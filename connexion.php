<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
    	<title>Extranet GBAF</title>
    	<link rel="stylesheet" href="style.css" />
    </head>
	<body>
		<!-- si déjà connecté redirige vers accueil.php -->
		<!-- sinon affiche le contenu de connexion.php -->
		<!-- page entière -->
		<div class="connexion-corpse">
			<!-- insertion de l'en-tête -->
			<header class="site-header-container">
				<div class="site-header-content"><?php include 'header.php'; ?></div>
			</header>
			<!-- contenu de la page entre en-tête et pied de page -->
			<div class="connexion-content">
				<!-- section formulaire de connexion -->
				<section class="connexion-form-container">
					<!-- titre pour formulaire -->
					<div class="connexion-h1">
						<h1>Connexion</h1>
					</div>

					<!-- formulaire de connexion -->
					<div class="connexion-form-content">
						<form class="connexion-form" method="post" action="connexion-script.php">
							<label for="pseudo">Votre pseudo</label> : <input type="text" name="pseudo" id="pseudo" required size="30" maxlenght="30" /><br />
							<label for="password">Votre mot de passe</label> : <input type="password" name="password" id="password" required size="30" maxlenght="30" /><br />
							<input type="submit" value="Confirmer"/><br />
						</form>
					</div>
					<!-- mot de passe oublié & inscription -->
					<a href="inscription.php">Vous n'avez pas encore de compte ? Inscrivez vous !</a><br />
					<a href="passwordlost.php">Mot de passe oublié ?</a>
				</section>
			</div>
			<!-- insertion pied de base -->
			<footer class="site-footer-container">
				<div class="site-footer-content"><?php include 'footer.php'; ?></div>
			</footer>
		</div>
    </body>
</html>