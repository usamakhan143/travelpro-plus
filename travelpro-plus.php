<?php

/**
 * Plugin Name: Travelpro Plus
 * Description: Just a user-friendly WordPress plugin enabling seamless flight and hotel bookings. Users search, view adjusted prices, and book with ease. Secure payments and admin notifications included.
 * Version: 1.0.0
 * Author: Usama Khan
 * Author URI: https://github.com/usamakhan143
 * Requires PHP: 7.4
 * Text Domain: translate-travelpro-plus
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
// A user-friendly WordPress plugin enabling seamless flight and hotel bookings. Users search, view adjusted prices, and book with ease. Secure payments and admin notifications included.

if (!class_exists('TravelproPlus')) {


	class TravelproPlus
	{

		public function __construct()
		{
			// Define a constant to initialize the plugin path.
			define('TRAVELPRO_PLUS_PLUGIN_PATH', plugin_dir_path(__FILE__));

			// Define a constant to initialize the frontend plugin path.
			define('TRAVELPRO_PLUS_PLUGIN_URL', plugin_dir_url(__FILE__));

			// Call the packages that you are using in the plugin to enhance the functionality.
			require_once(TRAVELPRO_PLUS_PLUGIN_PATH . '/vendor/autoload.php');
		}

		public function initialize()
		{
			include_once(TRAVELPRO_PLUS_PLUGIN_PATH . '/includes/utilities.php');
			include_once(TRAVELPRO_PLUS_PLUGIN_PATH . '/includes/options-page.php');
			include_once(TRAVELPRO_PLUS_PLUGIN_PATH . '/includes/travelpro-plus.php');
		}
	}
} else {
	die('This class is already exist!');
}

$TravelproPlus = new TravelproPlus();
$TravelproPlus->initialize();