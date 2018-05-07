<?php

include "database.php";

if(isset($_POST["motdepass"]) && isset($_POST["remotdepass"]) && isset($_POST["mel"]) && isset($_POST["nom"]) && isset($_POST["prenom"]))
{
		$mail = htmlspecialchars($_POST["mel"]);
		$mdp = htmlspecialchars($_POST["motdepass"]);
		$mdp = sha1($mdp);
		$remdp = htmlspecialchars($_POST["remotdepass"]);
		$remdp = sha1($remdp);
		$nom = htmlspecialchars($_POST["nom"]);
		$prenom = htmlspecialchars($_POST["prenom"]);

		$req=$bdd->prepare("SELECT * FROM User WHERE mail = :mail");
		$req->bindValue(':mail',$mail,PDO::PARAM_STR);
		$req->execute();
		$count=$req->rowcount();

		if($count==0)
		{
			header("Location:inscription.php?error=1");
		}

		else
		{	
			$abonne=$bdd->prepare("INSERT INTO User(mail, motdepasse, nomUser, prenomUser) VALUES (:mail, :motdepasse, :nomUser, :prenomUser)");

			$abonne->bindValue(':mail',$mail,PDO::PARAM_STR); 
			$abonne->bindValue(':motdepasse',$mdp, PDO::PARAM_STR); 
			$abonne->bindValue(':nomUser',$nom, PDO::PARAM_STR); 
			$abonne->bindValue(':prenomUser',$prenom, PDO::PARAM_STR); 

			$enregistrer=$abonne->execute();
			header("Location:inscrit.php");
		}
}
	
?>

