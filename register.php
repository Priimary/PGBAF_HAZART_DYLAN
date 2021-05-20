<?php
session_start();
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
		<!-- si déjà connecté redirige vers accueil.php -->
		<!-- sinon affiche le contenu de register.php -->
		<!-- page entière -->
		<div id="register-corpse">
			<!-- insertion de l'en-tête -->
			<header class="site-header-container">
				<div class="site-header-content"><?php include 'header.php'; ?></div>
			</header>
			<!-- contenu de la page entre en-tête et pied de page -->
			<div id="register-content">
				<!-- section formulaire inscription -->
				<section id="register-form-container">
					<!-- titre pour formulaire -->
					<h1>Créer un compte</h1>
					<!-- formulaire d'inscription -->
					<form id="register-form" method="post" action="register-script.php">
						<label for="register-nom">Votre nom</label>
						<br />
						<input type=text name="register-nom" id="register-nom" required size="30" minlenght="2" maxlenght="20" />
						<br />
						<p><span class="requirement-register-form">2 à 20 caractères (a-z, A-Z, ' et -)</span></p>
						<?php
						// message d'erreur de connexion
		                    if(isset($_SESSION['errornom']))
		                    {
		                        $errornom = $_SESSION['errornom'];
								echo "<p><span class='error-register'>$errornom</span></p>";
		                    }
	                	?>
						<label for="register-prenom">Votre prénom</label>
						<br />
						<input type=text name="register-prenom" id="register-prenom" required size="30" minlenght="2" maxlenght="20" />
						<br />
						<p><span class="requirement-register-form">2 à 20 caractères (a-z, A-Z, ' et -)</span></p>
						<?php
						// message d'erreur de connexion
		                   	if(isset($_SESSION['errorprenom']))
		                    {
		                        $errorprenom = $_SESSION['errorprenom'];
		                        echo "<p><span class='error-register'>$errorprenom</span></p>";                    	
		                    }
	                	?>
						<label for="register-username">Votre nom d'utilisateur</label>
						<br />
						<input type="text" name="register-username" id="register-username" required size="30" minlenght="5" maxlenght="20" />
						<br />
						<p><span class="requirement-register-form">5 à 20 caractères (a-z, A-Z, 0-9, - et _)</span></p>
						<?php
						// message d'erreur de connexion
		                    if(isset($_SESSION['errorusername']))
		                    {
		                        $errorusername = $_SESSION['errorusername'];
		                        echo "<p><span class='error-register'>$errorusername</span></p>";                    	
		                    }
		                    if(isset($_SESSION['usernametaken']))
		                    {
		                    	$usernametaken = $_SESSION['usernametaken'];
		                    	echo "<p><span id='username-taken'>$usernametaken</span></p>";
		                    }
	                	?>
						<label for="register-password">Votre mot de passe</label>
						<br />
						<input type="password" name="register-password" id="register-password" required size="30" minlenght="8" maxlenght="30" />
						<br />
						<p><span class="requirement-register-form">8 à 30 caractères (a-z, A-Z, 0-9, -, _, *, .)</span></p>
						<?php
						// message d'erreur de connexion
		                    if(isset($_SESSION['errorpassword']))
		                    {
		                        $errorpassword = $_SESSION['errorpassword'];
		                        echo "<p><span class='error-register'>$errorpassword</span></p>";                    	
		                    }
	                	?>
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
		                <?php
						// message d'erreur de connexion
		                    if(isset($_SESSION['errorsecretquestion']))
		                    {
		                        $errorpassword = $_SESSION['errorsecretquestion'];
		                        echo "<p><span class='error-register'>$errorsecretquestion</span></p>";                    	
		                    }
	                	?>
		                <label for="register-secretanswer">Réponse à votre question secrète</label>
		                <br />
		                <input type="text" name="register-secretanswer" id="register-secretanswer" required size="30" minlenght="2" maxlenght="20" />
		                <br />
		                <p><span class="requirement-register-form">2 à 20 caractères (a-z, A-Z, ' et -)</span></p>
						<?php
						// message d'erreur de connexion
		                    if(isset($_SESSION['errorsecretanswer']))
		                    {
		                        $errorsecretanswer = $_SESSION['errorsecretanswer'];
		                        echo "<p><span class='error-register'>$errorsecretanswer</span></p>";                    	
		                    }
	                	?>
						<input id="register-button" type="submit" value="INSCRIPTION"/>
					</form>
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
    unset($_SESSION['errornom']);
    unset($_SESSION['errorprenom']);
    unset($_SESSION['errorusername']);
    unset($_SESSION['errorpassword']);
    unset($_SESSION['errorsecretquestion']);
    unset($_SESSION['errorsecretanswer']);
    unset($_SESSION['usernametaken']);
?>