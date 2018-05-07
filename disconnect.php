<?php

//On démarre la session pour récupérer toutes les variables
session_start();
session_destroy();
session_unset();
header("location:index.php");

?>