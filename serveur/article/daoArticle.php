<?php

declare (strict_types=1);

require_once(__DIR__."/../bd/connexion.inc.php");
require_once(__DIR__."/includes/Article.inc.php");

class DaoArticle {
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

    function chargerPhotoArticle($nom){
        $photo = "logo.png";
        $dossierPhotos = "photos/";
        $objPhotoRecue = $_POST['photo'];
   
        if($objPhotoRecue['tmp_name'][0]!== ""){
            $nouveauNom = $nom.time();
            $extension = strrchr($objPhotoRecue['name'], ".");
   
            $photo = $nouveauNom.$extension;

            @move_uploaded_file($objPhotoRecue['tmp_name'], $dossierPhotos.$photo);
            if (!file_exists($dossierPhotos.$photo)) {
                $msg = "Erreur lors du téléchargement du fichier.";
            }
        }

        return $photo;
    }

	function Dao_Article_Enregistrer($article):string {
             
        $connexion = Connexion::getInstanceConnexion()->getConnexion();
        $requete = "INSERT INTO articles (nom, description, categorie, prix, etat, photo) VALUES (?, ?, ?, ?, ?, ?)";
        try{
            $stmt = $connexion->prepare($requete);
            $stmt->bindParam(':nom', $article->getNom());
            $stmt->bindParam(':description', $article->getDescription());
            $stmt->bindParam(':categorie', $article->getCategorie());
            $stmt->bindParam(':prix', $article->getPrix());
            $stmt->bindParam(':etat', $article->getEtat());
            $stmt->bindParam(':photo', 'logo.png'); // Vérifiez la fonction chargerPhotoArticle

            $stmt->execute();
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

    function Dao_Article_Supprimer($articleIda):string {

        $connexion = Connexion::getInstanceConnexion()->getConnexion();
        $requete = "DELETE FROM articles WHERE ida=".$articleIda;
        try{
            $stmt = $connexion->prepare($requete);
            $stmt->execute();
            $this->reponse['OK'] = true;
            $this->reponse['msg'] = "Article bien supprimé";
            $this->reponse['action'] = "supprimer";
        }catch (Exception $e){
            $this->reponse['OK'] = false;
            $this->reponse['msg'] = "Probème lors de la suppression de l'article";
        }finally {
            unset($connexion);
            return json_encode($this->reponse);
        }
    }

    function Dao_Article_Lister():string {

        $connexion = Connexion::getInstanceConnexion()->getConnexion();
        $requete = "SELECT * FROM articles";
        try{
            $stmt = $connexion->prepare($requete);
            $stmt->execute();
            $this->reponse['OK'] = true;
            $this->reponse['msg'] = "";
            $this->reponse['action'] = "lister";
            $this->reponse['listeArticles'] = array();
            while($ligne = $stmt->fetch(PDO::FETCH_OBJ)){
                $this->reponse['listeArticles'][] = $ligne;
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

    function Dao_Article_Form_Modifier($articleIda){
        $connexion = Connexion::getInstanceConnexion()->getConnexion();
        $requete = "SELECT * FROM articles WHERE ida=".$articleIda;
        try{
            $stmt = $connexion->prepare($requete);
            $stmt->execute();
            $this->reponse['OK'] = true;
            $this->reponse['msg'] = "";
            $this->reponse['action'] = "formModifier";
            $this->reponse['article'] = $stmt->fetch(PDO::FETCH_OBJ);
        }catch (Exception $e){
            $this->reponse['OK'] = false;
            $this->reponse['msg'] = "Problème pour obtenir les données des articles";
        }finally {
            unset($connexion);

            return json_encode($this->reponse);
        }
    }

    function Dao_Article_Form_Supprimer($articleIda){
        $connexion = Connexion::getInstanceConnexion()->getConnexion();
        $requete = "SELECT * FROM articles WHERE ida=".$articleIda;
        try{
            $stmt = $connexion->prepare($requete);
            $stmt->execute();
            $this->reponse['OK'] = true;
            $this->reponse['msg'] = "";
            $this->reponse['action'] = "formSupprimer";
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
        $connexion = Connexion::getInstanceConnexion()->getConnexion();
        $requete = "SELECT * FROM articles WHERE ida=".$article->getIda();

        $this->reponse = [
            'OK' => false,
            'msg' => "",
            'action' => "",
            'article' => null,
            'photoArticle' => null,
        ];

        try{
			$stmt = $connexion->prepare($requete);
            $stmt->execute();
            $this->reponse['photoArticle'] = $stmt->fetch(PDO::FETCH_OBJ)->photo;
			
			$anciennePhoto = $this->reponse['photoArticle'];
			
			$requete2 = "UPDATE articles SET nom=?, description=?, categorie=?, prix=?, etat=?, photo='".$anciennePhoto."' WHERE ida=".$article->getIda();
			try{
                $donnees2 = [$article->getNom(), $article->getDescription(),  $article->getCategorie(), $article->getPrix(), $article->getEtat()];
                $stmt2 = $connexion->prepare($requete2);
                $stmt2->execute($donnees2);
                try{
                    $requete3 = "SELECT * FROM articles WHERE ida=".$article->getIda();
                    $stmt3 = $connexion->prepare($requete3);
                    $stmt3->execute();
                    
                    $this->reponse['OK'] = true;
                    $this->reponse['msg'] = "";
                    $this->reponse['action'] = "envoyerModif";
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
}
?>