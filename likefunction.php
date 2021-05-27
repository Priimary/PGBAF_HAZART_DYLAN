<?php
// Nombre de votes like pour un acteur
function getLikes($id_acteur)
{
	global $bdd;
	$req = $bdd->prepare('SELECT COUNT(vote) FROM vote WHERE id_acteur = :idacteur AND vote = :vote');
	$req->execute(array(
		'idacteur' => $id_acteur,
		'vote' => 'like'));
	$likeNbr = $req->fetchColumn();
	return $likeNbr;
}

// Nombre de votes dislike pour un acteur
function getDislikes($id_acteur)
{
	global $bdd;
	$req = $bdd->prepare('SELECT COUNT(vote) FROM vote WHERE id_acteur = :id_acteur AND vote = :vote');
	$req->execute(array(
		'id_acteur' => $id_acteur,
		'vote' => 'dislike'));
	$dislikeNbr = $req->fetchColumn();
	return $dislikeNbr;
}

// Vérifie si l'utilisateur a déjà like le post
function userLiked($id_acteur)
{
	global $bdd;
	global $id_user;
	$req = $bdd->prepare ('SELECT * FROM vote WHERE id_user = :id_user AND id_acteur = :id_acteur AND vote = :vote');
	$req->execute(array(
		'id_user' => $id_user,
		'id_acteur' => $id_acteur,
		'vote' => 'like'));
	$result = $req->fetch();
	if($req->rowCount($result) > 0)
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
	global $id_user;
	$req = $bdd->prepare ('SELECT * FROM vote WHERE id_user = :id_user AND id_acteur = :id_acteur AND vote = :vote');
	$req->execute(array(
		'id_user' => $id_user,
		'id_acteur' => $id_acteur,
		'vote' => 'dislike'));
	$result = $req->fetch();
	if($req->rowCount($result) > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}
?>