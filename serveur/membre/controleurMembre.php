<?php
    require_once('includes/Membre.inc.php');
    require_once('daoMembre.php');

    class ControleurMembre { 
        static private $instanceCtr = null;
        
        private $reponse;
    
        private function __construct(){}
    
        static function getControleurMembre():ControleurMembre{
            if(self::$instanceCtr == null){
                self::$instanceCtr = new ControleurMembre();  
            }
            return self::$instanceCtr;
        }
    }

    function Ctrl_Membre_Ajouter(){
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $courriel = $_POST['courriel'];
        $sexe = $_POST['sexe'];
        $daten = $_POST['daten'];
        
        $membre = new Membre(0, $nom, $prenom, $courriel, $sexe, $daten, " ");
        return DaoMembre::getDaoMembre()->Dao_Membre_Ajouter($membre, $_POST['mdp']);
    }
    
    function Ctrl_Membre_Actions(){
        $action=$_POST['action'];
        switch($action){
            case "ajouter" :
                return  $this->Ctrl_Membre_Ajouter();
            break;
            case "modifier" :
                //modifier(); 
            break;
            case "desactiver" :
                //desactiver(); 
            break; 
        }     
    }
?>

<br/>
<a href="../../index.php">Retour à l'accueil</a>