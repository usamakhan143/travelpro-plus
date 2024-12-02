<?php

add_shortcode('flights_search_form', 'show_flight_search_form');
add_shortcode('flights_search_results', 'showFlightSearchResults');
add_shortcode('hotel_search_form', 'show_hotel_search_form');
add_shortcode('hotels_search_results', 'showHotelSearchResults');
add_shortcode('hotel_detail', 'showHotelDetail');
add_shortcode('travelpro_plus_checkout', 'showCheckout');
add_shortcode('hotels_search_redirect_form', 'showHotelSearchRedirect');

add_action('wp_head', 'runJqueryTravelproPlus');
add_action('wp_enqueue_scripts', 'enqueue_travelproplus_styles', 100);
add_action('wp_enqueue_scripts', 'travelproCheckout_styles', 100);
add_action('wp_enqueue_scripts', 'travelproHotelSearch_styles', 100);
add_action('wp_enqueue_scripts', 'travelproHotelDetail_styles', 100);
add_action('wp_footer', 'travelproPlusbeforeBodyClosingScripts', 9999);
add_action('init', 'travelproPlusStripePaymentHandling');
add_action('wp_footer', 'travelproCheckout_footerScripts', 9999);
add_action('init', 'sendEmailNotificationTravelproPlus');

// Hotel Search Redirect Form
function showHotelSearchRedirect()
{
    include TRAVELPRO_PLUS_PLUGIN_PATH . '/includes/templates/hotels/hotel-search-redirect.php';
}

// Checkout Page
function showCheckout()
{
    include TRAVELPRO_PLUS_PLUGIN_PATH . '/includes/templates/bookings/checkout.php';
}

// Flight Search Form
function show_flight_search_form()
{
    include TRAVELPRO_PLUS_PLUGIN_PATH . '/includes/templates/flights/flight-search-style-2.php';
}

function showFlightSearchResults()
{
    include TRAVELPRO_PLUS_PLUGIN_PATH . '/includes/templates/flights/flight-search-results.php';
}

// Hotel Search Form
function show_hotel_search_form()
{
    include TRAVELPRO_PLUS_PLUGIN_PATH . '/includes/templates/hotels/hotel-search.php';
}

// Hotel Results
function showHotelSearchResults()
{
    include TRAVELPRO_PLUS_PLUGIN_PATH . '/includes/templates/hotels/hotel-search-results.php';
}

// Hotel Detail
function showHotelDetail()
{
    include TRAVELPRO_PLUS_PLUGIN_PATH . '/includes/templates/hotels/hotel-detail.php';
}

function runJqueryTravelproPlus()
{
?>
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet" />
    <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'node_modules/jquery/dist/jquery.min.js'; ?>"> </script>
    <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'node_modules/jquery-ui/dist/jquery-ui.min.js'; ?>"></script>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Date picker disable before dates.

        var currentDate = new Date();
        $("#departure-date").datepicker({
            minDate: 0, // Disable past dates
            onSelect: function(selectedDate) {
                // Set the minDate of the second datepicker to the selected date
                $("#return-date").datepicker("option", "minDate", selectedDate);
            },
        });
        $("#return-date").datepicker({
            minDate: 0, // Disable past dates
        });
    </script>
    <?php
}


function travelproCheckout_styles()
{
    // Check if the current page or post contains your plugin's shortcode
    if (is_page() || is_single()) {
        if ((has_shortcode(get_the_content(), 'travelpro_plus_checkout'))) {
            $checkoutFormCss = TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/css/checkout.css';
            $bootstrap5 = TRAVELPRO_PLUS_PLUGIN_URL . 'node_modules/bootstrap/dist/css/bootstrap.min.css';
            wp_register_style('travelpro-plus-bootstrapFive', $bootstrap5, array(), '1.0.0');
            wp_register_style('travelpro-plus-checkoutFormCss', $checkoutFormCss, array(), '1.0.0');

            wp_enqueue_style('travelpro-plus-bootstrapFive');
            wp_enqueue_style('travelpro-plus-checkoutFormCss');
        }
    }
}

