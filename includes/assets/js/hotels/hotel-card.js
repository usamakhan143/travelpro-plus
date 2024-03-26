function createHotelCard(property) {
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

  const hotelName = document.createElement("h5");
  hotelName.classList.add("card-title");
  hotelName.innerHTML = property.name;

  const hotelParagraph = document.createElement("p");
  hotelParagraph.classList.add("card-text");
  hotelParagraph.innerHTML = `${property.star} Star Hotel`;

  hotelCardCol.appendChild(cardContainer);
  cardContainer.appendChild(hotelImage);
  cardContainer.appendChild(cardBody);
  cardBody.appendChild(hotelName);
  cardBody.appendChild(hotelParagraph);

  return hotelCardCol;
}
