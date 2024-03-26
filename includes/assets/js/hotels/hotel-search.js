// Function to make a flight search API request
function searchHotels(regionId, checkInDate, checkOutDate) {
  var hotelSearchApiUrl =
    "https://hotels-com-provider.p.rapidapi.com/v2/hotels/search";
  $(".hotel-loader-wrapper").show();
  $.ajax({
    url: hotelSearchApiUrl,
    method: "GET",
    headers: {
      "X-RapidAPI-Key": hotelApiKey,
      "X-RapidAPI-Host": hotelApiHost,
    },
    data: {
      checkin_date: checkInDate,
      checkout_date: checkOutDate,
      region_id: regionId,
      locale: "en_US",
      sort_order: "REVIEW",
      adults_number: "1",
      domain: "US",
      lodging_type: "HOTEL,APART_HOTEL",
      star_rating_ids: "3,4,5",
      meal_plan: "ALL_INCLUSIVE,FULL_BOARD,HALF_BOARD,FREE_BREAKFAST",
      payment_type: "PAY_LATER,FREE_CANCELLATION",
      available_filter: "SHOW_AVAILABLE_ONLY",
    },
    success: function (data) {
      console.log("data", data);
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
