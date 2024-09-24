function createHotelCard(property) {
  let rating = property.class;
  let totalReviews = property.review_nr;
  let neighborhoodName;
  if (property.neighborhood !== null) {
    neighborhoodName = property.address;
  } else {
    neighborhoodName = "NA";
  }
  // let availableRooms =
  //   property.availability.minRoomsLeft !== null
  //     ? property.availability.minRoomsLeft
  //     : "NA";
  let hotelprice = property.price_breakdown.gross_price;
  // Hotel Card
  const hotelCardCol = document.createElement("div");
  hotelCardCol.classList.add("col");

  const cardContainer = document.createElement("div");
  cardContainer.classList.add("card", "h-100", "hotel-card");

  const hotelImage = document.createElement("img");
  hotelImage.classList.add("hotel-card-img-top");
  hotelImage.src = property.max_photo_url;
  hotelImage.alt = property.hotel_name;

  const cardBody = document.createElement("div");
  cardBody.classList.add("card-body");

  const starRating = document.createElement("p");
  starRating.classList.add("card-text");
  starRating.innerHTML = `${getStarRating(rating)} (${totalReviews} reviews)`;

  const hotelName = document.createElement("h5");
  hotelName.classList.add("card-title");
  hotelName.innerHTML = truncateHotelName(property.hotel_name, 27);

  const hotelLocation = document.createElement("p");
  hotelLocation.classList.add("card-text");
  hotelLocation.innerHTML = `<i class="fas fa-map-marker-alt"></i> ${neighborhoodName}`;

  const hotelRoomsAvailablity = document.createElement("p");
  hotelRoomsAvailablity.classList.add("card-text");
  hotelRoomsAvailablity.innerHTML = `<i class="far fa-calendar-check"></i> Available Rooms: NA`;

  const hotelPrice = document.createElement("p");
  hotelPrice.classList.add("hotel-price");
  hotelPrice.innerHTML = "$" + increasePrice(hotelprice);

  hotelCardCol.appendChild(cardContainer);
  cardContainer.appendChild(hotelImage);
  cardContainer.appendChild(cardBody);
  cardBody.appendChild(starRating);
  cardBody.appendChild(hotelName);
  cardBody.appendChild(hotelLocation);
  // cardBody.appendChild(hotelRoomsAvailablity);
  cardBody.appendChild(hotelPrice);

  return hotelCardCol;
}
