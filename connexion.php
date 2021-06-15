<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
    	<title>Connexion GBAF</title>
    	<link rel="stylesheet" href="css/style.css" />
    	<link rel="icon" href="img/favicon.ico"/>
    	<meta name="viewport" content="width=device-width" />
    </head>
	<body>
		<!-- Bloc page entière -->
		<div id="connexion-container">
			<!-- Insertion de l'en-tête -->
			<header class="site-header-container">
				<div class="site-header-content"><?php include 'header.php'; ?></div>
			</header>
			<!-- Bloc contenu de la page entre en-tête et pied de page -->
			<div class="connexion-content">
				<!-- Section formulaire de connexion -->
				<section id="connexion-form-container">
					<!-- Titre pour formulaire -->
					<h1>Connexion</h1>

					<!-- Message réussite connexion -->
					<?php
					if(isset($_SESSION['registerdone']))
					{
						$registerdone = $_SESSION['registerdone'];
						echo "<p><span id='registerSucces'>$registerdone</span></p>";					
					}
					?>

					<!-- Formulaire de connexion -->
					<form id="connexion-form" method="post" action="connexion-script.php">

						<!-- Message d'erreur de connexion -->
						<?php
                    	if(isset($_SESSION['errorConnexion']))
                    	{
                        	$errorConnexion = $_SESSION['errorConnexion'];
                        	echo "<p>$errorConnexion</p>";                    	
                        }
                		?>

                		<!-- Champs nom d'utilisateur et mdp -->
						<label for="connexion-username">Nom d'utilisateur</label>
						<br />
						<input type="text" name="connexion-username" id="connexion-username" required size="33" maxlength="30" />
						<br />
						<label for="connexion-password">Mot de passe</label>
						<br />
						<input type="password" name="connexion-password" id="connexion-password" required size="33" maxlength="30" />
						<br />

						<!-- Bouton de connexion -->
						<input id="connexion-button" type="submit" value="Se connecter"/>
					</form>

					<!-- Lien vers page mot de passe oublié & inscription -->
					<a href="register.php">Vous n'avez pas encore de compte ? Inscrivez vous !</a><br />
					<a href="passwordlost.php">Mot de passe oublié ?</a>

				</section>
			</div>
			<!-- Insertion pied de page -->
			<footer class="site-footer-container">
				<div class="site-footer-content"><?php include 'footer.php'; ?></div>
			</footer>
		</div>
    </body>
</html>
<?php
    unset($_SESSION['errorConnexion']);
    unset($_SESSION['registerdone']);
?>