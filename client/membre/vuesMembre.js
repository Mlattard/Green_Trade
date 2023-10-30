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
			afficherPanier(reponse.panier);
		break;
        case "creerPanier" :
		break;
        case 'ajouterPanier' :
            console.log(reponse);
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

let afficherPanier = () => {
    let panier = JSON.parse(localStorage.getItem("panier"));
    let nbArt = panier.length;
    let vuePanier = `
        <div class="card">
            <div class="row">
                <div class="col-md-8">
                    <div class="title">
                        <div class="row">
                            <div class="col">
                                <h4><b>Panier d'achats</b></h4>
                            </div>
                            <div class="col align-self-center text-right text-muted">${nbArt} articles</div>
                        </div>
                    </div> 
        `;
    let listeArticlesAchetes = [];
    panier.forEach(idArticle => {
        listeArticlesAchetes.push(listeArticles.find(unArticle => unArticle.ida == idArticle));
    });
    let totalAchat = 0;
    let montantTotalCetArticle;
    for (let unArticle of listeArticlesAchetes) {
        montantTotalCetArticle = parseFloat(unArticle.prix);
        vuePanier += ` 
            <div class="row border-top border-bottom">
                <div class="row align-items-center">
                    <div class="col-2"><img class="img-fluid" src="../../images_articles/${unArticle.imageart}"></div>
                    <div class="col">
                        <div class="row text-muted">${unArticle.nomarticle}</div>
                    </div>
                    <div class="col"> <input type="number" id="qte" name="qte" min="1" max="100" value=1 onChange="ajusterTotalAchat(this,${unArticle.prix}, ${montantTotalCetArticle});"></div>
                    <div class="col">${montantTotalCetArticle}$</div>
                    <div class="col"><div class="close closeBtn" onClick="enleverArticle(this,${unArticle.ida});">&#10005;</div></div>
                </div>
            </div>
        `;
        totalAchat += montantTotalCetArticle;
    }
    
    let montantTaxes = totalAchat * TAXES;
    let totalPayer = totalAchat + montantTaxes;

    vuePanier += `
            </div>
                    <div class="col-md-4 bg-info text-dark">
                        <div>
                            <h5><b>Facture</b></h5>
                        </div>
                        <hr>
                        <br/>
                        <div class="row">
                            <div class="col" style="padding-left:10;">${nbArt} ARTICLES</div>
                            <div id="totalAchat" class="col text-right">${totalAchat.toFixed(2)}$</div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col" style="padding-left:10;">MONTANT TAXES</div>
                            <div id="idTaxes" class="col text-right">${montantTaxes.toFixed(2)}$</div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col" style="padding-left:10;">MONTANT À PAYER</div>
                            <div id="totalPayer" class="col text-right">${totalPayer.toFixed(2)}$</div>
                        </div> 
                        </br>
                        <button class="btn btn-dark" onclick="payer();">PAYER</button>
                        <span id="payer"></span>
                        <br/> 
                    </div>
                </div>
            </div>
        `;
    $('#contenuPanier').html(vuePanier);
    document.getElementById("payer").innerHTML = "";
    let modalPanier = new bootstrap.Modal(document.getElementById('idModPanier'), {});
    modalPanier.show();
}