<?php
session_start();
// Redirige vers la page de connexion si pas connecté
if($_SESSION['loggedIn'] != true)
{
	header('Location: connexion.php');
	exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
    	<title>Extranet GBAF</title>
    	<link rel="stylesheet" href="style.css"/>
    	<link rel="icon" href="img/favicon.ico"/>
    	<meta name="viewport" content="width=device-width"/>
    </head>
    <body>
    	<!-- Insertion en-tête -->
    	<header class="site-header-container">
			<div class="site-header-content"><?php include 'header.php'; ?></div>
		</header>

    	<?php
    	// Connexion BDD
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=oc_gbaf;charset=utf8', 'root', 'root');
		}
		catch(Exception $e)
		{
		    die('Erreur : '.$e->getMessage());
		}

		// Mise en variable donnée nécessaire
		$id_acteur = $_GET['acteur'];

		// Récupération informations acteur 
		$req = $bdd->prepare('SELECT id_acteur, acteur, description, logo FROM acteur WHERE id_acteur = :id_acteur');
		$req->execute(array(
			'id_acteur' => $id_acteur));
		$donnees = $req->fetch();

		// Redirection vers l'index si tentative d'accès à une page d'acteur invalide
		if(empty($donnees) == true)
		{
		    header('Location: index.php');
		    exit(); 
		}
		?>

		<!-- Section complète acteur -->
		<section class="actor-section-container">
			<!-- Article contenu acteur -->
			<article class="actor-content">

				<!-- Logo acteur -->
				<img src="img/<?php echo htmlspecialchars($donnees['logo']); ?>" alt="Image de présentation de l'acteur">
				<br />

				<!-- Titre acteur -->
				<h2>
				    <?php echo htmlspecialchars($donnees['acteur']); ?>
				</h2>

			    <!-- Description acteur -->
				<p>
					<?php echo nl2br(htmlspecialchars($donnees['description'])); ?>
				</p>

			</article>
		</section>

		<!-- Fin requête précédente -->
		<?php $req->closeCursor(); ?>

		<!-- Section complète commentaires -->
		<section id="post-list-container">
			<!-- Article contenu commentaires -->
			<article id="post-list-content">

				<!-- Titre liste commentaires -->
				<h3>Commentaires</h3>

				<!-- Message d'erreur si commentaire vide -->
				<?php
				if(isset($_SESSION['errorPost']))
				{
					$errorPost = $_SESSION['errorPost'];
					echo "<p><span class='errorpost'>$errorPost</span></p>";
				}
				elseif(isset($_SESSION['errorPosted']))
				{
					$errorPosted = $_SESSION['errorPosted'];
					echo "<p><span class='errorpost'>$errorPosted</span></p>";
				}
				?>

				<!-- Bouton nouveau commentaire -->
				<a href="#">Nouveau commentaire</a>

				<!-- Formulaire nouveau commentaire caché de base, affiché sur appuie bouton -->
				<form id="form-add-post" method="post" action="add_post.php?acteur=<?php echo $id_acteur; ?>">
					<label for="commentaire">Commentaire</label>
					<br />
					<input type="text" name="commentaire" id="commentaire" required size="30" maxlenght="30"/>
					<input type="submit" value="Envoyer"/>
				</form>

				<!-- Insertion système de vote -->
				<div id="likesystem-container">
					<?php include 'likesystem.php'; ?>
				</div>

				<?php
				// Récupération des commentaires
				$req = $bdd->prepare('SELECT a.prenom prénom, p.post post, DATE_FORMAT(p.date_add, \'%d/%m/%Y à %Hh%imin%ss\') date_commentaire FROM post p INNER JOIN account a ON p.id_user = a.id_user  WHERE id_acteur = :id_acteur  ORDER BY date_add');
				$req->execute(array(
					'id_acteur' => $id_acteur));
				while($donnees = $req->fetch())
				{
				?>
					<!-- Affichage de chaque commentaire disponible avec prénom, date, et post -->
					<p><strong><?php echo htmlspecialchars($donnees['prénom']); ?></strong> le <?php echo $donnees['date_commentaire']; ?></p><br/>
					<p><?php echo nl2br(htmlspecialchars($donnees['post'])); ?></p>
				<?php
				}
				$req->closeCursor();
				?>
			</article>
		</section>

		<!-- Insertion pied de page -->
		<footer class="site-footer-container">
			<div class="site-footer-content"><?php include 'footer.php'; ?></div>
		</footer>
	</body>
</html>
<?php
unset($_SESSION['errorPost']);
unset($_SESSION['errorPosted']);
?>
