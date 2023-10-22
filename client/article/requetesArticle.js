let requeteAjaxIndex = (formArticle) => {
    $.ajax({
        type: 'POST',
        url: 'routes.php',
        data: formArticle,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: (reponse) => {
            actionsVuesArticle(formArticle.get('action'), reponse);
        },
        error: function (xhr, status, error) {
            console.log(error);
            console.log(formArticle.get('action'));
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
            actionsVuesArticle(formArticle.get('action'), reponse);
        },
        error: function (xhr, status, error) {
            console.log(error);
            console.log(formArticle.get('action'));
            alert('Erreur de requête : ' + status + ' - ' + error);
        }
    });
};

let listerArticlesCards = () => {
    let formArticle = new FormData();
    formArticle.append('action', 'listerCards');
    formArticle.append('route', 'article');
    $.ajax({
        type: 'POST',
        url: 'routes.php',
        data: formArticle,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: (reponse) => {
            actionsVuesArticle(formArticle.get('action'), reponse);
        },
        error: function (xhr, status, error) {
            console.log(error);
            console.log(formArticle.get('action'));
            alert('Erreur de requête : ' + status + ' - ' + error);
        }
    });
};

let listerArticlesTab = () => {
    let formArticle = new FormData();
    formArticle.append('action', 'listerTabA');
    formArticle.append('route', 'article');
    requeteAjaxAdmin(formArticle);
};

let obtenirFicheArticle = (articleIda) => {
    let formArticle = new FormData();
    formArticle.append('action', 'ficheArticle');
    formArticle.append('route', 'article');
    formArticle.append('articleIda', articleIda);
    requeteAjaxAdmin(formArticle);
};

let obtenirFormModifier = (articleIda) => {
    let formArticle = new FormData();
    formArticle.append('action', 'formModifier');
    formArticle.append('route', 'article');
    formArticle.append('articleIda', articleIda);
    requeteAjaxAdmin(formArticle);
};

let obtenirFormSupprimer = (articleIda) => {
    let formArticle = new FormData();
    formArticle.append('action', 'formSupprimer');
    formArticle.append('route', 'article');
    formArticle.append('articleIda', articleIda);
    requeteAjaxAdmin(formArticle);
};

let supprimerArticle = (articleIda) => {
    let formArticle = new FormData();
    formArticle.append('action', 'supprimer');
    formArticle.append('route', 'article');
    formArticle.append('articleIda', articleIda);
    $.ajax({
        type: 'POST',
        url: '../../routes.php',
        data: formArticle,
        dataType: 'text',
        contentType: false,
        processData: false,
        success: (reponse) => {
        },
        error: function (xhr, status, error) {
            console.log(error);
            console.log(formArticle.get('action'));
            alert('Erreur de requête : ' + status + ' - ' + error);
        }
    });
};

let envoyerModifArticle = (articleIda) => {
    var leForm = document.getElementById('formModifierArticle');
    let formArticle = new FormData(leForm);
    formArticle.append('action', 'envoyerModif');
    formArticle.append('route', 'article');
    formArticle.append('articleIda', articleIda);
    $.ajax({
        type: 'POST',
        url: '../../routes.php',
        data: formArticle,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: () => {
        },
        error: function (xhr, status, error) {
            console.log(error);
            console.log(formArticle.get('action'));
            alert('Erreur de requête : ' + status + ' - ' + error);
        }
    });
};

let envoyerEnregistrerArticle = () => {
    var leForm = document.getElementById('formEnregistrerArticle');
    let formArticle = new FormData(leForm);
    formArticle.append('action', 'envoyerEnregistrer');
    formArticle.append('route', 'article');
    
    $.ajax({
        type: 'POST',
        url: '../../routes.php',
        data: formArticle,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: (reponse) => {
            alert(formArticle.get('msg'));
        },
        error: function (xhr, status, error) {
            console.log(error);
            alert('Erreur de requête : ' + status + ' - ' + error);
        }
    });
};