<style>
    @import url("https://fonts.googleapis.com/css?family=Roboto:100,400");

    html,
    * {
        box-sizing: border-box;
        font-size: 16px;
    }

    body {
        font-family: "Roboto", sans-serif;
    }

    .flight-card {
        width: calc(50% - 20px);
        /* Adjusted width for two cards in a row */
        height: 450px;
        border-radius: 50px;
        overflow: hidden;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        margin: 10px;
        /* Added margin for spacing between cards */
    }

    .main-flight-row {
        margin-bottom: 23px;
        padding: 30px;
        border-radius: 50px;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        align-items: flex-start;
    }

    .flight-card-header {
        height: 180px;
        width: 100%;
        background: linear-gradient(to bottom, #007bff 0%, #0063ff 100%);
        padding: 30px 50px;
        border-bottom: 7px solid #6dbe47;
        position: relative;
    }

    .flight-logo {
        height: 50px;
        width: 100%;

        img {
            width: 32px;
        }
    }

    .flight-data {
        height: auto;
        border-top: 2px solid #3e5177;
        padding-top: 1em;
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        text-align: left;

        span {
            display: block;
        }

        .title {
            color: #000;
            font-size: 16px;
        }

        .detail {
            font-size: 18px;
            padding-top: 3px;
            color: white;
        }
    }

    .flight-card-content {
        width: 100%;
        height: auto;
        display: inline-block;
    }

    .flight-row {
        width: 100%;
        padding: 30px 50px;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
    }

    .plane {
        text-align: center;
        position: relative;

        img {
            width: 90px;
        }

        &:before {
            content: "";
            width: 135px;
            height: 3px;
            background: #efefef;
            position: absolute;
            top: 45px;
            left: -75px;
        }

        &:after {
            content: "";
            width: 135px;
            height: 3px;
            background-color: #efefef;
            position: absolute;
            top: 45px;
            right: -75px;
        }
    }

    .flight-from {
        text-align: left;
        float: left;
    }

    .flight-to {
        text-align: right;
        float: right;
    }

    .flight-from,
    .flight-to {
        span {
            display: block;
        }

        .from-code,
        .to-code {
            font-size: 45px;
            color: #002c5f;
            font-weight: 200;
        }

        .from-city,
        .to-city {
            font-size: 14px;
            color: #002c5f;
            font-weight: 400;
            padding-top: 22px;
        }
    }

    .flight-details-row {
        width: 100%;
        display: grid;
        padding: 10px 50px;
        grid-template-columns: 1fr 1fr 1fr;

        span {
            display: block;
        }

        .title {
            color: #6a8597;
            font-size: 14px;
            letter-spacing: 3px;
        }

        .detail {
            margin-top: 0.2em;
            color: #002c5f;
            font-size: 14px;
        }

        .flight-operator {
            text-align: left;
            float: left;
        }

        .flight-class {
            float: right;
            text-align: right;
        }

        .flight-number {
            padding-left: 50px;
        }
    }

    .book-now-container {
        width: 100%;
        display: flex;
        margin-top: 20px;
        padding: 10px;
        border-radius: 30px;
        background-color: #007bff;
        align-items: center;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),
            0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .book-now-btn {
        padding: 12px 26px;
        background-color: lightblue;
        color: #000;
        border: none;
        border-radius: 20px;
        cursor: pointer;
        text-decoration: none;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 16px;
        font-weight: 600;
    }

    #search-results {
        align-items: center;
        justify-content: center;
    }

    .flight-price {
        font-size: 24px;
        flex: 1;
        color: #fff;
        font-weight: bold;
        font-family: Arial, Helvetica, sans-serif;
    }

    .flight-load-more-container {
        display: flex;
    }

    #flight-load-more-button {
        flex: 1;
        padding: 12px 26px;
        background-color: lightblue;
        color: #000;
        border: none;
        border-radius: 20px;
        cursor: pointer;
        text-decoration: none;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 16px;
        font-weight: 600;
    }


    /* Loader CSS */
    .flight-loader-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.7);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .loader {
        border: 8px solid #f3f3f3;
        border-radius: 50%;
        border-top: 8px solid #3498db;
        width: 60px;
        height: 60px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }




    @media (max-width: 768px) {
        .flight-price {
            flex: 100%;
        }
    }
</style>

<!-- Loader HTML -->
<div class="flight-loader-wrapper">
    <div class="loader"></div>
</div>

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
</form>
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


