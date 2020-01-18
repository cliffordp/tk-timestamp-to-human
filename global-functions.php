<?php

// Functions to be available to the global namespace.

if ( ! function_exists( 'tk_timestamp_to_human_wp_all_export' ) ) {
	/**
	 * A global function to use the shortcode to get the human readable format for WP All Export's usage.
	 *
	 * @link  http://www.wpallimport.com/tour/export-developer-friendly/ The reason this needs to be global namespace.
	 *
	 * @see   \TK_Timestamp_Human\Shortcodes\TK_Timestamp_Human
	 *
	 * @since 1.0.0
	 * @since 1.0.1 Removed hard-coded 'j F, Y' formatting. Added `format` and `time_zone` params.
	 *
	 * @param int|string $timestamp
	 * @param string     $format
	 * @param string     $time_zone
	 *
	 * @return string
	 */
	function tk_timestamp_to_human_wp_all_export(
		$timestamp,
		string $format = '',
		string $time_zone = ''
	) {
		if ( ! shortcode_exists( 'tk_timestamp_human' ) ) {
			return (string) $timestamp;
		}

		$shortcode = sprintf( '[tk_timestamp_human timestamp="%d" format="%s", time_zone="%s"]', $timestamp, $format, $time_zone );

		return do_shortcode( $shortcode );
	}
}