<?php
    declare (strict_types=1);

    require_once('../bd/connexion.inc.php');

    function Mdl_connexion($courriel, $mdp){
        $msg = "";
        $connexion = Connexion::getInstanceConnexion()->getConnexion();
        
        try{
            $requete = "SELECT * FROM connexion WHERE courriel=? AND pass=?";
            $donnees = [$courriel, $mdp];
            $stmt = $connexion->prepare($requete);
            $stmt->execute($donnees);
            $reponse = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($reponse) {
                if($reponse['statut'] == 'A'){
                    $requete = "SELECT * FROM membres WHERE courriel=?";
                    $donnees = [$courriel];
                    $stmt = $connexion->prepare($requete);
                    $stmt->execute($donnees);
                    $reponse2 = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($reponse['role'] == 'M'){
                        $_SESSION['role'] = 'M';
                        $_SESSION['prenom'] = $ligne2->prenom;
                        $_SESSION['nom'] = $ligne2->nom;
                        $_SESSION['photo'] = "../membre/photos/".$ligne2->photo;
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