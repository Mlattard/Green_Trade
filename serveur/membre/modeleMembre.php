<?php
    require_once('../bd/connexion.inc.php');

    function Mdl_Ajouter($membre, $mdp){
        global $connexion;
        $nom = $membre->getNom();
        $prenom = $membre->getPrenom();
        $courriel = $membre->getCourriel();
        $sexe = $membre->getSexe();
        $daten = $membre->getDaten();

    try{
        $requete = "INSERT INTO membres VALUES (0, ?, ?, ?, ?, ?)";
        $stmt = $connexion->prepare($requete);
        $stmt->bind_param("sssss", $nom, $prenom, $courriel, $sexe, $daten);
            // le premier argument de bind_param donne le type des arguments passé après: 5 's' car 5 String, on aurait utilisé i pour integer
            $stmt->execute();
            $idm = $connexion->insert_id;
            $requete = "INSERT INTO connexion VALUES (?, ?, ?, ?, ?)";
            $stmt = $connexion->prepare($requete);
            $stmt->bind_param("issss", $idm, $membre->getCourriel(), $mdp, "M", "A");
            $stmt->execute();
            $msg="<h3>Le membre ".$membre->getPrenom()." ".$membre->getNom()." a bien été enregistré</h3>";
        } catch(Exception $e) {
            $msg="Une erreur est survenue lors de l'enregistrement: ".$e->getMessage()."\br";
        } finally {
            return $msg;
        }
    }
?>