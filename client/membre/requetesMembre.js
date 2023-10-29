
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

let creerPanier = (membreIdm) => {
    let form = new FormData();
    form.append('action', 'creerPanier');
    form.append('route', 'panier');
    form.append('membreIdm', membreIdm);
    requeteAjaxMembre(form);
}

let ajouterPanier = (articleIda) => {
    let form = new FormData();
    form.append('action', 'ajouterPanier');
    form.append('route', 'panier');
    form.append('articleIda', articleIda)
    requeteAjaxMembre(form);
}