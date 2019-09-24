<?php

namespace TK_Timestamp_Human\Shortcodes;

// Abort if this file is called directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( Manage_Shortcodes::class ) ) {
	/**
	 * Handle all the shortcodes.
	 */
	class Manage_Shortcodes {
		/**
		 * Shortcodes to register.
		 *
		 * Enter the name of each class (without namespace) from within the `TK_Timestamp_Human\Shortcodes` namespace.
		 */
		public $shortcode_classes = [
			'TK_Timestamp_Human',
		];

		/**
		 * Register all of the hard-coded shortcode classes.
		 *
		 * @see \TK_Timestamp_Human\Shortcodes\Abstract_Shortcode::register()
		 */
		public function register_all_shortcodes(): void {
			foreach ( $this->shortcode_classes as $shortcode_class ) {
				$shortcode_class = __NAMESPACE__ . '\\' . $shortcode_class;

				/** @var Abstract_Shortcode $shortcode_class */
				$shortcode_class = new $shortcode_class;

				$shortcode_class->register();
			}

		}
	}
}