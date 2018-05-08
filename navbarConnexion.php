<div class="navbar navbar-inverse navbar-fixed-top headroom" >
	<div class="container">
		<div class="navbar-header">
			<img src="assets/images/logo.png" width="200px" height="50px">
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav pull-right navbarConnexion">
				<li id="index"><a href="connecter.php">Accueil</a></li>
				<?php
				if($_SESSION["admin"] == 1){
				?>
				<li id="manageBiblio"><a href="manageBiblio.php">Gestion Bibliothèque</a></li>
				<li id="manageUser"><a href="manageUser.php">Gestion Utilisateur</a></li>
				<li><a href=""></a>
				<?php
				}else{

				?>
				<li><a href="reservation.php">Emprunter un livre</a></li>
				<li><a href=""></a>
				<?php 
				}
				?>
				<li><a class="btn" href="disconnect.php">Déconnexion</a></li>
			</ul>
		</div>
	</div>
</div>