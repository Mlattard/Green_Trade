<?php
	require_once("includes/Article.inc.php");
	require_once("daoArticle.php");

	class ControleurArticle { 

		// Construction Controleur:

		static private $instanceCtrl = null;
	
		private function __construct(){}

		static function getControleurArticle():ControleurArticle{
			if(self::$instanceCtrl == null){
				self::$instanceCtrl = new ControleurArticle();  
			}
			return self::$instanceCtrl;
		}

		// Repartiteur d'actions:

		function Ctrl_Article_Actions($action){
			
			switch($action){
				case "carrouselPrecedent":
				case "carrouselSuivant":
				case "listerTabArticles" :
				case "listerCardsArticles" :
					return $this->Ctrl_Article_Lister($action);
				break;
				case "ficheArticle" :
					return $this->Ctrl_Article_Fiche($_POST['articleIda']);
				break;
				case "formModifierArticle" :
					return $this->Ctrl_Article_Form_Modifier($_POST['articleIda']);
				break;
				case "envoyerModifArticle" :
					return $this->Ctrl_Article_Modifier($_POST['articleIda']);
				break;
				case "formChangerStatutArticle" :
					return $this->Ctrl_Article_Form_Changer_Statut($_POST['articleIda']);
				break;
				case "changerStatutArticle" :
					return $this->Ctrl_Article_Changer_Statut($_POST['articleIda']);
				break;
				case "formSupprimerArticle" :
					return $this->Ctrl_Article_Form_Supprimer($_POST['articleIda']);
				break;
				case "supprimerArticle" :
					return $this->Ctrl_Article_Supprimer($_POST['articleIda']);
				break;
				case "envoyerEnregistrerArticle" :
					return $this->Ctrl_Article_Enregistrer();
				break;
			}
	    }

		// CRUD:
		// Create:

		function Ctrl_Article_Enregistrer(){
			$nom = $_POST['nomArticle'];
			$description = $_POST['description'];
			$categorie = $_POST['categorie'];
			$prix = $_POST['prix'];
			$etat = $_POST['etat'];

			$article = new Article(0, $nom, $description, $categorie, $prix, $etat, ' ', 'A');
			return DaoArticle::getDaoArticle()->Dao_Article_Enregistrer($article); 
	    }

		// Read:

		function Ctrl_Article_Lister($action){
			return DaoArticle::getDaoArticle()->Dao_Article_Lister($action); 
	    }

		function Ctrl_Article_Fiche($articleIda){
			return DaoArticle::getDaoArticle()->Dao_Article_Fiche($articleIda); 
		}

		// Update:

		function Ctrl_Article_Form_Modifier($articleIda){
			return DaoArticle::getDaoArticle()->Dao_Article_Form_Modifier($articleIda); 
		}

		function Ctrl_Article_Modifier($articleIda){
			$nom = $_POST['nomArticle'];
			$description = $_POST['description'];
			$categorie = $_POST['categorie'];
			$prix = $_POST['prix'];
			$etat = $_POST['etat'];
			$statut = $_POST['statut'];

			$article = new Article($articleIda, $nom, $description, $categorie, $prix, $etat, ' ', $statut);
			return DaoArticle::getDaoArticle()->Dao_Article_Modifier($article); 
		}

		function Ctrl_Article_Form_Changer_Statut($articleIda){
			return DaoArticle::getDaoArticle()->Dao_Article_Form_Changer_Statut($articleIda); 
		}

		function Ctrl_Article_Changer_Statut($articleIda){
			return DaoArticle::getDaoArticle()->Dao_Article_Changer_Statut($articleIda); 
		}

		// Delete

		function Ctrl_Article_Form_Supprimer($articleIda){
			return DaoArticle::getDaoArticle()->Dao_Article_Form_Supprimer($articleIda); 
		}

		function Ctrl_Article_Supprimer($articleIda){
			return DaoArticle::getDaoArticle()->Dao_Article_Supprimer($articleIda); 
		}
	}
?>