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
// variable message erreur
$errorpasswordlost = "Informations invalides";
$errorpasswordlost_password = "Mauvais format, respectez la condition au-dessus";
$errorpasswordlost_password2 = "Les deux champs ne sont pas identiques";

// si données reçues depuis le champ password & variable session créée après avoir vérifié les données du formulaire
if (isset($_POST['passwordlost-password'], $_POST['passwordlost-password2'], $_SESSION['passwordlost-username']) 
	&& $_POST['passwordlost-password'] === $_POST['passwordlost-password2'])
{
    $_POST['passwordlost-password'] = htmlspecialchars($_POST['passwordlost-password']);

    if (preg_match("#^(?=.{8,30}$)(?![-_*.])(?!.*[-_*.]{2})[a-zA-Z0-9-_*.]+$#", $_POST['passwordlost-password']))
    {
        $password = password_hash($_POST['passwordlost-password'], PASSWORD_DEFAULT);
        $upd = $bdd->prepare('UPDATE account SET password = :password WHERE username = :username');
        $upd->execute(array(
        	'password' => $password,
        	'username' => $_SESSION['passwordlost-username']));
        $upd->closeCursor();
        unset($_SESSION['passwordlost-username']);
        header('Location: connexion.php');
        exit();
    }
    else
    {
        $_SESSION['errorpasswordlost-password'] = $errorpasswordlost_password;
        header('Location: passwordlost.php');
        exit();
    }
}
elseif (isset($_POST['passwordlost-password'], $_POST['passwordlost-password2'], $_SESSION['passwordlost-username']) 
	&& $_POST['passwordlost-password'] != $_POST['passwordlost-password2'])
{
	$_SESSION['errorpasswordlost-password2'] = $errorpasswordlost_password2;
	header('Location: passwordlost.php');
	exit();
}
else
{
	// rend inoffensif les possibles balises html de l'username
	if (isset($_POST['passwordlost-username'], $_POST['passwordlost-secretquestion'], $_POST['passwordlost-secretanswer']))
	{
	    $username = htmlspecialchars($_POST['passwordlost-username']);
	    $secretquestion = htmlspecialchars($_POST['passwordlost-secretquestion']);
	    $secretanswer = htmlspecialchars($_POST['passwordlost-secretanswer']);
	}
	else
	{
		$_SESSION['errorpasswordlost'] = $errorpasswordlost;
	    header('Location: passwordlost.php');
	    exit();
	}
	// cherche si les données reçues correspondent à celles dans la bdd
	if(isset($username, $secretquestion, $secretanswer))
	{
		$req = $bdd->prepare('SELECT username, question, reponse FROM account WHERE username = :username');
		$req->execute(array(
			'username' => $username));
		$user = $req->fetch();

		if (isset($user) && $user['username'] === $username && $user['question'] === $secretquestion && $user['reponse'] === $secretanswer)  
		{	
	   		$_SESSION['passwordlost-username'] = $username;
	   		header('Location: passwordlost.php');
	   		exit();
	   	}
	   	else
	   	{
	   		$_SESSION['errorpasswordlost'] = $errorpasswordlost;
	    	header('Location: passwordlost.php');
	    	exit();
	   	}
	}
	else
	{
		$_SESSION['errorpasswordlost'] = $errorpasswordlost;
	    header('Location: passwordlost.php');
	    exit();
	}
}
?>