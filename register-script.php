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

// Mise en variable message d'erreurs
$errornom = "Mauvais format, respectez la condition au-dessus";
$errorprenom = "Mauvais format, respectez la condition au-dessus";
$errorusername = "Mauvais format, respectez la condition au-dessus";
$errorpassword = "Mauvais format, respectez la condition au-dessus";
$errorsecretquestion = "Cette question n'est pas dans le formulaire";
$errorsecretanswer = "Mauvais format, respectez la condition au-dessus";
$usernametaken = "Nom d'utilisateur déjà pris";

// Vérification nom, doit contenir entre 2 et 20 caractères, commencant par minimum 2 lettres, avec possibilitée d'avoir apostrophe ou tiret-d'union puis suite nom
if(isset($_POST['register-nom']))
{
    $_POST['register-nom'] = htmlspecialchars($_POST['register-nom']);

    if(preg_match("#^(?=.{2,20}$)([a-zA-Z]{2,}'?-?[a-zA-Z]{2,}$)#", $_POST['register-nom']))
    {
        $nom = $_POST['register-nom'];
    }
    else
    {
        $_SESSION['errornom'] = $errornom;
    }
}
else
{
    $_SESSION['errornom'] = $errornom;
}

// Vérification prénom, doit contenir entre 2 et 20 caractères, commencant par minimum 2 lettres, avec possibilitée d'avoir apostrophe ou tiret-d'union puis suite prénom
if(isset($_POST['register-prenom']))
{
    $_POST['register-prenom'] = htmlspecialchars($_POST['register-prenom']);

    if(preg_match("#^(?=.{2,20}$)([a-zA-Z]{2,}'?-?[a-zA-Z]{2,}$)#", $_POST['register-prenom']))
    {
        $prenom = $_POST['register-prenom'];
    }
    else
    {
        $_SESSION['errorprenom'] = $errorprenom;
    }
}
else
{
    $_SESSION['errorprenom'] = $errorprenom;
}

/* Vérification username, doit contenir entre 5 et 20 cacatères, commencant par une lettre obligatoirement, puis peut utiliser lettres/chiffres/tiret et underscore, mais ne peux pas utiliser deux underscore ou tiret à la suite */
if(isset($_POST['register-username']))
{
    $_POST['register-username'] = htmlspecialchars($_POST['register-username']);

    if(preg_match("#^(?=.{5,20}$)(?![_-])(?!.*[-_]{2})[a-zA-Z0-9_-]+$#", $_POST['register-username']))
    {
        $username = $_POST['register-username'];
    }
    else
    {
        $_SESSION['errorusername'] = $errorusername;
    }
}
else
{
    $_SESSION['errorusername'] = $errorusername;
}

/* Vérification password, doit contenir entre 8 et 30 caractères, commencant par une lettre ou un chiffre obligatoirement, puis peut utiliser lettres/chiffres, caractères spéciaux, mais ne peux pas utiliser deux caractères spéciaux à la suite */
if(isset($_POST['register-password']))
{
    $_POST['register-password'] = htmlspecialchars($_POST['register-password']);

    if(preg_match("#^(?=.{8,30}$)(?![-_*.])(?!.*[-_*.]{2})[a-zA-Z0-9-_*.]+$#", $_POST['register-password']))
    {
        $password = password_hash($_POST['register-password'], PASSWORD_DEFAULT);
    }
    else
    {
        $_SESSION['errorpassword'] = $errorpassword;
    }
}
else
{
    $_SESSION['errorpassword'] = $errorpassword;
}

// Vérification question secrète en la récupérant du formulaire et la comparant avec les question secrètes normalement disponibles
$secretquestion1 = "Qu'est ce que vous vouliez devenir plus grand, lorsque vous étiez enfant ?";
$secretquestion2 = "Quel est le nom de famille de votre professeur d'enfance préféré ?";
$secretquestion3 = "Quel est le nom et prénom de votre premier amour ?";
$secretquestion4 = "Dans quelle ville se sont rencontrés vos parents ?";

if(isset($_POST['register-secretquestion']) && $_POST['register-secretquestion'] == $secretquestion1 || $secretquestion2 || $secretquestion3 || $secretquestion4)
{
	$secretquestion = htmlspecialchars($_POST['register-secretquestion']);
}
else
{
	$_SESSION['errorsecretquestion'] = $errorsecretquestion;
}

// Vérification réponse secrète, doit contenir entre 2 et 20 caractères, commencant par minimum 2 lettres, avec possibilitée d'avoir apostrophe ou tiret-d'union puis suite texte 
if(isset($_POST['register-secretanswer']))
{
    $_POST['register-secretanswer'] = htmlspecialchars($_POST['register-secretanswer']);

    if(preg_match("#^(?=.{2,20}$)([a-zA-Z]{2,}'?-?[a-zA-Z]{2,}$)#", $_POST['register-secretanswer']))
    {
        $secretanswer = $_POST['register-secretanswer'];
    }
    else
    {
        $_SESSION['errorsecretanswer'] = $errorsecretanswer;
        header('Location: register.php');
        exit();
    }
}
else
{
    $_SESSION['errorsecretanswer'] = $errorsecretanswer;
    header('Location: register.php');
    exit();
}

// Vérification si username pas déjà dispo en database si prérequis du formulaire rempli, si non dispo inscris l'utilisateur dans la bdd
if(isset($prenom, $nom, $username, $password, $secretquestion, $secretanswer))
{
	$req = $bdd->prepare('SELECT nom, prenom, username FROM account WHERE username = :username');
	$req->execute(array(
		'username' => $username));
	$user = $req->fetch();

	if(isset($user) && $user['username'] === $username)  
	{	
   		$_SESSION['usernametaken'] = $usernametaken;
   		header('Location: register.php');
   		exit();
   	}
   	else
   	{
		$req->closeCursor();
		$ins = $bdd->prepare('INSERT INTO account(nom, prenom, username, password, question, reponse) VALUES(:nom, :prenom, :username, :password, :question, :reponse)');
		$ins->execute(array(
		    'nom' => $nom,
		    'prenom' => $prenom,
		    'username' => $username,
		    'password' => $password,
		    'question' => $secretquestion,
		    'reponse' => $secretanswer));
		$ins->closeCursor();
	}
	if($ins)
	{
        $registerdone = "Vous avez bien réussi à créer votre compte !";
        $_SESSION['registerdone'] = $registerdone;
		header('Location: connexion.php');
		exit();
	}
	else
	{
		echo "Erreur, contactez l'administrateur du site pour plus d'informations";
	}
}
else
{
	echo "Erreur, contactez l'administrateur du site pour plus d'informations";	
}
?>