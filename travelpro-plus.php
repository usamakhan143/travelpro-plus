<?php
/*
 * Plugin Name: Travelpro Plus
 * Description: Just a user-friendly WordPress plugin enabling seamless flight and hotel bookings. Users search, view adjusted prices, and book with ease. Secure payments and admin notifications included.
 * Version: 1.0.0
 * Author: Usama Khan
 * Author URI: https://github.com/usamakhan143
 * Requires PHP: 7.4
 * Text Domain: translate-travelpro-plus
 */
ob_end_clean();
register_activation_hook(__FILE__, 'travelpro_plus_plugin_activate');

function travelpro_plus_plugin_activate()
{
	// Check if the hotel detail page exists
	$hotel_detail_page = get_page_by_path('hotel-detail');

	// If the page doesn't exist, create it
	if (!$hotel_detail_page) {
		$hotel_detail_page_id = wp_insert_post(array(
			'post_title'   => 'Hotel Detail',
			'post_content' => '',
			'post_status'  => 'publish',
			'post_type'    => 'page',
		));

		if ($hotel_detail_page_id) {
			// Page creation successful
			error_log('Hotel Detail page created with ID: ' . $hotel_detail_page_id);
		} else {
			// Page creation failed
			error_log('Failed to create Hotel Detail page');
		}
	} else {
		// Page already exists
		error_log('Hotel Detail page already exists');
	}
}

// Plugin deactivation hook
register_deactivation_hook(__FILE__, 'travelpro_plus_plugin_deactivate');

function travelpro_plus_plugin_deactivate()
{
	// Check if the hotel detail page exists
	$hotel_detail_page = get_page_by_path('hotel-detail');

	// If the page exists, delete it
	if ($hotel_detail_page) {
		$deleted = wp_delete_post($hotel_detail_page->ID, true);

		if ($deleted) {
			// Page deletion successful
			error_log('Hotel Detail page deleted');
		} else {
			// Page deletion failed
			error_log('Failed to delete Hotel Detail page');
		}
	}
}

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
