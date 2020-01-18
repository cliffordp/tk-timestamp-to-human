<?php

namespace TK_Timestamp_Human\Core;

use TK_Timestamp_Human\Admin as Admin;
use TK_Timestamp_Human\Common as Common;
use TK_Timestamp_Human\Frontend as Frontend;
use TK_Timestamp_Human\Shortcodes as Shortcodes;
use TK_Timestamp_Human\Plugin_Data as Plugin_Data;

// Abort if this file is called directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( Init::class ) ) {
	/**
	 * The core plugin class.
	 * Defines internationalization, admin-specific hooks, and public-facing site hooks.
	 */
	class Init {

		/**
		 * The loader that's responsible for maintaining and registering all hooks that power
		 * the plugin.
		 *
		 * @var      Loader $loader Maintains and registers all hooks for the plugin.
		 */
		protected $loader;

		/**
		 * Initialize and define the core functionality of the plugin.
		 */
		public function __construct() {
			$this->load_dependencies();
			$this->set_locale();
			$this->define_common_hooks();
			$this->define_admin_hooks();
			$this->define_public_hooks();
			$this->register_shortcodes();
		}

		/**
		 * Loads the following required dependencies for this plugin.
		 *
		 * - Loader - Orchestrates the hooks of the plugin.
		 * - Internationalization_I18n - Defines internationalization functionality.
		 * - Admin - Defines all hooks for the admin area.
		 * - Frontend - Defines all hooks for the public side of the site.
		 */
		private function load_dependencies(): void {
			$this->loader = new Loader();
		}

		/**
		 * Define the locale for this plugin for internationalization.
		 *
		 * Uses the Internationalization_I18n class in order to set the domain and to register the hook
		 * with WordPress.
		 */
		private function set_locale(): void {
			$plugin_i18n = new Internationalization_I18n();

			$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
		}

		/**
		 * Register all of the hooks related to both the admin area and the public-facing functionality of the plugin.
		 */
		private function define_common_hooks(): void {
			//$plugin_common = new Common\Common();

			// Example: $this->loader->add_filter( 'gform_currencies', $plugin_common, 'gf_currency_usd_whole_dollars', 50 );
		}

		/**
		 * Register all of the hooks related to the admin area functionality of the plugin.
		 * Also works during Ajax.
		 */
		private function define_admin_hooks(): void {
			if ( ! is_admin() ) {
				return;
			}
		}

		/**
		 * Register all of the hooks related to the public-facing functionality of the plugin.
		 * Also works during Ajax.
		 */
		private function define_public_hooks(): void {
			if (
				is_admin()
				&& ! wp_doing_ajax()
			) {
				return;
			}

			$assets = new Frontend\Assets();

			// Enqueue plugin's front-end assets
			$this->loader->add_action( 'wp_enqueue_scripts', $assets, 'enqueue_styles' );
		}

		/**
		 * Register all of the shortcodes.
		 */
		private function register_shortcodes(): void {
			( new Shortcodes\Manage_Shortcodes() )->register_all_shortcodes();
		}

		/**
		 * Run the loader to execute all of the hooks with WordPress.
		 */
		public function run(): void {
			$this->loader->run();
		}

		/**
		 * The reference to the class that orchestrates the hooks with the plugin.
		 *
		 * @return Loader Orchestrates the hooks of the plugin.
		 */
		public function get_loader(): Loader {
			return $this->loader;
		}
	}
}