function travelproHotelSearch_styles()
{
    // Check if the current page or post contains your plugin's shortcode
    if (is_page() || is_single()) {
        if ((has_shortcode(get_the_content(), 'hotel_search_form'))) {
            $customModalCss = TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/css/custom-modal.css';
            $hotelSearchResults = TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/css/hotel-card-style2.css';
            // Custom Modal
            wp_register_style('travelpro-plus-customModalCss', $customModalCss, array(), '1.0.0');
            wp_enqueue_style('travelpro-plus-customModalCss');
            // Search Results
            wp_register_style('travelpro-plus-hotelSearchResults', $hotelSearchResults, array(), '1.0.0');
            wp_enqueue_style('travelpro-plus-hotelSearchResults');
        }
    }
}

function travelproCheckout_footerScripts()
{
    if (is_page() && (has_shortcode(get_the_content(), 'travelpro_plus_checkout'))) {
    ?>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/js/utilities.js'; ?>"></script>;
    <?php
    }
}


function travelproHotelDetail_styles()
{
    // Check if the current page or post contains your plugin's shortcode
    if (is_page() || is_single()) {
        if ((has_shortcode(get_the_content(), 'hotel_detail'))) {
            $hotelDetail = TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/css/hotel-detail.css';
            wp_register_style('travelpro-plus-hotelDetail', $hotelDetail, array(), '1.0.0');
            wp_enqueue_style('travelpro-plus-hotelDetail');
        }
    }
}


function enqueue_travelproplus_styles()
{
    // Check if the current page or post contains your plugin's shortcode
    if (is_page() || is_single()) {
        if ((has_shortcode(get_the_content(), 'flights_search_form') && has_shortcode(get_the_content(), 'flights_search_results')) || has_shortcode(get_the_content(), 'hotel_search_form') || has_shortcode(get_the_content(), 'hotels_search_redirect_form') || has_shortcode(get_the_content(), 'hotel_detail')) {

            // Register your plugin's styles
            $fontAwesome = TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/font-awesome-4.7/css/font-awesome.min.css';
            $materialDesignIconic = TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/mdi-font/css/material-design-iconic-font.min.css';
            $searchFormCss = TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/css/flight-search-form.css';
            $datePickerRangeCss = TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/datepicker/daterangepicker.css';
            $flightResults = TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/css/flight-results.css';
            $select2 = TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/select2/select2.min.css';
            $flightResultsStyleTwo = TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/css/flight-results-style-2.css';
            $bootstrap5 = TRAVELPRO_PLUS_PLUGIN_URL . 'node_modules/bootstrap/dist/css/bootstrap.min.css';
            $fontAwesomeNewVersion = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css";
            $materialIcons = "https://fonts.googleapis.com/icon?family=Material+Icons";
            $lightbox2Css = TRAVELPRO_PLUS_PLUGIN_URL . 'node_modules/lightbox2/dist/css/lightbox.min.css';
            $flatpickCss = "https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css";
            $peopleSelector = TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/css/people-selector.css';

            wp_register_style('travelpro-plus-materialDesignIconic', $materialDesignIconic, array(), '1.0.0');
            wp_register_style('travelpro-plus-fontawesome', $fontAwesome, array(), '1.0.0');
            wp_register_style('travelpro-plus-fontawesome-5', $fontAwesomeNewVersion, array(), '1.1.0');
            wp_register_style('travelpro-plus-select2', $select2, array(), '1.0.0');
            wp_register_style('travelpro-plus-daterangepicker', $datePickerRangeCss, array(), '1.0.0');
            wp_register_style('travelpro-plus-style', $searchFormCss, array(), '1.0.0');
            wp_register_style('travelpro-plus-bootstrapFive', $bootstrap5, array(), '1.0.0');
            // wp_register_style('travelpro-plus-flightresults', $flightResults, array(), '1.0.0');
            wp_register_style('travelpro-plus-flightresultsStyleTwo', $flightResultsStyleTwo, array(), '1.0.0');
            wp_register_style('travelpro-plus-materialIcons', $materialIcons, array(), '1.0.0');
            wp_register_style('travelpro-plus-lightbox2', $lightbox2Css, array(), '1.0.0');
            wp_register_style('travelpro-plus-flatpickr', $flatpickCss, array(), '1.0.0');
            wp_register_style('travelpro-plus-peopleSelector', $peopleSelector, array(), '1.0.0');

            // Enqueue your plugin's styles
            wp_enqueue_style('travelpro-plus-materialDesignIconic');
            wp_enqueue_style('travelpro-plus-fontawesome');
            wp_enqueue_style('travelpro-plus-fontawesome-5');
            wp_enqueue_style('travelpro-plus-select2');
            wp_enqueue_style('travelpro-plus-daterangepicker');
            wp_enqueue_style('travelpro-plus-style');
            wp_enqueue_style('travelpro-plus-bootstrapFive');
            // wp_enqueue_style('travelpro-plus-flightresults');
            wp_enqueue_style('travelpro-plus-flightresultsStyleTwo');
            wp_enqueue_style('travelpro-plus-materialIcons');
            wp_enqueue_style('travelpro-plus-lightbox2');
            wp_enqueue_style('travelpro-plus-flatpickr');
            wp_enqueue_style('travelpro-plus-peopleSelector');
        }
    }
}


