<?php

add_shortcode('flights_search_form', 'show_flight_search_form');
add_shortcode('flights_search_results', 'showFlightSearchResults');
add_shortcode('hotel_search_form', 'show_hotel_search_form');
add_shortcode('hotels_search_results', 'showHotelSearchResults');
add_action('wp_head', 'runJqueryTravelproPlus');
add_action('wp_enqueue_scripts', 'enqueue_travelproplus_styles', 100);
add_action('wp_footer', 'travelproPlusbeforeBodyClosingScripts', 9999);

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

function runJqueryTravelproPlus()
{
?>
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet" />
    <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'node_modules/jquery/dist/jquery.min.js'; ?>"> </script>
    <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'node_modules/jquery-ui/dist/jquery-ui.min.js'; ?>"></script>
    <?php
}

function enqueue_travelproplus_styles()
{
    // Check if the current page or post contains your plugin's shortcode
    if (is_page() || is_single()) {
        if ((has_shortcode(get_the_content(), 'flights_search_form') && has_shortcode(get_the_content(), 'flights_search_results')) || has_shortcode(get_the_content(), 'hotel_search_form')) {

            // Register your plugin's styles
            $fontAwesome = TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/font-awesome-4.7/css/font-awesome.min.css';
            $materialDesignIconic = TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/mdi-font/css/material-design-iconic-font.min.css';
            $searchFormCss = TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/css/flight-search-form.css';
            $datePickerRangeCss = TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/datepicker/daterangepicker.css';
            $flightResults = TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/css/flight-results.css';
            $select2 = TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/select2/select2.min.css';
            $flightResultsStyleTwo = TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/css/flight-results-style-2.css';
            $bootstrap5 = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css";
            $fontAwesomeNewVersion = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css";

            wp_register_style('travelpro-plus-materialDesignIconic', $materialDesignIconic, array(), '1.0.0');
            wp_register_style('travelpro-plus-fontawesome', $fontAwesome, array(), '1.0.0');
            wp_register_style('travelpro-plus-fontawesome-5', $fontAwesomeNewVersion, array(), '1.1.0');
            wp_register_style('travelpro-plus-select2', $select2, array(), '1.0.0');
            wp_register_style('travelpro-plus-daterangepicker', $datePickerRangeCss, array(), '1.0.0');
            wp_register_style('travelpro-plus-style', $searchFormCss, array(), '1.0.0');
            wp_register_style('travelpro-plus-bootstrapFive', $bootstrap5, array(), '1.0.0');
            wp_register_style('travelpro-plus-flightresults', $flightResults, array(), '1.0.0');
            wp_register_style('travelpro-plus-flightresultsStyleTwo', $flightResultsStyleTwo, array(), '1.0.0');

            // Enqueue your plugin's styles
            wp_enqueue_style('travelpro-plus-materialDesignIconic');
            wp_enqueue_style('travelpro-plus-fontawesome');
            wp_enqueue_style('travelpro-plus-fontawesome-5');
            wp_enqueue_style('travelpro-plus-select2');
            wp_enqueue_style('travelpro-plus-daterangepicker');
            wp_enqueue_style('travelpro-plus-style');
            wp_enqueue_style('travelpro-plus-bootstrapFive');
            wp_enqueue_style('travelpro-plus-flightresults');
            wp_enqueue_style('travelpro-plus-flightresultsStyleTwo');
        }
    }
}


function travelproPlusbeforeBodyClosingScripts()
{
    if (is_page() && (has_shortcode(get_the_content(), 'flights_search_form') && has_shortcode(get_the_content(), 'flights_search_results')) || has_shortcode(get_the_content(), 'hotel_search_form')) {
    ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/js/flights/location-autocomplete.js'; ?>"> </script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/js/hotels/hotel-autocomplete.js'; ?>"> </script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/js/utilities.js'; ?>"></script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/js/flights/search-flights.js'; ?>"> </script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/js/hotels/hotel-search.js'; ?>"> </script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/js/flights/flight-card.js'; ?>"> </script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/js/hotels/hotel-card.js'; ?>"> </script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/select2/select2.min.js'; ?>"></script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/jquery-validate/jquery.validate.min.js'; ?>"></script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/bootstrap-wizard/bootstrap.min.js'; ?>"></script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/bootstrap-wizard/jquery.bootstrap.wizard.min.js'; ?>"></script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/datepicker/moment.min.js'; ?>"></script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/datepicker/daterangepicker.js'; ?>"></script>
        <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/js/global.js'; ?>"></script>

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

                // Event handler for the hotel search form submission
                $('form[name="hotel-search-form"]').submit(function(event) {
                    event.preventDefault();

                    $('.travelpro-plus-hotel-results-heading').show();

                    const hotelDestinationId = $('input[name="hotel-destination"]').data('id');
                    const hotelDestinationName = $('input[name="hotel-destination"]').val();
                    const hotelCheckIn = $('input[name="hotel-check-in"]').val();
                    const hotelCheckOut = $('input[name="hotel-check-out"]').val();
                    const childernInfo = $('input[name="numberOfChildren"]').val();
                    const hotelAdults = $('input[name="numberOfAdultsInHotel"]').val();

                    // Scroll to the search result section
                    $('html, body').animate({
                        scrollTop: $("#search-results").offset().top
                    }, 1000); // Adjust the duration as needed

                    if (hotelDestinationId === undefined) {
                        alert('Please enter a valid region, destination and wait for the results to appear. Then, select your region, destination from the list.');
                        return;
                    }

                    // Perform Hotels search
                    if ($("#search-results").length) {

                        searchHotels(hotelDestinationId, hotelCheckIn, hotelCheckOut, childernInfo, hotelAdults)
                        console.log([hotelDestinationId, hotelDestinationName, hotelCheckIn, hotelCheckOut, childernInfo, hotelAdults], 'On Submit');

                    } else {
                        alert("Please add a [hotels_search_results] on this page to show the search results otherwise you can't be able to view the hotels data");
                        return null;
                    }
                });

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
                            searchOneWayFlights(originEntityId, destinationEntityId, departureDate, adult, child, infants, cabinClass, isOneWay);
                        } else {

                            searchFlights(originEntityId, destinationEntityId, departureDate, returnDate, adult, child, infants, cabinClass, isOneWay);
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
