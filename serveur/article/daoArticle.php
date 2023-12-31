<?php

declare (strict_types=1);

require_once(__DIR__."/../bd/connexion.inc.php");
require_once(__DIR__."/includes/Article.inc.php");

class DaoArticle {

    // Construction Dao:

    static private $instanceDaoArticle = null;
    
    private $reponse = array();
    private $connexion = null;
	
    private function __construct(){}
    
	static function getDaoArticle():DaoArticle {
		if(self::$instanceDaoArticle == null){
			self::$instanceDaoArticle = new DaoArticle();
		}
		return self::$instanceDaoArticle;
	}

    // Méthodes:

    function chargerPhotoArticle($nom){
        $photo = "logo.png";
        $dossierPhotos = "serveur/article/photos/";
        $objPhotoRecue = $_FILES['photoArticle'];
   
        if($objPhotoRecue['tmp_name']!== ""){
            $nouveauNom = $nom.time();
            $extension = strrchr($objPhotoRecue['name'], ".");
   
            $photo = $nouveauNom.$extension;

            try {
                @move_uploaded_file($objPhotoRecue['tmp_name'], $dossierPhotos.$photo);
                if (!file_exists($dossierPhotos.$photo)) {
                    $this->reponse['msg'] = "Erreur lors du téléchargement du fichier.";
                }
            } catch(Exception $e) {
                $this->reponse['msg'] = "Mauvais chemin";
            } 
        }
        return $photo;
    }

    function chargerPhotoArticleModifie($existante){
        $photo = $existante;
        $dossierPhotos = "serveur/article/photos/";
        $objPhotoRecue = $_FILES['photoArticle'];
   
        if($objPhotoRecue['tmp_name']!== ""){
            $nouveauNom = pathinfo($objPhotoRecue['name'], PATHINFO_FILENAME).time();
            $extension = strrchr($objPhotoRecue['name'], ".");
   
            $photo = $nouveauNom.$extension;

            try {
                @move_uploaded_file($objPhotoRecue['tmp_name'], $dossierPhotos.$photo);
                if (!file_exists($dossierPhotos.$photo)) {
                    $this->reponse['msg'] = "Erreur lors du téléchargement du fichier.";
                }
            } catch(Exception $e) {
                $this->reponse['msg'] = "Mauvais chemin";
            } 
        }
        return $photo;
    }

    // CRUD:
    // Create:

    function Dao_Article_Enregistrer($article):string {
             
        $nom = $article->getNom();
        $description = $article->getDescription();
        $categorie = $article->getCategorie();
        $prix = $article->getPrix();
        $etat = $article->getEtat();

        $connexion = Connexion::getInstanceConnexion()->getConnexion();
        $photo = self::chargerPhotoArticle($nom);
        $requete = "INSERT INTO articles (nom, description, categorie, prix, etat, photo, statut) VALUES (?, ?, ?, ?, ?, ?, 'A')";
        try{
            $donnees = [$nom, $description, $categorie, $prix, $etat, $photo];
            $stmt = $connexion->prepare($requete);
            $stmt->execute($donnees);
            
            $this->reponse['OK'] = true;
            $this->reponse['msg'] = "Article enregistré avec succès";
        }catch (Exception $e){
            $this->reponse['OK'] = false;
            $this->reponse['msg'] = "Erreur lors de l'enregistrement de l'article : " . $e->getMessage();;
        }finally {
            unset($connexion);
            return json_encode($this->reponse);
        }
    }

    // Read:

    function Dao_Article_Lister($action, $membreIdm):string {

        $connexion = Connexion::getInstanceConnexion()->getConnexion();
        $requete = "SELECT * FROM articles";
        try{
            $stmt = $connexion->prepare($requete);
            $stmt->execute();
            $this->reponse['OK'] = true;
            $this->reponse['msg'] = "";
            $this->reponse['action'] = $action;
            $this->reponse['membreIdm'] = $membreIdm;
            $this->reponse['listeArticles'] = array();
            while($ligne = $stmt->fetch(PDO::FETCH_OBJ)){
                $this->reponse['listeArticles'][] = $ligne;
            }
            if ($membreIdm != null) {
                try{
                    $requete2 = "SELECT * FROM paniers WHERE idm = ".$membreIdm." AND statut = 'A'";
                    $stmt2 = $connexion->prepare($requete2);
                    $stmt2->execute();
                    $this->reponse['OK'] = true;
                    $this->reponse['msg'] = "";              
                    $this->reponse['panier'] = $stmt2->fetch(PDO::FETCH_OBJ);
                }catch (Exception $e){
                    $this->reponse['OK'] = false;
                    $this->reponse['msg'] = "Problème pour obtenir les données des articles";
                }
            }
        }catch (Exception $e){
            $this->reponse['OK'] = false;
            $this->reponse['msg'] = "Problème pour obtenir les données des articles";
        }finally {
            unset($connexion);
            return json_encode($this->reponse);
        }
    }

