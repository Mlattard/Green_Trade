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

    function chargerPhotoMembre($nom, $prenom){
        $photo = "avatarMembre.png";
        $dossierPhotos = "photos/";
        $objPhotoRecue = $_FILES['photo'];
   
        if($objPhotoRecue['tmp_name'][0]!== ""){
            $nouveauNom = $nom.$prenom.time();
            $extension = strrchr($objPhotoRecue['name'], ".");

            $photo = $nouveauNom.$extension;
   
            @move_uploaded_file($objPhotoRecue['tmp_name'], $dossierPhotos.$photo);
            if (!file_exists($dossierPhotos.$photo)) {
                $msg = "Erreur lors du téléchargement du fichier.";
            }
        }

        return $photo;
    }

	function Dao_Article_Enregistrer(Article $article):string {
             
        $connexion = Connexion::getConnexion();

        $requete = "INSERT INTO articles VALUES(0,?,?,?,?,?,?)";
        try{
            $photo = chargerPhotoArticle($article->getNom());
            $donnees = [$article->getNom(),$article->getDescription(),$article->getCategorie(),
                        $article->getPrix(),$article->getEtat(),$photo];
            $stmt = $connexion->prepare($requete);
            $stmt->execute($donnees);
            $this->reponse['OK'] = true;
            $this->reponse['msg'] = "Article bien enregistré";
        }catch (Exception $e){
            $this->reponse['OK'] = false;
            $this->reponse['msg'] = "Probème lors de l'enregistrement de l'article";
        }finally {
            unset($connexion);
            return json_encode($this->reponse);
        }
    }

    function Dao_Article_Supprimer(Article $article):string {

        $connexion = Connexion::getConnexion();
        $requete = "DELETE FROM articles WHERE id=?";
        try{
            $donnees = $article->getIda();
            $stmt = $connexion->prepare($requete);
            $stmt->execute($donnees);
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
        $requete="SELECT photo FROM articles WHERE ida=".$article->articleIda;

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
			//$photo = chargerPhotoArticle($anciennePhoto);	
			
			$requete2 = "UPDATE articles SET nom=?, description=?, categorie=?, prix=?, etat=?, photo=".$anciennePhoto." WHERE ida=".$articleIda;
			$donnees2 = [$article->nom, $article->description, $article->categorie, $article->prix, $article->etat];
            $stmt = $connexion->prepare($requete2);
            $stmt->execute($donnees2);

            $requete3 = "SELECT * FROM articles WHERE ida=".$articleIda;
            $stmt = $connexion->prepare($requete3);
            $stmt->execute();
            
            $this->reponse['OK'] = true;
            $this->reponse['msg'] = "";
            $this->reponse['action'] = "envoyerModif";
            $this->reponse['article'] = $stmt->fetch(PDO::FETCH_OBJ);
		}catch(Exception $e){
		}finally{
			unset($connexion);
            return json_encode($this->reponse);
		}
    }
}
?>