<?php
    require_once('../env/env.inc.php');
    
    // avec l'API mysqli
    $connexion = new mysqli(SERVEUR, USAGER, MDP, BD);
    if($connexion->connect_errno){
        echo "Problème de connexion au serveur";
        exit();
    }

    // avec l'API PDO
?>