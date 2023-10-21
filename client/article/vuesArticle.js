var actionsVues = (action, reponse) => {

	switch(action){
		case "enregistrer" :
        break;
		case "enlever" :
        break;
		case "modifier" :
			$('#messages').html(reponse.msg);
			setTimeout(function(){ $('#messages').html(""); }, 5000);
		break;
		case "listerCards" :
			listerVuesArticlesCards(reponse.listeArticles);
		break;
        case "listerTab" :
			listerVuesArticlesTab(reponse.listeArticles);
		break;
        case "detailsArticle" :
			afficherModalAvecDetails(reponse.article);
		break;
	}
}

function listerVuesArticlesCards(listeArticles){
    var contenu = $('#contenu');
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

function listerVuesArticlesTab(listeArticles){
    var contenu = $('#contenu');
    contenu.empty();
    var tab = '<table class="table table-hover" id="contenuDynamique">';
    tab += '<thead>';
    tab += '<tr>';
    tab += '<th scope="col">ID Article</th>';
    tab += '<th scope="col">Nom</th>';
    tab += '<th scope="col">Categorie</th>';
    tab += '</tr>';
    tab += '</thead>';
    tab += '<tbody>';
    
    listeArticles.forEach(function (article) {
        tab += remplirTableauArticle(article);
    });

    tab += '</tbody>';
    tab += '</table>';

    contenu.append(tab);
}

function remplirTableauArticle(article){
    var ligne = '<tr onclick="trouverDetailsArticleParId(' + article.ida + ');">';
    ligne += '<th scope="row">' + article.ida + '</th>';
    ligne += '<td>' + article.nom + '</td>';
    ligne += '<td>' + article.categorie + '</td>';
    ligne += '</tr>';

    return ligne;
}

let afficherModalAvecDetails = (article) => {
    document.getElementById('modals').innerHTML = modalDetailsArticle(article);
    const modalDetails = new bootstrap.Modal('#modalDetailsArticle', {
    });
    modalDetails.show();
}

let modalDetailsArticle = (article) => {
    return `
    <div class="modal modal-xl fade" id="modalDetailsArticle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">${article.ida} - ${article.nom}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="../article/photos/${article.photo}" class="photoArticle" alt="...">
                    <p>${article.description}</p>
                    <p>Catégorie: ${article.categorie}</p>
                    <p>Prix: ${article.prix} $</p>
                    <p>État: ${article.etat}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Modifier</button>
                    <button type="button" class="btn btn-secondary">Supprimer</button>
                </div>
            </div>
        </div>
    `;
}