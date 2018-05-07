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
							<th>ISBN</th>
							<th>Titre du livre</th>
							<th>Edition</th>
							<th>Date Emprunt</th>
						</tr>';
						while($mesLivres = $req->fetch()){
							echo "<tr>";
							$req2 = $bdd->prepare("SELECT * FROM LIVRE WHERE ISBN = :isbn");
							$req2->bindValue(":isbn", $mesLivres["ISBN"], PDO::PARAM_STR);
							$req2->execute();
							$livre = $req2->fetch();
							echo "<td>" . $mesLivres["ISBN"] . "</td>";
							echo "<td>" . utf8_encode($livre["titre"]) . "</td>";
							echo "<td>" . utf8_encode($livre["edition"]) . "</td>";
							echo "<td>" . utf8_encode($mesLivres["dateemprunt"]) . "</td>";
							echo "</tr>";
						}
					echo '</table>';
				}else{
					echo "vous n'avez pas de réservation";
				}

				?>
				<h4>Votre Wishlist</h4>
				<?php
					$req3= $bdd->prepare("SELECT * FROM Wishlist WHERE idUser = :iduser");
					$req3->bindValue(":iduser", $_SESSION["idUser"], PDO::PARAM_INT);
					$req3->execute();
					while ($Wishlist=$req3->fetch()){
						echo "<tr>";
						$req2 = $bdd->prepare("SELECT * FROM LIVRE WHERE ISBN = :isbn");
							$req2->bindValue(":isbn", $mesLivres["ISBN"], PDO::PARAM_STR);
							$req2->execute();
							$livre = $req2->fetch();
							echo "<td>" . $mesLivres["ISBN"] . "</td>";
							echo "<td>" . utf8_encode($livre["titre"]) . "</td>";
							echo "<td>" . utf8_encode($livre["edition"]) . "</td>";
							echo "</tr>";
					}
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