<?php
	
	include "database.php";
	
	$message = "";
	
	if(isset($_POST["id"]) && isset($_POST["motdepass"]) && isset($_POST["mel"]) && isset($_POST["nom"]) && isset($_POST["prenom"])){

		
		$abonne=$bdd->prepare('INSERT INTO Membre VALUES (:idmembre, :motdepasse, :mail, :nommembre, :prenommembre, NULL);');
		$abonne->bindValue(':idmembre',"haha",PDO::PARAM_STR); 
		$abonne->bindValue(':motdepasse',"TEST", PDO::PARAM_STR); 
		$abonne->bindValue(':mail',"TEST", PDO::PARAM_STR); 
		$abonne->bindValue(':nommembre',"TEST", PDO::PARAM_STR); 
		$abonne->bindValue(':prenommembre',"TEST", PDO::PARAM_STR);

		$abonne->execute();
		
		
		if($enregistrer){
			$message='Vous êtes bien inscrit!';
		}
		else{
			$message='Echec d\inscription';
		}
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