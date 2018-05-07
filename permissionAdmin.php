<?php
if(!isset($_SESSION["idUser"]) && !isset($_SESSION["mail"]) && $_SESSION["admin"] != 1){
	header("location:index.php");
}
?>