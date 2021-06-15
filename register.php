<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
    	<title>Inscription GBAF</title>
    	<link rel="stylesheet" href="css/style.css"/>
    	<link rel="icon" href="img/favicon.ico"/>
    	<meta name="viewport" content="width=device-width"/>
    </head>
	<body>
		<!-- Bloc page entière -->
		<div id="register-container">
			<!-- Insertion de l'en-tête -->
			<header class="site-header-container">
				<div class="site-header-content"><?php include 'header.php'; ?></div>
			</header>
			<!-- Contenu de la page entre en-tête et pied de page -->
			<div id="register-content">
				<!-- Section formulaire inscription -->
				<section id="register-form-container">
					<!-- Titre pour formulaire -->
					<h1>Créer un compte</h1>
					<!-- Formulaire d'inscription -->
					<form id="register-form" method="post" action="register-script.php">

						<!-- Champ nom -->
						<label for="register-nom">Votre nom</label>
						<br />
						<input type=text name="register-nom" id="register-nom" required size="30" maxlength="20" />
						<br />
						<p><span class="requirement-register-form">2 à 20 caractères (a-z, A-Z, ' et -)</span></p>

						<!-- Message d'erreur si format du nom invalide -->
						<?php
						if(isset($_SESSION['errornom']))
						{
							$errornom = $_SESSION['errornom'];
							echo "<p><span class='error-register'>$errornom</span></p>";
						}
						?>

						<!-- Champ prénom -->
						<label for="register-prenom">Votre prénom</label>
						<br />
						<input type=text name="register-prenom" id="register-prenom" required size="30" maxlength="20" />
						<br />
						<p><span class="requirement-register-form">2 à 20 caractères (a-z, A-Z, ' et -)</span></p>

						<!-- Message d'erreur si format prénom invalide -->
						<?php
						if(isset($_SESSION['errorprenom']))
						{
							$errorprenom = $_SESSION['errorprenom'];
							echo "<p><span class='error-register'>$errorprenom</span></p>";                    	
						}
						?>

	                	<!-- Champ nom d'utilisateur -->
						<label for="register-username">Votre nom d'utilisateur</label>
						<br />
						<input type="text" name="register-username" id="register-username" required size="30" maxlength="20" />
						<br />
						<p><span class="requirement-register-form">5 à 20 caractères (a-z, A-Z, 0-9, - et _)</span></p>

						<!-- Message d'erreur si format nom d'utilisateur invalide ou si nom d'utilisateur déjà pris -->
						<?php
						if(isset($_SESSION['errorusername']))
						{
							$errorusername = $_SESSION['errorusername'];
							echo "<p><span class='error-register'>$errorusername</span></p>";                    	
						}
						elseif(isset($_SESSION['usernametaken']))
						{
							$usernametaken = $_SESSION['usernametaken'];
							echo "<p><span id='username-taken'>$usernametaken</span></p>";
						}
						?>

	                	<!-- Champ mot de passe -->
						<label for="register-password">Votre mot de passe</label>
						<br />
						<input type="password" name="register-password" id="register-password" required size="30" maxlength="30" />
						<br />
						<p><span class="requirement-register-form">8 à 30 caractères (a-z, A-Z, 0-9, -, _, *, .)</span></p>

						<!-- Message d'erreur si format mot de passe invalide -->
						<?php
						if(isset($_SESSION['errorpassword']))
						{
							$errorpassword = $_SESSION['errorpassword'];
							echo "<p><span class='error-register'>$errorpassword</span></p>";                    	
						}
						?>

						<!-- Champ question secrète -->
						<label for="register-secretquestion">Choisissez une question secrète</label>
						<br />
						<select name="register-secretquestion" id="register-secretquestion">
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
		                <br/>

		                <!-- Message d'erreur si question secrète invalide -->
						<?php
						if(isset($_SESSION['errorsecretquestion']))
						{
							$errorsecretquestion = $_SESSION['errorsecretquestion'];
							echo "<p><span class='error-register'>$errorsecretquestion</span></p>";                    	
						}
						?>

						<!-- Champ réponse secrète -->
		                <label for="register-secretanswer">Réponse à votre question secrète</label>
		                <br />
		                <input type="text" name="register-secretanswer" id="register-secretanswer" required size="30" maxlength="20" />
		                <br />
		                <p><span class="requirement-register-form">2 à 20 caractères (a-z, A-Z, ' et -)</span></p>

		                <!-- Message d'erreur format réponse secrète invalide -->
						<?php
						if(isset($_SESSION['errorsecretanswer']))
						{
							$errorsecretanswer = $_SESSION['errorsecretanswer'];
							echo "<p><span class='error-register'>$errorsecretanswer</span></p>";                    	
						}
						?>

						<!-- Bouton validation inscription -->
						<input id="register-button" type="submit" value="INSCRIPTION"/>

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
    unset($_SESSION['errornom']);
    unset($_SESSION['errorprenom']);
    unset($_SESSION['errorusername']);
    unset($_SESSION['errorpassword']);
    unset($_SESSION['errorsecretquestion']);
    unset($_SESSION['errorsecretanswer']);
    unset($_SESSION['usernametaken']);
?>