let requeteAjaxMembre = (formMembre) => {
    $.ajax({
        type: 'POST',
        url: '../../routes.php',
        data: formMembre,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: (reponse) => {
            console.log(reponse);
            actionsVuesMembre(formMembre.get('action'), reponse);
        },
        error: function (xhr, status, error) {
            alert('Erreur de requête : ' + status + ' - ' + error);
        }
    });
};

let listerMembresTab = () => {
    let formMembre = new FormData();
    formMembre.append('action', 'listerTabM');
    formMembre.append('route', 'membre');
    $.ajax({
        type: 'POST',
        url: '../../routes.php',
        data: formMembre,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: (reponse) => {
            actionsVuesMembre(formMembre.get('action'), reponse);
        },
        error: function (xhr, status, error) {
            alert('Erreur de requête : ' + status + ' - ' + error);
        }
    });
};

let obtenirFicheMembre = (membreIdm) => {
    let formMembre = new FormData();
    formMembre.append('action', 'ficheMembre');
    formMembre.append('route', 'membre');
    formMembre.append('membreIdm', membreIdm);
    $.ajax({
        type: 'POST',
        url: '../../routes.php',
        data: formMembre,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: (reponse) => {
            console.log(reponse);
            actionsVuesMembre(formMembre.get('action'), reponse);
        },
        error: function (xhr, status, error) {
            alert('Erreur de requête : ' + status + ' - ' + error);
        }
    });
};