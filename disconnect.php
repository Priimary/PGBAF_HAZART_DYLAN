<?php 
session_start();

// Suppression des variables de session et de la session
$_SESSION = array();
session_destroy();

// redirection
header('Location: connexion.php');
exit;
?>