function travelproPlusbeforeBodyClosingScripts()
{
    if (is_page() && (has_shortcode(get_the_content(), 'flights_search_form') && has_shortcode(get_the_content(), 'flights_search_results')) || has_shortcode(get_the_content(), 'hotel_search_form') || has_shortcode(get_the_content(), 'hotels_search_redirect_form') || has_shortcode(get_the_content(), 'hotel_detail')) {
    ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/js/flights/location-autocomplete.js'; ?>"> </script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/js/hotels/hotel-autocomplete.js'; ?>"> </script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/js/flights/search-flights.js'; ?>"> </script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/js/hotels/hotel-search.js'; ?>"> </script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/js/flights/flight-card.js'; ?>"> </script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/js/hotels/hotel-cards/hotel-card.js'; ?>"> </script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/js/hotels/hotel-cards/hotel-card-style2.js'; ?>"> </script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/select2/select2.min.js'; ?>"></script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/jquery-validate/jquery.validate.min.js'; ?>"></script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/bootstrap-wizard/bootstrap.min.js'; ?>"></script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/bootstrap-wizard/jquery.bootstrap.wizard.min.js'; ?>"></script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/datepicker/moment.min.js'; ?>"></script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/datepicker/daterangepicker.js'; ?>"></script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/js/global.js'; ?>"></script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/js/date-pickers/flatpick-range.js'; ?>"></script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/js/people-selector.js'; ?>"></script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'node_modules/lightbox2/dist/js/lightbox-plus-jquery.js'; ?>"></script>

        <script>
            $(document).ready(function() {

                // Hide the loader initially
                $(".flight-loader-wrapper").hide();
                $("#flight-load-more-button").hide();
                $('.origin-loader').hide();
                $('.destination-loader').hide();
                $('.travelpro-plus-flight-results-heading').hide();
                $('.travelpro-plus-hotel-results-heading').hide();
                $(".hotel-loader-wrapper").hide();
                $("#hotel-load-more-button").hide();
                $(".hotel-destination-loader").hide();

                let isOneWay = true;
                var stpPk = `<?php echo get_travelpro_options('travelproplus_stripepk'); ?>`;

                // Hide and Show return date on the basis of trip type.
                $('input[type=radio][name=tripType]').change(function() {
                    if (this.value === 'oneWay') {
                        $('.return-date').hide();
                        $('.depart-date').removeClass('col-md-3').addClass('col-md-6');
                        $("input[name='return']").removeAttr('required');
                        isOneWay = true;
                    } else if (this.value === 'roundTrip') {
                        $('.return-date').show();
                        $('.depart-date').removeClass('col-md-6').addClass('col-md-3');
                        $("input[name='return']").prop('required', true);
                        isOneWay = false;
                    }
                });


                // Start Coding Pre Search Location

                const popularDestinations = popularlocations.popularDestinations;
                const isActiveLocations = popularlocations.isActive;

                const dropdown = $("#travelproplus-destination-dropdown");
                const inputField = $("#travelpro-plus-hotel-destination");

                if (isActiveLocations) {
                    // Populate dropdown
                    popularDestinations.forEach((destination) => {
                        dropdown.append(
                            `<div class="travelproplus-dropdown-item"
                            data-dest-id="${destination.dest_id}">
                            ${destination.name}
                        </div>`
                        );
                    });

                    // Position and show dropdown on focus
                    inputField.on("focus", function() {
                        dropdown.css({
                            display: "block",
                            position: "absolute",
                            top: '90px',
                            left: '25px',
                            width: inputField.outerWidth(),
                        });
                    });

                    // Hide dropdown when typing starts
                    inputField.on("input", function() {
                        dropdown.hide(); // Hide the dropdown when user types
                    });

                    // Hide dropdown on blur
                    inputField.on("blur", function() {
                        setTimeout(() => dropdown.hide(), 200); // Delay for click event
                    });

                    // Handle selection
                    $(document).on("click", ".travelproplus-dropdown-item", function() {
                        const selectedDestination = $(this).text().trim();
                        const destId = $(this).data("dest-id");

                        // Set the sanitized value in the input field
                        inputField.val(selectedDestination);
                        inputField.data("id", destId);

                        // Use additional data (optional)
                        // console.log("Selected Location:", selectedDestination);
                        // console.log("Destination ID:", destId);

                        dropdown.hide();
                    });
                }
                // End Coding Pre Search Location


                // Event handler for the hotel search form submission
                $('form[name="hotel-search-form"]').submit(function(event) {
                    event.preventDefault();

                    const hotelDestinationId = $('input[name="hotel-destination"]').data('id');
                    const hotelDestinationName = $('input[name="hotel-destination"]').val();
                    const hotelCheckIn = $('input[name="hotel-check-in"]').val();
                    const hotelCheckOut = $('input[name="hotel-check-out"]').val();
                    let numOfChild = document.getElementById("children").value;

                    if (numOfChild < 1) {
                        numOfChild = "";
                    }

                    let childAges = [];
                    const childAgeSelectors =
                        childAgesContainer.getElementsByClassName("child-age-select");
                    for (let i = 0; i < childAgeSelectors.length; i++) {
                        childAges.push(childAgeSelectors[i].value);
                    }

                    const childernInfo = childAges.join(",");
                    const hotelAdults = $('#numberOfAdultsInHotel').val();

                    if (hotelDestinationId === undefined) {
                        alert('Please enter a valid region, destination and wait for the results to appear. Then, select your region, destination from the list.');
                        return;
                    }
                    if (!hotelCheckIn || !hotelCheckOut) {
                        alert("Please select both check-in and check-Out dates.");
                        return null;
                    }

                    // Scroll to the search result section
                    // $('html, body').animate({
                    //     scrollTop: $("#search-results").offset().top
                    // }, 1000); // Adjust the duration as needed

                    // Perform Hotels search
                    if ($("#search-results").length) {

                        searchHotels(hotelDestinationId, hotelCheckIn, hotelCheckOut, childernInfo, hotelAdults, numOfChild)
                        $('.travelpro-plus-hotel-results-heading').show();
                        console.log([hotelDestinationId, hotelDestinationName, hotelCheckIn, hotelCheckOut, childernInfo, hotelAdults, numOfChild], 'On Submit');

                    } else {
                        alert("Please add a [hotels_search_results] on this page to show the search results otherwise you can't be able to view the hotels data");
                        return null;
                    }
                });

                // Bind the change event to all form fields
                // $('form[name="hotel-redirect-search-form"]').find('input').on('input', function() {
                //     clearURLParams(); // Clear URL parameters whenever a field changes
                //     console.log('cleared');
                // });

                // Event handler for the hotel redirect search form submission
                $('form[name="hotel-redirect-search-form"]').submit(function(event) {
                    event.preventDefault();

                    const form = event.target;
                    const formData = new FormData(form);

                    // Create the query string from form fields
                    const params = new URLSearchParams();

                    const destId = $('input[name="hotel-destination"]').data('id');
                    const hotelDestinationName = $('input[name="hotel-destination"]').val();
                    const hotelCheckIn = $('input[name="hotel-check-in"]').val();
                    const hotelCheckOut = $('input[name="hotel-check-out"]').val();
                    let numOfChild = document.getElementById("children").value;

                    if (numOfChild < 1) {
                        numOfChild = "";
                    }

                    let childAges = [];
                    const childAgeSelectors =
                        childAgesContainer.getElementsByClassName("child-age-select");
                    for (let i = 0; i < childAgeSelectors.length; i++) {
                        childAges.push(childAgeSelectors[i].value);
                    }

                    const childernInfo = childAges.join(",");
                    const hotelAdults = $('#numberOfAdultsInHotel').val();

                    if (destId === undefined) {
                        alert('Please enter a valid region, destination and wait for the results to appear. Then, select your region, destination from the list.');
                        return;
                    }
                    if (!hotelCheckIn || !hotelCheckOut) {
                        alert("Please select both check-in and check-Out dates.");
                        return null;
                    }

                    params.append('dest-id', destId);
                    params.append('destination', hotelDestinationName);
                    params.append('check-in', hotelCheckIn);
                    params.append('check-out', hotelCheckOut);
                    params.append('adult', hotelAdults);
                    params.append('child', numOfChild);
                    params.append('children-ages', childAges);

                    // Redirect to another page with form fields as query parameters
                    window.location.href = 'search-hotels?' + params.toString();

                });

                // Check on Hotel Search page If params are available in the URL
                const urlParams = new URLSearchParams(window.location.search);
                // Check if 'hotel-destination' and 'hotel-destination-id' parameters are available
                if (urlParams.has('dest-id') && urlParams.has('destination') && urlParams.has('check-in') && urlParams.has('check-out') && urlParams.has('adult') && urlParams.has('child') && urlParams.has('children-ages')) {
                    deleteCookie('price');
                    // Retrieve the parameters
                    const destId = urlParams.get('dest-id');
                    const hotelDestinationName = urlParams.get('destination');
                    const hotelCheckIn = urlParams.get('check-in');
                    const hotelCheckOut = urlParams.get('check-out');
                    let numOfChild = urlParams.get('child');
                    const childernInfo = urlParams.get('children-ages');
                    const hotelAdults = urlParams.get('adult');

                    if (numOfChild < 1) {
                        numOfChild = "";
                    }

                    // Set the form values
                    let mainPeopleFeild = `${hotelAdults} Adult(s), ${numOfChild} Child(ren)`;
                    let mainDatesField = `${hotelCheckIn} to ${hotelCheckOut}`;

                    $('#travelpro-plus-hotel-destination').val(hotelDestinationName);
                    $('#flat-start-date').val(hotelCheckIn);
                    $('#flat-end-date').val(hotelCheckOut);
                    $('#numberOfAdultsInHotel').val(hotelAdults);
                    $('#children').val(numOfChild);
                    $('#peopleInput').val(mainPeopleFeild);
                    $('#flat-start-end-date').val(mainDatesField);

                    // Perform Hotels search
                    if ($("#search-results").length) {

                        searchHotels(destId, hotelCheckIn, hotelCheckOut, childernInfo, hotelAdults, numOfChild)
                        $('.travelpro-plus-hotel-results-heading').show();
                        console.log([destId, hotelDestinationName, hotelCheckIn, hotelCheckOut, childernInfo, hotelAdults, numOfChild], 'On Submit');

                    } else {
                        alert("Please add a [hotels_search_results] on this page to show the search results otherwise you can't be able to view the hotels data");
                        return null;
                    }

                } else {
                    console.warn("Required parameters are missing.");
                    // Optionally, you can handle this by showing an error message or redirecting the user
                }


                // Event handler for the flight search form submission
                $('form[name="search-form"]').submit(function(event) {
                    event.preventDefault(); // Prevent the default form submission

                    $('.travelpro-plus-flight-results-heading').show();

                    // Scroll to the search result section
                    $('html, body').animate({
                        scrollTop: $("#search-results").offset().top
                    }, 1000); // Adjust the duration as needed


                    var originEntityId = $('input[name="origin"]').data('id');
                    var destinationEntityId = $('input[name="destination"]').data('id');
                    var adult = parseInt($(".quantity1 input").val());
                    var child = parseInt($(".quantity2 input").val());
                    var infants = parseInt($(".quantity3 input").val());
                    var departureDate = $('input[name="depart"]').val();
                    var returnDate = $('input[name="return"]').val();
                    var cabinClass = $('select[name="cabin"]').val();


                    if (originEntityId === undefined && destinationEntityId === undefined) {
                        alert('Please enter a valid origin, destination and wait for the results to appear. Then, select your origin, destination from the list.');
                        return;
                    } else if (originEntityId === undefined && destinationEntityId != undefined) {
                        alert('Please enter a valid origin and wait for the results to appear. Then, select your origin from the list.');
                        return;
                    } else if (originEntityId != undefined && destinationEntityId === undefined) {
                        alert('Please enter a valid destination and wait for the results to appear. Then, select your destination from the list.');
                        return;
                    }

                    // Perform flight search
                    if ($("#search-results").length) {
                        if (isOneWay) {
                            searchOneWayFlights(originEntityId, destinationEntityId, departureDate, adult, child, infants, cabinClass, isOneWay, stpPk);
                        } else {

                            searchFlights(originEntityId, destinationEntityId, departureDate, returnDate, adult, child, infants, cabinClass, isOneWay, stpPk);
                        }
                    } else {
                        alert("Please add a [flights_search_results] on this page to show the search results otherwise you can't be able to view the flights data");
                        return null;
                    }
                });

            });
        </script>
<?php
    }
}

