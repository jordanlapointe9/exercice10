let collectionBtnNouvelle = document.querySelectorAll(".button-article");
let collectionNouvelle = document.querySelectorAll(".content-article");

if (collectionBtnNouvelle) {
  for (let btn of collectionBtnNouvelle) {
    btn.addEventListener("click", Ajax);
  }
}

function Ajax(evt) {
  let evtId = evt.target.id;

  let maRequete = new XMLHttpRequest();
  maRequete.open(
    "GET",
    "http://localhost/exercice9/wp-json/wp/v2/posts/" + evtId
  );

  maRequete.onload = function() {
    if (maRequete.status >= 200 && maRequete.status < 400) {
      let data = JSON.parse(maRequete.responseText);
      console.log(evt.target.dataset.checked);
      // instructions ici
      creationHTML(data); // paramètres à ajouter
    } else {
      console.log("La connexion est faite mais il y a une erreur");
    }
  };

  maRequete.onerror = function() {
    console.log("erreur de connexion");
  };

  maRequete.send();
}
///////////////////////////////////////////////////////

function creationHTML(postsData) {
  let monHtmlString = "";
  monHtmlString += "<h2>" + postsData.title.rendered + "</h2>";
  monHtmlString += postsData.content.rendered;

  let contenuNouvelleId = "#content-" + postsData.id;
  let contenuNouvelle = document.querySelector(contenuNouvelleId);

  contenuNouvelle.innerHTML = monHtmlString;
}
