function createHotelCard(property) {
  let rating = property.star;
  let totalReviews = property.reviews.total;
  let neighborhoodName;
  if (property.neighborhood !== null) {
    neighborhoodName = property.neighborhood.name;
  } else {
    neighborhoodName = "NA";
  }
  let availableRooms =
    property.availability.minRoomsLeft !== null
      ? property.availability.minRoomsLeft
      : "NA";
  let hotelprice = property.price.lead.formatted;
  // Hotel Card
  const hotelCardCol = document.createElement("div");
  hotelCardCol.classList.add("col");

  const cardContainer = document.createElement("div");
  cardContainer.classList.add("card", "h-100");

  const hotelImage = document.createElement("img");
  hotelImage.classList.add("hotel-card-img-top");
  hotelImage.src = property.propertyImage.image.url;
  hotelImage.alt = property.propertyImage.image.description;

  const cardBody = document.createElement("div");
  cardBody.classList.add("card-body");

  const starRating = document.createElement("p");
  starRating.classList.add("card-text");
  starRating.innerHTML = `${getStarRating(rating)} (${totalReviews} reviews)`;

  const hotelName = document.createElement("h5");
  hotelName.classList.add("card-title");
  hotelName.innerHTML = property.name;

  const hotelLocation = document.createElement("p");
  hotelLocation.classList.add("card-text");
  hotelLocation.innerHTML = `<i class="fas fa-map-marker-alt"></i> ${neighborhoodName}`;

  const hotelRoomsAvailablity = document.createElement("p");
  hotelRoomsAvailablity.classList.add("card-text");
  hotelRoomsAvailablity.innerHTML = `<i class="far fa-calendar-check"></i> Available Rooms: ${availableRooms}`;

  const hotelPrice = document.createElement("p");
  hotelPrice.classList.add("hotel-price");
  hotelPrice.innerHTML = hotelprice;

  hotelCardCol.appendChild(cardContainer);
  cardContainer.appendChild(hotelImage);
  cardContainer.appendChild(cardBody);
  cardBody.appendChild(starRating);
  cardBody.appendChild(hotelName);
  cardBody.appendChild(hotelLocation);
  cardBody.appendChild(hotelRoomsAvailablity);
  cardBody.appendChild(hotelPrice);

  return hotelCardCol;
}
