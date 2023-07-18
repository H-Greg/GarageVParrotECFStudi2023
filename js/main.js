//===== Filter and sorting management of results =====

// Select all elements with the class "carBrand"
var carBrandCheckboxes = document.querySelectorAll(".carBrand");

// Select the car year input element
var carYearInput = document.getElementById("carYear");

// Get all rows from the results table
var lignesResultats = document.querySelectorAll("div.filtered tbody tr");

// Select all checkbox labels
var carBrandLabels = document.querySelectorAll("label[for^='Brand']");

// Add an event listener to each brand label
carBrandLabels.forEach(function (label) {
  label.addEventListener("click", toggleCheckbox);
});

// Function to toggle the state of the corresponding checkbox
function toggleCheckbox(event) {
  var checkbox = event.target.previousElementSibling;
  checkbox.checked = !checkbox.checked;
  filterResults(); // Call the filter function after toggling the checkbox
}

// Add event listeners to each checkbox and the car year input
carBrandCheckboxes.forEach(function (checkbox) {
  checkbox.addEventListener("change", filterResults);
});

carYearInput.addEventListener("input", filterResults);

// Select the car minimum price input element
var carPriceMinInput = document.getElementById("carPriceMin");

// Select the car maximum price input element
var carPriceMaxInput = document.getElementById("carPriceMax");

// Add event listeners to each price input
carPriceMinInput.addEventListener("input", filterResults);
carPriceMaxInput.addEventListener("input", filterResults);

// Select the car mileage input element
var carMilesInput = document.getElementById("carMilesMax");

// Get the value of the maximum mileage input
var kilometrageMaxFiltre = parseInt(carMilesInput.value);

// Add an event listener to the mileage input
carMilesInput.addEventListener("input", filterResults);

// Function to filter the results
function filterResults() {
  // Reset the display of all rows
  lignesResultats.forEach(function (ligne) {
    ligne.style.display = "";
  });

  // Create an array to store the selected filters
  var filtresSelectionnes = [];

  // Loop through each checkbox to apply the selected filters
  carBrandCheckboxes.forEach(function (checkbox) {
    if (checkbox.checked) {
      // Add the selected filter to the array
      filtresSelectionnes.push(checkbox.value);
    }
  });

  // Get the value of the year input
  var anneeFiltre = parseInt(carYearInput.value);

  // Get the value of the minimum price input
  var prixMinFiltre = parseInt(carPriceMinInput.value);

  // Get the value of the maximum price input
  var prixMaxFiltre = parseInt(carPriceMaxInput.value);

   // Get the value of the mileage input
   var kilometrageFiltre = parseInt(carMilesInput.value);

   // Variable to check if any results are found
  var resultsFound = false;

  // Loop through each row in the results table
  for (var i = 0; i < lignesResultats.length; i++) {
    var ligne = lignesResultats[i];
    var marque = ligne.querySelector("td:nth-child(1)").textContent;
    var annee = parseInt(ligne.querySelector("td:nth-child(2)").textContent);
    var prix = parseInt(ligne.querySelector("td:nth-child(3)").textContent);
    var kilometrage = parseInt(ligne.querySelector("td:nth-child(4)").textContent);

    // Show or hide the row based on the selected filters, year, and prices
    if (
      (filtresSelectionnes.length > 0 && !filtresSelectionnes.includes(marque)) ||
      (anneeFiltre && annee !== anneeFiltre) ||
      (prixMinFiltre && prix < prixMinFiltre) ||
      (prixMaxFiltre && prix > prixMaxFiltre) ||
      (kilometrageFiltre && kilometrage > kilometrageFiltre)
    ) {
      ligne.style.display = "none";
    } else {
      // At least one result is found
      resultsFound = true;
    }
  }
  // If no results are found, display the message
  var noResultMessage = document.getElementById("noResultMessage");
  if (!resultsFound) {
    noResultMessage.style.display = "block";
  } else {
    noResultMessage.style.display = "none";
  }
}



//===== Limiting the input for the year =====

// Limit the year input to a maximum of 4 digits
var carYearInput = document.getElementById("carYear");

carYearInput.addEventListener("input", function () {
  var value = this.value;

  // Remove all non-numeric characters
  value = value.replace(/\D/g, "");

  // Limit the value to 4 digits
  value = value.slice(0, 4);

  // Update the value of the <input> element
  this.value = value;
});



//===== Initial sorting on page load =====

// Initial sorting on page load (ascending alphabetical order)
window.addEventListener("DOMContentLoaded", () => {
  sortingSelect.value = "alphabeticalGrowing";
  sortingSelect.dispatchEvent(new Event("change"));
});



//===== Sorting of the results table =====

// Sort the table based on the selected value in the "sorting"
const sortingSelect = document.getElementById("sorting");
const tableBody = document.querySelector(".filtered tbody");
const rows = Array.from(tableBody.querySelectorAll("tr"));

