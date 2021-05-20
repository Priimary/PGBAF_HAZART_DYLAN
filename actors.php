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

		// récupération informations acteur grace id_acteur de l'url
		$req = $bdd->prepare('SELECT id_acteur, acteur, description, logo FROM acteur WHERE id_acteur = ?');
		$req->execute(array($_GET['acteur']));
		$donnees = $req->fetch();
		//	page d'erreur si tentative d'accès à un autre id
		if (empty($donnees) == true)
		{
		    echo 'Cette page n\'existe pas.';
		    exit(); 
		}
		// sinon fin balise php pour commencer structure html
		?>
		<!-- section complète acteur -->
		<section class="actor-container">
			<div class="actor-content">
				<!-- bloc image acteur -->
				<div class="actor-picture">
					<img src="<?php echo htmlspecialchars($donnees['logo']); ?>" alt="Image de présentation de l'acteur"><br />
				</div>
				<!-- bloc titre acteur -->
				<div class="actor-title">
				    <h2>
				        <?php echo htmlspecialchars($donnees['acteur']); ?><br />
				    </h2>
			    </div>
			    <!-- bloc description acteur -->
			    <div class="actor-introduction">
				    <p>
					    <?php echo nl2br(htmlspecialchars($donnees['description'])); ?>
				    </p>
				</div>
			</div>
		</section>
		<!-- section complète commentaires -->
		<section class="post-list-container">
			<div class="post-list-content">
				<!-- bloc titre liste commentaires -->
				<div class="post-list-title">
					<h3>Commentaires</h3>
				</div>
				<!-- bloc bouton nouveau commentaire -->
				<div class="button-new-post">
					<a href="#">Nouveau commentaire</a>
				</div>
				<!-- bloc formulaire nouveau commentaire caché de base, affiché sur appuie sur bouton -->
				<div class="new-post">
					<form class="form-add-post" method="post" action="add_post.php">
						<input type="hidden" name="id_user" id="id_user" value="<?php echo htmlspecialchars($_SESSION['id_user']) ?>"/>
						<input type="hidden" name="id_acteur" id="id_acteur" value="<?php echo $_GET['acteur'] ?>"/>
						<label for="commentaire">Commentaire</label> : <input type="text" name="commentaire" id="commentaire" required size="30" maxlenght="30"/>
						<input type="submit" value="Envoyer"/><br />
					</form>
				</div>
				<!-- bloc like/dislike -->

				<?php
				$req->closeCursor(); // fin requête précédente

				// Récupération des commentaires
				$req = $bdd->prepare('SELECT a.prenom prénom, p.post post, DATE_FORMAT(p.date_add, \'%d/%m/%Y à %Hh%imin%ss\') date_commentaire FROM post p INNER JOIN account a ON p.id_user = a.id_user  WHERE id_acteur = ?  ORDER BY date_add');
				$req->execute(array($_GET['acteur']));
				while ($donnees = $req->fetch())
				{
				// fin balise php pour commencer structure html
				?>
				<!-- bloc pour chaque commentaire -->
				<div class="post-content">
					<p><strong><?php echo htmlspecialchars($donnees['prénom']); ?></strong> le <?php echo $donnees['date_commentaire']; ?></p><br/>
					<p><?php echo nl2br(htmlspecialchars($donnees['post'])); ?></p>
				</div>
				<!-- fin boucle commentaire -->
				<?php
				}
				$req->closeCursor();
				?>
			</div>
		</section>
	<!-- insertion pied de page -->
		<footer class="site-footer-container">
			<div class="site-footer-content"><?php include 'footer.php'; ?></div>
		</footer>
	</body>
</html>
