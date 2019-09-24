<?php

namespace TK_Timestamp_Human\Shortcodes;

// Abort if this file is called directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use TK_Timestamp_Human\Common\Common as Common;

if ( ! class_exists( TK_Timestamp_Human::class ) ) {
	/**
	 * The class for the [tk_timestamp_human] shortcode.
	 */
	final class TK_Timestamp_Human extends Abstract_Shortcode {
		/**
		 * An array of all the shortcode's possible attributes and their default values.
		 *
		 * @return array
		 */
		public function get_defaults(): array {
			return [
				'timestamp'  => '', // or use the 'post_id' and 'field_timestamp' arguments
				'format'     => '', // default from the function is 'c'
				'time_zone'  => '', // only supports a PHP named time zone
				'field_name' => '', // the raw name (including the `wpcf-` prefix if a Types field) or a custom field that should have a UTC timestamp as its value
				'post_id'    => '', // applicable if using the 'field_timestamp' argument - defaults to current post if empty
			];
		}

		/**
		 * Shortcode: Get the human readable string from a UTC timestamp.
		 *
		 * @see  \TK_Timestamp_Human\Common\Common::timestamp_to_human()
		 *
		 * @param array  $atts    If using the shortcode, this will be an array. If using PHP function, array or scalar.
		 * @param string $content The value from using an enclosing (not self-closing) shortcode.
		 *
		 * @return string
		 */
		public function process_shortcode( array $atts = [], string $content = '' ) {
			$atts = $this->get_atts( $atts );

			$common = new Common();

			$result = $common->timestamp_to_human( $atts['timestamp'], $atts['format'], $atts['time_zone'], $atts['field_name'], $atts['post_id'] );

			// bad request
			if ( ! is_string( $result ) ) {
				return $this->get_error_message( 'Missing required parameter or other error' );
			}

			return $result;
		}
	}
}