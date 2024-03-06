<form name="search-form" method="post">
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

    <input type="submit" value="Search">

    <br /><br /><br /><br /><br /><br />
</form>
<button id="load-more-button">Load More</button>
<br /><br /><br /><br /><br /><br />
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


<script>
    $(document).ready(function() {
        const apiWithEndpoint = 'https://sky-scanner3.p.rapidapi.com/flights/auto-complete?';
        const apiKey = 'aa97ac4b72mshe4ad620e30f1ba2p19ff5ajsn93214a8b8fb3';
        const apiHost = 'sky-scanner3.p.rapidapi.com';
        var debounceTimer; // Variable to hold the debounce timer
        var currentSessionId;

        // Function to make an API request for autocomplete suggestions
        function makeFlightAutocompleteAPIRequest(request, response) {
            var keyword = request.term;
            var maxResults = 10;

            if (keyword.length >= 3) {
                var apiUrl =
                    apiWithEndpoint +
                    "query=" +
                    keyword;

                $.ajax({
                    url: apiUrl,
                    method: "GET",
                    headers: {
                        'X-RapidAPI-Key': apiKey,
                        'X-RapidAPI-Host': apiHost
                    },
                    success: function(data) {

                        // Handle the API response and display results in the autocomplete
                        var autocompleteData = data.data.map(function(item) {
                            return {
                                label: item.presentation.suggestionTitle, // Display city and country
                                value: item.presentation.suggestionTitle, // Value to be placed in the input field
                                id: item.presentation.id // Include entityId in autocomplete data
                            };
                        });

                        // Display autocomplete suggestions
                        response(autocompleteData);
                    },
                    error: function(e) {
                        console.error("Error: ", e.responseJSON.errors);
                    },
                });
            }
        }

        // Autocomplete functionality
        $('#origin, #destination').autocomplete({
            source: function(request, response) {
                // Clear previous debounce timer
                clearTimeout(debounceTimer);

                // Set new debounce timer
                debounceTimer = setTimeout(function() {
                    makeFlightAutocompleteAPIRequest(request, response);
                }, 300); // Adjust the debounce delay as needed
            },
            minLength: 3,
            select: function(event, ui) {
                // Set the selected value to the input field
                $(this).val(ui.item.label);
                // Set the corresponding entityId to the data-entity-id attribute
                $(this).data('id', ui.item.id);
                return false;
            }
        });

        // Function to make a flight search API request
        function searchFlights(originEntityId, destinationEntityId, departureDate, returnDate) {
            var apiUrl = "https://sky-scanner3.p.rapidapi.com/flights/search-roundtrip";
            $.ajax({
                url: apiUrl,
                method: "GET",
                headers: {
                    'X-RapidAPI-Key': apiKey,
                    'X-RapidAPI-Host': apiHost
                },
                data: {
                    fromEntityId: originEntityId,
                    toEntityId: destinationEntityId,
                    departDate: departureDate,
                    returnDate: returnDate
                },
                success: function(data) {
                    // Store the current session ID
                    currentSessionId = data.data.flightsSessionId;
                    if (data.data.context.totalResults === 0 && data.data.context.status === "incomplete") {
                        // Call function to load complete results
                        loadCompleteResults(data.data.context.sessionId);

                    } else {
                        // Process the flight search results as needed
                        console.log("Incomplete Flight search results:", data);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                    // Handle the error gracefully
                }
            });
        }

        // Function to load complete results using session ID
        function loadCompleteResults(sessionId) {
            var apiUrl = 'https://sky-scanner3.p.rapidapi.com/flights/search-incomplete';
            $.ajax({
                url: apiUrl,
                method: "GET",
                headers: {
                    'X-RapidAPI-Key': apiKey,
                    'X-RapidAPI-Host': apiHost
                },
                data: {
                    sessionId: sessionId
                },
                success: function(data) {
                    // Handle the complete results
                    console.log("Complete flight search results:", data);
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                    // Handle the error gracefully
                }
            });
        }

        // Function to process flight search results
        function processData(data) {
            // Handle the API response and display results in the autocomplete
        }

        // Event handler for the search form submission
        $('form[name="search-form"]').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form values
            var originEntityId = $('#origin').data('id');
            var destinationEntityId = $('#destination').data('id');
            var departureDate = $('#departure_date').val();
            var returnDate = $('#return_date').val();

            // Perform flight search
            searchFlights(originEntityId, destinationEntityId, departureDate, returnDate);
        });

        // Event handler for the "Load More" button click
        $('#load-more-button').click(function() {
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