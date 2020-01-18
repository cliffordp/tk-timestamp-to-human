<?php

namespace TK_Timestamp_Human;

// Abort if this file is called directly.
use TK_Timestamp_Human\Core as Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( Bootstrap::class ) ) {
	/**
	 * The file that gets things going.
	 */
	class Bootstrap {
		/**
		 * Begins execution of the plugin.
		 *
		 * Since everything within the plugin is registered via hooks, then kicking off the plugin from this point in the file
		 * does not affect the page life cycle.
		 *
		 * Also returns copy of the app object so 3rd party developers can interact with the plugin's hooks contained within.
		 *
		 * @return Bootstrap|null
		 */
		public function init(): ?self {
			$plugin = new self();

			if ( $plugin->is_ready() ) {
				$core = new Core\Init();
				$core->run();

				return $plugin;
			} else {
				return null;
			}
		}

		/**
		 * Output a message about unsatisfactory version of PHP.
		 */
		public function notice_old_php_version(): void {
			$help_link = sprintf( '<a href="%1$s" target="_blank">%1$s</a>', 'https://wordpress.org/about/requirements/' );

			$message = sprintf(
				__( '%1$s requires at least PHP version %2$s in order to work. You have version %3$s. Please see %4$s for more information.', 'tk-timestamp-to-human' ),
				'<strong>' . Plugin_Data::get_plugin_display_name() . '</strong>',
				'<strong>' . Plugin_Data::required_min_php_version() . '</strong>',
				'<strong>' . PHP_VERSION . '</strong>',
				$help_link
			);

			$this->do_admin_notice( $message );
		}

		/**
		 * Output a wp-admin notice.
		 *
		 * @param string $message
		 * @param string $type
		 */
		public function do_admin_notice( string $message, string $type = 'error' ): void {
			$class = sprintf( '%s %s', $type, sanitize_html_class( Plugin_Data::plugin_text_domain() ) );

			printf( '<div class="%s"><p>%s</p></div>', $class, $message );
		}

		/**
		 * Check if we have everything that is required.
		 *
		 * @return bool
		 */
		public function is_ready(): bool {
			$success = true;

			if ( version_compare( PHP_VERSION, Plugin_Data::required_min_php_version(), '<' ) ) {
				add_action( 'admin_notices', [ $this, 'notice_old_php_version' ] );
				$success = false;
			}

			return $success;
		}

		/**
		 * Get the file path of the plugin file from the plugin slug, if the plugin is installed.
		 *
		 * @param string $slug Plugin slug (typically folder name) as provided by the developer.
		 *
		 * @return string Either file path for plugin directory, or just the plugin file slug.
		 */
		private function get_plugin_basename_from_slug( string $slug ): string {
			$keys = array_keys( get_plugins() );

			foreach ( $keys as $key ) {
				if ( preg_match( '|^' . $slug . '/|', $key ) ) {
					return $key;
				}
			}

			return $slug;
		}

	}
}