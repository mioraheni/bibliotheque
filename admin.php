<?php
	
?>





<!DOCTYPE html>
<html>
<head>
	<title>Bibliothèque PMF</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/nav.css" />
	<link rel="stylesheet" type="text/css" href="css/admin.css" />
</head>

<body>

	<div class="bord">
		<h1 class="titre">
			Bibliothèque de PMF
		</h1>
	</div>

	<div class="saut">
		<ul id="nav">
			<li><a href="accueil.php">Accueil</a></li>
			<li><a href="#">Administrateur</a></li>
			<li><a href="abonne.php">Abonnées</a></li>
		</ul>
	</div>

	<div class="marge"></div>

	<div class="cadre">
		<h2 class="connecter"><u>Connexion</u></h2>
		<form method="POST" action="adminconnecte.php">
			<div>
				<input class="style" type="text" name="nom" placeholder="Identifiant" required size="45" />
			</div>
			<div class="marge2">
				<input class="style" type="password" name="motdepasse" placeholder="Mot de Passe" required size="45" />
			</div>
			<div class="marge2">
				<input class="appuie" type="submit" value= "Connecter" />
			</div>
		</form>
	</div>

</body>

</html>