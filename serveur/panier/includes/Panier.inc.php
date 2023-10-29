<?php
    class Panier{
        private $idp;
        private $idm;
        private $statut;
        private $date_creation;
        
        function __construct($idp, $idm, $statut, $date_creation){
            $this->setIdp($idp);
            $this->setIdm($idm);
            $this->setStatut($statut);
            $this->setDateCreation($date_creation);
        }

        // Getters

        function getIdp(){return $this->idp;}
        function getIdm(){return $this->idm;}
        function getStatut(){return $this->statut;}
        function getDateCreation(){return $this->date_creation;}

        // Setters

        function setIdp($idp){$this->idp=$idp;}
        function setIdm($idm){$this->idm=$idm;}
        function setStatut($statut){$this->statut=$statut;}
        function setDateCreation($date_creation){$this->date_creation=$date_creation;}
    }
?>