<?php
    require_once('../bd/connexion.inc.php');

    function chargerPhoto($nom, $prenom){
        $photo = "avatarMembre.png";
        $dossierPhotos = "photos/";
        $objPhotoRecue = $_FILES['photo'];
   
        echo "Nom: $nom, Prenom: $prenom<br>";
   
        if($objPhotoRecue['tmp_name'][0]!== ""){
            $nouveauNom = sha1($nom.$prenom.time());
            $extension = strrchr($objPhotoRecue['name'][0], ".");
            $photo = $nouveauNom.$extension;
   
            echo "Nouveau Nom: $nouveauNom, Extension: $extension, Photo: $photo<br>";
   
            @move_uploaded_file($objPhotoRecue['tmp_name'][0], $dossierPhotos.$photo);
            if (!file_exists($dossierPhotos.$photo)) {
                $msg = "Erreur lors du téléchargement du fichier.";
            }
        }

        return $photo;
    }
   

    function Mdl_Ajouter($membre, $mdp){
        global $connexion;
        $nom = $membre->getNom();
        $prenom = $membre->getPrenom();
        $courriel = $membre->getCourriel();
        $sexe = $membre->getSexe();
        $daten = $membre->getDaten();
        $msg = "";

        try{
            $requete = "SELECT * FROM membres WHERE courriel = ?";
            $stmt = $connexion->prepare($requete);
            $stmt->bind_param("s", $courriel);
            $stmt->execute();
            $reponse = $stmt->get_result();
            if ($reponse -> num_rows == 0) {
                $photo = chargerPhoto($nom, $prenom);
                $requete = "INSERT INTO membres VALUES (0, ?, ?, ?, ?, ?, ?)";
                $stmt = $connexion->prepare($requete);
                $stmt->bind_param("ssssss", $nom, $prenom, $courriel, $sexe, $daten, $photo);
                // le premier argument de bind_param donne le type des arguments passé après: 6 's' car 6 String,
                // on aurait utilisé i pour integer
                $stmt->execute();
                $idm = $connexion->insert_id;
                
                $requete = "INSERT INTO connexion VALUES (?, ?, ?, 'M', 'A')";
                $stmt = $connexion->prepare($requete);
                $stmt->bind_param("iss", $idm, $courriel, $mdp);
                $stmt->execute();
                $msg = "<h3>Le membre ".$membre->getPrenom()." ".$membre->getNom()." a bien été enregistré</h3>";
            } else {
                $msg = "<h3>Le courriel ".$courriel." est déjà dans la base de donnée</h3>";
            }
        } catch(Exception $e) {
            $msg = "<h3>Une erreur est survenue lors de l'enregistrement: ".$e->getMessage()."\br</h3>";
        } finally {
            return $msg;
        }
    }
?>