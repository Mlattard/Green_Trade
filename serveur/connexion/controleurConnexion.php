<?php
    require_once('modeleConnexion.php');

    function Ctr_Connexion(){
        $courriel = $_POST['courrielConnexion'];
        $mdp = $_POST['mdpConnexion'];

        $msg = Mdl_Connexion($courriel, $mdp);
        return $msg;
    }

    $msg = Ctr_Connexion();
    echo $msg;
?>

<br/>
<a href="../../index.php">Retour à l'accueil</a>