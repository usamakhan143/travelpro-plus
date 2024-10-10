function createHotelCardStyle2(hotelData) {
  // Assuming JSON data is stored in a variable 'hotelData'
  const hotelCard = {
    name: hotelData.hotel_name_trans,
    distance: hotelData.distances[0].text,
    location: hotelData.address,
    city: hotelData.city,
    ribbonText: hotelData.ribbon_text,
    isFreeCancellable: hotelData?.is_free_cancellable,
    roomDetails: hotelData.unit_configuration_label,
    reviewScoreWord: hotelData.review_score_word,
    reviewScore: hotelData.review_score,
    NumOfReview: hotelData.review_nr,
    originalPrice:
      hotelData.composite_price_breakdown.strikethrough_amount?.amount_rounded,
    discountedPrice:
      hotelData.composite_price_breakdown.all_inclusive_amount?.amount_rounded,
    taxesInfo:
      hotelData.composite_price_breakdown.charges_details.translated_copy,
    bookingUrl: hotelData.url,
    featuredImage: hotelData.max_photo_url,
  };

  let urgencyMessage = hotelData?.urgency_message;
  let updatedMessage = "";
  if (urgencyMessage !== undefined) {
    updatedMessage = urgencyMessage.replace("Booking.com", "pepehotels.com");
  }

  let rscword = "";
  if (hotelCard.reviewScoreWord !== null) {
    rscword = `${hotelCard.reviewScoreWord} |`;
  }

  let numberOfReviews = "";
  if (hotelCard.NumOfReview !== null) {
    numberOfReviews = hotelCard.NumOfReview + " reviews";
  }

  let reviewScoreNum = "";
  if (hotelCard.reviewScore !== null) {
    reviewScoreNum = `<span class='review-badge'>${hotelCard.reviewScore}</span>`;
  }

  let originalPrice = "";
  if (hotelCard.originalPrice !== undefined) {
    originalPrice = hotelCard.originalPrice;
  }
  // Hotel Card
  const hotelCardBox = document.createElement("div");
  hotelCardBox.classList.add("card", "p-3", "position-relative");

  // Card Main Row
  const hotelCardInnerBoxRow = document.createElement("div");
  hotelCardInnerBoxRow.classList.add("row");

  // First Column
  const hotelFeaturedImageContainer = document.createElement("div");
  hotelFeaturedImageContainer.classList.add(
    "col-md-3",
    "col-12",
    "position-relative"
  );

  // Hotel Featured Image
  const hotelFeaturedImage = document.createElement("img");
  hotelFeaturedImage.classList.add(
    "img-fluid",
    "rounded",
    "hotel-card-img-top"
  );
  hotelFeaturedImage.src = hotelCard.featuredImage;
  hotelFeaturedImage.alt = "Hotel Image";

  // Appending First Col elements
  hotelFeaturedImageContainer.appendChild(hotelFeaturedImage);

  // Second Column ========================= \\
  const hotelInfoContainer = document.createElement("div");
  hotelInfoContainer.classList.add("col-md-6", "col-12");

  // Hotel Name
  const hotelTitle = document.createElement("h5");
  hotelTitle.classList.add("hotel-title");
  hotelTitle.textContent = hotelCard.name
    ? hotelCard.name
    : "Royal Central Hotel and Resort The Palm";

  const locationSpan = document.createElement("span");
  locationSpan.classList.add("d-block", "mb-1", "text-muted");
  locationSpan.innerHTML = `<i class='bi bi-geo-alt'></i> ${hotelCard.location}, ${hotelCard.city} - ${hotelCard.distance}`;

  // Badges Container
  const badgesContainer = document.createElement("p");
  badgesContainer.innerHTML = `${
    hotelCard.ribbonText !== undefined
      ? `<span class='badge-free'>${hotelCard.ribbonText}</span>`
      : ""
  }`;

  // Hotel Info
  const hotelInfo = document.createElement("div");
  hotelInfo.classList.add("hotel-info");
  hotelInfo.innerHTML = `<b><p>Hotel room info:</p></b> <p class="small-text"><i class='bi bi-check-circle-fill text-success'></i> ${
    hotelCard.roomDetails
  }</p> <p>
  ${
    hotelCard.isFreeCancellable === 1
      ? "<i class='bi bi-check-circle-fill text-success'></i>  Free cancellation"
      : ""
  }
              </p> <p class="availability">
                ${updatedMessage}
              </p>`;

  hotelInfoContainer.appendChild(hotelTitle);
  hotelInfoContainer.appendChild(locationSpan);
  hotelInfoContainer.appendChild(badgesContainer);
  hotelInfoContainer.appendChild(hotelInfo);

  // Third Column, Pricing Section
  const hotelPricingContainer = document.createElement("div");
  hotelPricingContainer.classList.add("col-md-3", "col-12", "text-md-end");
  hotelPricingContainer.innerHTML = reviewScoreNum;

  // const reviewBadgeSpan = document.createElement("span");
  // reviewBadgeSpan.classList.add("review-badge");
  // reviewBadgeSpan.textContent = hotelCard.reviewScore;

  const reviewTextP = document.createElement("p");
  reviewTextP.classList.add("small-text", "mb-1");
  reviewTextP.innerHTML = `${rscword} ${numberOfReviews}`;

  const priceP = document.createElement("p");
  priceP.classList.add("price");
  priceP.innerHTML = originalPrice;

  const currentPrice = document.createElement("p");
  currentPrice.classList.add("price-current");
  currentPrice.textContent = hotelCard.discountedPrice;

  const taxFeesText = document.createElement("p");
  taxFeesText.classList.add("small-text");
  taxFeesText.textContent = hotelCard.taxesInfo;

  const seeAvailablityBtn = document.createElement("a");
  seeAvailablityBtn.classList.add("btn", "btn-primary", "see-availablity");
  seeAvailablityBtn.textContent = "See availability";

  // hotelPricingContainer.appendChild(reviewBadgeSpan);
  hotelPricingContainer.appendChild(reviewTextP);
  hotelPricingContainer.appendChild(priceP);
  hotelPricingContainer.appendChild(currentPrice);
  hotelPricingContainer.appendChild(taxFeesText);
  hotelPricingContainer.appendChild(seeAvailablityBtn);

  // Complete Card
  hotelCardBox.appendChild(hotelCardInnerBoxRow);
  hotelCardInnerBoxRow.appendChild(hotelFeaturedImageContainer);
  hotelCardInnerBoxRow.appendChild(hotelInfoContainer);
  hotelCardInnerBoxRow.appendChild(hotelPricingContainer);

  return hotelCardBox;
}
