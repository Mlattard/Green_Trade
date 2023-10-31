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

        function Dao_Panier_Afficher($membreIdm):string {

            $connexion = Connexion::getInstanceConnexion()->getConnexion();
            
            try{
                $requete = "SELECT idp FROM paniers WHERE idm = ? AND statut = 'A'";
                $donnees = [$membreIdm];
                $stmt = $connexion->prepare($requete);
                $stmt->execute($donnees);
                
                $this->reponse['OK'] = true;
                $this->reponse['msg'] = "Panier trouvé";
                $this->reponse['idp'] = $stmt->fetch(PDO::FETCH_OBJ)->idp;
                try{
                    $requete4 = "SELECT * FROM articlespanier WHERE idp = ?";
                    $donnees4 = [$this->reponse['idp']];
                    $stmt4 = $connexion->prepare($requete4);
                    $stmt4->execute($donnees4);
                    
                    $this->reponse['OK'] = true;
                    $this->reponse['msg'] = "Article trouvé dans le panier";

                    $this->reponse['panier'] = array();
                    while($ligne = $stmt4->fetch(PDO::FETCH_OBJ)){
                        $this->reponse['panier'][] = $ligne;
                    }
                }catch (Exception $e){
                    $this->reponse['OK'] = false;
                    $this->reponse['msg'] = "Pas d'Articles dans le panier: " . $e->getMessage();
                }finally {
                    unset($connexion);
                    return json_encode($this->reponse);
                }
            }catch (Exception $e){
                $this->reponse['OK'] = false;
                $this->reponse['msg'] = "Panier pas trouvé: " . $e->getMessage();
            }finally {
                unset($connexion);
                return json_encode($this->reponse);
            }
        }


        function Dao_Panier_Ajouter($panierIdp, $articleIda):string {

            $connexion = Connexion::getInstanceConnexion()->getConnexion();
            
            try{
                $requete = "SELECT * FROM paniers WHERE idp =".$panierIdp;
                $stmt = $connexion->prepare($requete);
                $stmt->execute();

                $this->reponse['OK'] = true;
                $this->reponse['msg'] = "Panier trouvé avec succès";
                $this->reponse['idp'] = $stmt->fetch(PDO::FETCH_OBJ)->idp;
                try{
                    $requete2 = "SELECT * FROM articles WHERE ida = ".$articleIda;
                    $stmt2 = $connexion->prepare($requete2);
                    $stmt2->execute();

                    $this->reponse['OK'] = true;
                    $this->reponse['msg'] = "Article trouvé avec succès";
                    $this->reponse['article'] = $stmt2->fetch(PDO::FETCH_OBJ);
                    $this->reponse['nom'] = $this->reponse['article']->nom;
                    $this->reponse['prix'] = $this->reponse['article']->prix;
                    try{
                        $requete3 = "INSERT INTO articlespanier VALUES (?, ?, ?, ?)";
                        $donnees3 = [$this->reponse['idp'], $articleIda, $this->reponse['nom'], $this->reponse['prix']];
                        $stmt3 = $connexion->prepare($requete3);
                        $stmt3->execute($donnees3);
                        
                        $this->reponse['OK'] = true;
                        $this->reponse['msg'] = "Article enregistré avec succès dans le panier";
                        try{
                            $requete4 = "SELECT * FROM articlespanier WHERE idp = ?";
                            $donnees4 = [$this->reponse['idp']];
                            $stmt4 = $connexion->prepare($requete4);
                            $stmt4->execute($donnees4);
                            
                            $this->reponse['OK'] = true;
                            $this->reponse['msg'] = "Article trouvé dans le panier";

                            $this->reponse['panier'] = array();
                            while($ligne = $stmt4->fetch(PDO::FETCH_OBJ)){
                                $this->reponse['panier'][] = $ligne;
                            }
                        }catch (Exception $e){
                            $this->reponse['OK'] = false;
                            $this->reponse['msg'] = "Article pas trouvé dans le panier: " . $e->getMessage();
                        }
                    }catch (Exception $e){
                        $this->reponse['OK'] = false;
                        $this->reponse['msg'] = "Erreur lors de l'ajout de l'article dans le panier: " . $e->getMessage();
                    }
                }catch (Exception $e){
                    $this->reponse['OK'] = false;
                    $this->reponse['msg'] = "Article pas trouvé: " . $e->getMessage();
                }
            }catch (Exception $e){
                $this->reponse['OK'] = false;
                $this->reponse['msg'] = "Panier pas trouvé: " . $e->getMessage();
            }finally {
                unset($connexion);
                return json_encode($this->reponse);
            }
        }

    function Dao_Panier_Enlever($panierIdp, $articleIda):string {

        $connexion = Connexion::getInstanceConnexion()->getConnexion();
        
            try{
                $requete = "DELETE FROM articlespanier WHERE idp = ? AND ida = ?";
                $donnees = [$panierIdp, $articleIda];
                $stmt = $connexion->prepare($requete);
                $stmt->execute($donnees);
                
                $this->reponse['OK'] = true;
                $this->reponse['msg'] = "Article supprimé avec succès du panier";
                try{
                    $requete2 = "SELECT * FROM articlespanier WHERE idp = ?";
                    $donnees2 = [$panierIdp];
                    $stmt2 = $connexion->prepare($requete2);
                    $stmt2->execute($donnees2);
                    
                    $this->reponse['OK'] = true;
                    $this->reponse['msg'] = "Articles trouvé dans le panier";
                    $this->reponse['idp'] = $panierIdp;
                    $this->reponse['panier'] = array();
                    while($ligne = $stmt2->fetch(PDO::FETCH_OBJ)){
                        $this->reponse['panier'][] = $ligne;
                    }
                }catch (Exception $e){
                    $this->reponse['OK'] = false;
                    $this->reponse['msg'] = "Panier vide: " . $e->getMessage();
                }finally {
                    unset($connexion);
                    return json_encode($this->reponse);
                }
            }catch (Exception $e){
                $this->reponse['OK'] = false;
                $this->reponse['msg'] = "Erreur lors de la suppression de l'article du le panier: " . $e->getMessage();
            }finally {
                unset($connexion);
                return json_encode($this->reponse);
            }
        }
    }
?>