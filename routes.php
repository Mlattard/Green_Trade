<?php
    declare (strict_types=1);

    require_once(__DIR__."/serveur/article/controleurArticle.php");
    require_once(__DIR__."/serveur/membre/controleurMembre.php");
    require_once(__DIR__."/serveur/panier/controleurPanier.php");

    if (isset($_POST['route'])) {
        switch($_POST['route']){
            case "article" :
                $instanceCtrl = ControleurArticle::getControleurArticle();
                echo $instanceCtrl->Ctrl_Article_Actions($_POST['action']);
            break;
            case "membre" :
                $instanceCtrl = ControleurMembre::getControleurMembre();
                echo $instanceCtrl->Ctrl_Membre_Actions($_POST['action']);
            break; 
            case "panier" :
                $instanceCtrl = ControleurPanier::getControleurPanier();
                echo $instanceCtrl->Ctrl_Panier_Actions($_POST['action']);
            break; 
            default:
                echo "Route non valide";
            break;
        }
    } else {
        echo "Route non définie dans la requête POST";
    }
?>