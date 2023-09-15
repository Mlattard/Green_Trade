<?php
    require_once('../bd/connexion.inc.php');

    function Mdl_connexion($courriel, $mdp){
        global $connexion;
        $msg = "";

        try{
            $requete = "SELECT * FROM connexion WHERE courriel=? AND pass=?";
            $stmt = $connexion->prepare($requete);
            $stmt->bind_param("ss", $courriel, $mdp);
            $stmt->execute();
            $reponse = $stmt->get_result();
            if ($reponse->num_rows > 0) { // OK, courriel et mot de passe existent
                $ligne = $reponse->fetch_object();
                if($ligne->statut == 'A'){
                    if($ligne->role == 'M'){
                        header('Location: ../membre/membre.php');
                        exit();
                    } else { // Dans ce cas c'est un admin
                        header('Location: ../admin/admin.php');
                        exit();
                    }
                } else {// Membre inactif
                    $msg = "<b>SVP contactez l'administrateur !!!</b>";
                }
            } else {
                $msg = '<b>Courriel ou Mot de Passe incorrect</b>';
            }
        } catch(Exception $e) {
            $msg="Une erreur est survenue lors de la connexion: ".$e->getMessage()."\br";
        } finally {
            return $msg;
        }
    }
?>