<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>Connexion-Bibliothque PMF</title>
	
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen" >
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/custom.css">
</head>

<body style="background-image: url(assets/images/bibliotheques.jpg); background-repeat: no-repeat; background-size: 100%;">
	<?php include "nav2.php"; ?>

	<?php
	if(isset($_GET["error"]) && $_GET["error"] != ""){
		$error = intval($_GET["error"]);

		switch ($error) {
			case 1:
				$badRequest = "Le mail existe déjà";
				break;
			case 2:
				$badRequest = "Le mot de passe ne correspond pas";
				break;
			
			default:
				$badRequest = "";
				break;
		}
	}

	?>

	<div class="container">

		<div class="row">
			
				
				<div class="marge3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div style="padding: 100px">
							<h3 class="thin text-center"><strong>Inscription</strong></h3>
							<span style="color:red;"><?php echo $badRequest; ?></span>
							<form method="POST" action="inscrit.php">
								<div class="top-margin">
									<input type="email" id="mail" class="form-control" name="mel" placeholder="Mail" required size="45" />
								</div>
								<div class="top-margin">
									<input type="password" class="form-control" name="motdepass" placeholder="Mot de passe" required size="45" />
								</div>
								<div class="top-margin">
									<input type="password" class="form-control" name="motdepass" placeholder="Verification du Mot de passe" required size="45" />
								</div>
								<div class="top-margin">
									<input type="text" class="form-control" name="nom" placeholder="Nom" required size="45" />
								</div>
								<div class="top-margin">
									<input type="text" class="form-control" name="prenom" placeholder="Prenom" required size="45" />
								</div>
								<div class=" text-center top-margin">
									<input  class=" appuie" type="submit" value="Enregistrer">
								</div>
							</form>
						</div>
					</div>

				</div>
				
			

		</div>
	</div>	
	

	<?php include "footer.php"; ?>
		




	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="assets/js/headroom.min.js"></script>
	<script src="assets/js/jQuery.headroom.min.js"></script>
	<script src="assets/js/template.js"></script>

</body>
</html>