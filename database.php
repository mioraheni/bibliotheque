<?php

try{
		$bdd = new PDO('mysql:host=localhost;dbname=Bibliotheque','root','root');
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}


?>