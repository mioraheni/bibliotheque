<?php
include "database.php";
if(isset($_POST["idUser"]) && $_POST["idUser"] != ""){
	$idUser = htmlspecialchars($_POST["idUser"]);
	$req = $bdd->prepare("SELECT * FROM USER WHERE idUser = :idUser");
	$req->bindValue(":idUser", $idUser, PDO::PARAM_STR);
	$req->execute();
	$livre = $req->fetch();

	$paramUser["idUser"] = $livre["idUser"];
	$paramUser["mail"] = utf8_encode($livre["mail"]);
	$paramUser["nomUser"] = utf8_encode($livre["nomUser"]);
	$paramUser["prenomUser"] = utf8_encode($livre["prenomUser"]);
	header("content-type: application/json");
	echo json_encode($paramUser);
}