// Hide the loader initially
$(".flight-loader-wrapper").hide();
$("#flight-load-more-button").hide();

const apiWithEndpoint =
  "https://sky-scanner3.p.rapidapi.com/flights/auto-complete?";
const apiKey = "aa97ac4b72mshe4ad620e30f1ba2p19ff5ajsn93214a8b8fb3";
const apiHost = "sky-scanner3.p.rapidapi.com";
var debounceTimer; // Variable to hold the debounce timer
var currentSessionId;

// Function to make an API request for autocomplete suggestions
function makeFlightAutocompleteAPIRequest(request, response) {
  var keyword = request.term;

  if (keyword.length >= 3) {
    var apiUrl = apiWithEndpoint + "query=" + keyword;

    $.ajax({
      url: apiUrl,
      method: "GET",
      headers: {
        "X-RapidAPI-Key": apiKey,
        "X-RapidAPI-Host": apiHost,
      },
      success: function (data) {
        // Handle the API response and display results in the autocomplete
        var autocompleteData = data.data.map(function (item) {
          return {
            label: item.presentation.suggestionTitle, // Display city and country
            value: item.presentation.suggestionTitle, // Value to be placed in the input field
            id: item.presentation.id, // Include entityId in autocomplete data
          };
        });

        // Display autocomplete suggestions
        response(autocompleteData);
      },
      error: function (e) {
        console.error("Error: ", e.responseJSON.errors);
      },
    });
  }
}

// Autocomplete functionality
$("#origin, #destination").autocomplete({
  source: function (request, response) {
    // Clear previous debounce timer
    clearTimeout(debounceTimer);

    // Set new debounce timer
    debounceTimer = setTimeout(function () {
      makeFlightAutocompleteAPIRequest(request, response);
    }, 300); // Adjust the debounce delay as needed
  },
  minLength: 3,
  select: function (event, ui) {
    // Set the selected value to the input field
    $(this).val(ui.item.label);
    // Set the corresponding entityId to the data-entity-id attribute
    $(this).data("id", ui.item.id);
    return false;
  },
});
