<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>Connexion-Bibliothque PMF</title>
	
	<?php include "require/includeCss.php"; ?>
</head>

<body style="background-image: url(assets/images/bibliotheques.jpg); background-repeat: no-repeat; background-size: 100%;">
	<?php include "nav2.php"; ?>


	<div class="container">

		<div class="row">
			<div class="marge3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
				<div class="panel panel-default">
					<div style="padding: 100px">
						<h3 class="thin text-center"><strong>Connexion</strong></h3>
						<form method="POST" action="form2.php">
							<div class="top-margin">
								<input type="text" class="form-control" placeholder="Entrez votre adresse mail" name="mel">
							</div>
							<div class="top-margin">
								<input type="password" class="form-control" placeholder="Entrez votre mot de passe" name="motdepass">
							</div>

							<hr>

							<div class="row">
								<div class="col-lg-8">
									<b><a href="inscription.php">S'inscrire?</a></b>
								</div>
								<div class="col-lg-4 text-right">
									<input class="appuie" type="submit" value="Se Connecter">
								</div>
							</div>
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>	
	

	<?php include "footer.php"; ?>

	<?php include "require/includeJS.php"; ?>
</body>
</html>