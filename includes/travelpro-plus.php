<?php

add_shortcode('flights_search', 'show_flight_search_form');
add_action('wp_head', 'runJqueryTravelproPlus');
function show_flight_search_form()
{
    include TRAVELPRO_PLUS_PLUGIN_PATH . '/includes/templates/flight-search.php';
}

function runJqueryTravelproPlus()
{
?>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
    <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'node_modules/jquery/dist/jquery.min.js'; ?>"> </script>
    <script src="<?php echo TRAVELPRO_PLUS_PLUGIN_URL . 'node_modules/jquery-ui/dist/jquery-ui.min.js'; ?>"></script>
<?php
}
