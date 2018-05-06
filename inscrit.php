<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>Inscrit-Bibliothque PMF</title>
	
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen" >
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/custom.css">
</head>

<body style="background-image: url(assets/images/bibliotheques.jpg); background-repeat: no-repeat; background-size: 100%;">

	<?php include "nav2.php";?>

	<div class="container">

		<div class="row">
				<div class="marge3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div style="padding: 100px; text-align: center;">
							<p class="texte"><?php echo 'Vous êtes bien inscrit!';?></p>
							<a href="signin.php"><input class="appuie" type="submit" value= "Se Connecter" /></a>
						</div>
					</div>
				</div>	
		</div>

	</div>	
	

	<?php include "footer.php";?>
		

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="assets/js/headroom.min.js"></script>
	<script src="assets/js/jQuery.headroom.min.js"></script>
	<script src="assets/js/template.js"></script>

</body>
</html>