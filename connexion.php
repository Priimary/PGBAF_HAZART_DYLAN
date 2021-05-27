<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
    	<title>Extranet GBAF</title>
    	<link rel="stylesheet" href="style.css" />
    	<link rel="icon" href="img/favicon.ico"/>
    	<meta name="viewport" content="width=device-width" />
    </head>
	<body>
		<!-- page entière -->
		<div id="connexion-container">
			<!-- insertion de l'en-tête -->
			<header class="site-header-container">
				<div class="site-header-content"><?php include 'header.php'; ?></div>
			</header>
			<!-- contenu de la page entre en-tête et pied de page -->
			<div class="connexion-content">
				<!-- section formulaire de connexion -->
				<section id="connexion-form-container">
					<!-- titre pour formulaire -->
					<h1>Connexion</h1>
					<!-- message reussite connexion -->
					<?php
					if(isset($_SESSION['registerdone']))
					{
						$registerdone = $_SESSION['registerdone'];
						echo "<p>$registerdone</p>";					}
					?>
					<!-- formulaire de connexion -->
					<form id="connexion-form" method="post" action="connexion-script.php">
						<?php
						// message d'erreur de connexion
                    	if(isset($_SESSION['error']))
                    	{
                        	$error = $_SESSION['error'];
                        	echo "<p>$error</p>";                    	
                        }
                		?>
						<label for="connexion-username">Nom d'utilisateur</label>
						<br />
						<input type="text" name="connexion-username" id="connexion-username" required size="33" maxlenght="30" />
						<br />
						<label for="connexion-password">Mot de passe</label>
						<br />
						<input type="password" name="connexion-password" id="connexion-password" required size="33" maxlenght="30" />
						<br />
						<input id="connexion-button" type="submit" value="Se connecter"/>
						<br />
					</form>
					<!-- mot de passe oublié & inscription -->
					<a href="register.php">Vous n'avez pas encore de compte ? Inscrivez vous !</a><br />
					<a href="passwordlost.php">Mot de passe oublié ?</a>
				</section>
			</div>
			<!-- insertion pied de page -->
			<footer class="site-footer-container">
				<div class="site-footer-content"><?php include 'footer.php'; ?></div>
			</footer>
		</div>
    </body>
</html>
<?php
    unset($_SESSION['error']);
?>