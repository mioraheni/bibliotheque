<?php
include "database.php";
if(isset($_POST["ISBNAdding"]) && isset($_POST["titreLivreAdding"]) && isset($_POST["editionLivreAdding"]) && isset($_POST["nomAuteurAdding"]) && isset($_POST["prenomAuteurAdding"]) && isset($_POST["etatLivreAdding"]) && $_POST["ISBNAdding"] != "" && $_POST["titreLivreAdding"] != "" && $_POST["editionLivreAdding"] != "" && $_POST["nomAuteurAdding"] != "" && $_POST["prenomAuteurAdding"] != "" && $_POST["etatLivreAdding"] != ""){

	$ISBN = htmlspecialchars($_POST["ISBNAdding"]);
	$titreLivre = ucwords(strtolower(htmlspecialchars($_POST["titreLivreAdding"])));
	$editionLivre = ucwords(strtolower(htmlspecialchars($_POST["editionLivreAdding"])));
	$nomAuteur = ucwords(strtolower(htmlspecialchars($_POST["nomAuteurAdding"])));
	$prenomAuteur = ucwords(strtolower(htmlspecialchars($_POST["prenomAuteurAdding"])));
	$etatLivreEdit = htmlspecialchars($_POST["etatLivreAdding"]);

	$req = $bdd->prepare("SELECT * FROM LIVRE WHERE ISBN = :isbn");
	$req->bindValue(":isbn", $ISBN, PDO::PARAM_STR);
	$req->execute();
	$count = $req->rowCount();
	if($count == 0){
		$req = $bdd->prepare("SELECT * FROM AUTEUR WHERE nomAuteur like :nomAuteur AND prenomAuteur like :prenomAuteur ");
		$req->bindValue(":nomAuteur", $nomAuteur, PDO::PARAM_STR);
		$req->bindValue(":prenomAuteur", $prenomAuteur, PDO::PARAM_STR);
		$req->execute();
		$count = $req->rowCount();
		if($count == 0){
			$req = $bdd->prepare("INSERT INTO auteur (idAuteur, nomAuteur, prenomAuteur) VALUES (NULL, :nomAuteur, :prenomAuteur)");
			$req->bindValue(":nomAuteur", $nomAuteur, PDO::PARAM_STR);
			$req->bindValue(":prenomAuteur", $prenomAuteur, PDO::PARAM_STR);
			$req->execute();
			$idAuteur = $bdd->lastInsertId();
		}else{
			$auteur = $req->fetch();
			$idAuteur = $auteur["idAuteur"];
		}
	
		$req = $bdd->prepare("INSERT INTO livre (ISBN, titre, edition, idAuteur, etat) VALUES (:isbn, :titreLivre, :editionLivre, :idAuteur, :etatLivreEdit)");
		$req->bindValue(":isbn", $ISBN, PDO::PARAM_STR);
		$req->bindValue(":titreLivre", $titreLivre, PDO::PARAM_STR);
		$req->bindValue(":editionLivre", $editionLivre, PDO::PARAM_STR);
		$req->bindValue(":idAuteur", $idAuteur, PDO::PARAM_INT);
		$req->bindValue(":etatLivreEdit", $etatLivreEdit, PDO::PARAM_STR);
		$req->bindValue(":isbn", $ISBN, PDO::PARAM_STR);
		$req->execute();

		$livre = $req->fetch();
		$paramLivre["ISBN"] = $ISBN;  
		$paramLivre["titre"] = $titreLivre; 
		$paramLivre["edition"] = $editionLivre;  
		$paramLivre["nomAuteur"] = $nomAuteur;  
		$paramLivre["prenomAuteur"] = $prenomAuteur;  
		$paramLivre["etat"] = $etatLivreEdit;  
		
		header("content-type: application/json");
		echo json_encode($paramLivre);	
	}else{
		header("content-type: application/json");
		$paramLivre["error"] = "ISBN déjà existant, veuillez en choisir un autre";
		echo json_encode($paramLivre);
		exit;
	}

}else{
	header("content-type: application/json");
	$paramLivre["error"] = "Veuillez remplir tous les champs du formulaire";
	echo json_encode($paramLivre);
}