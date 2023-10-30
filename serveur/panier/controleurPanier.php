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
					return $this->Ctrl_Panier_Ajouter($_POST['panierIdp'], $_POST['articleIda']);
				break;
            }
        }

        function Ctrl_Panier_Creer($membreIdm){
			return DaoPanier::getDaoPanier()->Dao_Panier_Creer($membreIdm); 
		}

        function Ctrl_Panier_Ajouter($panierIdp, $articleIda){
			return DaoPanier::getDaoPanier()->Dao_Panier_Ajouter($panierIdp, $articleIda); 
		}
    }
?>    