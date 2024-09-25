document.addEventListener("DOMContentLoaded", function () {
  const startDateInput = document.getElementById("flat-start-date");
  const endDateInput = document.getElementById("flat-end-date");

  flatpickr(startDateInput, {
    mode: "range", // Enables date range selection
    dateFormat: "Y-m-d", // Custom date format
    minDate: "today", // Disable all dates before today
    onChange: function (selectedDates, dateStr, instance) {
      if (selectedDates.length === 2) {
        // Range selected
        const startDate = selectedDates[0]; // First selected date
        const endDate = selectedDates[1]; // Second selected date

        startDateInput.value = instance.formatDate(startDate, "Y-m-d");
        endDateInput.value = instance.formatDate(endDate, "Y-m-d");
      }
    },
  });
});
