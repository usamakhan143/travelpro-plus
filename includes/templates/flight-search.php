<link href="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/css/flight.css'; ?>" rel="stylesheet" media="all" />
<link href="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/select2/select2.min.css'; ?>" rel="stylesheet" media="all" />
<link href="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/datepicker/daterangepicker.css'; ?>" rel="stylesheet" media="all" />
<!-- Font special for pages-->
<link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />

<link href="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/css/main.css'; ?>" rel="stylesheet" media="all" />

<!-- Loader HTML -->
<div class="flight-loader-wrapper">
    <div class="loader"></div>
</div>

<!-- <form name="search-form" method="post">
    <label for="origin">Origin:</label><br>
    <input type="text" id="origin" name="origin"><br>
    <div id="origin-suggestions"></div>
    <label for="destination">Destination:</label><br>
    <input type="text" id="destination" name="destination"><br>
    <label for="departure_date">Departure Date:</label><br>
    <input type="date" id="departure_date" name="departure_date"><br>
    <label for="return_date">Return Date:</label><br>
    <input type="date" id="return_date" name="return_date"><br>

    <label for="adult">Adult:</label><br>
    <input type="number" id="adult" name="adult"><br>

    <label for="child">Child:</label><br>
    <input type="number" id="child" name="child"><br>

    <label for="infants">Infants:</label><br>
    <input type="number" id="infants" name="infants"><br>

    <label for="cabin">Cabin:</label><br />
    <select id="cabin" name="cabin">
        <option value="economy">Economy</option>
        <option value="premium_economy">Premium Economy</option>
        <option value="business">Business</option>
        <option value="first">First</option>
    </select>

    <input type="submit" value="Search">

    <br /><br /><br /><br /><br /><br />
</form> -->

<!-- <div class="page-wrapper bg-img-2 p-t-290 p-b-120"> -->
<!-- <div class="wrapper wrapper--w1226"> -->
<div class="card card-5">
    <div class="card-body">
        <form method="POST" action="#">
            <div class="row row-space">
                <div class="col-2">
                    <div class="input-group">
                        <label class="label">from</label>
                        <input class="input--style-1" type="text" name="from" placeholder="City, Region or Airport" required="required" />
                        <div class="icon-container origin-loader">
                            <i class="loader"></i>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="input-group">
                        <label class="label">to</label>
                        <input class="input--style-1" type="text" name="to" placeholder="City, Region or Airport" required="required" />
                        <div class="icon-container destination-loader">
                            <i class="loader"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-space">
                <div class="col-2">
                    <div class="row row-space">
                        <div class="col-2">
                            <div class="input-group m-b-0">
                                <label class="label">Passengers</label>
                                <div class="input-group-icon" id="js-select-special">
                                    <input class="input--style-1 input--text-small" type="text" name="passengers" value="1 Adult, 0 Child, 0 Infant" disabled="disabled" id="info" />
                                    <i class="zmdi zmdi-plus input-icon"></i>
                                </div>
                                <div class="dropdown-select">
                                    <ul class="list-room">
                                        <li class="list-room__item">
                                            <span class="list-room__name">Passengers</span>
                                            <ul class="list-person">
                                                <li class="list-person__item">
                                                    <span class="name">Adult</span>
                                                    <div class="quantity quantity1">
                                                        <span class="minus">-</span>
                                                        <input class="inputQty" type="number" min="0" value="1" />
                                                        <span class="plus">+</span>
                                                    </div>
                                                </li>
                                                <li class="list-person__item">
                                                    <span class="name">Child</span>
                                                    <div class="quantity quantity2">
                                                        <span class="minus">-</span>
                                                        <input class="inputQty" type="number" min="0" value="0" />
                                                        <span class="plus">+</span>
                                                    </div>
                                                </li>
                                                <li class="list-person__item">
                                                    <span class="name">Infant</span>
                                                    <div class="quantity quantity3">
                                                        <span class="minus">-</span>
                                                        <input class="inputQty" type="number" min="0" value="0" />
                                                        <span class="plus">+</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <!-- <div class="list-room__footer">
                            <a href="#" id="btn-add-room">Add room</a>
                          </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group m-b-0">
                                <label class="label">Depart</label>
                                <input class="input--style-1" type="text" name="depart" placeholder="YYYY-MM-DD" id="input-start" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="row row-space">
                        <div class="col-2">
                            <div class="input-group m-b-0">
                                <label class="label">Return</label>
                                <input class="input--style-1" type="text" name="return" placeholder="YYYY-MM-DD" id="input-end" />
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="submission-row">
                                <div class="select-container">
                                    <label class="label">Cabin Class</label>
                                    <select id="cabin" name="cabin" class="select--style-1">
                                        <option value="economy">Economy</option>
                                        <option value="premium_economy">Premium Economy</option>
                                        <option value="business">Business</option>
                                        <option value="first">First</option>
                                    </select>
                                </div>
                                <div class="button-container">
                                    <button class="btn-submit" type="submit">search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- </div> -->
<!-- </div> -->
<br /><br />
<div class="container">
    <h1>Flight Search Results</h1>
    <div id="search-results"></div>
    <div class="flight-load-more-container">
        <button id="flight-load-more-button">Load More</button>
    </div>
</div>
<br /><br /><br /><br />
<?php

$id_attributes = get_travelpro_options('travelproplus_id_attributes');
if ($id_attributes) {
    $flattenedData = array();

    foreach ($id_attributes as $subArray) {
        foreach ($subArray as $value) {
            if ($value != '_') {
                $flattenedData[] = '#' . trim($value);
            }
        }
    }

    $resultString = implode(', ', $flattenedData);
}
$ids_separated = $resultString;

?>

<script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/js/flights/location-autocomplete.js'; ?>"> </script>
<script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/js/flights/search-flights.js'; ?>"> </script>
<script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/js/flights/flight-card.js'; ?>"> </script>
<script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/select2/select2.min.js'; ?>"></script>
<script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/jquery-validate/jquery.validate.min.js'; ?>"></script>
<script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/bootstrap-wizard/bootstrap.min.js'; ?>"></script>
<script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/bootstrap-wizard/jquery.bootstrap.wizard.min.js'; ?>"></script>
<script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/datepicker/moment.min.js'; ?>"></script>
<script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/datepicker/daterangepicker.js'; ?>"></script>

<script>
    $(document).ready(function() {
        // Event handler for the search form submission
        $('form[name="search-form"]').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form values
            var originEntityId = $('#origin').data('id');
            var destinationEntityId = $('#destination').data('id');
            var departureDate = $('#departure_date').val();
            var returnDate = $('#return_date').val();
            var adult = $('#adult').val();
            var child = $('#child').val();
            var infants = $('#infants').val();
            var cabinClass = $('#cabin').val();

            // Perform flight search
            searchFlights(originEntityId, destinationEntityId, departureDate, returnDate, adult, child, infants, cabinClass);
        });

        // Event handler for the "Load More" button click
        $('#flight-load-more-button').click(function() {
            // Check if currentSessionId is defined
            if (currentSessionId) {
                // Call the function to load more flights with the current session ID
                loadCompleteResults(currentSessionId);
            } else {
                console.error("Error: Current session ID is undefined");
            }
        });
    });
</script>