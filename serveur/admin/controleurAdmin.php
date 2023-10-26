<?php
require_once("modeleAdmin.php");

$tabRes = array();

function enregistrer(){
    global $tabRes;

    // Récupérer les données du formulaire
    $nomProduit = $_POST['nomProduit'];
    $description = $_POST['description'];
    $categorie = $_POST['categorie'];
    $prix = $_POST['prix'];
    $etat = $_POST['etat'];

    try {
        $instanceModele = ModeleDonnees::getInstanceModeleDonnees();
        $requete = "INSERT INTO articles (nomProduit, description, categorie, prix, etat) VALUES (?, ?, ?, ?, ?)";
        $stmt = $instanceModele->executer($requete, [$nomProduit, $description, $categorie, $prix, $etat]);
        $tabRes['action'] = "enregistrer";
        $tabRes['msg'] = "Article bien enregistré";
    } catch (Exception $e) {
        // Gérer les exceptions si nécessaire
    } finally {
        unset($instanceModele);
    }
}

function lister(){
    global $tabRes;

    try {
        $instanceModele = ModeleDonnees::getInstanceModeleDonnees();
        $requete = "SELECT * FROM articles";
        $stmt = $instanceModele->executer($requete, []);
        $tabRes['action'] = "lister";
        $tabRes['listeArticles'] = $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (Exception $e) {
        // Gérer les exceptions si nécessaire
    } finally {
        unset($instanceModele);
    }
}

function enlever(){
    global $tabRes;

    // Récupérer l'ID de l'article à supprimer
    $id = $_POST['numE'];

    try {
        $instanceModele = ModeleDonnees::getInstanceModeleDonnees();
        $requete = "DELETE FROM articles WHERE id = ?";
        $stmt = $instanceModele->executer($requete, [$id]);
        $tabRes['action'] = "enlever";
        $tabRes['msg'] = "Article ".$id." bien enlevé";
    } catch (Exception $e) {
        // Gérer les exceptions si nécessaire
    } finally {
        unset($instanceModele);
    }
}

function fiche(){
    global $tabRes;

    // Récupérer l'ID de l'article à afficher
    $id = $_POST['numF'];

    try {
        $instanceModele = ModeleDonnees::getInstanceModeleDonnees();
        $requete = "SELECT * FROM articles WHERE id = ?";
        $stmt = $instanceModele->executer($requete, [$id]);
        $tabRes['action'] = "fiche";
        $tabRes['fiche'] = $stmt->fetch(PDO::FETCH_OBJ);
        $tabRes['OK'] = ($tabRes['fiche'] !== false);
    } catch (Exception $e) {
        // Gérer les exceptions si nécessaire
    } finally {
        unset($instanceModele);
    }
}

function modifier(){
    global $tabRes;

    // Récupérer les données du formulaire
    $nomProduit = $_POST['nomProduitF'];
    $description = $_POST['descriptionF'];
    $categorie = $_POST['categorieF'];
    $prix = $_POST['prixF'];
    $etat = $_POST['etatF'];
    $id = $_POST['id'];

    try {
        $instanceModele = ModeleDonnees::getInstanceModeleDonnees();
        $requete = "UPDATE articles SET nomProduit=?, description=?, categorie=?, prix=?, etat=? WHERE id=?";
        $stmt = $instanceModele->executer($requete, [$nomProduit, $description, $categorie, $prix, $etat, $id]);
        $tabRes['action'] = "modifier";
        $tabRes['msg'] = "Article $id bien modifié";
    } catch (Exception $e) {
        // Gérer les exceptions si nécessaire
    } finally {
        unset($instanceModele);
    }
}

// Contrôleur
function Ctrl_Admin_Actions($action){
			
    switch($action){
        case "listerCardsArticle" :
            return $this->Ctrl_Article_Lister();
        break;
        case "envoyerEnregistrer" :
            return $this->Ctrl_Article_Enregistrer();
        break;
        case "listerTabA" :
        
        case "formModifier" :
            return $this->Ctrl_Article_Form_Modifier($_POST['articleIda']);
        break;
        case "envoyerModif" :
            return $this->Ctrl_Article_Modifier($_POST['articleIda']);
        break;
        case "formSupprimer" :
            return $this->Ctrl_Article_Form_Supprimer($_POST['articleIda']);
        break;
        case "supprimer" :
            return $this->Ctrl_Article_Supprimer($_POST['articleIda']);
        break;
        case "ficheArticle" :
            return $this->Ctrl_Article_Fiche($_POST['articleIda']);
        break;
    }
}
?>
