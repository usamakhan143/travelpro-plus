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
	$checkout_page = get_page_by_path('make-payment');

	// If the page doesn't exist, create it
	if (!$hotel_detail_page && !$checkout_page) {
		$hotel_detail_page_id = wp_insert_post(array(
			'post_title'   => 'Hotel Detail',
			'post_content' => '[hotel_detail]',
			'post_status'  => 'publish',
			'post_type'    => 'page',
		));

		$checkout_page_id = wp_insert_post(array(
			'post_title'   => 'Checkout',
			'post_content' => '[travelpro_plus_checkout]',
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_name'    => 'make-payment', // This sets the page slug
		));

		if ($hotel_detail_page_id && $checkout_page_id) {
			// Page creation successful
			error_log('Hotel Detail page and checkout page created with their IDs. Hotel detail ID:' . $hotel_detail_page_id . ' checkout ID:' . $checkout_page_id);
		} else {
			// Page creation failed
			error_log('Failed to create Hotel Detail and checkout page');
		}
	} else {
		// Page already exists
		error_log('Hotel Detail and checkout page already exists');
	}
}

// Plugin deactivation hook
register_deactivation_hook(__FILE__, 'travelpro_plus_plugin_deactivate');

function travelpro_plus_plugin_deactivate()
{
	// Check if the hotel detail page exists
	$hotel_detail_page = get_page_by_path('hotel-detail');
	// Check if the "Checkout" page exists
	$checkout_page = get_page_by_path('make-payment');

	// If the page exists, delete it
	if ($hotel_detail_page && $checkout_page) {
		$deleted = wp_delete_post($hotel_detail_page->ID, true);
		$deletedCheckout = wp_delete_post($checkout_page->ID, true);

		if ($deleted) {
			// Page deletion successful
			error_log('Hotel Detail page deleted');
			error_log('Travelpro Plus Checkout page deleted');
		} else {
			// Page deletion failed
			error_log('Failed to delete Hotel Detail page');
			error_log('Failed to delete Travelpro Plus Checkout page');
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
