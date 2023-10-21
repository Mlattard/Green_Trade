let requeteAjaxIndex = (formArticle) => {
    $.ajax({
        type: 'POST',
        url: 'routes.php',
        data: formArticle,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: (reponse) => {
            actionsVues(formArticle.get('action'), reponse);
        },
        error: function (xhr, status, error) {
            alert('Erreur de requête : ' + status + ' - ' + error);
        }
    });
};

let requeteAjaxAdmin = (formArticle) => {
    $.ajax({
        type: 'POST',
        url: '../../routes.php',
        data: formArticle,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: (reponse) => {
            actionsVues(formArticle.get('action'), reponse);
        },
        error: function (xhr, status, error) {
            alert('Erreur de requête : ' + status + ' - ' + error);
        }
    });
};

let listerArticlesCards = () => {
    let formArticle = new FormData();
    formArticle.append('action', 'listerCards');
    requeteAjaxIndex(formArticle);
};

let listerArticlesTab = () => {
    let formArticle = new FormData();
    formArticle.append('action', 'listerTab');
    requeteAjaxAdmin(formArticle);
};

let obtenirFicheArticle = (articleIda) => {
    let formArticle = new FormData();
    formArticle.append('action', 'ficheArticle');
    formArticle.append('articleIda', articleIda);
    requeteAjaxAdmin(formArticle);
};

let obtenirFormModifier = (articleIda) => {
    let formArticle = new FormData();
    formArticle.append('action', 'formModifier');
    formArticle.append('articleIda', articleIda);
    requeteAjaxAdmin(formArticle);
};

// let enregistrerArticle = () => {
//     let formArticle = new FormData(document.getElementById('formEnreg'));
//     formArticle.append('action', 'enregistrer');
//     requeteAjaxIndex(formArticle);
// };

// let enleverArticle = () => {
//     let leForm = document.getElementById('formEnlever');
//     let formArticle = new FormData(leForm);
//     formArticle.append('action', 'enlever');
//     requeteAjaxIndex(formArticle);
// };

// let modifierArticle = (articleIda) => {
//     let formArticle = new FormData();
//     formArticle.append('action', 'modifierArticle');
//     formArticle.append('articleIda', articleIda);
//     requeteAjaxAdmin(formArticle);
// };