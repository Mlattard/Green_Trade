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
            actionsVuesMembre(formMembre.get('action'), reponse);
        },
        error: function (xhr, status, error) {
            alert(formMembre.get('membre'));
            alert('Erreur de requête : ' + status + ' - ' + error);
        }
    });
};

let obtenirFormModifierM = (membreIdm) => {
    let formMembre = new FormData();
    formMembre.append('action', 'formModifierM');
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
            actionsVuesMembre(formMembre.get('action'), reponse);
        },
        error: function (xhr, status, error) {
            alert(formMembre.get('membre'));
            alert('Erreur de requête : ' + status + ' - ' + error);
        }
    });
};

let obtenirFormChangerStatutM = (membreIdm) => {
    let formMembre = new FormData();
    formMembre.append('action', 'formChangerStatutM');
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
            actionsVuesMembre(formMembre.get('action'), reponse);
        },
        error: function (xhr, status, error) {
            alert(formMembre.get('membre'));
            alert('Erreur de requête : ' + status + ' - ' + error);
        }
    });
};

let envoyerModifMembre = (membreIdm) => {
    var leForm = document.getElementById('formModifierMembre');
    let formMembre = new FormData(leForm);
    formMembre.append('action', 'envoyerModifM');
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
            actionsVuesMembre(formMembre.get('action'), reponse);
        },
        error: function (xhr, status, error) {
            alert('Erreur de requête : ' + status + ' - ' + error);
        }
    });
};

let changerStatutMembre = (membreIdm) => {
    let formMembre = new FormData();
    formMembre.append('action', 'changerStatutM');
    formMembre.append('route', 'membre');
    formMembre.append('membreIdm', membreIdm);
    $.ajax({
        type: 'POST',
        url: '../../routes.php',
        data: formMembre,
        dataType: 'text',
        contentType: false,
        processData: false,
        success: (reponse) => {
            alert(reponse);
        },
        error: function (xhr, status, error) {
            alert('Erreur de requête : ' + status + ' - ' + error);
        }
    });
};

