<?php include TRAVELPRO_PLUS_PLUGIN_PATH . 'includes/email/templates/billing-info.php'; ?>

<?php
// Extract flight parameters
$flight_details = isset($params['flight_details']) ? $params['flight_details'] : '';
$departure_date = isset($params['departure_date']) ? $params['departure_date'] : '';
$arrival_date = isset($params['arrival_date']) ? $params['arrival_date'] : '';
$flight_price = isset($params['flight_price']) ? $params['flight_price'] : '';
$passangers = isset($params['passengers']) ? $params['passengers'] : '';
?>

<p><strong>Flight Inquiry:</strong></p>
<p>Flight Details: <?php echo $flight_details; ?></p>
<p>Passengers: <?php echo $passangers; ?></p>
<p>Departure Date: <?php echo $departure_date; ?></p>
<?php if (!empty($arrival_date)) : ?>
    <p>Arrival Date: <?php echo $arrival_date; ?></p>
<?php endif; ?>
<p>Total Price: $<?php echo $flight_price; ?></p>