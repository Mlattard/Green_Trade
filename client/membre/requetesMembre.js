
// Modèle de requete AJAX:

let requeteAjaxMembre = (form) => {
    $.ajax({
        type: 'POST',
        url: '../../routes.php',
        data: form,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: (reponse) => {
            console.log(reponse);
            actionsVuesMembre(form.get('action'), reponse);
        },
        error: function (xhr, status, error) {
            console.log(error);
            console.log(form.get('action'));
            alert('Erreur de requête : ' + status + ' - ' + error);
        }
    });
};

// Fonctions:

let listerArticlesCards = () => {
    let form = new FormData();
    form.append('action', 'listerCardsArticles');
    form.append('route', 'article');
    requeteAjaxMembre(form);
};