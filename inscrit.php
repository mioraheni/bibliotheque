<?php
	
	try{
        $bdd = new PDO('mysql:host=localhost;dbname=Bibliotheque','root','root');
    }
	catch(Exception $e)
   	{
        die('Erreur : '.$e->getMessage());
   	}
   	


   	$abonne=$bdd->prepare('INSERT INTO Membre VALUES(:idmembre,:motdepasse,:mail,:nommembre,:prénommembre,NULL)');
   	$abonne->bindValue(':idmembre',$_POST('id'),PDO::PARAM_INT); 
   	$abonne->bindValue(':motdepasse',$_POST('motdepass'),PDO::PARAM_STR); 
   	$abonne->bindValue(':mail',$_POST('mel'),PDO::PARAM_STR); 
   	$abonne->bindValue(':nommembre',$_POST('nom'),PDO::PARAM_STR); 
   	$abonne->bindValue(':prénommembre',$_POST('prénom'),PDO::PARAM_STR); 

   	$enregistrer=$abonne->execute();

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
	<title>Bibliothèque PMF</title>
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