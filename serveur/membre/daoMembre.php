<?php
    declare (strict_types=1);

    require_once(__DIR__."/../bd/connexion.inc.php");
    require_once(__DIR__."/includes/Membre.inc.php");
    
    class DaoMembre {
        static private $instanceDaoMembre = null;
        
        private $reponse = array();
        private $connexion = null;
        
        private function __construct(){}
        
        static function getDaoMembre():DaoMembre {
            if(self::$instanceDaoMembre == null){
                self::$instanceDaoMembre = new DaoMembre();
            }
            return self::$instanceDaoMembre;
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
       
        function Dao_Membre_Lister():string {

            $connexion = Connexion::getInstanceConnexion()->getConnexion();
            $requete = "SELECT * FROM membres";
            try{
                $stmt = $connexion->prepare($requete);
                $stmt->execute();
                $this->reponse['OK'] = true;
                $this->reponse['msg'] = "";
                $this->reponse['action'] = "listerM";
                $this->reponse['listeMembres'] = array();
                while($ligne = $stmt->fetch(PDO::FETCH_OBJ)){
                    $this->reponse['listeMembres'][] = $ligne;
                }
            }catch (Exception $e){
                $this->reponse['OK'] = false;
                $this->reponse['msg'] = "Problème pour obtenir les données des articles";
            }finally {
                unset($connexion);
                return json_encode($this->reponse);
            }
        }

        function Dao_Membre_Enregistrer(Membre $membre, String $mdp):string {

            $nom = $membre->getNom();
            $prenom = $membre->getPrenom();
            $courriel = $membre->getCourriel();
            $sexe = $membre->getSexe();
            $daten = $membre->getDaten();
            $msg = "";
        
            $connexion = Connexion::getInstanceConnexion()->getConnexion();
            
            try{
                $requete = "SELECT * FROM membres WHERE courriel = ?";
                $donnees = [$courriel];
                $stmt = $connexion->prepare($requete);
                $stmt->execute($donnees);
                $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$resultat) {
                    $photo = self::chargerPhotoMembre($nom, $prenom);
                    $requete = "INSERT INTO membres VALUES (0, ?, ?, ?, ?, ?, ?)";
                    $donnees = [$nom, $prenom, $courriel, $sexe, $daten, $photo];
                    $stmt = $connexion->prepare($requete);
                    $stmt->execute($donnees);
                    $idm = $connexion->lastInsertId();

                    $requete = "INSERT INTO connexion VALUES (?, ?, ?, 'M', 'A')";
                    $stmt = $connexion->prepare($requete);
                    $stmt->execute([$idm, $courriel, $mdp]);
                    $msg = "<h3>Le membre ".$membre->getPrenom()." ".$membre->getNom()." a bien été enregistré</h3>";
                } else {
                    $msg = "<h3>Le courriel ".$courriel." est déjà dans la base de donnée</h3>";
                }
            } catch(Exception $e) {
                $msg = "<h3>Une erreur est survenue lors de l'enregistrement: ".$e->getMessage()."\br</h3>";
            }finally {
                unset($connexion);
                return $msg;
            }
        }

        function Dao_Membre_Fiche($membreIdm){
            $connexion = Connexion::getInstanceConnexion()->getConnexion();
            $requete = "SELECT M.idm, M.nom, M.prenom, M.courriel, M.sexe, M.datenaissance, M.photo, C.role, C.statut FROM membres M INNER JOIN connexion C ON M.idm = C.idm WHERE M.idm = ".$membreIdm;
            try{
                $stmt = $connexion->prepare($requete);
                $stmt->execute();
                $this->reponse['OK'] = true;
                $this->reponse['msg'] = "";
                $this->reponse['action'] = "ficheMembre";
                $this->reponse['membre'] = $stmt->fetch(PDO::FETCH_OBJ);
                
            }catch (Exception $e){
                $this->reponse['OK'] = false;
                $this->reponse['msg'] = "Problème pour obtenir les données des membres";
            }finally {
                unset($connexion);
                return json_encode($this->reponse);
            }
        }

        function Dao_Membre_Form_Modifier($membreIdm){
            $connexion = Connexion::getInstanceConnexion()->getConnexion();
            $requete = "SELECT * FROM membres WHERE idm=".$membreIdm;
            try{
                $stmt = $connexion->prepare($requete);
                $stmt->execute();
                $this->reponse['OK'] = true;
                $this->reponse['msg'] = "";
                $this->reponse['action'] = "formModifierM";
                $this->reponse['membre'] = $stmt->fetch(PDO::FETCH_OBJ);
            }catch (Exception $e){
                $this->reponse['OK'] = false;
                $this->reponse['msg'] = "Problème pour obtenir les données des articles";
            }finally {
                unset($connexion);
    
                return json_encode($this->reponse);
            }
        }
    
        function Dao_Membre_Form_Changer_Statut($membreIdm){
            $connexion = Connexion::getInstanceConnexion()->getConnexion();
            $requete = "SELECT M.idm, M.nom, M.prenom, C.statut FROM membres M INNER JOIN connexion C ON M.idm = C.idm WHERE M.idm = ".$membreIdm;
            try{
                $stmt = $connexion->prepare($requete);
                $stmt->execute();
                $this->reponse['OK'] = true;
                $this->reponse['msg'] = "";
                $this->reponse['action'] = "formChangerStatutM";
                $this->reponse['membre'] = $stmt->fetch(PDO::FETCH_OBJ);
            }catch (Exception $e){
                $this->reponse['requete'] = $requete;
                $this->reponse['OK'] = false;
                $this->reponse['msg'] = "Problème pour obtenir les données des articles";
            }finally {
                unset($connexion);
    
                return json_encode($this->reponse);
            }
        }

        function Dao_Membre_Changer_Statut($membreIdm):string {
            $connexion = Connexion::getInstanceConnexion()->getConnexion();
            $requete = "SELECT statut FROM connexion WHERE idm=".$membreIdm;

            $this->reponse = [
                'OK' => false,
                'msg' => "debut",
                'action' => "",
                'statutMembre' => null,
            ];

            try{
                $stmt = $connexion->prepare($requete);
                $stmt->execute();
                $statutMembre = $stmt->fetch(PDO::FETCH_OBJ);
                switch($statutMembre){
                    case "A" :
                        $nouveauStatut = "I";
                    break;
                    case "I" :
                        $nouveauStatut = "A";
                    break;
                    }
                $requete2 = "UPDATE connexion SET statut='".$nouveauStatut."' WHERE idm=".$membreIdm;
                try{
                    $stmt2 = $connexion->prepare($requete2);
                    $stmt2->execute();
                    $requete3 = "SELECT M.idm, M.nom, M.prenom, M.courriel, M.sexe, M.datenaissance, M.photo, C.role, C.statut FROM membres M INNER JOIN connexion C ON M.idm = C.idm WHERE M.idm = ".$membreIdm;
                    try{
                        $stmt3 = $connexion->prepare($requete3);
                        $stmt3->execute();
                        
                        $this->reponse['OK'] = true;
                        $this->reponse['msg'] = "c'est okay";
                        $this->reponse['membre'] = $stmt3->fetch(PDO::FETCH_OBJ);
                        $this->reponse['action'] = "changerStatutM";
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
    
        function Dao_Membre_Modifier($membre):string {
            $connexion = Connexion::getInstanceConnexion()->getConnexion();
            $requete = "SELECT * FROM membres WHERE idm=".$membre->getIdm();
    
            $this->reponse = [
                'OK' => false,
                'msg' => "debut",
                'action' => "",
                'membre' => null,
                'photoMembre' => null,
            ];
    
            try{
                $stmt = $connexion->prepare($requete);
                $stmt->execute();
                $this->reponse['photoMembre'] = $stmt->fetch(PDO::FETCH_OBJ)->photo;
                
                $anciennePhoto = $this->reponse['photoMembre'];
                
                $requete2 = "UPDATE membres SET nom=?, prenom=?, courriel=?, sexe=?, datenaissance=?, photo='".$anciennePhoto."' WHERE idm=".$membre->getIdm();
                try{
                    $donnees2 = [$membre->getNom(), $membre->getPrenom(), $membre->getCourriel(), $membre->getSexe(), $membre->getDaten()];
                    $stmt2 = $connexion->prepare($requete2);
                    $stmt2->execute($donnees2);
                    $requete3 = $requete = "SELECT M.idm, M.nom, M.prenom, M.courriel, M.sexe, M.datenaissance, M.photo, C.role, C.statut FROM membres M INNER JOIN connexion C ON M.idm = C.idm WHERE M.idm = ".$membre->getIdm();
                    try{
                        $stmt3 = $connexion->prepare($requete3);
                        $stmt3->execute();
                        
                        $this->reponse['OK'] = true;
                        $this->reponse['msg'] = "c'est okay";
                        $this->reponse['membre'] = $stmt3->fetch(PDO::FETCH_OBJ);
                        $this->reponse['action'] = "envoyerModifM";
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