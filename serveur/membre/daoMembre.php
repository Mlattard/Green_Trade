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
            $requete = "SELECT * FROM connexion WHERE ida=".$membreIdm;
            try{
                $stmt = $connexion->prepare($requete);
                $stmt->execute();
                $this->reponse['OK'] = true;
                $this->reponse['msg'] = "";
                $this->reponse['action'] = "formChangerStatut";
                $this->reponse['membre'] = $stmt->fetch(PDO::FETCH_OBJ);
            }catch (Exception $e){
                $this->reponse['OK'] = false;
                $this->reponse['msg'] = "Problème pour obtenir les données des articles";
            }finally {
                unset($connexion);
    
                return json_encode($this->reponse);
            }
        }
    }
?>