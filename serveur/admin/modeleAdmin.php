<?php

require_once("connexion.inc.php");

class ModeleAdmin
{
    private static $instance;

    // Singleton d'instance de la classe ModeleAdmin
    private function __construct()
    {
    }

    public static function getInstanceModeleAdmin()
    {
        if (self::$instance == null) {
            self::$instance = new ModeleAdmin();
        }
        return self::$instance;
    }

    // Méthodes pour gérer les articles

    function enregistrerArticle($nom, $description, $categorie, $prix, $etat)
    {
        $connexion = Connexion::getInstanceConnexion()->getConnexion();
        $requete = "INSERT INTO articles (nom, description, categorie, prix, etat) VALUES (?, ?, ?, ?, ?)";
        $stmt = $connexion->prepare($requete);
        $stmt->execute([$nom, $description, $categorie, $prix, $etat]);
        Connexion::getInstanceConnexion()->deconnexion();
        return $stmt;
    }

    function listerArticles()
    {
        $connexion = Connexion::getInstanceConnexion()->getConnexion();
        $requete = "SELECT * FROM articles";
        $stmt = $connexion->prepare($requete);
        $stmt->execute();
        Connexion::getInstanceConnexion()->deconnexion();
        return $stmt;
    }

    function enleverArticle($id)
    {
        $connexion = Connexion::getInstanceConnexion()->getConnexion();
        $requete = "DELETE FROM articles WHERE id = ?";
        $stmt = $connexion->prepare($requete);
        $stmt->execute([$id]);
        Connexion::getInstanceConnexion()->deconnexion();
        return $stmt;
    }

    function getFicheArticle($ida)
    {
        $connexion = Connexion::getInstanceConnexion()->getConnexion();
        $requete = "SELECT * FROM articles WHERE ida = ?";
        $stmt = $connexion->prepare($requete);
        $stmt->execute([$ida]);
        Connexion::getInstanceConnexion()->deconnexion();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    function modifierArticle($nom, $description, $categorie, $prix, $etat, $id)
    {
        $connexion = Connexion::getInstanceConnexion()->getConnexion();
        $requete = "UPDATE articles SET nom=?, description=?, categorie=?, prix=?, etat=? WHERE id=?";
        $stmt = $connexion->prepare($requete);
        $stmt->execute([$nom, $description, $categorie, $prix, $etat, $id]);
        Connexion::getInstanceConnexion()->deconnexion();
        return $stmt;
    }
}
?>
