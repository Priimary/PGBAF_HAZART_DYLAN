<?php
// Si déconnecté redirige vers la page de connexion sinon affiche la page
session_start();
if($_SESSION['loggedIn'] != true)
{
    header('Location: connexion.php');
    exit;
}
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
        <!-- Bloc page entière index -->
        <div id="index-container">
    		<!-- Insertion en-tête -->
    		<header class="site-header-container">
                <div class="site-header-content"><?php include 'header.php'; ?></div>
			</header>
            <!-- Bloc contenu index entre en-tête et pied de page -->
            <div id="index-content">
                <!-- Section GBAF -->
                <section id="gbaf-section-container">
                    <!-- Article contenu gbaf -->
        			<article id="gbaf-section-content">
                        <!--Titre gbaf -->
        				<h1>
                            Qu'est ce que GBAF et ce site ?
                        </h1>
                        <!-- Description gbaf -->
        				<p>
        					Le Groupement Banque-Assurance Français (GBAF) est une fédération représentant les 6 grands groupes français.<br />
        					Même s'il existe une forte concurrence entre ces entités, elles vont toutes travailler de la même façon pour gérer près de 80 millions de comptes sur le territoire national.
        					Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française. C'est aussi un interlocuteur privilégié des pouvoirs publics.
        				</p>
                        <!-- Illustration gbaf -->
        				<img src="img/illustration_gbaf.png" alt="logo des banques fondatrices gbaf">
        			</article>
                </section>

                <!-- Section acteurs -->
                <section id="actors-section-container">
                    <!-- Article contenu acteur -->
        			<article id="actors-section-content">
                        <!-- Titre présentation acteur -->
        				<h2>
                            Présentation des acteurs et partenaires
                        </h2>
                        <!-- Paragraphe présentation acteurs -->
        				<p>
        					Plusieurs partenaires se sont engagés avec le GBAF pour proposer leurs services aux salariés, et ainsi augmenter leur confort.
        				</p>
                    </article>
                    <!-- Bloc conteneur liste des acteurs -->
                    <div id="actors-list-container">
        				<?php
                        // Connexion BDD
                        try
                        {
                            $bdd = new PDO('mysql:host=localhost;dbname=oc_gbaf;charset=utf8', 'root', 'root');
                        }
                        catch(Exception $e)
                        {
                            die('Erreur : '.$e->getMessage());
                        }
                        // Récupération données acteurs
                        $req = $bdd->query('SELECT id_acteur, acteur, description, logo FROM acteur');
                        // Affiche les données acteurs
                        while ($donnees = $req->fetch())
                        {
                        ?>
                            <!-- Article pour chaque acteur -->
        				    <article class="actors-entry-content">
                                <!-- Logo de chaque acteur -->
                                <img src="img/<?php echo htmlspecialchars($donnees['logo']); ?>">
                                
                                <!-- Bloc contenant titre et description de chaque acteur -->
                                <div class="actors-entry-description-container">
                                    <h3>
                                        <?php echo htmlspecialchars($donnees['acteur']); ?>
                                    </h3>
                                    <p>
                                        <?php echo htmlspecialchars($donnees['description']); ?> 
                                    </p>
                                </div>

                                <!-- Lien lire la suite qui renvoie sur la page de l'acteur -->
                                <a href="actors.php?acteur=<?php echo $donnees['id_acteur']; ?>">Lire la suite</a>

                            </article>
                        <?php
                        }
                        $req->closeCursor();
                        ?>
        			</div>
        		</section>
            </div>
    		<!-- Insertion pied de page -->
			<footer class="site-footer-container">
                <div class="site-footer-content"><?php include 'footer.php'; ?></div>
			</footer>
		</div>
    </body>
</html>