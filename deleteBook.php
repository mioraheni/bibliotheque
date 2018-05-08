<?php
include "database.php";
if(isset($_POST["idBook"]) && $_POST["idBook"] != ""){
	$idBook = $_POST["idBook"];
	$req = $bdd->prepare("DELETE FROM LIVRE WHERE ISBN = :isbn");
	$req->bindValue(":isbn", $idBook, PDO::PARAM_STR);
	$req->execute();
	header("content-type: application/json");
	echo json_encode("sucess");
}else{
	header("location:manageBiblio.php");
}
?>