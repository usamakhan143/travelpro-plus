<form name="search-form" method="post">
    <label for="origin">Origin:</label><br>
    <input type="text" id="origin" name="origin"><br>
    <div id="loader" style="display:none;">Loading...</div>
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
    const apiWithEndpoint = 'https://sky-scanner3.p.rapidapi.com/flights/auto-complete?';
    const apiKey = 'c9bcc0fae2msh319fae4f97b55fep19ad9djsn9e1c0abf8b60';
    const apiHost = 'sky-scanner3.p.rapidapi.com';

    $(document).ready(function() {

        // Function to make an API request with the current access token
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
                        if (data.errors) {
                            // Handle API errors
                            console.log("Error", data);
                            return;
                        }

                        console.log(data.data);
                        // Handle the API response and display results in the autocomplete
                        var autocompleteData = data.data.map(function(item) {
                            return {
                                label: item.presentation.suggestionTitle, // Display city and country
                                value: item.presentation.suggestionTitle, // Value to be placed in the input field
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

        var id_attr = '<?php echo $ids_separated ?>';
        // Autocomplete functionality
        $(id_attr).autocomplete({
            source: makeFlightAutocompleteAPIRequest,
            minLength: 3,
        });

    });
</script>