<?php include TRAVELPRO_PLUS_PLUGIN_PATH . 'includes/email/templates/billing-info.php'; ?>

<?php
// Extract hotel parameters
$hotel_name = isset($params['hotel_name']) ? $params['hotel_name'] : '';
$check_in_date = isset($params['check_in_date']) ? $params['check_in_date'] : '';
$check_out_date = isset($params['check_out_date']) ? $params['check_out_date'] : '';
// $adults = isset($params['adults']) ? $params['adults'] : '';
// $children = isset($params['children']) ? $params['children'] : '';
$hotel_price = isset($params['hotel_price']) ? $params['hotel_price'] : '';
?>

<p><strong>Hotel Inquiry:</strong></p>
<p>Hotel Name: <?php echo $hotel_name; ?></p>
<p>Check In date: <?php echo $check_in_date; ?></p>
<p>Check Out date: <?php echo $check_out_date; ?></p>
<p>Total Price: $<?php echo $hotel_price; ?></p>