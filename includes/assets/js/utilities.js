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
    return "No ratings yet";
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
  $("#childrenModal").modal("show");
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

$("#childrenModal").on("hidden.bs.modal", function () {
  $("#numberOfChildrenModal").val("");
  $("#childAgeFieldsModal").empty();
});

$("#addChildrenBtn").click(function () {
  var childAges = [];
  $("#childAgeFieldsModal")
    .find("input")
    .each(function () {
      childAges.push($(this).val());
    });
  $("#numberOfChildren").val(childAges.join(","));
  $("#childrenModal").modal("hide");
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
