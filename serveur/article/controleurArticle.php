<?php
	require_once("modeleArticle.php");
	$tabRes = array();

    function CtrF_Enregistrer(){
        $film = new Film(0,$_POST['titre'], (int)$_POST['duree'], $_POST['res'],"Pochette");
        return DaoFilm::getDaoFilm()->MdlF_Enregistrer($film);
    }

	function Ctrl_Article_Enregistrer(){
		global $tabRes;
		$titre = $_POST['titre'];
		$duree = $_POST['duree'];
		$res = $_POST['res'];
		try{
			$instanceModele = ModeleDonnees::getInstanceModeleDonnees();
			$pochete = $instanceModele->verserFichier("pochettes", "pochette", "avatar.jpg",$titre);
			$requete = "INSERT INTO films VALUES(0,?,?,?,?)";
			$stmt = $instanceModele->executer($requete,[$titre,$duree,$res,$pochete]);
			$tabRes['action'] = "enregistrer";
			$tabRes['msg'] = "Film bien enregistré";
		}catch(Exception $e){
		}finally{
			unset($instanceModele);
		}
	}
	
	function Ctrl_Article_Supprimer(){
		global $tabRes;
		$ida = $_POST['numE'];
		try{
			$requete = "SELECT * FROM films WHERE idf=?";
			$instanceModele = ModeleDonnees::getInstanceModeleDonnees();
			$stmt=$instanceModele->executer($requete,[$idf]);
			if($ligne=$stmt->fetch(PDO::FETCH_OBJ)){
				$instanceModele->enleverFichier("pochettes",$ligne->pochette);
				$requete="DELETE FROM films WHERE idf=?";
				$stmt=$instanceModele->executer($requete,[$idf]);
				$tabRes['action']="enlever";
				$tabRes['msg']="Film ".$idf." bien enlevé";
			}
			else{
				$tabRes['action']="enlever";
				$tabRes['msg']="Film ".$idf." introuvable";
			}
		}catch(Exception $e){
		}finally{
			unset($instanceModele);
		}
	}
	
    function Ctrl_Article_Modifier(){
		global $tabRes;
		$titre=$_POST['titreF'];
		$duree=$_POST['dureeF'];
		$res=$_POST['resF'];
		$idf=$_POST['idf'];
		try{
			//Recuperer ancienne pochette
			$requete="SELECT pochette FROM films WHERE idf=?";
			$instanceModele = ModeleDonnees::getInstanceModeleDonnees();
			$stmt=$instanceModele->executer($requete,[$idf]);
			$ligne=$stmt->fetch(PDO::FETCH_OBJ);
			$anciennePochette=$ligne->pochette;
			$pochette=$instanceModele->verserFichier("pochettes", "pochette",$anciennePochette,$titre);
			
			$requete="UPDATE films SET titre=?,duree=?, res=?, pochette=? WHERE idf=?";
			$stmt=$instanceModele->executer($requete,[$titre,$duree,$res,$pochette,$idf]);
			$tabRes['action']="modifier";
			$tabRes['msg']="Film $idf bien modifié";
		}catch(Exception $e){
		}finally{
			unset($instanceModele);
		}
	}

    function Ctrl_Article_Lister(){
		global $tabRes;
		$tabRes['action']="lister";
		$requete="SELECT * FROM films";
		try{
			 $instanceModele = ModeleDonnees::getInstanceModeleDonnees();
			 $stmt=$instanceModele->executer($requete,[]);
			 $tabRes['listeFilms']=array();
			 while($ligne=$stmt->fetch(PDO::FETCH_OBJ)){
			    $tabRes['listeFilms'][]=$ligne;
			}
		}catch(Exception $e){
		}finally{
			unset($instanceModele);
		}
	}

	function fiche(){
		global $tabRes;
		$idf=$_POST['numF'];
		$tabRes['action']="fiche";
		$requete="SELECT * FROM films WHERE idf=?";
		try{
			 $instanceModele = ModeleDonnees::getInstanceModeleDonnees();
			 $stmt=$instanceModele->executer($requete,[$idf]);
			 $tabRes['fiche']=array();
			 if($ligne=$stmt->fetch(PDO::FETCH_OBJ)){
			    $tabRes['fiche']=$ligne;
				$tabRes['OK'] = true;
			}
			else{
				$tabRes['OK'] = false;
			}
		}catch(Exception $e){
		}finally{
			unset($instanceModele);
		}
	}

	//******************************************************
	//  Contrôleur

	$action=$_POST['action'];
	switch($action){
		case "enregistrer" :
			return  $this->Ctrl_Article_Enregistrer();
		break;
		case "supprimer" :
			return  $this->Ctrl_Article_Supprimer();
		break;
		case "modifier" :
			return  $this->Ctrl_Article_Modifier();
		break;
        case "lister" :
			return  $this->Ctrl_Article_Lister();
		break;
	}

    echo json_encode($tabRes);
?>