<?php
session_start();
// Connexion bdd
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=oc_gbaf;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}
// mise en variable données nécessaire
$id_acteur = $_GET['acteur'];
$errorpost = 'Veuillez écrire un commentaire professionnel et constructif.';

// sécurisation commentaire reçu
if (isset($_POST['commentaire']))
{
    $post = htmlspecialchars($_POST['commentaire']);
}
else
{
    $_SESSION['errorpost'] = $errorpost;
}
// insertion commentaire dans bdd
if(isset($post))
{
	$ins = $bdd->prepare('INSERT INTO post(id_user, id_acteur, date_add, post) VALUES(:id_user, :id_acteur, NOW(), :post)');
	$ins->execute(array(
		'id_user' => $_SESSION['id_user'],
		'id_acteur' => $id_acteur,
		'post' => $post));
	header('Location: actors.php?acteur='.$id_acteur);
	exit();
}