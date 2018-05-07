<?php

session_start();

include "permissionAdmin.php";
include "database.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>Modification des utilisateurs</title>

	<?php include "require/includeCss.php"; ?>
</head>

<body class="home">
	<?php include "navbarConnexion.php"; ?>
	<div class="margeMembre jumbotron top-space">
		<div class="container">
			<h3>Gestion des utilisateurs</h3>
			
			<?php
			$req = $bdd->prepare("SELECT * FROM user");
			$req->execute();
			echo '<table class="table table-bordered text-center" style="margin-top:30px;">
					<tr>
						<th class="text-center">Mail</th>
						<th class="text-center">Nom utilisateur</th>
						<th class="text-center">Prenom utilisateur</th>
						<th class="text-center">Gestion</th>
					</tr>';
			while($user = $req->fetch()){
				echo "<tr data-idUser='" . $user["idUser"] . "'>";
					echo "<td class='mail_user'>" . utf8_encode($user["mail"]) . "</td>";
					echo "<td class='nom_user'>" . utf8_encode($user["nomUser"]) . "</td>";
					echo "<td class='prenom_user'>" . utf8_encode($user["prenomUser"]) . "</td>";
					echo "<td> <i data-idUser='" . $user["idUser"] . "' class='fa fa-edit editUser' style='cursor:pointer;'></i> <i class='fa fa-times deleteUser' data-idUser='" . $user["idUser"] . "' style='color:red; padding-left:20px; cursor:pointer;'></i> </td>";
				echo "</tr>";
			}
			echo "</table>";
			?>
		</div>
	</div>


	<?php include "footer.php"; ?>

	<!-- modal editing book -->
	<div class="modal fade modalEditUser" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Modification d'un utilisateur</h4>
				</div>
				<form method="POST" action="">
					<div class="modal-body">
						<div class="form-group">
							<label for="mail">Mail de la personne</label>
							<input type="text" id="mail" class="form-control" name="mail" placeholder="Entrer l'adresse mail">
						</div>
						<div class="form-group">
							<label for="nomUser">Nom de la personne</label>
							<input type="text" id="nomUser" class="form-control" name="nomUser" placeholder="Entrer le nom utilisateur">
						</div>
						<div class="form-group">
							<label for="editionLivre">Prénom de la personne</label>
							<input type="text" id="prenomUser" class="form-control" name="prenomUser" placeholder="Entrer le prénom utilisateur">
						</div>
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
						<button type="submit" class="btn btn-primary confirmEditUser">Valider les changements</button>
					</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</body>
	<?php include "require/includeJS.php"; ?>
</html>