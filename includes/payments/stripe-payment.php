<?php

// Register custom RESTful endpoint for handling payments
add_action('rest_api_init', 'register_payment_endpoint');
function register_payment_endpoint()
{
    register_rest_route('stripe-payment/v1', '/charge', array(
        'methods' => 'POST',
        'callback' => 'process_payment',
        'permission_callback' => '__return_true', // Allow access to all users
    ));
}


// Callback function to process payment
function process_payment(WP_REST_Request $request)
{
    $token = $request->get_param('stripeToken');
    $amount = $request->get_param('amount'); // Make sure to sanitize and validate this value
    $currency = 'USD'; // You can set the currency as per your requirement
    $description = 'Payment for Flight Booking'; // Set a description for the payment


    // Convert dollar amount to cents
    $amount_in_cents = $amount * 100;

    // Set your secret API key
    \Stripe\Stripe::setApiKey(get_travelpro_options('travelproplus_stripesk'));

    try {
        // Create charge using Stripe API
        $charge = \Stripe\Charge::create(array(
            'amount' => $amount_in_cents,
            'currency' => $currency,
            'source' => $token,
            'description' => $description
        ));

        // Payment successful
        return rest_ensure_response(array('success' => true, 'message' => 'Payment processed successfully'));
    } catch (\Stripe\Exception\CardException $e) {
        // Payment failed
        return rest_ensure_response(array('success' => false, 'message' => $e->getError()->message));
    }
}
