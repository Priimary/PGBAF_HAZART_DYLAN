<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
    	<title>Extranet GBAF</title>
    	<link rel="stylesheet" href="style.css" />
    </head>
	<body>
		<!-- si déjà connecté redirige vers accueil.php -->
		<!-- sinon affiche le contenu de register.php -->
		<!-- page entière -->
		<div class="register-corpse">
			<!-- insertion de l'en-tête -->
			<header class="site-header-container">
				<div class="site-header-content"><?php include 'header.php'; ?></div>
			</header>
			<!-- contenu de la page entre en-tête et pied de page -->
			<div class="register-content">
				<!-- section formulaire inscription -->
				<section class="register-form-container">
					<!-- titre pour formulaire -->
					<div class="register-h1">
						<h1>Créer un compte</h1>
					</div>
					<!-- formulaire d'inscription -->
					<div class="register-form-content">
						<form class="register-form" method="post" action="register-script.php">
							<label for="nom">Votre nom</label> : <input type=text name="nom" id="nom" required size="30" maxlenght="30" /><br />
							<label for="prenom">Votre prénom</label> : <input type=text name="prenom" id="prenom" required size="30" maxlenght="30" /><br />
							<label for="pseudo">Votre pseudo</label> : <input type="text" name="pseudo" id="pseudo" required size="30" maxlenght="30" /><br />
							<label for="password">Votre mot de passe</label> : <input type="password" name="password" id="password" required size="30" maxlenght="30" /><br />
							<label for="secretquestion">Choisissez une question secrète</label> : <select name="secretquestion" id="secretquestion">
		                        <option value="Qu'est ce que vous vouliez devenir plus grand, lorsque vous étiez enfant ?" selected>
		                        	Qu'est ce que vous vouliez devenir plus grand, lorsque vous étiez enfant ?
		                        </option> 
		                        <option value="Quel est le nom de famille de votre professeur d'enfance préféré ?">Quel est le nom de famille de votre professeur d'enfance préféré ?</option>
		                        <option value="Quel est le nom et prénom de votre premier amour ?">Quel est le nom et prénom de votre premier amour ?</option>
		                        <option value="Dans quelle ville se sont rencontrés vos parents ?">Dans quelle ville se sont rencontrés vos parents ?</option>
		                        </select><br/>
		                    <label for="secretanswer">Réponse à votre question secrète</label> : <input type="text" name="secretanswer" id="secretanswer" required size="30" maxlenght="30" /><br />
							<input type="submit" value="INSCRIPTION"/><br />
						</form>
					</div>
				</section>
			</div>
			<!-- insertion pied de base -->
			<footer class="site-footer-container">
				<div class="site-footer-content"><?php include 'footer.php'; ?></div>
			</footer>
		</div>	
    </body>
</html>