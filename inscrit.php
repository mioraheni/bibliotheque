<?php
	
	include "database.php";
	include "Faker/src/autoload.php";

	$faker = Faker\Factory::create('fr_FR');
	
	
	
	
	if(isset($_POST["motdepass"]) && isset($_POST["mel"]) && isset($_POST["nom"]) && isset($_POST["prenom"])){
		$mail = htmlspecialchars($_POST["mel"]);
		$mdp = htmlspecialchars($_POST["motdepass"]);
		$mdp = sha1($mdp);
		$nom = htmlspecialchars($_POST["nom"]);
		$prenom = htmlspecialchars($_POST["prenom"]);

		$abonne=$bdd->prepare("INSERT INTO User(mail, motdepasse, nomUser, prenomUser) VALUES (:mail, :motdepasse, :nomUser, :prenomUser)");
		//creation de personne faker
		/*for($i=0; $i<40; $i++){
			$mail = $faker->email;
			$mdp = sha1($faker->password);
			$nom = $faker->lastname;
			$prenom = $faker->firstname;

			$abonne->bindValue(':mail',$mail,PDO::PARAM_STR); 
			$abonne->bindValue(':motdepasse',$mdp, PDO::PARAM_STR); 
			$abonne->bindValue(':nomUser',$nom, PDO::PARAM_STR); 
			$abonne->bindValue(':prenomUser',$prenom, PDO::PARAM_STR);
			$enregistrer=$abonne->execute();
		}*/

		// création classique 
		$abonne->bindValue(':mail',$mail,PDO::PARAM_STR); 
		$abonne->bindValue(':motdepasse',$mdp, PDO::PARAM_STR); 
		$abonne->bindValue(':nomUser',$nom, PDO::PARAM_STR); 
		$abonne->bindValue(':prenomUser',$prenom, PDO::PARAM_STR); 

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
	<link rel="stylesheet" type="text/css" href="assets/css/custom.css" />

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