sortingSelect.addEventListener("change", () => {
  const selectedValue = sortingSelect.value;
  let sortedRows;

  switch (selectedValue) {
    case "alphabeticalGrowing":
      sortedRows = rows.sort((a, b) => a.cells[0].textContent.localeCompare(b.cells[0].textContent));
      break;
    case "alphabeticalDescending":
      sortedRows = rows.sort((a, b) => b.cells[0].textContent.localeCompare(a.cells[0].textContent));
      break;
      case "priceGrowing":
        sortedRows = rows.sort((a, b) => {
          const priceA = Number(a.cells[2].textContent.replace(/\D/g, ''));
          const priceB = Number(b.cells[2].textContent.replace(/\D/g, ''));
          return priceA - priceB;
        });
        break;
      case "priceDescending":
        sortedRows = rows.sort((a, b) => {
          const priceA = Number(a.cells[2].textContent.replace(/\D/g, ''));
          const priceB = Number(b.cells[2].textContent.replace(/\D/g, ''));
          return priceB - priceA;
        });
        break;
      case "mileageGrowing":
        sortedRows = rows.sort((a, b) => {
          const mileageA = Number(a.cells[3].textContent.replace(/\D/g, ''));
          const mileageB = Number(b.cells[3].textContent.replace(/\D/g, ''));
          return mileageA - mileageB;
        });
        break;
      case "mileageDescending":
        sortedRows = rows.sort((a, b) => {
          const mileageA = Number(a.cells[3].textContent.replace(/\D/g, ''));
          const mileageB = Number(b.cells[3].textContent.replace(/\D/g, ''));
          return mileageB - mileageA;
        });
        break;
      
    case "yearGrowing":
      sortedRows = rows.sort((a, b) => Number(a.cells[1].textContent) - Number(b.cells[1].textContent));
      break;
    case "yearDescending":
      sortedRows = rows.sort((a, b) => Number(b.cells[1].textContent) - Number(a.cells[1].textContent));
      break;
    default:
      // No sorting selected, use the default order
      sortedRows = rows;
      break;
  }

  // Remove existing rows from the table
  tableBody.innerHTML = "";

  // Append sorted rows to the table
  for (const row of sortedRows) {
    tableBody.appendChild(row);
  }
});


//===== Modal box =====

document.addEventListener('DOMContentLoaded', function() {
  // Modal box for login
  var logo = document.getElementById('logo');
  var modal = document.getElementById('modal');
  var close = document.getElementsByClassName('close')[0];

  logo.addEventListener('click', function() {
    modal.style.display = 'block';
  });

  close.addEventListener('click', function() {
    modal.style.display = 'none';
  });

  window.addEventListener('click', function(event) {
    if (event.target === modal) {
      modal.style.display = 'none';
    }
  });

  // Modal box for cars
  var modifyButton = document.getElementById('modify-car');
  var carModal = document.getElementById('carModal');
  var carModalClose = carModal.getElementsByClassName('close')[0];

  modifyButton.addEventListener('click', function() {
    carModal.style.display = 'block';
  });

  carModalClose.addEventListener('click', function() {
    carModal.style.display = 'none';
  });

  window.addEventListener('click', function(event) {
    if (event.target === carModal) {
      carModal.style.display = 'none';
    }
  });

  // Modal box for pending comments
  var moderateButton = document.getElementById('moderate-commentary');
  var commentaryModal = document.getElementById('commentaryModal');
  var commentaryModalClose = commentaryModal.getElementsByClassName('close')[0];

  moderateButton.addEventListener('click', function() {
    commentaryModal.style.display = 'block';
  });

  commentaryModalClose.addEventListener('click', function() {
    commentaryModal.style.display = 'none';
  });

  window.addEventListener('click', function(event) {
    if (event.target === commentaryModal) {
      commentaryModal.style.display = 'none';
    }
  });
});


//===== Article modification =====

// When the administrator clicks on the "Modify" button
document.querySelector('.modify-article').addEventListener('click', function() {
    document.getElementById('modifyArticle').style.display = 'block';
    document.getElementById('article').style.display = 'none';
});


//===== Handling the Tab key in the article text area  =====

    // Handle the Tab key press event in the text area
    document.getElementById("textareaArticle").addEventListener("keydown", function(e) {
        if (e.key === "Tab") {
            e.preventDefault(); // Prevent default behavior (focus change)
            var start = this.selectionStart;
            var end = this.selectionEnd;
            // Insert a tab at the current cursor position
            this.value = this.value.substring(0, start) + "\t" + this.value.substring(end);
            // Move the cursor after the tab
            this.selectionStart = this.selectionEnd = start + 1;
        }
    });



//===== Displaying the contact form =====

// When the user clicks on the email address
function showContactForm() {
    var contactForm = document.getElementsByClassName("contactForm")[0];
    contactForm.style.display = "flex";
}


//===== Checking for the presence of the "modal-open" parameter in the URL =====

// Check if the URL contains the "modal-open" parameter to keep the modal box open
if (window.location.search.includes('modal-open')) {
    var commentaryModal = document.getElementById('commentaryModal');
    commentaryModal.style.display = 'block';
  }
