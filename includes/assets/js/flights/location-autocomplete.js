const apiWithEndpoint =
  "https://priceline-com-provider.p.rapidapi.com/v2/flight/autoComplete?";
const apiKey = "aa97ac4b72mshe4ad620e30f1ba2p19ff5ajsn93214a8b8fb3";
const apiHost = "priceline-com-provider.p.rapidapi.com";
var debounceTimer; // Variable to hold the debounce timer
var currentSessionId;

// Function to make an API request for autocomplete suggestions
function makeFlightAutocompleteAPIRequest(request, response, fieldId) {
  var keyword = request.term;

  fieldId === "travelpro-plus-flight-origin"
    ? $(".origin-loader").show()
    : null;

  fieldId === "travelpro-plus-flight-destination"
    ? $(".destination-loader").show()
    : null;

  if (keyword.length >= 3) {
    var apiUrl = apiWithEndpoint + "string=" + keyword;

    $.ajax({
      url: apiUrl,
      method: "GET",
      data: {
        airports: true,
        pois: false,
        cities: false,
        hotels: false,
        regions: false,
      },
      headers: {
        "X-RapidAPI-Key": apiKey,
        "X-RapidAPI-Host": apiHost,
      },
      success: function (data) {
        let airports =
          data.getAirAutoComplete.results.getSolr.results.data.airport_data;
        // Handle the API response and display results in the autocomplete

        var autocompleteData = Object.keys(airports).map(function (item) {
          var dataItem =
            airports[item].airport + " " + "(" + airports[item].iata + ")";
          // if (dataItem.includes(" (Any)")) {
          //   dataItem = dataItem.replace(" (Any)", "");
          // }

          return {
            label: dataItem, // Display city and country
            value: dataItem, // Value to be placed in the input field
            id: airports[item].iata, // Include entityId in autocomplete data
          };
        });
        // Display autocomplete suggestions
        response(autocompleteData);

        $(".origin-loader").hide();
        $(".destination-loader").hide();
      },
      error: function (e) {
        console.error("Error: ", e.responseJSON.errors);
        $(`#${fieldId}`).addClass("error-field");
        alert("Please re-type the City or Airport");
        $(`#${fieldId}`).removeClass("error-field");
        $(".origin-loader").hide();
        $(".destination-loader").hide();
      },
    });
  }
}

// Autocomplete functionality
$(
  "#travelpro-plus-flight-origin, #travelpro-plus-flight-destination"
).autocomplete({
  source: function (request, response) {
    // Clear previous debounce timer
    var inputId = $(this.element[0]).attr("id");
    clearTimeout(debounceTimer);
    // Set new debounce timer
    debounceTimer = setTimeout(function () {
      makeFlightAutocompleteAPIRequest(request, response, inputId);
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
