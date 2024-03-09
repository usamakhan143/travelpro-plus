<?php

add_shortcode('flights_search_form', 'show_flight_search_form');
add_shortcode('flights_search_results', 'showFlightSearchResults');
add_action('wp_head', 'runJqueryTravelproPlus');
add_action('wp_enqueue_scripts', 'enqueue_travelproplus_styles', 100);


function show_flight_search_form()
{
    include TRAVELPRO_PLUS_PLUGIN_PATH . '/includes/templates/flights/flight-search.php';
}

function showFlightSearchResults()
{
    include TRAVELPRO_PLUS_PLUGIN_PATH . '/includes/templates/flights/flight-search-results.php';
}

function runJqueryTravelproPlus()
{
?>
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
    <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'node_modules/jquery/dist/jquery.min.js'; ?>"> </script>
    <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'node_modules/jquery-ui/dist/jquery-ui.min.js'; ?>"></script>
<?php
}

function enqueue_travelproplus_styles()
{


    // Check if the current page or post contains your plugin's shortcode
    if (is_page() || is_single()) {
        if (stripos(get_the_content(), '[flights_search_form]') !== false) {

            // Register your plugin's styles
            $fontAwesome = TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/font-awesome-4.7/css/font-awesome.min.css';
            $materialDesignIconic = TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/mdi-font/css/material-design-iconic-font.min.css';
            $searchFormCss = TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/css/flight-search-form.css';
            $datePickerRangeCss = TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/datepicker/daterangepicker.css';
            $flightResults = TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/css/flight-results.css';
            $select2 = TRAVELPRO_PLUS_PLUGIN_URL . 'includes/assets/vendor/select2/select2.min.css';

            wp_register_style('travelpro-plus-materialDesignIconic', $materialDesignIconic, array(), '1.0.0');
            wp_register_style('travelpro-plus-fontawesome', $fontAwesome, array(), '1.0.0');
            wp_register_style('travelpro-plus-select2', $select2, array(), '1.0.0');
            wp_register_style('travelpro-plus-daterangepicker', $datePickerRangeCss, array(), '1.0.0');
            wp_register_style('travelpro-plus-style', $searchFormCss, array(), '1.0.0');
            wp_register_style('travelpro-plus-flightresults', $flightResults, array(), '1.0.0');

            // Enqueue your plugin's styles
            wp_enqueue_style('travelpro-plus-materialDesignIconic');
            wp_enqueue_style('travelpro-plus-fontawesome');
            wp_enqueue_style('travelpro-plus-select2');
            wp_enqueue_style('travelpro-plus-daterangepicker');
            wp_enqueue_style('travelpro-plus-style');
            wp_enqueue_style('travelpro-plus-flightresults');
        }
    }
}
