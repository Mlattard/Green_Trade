
// Modèle de requete AJAX:

let requeteAjaxIndex = (form) => {
    $.ajax({
        type: 'POST',
        url: 'routes.php',
        data: form,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: (reponse) => {
            actionsVuesIndex(form.get('action'), reponse);
        },
        error: function (xhr, status, error) {
            console.log(error);
            console.log(form.get('action'));
            alert('Erreur de requête : ' + status + ' - ' + error);
        }
    });
};

// Fonctions:

let enregistrerMembre = () => {
    var leForm = document.getElementById('formEnregistrerMembre');
    let form = new FormData(leForm);
    form.append('action', 'enregistrerMembre');
    form.append('route', 'membre');
    $.ajax({
        type: 'POST',
        url: 'routes.php',
        data: form,
        dataType: 'text',
        contentType: false,
        processData: false,
        success: (reponse) => {
            alert('lalala');
            actionsVuesIndex(form.get('action'), reponse);
        },
        error: function (xhr, status, error) {
            console.log(error);
            console.log(form.get('action'));
            alert('Erreur de requête : ' + status + ' - ' + error);
        }
    });
}

let listerArticlesCards = () => {
    let form = new FormData();
    form.append('action', 'listerCardsArticles');
    form.append('route', 'article');
    requeteAjaxIndex(form);
};