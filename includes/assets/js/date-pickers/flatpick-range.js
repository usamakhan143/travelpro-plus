document.addEventListener("DOMContentLoaded", function () {
  const startDateInput = document.getElementById("flat-start-date");
  const endDateInput = document.getElementById("flat-end-date");

  flatpickr(startDateInput, {
    mode: "range", // Enables date range selection
    dateFormat: "Y-m-d", // Custom date format
    minDate: "today", // Disable all dates before today
    onChange: function (selectedDates, dateStr, instance) {
      if (selectedDates.length === 2) {
        const startDate = selectedDates[0]; // First selected date (start date)
        const endDate = selectedDates[1]; // Second selected date (end date)

        if (startDate.getTime() === endDate.getTime()) {
          // Reset the second date if start and end date are the same
          instance.clear(); // Clear both dates
        } else {
          // Set start and end date values
          startDateInput.value = instance.formatDate(startDate, "Y-m-d");
          endDateInput.value = instance.formatDate(endDate, "Y-m-d");
        }
      }
    },
  });
});
