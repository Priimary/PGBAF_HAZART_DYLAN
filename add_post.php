<?php
session_start();
// Connexion BDD
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=oc_gbaf;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}

// Insertion fichier fonctions
include 'likefunction.php';

// Mise en variable données nécessaires
$id_acteur = $_GET['acteur'];
$errorPost = 'Veuillez écrire un commentaire professionnel et constructif.';
$errorPosted = 'Vous avez déjà écrit un commentaire sur cette page.';

// Vérifie si champ rempli, puis sécurise le texte reçu, puis vérifie si bon format, puis insert dans la BDD
if(isset($_POST['commentaire']) && ! userPosted($id_acteur))
{
    $post = htmlspecialchars($_POST['commentaire']);
    if(isset($post) && preg_match("#(.{5,})#s", $post))
	{
		$ins = $bdd->prepare('INSERT INTO post(id_user, id_acteur, date_add, post) VALUES(:id_user, :id_acteur, NOW(), :post)');
		$ins->execute(array(
			'id_user' => $_SESSION['id_user'],
			'id_acteur' => $id_acteur,
			'post' => $post));
		header('Location: actors.php?acteur='.$id_acteur);
		exit();
	}
	else
	{
		$_SESSION['errorPost'] = $errorPost;
    	header('Location: actors.php?acteur='.$id_acteur);
		exit();
	}
}
elseif(userPosted($id_acteur))
{
	$_SESSION['errorPosted'] = $errorPosted;
	header('Location: actors.php?acteur='.$id_acteur);
	exit();
}
else
{
    $_SESSION['errorPost'] = $errorPost;
    header('Location: actors.php?acteur='.$id_acteur);
	exit();
}
?>