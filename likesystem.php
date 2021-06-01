<?php
// Insertion fichier fonctions
include 'likefunction.php';

// si l'utilisateur aime déjà le contenu, affiche le nombre de votes et met en couleur le pouce du j'aime sans mettre de formulaire pour bloquer le vote
if(userLiked($id_acteur))
{
?>
	<?php echo getLikes($id_acteur); ?>
	<img src="img/bluethumb.png">
	<?php echo getDislikes($id_acteur); ?>
	<img src="img/graydislikethumb.png">
<?php
}
// si l'utilisateur n'aime déjà pas le contenu, affiche le nombre de votes et met en couleur le pouce du je n'aime pas sans mettre de formulaire pour bloquer le vote
elseif(userDisliked($id_acteur))
{
?>
	<?php echo getLikes($id_acteur); ?>
	<img src="img/graylikethumb.png">
	<?php echo getDislikes($id_acteur); ?>
	<img src="img/redthumb.png">
<?php
}
// sinon affiche le nombre de votes, et laisse les deux pouces en gris dans un formulaire pour pouvoir voter
else
{
?>
	<!-- formulaire pour le système de j'aime/je n'aime pas -->
	<form id="likesystem-form" method="post" action="likesystem-script.php?acteur=<?php echo $id_acteur;?>">
		<?php echo getLikes($id_acteur); ?>
		<button name="likeBtn" type="submit" value="like"><img src="img/graylikethumb.png"></button>
		<?php echo getDislikes($id_acteur); ?>
		<button name="dislikeBtn" type="submit" value="dislike"><img src="img/graydislikethumb.png"></button>
	</form>
<?php
}
?>
