<?php
include "database.php";
if(isset($_POST["idUser"]) && isset($_POST["mail"]) && isset($_POST["nomUser"]) && isset($_POST["prenomUser"]) && $_POST["idUser"] != "" && $_POST["mail"] != "" && $_POST["nomUser"] != "" && $_POST["prenomUser"] != "" ){

	$idUser = intval(htmlspecialchars($_POST["idUser"]));
	$mail = strtolower(htmlspecialchars($_POST["mail"]));
	$nomUser = ucwords(strtolower(htmlspecialchars($_POST["nomUser"])));
	$prenomUser = ucwords(strtolower(htmlspecialchars($_POST["prenomUser"])));

	$req = $bdd->prepare("SELECT * FROM USER WHERE idUser = :idUser");
	$req->bindValue(":idUser", $idUser, PDO::PARAM_INT);
	$req->execute();
	$userEdit = $req->fetch();

	$actualMail = strtolower($userEdit["mail"]);

	$count = $req->rowCount();
	if($count == 0){
		header("content-type: application/json");
		$paramUser["error"] = "L'utilisateur n'existe pas";
		echo json_encode($paramUser);
		exit;
	}else{
		$req = $bdd->prepare("SELECT * FROM USER WHERE mail = :mail");
		$req->bindValue(":mail", $mail, PDO::PARAM_STR);
		$req->execute();
		$count = $req->rowCount();
		if($count == 0 || $actualMail == $mail){
			$req = $bdd->prepare("UPDATE USER SET mail = :mail, nomUser = :nomUser, prenomUser = :prenomUser WHERE idUser = :idUser");
			$req->bindValue(":mail", $mail, PDO::PARAM_STR);
			$req->bindValue(":nomUser", $nomUser, PDO::PARAM_STR);
			$req->bindValue(":prenomUser", $prenomUser, PDO::PARAM_STR);
			$req->bindValue(":idUser", $idUser, PDO::PARAM_INT);
			$req->execute();

			$paramUser["idUser"] = $idUser;  
			$paramUser["mail"] = $mail; 
			$paramUser["nomUser"] = $nomUser;  
			$paramUser["prenomUser"] = $prenomUser;
			
			header("content-type: application/json");
			echo json_encode($paramUser);
		}else{
			header("content-type: application/json");
			$paramUser["error"] = "L'adresse mail existe déjà, veuillez en saisir un autre";
			echo json_encode($paramUser);
		}
	}
}else{
	header("content-type: application/json");
	$paramUser["error"] = "Veuillez remplir tous les champs du formulaire";
	echo json_encode($paramUser);
}