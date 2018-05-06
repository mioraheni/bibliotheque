<?php

session_start();
if(!isset($_SESSION["idUser"]) && !isset($_SESSION["mail"])){
	header("location:index.php");
}
include "database.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>Connecter-Bibliothèque PMF</title>

	<?php include "require/includeCss.php"; ?>
</head>

<body class="home">
	<?php include "navbarConnexion.php"; ?>
	<div class="margeMembre jumbotron top-space">
		<div class="container">
			<h3>Bonjour <?php echo strtoupper($_SESSION["nom"]) . " " . ucfirst($_SESSION["prenomUser"]);?></h3>
			<h4>Vos réservations</h4>
				<?php
				$req = $bdd->prepare("SELECT * FROM emprunts WHERE idUser = :iduser");
				$req->bindValue(":iduser", $_SESSION["idUser"], PDO::PARAM_INT);
				$req->execute();

				while($mesLivres = $req->fetch()){
					$req2 = $bdd->prepare("SELECT * FROM livre WHERE ISBN = :isbn");
					$req2->bindValue(":isbn", $$mesLivres["ISBN"], PDO::PARAM_STR);
					$livre = $req2->fetch();
					var_dump($livre);
					echo $livre["titre"];
				}

				?>
			<h4>Votre liste d'envie</h4>
			<h4>Vos réservations</h4>
		</div>
	</div>


	<?php include "footer.php"; ?>
		
</body>
	<?php include "require/includeJS.php"; ?>
</html>