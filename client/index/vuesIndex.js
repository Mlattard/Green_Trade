
// Repartiteur d'actions:

var actionsVuesIndex = (action, reponse) => {

	switch(action){
		case "listerCardsArticles" :
			listerVuesArticlesCards(reponse.listeArticles);
		break; 
        case "enregistrerMembre" :
            alert(reponse);  
        break;   
	}
}

// Lister en Cards:

function listerVuesArticlesCards(listeArticles){
    var contenu = $('#contenuIndex');
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
    card += '<p class="card-text">' + article.description + '</p>';
    card += '<p class="card-text">Catégorie: ' + article.categorie + '</p>';
    card += '<p class="card-text">Prix: ' + article.prix + '</p>';
    card += '<p class="card-text">État: ' + article.etat + '</p>';
    card += '<a href="#" class="btn btn-primary">Acheter</a>';
    card += '</div>';
    card += '</div>';
    
    return card;
}