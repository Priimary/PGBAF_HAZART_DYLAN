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

// Mise en variable données nécessaires
$id_acteur = $_GET['acteur'];
$errorpost = 'Veuillez écrire un commentaire professionnel et constructif.';

// Vérifie si champ rempli, puis sécurise le texte reçu, puis vérifie si bon format, puis insert dans la BDD
if (isset($_POST['commentaire']))
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
		$_SESSION['errorpost'] = $errorpost;
    	header('Location: actors.php?acteur='.$id_acteur);
		exit();
	}
}
else
{
    $_SESSION['errorpost'] = $errorpost;
    header('Location: actors.php?acteur='.$id_acteur);
	exit();
}