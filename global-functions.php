<?php

// Functions to be available to the global namespace.

if ( ! function_exists( 'tk_timestamp_to_human_wp_all_export' ) ) {
	/**
	 * A global function to use the shortcode to get the human readable format for WP All Export's usage.
	 *
	 * Types' timestamp custom field value (assumed to be UTC) to "8 July, 2011" format in WP's time zone.
	 *
	 * @link http://www.wpallimport.com/tour/export-developer-friendly/ The reason this needs to be global namespace.
	 *
	 * @see  \TK_Timestamp_Human\Shortcodes\TK_Timestamp_Human
	 *
	 * @param int|string $timestamp
	 *
	 * @return string
	 */
	function tk_timestamp_to_human_wp_all_export( $timestamp ) {
		if ( ! shortcode_exists( 'tk_timestamp_human' ) ) {
			return (string) $timestamp;
		}

		$shortcode = sprintf( '[tk_timestamp_human timestamp="%d" format="j F, Y"]', $timestamp );

		return do_shortcode( $shortcode );
	}
}