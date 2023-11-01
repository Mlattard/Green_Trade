const TVQ = 0.09975;
const TPS = 0.05;
const TAXES = TVQ + TPS;

// Repartiteur d'actions:

var actionsVuesMembre = (action, reponse) => {
    
    console.log(action + ' / ' + reponse.msg);
	switch(action){
		case "listerCardsArticles" :
			listerVuesArticlesCards(reponse);
		break;
        case "afficherPanier" :
        case 'ajouterPanier' :
        case 'enleverArticlePanier' :
        case "obtenirDetailsPanier" :
			afficherPanierMembre(reponse);
		break;
        case 'afficherCommandesPassees' :
            afficherCommandesPasseesMembre(reponse);
        break;
        case "creerPanier" :
		break;    
	}
}

// Lister en Cards:

function listerVuesArticlesCards(reponse){
    console.log('listerVuesArticlesCards');
    console.log(reponse);
    var contenu = $('#contenuMembre');
    contenu.empty();
    reponse.listeArticles.forEach(function (article) {
        if (article.statut == 'A') {
            contenu.append(obtenirCardArticle(article, reponse.panier, reponse.membreIdm));
        }
    });
    reponse.listeArticles.forEach(function (article) {
        if (article.statut == 'I') {
            contenu.append(obtenirCardArticle(article, reponse.panier, reponse.membreIdm));
        }
    });
}

function obtenirCardArticle(article, panier, membreIdm){
    var card = '<div class="card card_perso" style="width: 18rem;">';
    if (article.statut == 'I'){card += '<div class="card-overlay"></div>'};
    card += '<img src="../article/photos/' + article.photo + '" class="card-img-top" alt="...">';
    card += '<div class="card-body">';
    card += '<h5 class="card-title">' + article.nom + '</h5>';
    card += '<p class="card-text">' + article.description + '</p>';
    card += '<p class="card-text">Catégorie: ' + article.categorie + '</p>';
    card += '<p class="card-text">Prix: ' + article.prix + '$</p>';
    card += '<p class="card-text">État: ' + article.etat + '</p>';
    card += '<a href="#" class="btn btn-primary" onclick="ajouterPanier(' + article.ida + ', ' + panier.idp + ', ' + membreIdm + ')">Acheter</a>';
    card += '</div>';
    card += '</div>';
    
    return card;
}


let afficherPanierMembre = (reponse) => {
    console.log(reponse);
    let nbArt = reponse.panier.length;
    let vuePanier = '';
    if (reponse.statut == 'I'){
        vuePanier += '<h5>Facture commande ' + reponse.panierIdp + '</h5>';
    } else {
        vuePanier += '<h5>Panier ' + reponse.panierIdp + '</h5>'
    }

    vuePanier += `
        <table class="table" id="tablePanier">
            <tbody>
        `;

    let montantAvantTaxes = 0;

    for (let unArticle of reponse.panier) {
        let prix = parseFloat(unArticle.prix);
        vuePanier += `
            <tr>
                <td class="nomArticlePanier">${unArticle.nom}</td>
                <td class="prixPanier">${prix.toFixed(2)} $</td>
        `
        if (reponse.statut == 'A'){
            vuePanier += '<td><a href="#" class="close closeBtn" onclick="enleverArticlePanier(' + unArticle.ida + ', ' + reponse.panierIdp + ');">&#10005;</a></td>';
        }
        vuePanier += '</tr>'; 
        montantAvantTaxes += prix;
    }
    
    let montantTaxes = parseFloat((montantAvantTaxes * TAXES).toFixed(2));
    let montantTotal = montantAvantTaxes + montantTaxes;

    vuePanier += `
            <tr>
                <th>${nbArt} articles</th>
                <td class="prixPanier">${montantAvantTaxes.toFixed(2)} $</td>
            </tr>
            <tr>
                <th>Taxes</th>
                <td class="prixPanier">${montantTaxes.toFixed(2)} $</td>
            </tr>
            <tr>
                <th>Total</th>
                <td class="prixPanier">${montantTotal.toFixed(2)} $</td>
            </tr>
            </tbody>
        </table>
        `
        if (reponse.statut == 'A'){
            vuePanier += '<button class="btn btn-dark" id="btnPayer" onclick="desactiverPanier(' + reponse.panierIdp + '); listerArticlesCards(' + reponse.membreIdm + '); creerPanier(' + reponse.membreIdm + '); afficherPanier(' + reponse.membreIdm + '); payer();">Payer</button>';
            vuePanier += '<span id="payer"></span>';
        }

    $('#panierMembre').html(vuePanier);
    $("#payer").innerHTML = "";   
}

let payer = () => {
    document.getElementById("payer").innerHTML = "Commande passée :)";
}
// Lister Commandes Passées

function afficherCommandesPasseesMembre(reponse){
    var contenu = $('#contenuMembre');
    contenu.empty();
    var tab = '<table class="table table-hover" id="contenuDynamique">';
    tab += '<thead>';
    tab += '<tr>';
    tab += '<th scope="col">ID Panier</th>';
    tab += '<th scope="col">Date de création</th>';
    tab += '</tr>';
    tab += '</thead>';
    tab += '<tbody>';
    
    reponse.paniers.forEach(function (panier) {
        tab += remplirTableauPaniers(panier, reponse.membreIdm);
    });

    tab += '</tbody>';
    tab += '</table>';

    contenu.append(tab);
}

function remplirTableauPaniers(panier, membreIdm){
    var ligne = '<tr onclick="obtenirDetailsPanier(' + membreIdm + ', ' + panier.idp + ');">';
    ligne += '<th scope="row">' + panier.idp + '</th>';
    ligne += '<td>' + panier.date_creation + '</td>';
    ligne += '</tr>';

    return ligne;
}