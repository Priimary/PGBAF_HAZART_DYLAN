<?php
// Nombre de votes like pour un acteur
function getLikes($id_acteur)
{
	global $bdd;
	$reqNbrLike = $bdd->prepare('SELECT COUNT(vote) FROM vote WHERE id_acteur = :id_acteur AND vote = :vote');
	$reqNbrLike->execute(array(
		'id_acteur' => $id_acteur,
		'vote' => 'like'));
	$likeNbr = $reqNbrLike->fetchColumn();
	return $likeNbr;
}

// Nombre de votes dislike pour un acteur
function getDislikes($id_acteur)
{
	global $bdd;
	$reqNbrDislike = $bdd->prepare('SELECT COUNT(vote) FROM vote WHERE id_acteur = :id_acteur AND vote = :vote');
	$reqNbrDislike->execute(array(
		'id_acteur' => $id_acteur,
		'vote' => 'dislike'));
	$dislikeNbr = $reqNbrDislike->fetchColumn();
	return $dislikeNbr;
}

// Vérifie si l'utilisateur a déjà like le post
function userLiked($id_acteur)
{
	global $bdd;
	$reqLiked = $bdd->prepare ('SELECT * FROM vote WHERE id_user = :id_user AND id_acteur = :id_acteur AND vote = :vote');
	$reqLiked->execute(array(
		'id_user' => $_SESSION['id_user'],
		'id_acteur' => $id_acteur,
		'vote' => 'like'));
	$resultLiked = $reqLiked->fetch();
	if($reqLiked->rowCount($resultLiked) > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

// Vérifie si l'utilisateur a déjà dislike un post
function userDisliked($id_acteur)
{
	global $bdd;
	$reqDisliked = $bdd->prepare ('SELECT * FROM vote WHERE id_user = :id_user AND id_acteur = :id_acteur AND vote = :vote');
	$reqDisliked->execute(array(
		'id_user' => $_SESSION['id_user'],
		'id_acteur' => $id_acteur,
		'vote' => 'dislike'));
	$resultDisliked = $reqDisliked->fetch();
	if($reqDisliked->rowCount($resultDisliked) > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

// Vérifie si l'utilisateur a déjà écrit un commentaire
function userPosted($id_acteur)
{
	global $bdd;
	$reqPosted = $bdd->prepare('SELECT * FROM post WHERE id_user = :id_user AND id_acteur = :id_acteur');
	$reqPosted->execute(array(
		'id_user' => $_SESSION['id_user'],
		'id_acteur' => $id_acteur));
	$resultPosted = $reqPosted->fetch();
	if($reqPosted->rowCount($resultPosted) > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}
?>