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
                    //obtenir les infos du membre
                    $requete = "SELECT * FROM connexion WHERE courriel=?";
                    $stmt = $connexion->prepare($requete);
                    $stmt->bind_param("s", $courriel);
                    $stmt->execute();
                    $reponse = $stmt->get_result();
                    $ligne2 = $reponse -> fetch_objet();
                    if($ligne->role == 'M'){
                        $_SESSION['role'] = 'M';
                        $_SESSION['prenom'] = $ligne2->prenom;
                        $_SESSION['nom'] = $ligne2->nom;
                        header('Location: ../membre/membre.php');
                        exit();
                    } else { // Dans ce cas c'est un admin
                        $_SESSION['role']= 'A';
                        $_SESSION['prenom'] = $ligne->prenom;
                        $_SESSION['nom'] = $ligne->nom;
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