    function Dao_Article_Fiche($articleIda){
        $connexion = Connexion::getInstanceConnexion()->getConnexion();
        $requete = "SELECT * FROM articles WHERE ida=".$articleIda;
        try{
            $stmt = $connexion->prepare($requete);
            $stmt->execute();
            $this->reponse['OK'] = true;
            $this->reponse['msg'] = "";
            $this->reponse['action'] = "ficheArticle";
            $this->reponse['article'] = $stmt->fetch(PDO::FETCH_OBJ);
            
        }catch (Exception $e){
            $this->reponse['OK'] = false;
            $this->reponse['msg'] = "Problème pour obtenir les données des articles";
        }finally {
            unset($connexion);
            return json_encode($this->reponse);
        }
    }

    // Update:

	function Dao_Article_Form_Modifier($articleIda):string {
        $connexion = Connexion::getInstanceConnexion()->getConnexion();
        $requete = "SELECT * FROM articles WHERE ida=".$articleIda;
        
        $this->reponse = [
            'OK' => false,
            'msg' => "",
            'action' => "",
            'article' => null,
        ];

        try{
            $stmt = $connexion->prepare($requete);
            $stmt->execute();
            $this->reponse['OK'] = true;
            $this->reponse['msg'] = "";
            $this->reponse['action'] = "formModifierArticle";
            $this->reponse['article'] = $stmt->fetch(PDO::FETCH_OBJ);
        }catch (Exception $e){
            $this->reponse['OK'] = false;
            $this->reponse['msg'] = "Problème pour obtenir les données des articles";
        }finally {
            unset($connexion);
            return json_encode($this->reponse);
        }
    }

    function Dao_Article_Modifier($article):string {

        $ida = $article->getIda();
        $nom = $article->getNom();
        $description = $article->getDescription();
        $categorie = $article->getCategorie();
        $prix = $article->getPrix();
        $etat = $article->getEtat();
        $statut = $article->getStatut();

        $connexion = Connexion::getInstanceConnexion()->getConnexion();
        $requete = "SELECT * FROM articles WHERE ida=".$ida;

        $this->reponse = [
            'OK' => false,
            'msg' => "",
            'action' => "",
            'article' => null,
        ];

        try{
			$stmt = $connexion->prepare($requete);
            $stmt->execute();
			
            $anciennePhoto = $stmt->fetch(PDO::FETCH_OBJ)->photo;
            $photo = self::chargerPhotoArticleModifie($anciennePhoto);
			
			$requete2 = "UPDATE articles SET nom=?, description=?, categorie=?, prix=?, etat=?, photo=?, statut=? WHERE ida=".$ida;
			try{
                $donnees2 = [$nom, $description, $categorie, $prix, $etat, $photo, $statut];
                $stmt2 = $connexion->prepare($requete2);
                $stmt2->execute($donnees2);
                try{
                    $requete3 = "SELECT * FROM articles WHERE ida=".$ida;
                    $stmt3 = $connexion->prepare($requete3);
                    $stmt3->execute();
                    
                    $this->reponse['article'] = $stmt3->fetch(PDO::FETCH_OBJ);
                    $this->reponse['OK'] = true;
                    $this->reponse['msg'] = "";
                    $this->reponse['action'] = "envoyerModifArticle";
                }catch(Exception $e){
                    $this->reponse['OK'] = false;
                    $this->reponse['msg'] = "Problème requete3";
                }
            }catch(Exception $e){
                $this->reponse['OK'] = false;
                $this->reponse['msg'] = "Problème requete2";
            }         
		}catch(Exception $e){
            $this->reponse['OK'] = false;
            $this->reponse['msg'] = "Problème requete1";
		}finally{
			unset($connexion);
            return json_encode($this->reponse);
		}
    }

