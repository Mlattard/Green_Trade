<?php
	require_once("includes/Article.inc.php");
	require_once("daoArticle.php");

	class ControleurArticle { 
		static private $instanceCtrl = null;
		private $reponse;
	
		private function __construct(){}

		static function getControleurArticle():ControleurArticle{
			if(self::$instanceCtrl == null){
				self::$instanceCtrl = new ControleurArticle();  
			}
			return self::$instanceCtrl;
		}

		function Ctrl_Article_Lister(){
			return DaoArticle::getDaoArticle()->Dao_Article_Lister(); 
	    }

		function Ctrl_Article_Enregistrer(){
			$nom = $_POST['nom'];
			$description = $_POST['description'];
			$categorie = $_POST['categorie'];
			$prix = $_POST['prix'];
			$etat = $_POST['etat'];
			$photo = $_POST['photo'];

			$article = new Article(0, $nom, $description, $categorie, $prix, $etat, $photo);
			return DaoArticle::getDaoArticle()->Dao_Article_Enregistrer($article); 
	    }

		function Ctrl_Article_Fiche($articleIda){
			return DaoArticle::getDaoArticle()->Dao_Article_Fiche($articleIda); 
		}

		function Ctrl_Article_Form_Modifier($articleIda){
			return DaoArticle::getDaoArticle()->Dao_Article_Form_Modifier($articleIda); 
		}

		function Ctrl_Article_Modifier($articleIda){
			return DaoArticle::getDaoArticle()->Dao_Article_Modifier($articleIda); 
		}

	    function Ctrl_Article_Actions(){
			$action = $_POST['action'];

			switch($action){
				case "enregistrer" :
					return $this->Ctrl_Article_Enregistrer();
				break;
				case "supprimer" :
					return $this->Ctrl_Article_Supprimer();
				break;
				case "listerTab" :
				case "listerCards" :
					return $this->Ctrl_Article_Lister();
				break;
				case "formModifier" :
					return $this->Ctrl_Article_Form_Modifier($_POST['articleIda']);
				break;
				case "ficheArticle" :
					return $this->Ctrl_Article_Fiche($_POST['articleIda']);
				break;
				case "modifierArticle" :
					return $this->Ctrl_Article_Modifier($_POST['articleIda']);
				break;
			}
	    }
	}

	// function Ctrl_Article_Enregistrer(){
	// 	global $tabRes;
	// 	$titre = $_POST['titre'];
	// 	$duree = $_POST['duree'];
	// 	$res = $_POST['res'];
	// 	try{
	// 		$instanceModele = ModeleDonnees::getInstanceModeleDonnees();
	// 		$pochete = $instanceModele->verserFichier("pochettes", "pochette", "avatar.jpg",$titre);
	// 		$requete = "INSERT INTO films VALUES(0,?,?,?,?)";
	// 		$stmt = $instanceModele->executer($requete,[$titre,$duree,$res,$pochete]);
	// 		$tabRes['action'] = "enregistrer";
	// 		$tabRes['msg'] = "Film bien enregistré";
	// 	}catch(Exception $e){
	// 	}finally{
	// 		unset($instanceModele);
	// 	}
	// }
	
	// function Ctrl_Article_Supprimer(){
	// 	global $tabRes;
	// 	$ida = $_POST['numE'];
	// 	try{
	// 		$requete = "SELECT * FROM films WHERE idf=?";
	// 		$instanceModele = ModeleDonnees::getInstanceModeleDonnees();
	// 		$stmt=$instanceModele->executer($requete,[$idf]);
	// 		if($ligne=$stmt->fetch(PDO::FETCH_OBJ)){
	// 			$instanceModele->enleverFichier("pochettes",$ligne->pochette);
	// 			$requete="DELETE FROM films WHERE idf=?";
	// 			$stmt=$instanceModele->executer($requete,[$idf]);
	// 			$tabRes['action']="enlever";
	// 			$tabRes['msg']="Film ".$idf." bien enlevé";
	// 		}
	// 		else{
	// 			$tabRes['action']="enlever";
	// 			$tabRes['msg']="Film ".$idf." introuvable";
	// 		}
	// 	}catch(Exception $e){
	// 	}finally{
	// 		unset($instanceModele);
	// 	}
	// }
	
    // function Ctrl_Article_Modifier(){
	// 	global $tabRes;
	// 	$titre=$_POST['titreF'];
	// 	$duree=$_POST['dureeF'];
	// 	$res=$_POST['resF'];
	// 	$idf=$_POST['idf'];
	// 	try{
	// 		//Recuperer ancienne pochette
	// 		$requete="SELECT pochette FROM films WHERE idf=?";
	// 		$instanceModele = ModeleDonnees::getInstanceModeleDonnees();
	// 		$stmt=$instanceModele->executer($requete,[$idf]);
	// 		$ligne=$stmt->fetch(PDO::FETCH_OBJ);
	// 		$anciennePochette=$ligne->pochette;
	// 		$pochette=$instanceModele->verserFichier("pochettes", "pochette",$anciennePochette,$titre);
			
	// 		$requete="UPDATE films SET titre=?,duree=?, res=?, pochette=? WHERE idf=?";
	// 		$stmt=$instanceModele->executer($requete,[$titre,$duree,$res,$pochette,$idf]);
	// 		$tabRes['action']="modifier";
	// 		$tabRes['msg']="Film $idf bien modifié";
	// 	}catch(Exception $e){
	// 	}finally{
	// 		unset($instanceModele);
	// 	}
	// }

    // function Ctrl_Article_Lister(){
	// 	global $tabRes;
	// 	$tabRes['action']="lister";
	// 	$requete = "SELECT * FROM articles";
	// 	try{
	// 		$instanceDao = DaoArticle::getDaoArticle();
	// 		$stmt = $instanceDao->executer($requete,[]);
	// 		$tabRes['listeArticles'] = array();
	// 		while($ligne = $stmt->fetch(PDO::FETCH_OBJ)){
	// 		    $tabRes['listeArticles'][] = $ligne;
	// 		}
	// 	}catch(Exception $e){
	// 	}finally{
	// 		unset($instanceDao);
	// 	}
	// }

	// function fiche(){
	// 	global $tabRes;
	// 	$idf=$_POST['numF'];
	// 	$tabRes['action']="fiche";
	// 	$requete="SELECT * FROM films WHERE idf=?";
	// 	try{
	// 		 $instanceModele = ModeleDonnees::getInstanceModeleDonnees();
	// 		 $stmt=$instanceModele->executer($requete,[$idf]);
	// 		 $tabRes['fiche']=array();
	// 		 if($ligne=$stmt->fetch(PDO::FETCH_OBJ)){
	// 		    $tabRes['fiche']=$ligne;
	// 			$tabRes['OK'] = true;
	// 		}
	// 		else{
	// 			$tabRes['OK'] = false;
	// 		}
	// 	}catch(Exception $e){
	// 	}finally{
	// 		unset($instanceModele);
	// 	}
	// }

	//******************************************************
	//  Contrôleur

?>