<script>
    $(document).ready(function() {
        // Hide the loader initially
        $(".flight-loader-wrapper").hide();
        $("#flight-load-more-button").hide();


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
        function searchFlights(originEntityId, destinationEntityId, departureDate, returnDate, adult, child, infants, cabinClass) {
            var apiUrl = "https://sky-scanner3.p.rapidapi.com/flights/search-roundtrip";
            $(".flight-loader-wrapper").show();
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
                    returnDate: returnDate,
                    adult: adult,
                    children: child,
                    infants: infants,
                    cabinClass: cabinClass
                },
                success: function(data) {
                    // Store the current session ID
                    currentSessionId = data.data.context.sessionId;
                    if (data.data.context.status === "incomplete") {
                        // Call function to load complete results
                        $("#flight-load-more-button").show();
                        processData(data);

                    } else if (data.data.context.status === "complete") {
                        // Process the flight search results as needed
                        console.log("complete Flight search results:", data);
                        processData(data);
                    } else {
                        console.log("Else Flight search results:", data);
                        processData(data);
                    }
                    $(".flight-loader-wrapper").hide();
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                    // Handle the error gracefully
                }
            });
        }

        // Function to load complete results using session ID
        function loadCompleteResults(sessionId) {
            $(".flight-loader-wrapper").show();
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
                    processData(data);
                    $(".flight-loader-wrapper").hide();
                    $("#flight-load-more-button").hide();
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                    // Handle the error gracefully
                }
            });
        }

        // Function to process flight search results
        function processData(data) {
            var searchResultsDiv = document.getElementById("search-results");
            searchResultsDiv.innerHTML = ""; // Clear previous search results

            var itineraries = data.data.itineraries;

            if (itineraries.length === 0) {
                searchResultsDiv.innerHTML = "<p>No flights found.</p>";
                return;
            }

            itineraries.forEach(function(itinerary, index) {
                var flightRow = document.createElement("div");
                flightRow.classList.add("main-flight-row");

                // Outbound flight card
                var outboundCard = createFlightCard(itinerary.legs[0]);

                // Return flight card
                var returnCard = createFlightCard(itinerary.legs[1]);

                // Price and book now button
                var priceAndButton = document.createElement("div");
                priceAndButton.classList.add("book-now-container");
                // priceAndButton.style.display = "flex";
                // priceAndButton.style.flexDirection = "column";
                // priceAndButton.style.alignItems = "center";
                var price = document.createElement("div");
                price.classList.add("flight-price");
                price.textContent = itinerary.price.formatted;
                var bookNowButton = document.createElement("button");
                bookNowButton.classList.add("book-now-btn");
                bookNowButton.textContent = "Book Now";
                // Add event listener for booking functionality
                bookNowButton.addEventListener("click", function() {
                    // Add your booking functionality here
                    console.log("Book now button clicked for itinerary:", itinerary.id);
                });
                priceAndButton.appendChild(price);
                priceAndButton.appendChild(bookNowButton);
                flightRow.appendChild(outboundCard);
                flightRow.appendChild(returnCard);
                flightRow.appendChild(priceAndButton);

                searchResultsDiv.appendChild(flightRow);
            });
        }


        // Function to create flight card
        function createFlightCard(leg) {
            // Flight Card
            var flightCard = document.createElement("div");
            flightCard.classList.add("flight-card");

            // Flight Header
            var flightCardHeader = document.createElement("div");
            flightCardHeader.classList.add("flight-card-header");

            // Flight Logo
            var flightLogo = document.createElement("div");
            flightLogo.classList.add("flight-logo");

            // Flight details
            var flightData = document.createElement("div");
            flightData.classList.add("flight-data");

            var flightCardContent = document.createElement("div");
            flightCardContent.classList.add("flight-card-content");

            flightData.innerHTML = `
      <div class="passanger-details">
      <span class="title">Date</span>
      <span class="detail">${new Date(leg.departure).toLocaleDateString()}</span>
      </div>
      <div class="passanger-depart">
            <span class="title">Depart</span>
            <span class="detail">${new Date(leg.departure).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span>
        </div>
        
        <div class="passanger-arrives">
              <span class="title">Arrives</span>
              <span class="detail">${new Date(leg.arrival).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span>
            </div>
    `;

            flightCardContent.innerHTML = `
    <div class="flight-row">
            <div class="flight-from">
              <span class="from-code">${leg.origin.displayCode}</span>
              <span class="from-city">${leg.origin.city},${leg.origin.country}</span>
            </div>
            <div class="plane">
              <img
                src="https://cdn.onlinewebfonts.com/svg/img_537856.svg"
                alt="Plane"
              />
            </div>
            <div class="flight-to">
              <span class="to-code">${leg.destination.displayCode}</span>
              <span class="to-city">${leg.destination.city}, ${leg.destination.country}</span>
            </div>
          </div>
          <div class="flight-details-row">
            <div class="flight-operator">
              <span class="title">OPERATOR</span>
              <span class="detail">${leg.carriers.marketing[0].name}</span>
            </div>
            <div class="flight-number">
              <span class="title">FLIGHT #</span>
              <span class="detail">${leg.segments[0].flightNumber}</span>
            </div>
            <div class="flight-class">
              <span class="title">Duration</span>
              <span class="detail">${leg.durationInMinutes}</span>
            </div>
          </div>
    `;


            // Airline logo
            var airlineLogo = document.createElement("img");
            airlineLogo.src = leg.carriers.marketing[0].logoUrl;
            airlineLogo.alt = leg.carriers.marketing[0].name;
            flightLogo.appendChild(airlineLogo);

            flightCardHeader.appendChild(flightLogo);
            flightCardHeader.appendChild(flightData);
            flightCard.appendChild(flightCardHeader);
            flightCard.appendChild(flightCardContent);

            return flightCard;
        }


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