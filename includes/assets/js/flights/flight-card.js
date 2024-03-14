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
          <span class="from-city">${leg.origin.city}, ${
    leg.origin.country
  }</span>
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
          <span class="to-city">${leg.destination.city}, ${
    leg.destination.country
  }</span>
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
          <span class="detail">${convertMinutesToHoursAndMinutes(
            leg.durationInMinutes
          )}</span>
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

function flightCardStyleTwo(leg) {
  // Flight data row or main-strip
  var flightDataRow = document.createElement("div");
  flightDataRow.classList.add("row", "travelpro-plus-spacing");

  // Flight Logo, It's a child of main-strip
  var flightLogoColTwo = document.createElement("div");
  flightLogoColTwo.classList.add("col-2");

  // Airline logo
  var airlineLogo = document.createElement("img");
  airlineLogo.src = leg.carriers.marketing[0].logoUrl;
  airlineLogo.alt = leg.carriers.marketing[0].name;

  // span for showing Operator name if airline image is undefined
  var airlineName = document.createElement("span");
  airlineName.classList.add("travelpro-plus-leginfo-duration");

  if (leg.carriers.marketing[0].logoUrl !== undefined) {
    flightLogoColTwo.appendChild(airlineLogo);
  } else {
    airlineName.textContent = leg.carriers.marketing[0].name;
    flightLogoColTwo.appendChild(airlineName);
  }

  // Flight data, It's a child of main-strip
  var flightDataMainColTen = document.createElement("div");
  flightDataMainColTen.classList.add("col-10");

  flightDataMainColTen.innerHTML = `
  
  <div class="travelpro-plus-leginfo">
    <div class="travelpro-plus-leginfo-from-time">
      <span class="travelpro-leginfo-timings">
      ${new Date(leg.departure).toLocaleTimeString([], {
        hour: "2-digit",
        minute: "2-digit",
      })}
      </span>
      <span class="travelpro-leginfo-location">${leg.origin.displayCode}</span>
    </div>
    <div class="travelpro-plus-leginfo-stops">
      <span class="travelpro-plus-leginfo-duration">${convertMinutesToHoursAndMinutes(
        leg.durationInMinutes
      )}</span>
      <div class="travelpro-plus-LegInfo_stopLine">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          xml:space="preserve"
          viewBox="0 0 12 12"
          class="travelpro-plus-LegInfo_planeEnd"
        >
          <path
            fill="#898294"
            d="M3.922 12h.499a.52.52 0 0 0 .444-.247L7.949 6.8l3.233-.019A.8.8 0 0 0 12 6a.8.8 0 0 0-.818-.781L7.949 5.2 4.866.246A.525.525 0 0 0 4.421 0h-.499a.523.523 0 0 0-.489.71L5.149 5.2H2.296l-.664-1.33a.523.523 0 0 0-.436-.288L0 3.509 1.097 6 0 8.491l1.196-.073a.523.523 0 0 0 .436-.288l.664-1.33h2.853l-1.716 4.49a.523.523 0 0 0 .489.71"
          ></path>
        </svg>
      </div>
      <span class="travelpro-plus-leginfo-duration">Direct</span>
    </div>
    <div class="travelpro-plus-leginfo-to-time">
      <span class="travelpro-leginfo-timings left-align">
      ${new Date(leg.arrival).toLocaleTimeString([], {
        hour: "2-digit",
        minute: "2-digit",
      })}
      </span>
      <span class="travelpro-leginfo-location left-align">${
        leg.destination.displayCode
      }</span>
    </div>
  </div>
  `;

  flightDataRow.appendChild(flightLogoColTwo);
  flightDataRow.appendChild(flightDataMainColTen);

  return flightDataRow;
}
