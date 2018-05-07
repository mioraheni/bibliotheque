<?php
include "database.php";
$retour = $bdd->prepare('SELECT COUNT(*) AS nbre_entrees FROM connectes WHERE ip=\'' . $_SERVER['REMOTE_ADDR'] . '\'');
$retour->execute();
$donnees = $retour->fetch();

if ($donnees['nbre_entrees'] == 0) // L'IP ne se trouve pas dans la table, on va l'ajouter.
{
    $req = $bdd->prepare('INSERT INTO connectes VALUES(\'' . $_SERVER['REMOTE_ADDR'] . '\', ' . time() . ')');
    $req->execute();
}
else // L'IP se trouve déjà dans la table, on met juste à jour le timestamp.
{
    $req = $bdd->prepare('UPDATE connectes SET timestamp=' . time() . ' WHERE ip=\'' . $_SERVER['REMOTE_ADDR'] . '\'');
    $req->execute();
}

// On stocke dans une variable le timestamp qu'il était il y a 5 minutes :
$timestamp_5min = time() - (60 * 5); // 60 * 5 = nombre de secondes écoulées en 5 minutes
$req = $bdd->prepare('DELETE FROM connectes WHERE timestamp < ' . $timestamp_5min);
$req->execute();

$retour = $bdd->prepare('SELECT COUNT(*) AS nbre_entrees FROM connectes');
$retour->execute();
$donnees = $retour->fetch();


// Ouf ! On n'a plus qu'à afficher le nombre de connectés !
echo '<p>Il y a actuellement ' . $donnees['nbre_entrees'] . ' visiteurs connectés sur le site !</p>';
?>
