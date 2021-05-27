<?php
    session_start();
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
    	<!-- insertion en-tête -->
    	<header class="site-header-container">
			<div class="site-header-content"><?php include 'header.php'; ?></div>
		</header>

    	<?php
		// Connexion bdd
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=oc_gbaf;charset=utf8', 'root', 'root');
		}
		catch(Exception $e)
		{
		    die('Erreur : '.$e->getMessage());
		}
		// mise en variable
		$id_acteur = $_GET['acteur'];
		// récupération informations acteur grace id_acteur de l'url
		$req = $bdd->prepare('SELECT id_acteur, acteur, description, logo FROM acteur WHERE id_acteur = ?');
		$req->execute(array($id_acteur));
		$donnees = $req->fetch();
		// page d'erreur si tentative d'accès à un id eronné
		if (empty($donnees) == true)
		{
		    echo 'Cette page n\'existe pas.';
		    exit(); 
		}
		?>
		<!-- section complète acteur -->
		<section class="actor-section-container">
			<article class="actor-content">
				<!-- bloc image acteur -->
				<img src="img/<?php echo htmlspecialchars($donnees['logo']); ?>" alt="Image de présentation de l'acteur"><br />
				<!-- bloc titre acteur -->
				<h2>
				    <?php echo htmlspecialchars($donnees['acteur']); ?>
				</h2>
			    <!-- bloc description acteur -->
				<p>
					<?php echo nl2br(htmlspecialchars($donnees['description'])); ?>
				</p>
			</article>
		</section>
		<!-- section complète commentaires -->
		<section id="post-list-container">
			<article id="post-list-content">
				<!-- titre liste commentaires -->
				<h3>Commentaires</h3>
				<!-- erreur commentaire -->
				<?php
				// message d'erreur de format
				if(isset($_SESSION['errorpost']))
				{
					$errorpost = $_SESSION['errorpost'];
					echo "<p><span class='errorpost'>$errorpost</span></p>";
				}
				?>
				<!-- bouton nouveau commentaire -->
				<a href="#">Nouveau commentaire</a>
				<!-- formulaire nouveau commentaire caché de base, affiché sur appuie bouton -->
				<form id="form-add-post" method="post" action="add_post.php?acteur=<?php echo $id_acteur; ?>">
					<label for="commentaire">Commentaire</label>
					<br />
					<input type="text" name="commentaire" id="commentaire" required size="30" maxlenght="30"/>
					<input type="submit" value="Envoyer"/>
				</form>

				<?php
				$req->closeCursor(); // fin requête précédente
				?>
				<div id="likesystem-container">
					<?php include 'likesystem.php'; ?>
				</div>

				<?php
				// Récupération des commentaires
				$req = $bdd->prepare('SELECT a.prenom prénom, p.post post, DATE_FORMAT(p.date_add, \'%d/%m/%Y à %Hh%imin%ss\') date_commentaire FROM post p INNER JOIN account a ON p.id_user = a.id_user  WHERE id_acteur = ?  ORDER BY date_add');
				$req->execute(array($id_acteur));
				while ($donnees = $req->fetch())
				{
				// fin balise php pour commencer structure html
				?>
					<!-- affichage de chaque commentaire disponible -->
					<p><strong><?php echo htmlspecialchars($donnees['prénom']); ?></strong> le <?php echo $donnees['date_commentaire']; ?></p><br/>
					<p><?php echo nl2br(htmlspecialchars($donnees['post'])); ?></p>
					<!-- fin boucle commentaire -->
				<?php
				}
				$req->closeCursor();
				?>
			</article>
		</section>
		<!-- insertion pied de page -->
		<footer class="site-footer-container">
			<div class="site-footer-content"><?php include 'footer.php'; ?></div>
		</footer>
	</body>
</html>
<?php
// supprime contenu variable session erreur pour empêcehr le message de rester indéfiniment
unset($_SESSION['errorpost']);
?>
