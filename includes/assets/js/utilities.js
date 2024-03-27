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
