<div class="container">
    <!-- Header -->
    <div class="header">
        <h2>Checkout</h2>
    </div>

    <!-- Parent Form -->
    <form id="checkoutForm">
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
                        <p><strong>Flight:</strong> $300.00</p>
                        <p><strong>Hotel:</strong> $450.00</p>
                        <p><strong>Grand Total:</strong> $750.00</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>Payment Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="cardNumber" class="form-label">Card Number:</label>
                            <input type="text" id="cardNumber" name="cardNumber" class="form-control" required placeholder="1234 5678 9012 3456" />
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="cardExpiry" class="form-label">Expiry Date:</label>
                                <input type="text" id="cardExpiry" name="cardExpiry" class="form-control" required placeholder="MM/YY" />
                            </div>
                            <div class="col-md-6">
                                <label for="cvc" class="form-label">CVC:</label>
                                <input type="text" id="cvc" name="cvc" class="form-control" required placeholder="123" />
                            </div>
                            <div class="col-md-12">
                                <!-- Checkout Button -->
                                <button type="submit" form="checkoutForm" class="btn btn-checkout w-100 mt-3">
                                    Pay now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>