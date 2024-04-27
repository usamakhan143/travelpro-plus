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
    $required_fields = array('first_name', 'last_name', 'email', 'phone', 'address', 'city', 'state', 'zip', 'country', 'hotel_name', 'check_in_date', 'check_out_date', 'total_price');
    foreach ($required_fields as $field) {
        if (empty($params[$field])) {
            return new WP_Error('missing_parameters', 'All fields are required.', array('status' => 400));
        }
    }

    // Prepare email content
    $to = sanitize_email($params['email']);
    $subject = 'Booking Confirmation';

    $message = "Billing Info:\n\n";
    $message .= !empty($params['first_name']) ? "First Name: {$params['first_name']}\n" : '';
    $message .= !empty($params['last_name']) ? "Last Name: {$params['last_name']}\n" : '';
    $message .= !empty($params['email']) ? "Email: {$params['email']}\n" : '';
    $message .= !empty($params['phone']) ? "Phone: {$params['phone']}\n" : '';
    $message .= !empty($params['address']) ? "Address: {$params['address']}\n" : '';
    $message .= !empty($params['city']) ? "City: {$params['city']}\n" : '';
    $message .= !empty($params['state']) ? "State: {$params['state']}\n" : '';
    $message .= !empty($params['zip']) ? "Zip: {$params['zip']}\n" : '';
    $message .= !empty($params['country']) ? "Country: {$params['country']}\n" : '';

    $message .= "\nBooking Summary:\n\n";
    $message .= !empty($params['hotel_name']) ? "Hotel Name: {$params['hotel_name']}\n" : '';
    $message .= !empty($params['check_in_date']) ? "Check In date: {$params['check_in_date']}\n" : '';
    $message .= !empty($params['check_out_date']) ? "Check Out date: {$params['check_out_date']}\n" : '';
    $message .= !empty($params['total_price']) ? "Total Price: {$params['total_price']}\n" : '';

    // Send email
    $sent = wp_mail($to, $subject, $message);

    if ($sent) {
        return array('message' => 'Email sent successfully.');
    } else {
        return new WP_Error('email_send_error', 'Failed to send email.', array('status' => 500));
    }
}
