<?php
include "database.php";
if(isset($_POST["idBook"]) && $_POST["idBook"] != ""){
	$idBook = htmlspecialchars($_POST["idBook"]);
	$req = $bdd->prepare("SELECT * FROM LIVRE WHERE ISBN = :isbn");
	$req->bindValue(":isbn", $idBook, PDO::PARAM_STR);
	$req->execute();
	$livre = $req->fetch();

	$paramLivre["ISBN"] = $livre["ISBN"];
	$paramLivre["titre"] = utf8_encode($livre["titre"]);
	$paramLivre["edition"] = utf8_encode($livre["edition"]);
	$req2 = $bdd->prepare("SELECT * FROM auteur WHERE idAuteur = :auteur");
	$req2->bindValue(":auteur", $livre["idAuteur"], PDO::PARAM_INT);
	$req2->execute();
	$auteur = $req2->fetch();
	$paramLivre["nomAuteur"] = utf8_encode($auteur["nomAuteur"]);
	$paramLivre["prenomAuteur"] = utf8_encode($auteur["prenomAuteur"]);
	$paramLivre["etat"] = utf8_encode($livre["etat"]);
	header("content-type: application/json");
	echo json_encode($paramLivre);
}