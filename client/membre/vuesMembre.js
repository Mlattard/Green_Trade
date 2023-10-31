const TVQ = 0.09975;
const TPS = 0.05;
const TAXES = TVQ + TPS;

// Repartiteur d'actions:

var actionsVuesMembre = (action, reponse) => {

	switch(action){
		case "listerCardsArticles" :
			listerVuesArticlesCards(reponse.listeArticles, reponse.panier);
		break;
        case "afficherPanier" :
        case 'ajouterPanier' :
        case 'enleverArticlePanier' :
			afficherPanierMembre(reponse);
		break;
        case "creerPanier" :
		break;        
	}
}

// Lister en Cards:

function listerVuesArticlesCards(listeArticles, panier){
    var contenu = $('#contenuMembre');
    contenu.empty();
    listeArticles.forEach(function (article) {
        contenu.append(obtenirCardArticle(article, panier));
    });
}

function obtenirCardArticle(article, panier){
    var card = '<div class="card card_perso" style="width: 18rem;">';
    card += '<img src="../article/photos/' + article.photo + '" class="card-img-top" alt="...">';
    card += '<div class="card-body">';
    card += '<h5 class="card-title">' + article.nom + '</h5>';
    card += '<p class="card-text">' + article.description + '</p>';
    card += '<p class="card-text">Catégorie: ' + article.categorie + '</p>';
    card += '<p class="card-text">Prix: ' + article.prix + '$</p>';
    card += '<p class="card-text">État: ' + article.etat + '</p>';
    card += '<a href="#" class="btn btn-primary" onclick="ajouterPanier(' + article.ida + ', ' + panier.idp + ')">Acheter</a>';
    card += '</div>';
    card += '</div>';
    
    return card;
}


let afficherPanierMembre = (reponse) => {
    
    console.log(reponse);

    let nbArt = reponse.panier.length;
    let vuePanier = `
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
                <td><a href="#" class="close closeBtn" onclick="enleverArticlePanier(${unArticle.ida}, ${reponse.idp});">&#10005;</a></td>
            </tr> 
        `;
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
        <button class="btn btn-dark" onclick="payer();">Payer</button>
        <span id="payer"></span>
        `;

    $('#panierMembre').html(vuePanier);
    // document.getElementById("payer").innerHTML = "";   
}