// Stripe Payments Handling
function travelproPlusStripePaymentHandling()
{
    include TRAVELPRO_PLUS_PLUGIN_PATH . 'includes/payments/stripe-payment.php';
}


// Send PHP variables to JS file
function sendDataToSearchFlightsJs()
{
    wp_enqueue_script('search-flight-js', plugins_url('assets/js/flights/search-flights.js', __FILE__), array('jquery'), null, true);
    $script_params = array(
        'checkoutFileUrl' => TRAVELPRO_PLUS_PLUGIN_URL . 'includes/templates/bookings/checkout.php'
    );
    wp_localize_script('search-flight-js', 'SearchFlightParams', $script_params);
}
add_action('wp_enqueue_scripts', 'sendDataToSearchFlightsJs');

// Send email after user filled the checkout form
function sendEmailNotificationTravelproPlus()
{
    include TRAVELPRO_PLUS_PLUGIN_PATH . 'includes/email/send-booking-confirmation.php';
}


function travelproplusglobal_scripts()
{
    // Register the JavaScript file
    wp_register_script('my-utilities-script', plugins_url('assets/js/utilities.js', __FILE__), array('jquery'), null, true);

    // Enqueue the script only if not already enqueued
    if (!wp_script_is('my-utilities-script', 'enqueued')) {
        wp_enqueue_script('my-utilities-script');
    }

    // Localize the script with data
    $data_to_pass = array(
        'globalMinDurationVal' => get_travelpro_options('travelproplus_min_duration'),
    );
    wp_localize_script('my-utilities-script', 'travelProPlusData', $data_to_pass);
}
add_action('wp_enqueue_scripts', 'travelproplusglobal_scripts');


