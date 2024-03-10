// Function to create flight card
function createFlightCard(leg) {
  // Flight Card
  var flightCard = document.createElement("div");
  flightCard.classList.add("flight-card");

  // Flight Header
  var flightCardHeader = document.createElement("div");
  flightCardHeader.classList.add("flight-card-header");

  // Flight Logo
  var flightLogo = document.createElement("div");
  flightLogo.classList.add("flight-logo");

  // Flight details
  var flightData = document.createElement("div");
  flightData.classList.add("flight-data");

  var flightCardContent = document.createElement("div");
  flightCardContent.classList.add("flight-card-content");

  flightData.innerHTML = `
  <div class="passanger-details">
  <span class="title">Date</span>
  <span class="detail">${new Date(leg.departure).toLocaleDateString()}</span>
  </div>
  <div class="passanger-depart">
        <span class="title">Depart</span>
        <span class="detail">${new Date(leg.departure).toLocaleTimeString([], {
          hour: "2-digit",
          minute: "2-digit",
        })}</span>
    </div>
    
    <div class="passanger-arrives">
          <span class="title">Arrives</span>
          <span class="detail">${new Date(leg.arrival).toLocaleTimeString([], {
            hour: "2-digit",
            minute: "2-digit",
          })}</span>
        </div>
`;

  flightCardContent.innerHTML = `
<div class="flight-row">
        <div class="flight-from">
          <span class="from-code">${leg.origin.displayCode}</span>
          <span class="from-city">${leg.origin.city}, ${leg.origin.country}</span>
        </div>
        <div class="plane">
          <div class="plane-img">
            <img
              src="https://cdn.onlinewebfonts.com/svg/img_537856.svg"
              alt="Plane"
            />
          </div>
        </div>
        <div class="flight-to">
          <span class="to-code">${leg.destination.displayCode}</span>
          <span class="to-city">${leg.destination.city}, ${leg.destination.country}</span>
        </div>
      </div>
      <div class="flight-details-row">
        <div class="flight-operator">
          <span class="title">OPERATOR</span>
          <span class="detail">${leg.carriers.marketing[0].name}</span>
        </div>
        <div class="flight-number">
          <span class="title">FLIGHT #</span>
          <span class="detail">${leg.segments[0].flightNumber}</span>
        </div>
        <div class="flight-class">
          <span class="title">DURATION</span>
          <span class="detail">${leg.durationInMinutes}</span>
        </div>
      </div>
`;

  // Airline logo
  var airlineLogo = document.createElement("img");
  airlineLogo.src = leg.carriers.marketing[0].logoUrl;
  airlineLogo.alt = leg.carriers.marketing[0].name;
  flightLogo.appendChild(airlineLogo);

  flightCardHeader.appendChild(flightLogo);
  flightCardHeader.appendChild(flightData);
  flightCard.appendChild(flightCardHeader);
  flightCard.appendChild(flightCardContent);

  return flightCard;
}
