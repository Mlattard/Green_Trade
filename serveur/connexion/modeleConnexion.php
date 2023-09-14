<?php
    require_once('../bd/connexion.inc.php');

    function Mdl_connexion($courriel, $mdp){
        global $connexion;
        $msg = "";

        try{
            $requete = "SELECT * FROM connexion WHERE courriel = ? AND pass = ?";
            $stmt = $connexion->prepare($requete);
            $stmt->bind_param("s", $courriel, $mdp);
            $stmt->execute();
            $reponse = $stmt->get_result();
            if ($reponse -> num_rows > 0) {
                $ligne = $reponse->fetch_object();
                if($ligne->statut == 'A'){
                    if($ligne->role == 'M'){
                        header('Location: ../membre/membre.php');
                        exit;
                    } else if($ligne->role == 'A'){
                        header('Location: ../admin/admin.php');
                        exit;
                    }
                } else {
                    $msg = "Le membre est inactif. Contactez l'administrateur.";
                }
            }
        } catch(Exception $e) {
            $msg="Une erreur est survenue lors de la connexion: ".$e->getMessage()."\br";
        } finally {
            return $msg;
        }
    }
?>