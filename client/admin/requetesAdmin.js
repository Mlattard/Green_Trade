
// Modèle de requete AJAX:

let requeteAjaxAdmin = (form) => {
    $.ajax({
        type: 'POST',
        url: '../../routes.php',
        data: form,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: (reponse) => {
            actionsVuesAdmin(form.get('action'), reponse);
        },
        error: function (xhr, status, error) {
            console.log(error);
            alert('Erreur de requête : ' + status + ' - ' + error);
        }
    });
};

// Fonctions CRUD:
// Create Article:

let envoyerEnregistrerArticle = () => {
    var leForm = document.getElementById('formEnregistrerArticle');
    let form = new FormData(leForm);
    form.append('action', 'envoyerEnregistrerArticle');
    form.append('route', 'article');
    $.ajax({
        type: 'POST',
        url: '../../routes.php',
        data: form,
        dataType: 'text',
        contentType: false,
        processData: false,
        success: (reponse) => {
            console.log(reponse);
            actionsVuesAdmin(form.get('action'), reponse);
        },
        error: function (xhr, status, error) {
            console.log(error);
            alert('Erreur de requête : ' + status + ' - ' + error);
        }
    });
};

// Read Article:

let listerArticlesTab = () => {
    let form = new FormData();
    form.append('action', 'listerTabArticles');
    form.append('route', 'article');
    requeteAjaxAdmin(form);
};

let obtenirFicheArticle = (articleIda) => {
    let form = new FormData();
    form.append('action', 'ficheArticle');
    form.append('route', 'article');
    form.append('articleIda', articleIda);
    requeteAjaxAdmin(form);
};

// Read Membre:

let listerMembresTab = () => {
    let form = new FormData();
    form.append('action', 'listerTabMembre');
    form.append('route', 'membre');
    requeteAjaxAdmin(form);
};

let obtenirFicheMembre = (membreIdm) => {
    let form = new FormData();
    form.append('action', 'ficheMembre');
    form.append('route', 'membre');
    form.append('membreIdm', membreIdm);
    requeteAjaxAdmin(form);
};

// Update Article: 

let obtenirFormModifierArticle = (articleIda) => {
    let form = new FormData();
    form.append('action', 'formModifierArticle');
    form.append('route', 'article');
    form.append('articleIda', articleIda);
    requeteAjaxAdmin(form);
};

let obtenirFormChangerStatutArticle = (articleIda) => {
    let form = new FormData();
    form.append('action', 'formChangerStatutArticle');
    form.append('route', 'article');
    form.append('articleIda', articleIda);
    requeteAjaxAdmin(form);
};

let envoyerModifArticle = (articleIda) => {
    var leForm = document.getElementById('formModifierArticle');
    let form = new FormData(leForm);
    form.append('action', 'envoyerModifArticle');
    form.append('route', 'article');
    form.append('articleIda', articleIda);
    requeteAjaxAdmin(form);
};

let changerStatutArticle = (articleIda) => {
    let form = new FormData();
    form.append('action', 'changerStatutArticle');
    form.append('route', 'article');
    form.append('articleIda', articleIda);
    requeteAjaxAdmin(form);
};

// Update Membre:

let obtenirFormModifierM = (membreIdm) => {
    let form = new FormData();
    form.append('action', 'formModifierMembre');
    form.append('route', 'membre');
    form.append('membreIdm', membreIdm);
    requeteAjaxAdmin(form);
};

let obtenirFormChangerStatutM = (membreIdm) => {
    let form = new FormData();
    form.append('action', 'formChangerStatutMembre');
    form.append('route', 'membre');
    form.append('membreIdm', membreIdm);
    requeteAjaxAdmin(form);
};

let envoyerModifMembre = (membreIdm) => {
    var leForm = document.getElementById('formModifierMembre');
    let form = new FormData(leForm);
    form.append('action', 'envoyerModifMembre');
    form.append('route', 'membre');
    form.append('membreIdm', membreIdm);
    requeteAjaxAdmin(form);
};

let changerStatutMembre = (membreIdm) => {
    let form = new FormData();
    form.append('action', 'changerStatutMembre');
    form.append('route', 'membre');
    form.append('membreIdm', membreIdm);
    requeteAjaxAdmin(form);
};

// Delete Article:

let obtenirFormSupprimerArticle = (articleIda) => {
    let form = new FormData();
    form.append('action', 'formSupprimerArticle');
    form.append('route', 'article');
    form.append('articleIda', articleIda);
    requeteAjaxAdmin(form);
};

let supprimerArticle = (articleIda) => {
    let form = new FormData();
    form.append('action', 'supprimerArticle');
    form.append('route', 'article');
    form.append('articleIda', articleIda);
    requeteAjaxAdmin(form);
};