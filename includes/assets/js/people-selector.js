document.addEventListener("DOMContentLoaded", function () {
  const peopleInput = document.getElementById("peopleInput");
  const peopleDropdown = document.getElementById("peopleDropdown");
  const childrenSelector = document.getElementById("children");
  const childAgesContainer = document.getElementById("childAgesContainer");
  const confirmSelection = document.getElementById("confirmSelection");

  // Toggle the dropdown on input click
  peopleInput.addEventListener("click", function () {
    peopleDropdown.style.display =
      peopleDropdown.style.display === "block" ? "none" : "block";
  });

  // Function to create age dropdowns based on the number of children selected
  function createChildAgeSelectors(childrenCount) {
    // Clear any existing child age selectors
    childAgesContainer.innerHTML = "";

    for (let i = 0; i < childrenCount; i++) {
      const label = document.createElement("label");
      label.textContent = `Child ${i + 1} Age:`;
      label.className = "child-age-label";

      const select = document.createElement("select");
      select.className = "child-age-select";

      for (let age = 1; age <= 17; age++) {
        const option = document.createElement("option");
        option.value = age;
        option.textContent = `${age} year${age > 1 ? "s" : ""}`;
        select.appendChild(option);
      }

      childAgesContainer.appendChild(label);
      childAgesContainer.appendChild(select);
    }
  }

  // Update child age selectors when the number of children changes
  childrenSelector.addEventListener("change", function () {
    const numberOfChildren = parseInt(this.value);
    createChildAgeSelectors(numberOfChildren);
  });

  // Confirm selection and close the dropdown
  confirmSelection.addEventListener("click", function () {
    // Prevent the default button behavior
    event.preventDefault();
    const rooms = document.getElementById("rooms").value;
    const adults = document.getElementById("numberOfAdultsInHotel").value;
    const children = document.getElementById("children").value;

    let summary = `${rooms} Room(s), ${adults} Adult(s), ${children} Child(ren)`;

    // Add children ages to the summary
    const childAgeSelectors =
      childAgesContainer.getElementsByClassName("child-age-select");
    if (childAgeSelectors.length > 0) {
      let childAges = [];
      for (let i = 0; i < childAgeSelectors.length; i++) {
        childAges.push(childAgeSelectors[i].value);
      }
      summary += `, Ages: ${childAges.join(", ")}`;
    }

    // Set the input value with the summary and close the dropdown
    peopleInput.value = summary;
    peopleDropdown.style.display = "none";
  });

  // Hide dropdown when clicking outside
  document.addEventListener("click", function (e) {
    if (!peopleInput.contains(e.target) && !peopleDropdown.contains(e.target)) {
      peopleDropdown.style.display = "none";
    }
  });
});
