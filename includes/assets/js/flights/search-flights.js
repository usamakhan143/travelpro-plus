// Function to make a flight search API request
function searchFlights(
  originEntityId,
  destinationEntityId,
  departureDate,
  returnDate,
  adult,
  child,
  infants,
  cabinClass
) {
  var apiUrl = "https://sky-scanner3.p.rapidapi.com/flights/search-roundtrip";
  $(".flight-loader-wrapper").show();
  $.ajax({
    url: apiUrl,
    method: "GET",
    headers: {
      "X-RapidAPI-Key": apiKey,
      "X-RapidAPI-Host": apiHost,
    },
    data: {
      fromEntityId: originEntityId,
      toEntityId: destinationEntityId,
      departDate: departureDate,
      returnDate: returnDate,
      adult: adult,
      children: child,
      infants: infants,
      cabinClass: cabinClass,
    },
    success: function (data) {
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
    error: function (xhr, status, error) {
      console.error("Error:", error);
      // Handle the error gracefully
    },
  });
}

// Function to load complete results using session ID
function loadCompleteResults(sessionId) {
  $(".flight-loader-wrapper").show();
  var apiUrl = "https://sky-scanner3.p.rapidapi.com/flights/search-incomplete";
  $.ajax({
    url: apiUrl,
    method: "GET",
    headers: {
      "X-RapidAPI-Key": apiKey,
      "X-RapidAPI-Host": apiHost,
    },
    data: {
      sessionId: sessionId,
    },
    success: function (data) {
      // Handle the complete results
      console.log("Complete flight search results:", data);
      processData(data);
      $(".flight-loader-wrapper").hide();
      $("#flight-load-more-button").hide();
    },
    error: function (xhr, status, error) {
      console.error("Error:", error);
      // Handle the error gracefully
    },
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

  itineraries.forEach(function (itinerary, index) {
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
    bookNowButton.addEventListener("click", function () {
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
