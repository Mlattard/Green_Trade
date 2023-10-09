<?php
    require_once(__DIR__.'/../bd/connexion.inc.php');

    function Mdl_Lister(){
        global $connexion;
        try{
            // Tester si le courriel existe et mot de passe aussi
            $requete = "SELECT * FROM articles";
            $stmt = $connexion->prepare($requete);
            $stmt->execute();
            $reponse = $stmt->get_result();
        } catch(Exception $e) {
            return [];
        }finally{
            return $reponse;
        }
    }
?>