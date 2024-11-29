document.addEventListener("DOMContentLoaded", function () {
  const startEndDateInput = document.getElementById("flat-start-end-date");
  const startDateInput = document.getElementById("flat-start-date");
  const endDateInput = document.getElementById("flat-end-date");

  flatpickr(startEndDateInput, {
    mode: "range", // Enables date range selection
    dateFormat: "Y-m-d", // Custom date format
    minDate: "today", // Disable all dates before today
    onChange: function (selectedDates, dateStr, instance) {
      if (selectedDates.length === 2) {
        const startDate = selectedDates[0]; // First selected date (start date)
        const endDate = selectedDates[1]; // Second selected date (end date)

        // Calculate the difference in days between the dates
        const diffInTime = endDate.getTime() - startDate.getTime();
        const diffInDays = diffInTime / (1000 * 60 * 60 * 24);

        if (diffInDays < globalMinDurationJs) {
          // Clear the end date if the range is less than 30 days
          instance.clear();
          alert("Please select a date range of at least 30 days.");
        } else {
          // Set start and end date values
          startDateInput.value = instance.formatDate(startDate, "Y-m-d");
          endDateInput.value = instance.formatDate(endDate, "Y-m-d");
        }
      }
    },
  });
});
