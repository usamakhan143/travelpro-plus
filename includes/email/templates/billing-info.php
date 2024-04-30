<?php
// Extract parameters
$first_name = isset($params['first_name']) ? $params['first_name'] : '';
$last_name = isset($params['last_name']) ? $params['last_name'] : '';
$email = isset($params['email']) ? $params['email'] : '';
$phone = isset($params['phone']) ? $params['phone'] : '';
$address = isset($params['address']) ? $params['address'] : '';
$city = isset($params['city']) ? $params['city'] : '';
$state = isset($params['state']) ? $params['state'] : '';
$zip = isset($params['zip']) ? $params['zip'] : '';
$country = isset($params['country']) ? $params['country'] : '';
?>

<p><strong>Billing Information:</strong></p>
<p>First Name: <?php echo $first_name; ?></p>
<p>Last Name: <?php echo $last_name; ?></p>
<p>Email: <?php echo $email; ?></p>
<p>Phone: <?php echo $phone; ?></p>
<p>Address: <?php echo $address; ?></p>
<p>City: <?php echo $city; ?></p>
<p>State: <?php echo $state; ?></p>
<p>Zip: <?php echo $zip; ?></p>
<p>Country: <?php echo $country; ?></p>