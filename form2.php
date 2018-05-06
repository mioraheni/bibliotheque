<?php

session_start();

include "database.php";


if(isset($_POST["motdepass"]) && isset($_POST["mel"]))
{
		$mail = htmlspecialchars($_POST["mel"]);
		$mdp = htmlspecialchars($_POST["motdepass"]);
		$mdp = sha1($mdp);
		$_SESSION['mail']=$mail;
		$_SESSION['mdp']=$mdp;

		$req = $bdd->prepare("SELECT * FROM Uder WHERE mail = :mail AND motdepasse = :mdp");
		$req->bindValue(":mail",$_SESSION['mail'], PDO::PARAM_STR);
        $req->bindValue(":pass",$_SESSION['mdp'], PDO::PARAM_STR);
		$req->execute();
		$count = $req->rowCount();

		if ($count==0) {
			
		}

		else{
			echo 0;
		}
}

?>