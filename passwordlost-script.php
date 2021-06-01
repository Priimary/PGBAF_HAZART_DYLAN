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

// Variables message d'erreurs
$errorpasswordlost = "Informations invalides";
$errorpasswordlost_password = "Mauvais format, respectez la condition au-dessus";
$errorpasswordlost_password2 = "Les deux champs ne sont pas identiques";
$errorpasswordused = "Veuillez définir un nouveau mot de passe différent du précédent";

/* Vérifie si champs password remplis, variable session créée, et nouveaux mdp identiques, puis sécurise le nouveau mdp, puis vérifie si format nouveau mdp correct, puis vérifie si différent de l'ancien */
if(isset($_POST['passwordlost-password'], $_POST['passwordlost-password2'], $_SESSION['passwordlost-username']) 
	&& $_POST['passwordlost-password'] === $_POST['passwordlost-password2'])
{
    $_POST['passwordlost-password'] = htmlspecialchars($_POST['passwordlost-password']);

    if(preg_match("#^(?=.{8,30}$)(?![-_*.])(?!.*[-_*.]{2})[a-zA-Z0-9-_*.]+$#", $_POST['passwordlost-password']))
    {
        $req = $bdd->prepare('SELECT password FROM account WHERE username = :username');
		$req->execute(array('username' => $_SESSION['passwordlost-username']));
		$result = $req->fetch();
		$isPasswordUsed = password_verify($_POST['passwordlost-password'], $result['password']);
		if(isset($isPasswordUsed) && $isPasswordUsed)
		{
			$_SESSION['errorpasswordused'] = $errorpasswordused;
			header('Location: passwordlost.php');
			exit();
		}
		else
		{
			$req->closeCursor();
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
    }
    else
    {
        $_SESSION['errorpasswordlost-password'] = $errorpasswordlost_password;
        header('Location: passwordlost.php');
        exit();
    }
}
elseif(isset($_POST['passwordlost-password'], $_POST['passwordlost-password2'], $_SESSION['passwordlost-username']) 
	&& $_POST['passwordlost-password'] != $_POST['passwordlost-password2'])
{
	$_SESSION['errorpasswordlost-password2'] = $errorpasswordlost_password2;
	header('Location: passwordlost.php');
	exit();
}
// Vérifie si champs username, secretquestion et secretanswer remplis, puis les sécurise, puis vérifie s'ils correspondent à ceux dans la BDD
else
{
	if(isset($_POST['passwordlost-username'], $_POST['passwordlost-secretquestion'], $_POST['passwordlost-secretanswer']))
	{
	    $username = htmlspecialchars($_POST['passwordlost-username']);
	    $secretquestion = htmlspecialchars($_POST['passwordlost-secretquestion']);
	    $secretanswer = htmlspecialchars($_POST['passwordlost-secretanswer']);
	    if(isset($username, $secretquestion, $secretanswer))
		{
			$req = $bdd->prepare('SELECT username, question, reponse FROM account WHERE username = :username');
			$req->execute(array(
				'username' => $username));
			$user = $req->fetch();

			if(isset($user) && $user['username'] === $username && $user['question'] === $secretquestion && $user['reponse'] === $secretanswer)  
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
	}
	else
	{
		$_SESSION['errorpasswordlost'] = $errorpasswordlost;
	    header('Location: passwordlost.php');
	    exit();
	}
	
}
?>