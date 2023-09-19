<?php
    session_start();
    require_once('modeleConnexion.php');

    function Ctr_Connexion(){
        $courriel = $_POST['courrielConnexion'];
        $mdp = $_POST['mdpConnexion'];

        $msg = Mdl_Connexion($courriel, $mdp);
        return $msg;
    }

    function Ctr_Deconnexion(){
        unset($_SESSION);
        session_destroy();
        header('Location: ../../index.php');
        exit();
    }

    $action = $_POST['action'];
    switch($action){
        case 'connexion':
            echo Ctr_Connexion();
        break;
        case 'deconnexion':
            Ctr_Deconnexion();
        break;
    }
?>

<br/>
<a href="../../index.php">Retour à l'accueil</a>