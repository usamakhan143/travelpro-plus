<?php

// Add a custom endpoint for sending emails
function custom_send_email_endpoint()
{
    register_rest_route('booking/v1', '/send-confirmation', array(
        'methods' => 'POST',
        'callback' => 'send_custom_email',
    ));
}
add_action('rest_api_init', 'custom_send_email_endpoint');


// Callback function to send email
function send_custom_email($request)
{
    $params = $request->get_params();

    // Validate input parameters
    $required_fields = array('inquiry_type', 'first_name', 'last_name', 'email', 'phone', 'address', 'city', 'state', 'zip', 'country');
    foreach ($required_fields as $field) {
        if (empty($params[$field])) {
            return new WP_Error('missing_parameters', 'All fields are required.', array('status' => 400));
        }
    }

    // Prepare email content based on inquiry type
    $to = isset($params['email']) ? sanitize_email($params['email']) : '';
    $subject = 'Booking Confirmation';

    $message = "Billing Info:\n\n";
    $message .= isset($params['first_name']) ? "First Name: {$params['first_name']}\n" : '';
    $message .= isset($params['last_name']) ? "Last Name: {$params['last_name']}\n" : '';
    $message .= isset($params['email']) ? "Email: {$params['email']}\n" : '';
    $message .= isset($params['phone']) ? "Phone: {$params['phone']}\n" : '';
    $message .= isset($params['address']) ? "Address: {$params['address']}\n" : '';
    $message .= isset($params['city']) ? "City: {$params['city']}\n" : '';
    $message .= isset($params['state']) ? "State: {$params['state']}\n" : '';
    $message .= isset($params['zip']) ? "Zip: {$params['zip']}\n" : '';
    $message .= isset($params['country']) ? "Country: {$params['country']}\n" : '';

    if ($params['inquiry_type'] === 'hotel') {
        $message = "Hotel Inquiry:\n\n";
        $message .= isset($params['hotel_name']) ? "Hotel Name: {$params['hotel_name']}\n" : '';
        $message .= isset($params['check_in_date']) ? "Check In date: {$params['check_in_date']}\n" : '';
        $message .= isset($params['check_out_date']) ? "Check Out date: {$params['check_out_date']}\n" : '';
        $message .= isset($params['total_price']) ? "Total Price: {$params['total_price']}\n" : '';
        $message .= isset($params['destination']) ? "Destination: {$params['destination']}\n" : '';
        $message .= isset($params['adults']) ? "Adults: {$params['adults']}\n" : '';
        $message .= isset($params['children']) ? "Children: {$params['children']}\n" : '';
    } elseif ($params['inquiry_type'] === 'flight') {
        $message = "Flight Inquiry:\n\n";
        $message .= isset($params['flight_number']) ? "Flight Number: {$params['flight_number']}\n" : '';
        $message .= isset($params['departure_date']) ? "Departure Date: {$params['departure_date']}\n" : '';
        $message .= isset($params['arrival_date']) ? "Arrival Date: {$params['arrival_date']}\n" : '';
        $message .= isset($params['flight_price']) ? "Flight Price: {$params['flight_price']}\n" : '';
    } else {
        return new WP_Error('invalid_inquiry_type', 'Invalid inquiry type.', array('status' => 400));
    }

    // Send email if at least one field is provided
    if ($to && !empty($message)) {
        $sent = wp_mail($to, $subject, $message);

        if ($sent) {
            return array('message' => 'Email sent successfully.');
        } else {
            return new WP_Error('email_send_error', 'Failed to send email.', array('status' => 500));
        }
    } else {
        return new WP_Error('missing_parameters', 'At least one field is required.', array('status' => 400));
    }
}
