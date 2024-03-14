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
        processDataStyleTwo(data);
      } else if (data.data.context.status === "complete") {
        // Process the flight search results as needed
        console.log("complete Flight search results:", data);
        processDataStyleTwo(data);
      } else {
        console.log("Else Flight search results:", data);
        processDataStyleTwo(data);
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
      processDataStyleTwo(data);
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
  searchResultsDiv.innerHTML = "";

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

    // searchResultsDiv.append(mainHeading);
    searchResultsDiv.appendChild(flightRow);
  });
}

function processDataStyleTwo(data) {
  var searchResultsDiv = document.getElementById("search-results");
  searchResultsDiv.innerHTML = "";

  var itineraries = data.data.itineraries;

  if (itineraries.length === 0) {
    searchResultsDiv.innerHTML = "<p>No flights found.</p>";
    return;
  }

  itineraries.forEach(function (itinerary, index) {
    // It is a parent
    var mainFlightCardView = document.createElement("div");
    mainFlightCardView.classList.add("main-flight-card-view");

    // Parent is .main-flight-card-view
    var mainRow = document.createElement("div");
    mainRow.classList.add("row");

    // Outbound flight card
    var outboundCard = flightCardStyleTwo(itinerary.legs[0]);

    // Return flight card
    var returnCard = flightCardStyleTwo(itinerary.legs[1]);

    // Parent is .row = mainRow
    var columnOfEight = document.createElement("div");
    columnOfEight.classList.add("col-md-9");

    // Divider <hr />
    var divider = document.createElement("hr");

    // Parent is .row = mainRow
    var columnOfFour = document.createElement("div");
    columnOfFour.classList.add("col-md-3", "travelpro-plus-select-border");

    // Price and book now button div
    var priceAndButton = document.createElement("div");

    // Price Span
    var price = document.createElement("span");
    price.classList.add("travelpro-leginfo-pricing");
    price.textContent = itinerary.price.formatted;

    var lastRowForPricingAndOperator = document.createElement("div");
    lastRowForPricingAndOperator.classList.add("row");
    lastRowForPricingAndOperator.innerHTML = `
    <div class="col">
      <div class="travelpro-plus-card-footer">
        <span class="travelpro-plus-operator-name">${new Date(
          itinerary.legs[0].departure
        ).toLocaleDateString()}</span>
        <span class="travelpro-plus-footer-pricing">${price.textContent}</span>
      </div>
    </div>`;

    // Book now button created
    var bookNowButton = document.createElement("button");
    bookNowButton.classList.add("btn", "btn-success");
    bookNowButton.textContent = "Select ➜";

    bookNowButton.setAttribute("type", "button");
    bookNowButton.setAttribute("data-bs-toggle", "modal");
    bookNowButton.setAttribute("data-bs-target", "#staticBackdrop");
    // Add event listener for booking functionality
    bookNowButton.addEventListener("click", function () {
      // Add your booking functionality here
      console.log("Book now button clicked for itinerary:", itinerary.id);
    });

    priceAndButton.appendChild(price);
    priceAndButton.appendChild(bookNowButton);

    columnOfEight.appendChild(outboundCard); // Row 1
    columnOfEight.appendChild(returnCard); // Row 2
    columnOfEight.appendChild(divider); // Divider
    columnOfEight.appendChild(lastRowForPricingAndOperator); // Row 3
    columnOfFour.appendChild(priceAndButton); // col-md-4 (price, button)
    mainRow.appendChild(columnOfEight); // mainRow is parent of columnOfEight which is first div
    mainRow.appendChild(columnOfFour); // mainRow is parent of columnOfFour which is second div
    mainFlightCardView.appendChild(mainRow); // mainFlightCardView is parent of mainRow

    // searchResultsDiv.append(mainHeading);
    searchResultsDiv.appendChild(mainFlightCardView);
  });
}

// Event handler for the "Load More" button click
$("#flight-load-more-button").click(function () {
  // Check if currentSessionId is defined
  if (currentSessionId) {
    // Call the function to load more flights with the current session ID
    loadCompleteResults(currentSessionId);
  } else {
    console.error("Error: Current session ID is undefined");
  }
});
