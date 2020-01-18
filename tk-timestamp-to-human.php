<?php
/**
 * The plugin bootstrap file
 *
 * Introduction to the structure of this plugin's files:
 *
 * tk-timestamp-to-human/src/class-plugin_data.php - hard-coded information about the plugin, such as text domain
 * tk-timestamp-to-human/src/class-bootstrap.php - gets the plugin going, including setting required/recommended plugin dependencies
 *
 * tk-timestamp-to-human/src/frontend - public-facing functionality
 * tk-timestamp-to-human/src/common - functionality shared between the admin area and the public-facing parts
 *
 * tk-timestamp-to-human/src/common/utilities - generic functions for things like debugging, processing multidimensional arrays, handling datetimes, etc.
 * tk-timestamp-to-human/src/core - plugin core to register hooks, load files etc
 * tk-timestamp-to-human/src/shortcodes - where to create new shortcodes
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @package           TK_Timestamp_Human
 *
 * @wordpress-plugin
 * Plugin Name:       TK Timestamp to Human Readable Date
 * Plugin URI:        https://github.com/cliffordp/tk-timestamp-to-human
 * Description:       Given a timestamp (assumed in UTC), convert to a human-readable date format using PHP named time zones.
 * Version:           1.0.1
 * Author:            TourKick LLC (Clifford P)
 * Author URI:        https://tourkick.com/
 * License:           GPL version 3 or any later version
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       tk-timestamp-to-human
 * Domain Path:       /languages
 *
 ***
 *
 *     This plugin is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     any later version.
 *
 *     This plugin is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *     GNU General Public License for more details.
 *
 ***
 *
 *     This plugin was helped by Clifford Paulick's Plugin Boilerplate,
 *     available free at https://github.com/cliffordp/tk-timestamp-to-human
 *     You are invited to use it for your own WordPress projects.
 */

namespace TK_Timestamp_Human;

// Abort if this file is called directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Autoloading, via Composer.
 *
 * @link https://getcomposer.org/doc/01-basic-usage.md#autoloading
 */
require_once( __DIR__ . '/vendor/autoload.php' );

// Define Constants

/**
 * Register Activation and Deactivation Hooks
 * This action is documented in src/core/class-activator.php
 */
register_activation_hook( __FILE__, [ __NAMESPACE__ . '\Core\Activator', 'activate' ] );

/**
 * The code that runs during plugin deactivation.
 * This action is documented src/core/class-deactivator.php
 */
register_deactivation_hook( __FILE__, [ __NAMESPACE__ . '\Core\Deactivator', 'deactivate' ] );

// Begin execution of the plugin.
$init = ( new Bootstrap() )->init();

if ( ! empty( $init ) ) {
	include_once( 'global-functions.php' );
}