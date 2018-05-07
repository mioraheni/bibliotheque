<?php

//session_start();

include "database.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>Gestion Des Emprunts</title>

	<?php include "require/includeCss.php"; ?>
</head>

<body class="home">
	<?php include "navbarConnexion.php"; ?>
	<div class="margeMembre jumbotron top-space">
		<div class="container">
			<h3>Liste des Livres Empruntés</h3>
			
			<?php

				$req = $bdd->prepare("SELECT * FROM Emprunts");
				$req->execute();

				$req1 = $bdd->prepare("SELECT * FROM Livre");
				$req1->execute();
				echo '<table class="table">
						<tr>
							<th>ISBN</th>
							<th>Titre</th>
							<th>Date d\'Emprunt</th>
							<th>Date Rendu</th>
						</tr>';
				while($emprunt = $req->fetch()){
						echo "<tr>";
						echo "<td>" . utf8_encode($emprunt["ISBN"]) . "</td>";
						if ( $livre = $req1->fetch()) {
							$titre = htmlspecialchars($livre["titre"]);
							echo "<td>" . $titre . "</td>";
						}
						echo "<td>" . utf8_encode($emprunt["dateemprunt"]) . "</td>";
						echo "<td>" . utf8_encode($emprunt["daterendu"]) . "</td>";
							
						echo "<td>  <i class='fa fa-times deleteBook' data-idBook='" . $emprunt["ISBN"] . "' style='color:red; padding-left:20px; cursor:pointer;'></i> </td>";
						echo "</tr>";
					
				}
				echo "</table>";
			
			?>
		</div>
	</div>


	<?php include "footer.php"; ?>
	
</body>
	<?php include "require/includeJS.php"; ?>
</html>