<div class="navbar navbar-inverse navbar-fixed-top headroom" >
	<div class="container">
		<div class="navbar-header">
			<img src="assets/images/logo.png" width="200px" height="50px">
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav pull-right">
				<li class="active"><a href="connecter.php">Accueil</a></li>
				<?php
				if($_SESSION["admin"] == 1){
				?>
				<li><a href="manageBiblio.php">Gestion Bibliothèque</a></li>
				<li><a href="reservation.php">Gestion Utilisateur</a></li>
				<li><a href=""></a>
				<?php
				}else{

				?>
				<li><a href="reservation.php">Rechercher un livre</a></li>
				<li><a href="reservation.php">Rechercher un livre par auteur</a></li>
				<li><a href=""></a>
				<?php 
				}
				?>
				<li><a class="btn" href="disconnect.php">Déconnexion</a></li>
			</ul>
		</div>
	</div>
</div>