
<!DOCTYPE html>
<html>
<head>
	<title>Bibliothèque PMF</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="assets/css/custom.css" />
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
			<li><a href="admin.php">Administrateur</a></li>
			<li><a href="abonne.php">Abonnées</a></li>
		</ul>
	</div>

	<div class="marge"></div>

	<div class="cadre">
		<h2 class="connecter"><u>Inscription</u></h2>
		<form method="POST" action="inscrit.php">
			<div>
				<input class="style" type="email" name="mel" placeholder="Mail" size="45" />
			</div>
			<div class="marge2">
				<input class="style" type="password" name="motdepass" placeholder="Mot de Passe" size="45" />
			</div>
			
			<div class="marge2">
				<input class="style" type="text" name="nom" placeholder="Nom" size="45" />
			</div>
			<div class="marge2">
				<input class="style" type="text" name="prenom" placeholder="Prénom" size="45" />
			</div>
			<div class="marge2">
			<input class="appuie" type="submit" value= "Enregistrer" />
			</div>
		</form>




</body>

</html>