<?php
include "database.php";
if(isset($_POST["ISBNAdding"]) && isset($_POST["titreLivreAdding"]) && isset($_POST["editionLivreAdding"]) && isset($_POST["nomAuteurAdding"]) && isset($_POST["prenomAuteurAdding"]) && isset($_POST["etatLivreAdding"]) && $_POST["ISBNAdding"] != "" && $_POST["titreLivreAdding"] != "" && $_POST["editionLivreAdding"] != "" && $_POST["nomAuteurAdding"] != "" && $_POST["prenomAuteurAdding"] != "" && $_POST["etatLivreAdding"] != ""){

	$ISBN = (htmlspecialchars($_POST["ISBNAdding"]));
	$titreLivre = utf8_decode(htmlspecialchars($_POST["titreLivreAdding"]));
	$editionLivre = (htmlspecialchars($_POST["editionLivreAdding"]));
	$nomAuteur = utf8_decode(ucfirst(ucwords(htmlspecialchars($_POST["nomAuteurAdding"]))));
	$prenomAuteur = (ucfirst(ucwords(htmlspecialchars($_POST["prenomAuteurAdding"]))));
	$etatLivreEdit = utf8_decode(htmlspecialchars($_POST["etatLivreAdding"]));

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
		$paramLivre["titre"] = utf8_encode($titreLivre); 
		$paramLivre["edition"] = utf8_encode($editionLivre);  
		$paramLivre["nomAuteur"] = utf8_encode($nomAuteur);  
		$paramLivre["prenomAuteur"] = utf8_encode($prenomAuteur);  
		$paramLivre["etat"] = utf8_encode($etatLivreEdit);  
		
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