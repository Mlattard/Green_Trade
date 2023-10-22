
// Liste des actions
var actionsVuesMembre = (action, reponse) => {

	switch(action){
		case "listerTabM" :
			listerVuesMembresTab(reponse.listeMembres);
		break;
        case "ficheMembre" :
            console.log(reponse);
			afficherModalFicheM(reponse.membre);
		break;
        case "formEnregistrerArticle" :
            afficherModalEnregistrerArticle();
        break;
		case "enlever" :
        break;
        case "envoyerModif" :
        case "formModifier" :
			afficherModalModifier(reponse.article);
		break;   
        case "formSupprimer" :
			afficherModalSupprimer(reponse.article);
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
    tab += '<th scope="col">ID Membres</th>';
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
                    <p>Date de naissance: ${membre.datenaissance} $</p>
                    <p>Role: ${membre.role}</p>
                    <p>Statut: ${membre.statut}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="obtenirFormModifier(${membre.ida});">Modifier</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="obtenirFormSupprimer(${membre.ida});">Supprimer</button>
                </div>
            </div>
        </div>
    `;
}