
// Repartiteur d'actions:

var actionsVuesAdmin = (action, reponse) => {

	switch(action){
        case "listerTabArticles" :
			listerVuesArticlesTab(reponse.listeArticles);
		break;
        case "changerStatutArticle" :
        case "envoyerModifArticle" :
        case "ficheArticle" :
			afficherModalFicheArticle(reponse.article);
		break;
        case "formChangerStatutArticle" :
            afficherModalChangerStatutArticle(reponse.article);
            break;
        case "formEnregistrerArticle" :
            afficherModalEnregistrerArticle();
        break;
        case "formModifierArticle" :
			afficherModalModifierArticle(reponse.article);
		break;
        case "formSupprimerArticle" :
			afficherModalSupprimerArticle(reponse.article);
		break;  
        case "listerTabMembre" :
			listerVuesMembresTab(reponse.listeMembres);
		break;
        case "changerStatutMembre":
        case "envoyerModifMembre" :
        case "ficheMembre" :
			afficherModalFicheMembre(reponse.membre);
		break;
        case "formModifierMembre" :
			afficherModalModifierMembre(reponse.membre);
		break;
        case "formChangerStatutMembre" :
			afficherModalChangerStatutMembre(reponse.membre);
		break;       
	}
}

// CRUD:

// Create:

// Modal Form Enregistrer Article

let afficherModalEnregistrerArticle = () => {
    document.getElementById('modals').innerHTML = modalEnregistrerArticle();
    const modalEnregistrerA = new bootstrap.Modal('#modalEnregistrerArticle', {
    });
    modalEnregistrerA.show();
}

let modalEnregistrerArticle = () => {
    return `
    <div class="modal modal-lg fade" id="modalEnregistrerArticle" tabindex="-1" aria-labelledby="modalEnregistrerArticle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Enregistrer un nouvel article</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="msgErrEnregistrerArticle"></span>                  
                    <form class="row g-3" id="formEnregistrerArticle">
                        <div class="col-md-12">
                            <label for="nomArticle" class="form-label">Nom du produit</label>
                            <input type="text" class="form-control " id="nomArticle" name="nomArticle" required>
                        </div>
                        <div class="col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control " id="description" name="description" required></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="categorie" class="form-label">Catégorie</label>
                            <input type="text" class="form-control " id="categorie" name="categorie" required>
                        </div>
                        <div class="col-md-6">
                            <label for="prix" class="form-label">Prix</label>
                            <input type="number" min="0" step="0.01" class="form-control " id="prix" name="prix" required>
                        </div>
                        <div class="col-md-6">
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
                    <button type="button" class="btn btn-secondary" onclick="envoyerEnregistrerArticle();" data-bs-dismiss="modal">Enregistrer</button>
                    <input type="hidden" name="action" value="enregistrer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    `;
}

// Read:
// Lister articles en tableau

function listerVuesArticlesTab(listeArticles){
    var contenu = $('#contenuAdmin');
    contenu.empty();
    var tab = '<table class="table table-hover" id="contenuDynamique">';
    tab += '<thead>';
    tab += '<tr>';
    tab += '<th scope="col">ID Article</th>';
    tab += '<th scope="col">Nom</th>';
    tab += '<th scope="col">Categorie</th>';
    tab += '<th scope="col">Statut</th>';
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
    var ligne = '<tr onclick="obtenirFicheArticle(' + article.ida + ');">';
    ligne += '<th scope="row">' + article.ida + '</th>';
    ligne += '<td>' + article.nom + '</td>';
    ligne += '<td>' + article.categorie + '</td>';
    ligne += '<td>' + article.statut + '</td>';
    ligne += '</tr>';

    return ligne;
}

// Modal Fiche Article

let afficherModalFicheArticle = (article) => {
    document.getElementById('modals').innerHTML = modalFicheArticle(article);
    const modalFiche = new bootstrap.Modal('#modalFicheArticle');
    modalFiche.show();
    modalFiche._element.addEventListener('hide.bs.modal', event => {
        listerArticlesTab();
    })  
}

let modalFicheArticle = (article) => {
    return `
    <div class="modal modal-xl fade" id="modalFicheArticle" tabindex="-1" aria-labelledby="modalFicheArticle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">${article.ida} - ${article.nom}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="../article/photos/${article.photo}" class="photoArticle" alt="...">
                    <p>Description: ${article.description}</p>
                    <p>Catégorie: ${article.categorie}</p>
                    <p>Prix: ${article.prix} $</p>
                    <p>État: ${article.etat}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="obtenirFormModifierArticle(${article.ida});">Modifier</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="obtenirFormChangerStatutArticle(${article.ida});">Changer le statut</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="obtenirFormSupprimerArticle(${article.ida});">Supprimer</button>
                </div>
            </div>
        </div>
    `;
}

// Lister membres en tableau

