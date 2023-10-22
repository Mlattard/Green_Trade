let requeteAjaxMembre = (formMembre) => {
    $.ajax({
        type: 'POST',
        url: '../../routes.php',
        data: formMembre,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: (reponse) => {
            actionsVues(formMembre.get('action'), reponse);
        },
        error: function (xhr, status, error) {
            alert('Erreur de requête : ' + status + ' - ' + error);
        }
    });
};

let listerMembreTab = () => {
    let formMembre = new FormData();
    formMembre.append('action', 'listerMembreTab');
    formMembre.append('route', 'membre');
    requeteAjaxMembre(formMembre);
};