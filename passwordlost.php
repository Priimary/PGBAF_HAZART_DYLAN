<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
    	<title>Mot de passe perdu GBAF</title>
    	<link rel="stylesheet" href="css/style.css"/>
    	<link rel="icon" href="img/favicon.ico"/>
    	<meta name="viewport" content="width=device-width"/>
    </head>
	<body>
		<!-- Bloc page entière -->
		<div id="passwordlost-container">
			<!-- Insertion de l'en-tête -->
			<header class="site-header-container">
				<div class="site-header-content"><?php include 'header.php'; ?></div>
			</header>
			<!-- Contenu de la page entre en-tête et pied de page -->
			<div id="passwordlost-content">
				<!-- Section formulaire de connexion -->
				<section id="passwordlost-form-container">
						<!-- Titre pour formulaire -->
						<h1>Changer de mot de passe</h1>

						<!-- Formulaire récupération mot de passe -->
						<form id="passwordlost-form" method="post" action="passwordlost-script.php">
							<!-- Si données demandées sont valides, alors affiche le formulaire pour changer le mdp, sinon affiche le formulaire username/question/answer -->
							<?php
							if(isset($_SESSION['passwordlost-username']))
							{
							?>
								<!-- Message d'erreur si mdp identique à l'ancien -->
								<?php
		                    	if(isset($_SESSION['errorpasswordused']))
		                    	{
		                        	$errorpasswordused = $_SESSION['errorpasswordused'];
		                        	echo "<p><span class='error-passwordlost'>$errorpasswordused</span></p>";                    	
		                    	}
		                    	?>

		                		<!-- Champ nouveau mot de passe -->
								<label for="passwordlost-password">Nouveau mot de passe</label>
								<br />
								<input type="password" name="passwordlost-password" id="passwordlost-password" required size="30" maxlength="30" />
								<br />
								<p><span class="requirement-passwordlost-form">8 à 30 caractères (a-z, A-Z, 0-9, -, _, *, .)</span></p>
								<br />

								<!-- Message d'erreur si format mdp invalide -->
								<?php
			                    if(isset($_SESSION['errorpasswordlost-password']))
			                    {
			                        $errorpasswordlost_password = $_SESSION['errorpasswordlost-password'];
			                        echo "<p><span class='error-passwordlost'>$errorpasswordlost_password</span></p>";                    	
			                    }
		                		?>

		                		<!-- Champ répétition nouveau mdp -->
		                		<label for="passwordlost-password2">Répétition nouveau mot de passe</label>
								<br />
								<input type="password" name="passwordlost-password2" id="passwordlost-password2" required size="30" maxlength="30" />
								<br />
								<p><span class="requirement-passwordlost-form">8 à 30 caractères (a-z, A-Z, 0-9, -, _, *, .)</span></p>

								<!-- Message d'erreur si les deux nouveaux mdp sont différents -->
								<?php
			                    if(isset($_SESSION['errorpasswordlost-password2']))
			                    {
			                        $errorpasswordlost_password2 = $_SESSION['errorpasswordlost-password2'];
			                        echo "<p><span class='error-passwordlost'>$errorpasswordlost_password2</span></p>";                    	
			                    }
		                		?>
							<?php
							}
							else
							{
							?>

								<!-- Champ nom d'utilisateur -->
								<label for="passwordlost-username">Nom d'utilisateur</label>
								<br />
								<input type=text name="passwordlost-username" id="passwordlost-username" required size="30" maxlength="30" />
								<br />

								<!-- Message d'erreur nom d'utilisateur invalide -->
								<?php
								if(isset($_SESSION['errorpasswordlost']))
								{
									$errorpasswordlost = $_SESSION['errorpasswordlost'];
									echo "<p><span class='error-passwordlost'>$errorpasswordlost</span></p>";                    	
								}
								?>

								<!-- Champ question secrète -->
								<label for="passwordlost-secretquestion">Choisissez une question secrète</label>
								<br />
								<select name="passwordlost-secretquestion" id="passwordlost-secretquestion">
									<option value="" selected>--Choisissez une question--</option>
				                    <option value="Qu'est ce que vous vouliez devenir plus grand, lorsque vous étiez enfant ?">
				                        Qu'est ce que vous vouliez devenir plus grand, lorsque vous étiez enfant ?
				                    </option> 
				                    <option value="Quel est le nom de famille de votre professeur d'enfance préféré ?">
				                        Quel est le nom de famille de votre professeur d'enfance préféré ?
				                    </option>
				                    <option value="Quel est le nom et prénom de votre premier amour ?">
				                        Quel est le nom et prénom de votre premier amour ?
				                    </option>
				                    <option value="Dans quelle ville se sont rencontrés vos parents ?">
				                        Dans quelle ville se sont rencontrés vos parents ?
				                    </option>
				                </select>
				                <br />

				                <!-- Message d'erreur question secrète invalide -->
								<?php
								if(isset($_SESSION['errorpasswordlost']))
								{
									$errorpasswordlost = $_SESSION['errorpasswordlost'];
									echo "<p><span class='error-passwordlost'>$errorpasswordlost</span></p>";                    	
								}
								?>

								<!-- Champ réponse secrète -->
				                <label for="passwordlost-secretanswer">Réponse à votre question secrète</label>
				                <br />
				                <input type="text" name="passwordlost-secretanswer" id="passwordlost-secretanswer" required size="30" maxlength="20" />
				                <br />

				                <!-- Message d'erreur réponse secrète invalide -->
								<?php
								if(isset($_SESSION['errorpasswordlost']))
								{
									$errorpasswordlost = $_SESSION['errorpasswordlost'];
									echo "<p><span class='error-passwordlost'>$errorpasswordlost</span></p>";                    	
								}
								?>

							<?php
	                		}
	                		?>

	                		<!-- Bouton validation formulaire -->
	                		<input id="passwordlost-button" type="submit" value="ENVOYER"/>

						</form>	
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
    unset($_SESSION['errorpasswordlost']);
    unset($_SESSION['errorpasswordlost-password']);
    unset($_SESSION['errorpasswordlost-password2']);
    unset($_SESSION['errorpasswordused']);
?>