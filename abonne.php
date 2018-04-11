<!DOCTYPE html>
<html>
<head>
	<title>Bibliothèque PMF</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/nav.css" />
	<link rel="stylesheet" type="text/css" href="css/abonne.css" />
</head>

<body>

	<a href="accueil.php"><div class="bord">
		<h1 class="titre">
			Bibliothèque de PMF
		</h1>
	</div></a>

	<div class="saut">
		<ul id="nav">
			<li><a href="accueil.php">Accueil</a></li>
			<li><a href="admin.php">Administrateur</a></li>
			<li><a href="#">Abonnées</a></li>
		</ul>
	</div>

	<div class="marge"></div>

	<div class="cadre">
		<h2 class="connecter"><u>Connexion</u></h2>
		<form method="POST" action="">
			<div>
				<input class="style" type="text" name="nom" placeholder="Identifiant" size="45" />
			</div>
			<div class="marge2">
				<input class="style" type="password" name="motdepasse" placeholder="Mot de Passe" size="45" />
			</div>
			<div class="marge2">
				<input class="appuie" type="submit" value= "Connecter" />
			</div>
		</form>
		
		<h3 class="connecter"><u>Inscription</u></h3>
			<div class="marge2">
				<a href = "inscription.php"><input class="appuie" type="submit" value= "S'inscrire" /></a>
			</div>
	</div>

	

</body>

</html>