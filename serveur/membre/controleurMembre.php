<?php
    require_once('includes/Membre.inc.php');
    require_once('daoMembre.php');

    class ControleurMembre { 

		// Construction Controleur:

		static private $instanceCtrl = null;
		private $reponse;
	
		private function __construct(){}

		static function getControleurMembre():ControleurMembre{
			if(self::$instanceCtrl == null){
				self::$instanceCtrl = new ControleurMembre();  
			}
			return self::$instanceCtrl;
        }
        
		// Repartiteur d'actions:

		function Ctrl_Membre_Actions(){
			switch($_POST['action']){
				case "listerTabMembre" :
					return $this->Ctrl_Membre_Lister();
				break;
				case "ficheMembre" :
					return $this->Ctrl_Membre_Fiche($_POST['membreIdm']);
				break;
				case "formModifierMembre" :
					return $this->Ctrl_Membre_Form_Modifier($_POST['membreIdm']);
				break;
				case "envoyerModifMembre" :
					return $this->Ctrl_Membre_Modifier($_POST['membreIdm']);
				break;
				case "formChangerStatutMembre" :
					return $this->Ctrl_Membre_Form_Changer_Statut($_POST['membreIdm']);
				break;
				case "changerStatutMembre" :
					return $this->Ctrl_Membre_Changer_Statut($_POST['membreIdm']);
				break;
				case "enregistrerMembre" :
					return $this->Ctrl_Membre_Enregistrer();
				break;
			}
		}

		// CRUD:
		// Create:

		function Ctrl_Membre_Enregistrer(){
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $courriel = $_POST['courriel'];
            $sexe = $_POST['sexe'];
            $daten = $_POST['daten'];
            
            $membre = new Membre(0, $nom, $prenom, $courriel, $sexe, $daten, " ");
            return DaoMembre::getDaoMembre()->Dao_Membre_Enregistrer($membre, $_POST['mdp']);
        }

        function Ctrl_Membre_Lister(){
            return DaoMembre::getDaoMembre()->Dao_Membre_Lister(); 
        }

        // Read:
        
        function Ctrl_Membre_Fiche($membreIdm){
			return DaoMembre::getDaoMembre()->Dao_Membre_Fiche($membreIdm); 
		}

		// Update:

		function Ctrl_Membre_Form_Modifier($membreIdm){
			return DaoMembre::getDaoMembre()->Dao_Membre_Form_Modifier($membreIdm); 
		}

		function Ctrl_Membre_Form_Changer_Statut($membreIdm){
			return DaoMembre::getDaoMembre()->Dao_Membre_Form_Changer_Statut($membreIdm); 
		}

		function Ctrl_Membre_Modifier($membreIdm){
			$nom = $_POST['nomMembre'];
            $prenom = $_POST['prenomMembre'];
            $courriel = $_POST['courrielMembre'];
            $sexe = $_POST['sexeMembre'];
            $daten = $_POST['dateNaissanceMembre'];

			$membre = new Membre($membreIdm, $nom, $prenom, $courriel, $sexe, $daten, 'avatarMembre.png');
			return DaoMembre::getDaoMembre()->Dao_Membre_Modifier($membre); 
		}

		function Ctrl_Membre_Changer_Statut($membreIdm){
			return DaoMembre::getDaoMembre()->Dao_Membre_Changer_Statut($membreIdm); 
		}
    }
?>