function listerVuesMembresTab(listeMembres){
    var contenu = $('#contenuAdmin');
    contenu.empty();
    var tab = '<table class="table table-hover" id="contenuDynamique">';
    tab += '<thead>';
    tab += '<tr>';
    tab += '<th scope="col">ID Membre</th>';
    tab += '<th scope="col">Nom Complet</th>';
    tab += '<th scope="col">Courriel</th>';
    tab += '</tr>';
    tab += '</thead>';
    tab += '<tbody>';
    
    listeMembres.forEach(function (membre) {
        tab += remplirTableauMembres(membre);
    });

    tab += '</tbody>';
    tab += '</table>';

    contenu.append(tab);
}

function remplirTableauMembres(membre){
    var ligne = '<tr onclick="obtenirFicheMembre(' + membre.idm + ');">';
    ligne += '<th scope="row">' + membre.idm + '</th>';
    ligne += '<td>' + membre.nom + ' ' + membre.prenom + '</td>';
    ligne += '<td>' + membre.courriel + '</td>';
    ligne += '</tr>';

    return ligne;
}

// Modal Fiche Membre

let afficherModalFicheMembre = (membre) => {
    document.getElementById('modals').innerHTML = modalFicheMembre(membre);
    const modalFicheM = new bootstrap.Modal('#modalFicheMembre', {
    });
    modalFicheM.show();
    modalFicheM._element.addEventListener('hide.bs.modal', event => {
        listerMembresTab();
    }) 
}

let modalFicheMembre = (membre) => {
    switch(membre.sexe){
		case "M" :
			membre.sexe='Homme'
		break;
        case "F" :
			membre.sexe='Femme'
		break;
    }

    switch(membre.role){
		case "A" :
			membre.role='Administrateur'
		break;
        case "M" :
			membre.sexe='Membre'
		break;
        case "U" :
			membre.sexe='Usager'
		break;
    }

    switch(membre.statut){
		case "A" :
			membre.statut='Actif'
		break;
        case "I" :
			membre.statut='Inactif'
		break;
    }

    return `
    <div class="modal modal-xl fade" id="modalFicheMembre" tabindex="-1" aria-labelledby="modalFicheMembre" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">${membre.idm} - ${membre.nom} ${membre.prenom}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="../membre/photos/${membre.photo}" class="photoMembre" alt="...">
                    <p>Courriel: ${membre.courriel}</p>
                    <p>Sexe: ${membre.sexe}</p>
                    <p>Date de naissance: ${membre.datenaissance}</p>
                    <p>Role: ${membre.role}</p>
                    <p>Statut: ${membre.statut}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="obtenirFormModifierM(${membre.idm});">Modifier</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="obtenirFormChangerStatutM(${membre.idm});">Changer le statut</button>
                </div>
            </div>
        </div>
    `;
}

// Update:
// Modal Form Modifier Article

let afficherModalModifierArticle = (article) => {
    document.getElementById('modals').innerHTML = modalModifierArticle(article);
    const modalModifierA = new bootstrap.Modal('#modalModifierArticle', {
    });
	$('#nomArticle').val(article.nom);
	$('#description').val(article.description);
	$('#categorie').val(article.categorie);
	$('#prix').val(article.prix);
    $('#etat').val(article.etat);

    modalModifierA.show();
}

let modalModifierArticle = (article) => {
    return `
    <div class="modal modal-lg fade" id="modalModifierArticle" tabindex="-1" aria-labelledby="modalModifierArticle" aria-hidden="true">
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
                        <input type="hidden" value="${article.statut}" id="statut" name="statut">
                        <div class="col-md-12">
                            <label for="nomArticle" class="form-label">Nom du produit</label>
                            <input type="text" class="form-control " id="nomArticle" name="nomArticle" required>
                        </div>
                        <div class="col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control " id="description" name="description" required></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="categorie" class="form-label">Catégorie</label>
                            <input type="text" class="form-control " id="categorie" name="categorie" required>
                        </div>
                        <div class="col-md-6">
                            <label for="prix" class="form-label">Prix</label>
                            <input type="number" min="0" step="0.01" class="form-control " id="prix" name="prix" required>
                        </div>
                        <div class="col-md-6">
                            <label for="etat" class="form-label">État</label>
                            <select class="form-select " id="etat" name="etat" required>
                            <option value="Neuf">Neuf</option>
                            <option value="Occasion">Occasion</option>
                            <option value="Usagé">Usagé</option>
                            </select>
                        </div>
                        <div class="col-md-12 divPhotoArticle">
                            <img src="../article/photos/${article.photo}" class="photoArticle" alt="...">
                            <div>
                                <label for="photoArticle" class="form-label">Photo</label>
                                <input type="file" class="form-control" id="photoArticle" name="photoArticle">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="envoyerModifArticle(${article.ida});" data-bs-dismiss="modal">Modifier</button>
                    <input type="hidden" name="action" value="modifier">
                </div>
            </div>
        </div>
    `;
}

// Modal Form Modifier Membre

let afficherModalModifierMembre = (membre) => {
    document.getElementById('modals').innerHTML = modalModifierMembre(membre);
    const modalModifierM = new bootstrap.Modal('#modalModifierMembre', {
    });
	$('#nomMembre').val(membre.nom);
    $('#prenomMembre').val(membre.prenom);
    $('#courrielMembre').val(membre.courriel);
	$('#sexeMembre').val(membre.sexe);

    var dateInput = document.getElementById("dateNaissanceMembre");
    dateInput.valueAsDate = new Date(membre.datenaissance);;

    modalModifierM.show();
}

