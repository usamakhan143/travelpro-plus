function convertMinutesToHoursAndMinutes(minutes) {
  var hours = Math.floor(minutes / 60);
  var remainingMinutes = minutes % 60;
  var formattedTime = "";

  if (hours > 0) {
    formattedTime += hours + "hr ";
  }

  if (remainingMinutes > 0) {
    formattedTime += remainingMinutes + "min";
  }

  return formattedTime;
}

// generate randon string
function generateRandomString(length) {
  var chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  var result = "";
  for (var i = 0; i < length; i++) {
    var randomIndex = Math.floor(Math.random() * chars.length);
    result += chars.charAt(randomIndex);
  }
  return result;
}

// Stars Rating
function getStarRating(averageRating) {
  if (averageRating < 1) {
    return "No star ratings yet";
  }

  const totalStars = 5;
  const fullStars = Math.floor(averageRating);
  const halfStar = averageRating - fullStars >= 0.5 ? 1 : 0;
  const emptyStars = totalStars - fullStars - halfStar;

  let starIcons = "";

  for (let i = 0; i < fullStars; i++) {
    starIcons += `<i class="fas fa-star" style="color: #bf974c;"></i>`;
  }

  if (halfStar) {
    starIcons += `<i class="fas fa-star-half-alt" style="color: #bf974c;"></i>`;
  }

  for (let i = 0; i < emptyStars; i++) {
    starIcons += `<i class="far fa-star" style="color: #bf974c;"></i>`;
  }

  return starIcons;
}

// Example usage
// var minutes = 10; // Change this value to whatever you want
// var formattedTime = convertMinutesToHoursAndMinutes(minutes);
// console.log(formattedTime);

$("#numberOfChildren").click(function () {
  $("#childrenModal").css({
    display: "block",
  });
  $("#childrenModal").addClass("fadeIn");
});

$("#numberOfChildrenModal").on("input", function () {
  var numberOfChildren = parseInt($(this).val());
  if (numberOfChildren > 4) {
    $(this).val(4);
    numberOfChildren = 4;
  }
  var childrenAgeFields = $("#childAgeFieldsModal");
  childrenAgeFields.empty(); // Clear previous fields

  for (var i = 1; i <= numberOfChildren; i++) {
    var div = $('<div class="mb-3 col-sm-6"></div>');
    div.append(
      '<label for="childAgeFieldsModal' +
        i +
        '" class="form-label">Age of Child ' +
        i +
        ":</label>"
    );
    div.append(
      '<input type="number" class="form-control childAgeFieldsModal" id="childAgeFieldsModal' +
        i +
        '" name="childAgeFieldsModal' +
        i +
        '" min="0" max="17" required>'
    );
    childrenAgeFields.append(div);
    $("#childAgeFieldsModal" + i).on("input", function () {
      var ageNumberOfChild = parseInt($(this).val());
      if (ageNumberOfChild > 17) {
        $(this).val(17);
      }
    });
  }
});

// $("#childrenModal").on("hidden.bs.modal", function () {
//   $("#numberOfChildrenModal").val("");
//   $("#childAgeFieldsModal").empty();
// });

// Function to close the modal
function closeModal() {
  $("#childrenModal").removeClass("fadeIn");
  $("#childrenModal").addClass("fadeOut");
  $("#numberOfChildrenModal").val("");
  $("#childAgeFieldsModal").empty();
  // setTimeout(function () {
  //   $("#childrenModal").css({
  //     display: "none",
  //   });
  //   $("#childrenModal").removeClass("fadeOut");
  // }, 500); // Same duration as animation
  $("#childrenModal").css({
    display: "none",
  });
  $("#childrenModal").removeClass("fadeOut");
}

$("#addChildrenBtn").click(function () {
  var childAges = [];
  $("#childAgeFieldsModal")
    .find("input")
    .each(function () {
      childAges.push($(this).val());
    });
  $("#numberOfChildren").val(childAges.join(","));
  // $("#childrenModal").modal("hide");
  closeModal();
});

$("#numberOfAdultsInHotel").on("input", function () {
  var numberOfAdultsInHotel = parseInt($(this).val());

  if (numberOfAdultsInHotel == "") {
    $(this).val(1);
  } else if (numberOfAdultsInHotel > 10) {
    $(this).val(10);
  } else if (numberOfAdultsInHotel < 1) {
    $(this).val(1);
  }
});

function setCookie(name, value, days) {
  // Delete the existing cookie
  deleteCookie(name);

  var expires = "";
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000); // Calculate expiration date
    expires = "; expires=" + date.toUTCString();
  }
  // Set the cookie
  document.cookie =
    name + "=" + encodeURIComponent(value) + expires + "; path=/";
}

function deleteCookie(name) {
  // Set the cookie with an empty value and an expiration date in the past
  document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/";
}

// 30% Markup
function increasePrice(price) {
  const amount = price * 1.3;
  return amount.toString().split(".")[0];
}

// Function to get the value of a specific cookie by name
function getCookieValue(cookieName) {
  // Split the cookie string into an array of individual cookies
  var cookies = document.cookie.split(";");

  // Loop through each cookie to find the one with the specified name
  for (var i = 0; i < cookies.length; i++) {
    var cookie = cookies[i].trim(); // Trim any leading/trailing whitespace

    // Check if this cookie has the specified name
    if (cookie.indexOf(cookieName + "=") === 0) {
      // Return the value of the cookie (substring after the '=' sign)
      return cookie.substring(cookieName.length + 1);
    }
  }

  // If the cookie with the specified name is not found, return null
  return null;
}

var today = new Date();
var dd = String(today.getDate()).padStart(2, "0");
var mm = String(today.getMonth() + 1).padStart(2, "0"); // January is 0!
var yyyy = today.getFullYear();

today = yyyy + "-" + mm + "-" + dd;

// Set minimum date for start_date field
document.getElementById("start-date").setAttribute("min", today);

// Set minimum date for end_date field
document.getElementById("end-date").setAttribute("min", today);

// Add event listener to start_date input field
document.getElementById("start-date").addEventListener("change", function () {
  var startDate = this.value;
  document.getElementById("end-date").setAttribute("min", startDate);
});
