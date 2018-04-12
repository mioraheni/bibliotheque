<?php
	
	include "database.php";
	
	
	if(isset($_POST["motdepass"]) && isset($_POST["mel"]) && isset($_POST["nom"]) && isset($_POST["prenom"]))
	{

		
		$abonne=$bdd->prepare("INSERT INTO User(mail, motdepasse, nomUser, prenomUser) VALUES (:mail, :motdepasse, :nomUser, :prenomUser)");
		$abonne->bindValue(':mail',$_POST["mel"],PDO::PARAM_STR); 
		$abonne->bindValue(':motdepasse',$_POST["motdepass"], PDO::PARAM_STR); 
		$abonne->bindValue(':nomUser',$_POST["nom"], PDO::PARAM_STR); 
		$abonne->bindValue(':prenomUser',$_POST["prenom"], PDO::PARAM_STR); 

		$enregistrer=$abonne->execute();
	}
		
		if($enregistrer){
			$message='Vous êtes bien inscrit!';
		}
		else{
			$message='Echec d\inscription';
		}
	

?>
<!DOCTYPE html>
<html>
<head>
	<title>Bibliothèque PMF </title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/nav.css" />
	<link rel="stylesheet" type="text/css" href="css/abonne.css" />
</head>

<body>

	<div class="bord">
		<h1 class="titre">
			Bibliothèque de PMF
		</h1>
	</div>

	<div class="marge"></div>

	<p class="texte"><?php echo $message; ?></p>

	<div class="marge"></div>

	<div class="cadre">
		<a href="abonne.php"><input class="appuie" type="submit" value= "Se Connecter" /></a>
	</div>

</body>
</html>