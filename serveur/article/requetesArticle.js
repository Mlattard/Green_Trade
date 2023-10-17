// requetesArticle.js

let enregistrerArticle = () => {
    let formArticle = new FormData(document.getElementById('formEnreg'));
    formArticle.append('action', 'enregistrer');
    $.ajax({
        type: 'POST',
        url: 'serveur/article/controleurArticle.php',
        data: formArticle,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (reponse) {
            articlesVue(reponse);
        },
        fail: function (err) {
            // Gestion des erreurs
        }
    });
};

let listerArticles = () => {
    let formArticle = new FormData();
    formArticle.append('action', 'lister');
    $.ajax({
        type: 'POST',
        url: 'serveur/article/controleurArticle.php',
        data: formArticle,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (reponse) {
            articlesVue(reponse);
        },
        fail: function (err) {
            // Gestion des erreurs
        }
    });
};

let enleverArticle = () => {
    let leForm = document.getElementById('formEnlever');
    let formArticle = new FormData(leForm);
    formArticle.append('action', 'enlever');
    $.ajax({
        type: 'POST',
        url: 'serveur/article/controleurArticle.php',
        data: formArticle,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (reponse) {
            articlesVue(reponse);
        },
        fail: function (err) {
            // Gestion des erreurs
        }
    });
};

let obtenirFicheArticle = () => {
    $('#divFiche').hide();
    let leForm = document.getElementById('formFiche');
    let formArticle = new FormData(leForm);
    formArticle.append('action', 'fiche');
    $.ajax({
        type: 'POST',
        url: 'serveur/article/controleurArticle.php',
        data: formArticle,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (reponse) {
            articlesVue(reponse);
        },
        fail: function (err) {
            // Gestion des erreurs
        }
    });
};

let modifierArticle = () => {
    let leForm = document.getElementById('formFicheF');
    let formArticle = new FormData(leForm);
    formArticle.append('action', 'modifier');
    $.ajax({
        type: 'POST',
        url: 'serveur/article/controleurArticle.php',
        data: formArticle,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (reponse) {
            $('#divFormFiche').hide();
            articlesVue(reponse);
        },
        fail: function (err) {
            // Gestion des erreurs
        }
    });
};

// Continuez de la même manière pour obtenirFicheArticle et modifierArticle si nécessaire
