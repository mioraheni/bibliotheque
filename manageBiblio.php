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
			<h3>Gestion des livres <button class="btn btn-default addBook"><i class="fa fa-plus"></i> Ajouter un livre</button></h3>
			
			<?php
			$req = $bdd->prepare("SELECT * FROM livre");
			$req->execute();
			echo '<table class="table table-bordered text-center" style="margin-top:30px;">
					<tr>
						<th class="text-center">ISBN</th>
						<th class="text-center">Titre du livre</th>
						<th class="text-center">Edition</th>
						<th class="text-center">Auteur</th>
						<th class="text-center">Etat</th>
						<th class="text-center">Gestion</th>
					</tr>';
			while($livre = $req->fetch()){
				echo "<tr data-idbook='" . $livre["ISBN"] . "'>";
					echo "<td class='ISBN_Livre'>" . utf8_encode($livre["ISBN"]) . "</td>";
					echo "<td class='titre_Livre'>" . utf8_encode($livre["titre"]) . "</td>";
					echo "<td class='edition_Livre'>" . utf8_encode($livre["edition"]) . "</td>";
					$req2 = $bdd->prepare("SELECT * FROM auteur WHERE idAuteur = :auteur");
					$req2->bindValue(":auteur", $livre["idAuteur"], PDO::PARAM_INT);
					$req2->execute();
					$auteur = $req2->fetch();
					echo "<td class='idAuteur_livre'>" . utf8_encode($auteur["prenomAuteur"]) . " " . utf8_encode($auteur["nomAuteur"]) . "</td>";
					$etatLivre = utf8_encode($livre["etat"]);
					if($etatLivre == "Disponible"){
						$couleur = "green";
					}else if($etatLivre == "Non Disponible"){
						$couleur = "red";
					}else if($etatLivre == "Commande"){
						$couleur = "orange";
					}
					//Définit la couleur selon l'état du livre
					echo "<td class='etat_Livre' style='color:" . $couleur . "'>";

					echo utf8_encode($livre["etat"]) . "</td>";
					echo "<td> <i data-idBook='" . $livre["ISBN"] . "' class='fa fa-edit editBook' style='cursor:pointer;'></i> <i class='fa fa-times deleteBook' data-idBook='" . $livre["ISBN"] . "' style='color:red; padding-left:20px; cursor:pointer;'></i> </td>";
				echo "</tr>";
			}
			echo "</table>";
			?>
		</div>
	</div>


	<?php include "footer.php"; ?>

	<!-- modal editing book -->
	<div class="modal fade modalEdit" tabindex="-1" role="dialog">
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
								<option value="Commande">Commande</option>
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
	
	<!-- modal adding book -->
	<div class="modal fade modalAdding" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Ajout d'un livre</h4>
				</div>
				<form method="POST" action="">
					<div class="modal-body">
						<div class="form-group">
							<label for="ISBN">ISBN du livre</label>
							<input type="text" id="ISBNAdding" class="form-control" name="ISBN" placeholder="Entrer le ISBN">
						</div>
						<div class="form-group">
							<label for="titreLivre">Titre du livre</label>
							<input type="text" id="titreLivreAdding" class="form-control" name="titre" placeholder="Entrer le titre">
						</div>
						<div class="form-group">
							<label for="editionLivre">Edition du livre</label>
							<input type="text" id="editionLivreAdding" class="form-control" name="edition" placeholder="Entrer le edition">
						</div>
						<div class="form-group">
							<label for="nomAuteur">Nom de l'auteur du livre</label>
							<input type="text" id="nomAuteurAdding" class="form-control" name="idAuteur" placeholder="Entrer le nom de l'auteur">
						</div>
						<div class="form-group">
							<label for="prenomAuteur">Prénom de l'auteur du livre</label>
							<input type="text" id="prenomAuteurAdding" class="form-control" name="idAuteur" placeholder="Entrer le prénom de l'auteur">
						</div>
						<div class="form-group">
							<label>Etat du livre</label>
							<select name="etat" id="etatLivreAdding" class="form-control">
								<option value="">Veuillez choisir l'état</option>
								<option value="Disponible">Disponible</option>
								<option value="Non Disponible">Non Disponible</option>
								<option value="Commande">Commande</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
						<button type="button" class="btn btn-primary confirmAddingBook">Créer le livre</button>
					</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</body>
	<?php include "require/includeJS.php"; ?>
</html>