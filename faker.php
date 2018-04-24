<?php

$faker = Faker\Factory::create('fr_FR');
	
	
		$mail = htmlspecialchars($_POST["mel"]);
		$mdp = htmlspecialchars($_POST["motdepass"]);
		$mdp = sha1($mdp);
		$nom = htmlspecialchars($_POST["nom"]);
		$prenom = htmlspecialchars($_POST["prenom"]);

		$abonne=$bdd->prepare("INSERT INTO User(mail, motdepasse, nomUser, prenomUser) VALUES (:mail, :motdepasse, :nomUser, :prenomUser)");
		
		for($i=0; $i<40; $i++){
			$mail = $faker->email;
			$mdp = sha1($faker->password);
			$nom = $faker->lastname;
			$prenom = $faker->firstname;

			$abonne->bindValue(':mail',$mail,PDO::PARAM_STR); 
			$abonne->bindValue(':motdepasse',$mdp, PDO::PARAM_STR); 
			$abonne->bindValue(':nomUser',$nom, PDO::PARAM_STR); 
			$abonne->bindValue(':prenomUser',$prenom, PDO::PARAM_STR);
			$enregistrer=$abonne->execute();


?>