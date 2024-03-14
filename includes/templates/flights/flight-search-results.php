<div class="modal fade modal-lg" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Checkout</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="paymentForm">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label">First Name:</label>
                            <input type="text" id="firstName" name="firstName" class="form-control" required />
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label">Last Name:</label>
                            <input type="text" id="lastName" name="lastName" class="form-control" required />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address:</label>
                        <input type="text" id="address" name="address" class="form-control" required />
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="city" class="form-label">City:</label>
                            <input type="text" id="city" name="city" class="form-control" required />
                        </div>
                        <div class="col-md-4">
                            <label for="state" class="form-label">State:</label>
                            <input type="text" id="state" name="state" class="form-control" required />
                        </div>
                        <div class="col-md-2">
                            <label for="zip" class="form-label">Zip:</label>
                            <input type="text" id="zip" name="zip" class="form-control" required />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="country" class="form-label">Country:</label>
                        <input type="text" id="country" name="country" class="form-control" required />
                    </div>
                    <hr class="my-4" />
                    <h4>Card Information</h4>
                    <div class="mb-3">
                        <label for="cardNumber" class="form-label">Card Number:</label>
                        <input type="text" id="cardNumber" data-stripe="number" class="form-control" required />
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="expMonth" class="form-label">Expiration Month:</label>
                            <input type="text" id="expMonth" data-stripe="exp_month" class="form-control" required />
                        </div>
                        <div class="col-md-6">
                            <label for="expYear" class="form-label">Expiration Year:</label>
                            <input type="text" id="expYear" data-stripe="exp_year" class="form-control" required />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="cvc" class="form-label">CVC:</label>
                        <input type="text" id="cvc" data-stripe="cvc" class="form-control" required />
                    </div>
                    <button type="submit" class="btn btn-success">Pay Now</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="maincontainer">
    <h2 class="travelpro-plus-flight-results-heading">Flight Search Results</h2>
    <div id="search-results"></div>
    <div class="flight-load-more-container">
        <button id="flight-load-more-button">Load More</button>
    </div>
</div>