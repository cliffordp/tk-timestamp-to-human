<?php

namespace TK_Timestamp_Human\Core;

use TK_Timestamp_Human\Plugin_Data as Plugin_Data;

// Abort if this file is called directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( Internationalization_I18n::class ) ) {
	/**
	 * Define the internationalization functionality.
	 *
	 * Loads and defines the internationalization files for this plugin so that it is ready for translation.
	 */
	class Internationalization_I18n {

		/**
		 * Load the plugin text domain for translation.
		 */
		public function load_plugin_textdomain(): void {
			load_plugin_textdomain(
				Plugin_Data::plugin_text_domain(),
				false,
				dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
			);
		}
	}
}