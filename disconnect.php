<?php 
session_start();

// Suppression des variables de session et fin de la session
$_SESSION = array();
session_destroy();

// Redirection vers page connexion
header('Location: connexion.php');
exit;
?>