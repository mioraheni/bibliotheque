<?php
include "database.php";
if(isset($_POST["idUser"]) && $_POST["idUser"] != ""){
	$idUser = intval($_POST["idUser"]);
	//On supprime ses emprunts s'il en a, car sinon on va avoir des problemes avec la cohérence de la clé étrangère
	$req = $bdd->prepare("DELETE FROM EMPRUNTS WHERE idUser = :id");
	$req->bindValue(":id", $idUser, PDO::PARAM_INT);
	$req->execute();

	//On supprime l'utilisateur
	$req = $bdd->prepare("DELETE FROM USER WHERE idUser = :id");
	$req->bindValue(":id", $idUser, PDO::PARAM_INT);
	$req->execute();
	header("content-type: application/json");
	echo json_encode("sucess");
}else{
	header("location:manageUser.php");
}