<?php
include "database.php";
if(isset($_POST["ancienISBN"]) && isset($_POST["ISBN"]) && isset($_POST["titreLivre"]) && isset($_POST["editionLivre"]) && isset($_POST["nomAuteur"]) && isset($_POST["prenomAuteur"]) && isset($_POST["etatLivreEdit"]) && $_POST["ISBN"] != "" && $_POST["titreLivre"] != "" && $_POST["editionLivre"] != "" && $_POST["nomAuteur"] != "" && $_POST["prenomAuteur"] != "" && $_POST["etatLivreEdit"] != "" && $_POST["ancienISBN"] != ""){

	$ancienISBN = (htmlspecialchars($_POST["ancienISBN"]));
	$ISBN = (htmlspecialchars($_POST["ISBN"]));
	$titreLivre = (htmlspecialchars($_POST["titreLivre"]));
	$editionLivre = (htmlspecialchars($_POST["editionLivre"]));
	$nomAuteur = utf8_decode(ucfirst(ucwords(htmlspecialchars($_POST["nomAuteur"]))));
	$prenomAuteur = (ucfirst(ucwords(htmlspecialchars($_POST["prenomAuteur"]))));
	$etatLivreEdit = (htmlspecialchars($_POST["etatLivreEdit"]));

	if($ISBN != $ancienISBN){
		$req = $bdd->prepare("SELECT * FROM LIVRE WHERE ISBN = :isbn");
		$req->bindValue(":isbn", $ISBN, PDO::PARAM_STR);
		$count = $req->rowCount();
		if($count == 0){
			$req = $bdd->prepare("UPDATE LIVRE SET ISBN = :isbn WHERE ISBN = :ancienISBN");
			$req->bindValue(":isbn", $ISBN, PDO::PARAM_STR);
			$req->bindValue(":ancienISBN", $ancienISBN, PDO::PARAM_STR);
			$req->execute();
		}else{
			$paramLivre = "ISBN déjà existant";
		}
	}

	$req = $bdd->prepare("SELECT * FROM AUTEUR WHERE nomAuteur like :nomAuteur AND prenomAuteur like :prenomAuteur ");
	$req->bindValue(":nomAuteur", $nomAuteur, PDO::PARAM_STR);
	$req->bindValue(":prenomAuteur", $prenomAuteur, PDO::PARAM_STR);
	$req->execute();
	$test =	$req->fetch();
	$count = $req->rowCount();
	if($count == 0){
		$req = $bdd->prepare("INSERT INTO AUTEUR VALUES ('', :nomAuteur, :prenomAuteur)");
		$req->bindValue(":nomAuteur", $nomAuteur, PDO::PARAM_STR);
		$req->bindValue(":prenomAuteur", $prenomAuteur, PDO::PARAM_STR);
		$req->execute();
		$idAuteur = $req->lastInsertId();
	}else{
		$auteur = $req->fetch();
		$idAuteur = $auteur["idAuteur"];
	}
		
	$req = $bdd->prepare("UPDATE LIVRE SET titre = :titreLivre, edition = :editionLivre, idAuteur = :idAuteur, etat = :etatLivreEdit WHERE ISBN = :isbn");
	$req->bindValue(":titreLivre", $titreLivre, PDO::PARAM_STR);
	$req->bindValue(":editionLivre", $editionLivre, PDO::PARAM_STR);
	$req->bindValue(":idAuteur", $idAuteur, PDO::PARAM_INT);
	$req->bindValue(":etatLivreEdit", $etatLivreEdit, PDO::PARAM_STR);
	$req->bindValue(":isbn", $ISBN, PDO::PARAM_STR);
	$req->execute();

	$livre = $req->fetch();
	$paramLivre["ISBN"] = $ISBN;  
	$paramLivre["titre"] = utf8_decode($titreLivre); 
	$paramLivre["edition"] = $editionLivre;  
	$paramLivre["nomAuteur"] = $nomAuteur;  
	$paramLivre["prenomAuteur"] = $prenomAuteur;  
	$paramLivre["etat"] = $etatLivreEdit;  
	
	header("content-type: application/json");
	echo json_encode($paramLivre);	
}else{
	header("location:manageBiblio.php");
}