// Dropdown dynamic data for Pre search Locations
function travelproplusPreSearchLocScripts()
{
    // Register the JavaScript file
    wp_register_script('presearchLocations-script', plugins_url('assets/js/presearchlocations.js', __FILE__), array('jquery'), null, true);

    // Enqueue the script only if not already enqueued
    if (!wp_script_is('presearchLocations-script', 'enqueued')) {
        wp_enqueue_script('presearchLocations-script');
    }

    // Keys
    $key1 = get_travelpro_options('travelproplus_presearch_key_one');
    $key2 = get_travelpro_options('travelproplus_presearch_key_two');
    $key3 = get_travelpro_options('travelproplus_presearch_key_third');
    // Values
    $value1 = get_travelpro_options('travelproplus_presearch_val_one');
    $value2 = get_travelpro_options('travelproplus_presearch_val_two');
    $value3 = get_travelpro_options('travelproplus_presearch_val_third');

    // Dynamic locations data
    $dynamiclocations = array(
        array('name' => $key1, 'dest_id' => $value1),
        array('name' => $key2, 'dest_id' => $value2),
        array('name' => $key3, 'dest_id' => $value3),
    );

    // Localize the script with data
    wp_localize_script('presearchLocations-script', 'popularlocations', array('popularDestinations' => $dynamiclocations, 'isActive' => get_travelpro_options('travelproplus_presearch_onoff')));
}
add_action('wp_enqueue_scripts', 'travelproplusPreSearchLocScripts');
