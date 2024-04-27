<?php

// Retrieve the values of the cookies
$isCod = get_travelpro_options('travelproplus_cod');
$price = isset($_COOKIE['price']) ? $_COOKIE['price'] : null;
$isFlight = isset($_COOKIE['isFlight']) ? $_COOKIE['isFlight'] : null;
$stripeKey = isset($_COOKIE['key']) ? $_COOKIE['key'] : null;

// Check if the values are missing, empty, or null
if ($isCod) {
    if ($price === null || trim($price) === '') {
        // Either redirect the user to another page
        header('Location:' . get_home_url());
        exit;
    }
} else {
    if ($price === null || trim($price) === '' || $stripeKey === null || trim($stripeKey) === '') {
        // Either redirect the user to another page
        header('Location:' . get_home_url());
        exit;
    }
}

?>
<div class="container">
    <!-- Header -->
    <div class="header">
        <h2>Checkout</h2>
    </div>

    <!-- Parent Form -->
    <form id="paymentForm">
        <div class="row">
            <!-- Personal Information Form -->
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h5>Your Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="firstName" class="form-label">First Name:</label>
                            <input type="text" id="firstName" name="firstName" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name:</label>
                            <input type="text" id="lastName" name="lastName" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone:</label>
                            <input type="tel" id="phone" name="phone" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" id="address" name="address" class="form-control" required />
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="city" class="form-label">City:</label>
                                <input type="text" id="city" name="city" class="form-control" required />
                            </div>
                            <div class="col-md-4">
                                <label for="state" class="form-label">State:</label>
                                <input type="text" id="state" name="state" class="form-control" required />
                            </div>
                            <div class="col-md-4">
                                <label for="zip" class="form-label">Zip:</label>
                                <input type="zip" id="zip" name="zip" class="form-control" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">Country:</label>
                            <input type="text" id="country" name="country" class="form-control" required />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Information Form -->
            <div class="col-md-5">
                <!-- Booking Summary -->
                <div class="booking-summary">
                    <h3 class="booking-summary-heading">Booking Summary</h3>

                    <!-- Flight Details -->
                    <!-- <div class="details-container">
                        <h6>Flight Details:</h6>
                        <p><strong>Flight:</strong> XYZ123</p>
                        <p><strong>Date:</strong> April 25, 2024</p>
                        <p><strong>Time:</strong> 3:00 PM</p>
                        <p><strong>Departure:</strong> JFK Airport, New York</p>
                        <p><strong>Arrival:</strong> LAX Airport, Los Angeles</p>
                    </div> -->

                    <!-- Hotel Details -->
                    <!-- <div class="details-container">
                        <h6>Hotel Details:</h6>
                        <p><strong>Hotel:</strong> Grand Hotel</p>
                        <p><strong>Check-in Date:</strong> April 25, 2024</p>
                        <p><strong>Check-out Date:</strong> April 27, 2024</p>
                        <p><strong>Room Type:</strong> Deluxe Suite</p>
                        <p><strong>Location:</strong> 123 Main St, Los Angeles</p>
                    </div> -->

                    <!-- Total Price -->
                    <div class="details-container">
                        <h6>Total Price:</h6>
                        <p><strong><?php echo ($isFlight === 'true') ? 'Flight:' : 'Hotel:'; ?></strong> $<?php echo htmlspecialchars($price) ?></p>
                        <!-- <p><strong>Hotel:</strong> $450.00</p> -->
                        <p><strong>Grand Total:</strong> $<?php echo htmlspecialchars($price) ?></p>

                    </div>
                    <?php if ($isCod) { ?>
                        <button type="submit" class="btn btn-checkout w-100 mt-3">Send Inquiry</button>
                    <?php } ?>
                </div>
                <?php if ($isCod) { ?>
                <?php } else { ?>
                    <div class="card">
                        <div class="card-header">
                            <h5>Payment Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="cardNumber" class="form-label">Card Number:</label>
                                <div id="cardNumber" class="form-control"></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="cardExpiry" class="form-label">Expiration Date:</label>
                                    <div id="cardExpiry" class="form-control"></div>
                                </div>
                                <div class="col-md-6">
                                    <label for="cvc" class="form-label">CVC:</label>
                                    <div id="cvc" class="form-control"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-checkout w-100 mt-3">Pay Now</button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </form>
</div>

<script>
    var priceFlight = `<?php echo htmlspecialchars($price) ?>`;
    var stpkey = `<?php echo htmlspecialchars($stripeKey) ?>`;
    makeFlightPayment(priceFlight, stpkey);

    function makeFlightPayment(flightPrice, stpPk) {
        var stripe = Stripe(stpPk);
        var dynamicPrice = flightPrice;

        var elements = stripe.elements();

        var cardNumber = elements.create("cardNumber");
        cardNumber.mount("#cardNumber");

        var cardExpiry = elements.create("cardExpiry");
        cardExpiry.mount("#cardExpiry");

        var cvc = elements.create("cardCvc");
        cvc.mount("#cvc");

        $("#paymentForm").on("submit", function(event) {
            event.preventDefault(); // Prevent the form from submitting

            // Collect form data
            var formData = {
                firstName: $("#firstName").val(),
                lastName: $("#lastName").val(),
                address: $("#address").val(),
                city: $("#city").val(),
                state: $("#state").val(),
                zip: $("#zip").val(),
                country: $("#country").val(),
                amount: dynamicPrice, // Include the dynamic price in the form data
            };

            // Create a payment token using Stripe.js
            stripe.createToken(cardNumber).then(function(result) {
                if (result.error) {
                    // Handle error
                    console.error(result.error);
                } else {
                    // Token created successfully, send token to server
                    var token = result.token.id;
                    sendTokenToServer(token, dynamicPrice);

                    // console.log(token, 'token');
                }
            });
        });
    }

    // Function to send payment token to server
    function sendTokenToServer(token, amount) {
        const payApi = "/wp-json/stripe-payment/v1/charge";
        const pluginHost =
            window.location.host === "localhost" ?
            window.location.origin + "/wpplugindev" :
            window.location.origin;

        $(".flight-loader-wrapper").show();
        $.ajax({
            url: pluginHost + payApi,
            method: "POST",
            contentType: "application/json",
            data: JSON.stringify({
                stripeToken: token,
                amount: amount,
            }),
            success: function(response) {
                // Handle success response
                $(".flight-loader-wrapper").hide();
                alert(response.message);
                console.log("Payment successful");
                deleteCookie('price');
                deleteCookie('key');
                window.location.href = window.location.origin;
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error("Payment failed:", error);
                alert("Payment failed");
            },
        });
    }
</script>