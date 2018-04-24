<?php

if(isset($_POST["motdepass"]) && isset($_POST["mel"]) && isset($_POST["nom"]) && isset($_POST["prenom"]))
{
		$mail = htmlspecialchars($_POST["mel"]);
		$mdp = htmlspecialchars($_POST["motdepass"]);
		$mdp = sha1($mdp);
		$nom = htmlspecialchars($_POST["nom"]);
		$prenom = htmlspecialchars($_POST["prenom"]);


		$req=$bdd->prepare("SELECT * FROM User WHERE mail = :mail");
		$req->execute();
        $count = $req->rowCount();

		if($count==1)
		{
			$abonne=$bdd->prepare("INSERT INTO User(mail, motdepasse, nomUser, prenomUser) VALUES (:mail, :motdepasse, :nomUser, :prenomUser)");

			$abonne->bindValue(':mail',$mail,PDO::PARAM_STR); 
			$abonne->bindValue(':motdepasse',$mdp, PDO::PARAM_STR); 
			$abonne->bindValue(':nomUser',$nom, PDO::PARAM_STR); 
			$abonne->bindValue(':prenomUser',$prenom, PDO::PARAM_STR); 

			$enregistrer=$abonne->execute();
			header("Location: inscrit.php");
		}

		else
		{
			header("Location: inscription.php?error=1");
		}
}
	
?>

