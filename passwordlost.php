<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
    	<title>Extranet GBAF</title>
    	<link rel="stylesheet" href="style.css" />
    </head>
	<body>
		<!-- si déjà connecté redirige vers accueil.php -->
		<!-- sinon affiche le contenu de passwordlost.php -->
		<!-- page entière -->
		<div class="passwordlost-corpse">
			<!-- insertion de l'en-tête -->
			<header class="site-header-container">
				<div class="site-header-content"><?php include 'header.php'; ?></div>
			</header>
			<!-- contenu de la page entre en-tête et pied de page -->
			<div class="passwordlost-content">
				<!-- section formulaire récupération mot de passe -->
				<section class="passwordlost-form-container">
					<!-- titre pour formulaire -->
					<div class="passwordlost-h1">
						<h1>Récupérer votre mot de passe</h1>
					</div>
					<!-- formulaire récupération mot de passe -->
					<div class="register-form-content">
						<form class="register-form" method="post" action="passwordlost-script.php">
							<label for="pseudo">Votre pseudo</label><br />
							<input type=text name="nom" id="nom" required size="30" maxlenght="30" /><br />
						</form>
					</div>
				</section>
						<!-- insertion pied de base -->
			<footer class="site-footer-container">
				<div class="site-footer-content"><?php include 'footer.php'; ?></div>
			</footer>
		</div>
    </body>
</html>