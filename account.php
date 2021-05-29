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
		<!-- bloc page entière -->
		<div id="account-container">
			<!-- insertion de l'en-tête -->
			<header class="site-header-container">
				<div class="site-header-content"><?php include 'header.php'; ?></div>
			</header>
			<!-- contenu de la page entre en-tête et pied de page -->
			<div id="account-content">
				<!-- section formulaire de changement informations utilisateur -->
				<section id="account-form-container">
						<!-- titre pour formulaire -->
						<h1>INFORMATIONS</h1>
						<!-- formulaire informations utilisateurs -->
						<form id="account-form" method="post" action="account-script.php">
							<p>Nom :<span class="account-info"><?php echo $_SESSION['nom']; ?></span></p>
							<button name="nomBtn" type="submit" value="nom"><img src="img/pencil.png"></button>
							<br />
							<?php
							if(isset($_SESSION['changeNom']))
							{
								// message d'erreur si nom identique à celui de la bdd
			                    if(isset($_SESSION['errorAccountNomUsed']))
			                    {
			                        $errorAccountNomUsed = $_SESSION['errorAccountNomUsed'];
			                        echo "<p><span class='error-account'>$errorAccountNomUsed</span></p>";                    	
			                    }
							?>
								<label for="account-nom">Nouveau nom</label>
								:
								<input type=text name="account-nom" id="account-nom" required size="30" minlenght="2" maxlenght="20" />
								<br />
								<p><span class="requirement-account-form">2 à 20 caractères (a-z, A-Z, ' et -)</span></p>
								<?php
									// message d'erreur de connexion
				                    if(isset($_SESSION['errorAccountNom']))
				                    {
				                        $errorAccountNom = $_SESSION['errorAccountNom'];
										echo "<p><span class='error-account'>$errorAccountNom</span></p>";
				                    }
			                	?>
			                	<input class="validation-button" type="submit" value="Valider"/>
			                	<?php
							}
								?>
							<br />
							<p>Prenom :<span class="account-info"><?php echo $_SESSION['prenom']; ?></span></p>
							<button name="prenomBtn" type="submit" value="prenom"><img src="img/pencil.png"></button>
							<br />
							<?php
							if(isset($_SESSION['changePrenom']))
							{
								// message d'erreur si prenom identique à celui de la bdd
			                    if(isset($_SESSION['errorAccountPrenomUsed']))
			                    {
			                        $errorAccountPrenomUsed = $_SESSION['errorAccountPrenomUsed'];
			                        echo "<p><span class='error-account'>$errorAccountPrenomUsed</span></p>";                    	
			                    }
							?>
								<label for="account-prenom">Nouveau prénom</label>
								:
								<input type=text name="account-prenom" id="account-prenom" required size="30" minlenght="2" maxlenght="20" />
								<br />
								<p><span class="requirement-account-form">2 à 20 caractères (a-z, A-Z, ' et -)</span></p>
								<?php
									// message d'erreur de connexion
				                    if(isset($_SESSION['errorAccountPrenom']))
				                    {
				                        $errorAccountPrenom = $_SESSION['errorAccountPrenom'];
										echo "<p><span class='error-account'>$errorAccountPrenom</span></p>";
				                    }
								?>
								<input class="validation-button" type="submit" value="Valider"/>
								<?php
							}
								?>

							<br />
							<p>Nom d'utilisateur :<span class="account-info"><?php echo $_SESSION['username']; ?></span></p>
							<button name="usernameBtn" type="submit" value="username"><img src="img/pencil.png"></button>
							<br />
							<?php
							if(isset($_SESSION['changeUsername']))
							{
								// message d'erreur si nom d'utilisateur déjà utilisé
			                    if(isset($_SESSION['errorAccountUsernameUsed']))
			                    {
			                        $errorAccountUsernameUsed = $_SESSION['errorAccountUsernameUsed'];
			                        echo "<p><span class='error-account'>$errorAccountUsernameUsed</span></p>";                    	
			                    }
							?>
								<label for="account-username">Nouveau nom d'utilisateur</label>
								:
								<input type=text name="account-username" id="account-username" required size="30" minlenght="2" maxlenght="20" />
								<br />
								<p><span class="requirement-account-form">5 à 20 caractères (a-z, A-Z, 0-9, - et _)</span></p>
								<?php
									// message d'erreur de connexion
				                    if(isset($_SESSION['errorAccountUsername']))
				                    {
				                        $errorAccountUsername = $_SESSION['errorAccountUsername'];
										echo "<p><span class='error-account'>$errorAccountUsername</span></p>";
				                    }
								?>
								<input class="validation-button" type="submit" value="Valider"/>
								<?php
							}
								?>
							<br />
							<p>Mot de passe :<span class="account-info">********</span></p>
							<button name="passwordBtn" type="submit" value="password"><img src="img/pencil.png"></button>
							<br />
							<?php
							if(isset($_SESSION['changePassword']))
							{
								// message d'erreur si mot de passe identique à celui de la bdd
			                    if(isset($_SESSION['errorAccountPasswordUsed']))
			                    {
			                        $errorAccountPasswordUsed = $_SESSION['errorAccountPasswordUsed'];
			                        echo "<p><span class='error-account'>$errorAccountPasswordUsed</span></p>";                    	
			                    }
	                		?>
		                		<label for="account-password">Mot de passe actuel</label>
		                		:
		                		<input type="password" name="account-password" id="account-password" required size="30" minlenght="8" maxlenght="30" />
		                		<br />
		                		<?php
								// message d'erreur de format
			                    if(isset($_SESSION['errorAccountPassword']))
			                    {
			                        $errorAccountPassword = $_SESSION['errorAccountPassword'];
			                        echo "<p><span class='error-account'>$errorAccountPassword</span></p>";                    	
			                    }
		                		?>
		                		<br />
								<label for="account-newpassword">Nouveau mot de passe</label>
								:
								<input type="password" name="account-newpassword" id="account-newpassword" required size="30" minlenght="8" maxlenght="30" />
								<br />
								<p><span class="requirement-account-form">8 à 30 caractères (a-z, A-Z, 0-9, -, _, *, .)</span></p>
								<?php
								// message d'erreur de format
			                    if(isset($_SESSION['errorAccountNewPassword']))
			                    {
			                        $errorAccountNewPassword = $_SESSION['errorAccountNewPassword'];
			                        echo "<p><span class='error-account'>$errorAccountNewPassword</span></p>";                    	
			                    }
		                		?>
		                		<br />
		                		<label for="account-newpassword2">Répétition nouveau mot de passe</label>
								:
								<input type="password" name="account-newpassword2" id="account-newpassword2" required size="30" minlenght="8" maxlenght="30" />
								<br />
								<?php
								// message d'erreur mot de passe différent
			                    if(isset($_SESSION['errorAccountNewPassword2']))
			                    {
			                        $errorAccountNewPassword2 = $_SESSION['errorAccountNewPassword2'];
			                        echo "<p><span class='error-account'>$errorAccountNewPassword2</span></p>";                    	
			                    }
		                		?>
		                		<input class="validation-button" type="submit" value="Valider"/>
		                		<?php
		                	}
		                		?>
							<br />

							<p>Question secrète :<span class="account-info"><?php echo $_SESSION['question']; ?></span></p>
							<button name="questionBtn" type="submit" value="question"><img src="img/pencil.png"></button>
							<br />

							<?php
							if(isset($_SESSION['changeQuestion']))
							{
								// message d'erreur si question identique à celle de la bdd
			                    if(isset($_SESSION['errorAccountQuestionUsed']))
			                    {
			                        $errorAccountQuestionUsed = $_SESSION['errorAccountQuestionUsed'];
			                        echo "<p><span class='error-account'>$errorAccountQuestionUsed</span></p>";                    	
			                    }
			                ?>
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
								<br/>
								<?php
									// message d'erreur de connexion
									if(isset($_SESSION['errorAccountSecretQuestion']))
										{
											$errorAccountSecretQuestion = $_SESSION['errorAccountSecretQuestion'];
											echo "<p><span class='error-account'>$errorAccountSecretQuestion</span></p>";                    	
					                    }
				                ?>
				                <input class="validation-button" type="submit" value="Valider"/>
				                <?php
							}
								?>
							<br />

							<p>Réponse secrète :<span class="account-info">********</span></p>
							<button name="answerBtn" type="submit" value="answer"><img src="img/pencil.png"></button>
							<br />

							<?php
							if(isset($_SESSION['changeAnswer']))
							{
								// message d'erreur si réponse identique à celle de la bdd
			                    if(isset($_SESSION['errorAccountAnswerUsed']))
			                    {
			                        $errorAccountAnswerUsed = $_SESSION['errorAccountAnswerUsed'];
			                        echo "<p><span class='error-account'>$errorAccountAnswerUsed</span></p>";                    	
			                    }
			                ?>
								<label for="account-secretanswer">Réponse actuelle à la question secrète</label>
								:
								<input type="text" name="account-secretanswer" id="account-secretanswer" required size="30" minlenght="2" maxlenght="20" />
								<br />
								<?php
								// message d'erreur de connexion
								if(isset($_SESSION['errorAccountSecretAnswer']))
								{
									$errorAccountSecretAnswer = $_SESSION['errorAccountSecretAnswer'];
									echo "<p><span class='error-register'>$errorAccountSecretAnswer</span></p>";                    	
								}
								?>
								<br />
								<label for="account-newsecretanswer">Nouvelle réponse à la question secrète</label>
								:
								<input type="text" name="account-newsecretanswer" id="account-newsecretanswer" required size="30" minlenght="2" maxlenght="20" />
								<br />
								<?php
								// message d'erreur de connexion
								if(isset($_SESSION['errorAccountNewSecretAnswer']))
								{
									$errorAccountNewSecretAnswer = $_SESSION['errorAccountNewSecretAnswer'];
									echo "<p><span class='error-register'>$errorAccountNewSecretAnswer</span></p>";                    	
								}
								?>
								<input class="validation-button" type="submit" value="Valider"/>
								<?php
							}
								?>
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
?>