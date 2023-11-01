<?php
	require_once("includes/Panier.inc.php");
	require_once("daoPanier.php");

	class ControleurPanier { 

		// Construction Controleur:

		static private $instanceCtrl = null;
	
		private function __construct(){}

		static function getControleurPanier():ControleurPanier{
			if(self::$instanceCtrl == null){
				self::$instanceCtrl = new ControleurPanier();  
			}
			return self::$instanceCtrl;
		}

		// Repartiteur d'actions:

		function Ctrl_Panier_Actions($action){
			
			switch($action){
                case "creerPanier" :
					return $this->Ctrl_Panier_Creer($_POST['membreIdm']);
				break;
                case "ajouterPanier" :
					return $this->Ctrl_Panier_Ajouter($_POST['panierIdp'], $_POST['articleIda'], $_POST['membreIdm']);
				break;
				case "afficherPanier" :
					return $this->Ctrl_Panier_Afficher($_POST['membreIdm']);
				break;
				case "enleverArticlePanier" :
					return $this->Ctrl_Panier_Enlever($_POST['panierIdp'], $_POST['articleIda']);
				break;
				case "afficherCommandesPassees" :
					return $this->Ctrl_Panier_Commandes_Passees($_POST['membreIdm']);
				break;
				case "obtenirDetailsPanier" :
					return $this->Ctrl_Panier_Details_Panier($_POST['membreIdm'],$_POST['panierIdp']);
				break;
				case "desactiverPanier" :
					return $this->Ctrl_Panier_Desactiver_Panier($_POST['panierIdp']);
				break;
            }
        }

        function Ctrl_Panier_Creer($membreIdm){
			return DaoPanier::getDaoPanier()->Dao_Panier_Creer($membreIdm); 
		}

		function Ctrl_Panier_Afficher($membreIdm){
			return DaoPanier::getDaoPanier()->Dao_Panier_Afficher($membreIdm); 
		}

        function Ctrl_Panier_Ajouter($panierIdp, $articleIda, $membreIdm){
			return DaoPanier::getDaoPanier()->Dao_Panier_Ajouter($panierIdp, $articleIda, $membreIdm); 
		}

		function Ctrl_Panier_Enlever($panierIdp, $articleIda){
			return DaoPanier::getDaoPanier()->Dao_Panier_Enlever($panierIdp, $articleIda); 
		}

		function Ctrl_Panier_Commandes_Passees($membreIdm){
			return DaoPanier::getDaoPanier()->Dao_Panier_Commandes_Passees($membreIdm); 
		}

		function Ctrl_Panier_Details_panier($membreIdm, $panierIdp){
			return DaoPanier::getDaoPanier()->Dao_Panier_Details_Panier($membreIdm, $panierIdp); 
		}

		function Ctrl_Panier_Desactiver_panier($panierIdp){
			return DaoPanier::getDaoPanier()->Dao_Panier_Desactiver_Panier($panierIdp); 
		}
    }
?>    