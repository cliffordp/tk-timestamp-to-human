<?php

namespace TK_Timestamp_Human\Common;

use TK_Timestamp_Human\Plugin_Data as Plugin_Data;
use TK_Timestamp_Human\Common\Utilities\Posts as Posts;
use TK_Timestamp_Human\Common\Utilities\Timing as Timing;

// Abort if this file is called directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( Common::class ) ) {
	/**
	 * The functionality shared between the admin and public-facing areas of the plugin.
	 *
	 * Useful for things that affect both back-end and front-end.
	 */
	class Common {

		/**
		 * Capability required to access the settings, be shown error messages, etc.
		 *
		 * By default, 'customize' is mapped to 'edit_theme_options' (Administrator).
		 *
		 * @link  https://developer.wordpress.org/themes/customize-api/advanced-usage/
		 *
		 * @return string
		 */
		public function required_capability(): string {
			return apply_filters( Plugin_Data::plugin_text_domain_underscores() . '_required_capability', 'customize' );
		}

		/**
		 * Get the output's wrapper class.
		 *
		 * Used by the Customizer to add the quick edit pencil icon within the previewer.
		 *
		 * @return string
		 */
		public function get_wrapper_class(): string {
			$class = Plugin_Data::plugin_text_domain_underscores() . '-wrapper';

			return esc_attr( $class );
		}

		/**
		 * Given a specific timestamp, or a custom field name from which to get a timestamp for a post,
		 * get its string value in the given format in the time zone from WordPress' General Settings.
		 *
		 * @link https://www.php.net/manual/function.date.php Allowed formats.
		 *
		 * @param int|string $timestamp  Numeric. Required if no custom field name.
		 * @param string     $format     Anything supported by PHP's `date()`. Default: 2004-02-12T15:19:21+00:00
		 * @param string     $time_zone  A PHP named time zone, else WP's is used, else hard-coded fallback used.
		 * @param string     $field_name Name of custom field. Required if no Timestamp.
		 * @param int|string $post_id    Post from which to get custom field value. If empty, current post.
		 *
		 * @return bool|string False if bad request, else non-empty string of the result.
		 */
		public function timestamp_to_human( $timestamp = '', $format = 'c', $time_zone = '', $field_name = '', $post_id = 0 ) {
			// bad request
			if (
				! is_numeric( $timestamp )
				&& empty( $field_name )
			) {
				return false;
			}

			$posts  = new Posts();
			$timing = new Timing();

			// if custom field is set, override $timestamp with it, even if it's a non-empty value as well
			if ( ! empty( $field_name ) ) {
				// from custom field
				$post_id = $posts->post_id_helper( $post_id );

				if ( empty( $post_id ) ) {
					return false;
				}

				$timestamp = get_post_meta( $post_id, $field_name, true );

				if (
					empty( $timestamp )
					|| ! is_numeric( $timestamp ) // got something other than the expected timestamp
				) {
					return false;
				}
			}

			$timestamp = (int) $timestamp;

			$date = $timing->get_datetime_from_utc_timestamp( $timestamp, $format, $time_zone );

			if (
				empty( $date )
				|| ! is_string( $date ) // unexpected but just in case
			) {
				return false;
			} else {
				return $date;
			}
		}
	}
}