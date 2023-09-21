<?php
    require_once('includes/Membre.inc.php');
    require_once('modeleMembre.php');

    function Ctr_Ajouter(){
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $courriel = $_POST['courriel'];
        $sexe = $_POST['sexe'];
        $daten = $_POST['daten'];

        $membre = new Membre(0, $nom, $prenom, $courriel, $sexe, $daten, " ");
        $msg = Mdl_Ajouter($membre, $_POST['mdp']);
        return $msg;
    }

    $msg = Ctr_Ajouter();
    echo $msg;
?>

<br/>
<a href="../../index.php">Retour à l'accueil</a>