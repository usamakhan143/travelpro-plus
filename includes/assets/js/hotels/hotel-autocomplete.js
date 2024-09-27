const regionApiWithEndpoint =
  "https://booking-com.p.rapidapi.com/v1/hotels/locations?";
const hotelApiKey = "287af7df0fmshe1c40367b310b6ap1d4bdcjsne5ebfd994b06";
const hotelApiHost = "booking-com.p.rapidapi.com";
var hotelDebounceTimer; // Variable to hold the debounce timer

// Function to make an API request for autocomplete suggestions
function makeHotelRegionAutocompleteAPIRequest(request, response, fieldId) {
  var hotelDesKeyword = request.term;

  fieldId === "travelpro-plus-hotel-destination"
    ? $(".hotel-destination-loader").show()
    : null;

  if (hotelDesKeyword.length >= 3) {
    var regionApiUrl = regionApiWithEndpoint + "name=" + hotelDesKeyword;

    $.ajax({
      url: regionApiUrl,
      method: "GET",
      headers: {
        "x-rapidapi-key": hotelApiKey,
        "x-rapidapi-host": hotelApiHost,
      },
      data: {
        locale: "en-us",
      },
      success: function (data) {
        // Create a Set to track unique destination names
        var uniqueDestinations = new Set();

        // Filter and map the data to remove duplicates and invalid entries
        var autocompleteData = data
          .filter(function (item) {
            // Check if item has valid 'name', 'dest_id', and is of type 'city'
            return item.name && item.dest_id && item.dest_type === "city";
          })
          .filter(function (item) {
            // Check if the 'name' has already been processed (to avoid duplicates)
            if (!uniqueDestinations.has(item.name)) {
              uniqueDestinations.add(item.name); // Add to the set if unique
              return true; // Include the item in the result
            }
            return false; // Exclude duplicates
          })
          .map(function (item) {
            // Return the required data structure
            return {
              label: item.name, // Display city and country
              value: item.name, // Value to be placed in the input field
              id: item.dest_id, // Include entityId in autocomplete data
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
