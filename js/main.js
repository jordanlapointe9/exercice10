let collectionBtnNouvelle = document.querySelectorAll(".button-article");
let collectionNouvelle = document.querySelectorAll(".content-article");

if (collectionBtnNouvelle) {
  for (let btn of collectionBtnNouvelle) {
    btn.addEventListener("click", Ajax);
  }
}

function Ajax(evt) {
  let evtId = evt.target.id;
  let evtDataSet = evt.target.dataset.checked;

  let evtContentId = "#content-" + evtId;
  let contenuDiv = document.querySelector(evtContentId);
  let collectionBtn = document.querySelectorAll(".button-article");

  for (let i = 0; i < collectionBtn.length; i++) {
    if(collectionBtn[i].dataset.checked == "true"){
      const localContenuDiv = document.querySelector("#content-" + collectionBtn[i].id);
      
      localContenuDiv.classList.remove("open-div");
      localContenuDiv.classList.add("close-div");

      setTimeout(() => {
        localContenuDiv.innerHTML = "";
      }, 500);
    }
  }

  if (evtDataSet == "false") {
    evt.target.dataset.checked = "true";
    contenuDiv.classList.remove("close-div");

    let maRequete = new XMLHttpRequest();
    maRequete.open(
      "GET",
      "http://localhost/exercice9/wp-json/wp/v2/posts/" + evtId
    );

    maRequete.onload = function() {
      if (maRequete.status >= 200 && maRequete.status < 400) {
        let data = JSON.parse(maRequete.responseText);

        creationHTML(data); // paramètres à ajouter
      } else {
        console.log("La connexion est faite mais il y a une erreur");
      }
    };

    maRequete.onerror = function() {
      console.log("erreur de connexion");
    };

    maRequete.send();
  } else {
    contenuDiv.classList.remove("close-div");
    contenuDiv.classList.remove("open-div");
    contenuDiv.classList.add("close-div");

    setTimeout(() => {
      contenuDiv.innerHTML = "";
      evt.target.dataset.checked = "false";
    }, 500);
  }
}
///////////////////////////////////////////////////////

function creationHTML(postsData) {
  let monHtmlString = "";
  monHtmlString += "<h2>" + postsData.title.rendered + "</h2>";
  monHtmlString += postsData.content.rendered;

  let contenuNouvelleId = "#content-" + postsData.id;
  let contenuNouvelle = document.querySelector(contenuNouvelleId);

  contenuNouvelle.innerHTML = monHtmlString;
  contenuNouvelle.classList.add("open-div");
}
