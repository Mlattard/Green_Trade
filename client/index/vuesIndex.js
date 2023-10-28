
// Repartiteur d'actions:

var actionsVuesIndex = (action, reponse) => {

	switch(action){
		case "listerCardsArticles" :
			afficherArticles(page, reponse.listeArticles)
		break;
        case "carrouselPrecedent":
            afficherPagePrecedente(reponse.listeArticles);
        break;
        case "carrouselSuivant":
            afficherPageSuivante(reponse.listeArticles);
        break;
        case "enregistrerMembre" :
            alert(reponse);  
        break;   
	}
}

// Lister en Cards:

function listerVuesArticlesCards(listeArticles){
    var contenu = $('#produitsIndex');
    var page = 1;
    contenu.empty();
    listeArticles.forEach(function (article) {
        contenu.append(obtenirCardArticle(article));
    });
}

function obtenirCardArticle(article){
    var card = '<div class="card card_perso" style="width: 18rem;">';
    card += '<img src="serveur/article/photos/' + article.photo + '" class="card-img-top" alt="...">';
    card += '<div class="card-body">';
    card += '<h5 class="card-title">' + article.nom + '</h5>';
    card += '</div>';
    card += '</div>';
    
    return card;
}

function afficherArticles(page, listeArticles) {
    var contenu = $('#produitsIndex');
    var startIndex = (page - 1) * articlesParPage;
    var endIndex = startIndex + articlesParPage;
    var articlesAAfficher = listeArticles.slice(startIndex, endIndex);

    contenu.empty();

    articlesAAfficher.forEach(function (article) {
        contenu.append(obtenirCardArticle(article));
    });
}

function afficherPageSuivante(listeArticles) {
    if (page < Math.ceil(listeArticles.length / articlesParPage)) {
        page++;
        afficherArticles(page, listeArticles);
    }
}

function afficherPagePrecedente(listeArticles) {
    if (page > 1) {
        page--;
        afficherArticles(page, listeArticles);
    }
}

var page = 1;
var articlesParPage = 4;