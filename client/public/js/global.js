let lister = () => {
    document.getElementById('formLister').submit();
}

let listerMembres = () => {
    document.getElementById('formListerMembres').submit();
}

let validerFormEnregistrer = () => {
    let etat = true;
    const mdp = document.getElementById("mdp");
    const mdpc = document.getElementById("mdpc");

    if (mdp != mdpc){
        etat = false;
        document.getElementById("msgPass").innerHTML = "Mot de passe ne sont pas égaux.";
        setInterval(() => {
            document.getElementById("msgPass").innerHTML = "";
        }, 3000);
    }

    return etat;
}