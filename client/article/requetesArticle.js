let requeteAjax = (formArticle) => {
    $.ajax({
        type: 'POST',
        url: 'routes.php',
        data: formArticle,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: (reponse) => {    
            actionsVues("lister", reponse);
        },
        error: function (err) {
        }
    });
}

let listerArticles = () => {
    let formArticle = new FormData();
    formArticle.append('action', 'lister');
    requeteAjax(formArticle);
};

let enregistrerArticle = () => {
    let formArticle = new FormData(document.getElementById('formEnreg'));
    formArticle.append('action', 'enregistrer');
    requeteAjax(formArticle);
};

let enleverArticle = () => {
    let leForm = document.getElementById('formEnlever');
    let formArticle = new FormData(leForm);
    formArticle.append('action', 'enlever');
    requeteAjax(formArticle);
};

let obtenirFicheArticle = () => {
    $('#divFiche').hide();
    let leForm = document.getElementById('formFiche');
    let formArticle = new FormData(leForm);
    formArticle.append('action', 'fiche');
    requeteAjax(formArticle);
};

let modifierArticle = () => {
    let leForm = document.getElementById('formFicheF');
    let formArticle = new FormData(leForm);
    formArticle.append('action', 'modifier');
    requeteAjax(formArticle);
};