    function Dao_Article_Form_Changer_Statut($articleIda){
        $connexion = Connexion::getInstanceConnexion()->getConnexion();
        $requete = "SELECT * FROM articles WHERE ida = ".$articleIda;
        try{
            $stmt = $connexion->prepare($requete);
            $stmt->execute();
            $this->reponse['OK'] = true;
            $this->reponse['msg'] = "";
            $this->reponse['action'] = "formChangerStatutArticle";
            $this->reponse['article'] = $stmt->fetch(PDO::FETCH_OBJ);
        }catch (Exception $e){
            $this->reponse['requete'] = $requete;
            $this->reponse['OK'] = false;
            $this->reponse['msg'] = "Problème pour obtenir les données des articles";
        }finally {
            unset($connexion);

            return json_encode($this->reponse);
        }
    }

    function Dao_Article_Changer_Statut($articleIda):string {
        $connexion = Connexion::getInstanceConnexion()->getConnexion();
        $requete = "SELECT * FROM articles WHERE ida=".$articleIda;

        $this->reponse = [
            'OK' => false,
            'msg' => "debut",
            'action' => "",
            'statutArticle' => null,
        ];

        try{
            $stmt = $connexion->prepare($requete);
            $stmt->execute();
            $this->reponse['statutArticle'] = $stmt->fetch(PDO::FETCH_OBJ)->statut;

            switch($this->reponse['statutArticle']){
                case "A" :
                    $this->reponse['statutArticle'] = 'I';
                break;
                case "I" :
                    $this->reponse['statutArticle'] = 'A';
                break;
                }
            $requete2 = "UPDATE articles SET statut='".$this->reponse['statutArticle']."' WHERE ida=".$articleIda;
            try{
                $stmt2 = $connexion->prepare($requete2);
                $stmt2->execute();
                $requete3 = "SELECT * FROM articles WHERE ida = ".$articleIda;
                try{
                    $stmt3 = $connexion->prepare($requete3);
                    $stmt3->execute();
                    
                    $this->reponse['OK'] = true;
                    $this->reponse['msg'] = "c'est okay";
                    $this->reponse['article'] = $stmt3->fetch(PDO::FETCH_OBJ);
                    $this->reponse['action'] = "changerStatutArticle";
                }catch(Exception $e){
                    $this->reponse['OK'] = false;
                    $this->reponse['msg'] = "Problème requete3";
                }
            }catch(Exception $e){
                $this->reponse['OK'] = false;
                $this->reponse['msg'] = "Problème requete2";
            }         
        }catch(Exception $e){
            $this->reponse['OK'] = false;
            $this->reponse['msg'] = "Problème requete1";
        }finally{
            unset($connexion);
            return json_encode($this->reponse);
        }
    }

    // Delete:

    function Dao_Article_Form_Supprimer($articleIda){
        $connexion = Connexion::getInstanceConnexion()->getConnexion();
        $requete = "SELECT * FROM articles WHERE ida=".$articleIda;
        try{
            $stmt = $connexion->prepare($requete);
            $stmt->execute();
            $this->reponse['OK'] = true;
            $this->reponse['msg'] = "";
            $this->reponse['action'] = "formSupprimerArticle";
            $this->reponse['article'] = $stmt->fetch(PDO::FETCH_OBJ);
        }catch (Exception $e){
            $this->reponse['OK'] = false;
            $this->reponse['msg'] = "Problème pour obtenir les données des articles";
        }finally {
            unset($connexion);

            return json_encode($this->reponse);
        }
    }

    function Dao_Article_Supprimer($articleIda):string {
        $connexion = Connexion::getInstanceConnexion()->getConnexion();
        $requete = "DELETE FROM articles WHERE ida=".$articleIda;
        try{
            $stmt = $connexion->prepare($requete);
            $stmt->execute();
            $this->reponse['OK'] = true;
            $this->reponse['msg'] = "Article bien supprimé";
        }catch (Exception $e){
            $this->reponse['OK'] = false;
            $this->reponse['msg'] = "Probème lors de la suppression de l'article";
        }finally {
            unset($connexion);
            return json_encode($this->reponse);
        }
    }

}
?>