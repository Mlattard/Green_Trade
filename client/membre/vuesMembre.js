
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





