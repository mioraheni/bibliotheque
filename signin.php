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

</head>

<body>
	<?php include "nav.php"; ?>


	<div class="container">

		<div class="row">
			
				
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div style="padding: 100px">
							<h3 class="thin text-center"><strong>Connexion</strong></h3>
							
							<form>
								<div class="top-margin">
									<input type="text" class="form-control" placeholder="Entrez votre identifiant">
								</div>
								<div class="top-margin">
									<input type="password" class="form-control" placeholder="Entrez votre mot de passe">
								</div>

								<hr>

								<div class="row">
									<div class="col-lg-8">
										<b><a href="">S'inscrire?</a></b>
									</div>
									<div class="col-lg-4 text-right">
										<button class="btn btn-action" type="submit">Se connecter</button>
									</div>
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