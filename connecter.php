<?php

session_start();
if(!isset($_SESSION["idUser"]) && !isset($_SESSION["mail"])){
	header("location:index.php");
}

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
		<h3>Bonjour <?php echo strtoupper($_SESSION["nom"]) . " " . ucfirst($_SESSION["prenomUser"]);?></h3>
		<div class="container">
			
		</div>
	</div>


	<?php include "footer.php"; ?>
		
</body>
	<?php include "require/includeJS.php"; ?>
</html>