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
		<div id="passwordlost-container">
			<!-- insertion de l'en-tête -->
			<header class="site-header-container">
				<div class="site-header-content"><?php include 'header.php'; ?></div>
			</header>
			<!-- contenu de la page entre en-tête et pied de page -->
			<div id="passwordlost-content">
				<!-- section formulaire de connexion -->
				<section id="passwordlost-form-container">
						<!-- titre pour formulaire -->
						<h1>Changer de mot de passe</h1>
						<!-- formulaire récupération mot de passe -->
						<form id="passwordlost-form" method="post" action="passwordlost-script.php">
						<?php
						if(isset($_SESSION['passwordlost-username']))
						{
						?>
							<label for="passwordlost-password">Nouveau mot de passe</label>
							<br />
							<input type="password" name="passwordlost-password" id="passwordlost-password" required size="30" minlenght="8" maxlenght="30" />
							<br />
							<p><span class="requirement-passwordlost-form">8 à 30 caractères (a-z, A-Z, 0-9, -, _, *, .)</span></p>
							<?php
							// message d'erreur de format
		                    if(isset($_SESSION['errorpasswordlost-password']))
		                    {
		                        $errorpasswordlost_password = $_SESSION['errorpasswordlost-password'];
		                        echo "<p><span class='error-passwordlost'>$errorpasswordlost_password</span></p>";                    	
		                    }
	                		?>
	                		<br />
	                		<label for="passwordlost-password2">Répétition nouveau mot de passe</label>
							<br />
							<input type="password" name="passwordlost-password2" id="passwordlost-password2" required size="30" minlenght="8" maxlenght="30" />
							<br />
							<p><span class="requirement-passwordlost-form">8 à 30 caractères (a-z, A-Z, 0-9, -, _, *, .)</span></p>
							<?php
							// message d'erreur de format
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
							<label for="passwordlost-username">Nom d'utilisateur</label>
							<br />
							<input type=text name="passwordlost-username" id="passwordlost-username" required size="30" maxlenght="30" />
							<br />
							<?php
							// message d'erreur de format
			                    if(isset($_SESSION['errorpasswordlost']))
			                    {
			                        $errorpasswordlost = $_SESSION['errorpasswordlost'];
			                        echo "<p><span class='error-passwordlost'>$errorpasswordlost</span></p>";                    	
			                    }
	                		?>

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
			                <?php
							// message d'erreur de format
			                    if(isset($_SESSION['errorpasswordlost']))
			                    {
			                        $errorpasswordlost = $_SESSION['errorpasswordlost'];
			                        echo "<p><span class='error-passwordlost'>$errorpasswordlost</span></p>";                    	
			                    }
	                		?>

			                <label for="passwordlost-secretanswer">Réponse à votre question secrète</label>
			                <br />
			                <input type="text" name="passwordlost-secretanswer" id="passwordlost-secretanswer" required size="30" minlenght="2" maxlenght="20" />
			                <br />
			                <?php
							// message d'erreur de format
			                    if(isset($_SESSION['errorpasswordlost']))
			                    {
			                        $errorpasswordlost = $_SESSION['errorpasswordlost'];
			                        echo "<p><span class='error-passwordlost'>$errorpasswordlost</span></p>";                    	
			                    }
	                	}
	                		?>
	                		<input id="passwordlost-button" type="submit" value="ENVOYER"/>
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
    unset($_SESSION['errorpasswordlost']);
    unset($_SESSION['errorpasswordlost-password']);
    unset($_SESSION['errorpasswordlost-password2']);
?>