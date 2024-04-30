<?php

// Add a custom endpoint for sending emails
function custom_send_email_endpoint()
{
    register_rest_route('booking/v1', '/send-confirmation', array(
        'methods' => 'POST',
        'callback' => 'send_custom_email',
        'permission_callback' => '__return_true', // Allow access to all users
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

    ob_start(); // Start output buffering to capture HTML content

    if ($params['inquiry_type'] === 'hotel') {
        // Include hotel inquiry email template
        include_once(TRAVELPRO_PLUS_PLUGIN_PATH . 'includes/email/templates/hotel-info.php');
    } elseif ($params['inquiry_type'] === 'flight') {
        // Include flight inquiry email template
        include_once(TRAVELPRO_PLUS_PLUGIN_PATH . 'includes/email/templates/flight-info.php');
    } else {
        return new WP_Error('invalid_inquiry_type', 'Invalid inquiry type.', array('status' => 400));
    }

    $message = ob_get_clean(); // Get the captured HTML content and clear output buffer

    // Send email if at least one field is provided
    if ($to && !empty($message)) {
        $headers = array('Content-Type: text/html; charset=UTF-8');
        $sent = wp_mail($to, $subject, $message, $headers);

        if ($sent) {
            return array('message' => 'Email sent successfully.');
        } else {
            return new WP_Error('email_send_error', 'Failed to send email.', array('status' => 500));
        }
    } else {
        return new WP_Error('missing_parameters', 'At least one field is required.', array('status' => 400));
    }
}
