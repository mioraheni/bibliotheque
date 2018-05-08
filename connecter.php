<?php

session_start();
if(!isset($_SESSION["idUser"]) && !isset($_SESSION["mail"])){
	header("location:index.php");
}
include "database.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>Connecter-Bibliothèque PMF</title>

	<?php include "require/includeCss.php"; ?>
</head>

<body class="home">
	<?php include "navbarConnexion.php"; ?>
	<div class="margeMembre jumbotron top-space">
		<div class="container">
			<h3>Bonjour <?php echo strtoupper($_SESSION["nom"]) . " " . ucfirst($_SESSION["prenomUser"]);?></h3>
			<?php
			if($_SESSION["admin"] == 0){
			?>
				<h4>Vos Emprunts</h4>
						
				<?php
				$req = $bdd->prepare("SELECT * FROM emprunts WHERE idUser = :iduser");
				$req->bindValue(":iduser", $_SESSION["idUser"], PDO::PARAM_INT);
				$req->execute();
				$countLivre = $req->rowCount();
				if($countLivre > 0){
					echo '<table class="table">
						<tr>
							<th>ISBN du livre</th>
							<th>Titre du livre</th>
							<th>Edition</th>
							<th>Auteur</th>
							<th>Date Emprunt</th>
							<th>Date de Retour</th>
						</tr>';
						while($mesLivres = $req->fetch()){
							echo "<tr>";
							$req2 = $bdd->prepare("SELECT * FROM LIVRE WHERE ISBN = :isbn");
							$req2->bindValue(":isbn", $mesLivres["ISBN"], PDO::PARAM_STR);
							$req2->execute();
							$livre = $req2->fetch();
							echo "<td>" . utf8_encode($livre["ISBN"]) . "</td>";
							echo "<td>" . utf8_encode($livre["titre"]) . "</td>";
							echo "<td>" . utf8_encode($livre["edition"]) . "</td>";
							
							$req3 = $bdd->prepare("SELECT * FROM auteur WHERE idAuteur = :auteur");
							$req3->bindValue(":auteur", $livre["idAuteur"], PDO::PARAM_INT);
							$req3->execute();
							$auteur = $req3->fetch();
							echo "<td class='idAuteur_livre'>" . utf8_encode($auteur["prenomAuteur"]) . " " . utf8_encode($auteur["nomAuteur"]) . "</td>";
							echo "<td>" . utf8_encode($mesLivres["dateemprunt"]) . "</td>";
							if ($mesLivres["daterendu"]== NULL) {
								echo "<td><a><span data-idBook='" . $livre["ISBN"] . "' class='retourlivre' style='cursor:pointer;'>Retourner</span></a></td>";
							}
							else{
								echo "<td>" . utf8_encode($mesLivres["daterendu"]) . "</td>";
							}
							echo "</tr>";
						}
					echo '</table>';
				}else{
					echo "vous n'avez pas de réservation";
				}

				?>
				<h4>Votre Wishlist</h4>
				<?php

					echo '<table class="table">
						<tr>
							<th>Titre du livre</th>
							<th>Edition</th>
							<th>Auteur</th>
							<th>Supprimer de la Wishlist</th>
						</tr>';
					$req3 = $bdd->prepare("SELECT * FROM Wishlist WHERE idUser = :iduser");
					$req3->bindValue(":iduser", $_SESSION["idUser"], PDO::PARAM_INT);
					$req3->execute();
					$mesLivres = $req3->fetchAll();
					foreach($mesLivres as $list){
						$livreISBN = $list["ISBN"];
						$req = $bdd->prepare("SELECT * FROM LIVRE WHERE ISBN = :isbn");
						$req->bindValue(":isbn", $livreISBN, PDO::PARAM_STR);
						$req->execute();
						$livre = $req->fetch();
						echo "<tr>";
						echo "<td>" . $livre["titre"] . "</td>";
						echo "<td>" . $livre["edition"] . "</td>";
						$req3 = $bdd->prepare("SELECT * FROM auteur WHERE idAuteur = :auteur");
							$req3->bindValue(":auteur", $livre["idAuteur"], PDO::PARAM_INT);
							$req3->execute();
							$auteur = $req3->fetch();
							echo "<td class='idAuteur_livre'>" . utf8_encode($auteur["prenomAuteur"]) . " " . utf8_encode($auteur["nomAuteur"]) . "</td>";
							echo "<td> <i class='fa fa-times deletewishlist' data-idBook='" . $list["ISBN"] . "' style='color:red; padding-left:60px; cursor:pointer;'></i> </td>";
						echo "</tr>";
					}
					echo "</table>";
				?>
			<?php
				}
			?>
		</div>
	</div>


	<?php include "footer.php"; ?>
		
</body>
	<?php include "require/includeJS.php"; ?>
</html>