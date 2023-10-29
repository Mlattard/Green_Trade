<?php
    declare (strict_types=1);

    require_once(__DIR__."/../bd/connexion.inc.php");
    require_once(__DIR__."/includes/Panier.inc.php");
    
    class DaoPanier {

        // Construction Dao:

        static private $instanceDaoPanier = null;
        
        private $reponse = array();
        private $connexion = null;
        
        private function __construct(){}
        
        static function getDaoPanier():DaoPanier {
            if(self::$instanceDaoPanier == null){
                self::$instanceDaoPanier = new DaoPanier();
            }
            return self::$instanceDaoPanier;
        }

        // CRUD:
        // Create:

        function Dao_Panier_Creer($membreIdm):string {

            $connexion = Connexion::getInstanceConnexion()->getConnexion();
            $date = date("Y-m-d");

            try{
                $requete = "SELECT * FROM paniers WHERE idm =".$membreIdm." AND statut = 'A'";
                $stmt = $connexion->prepare($requete);
                $stmt->execute();
                $this->reponse['OK'] = true;
                $this->reponse['msg'] = "Panier créé avec succès";
                $this->reponse['panier'] = $stmt->fetch(PDO::FETCH_ASSOC);
                if (!$this->reponse['panier']) {
                    try{
                        $requete2 = "INSERT INTO paniers (idm, statut, date_creation) VALUES (?, 'A', ?)";
                        $donnees2 = [$membreIdm, $date];
                        $stmt2 = $connexion->prepare($requete2);
                        $stmt2->execute($donnees2);
                        $this->reponse['OK'] = true;
                        $this->reponse['msg'] = "Panier créé avec succès";
                    } catch (Exception $e){
                        $this->reponse['OK'] = false;
                        $this->reponse['msg'] = "Erreur lors de la création du panier: " . $e->getMessage();;
                    }
                } else {
                    $this->reponse['msg'] = "Le membre a déjà un panier actif";
                }
                try{
                    $stmt3 = $connexion->prepare($requete);
                    $stmt3->execute();
                    $this->reponse['OK'] = true;
                    $this->reponse['msg'] = "Panier sélectionné";
                    // $this->reponse['action'] = "creerPanier";
                    $this->reponse['panier'] = $stmt3->fetch(PDO::FETCH_ASSOC);
                } catch (Exception $e){
                    $this->reponse['OK'] = false;
                    $this->reponse['msg'] = "Erreur lors de la sélection du panier: " . $e->getMessage();;
                } finally {
                    unset($connexion);
                    return json_encode($this->reponse);
                }
            } catch (Exception $e){
                $this->reponse['OK'] = false;
                $this->reponse['msg'] = "Erreur lors de la création du panier: " . $e->getMessage();;
            } finally {
                unset($connexion);
                return json_encode($this->reponse);
            }
        }

        function Dao_Panier_Ajouter($articleIda):string {

            $connexion = Connexion::getInstanceConnexion()->getConnexion();
            
            $requete = "INSERT INTO paniers (nom, description, categorie, prix, etat, photo, statut) VALUES (?, ?, ?, ?, ?, ?, ?, 'A')";
            try{
                $donnees = [];
                $stmt = $connexion->prepare($requete);
                $stmt->execute($donnees);
                
                $this->reponse['OK'] = true;
                $this->reponse['msg'] = "Article enregistré avec succès";
            }catch (Exception $e){
                $this->reponse['OK'] = false;
                $this->reponse['msg'] = "Erreur lors de l'enregistrement de l'article : " . $e->getMessage();;
            }finally {
                unset($connexion);
                return json_encode($this->reponse);
            }
        }
    }
?>