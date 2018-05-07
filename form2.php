<?php

include "database.php";


if(isset($_POST["motdepass"]) && isset($_POST["mel"]))
{
	$mail = htmlspecialchars($_POST["mel"]);
	$mdp = htmlspecialchars($_POST["motdepass"]);
	$mdp = sha1($mdp);
	$req = $bdd->prepare("SELECT * FROM user WHERE mail = :mail AND motdepasse = :pass");
	$req->bindValue(":mail", $mail, PDO::PARAM_STR);
	$req->bindValue(":pass", $mdp, PDO::PARAM_STR);
	$req->execute();
	$count = $req->rowCount();
	echo $count;
	if ($count==1) {
		$user = $req->fetch();
		
		session_start();
		$_SESSION["idUser"] = $user["idUser"];
		$_SESSION["mail"] = $user["mail"];
		$_SESSION["nom"] = $user["nomUser"];
		$_SESSION["prenomUser"] = $user["prenomUser"];
		ob_start();
		if($mail == "admin" || $mail == "rasmiora@gmail.com" || $mail == "xxbingru@gmail.com"){
			$_SESSION["admin"] = 1;
		}
		header("location:connecter.php");
	}else{
		header("location:signin.php?error=Mauvais identifiant ou mot de passe");
	}
}

else{
	header("location:index.php");
}

?>