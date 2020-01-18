<?php

namespace TK_Timestamp_Human\Frontend;

use TK_Timestamp_Human\Plugin_Data as Plugin_Data;

// Abort if this file is called directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( Assets::class ) ) {
	/**
	 * Enqueues the public-facing assets.
	 */
	class Assets {

		/**
		 * Register the stylesheets for the public-facing side of the site.
		 */
		public function enqueue_styles(): void {
			wp_enqueue_style( Plugin_Data::plugin_text_domain(), plugin_dir_url( __FILE__ ) . 'css/style.css', [], Plugin_Data::plugin_version(), 'all' );
		}

		/**
		 * Register the JavaScript for the public-facing side of the site.
		 */
		public function enqueue_scripts(): void {
			wp_enqueue_script( Plugin_Data::plugin_text_domain(), plugin_dir_url( __FILE__ ) . 'js/script.js', [ 'jquery' ], Plugin_Data::plugin_version(), false );
		}
	}
}