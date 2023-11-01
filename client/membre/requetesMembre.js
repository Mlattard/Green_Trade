
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

let listerArticlesCards = (membreIdm) => {
    let form = new FormData();
    form.append('action', 'listerCardsArticles');
    form.append('membreIdm', membreIdm);
    form.append('route', 'article');
    $.ajax({
        type: 'POST',
        url: '../../routes.php',
        data: form,
        dataType: 'json',
        contentType: false,
        processData: false,
        async: false,
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

let creerPanier = (membreIdm) => {
    let form = new FormData();
    form.append('action', 'creerPanier');
    form.append('route', 'panier');
    form.append('membreIdm', membreIdm);
    $.ajax({
        type: 'POST',
        url: '../../routes.php',
        data: form,
        dataType: 'json',
        contentType: false,
        processData: false,
        async: false,
        success: (reponse) => {
            actionsVuesMembre(form.get('action'), reponse);
        },
        error: function (xhr, status, error) {
            console.log(error);
            console.log(form.get('action'));
            alert('Erreur de requête : ' + status + ' - ' + error);
        }
    });
}

let afficherPanier = (membreIdm) => {
    let form = new FormData();
    form.append('action', 'afficherPanier');
    form.append('route', 'panier');
    form.append('membreIdm', membreIdm);
    $.ajax({
        type: 'POST',
        url: '../../routes.php',
        data: form,
        dataType: 'json',
        contentType: false,
        processData: false,
        async: false,
        success: (reponse) => {
            actionsVuesMembre(form.get('action'), reponse);
        },
        error: function (xhr, status, error) {
            console.log(error);
            console.log(form.get('action'));
            alert('Erreur de requête : ' + status + ' - ' + error);
        }
    });
}

let ajouterPanier = (articleIda, panierIdp, membreIdm) => {
    console.log('ajouterPanier: ');
    console.log(panierIdp);
    let form = new FormData();
    form.append('action', 'ajouterPanier');
    form.append('route', 'panier');
    form.append('panierIdp', panierIdp);
    form.append('membreIdm', membreIdm);
    form.append('articleIda', articleIda);
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
}

let enleverArticlePanier = (articleIda, panierIdp) => {
    let form = new FormData();
    form.append('action', 'enleverArticlePanier');
    form.append('route', 'panier');
    form.append('panierIdp', panierIdp);
    form.append('articleIda', articleIda);
    $.ajax({
        type: 'POST',
        url: '../../routes.php',
        data: form,
        dataType: 'json',
        contentType: false,
        processData: false,
        async: false,
        success: (reponse) => {
            actionsVuesMembre(form.get('action'), reponse);
        },
        error: function (xhr, status, error) {
            console.log(error);
            console.log(form.get('action'));
            alert('Erreur de requête : ' + status + ' - ' + error);
        }
    });
}

let afficherCommandesPassees = (membreIdm) => {
    let form = new FormData();
    form.append('action', 'afficherCommandesPassees');
    form.append('route', 'panier');
    form.append('membreIdm', membreIdm);
    $.ajax({
        type: 'POST',
        url: '../../routes.php',
        data: form,
        dataType: 'json',
        contentType: false,
        processData: false,
        async: false,
        success: (reponse) => {
            actionsVuesMembre(form.get('action'), reponse);
        },
        error: function (xhr, status, error) {
            console.log(error);
            console.log(form.get('action'));
            alert('Erreur de requête : ' + status + ' - ' + error);
        }
    });
}

let obtenirDetailsPanier = (membreIdm, panierIdp) => {
    let form = new FormData();
    form.append('action', 'obtenirDetailsPanier');
    form.append('route', 'panier');
    form.append('membreIdm', membreIdm);
    form.append('panierIdp', panierIdp);
    $.ajax({
        type: 'POST',
        url: '../../routes.php',
        data: form,
        dataType: 'json',
        contentType: false,
        processData: false,
        async: false,
        success: (reponse) => {
            actionsVuesMembre(form.get('action'), reponse);
        },
        error: function (xhr, status, error) {
            console.log(error);
            console.log(form.get('action'));
            alert('Erreur de requête : ' + status + ' - ' + error);
        }
    });
}

let desactiverPanier = (panierIdp) => {
    let form = new FormData();
    form.append('action', 'desactiverPanier');
    form.append('route', 'panier');
    form.append('panierIdp', panierIdp);
    $.ajax({
        type: 'POST',
        url: '../../routes.php',
        data: form,
        dataType: 'json',
        contentType: false,
        processData: false,
        async: false,
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
}