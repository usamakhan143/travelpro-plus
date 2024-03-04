<?php

add_shortcode('flights_search', 'show_flight_search_form');
function show_flight_search_form()
{
    include TRAVELPRO_PLUS_PLUGIN_PATH . '/includes/templates/flight-search.php';
}