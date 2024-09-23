const regionApiWithEndpoint =
  "https://hotels-com-provider.p.rapidapi.com/v2/regions?";
const hotelApiKey = "287af7df0fmshe1c40367b310b6ap1d4bdcjsne5ebfd994b06";
const hotelApiHost = "hotels-com-provider.p.rapidapi.com";
var hotelDebounceTimer; // Variable to hold the debounce timer

// Function to make an API request for autocomplete suggestions
function makeHotelRegionAutocompleteAPIRequest(request, response, fieldId) {
  var hotelDesKeyword = request.term;

  fieldId === "travelpro-plus-hotel-destination"
    ? $(".hotel-destination-loader").show()
    : null;

  if (hotelDesKeyword.length >= 3) {
    var regionApiUrl = regionApiWithEndpoint + "query=" + hotelDesKeyword;

    $.ajax({
      url: regionApiUrl,
      method: "GET",
      headers: {
        "x-rapidapi-key": hotelApiKey,
        "x-rapidapi-host": hotelApiHost,
      },
      data: {
        domain: "US",
        locale: "en_US",
      },
      success: function (data) {
        // Handle the API response and display results in the autocomplete
        var autocompleteData = data.data.map(function (item) {
          var dataItem = item.regionNames.displayName;
          if (dataItem.includes(" (Any)")) {
            dataItem = dataItem.replace(" (Any)", "");
          }

          return {
            label: dataItem, // Display city and country
            value: dataItem, // Value to be placed in the input field
            id: item.essId.sourceId, // Include entityId in autocomplete data
          };
        });
        // Display autocomplete suggestions
        response(autocompleteData);

        $(".hotel-destination-loader").hide();
      },
      error: function (e) {
        console.error("Error: ", e.responseJSON.errors);
        $(`#${fieldId}`).addClass("error-field");
        alert("Please re-type the City or Hotel");
        $(`#${fieldId}`).removeClass("error-field");
        $(".hotel-destination-loader").hide();
      },
    });
  }
}

// Autocomplete functionality
$("#travelpro-plus-hotel-destination").autocomplete({
  source: function (request, response) {
    // Clear previous debounce timer
    var inputId = $(this.element[0]).attr("id");
    clearTimeout(hotelDebounceTimer);
    // Set new debounce timer
    hotelDebounceTimer = setTimeout(function () {
      makeHotelRegionAutocompleteAPIRequest(request, response, inputId);
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
