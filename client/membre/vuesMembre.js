
// Liste des actions
var actionsVuesMembre = (action, reponse) => {

	switch(action){
		case "listerTabM" :
			listerVuesMembresTab(reponse.listeMembres);
		break;
        case "changerStatutM":
        case "envoyerModifM" :
        case "ficheMembre" :
			afficherModalFicheM(reponse.membre);
		break;
        case "formModifierM" :
			afficherModalModifierM(reponse.membre);
		break;
        case "formChangerStatutM" :
			afficherModalChangerStatutM(reponse.membre);
		break;   
        case "formEnregistrerArticle" :
            afficherModalEnregistrerArticle();
        break;
		case "enlever" :
        break;
	}
}

// Lister en tableau

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

let afficherModalFicheM = (membre) => {
    document.getElementById('modals').innerHTML = modalFicheMembre(membre);
    const modalFicheM = new bootstrap.Modal('#modalFicheMembre', {
    });
    modalFicheM.show();
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="obtenirFormChangerStatutM(${membre.idm});">Changer Statut</button>
                </div>
            </div>
        </div>
    `;
}

// Modal Form Modifier Membre

let afficherModalModifierM = (membre) => {
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

// Modal Changer Statut Membre

let afficherModalChangerStatutM = (membre) => {
    
    document.getElementById('modals').innerHTML = modalChangerStatutMembre(membre);
    const modalChangerStatut = new bootstrap.Modal('#modalChangerStatutMembre', {
    });	
    modalChangerStatut.show();
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