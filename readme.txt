=== TK Timestamp to Human Readable Date ===

Contributors: cliffpaulick
Tags: timestamp, shortcode, import-export, toolset
Requires at least: 4.5
Tested up to: 5.3.2
Requires PHP: 7.1.0
Stable tag: 1.0.1
License: GPL version 3 or any later version
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Given a timestamp (assumed in UTC), convert to a human-readable date format using PHP named time zones.

== Description ==

= All Available Shortcode Arguments =

<pre>
'timestamp'  => '', // or use the 'post_id' and 'field_timestamp' arguments
'format'     => 'c', // see https://www.php.net/manual/en/function.date.php
'time_zone'  => '', // defaults to WP's General Settings time zone (if valid PHP time zone), else UTC. Only supports a PHP named time zone -- see https://www.php.net/manual/en/timezones.php
'field_name' => '', // the raw name (including the `wpcf-` prefix if a Types field) or a custom field that should have a UTC timestamp as its value
'post_id'    => '', // applicable if using the 'field_timestamp' argument - defaults to current post if empty
</pre>

= Shortcode Examples =

1)
Shortcode: `[tk_timestamp_human timestamp="1608299220"]`

(Assuming your WordPress General Settings time zone is set to 'Europe/Amsterdam')
Expected Result: `2020-12-18T14:47:00+01:00`

2)
Shortcode: `[tk_timestamp_human timestamp="1608299220" time_zone="America/Chicago"]`

Expected Result: `2020-12-18T07:47:00-06:00`

3)
Shortcode: `[tk_timestamp_human timestamp="1608299220" time_zone="UTC"]`

Expected Result: `2020-12-18T13:47:00+00:00`

4)
Shortcode: `[tk_timestamp_human timestamp="1608299220" time_zone="America/Chicago" format="j F, Y"]`

Expected Result: `18 December, 2020`

= Global Function =

The `tk_timestamp_to_human_wp_all_export()` global function is available as a wrapper for the shortcode, using all its defaults except requiring the Timestamp argument and optionally passing the Format and Time Zone parameters.

This can be handy for using with WP All Export ([http://www.wpallimport.com/tour/export-developer-friendly/](http://www.wpallimport.com/tour/export-developer-friendly/)), such as to export a custom field that's a UTC timestamp value to a human-readable format, such as if the system you're moving the data to requires a specific format.

== Screenshots ==

1. Basic usage
2. Example in UTC
3. Example in America/Chicago
3. Example in America/Chicago, with formatting

== Changelog ==

= 1.0.1 =

* January 21, 2020
* Remove link to settings because there aren't any settings to see.
* Remove loading of empty CSS/JS files on Admin and Frontend.
* Fix for the shortcode's default date format not coming through, making the shortcode not have a valid result.
* Added `$format` as the 2nd parameter for `tk_timestamp_to_human_wp_all_export()`.
* Fallback time zone (if WP's isn't a valid PHP time zone) changed from 'America/Edmonton' to 'UTC'.
* Removed this plugin recommending installing WP All Export plugin and all code regarding required plugins or themes.
* Tested working with WordPress 5.3+ even though this plugin's code was not updated to use its new `wp_time()`; we just don't need it for this plugin.
* Language files and translatable strings setup for publishing to WordPress.org

= 1.0.0 =

* September 24, 2019
* Initial version.
* FYI: Was not available on WordPress.org.