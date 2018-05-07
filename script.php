<?php

include "database.php";
$now = date("Y-m-d");
$req = $bdd->prepare("SELECT * FROM EMPRUNTS WHERE daterendu IS NULL");
$req->execute();
$emprunts = $req->fetchAll();
$date = strtotime(date("Y-m-d"));

foreach($emprunts as $empruntLivre){
	$dateEmprunt = date("d-m-Y", strtotime($empruntLivre["dateemprunt"]));
	$dateEmpruntLivre = $dateEmprunt;
	$dateEmprunt = strtotime($dateEmprunt);
	$dateTotal = $date - $dateEmprunt;
	//On rajoute +1 pour compter le jour où la personne a emprunté le livre
	$dateTotal = ($dateTotal/60/60/24)+1 . "<br>";

	//Si la date est égale à 8 jours, on envoie un mail à l'utilisateur pour l'avertis que le livre doit être rendu avant les deux jours
	if($dateTotal == 8){
		$idUser = $empruntLivre["idUser"];
		$ISBN = $empruntLivre["ISBN"];

		$req = $bdd->prepare("SELECT * FROM USER WHERE idUser = :id");
		$req->bindValue(":id", $idUser, PDO::PARAM_INT);
		$req->execute();
		$user = $req->fetch();

		$nom = utf8_encode($user["nomUser"]);
		$prenom = utf8_encode($user["prenomUser"]);
		$mail = $user["mail"];

		$req = $bdd->prepare("SELECT * FROM LIVRE WHERE ISBN = :isbn");
		$req->bindValue(":isbn", $ISBN , PDO::PARAM_STR);
		$req->execute();
		$livre = $req->fetch();

		$titre = $livre["titre"];
		$edition = $livre["edition"];

		$subject = "Retour du livre #" . $ISBN;

		$header="MIME-Version: 1.0\r\n";
		$header.='From:"bibliothequeSorbonne.com"<support@biblioSorbonne.com>'."\n";
		$header.='Content-Type:text/html; charset="uft-8"'."\n";
		$header.='Content-Transfer-Encoding: 8bit';
		
		echo $message='
		<html>
			<body>
				<div align="center">
					<img src="https://upload.wikimedia.org/wikipedia/fr/thumb/2/2c/Universit%C3%A9_Panth%C3%A9on-Sorbonne_%28depuis_janvier_2015%29.svg/640px-Universit%C3%A9_Panth%C3%A9on-Sorbonne_%28depuis_janvier_2015%29.svg.png"/>
					<br />
					Bonjour ' . $nom . ' ' . $prenom . ', <br/>
					Vous avez fait l acquisition du livre "' . $titre . '" le ' . $dateEmpruntLivre . ', il ne reste plus que 2 jours avant le retour du livre portant le numéro ISBN #' . $ISBN . ' nous vous rappelons que la date maximale du retour du livre est de 10 jours, 
					<br/>
					Ce message est un message automatique, merci de ne pas y répondre, <br />
					Toute l équipe vous remercie et vous souhaite une agréable journée, <br/>
					Cordialement La Bibliothèque de la Sorbonne
					<br />
				</div>
			</body>
		</html>
		';
		//envoie du mail, ne fonctionne pas en serveur local
		// mail($mail, $subject, $message, $header);
	}
}





?>