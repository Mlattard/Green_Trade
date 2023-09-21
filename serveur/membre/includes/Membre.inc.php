<?php
    class Membre{
        private $idm;
        private $nom;
        private $prenom;
        private $courriel;
        private $sexe;
        private $daten;
        private $photo;
        
        function __construct($idm, $nom, $prenom, $courriel, $sexe, $daten, $photo){
            $this->setIdm($idm);
            $this->setNom($nom);
            $this->setPrenom($prenom);
            $this->setCourriel($courriel);
            $this->setSexe($sexe);
            $this->setDaten($daten);
            $this->setPhoto($photo);
        }

        // Getters

        function getIdm(){return $this->idm;}
        function getNom(){return $this->nom;}
        function getPrenom(){return $this->prenom;}
        function getCourriel(){return $this->courriel;}
        function getSexe(){return $this->sexe;}
        function getDaten(){return $this->daten;}
        function getPhoto(){return $this->photo;}

        // Setters

        function setIdm($idm){$this->idm=$idm;}
        function setNom($nom){$this->nom=$nom;}
        function setPrenom($prenom){$this->prenom=$prenom;}
        function setCourriel($courriel){$this->courriel=$courriel;}
        function setSexe($sexe){$this->sexe=$sexe;}
        function setDaten($daten){$this->daten=$daten;}
        function setPhoto($photo){$this->photo=$photo;}

        // Fonctions

        function afficher(){
            $rep = "<img src='../photos/".$photo."'> ". $this->idm."  ".$this->nom."  ".$this->prenom."  ".$this->courriel."  ";
            if ($this->sexe == 'F'){
                $sexe = 'Feminin';
            } else if ($this->sexe == 'M'){
                $sexe = 'Masculin';
            } else {
                $sexe = 'Autre';
            }
            $rep.=$this->sexe."  ".$this->daten;
            return $rep;
        }
    }
?>