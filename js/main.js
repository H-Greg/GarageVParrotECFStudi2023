// Sélectionnez tous les éléments avec la classe "carBrand"
var carBrandCheckboxes = document.querySelectorAll(".carBrand");

// Sélectionnez l'élément d'entrée de l'année
var carYearInput = document.getElementById("carYear");

// Obtenez toutes les lignes du tableau des résultats
var lignesResultats = document.querySelectorAll("div.filtered tbody tr");

// Sélectionnez tous les libellés des cases à cocher
var carBrandLabels = document.querySelectorAll("label[for^='Brand']");

// Ajoutez un gestionnaire d'événements à chaque libellé de marque
carBrandLabels.forEach(function (label) {
  label.addEventListener("click", toggleCheckbox);
});

// Fonction pour basculer l'état de la case à cocher correspondante
function toggleCheckbox(event) {
  var checkbox = event.target.previousElementSibling;
  checkbox.checked = !checkbox.checked;
  filterResults(); // Appeler la fonction de filtrage après avoir basculé l'état de la case à cocher
}

// Ajoutez un gestionnaire d'événements à chaque case à cocher et à l'entrée de l'année
carBrandCheckboxes.forEach(function (checkbox) {
  checkbox.addEventListener("change", filterResults);
});

carYearInput.addEventListener("input", filterResults);

// Sélectionnez l'élément d'entrée du prix minimum
var carPriceMinInput = document.getElementById("carPriceMin");

// Sélectionnez l'élément d'entrée du prix maximum
var carPriceMaxInput = document.getElementById("carPriceMax");

// Ajoutez un gestionnaire d'événements à chaque entrée de prix
carPriceMinInput.addEventListener("input", filterResults);
carPriceMaxInput.addEventListener("input", filterResults);

// Sélectionnez l'élément d'entrée du kilométrage
var carMilesInput = document.getElementById("carMilesMax");

// Obtenez la valeur de l'entrée du kilométrage maximum
var kilometrageMaxFiltre = parseInt(carMilesInput.value);

// Ajoutez un gestionnaire d'événements à l'entrée du kilométrage
carMilesInput.addEventListener("input", filterResults);

// Fonction pour filtrer les résultats
function filterResults() {
  // Réinitialisez l'affichage de toutes les lignes
  lignesResultats.forEach(function (ligne) {
    ligne.style.display = "";
  });

  // Créez un tableau pour stocker les filtres sélectionnés
  var filtresSelectionnes = [];

  // Parcourez chaque case à cocher pour appliquer les filtres sélectionnés
  carBrandCheckboxes.forEach(function (checkbox) {
    if (checkbox.checked) {
      // Ajoutez le filtre sélectionné au tableau
      filtresSelectionnes.push(checkbox.value);
    }
  });

  // Obtenez la valeur de l'entrée de l'année
  var anneeFiltre = parseInt(carYearInput.value);

  // Obtenez la valeur de l'entrée du prix minimum
  var prixMinFiltre = parseInt(carPriceMinInput.value);

  // Obtenez la valeur de l'entrée du prix maximum
  var prixMaxFiltre = parseInt(carPriceMaxInput.value);

   // Obtenez la valeur de l'entrée du kilométrage
   var kilometrageFiltre = parseInt(carMilesInput.value);

  // Parcourez chaque ligne du tableau des résultats
  for (var i = 0; i < lignesResultats.length; i++) {
    var ligne = lignesResultats[i];
    var marque = ligne.querySelector("td:nth-child(1)").textContent;
    var annee = parseInt(ligne.querySelector("td:nth-child(2)").textContent);
    var prix = parseInt(ligne.querySelector("td:nth-child(3)").textContent);
    var kilometrage = parseInt(ligne.querySelector("td:nth-child(4)").textContent);

    // Affichez ou masquez la ligne en fonction des filtres sélectionnés, de l'année et des prix
    if (
      (filtresSelectionnes.length > 0 && !filtresSelectionnes.includes(marque)) ||
      (anneeFiltre && annee !== anneeFiltre) ||
      (prixMinFiltre && prix < prixMinFiltre) ||
      (prixMaxFiltre && prix > prixMaxFiltre) ||
      (kilometrageFiltre && kilometrage > kilometrageFiltre)
    ) {
      ligne.style.display = "none";
    }
  }
}





// Limiter l'input de l'année à 4 chiffres maximum
var carYearInput = document.getElementById("carYear");

carYearInput.addEventListener("input", function () {
  var value = this.value;

  // Supprimer tous les caractères non numériques
  value = value.replace(/\D/g, "");

  // Limiter la valeur à 4 chiffres
  value = value.slice(0, 4);

  // Mettre à jour la valeur de l'élément <input>
  this.value = value;
});




// Tri initial au chargement de la page (par ordre alphabétique croissant)
window.addEventListener("DOMContentLoaded", () => {
  sortingSelect.value = "alphabeticalGrowing";
  sortingSelect.dispatchEvent(new Event("change"));
});


// Trier le tableau en fonction de la sélection faite dans le menu déroulant "sorting"
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






document.addEventListener('DOMContentLoaded', function() {
  // Boite modale pour la connexion
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

  // Boîte modale pour les voitures
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

  // Boîte modale pour les commentaires en attente
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








// Lorsque l'administrateur clique sur le bouton "Modifier"
document.querySelector('.modify-article').addEventListener('click', function() {
    document.getElementById('modifyArticle').style.display = 'block';
    document.getElementById('article').style.display = 'none';
});



    // Gérer l'événement de pression de la touche Tab dans la zone de texte
    document.getElementById("textareaArticle").addEventListener("keydown", function(e) {
        if (e.key === "Tab") {
            e.preventDefault(); // Empêcher le comportement par défaut (changement de focus)
            var start = this.selectionStart;
            var end = this.selectionEnd;
            // Insérer une tabulation à la position actuelle du curseur
            this.value = this.value.substring(0, start) + "\t" + this.value.substring(end);
            // Déplacer le curseur après la tabulation
            this.selectionStart = this.selectionEnd = start + 1;
        }
    });







// Lorsque l'utilisateur clique sur l'adresse e-mail
function showContactForm() {
    var contactForm = document.getElementsByClassName("contactForm")[0];
    contactForm.style.display = "flex";
}




  // Vérifie si l'URL contient le paramètre "modal-open" pour garder la boîte modale ouverte
  if (window.location.search.includes('modal-open')) {
    var commentaryModal = document.getElementById('commentaryModal');
    commentaryModal.style.display = 'block';
  }



  // Vérifie si l'URL contient le paramètre "modal-open" pour garder la boîte modale ouverte
  if (window.location.search.includes('modal-open')) {
    var commentaryModal = document.getElementById('commentaryModal');
    commentaryModal.style.display = 'block';
  }
