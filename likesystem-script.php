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

// Insertion fichier fonctions
include 'likefunction.php';

// Mise en variable données nécessaires
$check1 = 'like';
$check2 = 'dislike';
$id_acteur = $_GET['acteur'];

// Vérification et mise en variable donnée formulaire
if(isset($_POST['likeBtn']) && $_POST['likeBtn'] === $check1)
{
	$action = $_POST['likeBtn'];
}
elseif(isset($_POST['dislikeBtn']) && $_POST['dislikeBtn'] === $check2)
{
	$action = $_POST['dislikeBtn'];
}
else
{
	echo 'Données reçues eronnés, veuillez contacter l\'administrateur du site !';
	echo 'Vous allez être redirigé vers la page précédente dans quelques secondes.';
	header('Refresh: 5; URL=actors.php?acteur='. $id_acteur);
	exit();
}

// Traitement donnée formulaire suivant le contenu
switch($action)
{
	// Si action sur bouton j'aime
	case 'like':
			// Insertion données dans la table vote
			$ins = $bdd->prepare('INSERT INTO vote(id_user, id_acteur, vote) VALUES(:id_user,:id_acteur,:vote)');
			$ins->execute(array(
				'id_user' => $_SESSION['id_user'],
				'id_acteur' => $id_acteur,
				'vote' => $action));
			header('Location: actors.php?acteur='.$id_acteur);
			exit();
			break;

	// Si action sur bouton je n'aime pas
	case 'dislike':
			// Insertion données dans la table vote
			$ins = $bdd->prepare('INSERT INTO vote(id_user, id_acteur, vote) VALUES(:id_user,:id_acteur,:vote)');
			$ins->execute(array(
				'id_user' => $_SESSION['id_user'],
				'id_acteur' => $id_acteur,
				'vote' => $action));
			header('Location: actors.php?acteur='.$id_acteur);
			exit();
			break;
}



