<?php

class Article {
    private $ida;
    private $nom;
    private $description;
    private $categorie;
    private $prix;
    private $etat;
    private $photo;
    private $statut;

    // Constructeur
    function __construct($ida, $nom, $description, $categorie, $prix, $etat, $photo, $statut) {
        $this->setIda($ida);
        $this->setNom($nom);
        $this->setDescription($description);
        $this->setCategorie($categorie);
        $this->setPrix($prix);
        $this->setEtat($etat);
        $this->setPhoto($photo);
        $this->setStatut($statut);
    }

    // Getters
    function getIda() { return $this->ida; }
    function getNom() { return $this->nom; }
    function getDescription() { return $this->description; }
    function getCategorie() { return $this->categorie; }
    function getPrix() { return $this->prix; }
    function getEtat() { return $this->etat; }
    function getPhoto() { return $this->photo; }
    function getStatut() { return $this->statut; }

    // Setters
    function setIda($ida) { $this->ida = $ida; }
    function setNom($nom) { $this->nom = $nom; }
    function setDescription($description) { $this->description = $description; }
    function setCategorie($categorie) { $this->categorie = $categorie; }
    function setPrix($prix) { $this->prix = $prix; }
    function setEtat($etat) { $this->etat = $etat; }
    function setPhoto($photo) { $this->photo = $photo; }
    function setStatut($statut) { $this->statut = $statut; }

    // Fonction pour afficher les détails de l'article
    function afficher() {
        $rep = "ID: " . $this->ida . "<br>";
        $rep .= "Nom: " . $this->nom . "<br>";
        $rep .= "Description: " . $this->description . "<br>";
        $rep .= "Catégorie: " . $this->categorie . "<br>";
        $rep .= "Prix: " . $this->prix . "<br>";
        $rep .= "État: " . $this->etat . "<br>";
        $rep .= "Photo: " . $this->photo . "<br>";
        $rep .= "Statut: " . $this->statut . "<br>";
        return $rep;
    }
}
?>
