<?php
    declare (strict_types=1);
    
    require_once(__DIR__.'/../env/env.inc.php');
    
    class Connexion{
        private $connexion;
	    private static $instance;
        
        // Interdire de créer des objets Connexion par l'extérieur de la classe
        private function __construct(){}
    
        public static function getInstanceConnexion(){
            if(self::$instance == null){
                self::$instance = new Connexion();
            }
            return self::$instance;
        }
        
        function getConnexion(){
            $this->connecter();
            return $this->connexion;
        }
        
        // Créer la connexion
        private function connecter(){
            try {
                $dns = "mysql:host=".SERVEUR.";dbname=".BD;
                $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
                $this->connexion = new PDO($dns, USAGER, MDP, $options);
            } catch ( Exception $e ) {
                echo "Probleme de connexion au serveur de bd";
                exit();
            }
        }
    }
?>