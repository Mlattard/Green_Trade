var actionsVues = (action, reponse) => {

	switch(action){
		case "enregistrer" :
        break;
		case "enlever" :
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
        case "modifier" :
			afficherModalModifier(reponse.article);
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
    <div class="modal modal-xl fade" id="modalDetailsArticle" tabindex="-1" aria-labelledby="modalDetailsArticle" aria-hidden="true">
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
                    <button type="button" class="btn btn-secondary" onclick="rendreInvisible('modalDetailsArticle'); modifierArticle(${article.ida});">Modifier</button>
                    <button type="button" class="btn btn-secondary">Supprimer</button>
                </div>
            </div>
        </div>
    `;
}

let afficherModalModifier = (article) => {
    document.getElementById('modals').innerHTML = modalModifierArticle(article);
    const modalModifier = new bootstrap.Modal('#modalModifierArticle', {
    });
    alert(JSON.stringify(article));
	$('#nomProduit').val(article.nom);
	$('#description').val(article.description);
	$('#categorie').val(article.categorie);
	$('#prix').val(article.prix);
    $('#etat').val(article.etat);
    modalModifier.show();
}

let modalModifierArticle = (article) => {
    return `
    <div class="modal modal-xl fade" id="modalModifierArticle" tabindex="-1" aria-labelledby="modalModifierArticle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">${article.ida} - ${article.nom}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="msgErrModifierArticle"></span>
                    <form class="row g-3" id="formModifierArticle">
                        <input type="hidden" value="${article.ida}" id="mdArticleIda">
                        <div class="col-md-12">
                            <label for="nomProduit" class="form-label">Nom du produit</label>
                            <input type="text" class="form-control " id="nomProduit" name="nomProduit" required>
                        </div>
                        <div class="col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control " id="description" name="description" required></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="categorie" class="form-label">Catégorie</label>
                            <input type="text" class="form-control " id="categorie" name="categorie" required>
                        </div>
                        <div class="col-md-12">
                            <label for="prix" class="form-label">Prix</label>
                            <input type="number" min="0" step="0.01" class="form-control " id="prix" name="prix" required>
                        </div>
                        <div class="col-md-12">
                            <label for="etat" class="form-label">État</label>
                            <select class="form-select " id="etat" name="etat" required>
                            <option value="Neuf">Neuf</option>
                            <option value="Occasion">Occasion</option>
                            <option value="Usagé">Usagé</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="photoArticle" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="photoArticle" name="photoArticle">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">Modifier</button>
                </div>
            </div>
        </div>
    `;
}