let modalModifierMembre = (membre) => {
    return `
    <div class="modal modal-xl fade" id="modalModifierMembre" tabindex="-1" aria-labelledby="modalModifierMembre" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">${membre.idm} - ${membre.nom} ${membre.prenom}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="msgErrModifierMembre"></span>
                    <form class="row g-3" id="formModifierMembre">
                        <input type="hidden" value="${membre.idm}" id="mdMembreIdm">
                        <div class="col-md-6">
                            <label for="nomMembre" class="form-label">Nom du membre</label>
                            <input type="text" class="form-control " id="nomMembre" name="nomMembre" required>
                        </div>
                        <div class="col-md-6">
                            <label for="prenomMembre" class="form-label">Prénom du membre</label>
                            <input class="form-control " id="prenomMembre" name="prenomMembre" required></input>
                        </div>
                        <div class="col-md-12">
                            <label for="courrielMembre" class="form-label">Courriel</label>
                            <input type="text" class="form-control " id="courrielMembre" name="courrielMembre" required>
                        </div>

                        <div class="col-md-6">
                            <label for="sexeMembre" class="form-label">Sexe</label>
                            <select class="form-select " id="sexeMembre" name="sexeMembre" required>
                                <option value="M">Homme</option>
                                <option value="F">Femme</option>
                                <option value="A">Autre</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="dateNaissanceMembre" class="form-label">Date de naissance</label>
                            <input type="date" class="form-control" id="dateNaissanceMembre" name="dateNaissanceMembre">
                        </div>
                        <div class="col-md-12">
                            <label for="photoMembre" class="form-label">Ajouter votre photo</label>
                            <input type="file" class="form-control" id="photoMembre" name="photoMembre">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="envoyerModifMembre(${membre.idm});" data-bs-dismiss="modal">Modifier</button>
                    <input type="hidden" name="action" value="modifier">
                </div>
            </div>
        </div>
    `;
}

// Modal Changer Statut Article

let afficherModalChangerStatutArticle = (article) => {
    
    document.getElementById('modals').innerHTML = modalChangerStatutArticle(article);
    const modalChangerStatutA = new bootstrap.Modal('#modalChangerStatutArticle', {
    });	
    modalChangerStatutA.show();
}

let modalChangerStatutArticle = (article) => {
    switch(article.statut){
		case "A" :
			article.statut='Actif'
		break;
        case "I" :
			article.statut='Inactif'
		break;
    }

    return `
    <div class="modal modal-xl fade" id="modalChangerStatutArticle" tabindex="-1" aria-labelledby="modalChangerStatutArticle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Changer le statut de l'article</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="msgErrChangerStatutArticle"></span>
                    <p>Le statut de ${article.ida} - ${article.nom} est actuellement : ${article.statut}</p>
                    <p>Êtes-vous sûr de vouloir changer son statut ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="changerStatutArticle(${article.ida});" data-bs-dismiss="modal">Confirmer</button>
                    <input type="hidden" name="action" value="changerStatut">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>
    `;
}

// Modal Changer Statut Membre

let afficherModalChangerStatutMembre = (membre) => {
    
    document.getElementById('modals').innerHTML = modalChangerStatutMembre(membre);
    const modalChangerStatutM = new bootstrap.Modal('#modalChangerStatutMembre', {
    });	
    modalChangerStatutM.show();
}

let modalChangerStatutMembre = (membre) => {
    switch(membre.statut){
		case "A" :
			membre.statut='Actif'
		break;
        case "I" :
			membre.statut='Inactif'
		break;
    }

    return `
    <div class="modal modal-xl fade" id="modalChangerStatutMembre" tabindex="-1" aria-labelledby="modalChangerStatutMembre" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Changer le statut du membre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="msgErrChangerStatutMembre"></span>
                    <p>Le statut de ${membre.nom} ${membre.prenom} est actuellement : ${membre.statut}</p>
                    <p>Êtes-vous sûr de vouloir changer son statut ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="changerStatutMembre(${membre.idm});" data-bs-dismiss="modal">Confirmer</button>
                    <input type="hidden" name="action" value="changerStatut">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>
    `;
}

// Delete:
// Modal Supprimer Article

let afficherModalSupprimerArticle = (article) => {
    console.log(article);
    document.getElementById('modals').innerHTML = modalSupprimerArticle(article);
    const modalSupprimerA = new bootstrap.Modal('#modalSupprimerArticle', {
    });	
    modalSupprimerA.show();
}

let modalSupprimerArticle = (article) => {
    return `
    <div class="modal modal-xl fade" id="modalSupprimerArticle" tabindex="-1" aria-labelledby="modalSupprimerArticle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Supprimer un article</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="msgErrSupprimerArticle"></span>
                    <p>Êtes-vous sûr de vouloir supprimer l'article: ${article.ida} - ${article.nom} ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="supprimerArticle(${article.ida});" data-bs-dismiss="modal">Supprimer</button>
                    <input type="hidden" name="action" value="modifier">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>
    `;
}