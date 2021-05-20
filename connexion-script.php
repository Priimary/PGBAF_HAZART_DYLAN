<?php 
session_start();
// Connexion bdd
try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=oc_gbaf;charset=utf8', 'root', 'root');
    }
catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
// Récupération de l'utilisateur et de son pass hashé
$req = $bdd->prepare('SELECT id_user, username, password, prenom, nom FROM account WHERE username = :username');
$req->execute(array(
    'username' => $_POST['connexion-username']));
$resultat = $req->fetch();

// Comparaison du pass envoyé via le formulaire avec la base
$isPasswordCorrect = password_verify($_POST['connexion-password'], $resultat['password']);
// message d'erreur de connexion
$error = "Identifiant/mot de passe incorrect";

// Si le pseudo et/ou mdp incorrect, affiche un message d'erreur, sinon créé variable de session et renvoie sur l'index
if (!$resultat)
{
    $_SESSION['error'] = $error;
    header('Location: connexion.php');
    exit();
}
else
{
    if (isset($isPasswordCorrect) && $isPasswordCorrect) 
    {
        $_SESSION['id_user'] = $resultat['id_user'];
        $_SESSION['prenom'] = $resultat['prenom'];
        $_SESSION['nom'] = $resultat['nom'];
        $_SESSION['username'] = $resultat['username'];
        $_SESSION['loggedIn'] = true;
        header('Location: index.php');
        exit();
    }
    else 
    {
        $_SESSION['error'] = $error;
        header('Location: connexion.php');
        exit();
    }
}
?>