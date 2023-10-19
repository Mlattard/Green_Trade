<?php
    require_once('includes/Membre.inc.php');
    require_once('daoMembre.php');

    function Ctrl_Membre_Enregistrer(){
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $courriel = $_POST['courriel'];
        $sexe = $_POST['sexe'];
        $daten = $_POST['daten'];
        
        $membre = new Membre(0, $nom, $prenom, $courriel, $sexe, $daten, " ");
        $msg = DaoMembre::getDaoMembre()->Dao_Membre_Enregistrer($membre, $_POST['mdp']);
        echo $msg;
    }
    
    function Ctrl_Membre_Modifier(){

    }

    function Ctrl_Membre_Desactiver(){

    }

    $action=$_POST['action'];

    switch($action){
        case "enregistrer" :
            Ctrl_Membre_Enregistrer();
        break;
        case "modifier" :
            Ctrl_Membre_Modifier();
        break;
        case "desactiver" :
            Ctrl_Membre_Desactiver();
        break; 
    }     
    
?>

<br/>
<a href="../../index.php">Retour à l'accueil</a>