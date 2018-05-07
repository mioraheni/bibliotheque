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
	
	<title>Modification de la bibliothèque</title>

	<?php include "require/includeCss.php"; ?>
</head>

<body class="home">
	<?php include "navbarConnexion.php"; ?>
	<div class="margeMembre jumbotron top-space">
		<div class="container">
			<h3>Gestion des livres existants</h3>
			
			<?php
			$req = $bdd->prepare("SELECT * FROM livre");
			$req->execute();
			echo '<table class="table">
					<tr>
						<th>ISBN</th>
						<th>Titre du livre</th>
						<th>Edition</th>
						<th>Auteur</th>
						<th>Etat</th>
						<th>Gestion</th>
					</tr>';
			while($livre = $req->fetch()){
				echo "<tr>";
					echo "<td>" . utf8_encode($livre["ISBN"]) . "</td>";
					echo "<td>" . utf8_encode($livre["titre"]) . "</td>";
					echo "<td>" . utf8_encode($livre["edition"]) . "</td>";
					$req2 = $bdd->prepare("SELECT * FROM auteur WHERE idAuteur = :auteur");
					$req2->bindValue(":auteur", $livre["idAuteur"], PDO::PARAM_INT);
					$req2->execute();
					$auteur = $req2->fetch();
					echo "<td>" . utf8_encode($auteur["prenomAuteur"]) . " " . utf8_encode($auteur["nomAuteur"]) . "</td>";
					$etatLivre = utf8_encode($livre["etat"]);
					if($etatLivre == "Disponible"){
						echo "<td style='color:green'>"; 
					}else if($etatLivre == "Non Disponible"){
						echo "<td style='color:red'>";
					}else if($etatLivre == "Commandé"){
						echo "<td style='color:orange'>";
					}

					echo utf8_encode($livre["etat"]) . "</td>";
					echo "<td> <i data-idBook='" . $livre["ISBN"] . "' class='fa fa-edit editBook' style='cursor:pointer;'></i> <i class='fa fa-times deleteBook' data-idBook='" . $livre["ISBN"] . "' style='color:red; padding-left:20px; cursor:pointer;'></i> </td>";
				echo "</tr>";
			}
			echo "</table>";
			?>
		</div>
	</div>


	<?php include "footer.php"; ?>
	<div class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Modification d'un livre</h4>
				</div>
				<form method="POST" action="">
					<div class="modal-body">
						<div class="form-group">
							<label for="ISBN">ISBN du livre</label>
							<input type="text" id="ISBN" class="form-control" name="ISBN" placeholder="Entrer le ISBN">
						</div>
						<div class="form-group">
							<label for="titreLivre">Titre du livre</label>
							<input type="text" id="titreLivre" class="form-control" name="titre" placeholder="Entrer le titre">
						</div>
						<div class="form-group">
							<label for="editionLivre">Edition du livre</label>
							<input type="text" id="editionLivre" class="form-control" name="edition" placeholder="Entrer le edition">
						</div>
						<div class="form-group">
							<label for="nomAuteur">Nom de l'auteur du livre</label>
							<input type="text" id="nomAuteur" class="form-control" name="idAuteur" placeholder="Entrer le nom de l'auteur">
						</div>
						<div class="form-group">
							<label for="prenomAuteur">Prénom de l'auteur du livre</label>
							<input type="text" id="prenomAuteur" class="form-control" name="idAuteur" placeholder="Entrer le prénom de l'auteur">
						</div>
						<div class="form-group">
							<label>Etat du livre</label>
							<select name="etat" id="etatLivreEdit" class="form-control">
								<option value="">Veuillez choisir l'état</option>
								<option value="Disponible">Disponible</option>
								<option value="Non Disponible">Non Disponible</option>
								<option value="Commandé">Commandé</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
						<button type="button" class="btn btn-primary confirmEditBook">Valider les changements</button>
					</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</body>
	<?php include "require/includeJS.php"; ?>
</html>