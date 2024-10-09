// Function to make a flight search API request
function searchHotels(
  destId,
  checkInDate,
  checkOutDate,
  childernInfo,
  hotelAdults,
  numOfChild
) {
  var hotelSearchApiUrl = "https://booking-com.p.rapidapi.com/v1/hotels/search";
  $(".hotel-loader-wrapper").show();
  $.ajax({
    url: hotelSearchApiUrl,
    method: "GET",
    headers: {
      "X-RapidAPI-Key": hotelApiKey,
      "X-RapidAPI-Host": hotelApiHost,
    },
    data: cleanParams({
      children_ages: childernInfo,
      page_number: 0,
      adults_number: hotelAdults,
      children_number: numOfChild,
      room_number: 1,
      include_adjacency: true,
      units: "metric",
      categories_filter_ids: "class::2,class::4,free_cancellation::1",
      checkout_date: checkOutDate,
      dest_id: destId,
      filter_by_currency: "USD",
      dest_type: "city",
      checkin_date: checkInDate,
      order_by: "popularity",
      locale: "en-us",
    }),
    success: function (data) {
      console.log("data", data);
      let children =
        "Adult: " +
        hotelAdults +
        " | Children Age: " +
        childernInfo +
        " | Child: " +
        numOfChild;
      processData(data);
      //   if (
      //     data.data.context.status === "incomplete" &&
      //     data.data.context.totalResults === 0
      //   ) {
      //     // Call function to load complete results
      //     loadCompleteResults(currentSessionId, isOneWay);
      //   } else if (
      //     data.data.context.status === "incomplete" &&
      //     data.data.context.totalResults > 0
      //   ) {
      //     // Process the flight search results as needed
      //     $("#hotel-load-more-button").show();
      //     console.log("Incomplete Flight search results:", data);
      //     processDataStyleTwo(data, isOneWay);
      //   }
      $(".hotel-loader-wrapper").hide();
      setCookie("checkInHotel", checkInDate, 1);
      setCookie("checkOutHotel", checkOutDate, 1);
      setCookie("peoples", children, 1);
    },
    error: function (xhr, status, error) {
      console.error("Error:", error);
      $(".hotel-loader-wrapper").hide();
      alert(
        "Please try again! There is something went wrong while searching hotels."
      );
      // Handle the error gracefully
    },
  });
}

// Function to process hotel search results
function processData(data) {
  var searchResultsDiv = document.getElementById("search-results");
  searchResultsDiv.innerHTML = "";

  var hotels = data.result;

  if (hotels.length === 0 || hotels === undefined) {
    searchResultsDiv.innerHTML = "<p>No hotels found.</p>";
    return;
  }

  const HotelContainer = document.createElement("div");
  HotelContainer.classList.add("container-fluid");

  const HotelRow = document.createElement("div");
  HotelRow.classList.add("row", "row-cols-1", "row-cols-md-3", "g-4");

  hotels.forEach(function (property) {
    // Outbound flight card
    let hotelCard = createHotelCard(property);

    HotelRow.appendChild(hotelCard);
    HotelContainer.appendChild(HotelRow);
    searchResultsDiv.appendChild(HotelContainer);

    hotelCard.addEventListener("click", function () {
      let hotelId = property.hotel_id;
      const hotelPrice = increasePrice(property.price_breakdown.gross_price);
      setCookie("price", hotelPrice, 1);
      setCookie("isFlight", false, 1);
      setCookie("hotelName", property.hotel_name, 1);
      const mainDomain = $(location).attr("origin");
      const detailPageSlug = "/hotel-detail";
      let hotelDetailPageUrl = "";
      if (mainDomain === "http://localhost") {
        hotelDetailPageUrl =
          mainDomain + "/wpplugindev" + detailPageSlug + "?hotel-id=" + hotelId;
      } else {
        hotelDetailPageUrl =
          mainDomain + detailPageSlug + "?hotel-id=" + hotelId;
      }

      window.open(hotelDetailPageUrl, "_blank");
    });
  });
}

function processDataStyle2(data) {
  var searchResultsDiv = document.getElementById("search-results");
  searchResultsDiv.innerHTML = "";

  var hotels = data.result;

  if (hotels.length === 0 || hotels === undefined) {
    searchResultsDiv.innerHTML = "<p>No hotels found.</p>";
    return;
  }

  const HotelContainer = document.createElement("div");
  HotelContainer.classList.add("container-fluid");

  hotels.forEach(function (property) {
    // Outbound flight card
    let hotelCard = createHotelCardStyle2(property);

    HotelContainer.appendChild(hotelCard);
    searchResultsDiv.appendChild(HotelContainer);

    hotelCard.addEventListener("click", function () {
      let hotelId = property.hotel_id;
      const hotelPrice = increasePrice(property.price_breakdown.gross_price);
      setCookie("price", hotelPrice, 1);
      setCookie("isFlight", false, 1);
      setCookie("hotelName", property.hotel_name, 1);
      const mainDomain = $(location).attr("origin");
      const detailPageSlug = "/hotel-detail";
      let hotelDetailPageUrl = "";
      if (mainDomain === "http://localhost") {
        hotelDetailPageUrl =
          mainDomain + "/wpplugindev" + detailPageSlug + "?hotel-id=" + hotelId;
      } else {
        hotelDetailPageUrl =
          mainDomain + detailPageSlug + "?hotel-id=" + hotelId;
      }

      window.open(hotelDetailPageUrl, "_blank");
    });
  });
}

// Function to clean the parameters
function cleanParams(params) {
  let cleanedParams = {};
  for (let key in params) {
    if (
      params[key] !== null &&
      params[key] !== "" &&
      params[key] !== undefined
    ) {
      cleanedParams[key] = params[key];
    }
  }
  return cleanedParams;
}
