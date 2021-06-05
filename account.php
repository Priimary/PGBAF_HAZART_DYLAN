<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
    	<title>Gestion de compte GBAF</title>
    	<link rel="stylesheet" href="style.css"/>
    	<link rel="icon" href="img/favicon.ico"/>
    	<meta name="viewport" content="width=device-width"/>
    </head>
	<body>
		<!-- Bloc page entière gestion de compte -->
		<div id="account-container">
			<!-- Insertion de l'en-tête -->
			<header class="site-header-container">
				<div class="site-header-content"><?php include 'header.php'; ?></div>
			</header>
			<!-- Contenu de la page entre en-tête et pied de page -->
			<div id="account-content">
				<!-- Section formulaire de changement informations utilisateur -->
				<section id="account-form-container">
					<!-- Titre pour formulaire -->
					<h1>INFORMATIONS</h1>

					<!-- Formulaire affichant nom et bouton formulaire nouveau nom -->
					<form id="account-form-nom" method="post" action="account-script.php">
						<p>Nom :<span class="account-info"><?php echo $_SESSION['nom']; ?></span></p>
						<button name="nomBtn" type="submit" value="nom"><img alt="Crayon qui sert de bouton" src="img/pencil.png"></button>
					</form>
					<br />

					<!-- Si appuie sur bouton nomBtn affiche le formulaire de changement nom -->
					<?php
					if(isset($_SESSION['changeNom']))
					{
					?>
						<!-- Formulaire changement de nom -->
						<form id="account-form-new-nom" method="post" action="account-script.php">

							<!-- Message d'erreur si nom identique à l'ancien -->
							<?php
							if(isset($_SESSION['errorAccountNomUsed']))
							{
							$errorAccountNomUsed = $_SESSION['errorAccountNomUsed'];
							echo "<p><span class='error-account'>$errorAccountNomUsed</span></p>";                   	
							}
							?>

							<!-- Champ nouveau nom -->
							<label for="account-nom">Nouveau nom</label>
							:
							<input type=text name="account-nom" id="account-nom" required size="30" maxlength="20" />	
							<p><span class="requirement-account-form">2 à 20 caractères (a-z, A-Z, ' et -)</span></p>

							<!-- Message d'erreur si format invalide du nouveau nom -->
							<?php
							if(isset($_SESSION['errorAccountNom']))
							{
								$errorAccountNom = $_SESSION['errorAccountNom'];
								echo "<p><span class='error-account'>$errorAccountNom</span></p>";
							}
							?>

							<!-- Bouton validation -->
			                <input class="validation-button" type="submit" value="Valider"/>

			            </form>
					<?php
					}
					// Message succès changement nom
					elseif(isset($_SESSION['succesChangeNom']))
							{
								$succesChangeNom = $_SESSION['succesChangeNom'];
								echo "<p><span class='succes-account'>$succesChangeNom</span></p>";
							}
					?>

					<!-- Formulaire affichant prenom et bouton affichage formulaire nouveau prenom -->
					<form id="account-form-prenom" method="post" action="account-script.php">
						<p>Prenom :<span class="account-info"><?php echo $_SESSION['prenom']; ?></span></p>
						<button name="prenomBtn" type="submit" value="prenom"><img alt="Crayon qui sert de bouton" src="img/pencil.png"></button>
					</form>
					<br />

					<!-- Si appuie sur prenomBtn affiche le formulaire changement prenom -->
					<?php
					if(isset($_SESSION['changePrenom']))
					{
					?>
						<!-- Formulaire changement de prenom -->
						<form id="account-form-new-prenom" method="post" action="account-script.php">

							<!-- Message d'erreur si prenom identique à l'ancien -->
							<?php
							if(isset($_SESSION['errorAccountPrenomUsed']))
							{
								$errorAccountPrenomUsed = $_SESSION['errorAccountPrenomUsed'];
								echo "<p><span class='error-account'>$errorAccountPrenomUsed</span></p>";                    	
							}
							?>

							<!-- Champ nouveau prénom -->
							<label for="account-prenom">Nouveau prénom</label>
							:
							<input type=text name="account-prenom" id="account-prenom" required size="30" maxlength="20" />
							<p><span class="requirement-account-form">2 à 20 caractères (a-z, A-Z, ' et -)</span></p>

							<!-- Message d'erreur si format invalide nouveau prenom -->
							<?php
							if(isset($_SESSION['errorAccountPrenom']))
							{
								$errorAccountPrenom = $_SESSION['errorAccountPrenom'];
								echo "<p><span class='error-account'>$errorAccountPrenom</span></p>";
							}
							?>

							<!-- Bouton validation -->
							<input class="validation-button" type="submit" value="Valider"/>

						</form>
					<?php
					}
					// Message succès changement prénom
					elseif(isset($_SESSION['succesChangePrenom']))
							{
								$succesChangePrenom = $_SESSION['succesChangePrenom'];
								echo "<p><span class='succes-account'>$succesChangePrenom</span></p>";
							}
					?>

					<!-- Formulaire affichage nom d'utilisateur et bouton formulaire changement nom d'utilisateur -->
					<form id="account-form-username" method="post" action="account-script.php">
						<p>Nom d'utilisateur :<span class="account-info"><?php echo $_SESSION['username']; ?></span></p>
						<button name="usernameBtn" type="submit" value="username"><img alt="Crayon qui sert de bouton" src="img/pencil.png"></button>
					</form>
					<br />

					<!-- Si appuie sur bouton usernameBtn affiche formulaire changement nom d'utilisateur -->
					<?php
					if(isset($_SESSION['changeUsername']))
					{
					?>
						<!-- Formulaire changement nom d'utilisateur -->
						<form id="account-form-new-username" method="post" action="account-script.php">

							<!-- Message d'erreur si nom d'utilisateur déjà pris -->
							<?php
							if(isset($_SESSION['errorAccountUsernameUsed']))
							{
								$errorAccountUsernameUsed = $_SESSION['errorAccountUsernameUsed'];
								echo "<p><span class='error-account'>$errorAccountUsernameUsed</span></p>";                    	
							}
							?>

							<!-- Champ nouveau nom d'utilisateur -->
							<label for="account-username">Nouveau nom d'utilisateur</label>
							:
							<input type=text name="account-username" id="account-username" required size="30" maxlength="20" />
							<p><span class="requirement-account-form">5 à 20 caractères (a-z, A-Z, 0-9, - et _)</span></p>

							<!-- Message d'erreur si format invalide nouveau nom d'utilisateur -->
							<?php
							if(isset($_SESSION['errorAccountUsername']))
							{
								$errorAccountUsername = $_SESSION['errorAccountUsername'];
								echo "<p><span class='error-account'>$errorAccountUsername</span></p>";
							}
							?>

							<!-- Bouton validation -->
							<input class="validation-button" type="submit" value="Valider"/>

						</form>
					<?php
					}
					// Message succès changement nom d'utilisateur
					elseif(isset($_SESSION['succesChangeUsername']))
						{
							$succesChangeUsername = $_SESSION['succesChangeUsername'];
							echo "<p><span class='succes-account'>$succesChangeUsername</span></p>";
						}
					?>
					
					<!-- Formulaire affichant mot de passe et bouton formulaire changement de mot de passe -->
					<form id="account-form-password" method="post" action="account-script.php">
						<p>Mot de passe :<span class="account-info">********</span></p>
						<button name="passwordBtn" type="submit" value="password"><img alt="Crayon qui sert de bouton" src="img/pencil.png"></button>
					</form>
					<br />

					<!-- Si appuie sur passwordBtn affiche formulaire changement mdp -->
					<?php
					if(isset($_SESSION['changePassword']))
					{
					?>
						<!-- Formulaire changement de mdp -->
						<form id="account-form-new-password" method="post" action="account-script.php">

							<!-- Message d'erreur si mdp identique à l'ancien -->
							<?php
							if(isset($_SESSION['errorAccountPasswordUsed']))
							{
								$errorAccountPasswordUsed = $_SESSION['errorAccountPasswordUsed'];
								echo "<p><span class='error-account'>$errorAccountPasswordUsed</span></p>";                    	
							}
	                		?>

	                		<!-- Champ ancien mot de passe -->
		                	<label for="account-password">Mot de passe actuel</label>
		                	:
		                	<input type="password" name="account-password" id="account-password" required size="30" maxlength="30" />
							<br />
		                	
		                	<!-- Message d'erreur si ancien mdp invalide -->
		                	<?php
							if(isset($_SESSION['errorAccountPassword']))
							{
								$errorAccountPassword = $_SESSION['errorAccountPassword'];
								echo "<p><span class='error-account'>$errorAccountPassword</span></p>";                    	
							}
							?>
		                	
		                	<!-- Champ nouveau mot de passe -->	
							<label for="account-newpassword">Nouveau mot de passe</label>
							:
							<input type="password" name="account-newpassword" id="account-newpassword" required size="30" maxlength="30" />
							<p><span class="requirement-account-form">8 à 30 caractères (a-z, A-Z, 0-9, -, _, *, .)</span></p>

							<!-- Message d'erreur si format nouveau mdp invalide -->
							<?php
							if(isset($_SESSION['errorAccountNewPassword']))
							{
								$errorAccountNewPassword = $_SESSION['errorAccountNewPassword'];
								echo "<p><span class='error-account'>$errorAccountNewPassword</span></p>";                    	
							}
							?>

							<!-- Champ répétation nouveau mot de passe -->
		                	<label for="account-newpassword2">Répétition nouveau mot de passe</label>
							:
							<input type="password" name="account-newpassword2" id="account-newpassword2" required size="30" maxlength="30" />

							<!-- Message d'erreur si les deux champs nouveau mdp ne sont pas identiques -->
							<?php
							if(isset($_SESSION['errorAccountNewPassword2']))
							{
								$errorAccountNewPassword2 = $_SESSION['errorAccountNewPassword2'];
								echo "<p><span class='error-account'>$errorAccountNewPassword2</span></p>";                    	
							}
							?>

							<!-- Bouton validation -->
		                	<input class="validation-button" type="submit" value="Valider"/>

		                </form>
					<?php
					}
					// Message succès changement mot de passe
					elseif(isset($_SESSION['succesChangePassword']))
						{
							$succesChangePassword = $_SESSION['succesChangePassword'];
							echo "<p><span class='succes-account'>$succesChangePassword</span></p>";
						}
					?>

					<!-- Formulaire affichage question secrète et bouton formulaire changement question secrète -->
					<form id="account-form-secretquestion" method="post" action="account-script.php">
						<p>Question secrète :<span class="account-info"><?php echo $_SESSION['question']; ?></span></p>
						<button name="questionBtn" type="submit" value="question"><img alt="Crayon qui sert de bouton" src="img/pencil.png"></button>
					</form>
					<br />

					<!-- Si appuie sur questionBtn affiche formulaire changement questino secrète -->
					<?php
					if(isset($_SESSION['changeQuestion']))
					{
					?>
						<!-- Formulaire changement question secrète -->
						<form id="account-form-new-secretquestion" method="post" action="account-script.php">

							<!-- Message d'erreur si question secrète identique à l'ancienne -->
							<?php
							if(isset($_SESSION['errorAccountSecretQuestionUsed']))
							{
								$errorAccountSecretQuestionUsed = $_SESSION['errorAccountSecretQuestionUsed'];
								echo "<p><span class='error-account'>$errorAccountSecretQuestionUsed</span></p>";                    	
							}
							?>

							<!-- Champ nouvelle question secrète -->
							<label for="account-secretquestion">Choisissez une nouvelle question secrète</label>
							:
							<select name="account-secretquestion" id="account-secretquestion">
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
							
							<!-- Message d'erreur si question secrète invalide -->
							<?php
							if(isset($_SESSION['errorAccountSecretQuestion']))
							{
								$errorAccountSecretQuestion = $_SESSION['errorAccountSecretQuestion'];
								echo "<p><span class='error-account'>$errorAccountSecretQuestion</span></p>";                    	
							}
							?>

							<!-- Bouton validation -->
							<input class="validation-button" type="submit" value="Valider"/>

						</form>
					<?php
					}
					// Message succès changement question secrète
					elseif(isset($_SESSION['succesChangeSecretQuestion']))
						{
							$succesChangeSecretQuestion = $_SESSION['succesChangeSecretQuestion'];
							echo "<p><span class='succes-account'>$succesChangeSecretQuestion</span></p>";
						}
					?>

					<!-- Formulaire affichage reponse secrète et bouton formulaire changement reponse secrète -->
					<form id="account-form-secretanswer" method="post" action="account-script.php">
						<p>Réponse secrète :<span class="account-info">********</span></p>
						<button name="answerBtn" type="submit" value="answer"><img alt="Crayon qui sert de bouton" src="img/pencil.png"></button>
					</form>
					<br />

					<!-- Si appuie sur bouton answerBtn affiche formulaire changement réponse secrète -->
					<?php
					if(isset($_SESSION['changeAnswer']))
					{
					?>
						<!-- Formulaire changement de réponse secrète -->
						<form id="account-form-new-secretanswer" method="post" action="account-script.php">

							<!-- Message d'erreur réponse secrète identique à l'ancienne -->
							<?php
							if(isset($_SESSION['errorAccountSecretAnswerUsed']))
							{
								$errorAccountSecretAnswerUsed = $_SESSION['errorAccountSecretAnswerUsed'];
								echo "<p><span class='error-account'>$errorAccountSecretAnswerUsed</span></p>";                    	
							}
							?>

							<!-- Champ réponse secrète actuelle -->
							<label for="account-secretanswer">Réponse actuelle à la question secrète</label>
							:
							<input type="text" name="account-secretanswer" id="account-secretanswer" required size="30" maxlength="20" />
							<br />
							
							<!-- Message d'erreur ancienne réponse invalide -->
							<?php
							if(isset($_SESSION['errorAccountSecretAnswer']))
							{
								$errorAccountSecretAnswer = $_SESSION['errorAccountSecretAnswer'];
								echo "<p><span class='error-register'>$errorAccountSecretAnswer</span></p>";                    	
							}
							?>
							
							<!-- Champ nouvelle réponse secrète -->
							<label for="account-newsecretanswer">Nouvelle réponse à la question secrète</label>
							:
							<input type="text" name="account-newsecretanswer" id="account-newsecretanswer" required size="30" maxlength="20" />
							<br />

							<!-- Message d'erreur mauvais format nouvelle réponse secrète -->
							<?php
							if(isset($_SESSION['errorAccountNewSecretAnswer']))
							{
								$errorAccountNewSecretAnswer = $_SESSION['errorAccountNewSecretAnswer'];
								echo "<p><span class='error-register'>$errorAccountNewSecretAnswer</span></p>";                    	
							}
							?>

							<!-- Bouton validation -->
							<input class="validation-button" type="submit" value="Valider"/>

						</form>
					<?php
					}
					// Message succès changement réponse secrète
					elseif(isset($_SESSION['succesChangeSecretAnswer']))
						{
							$succesChangeSecretAnswer = $_SESSION['succesChangeSecretAnswer'];
							echo "<p><span class='succes-account'>$succesChangeSecretAnswer</span></p>";
						}
					?>
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
	unset($_SESSION['errorAccountNomUsed']);
    unset($_SESSION['errorAccountNom']);
    unset($_SESSION['errorAccountPrenomUsed']);
    unset($_SESSION['errorAccountPrenom']);
    unset($_SESSION['errorAccountUsernameUsed']);
    unset($_SESSION['errorAccountUsername']);
    unset($_SESSION['errorAccountPasswordUsed']);
    unset($_SESSION['errorAccountPassword']);
    unset($_SESSION['errorAccountNewPassword']);
    unset($_SESSION['errorAccountNewPassword2']);
    unset($_SESSION['errorAccountSecretQuestionUsed']);
    unset($_SESSION['errorAccountSecretQuestion']);
    unset($_SESSION['errorAccountSecretAnswerUsed']);
    unset($_SESSION['errorAccountSecretAnswer']);
    unset($_SESSION['errorAccountNewSecretAnswer']);
    unset($_SESSION['succesChangeNom']);
    unset($_SESSION['succesChangePrenom']);
    unset($_SESSION['succesChangePassword']);
    unset($_SESSION['succesChangeUsername']);
    unset($_SESSION['succesChangeSecretQuestion']);
    unset($_SESSION['succesChangeSecretAnswer']);
?>