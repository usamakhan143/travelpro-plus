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

// Example usage
// var minutes = 10; // Change this value to whatever you want
// var formattedTime = convertMinutesToHoursAndMinutes(minutes);
// console.log(formattedTime);
