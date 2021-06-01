<?php 
session_start();
// Connexion BDD
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=oc_gbaf;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
// Variable message d'erreur
$errorConnexion = "Identifiant/mot de passe incorrect";

// Récupération de des données de l'utilisateur
$req = $bdd->prepare('SELECT id_user, nom, prenom, username, password, question FROM account WHERE username = :username');
$req->execute(array(
    'username' => $_POST['connexion-username']));
$resultat = $req->fetch();

// Comparaison du pass envoyé via le formulaire avec le mdp de la BDD
$isPasswordCorrect = password_verify($_POST['connexion-password'], $resultat['password']);

// Si le pseudo et/ou mdp incorrect, affiche un message d'erreur, sinon connecte l'utilisateur, créé variable de session et renvoie sur l'index
if (!$resultat)
{
    $_SESSION['errorConnexion'] = $errorConnexion;
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
        $_SESSION['question'] = $resultat['question'];
        $_SESSION['loggedIn'] = true;
        header('Location: index.php');
        exit();
    }
    else 
    {
        $_SESSION['errorConnexion'] = $errorConnexion;
        header('Location: connexion.php');
        exit();
    }
}
?>