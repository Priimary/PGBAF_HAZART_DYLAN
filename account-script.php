<?php
session_start();
// mise en variable données nécessaires
$checkNom = "nom";
$checkPrenom = "prenom";
$checkUsername = "username";
$checkPassword = "password";
$checkQuestion = "question";
$checkAnswer = "answer";
$errorAccountNomUsed = "Veuillez utiliser un nom différent de l'ancien !";
$errorAccountNom = "Mauvais format, respectez la condition au-dessus";
$errorAccountPrenomUsed = "Veuillez utiliser un prenom différent de l'ancien !";
$errorAccountPrenom = "Mauvais format, respectez la condition au-dessus";
$errorAccountUsernameUsed = "Ce nom d'utilisateur est déjà utilisé !";
$errorAccountUsername = "Mauvais format, respectez la condition au-dessus";
$errorAccountPasswordUsed = "Veuillez utiliser un mot de passe différent de l'ancien !";
$errorAccountPassword = "Ancien mot de passe invalide !";
$errorAccountNewPassword = "Mauvais format, respectez la condition au-dessus";
$errorAccountNewPassword2 = "Les deux champs ne sont pas identiques";
$errorAccountSecretQuestionUsed = "Veuillez utiliser une question secrète différente de l'ancienne !";
$errorAccountSecretQuestion = "Cette question n'est pas dans le formulaire";
$errorAccountSecretAnswerUsed = "Veuillez utiliser une réponse secrète différente de l'ancienne !";
$errorAccountSecretAnswer = "Ancienne réponse secrète invalide !";
$errorAccountNewSecretAnswer = "Mauvais format, respectez la condition au-dessus";
$secretQuestion1 = "Qu'est ce que vous vouliez devenir plus grand, lorsque vous étiez enfant ?";
$secretQuestion2 = "Quel est le nom de famille de votre professeur d'enfance préféré ?";
$secretQuestion3 = "Quel est le nom et prénom de votre premier amour ?";
$secretQuestion4 = "Dans quelle ville se sont rencontrés vos parents ?";
$succesChangeNom = "Le changement de votre nom s'est bien produit !";
$succesChangePrenom = "Le changement de votre prénom s'est bien produit !";
$succesChangeUsername = "Le changement de votre nom d'utilisateur s'est bien produit !";
$succesChangePassword = "Le changement de votre mot de passe s'est bien produit !";
$succesChangeSecretQuestion = "Le changement de votre question secrète s'est bien produit !";
$succesChangeSecretAnswer = "Le changement de votre réponse secrète s'est bien produit !";

// Connexion bdd
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=oc_gbaf;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

// vérification et mise en variable données boutons formulaires
if(isset($_POST['nomBtn']) && $_POST['nomBtn'] === $checkNom)
{
	$_SESSION['changeNom'] = true;
	header('Location: account.php');
	exit();
}
elseif(isset($_POST['prenomBtn']) && $_POST['prenomBtn'] === $checkPrenom)
{
	$_SESSION['changePrenom'] = true;
	header('Location: account.php');
	exit();
}
elseif(isset($_POST['usernameBtn']) && $_POST['usernameBtn'] === $checkUsername)
{
	$_SESSION['changeUsername'] = true;
	header('Location: account.php');
	exit();
}
elseif(isset($_POST['passwordBtn']) && $_POST['passwordBtn'] === $checkPassword)
{
	$_SESSION['changePassword'] = true;
	header('Location: account.php');
	exit();
}
elseif(isset($_POST['questionBtn']) && $_POST['questionBtn'] === $checkQuestion)
{
	$_SESSION['changeQuestion'] = true;
	header('Location: account.php');
	exit();
}
elseif(isset($_POST['answerBtn']) && $_POST['answerBtn'] === $checkAnswer)
{
	$_SESSION['changeAnswer'] = true;
	header('Location: account.php');
	exit();
}

// Vérification si champs remplis, puis si nouveau nom bon format, puis si différent de l'ancien
if(isset($_POST['account-nom']))
{
    $_POST['account-nom'] = htmlspecialchars($_POST['account-nom']);
    if(preg_match("#^(?=.{2,20}$)([a-zA-Z]{2,}'?-?[a-zA-Z]{2,}$)#", $_POST['account-nom']))
    {
        $newNom = $_POST['account-nom'];
        if(isset($newNom) && $nom != $_SESSION['nom'])
        {
        	$ins = $bdd->prepare('INSERT INTO account(nom) VALUES (:nom) WHERE id_user = :id_user');
        	$ins->execute(array(
        		'nom' => $newNom,
        		'id_user' => $_SESSION['id_user']));
        	$ins->closeCursor();
        	$_SESSION['nom'] = $newNom;
        	$_SESSION['succesChangeNom'] = $succesChangeNom;
        	unset($_SESSION['changeNom']);
        	header('Location: account.php');
        	exit();
        }
        else
        {
        	$_SESSION['errorAccountNomUsed'] = $errorAccountNomUsed;
        	header('Location: account.php');
        	exit();
        }
    }
    else
    {
        $_SESSION['errorAccountNom'] = $errorAccountNom;
        header('Location: account.php');
		exit();
    }
}

// vérification si champs remplis, si nouveau prénom bon format, puis si différent de l'ancien 
if(isset($_POST['account-prenom']))
{
    $_POST['account-prenom'] = htmlspecialchars($_POST['account-prenom']);

    if(preg_match("#^(?=.{2,20}$)([a-zA-Z]{2,}'?-?[a-zA-Z]{2,}$)#", $_POST['account-prenom']))
    {
        $newPrenom = $_POST['account-prenom'];
        if(isset($newPrenom) && $newPrenom != $_SESSION['prenom'])
        {
        	$ins = $bdd->prepare('INSERT INTO account(prenom) VALUES (:prenom) WHERE id_user = :id_user');
        	$ins->execute(array(
        		'prenom' => $newPrenom,
        		'id_user' => $_SESSION['id_user']));
        	$ins->closeCursor();
        	$_SESSION['prenom'] = $newPrenom;
        	$_SESSION['succesChangePrenom'] = $succesChangePrenom;
        	unset($_SESSION['changePrenom']);
        	header('Location: account.php');
        	exit();
        }
        else
        {
        	$_SESSION['errorAccountPrenomUsed'] = $errorAccountPrenomUsed;
			header('Location: account.php');
			exit();
        }
    }
    else
    {
        $_SESSION['errorAccountPrenom'] = $errorAccountPrenom;
		header('Location: account.php');
		exit();
    }
}

// vérification si champs remplis, puis si nouveau nom d'utilisateur bon format, et enfin si pas déjà utilisé
if(isset($_POST['account-username']))
{
    $_POST['account-username'] = htmlspecialchars($_POST['account-username']);

    if(preg_match("#^(?=.{5,20}$)(?![_-])(?!.*[-_]{2})[a-zA-Z0-9_-]+$#", $_POST['account-username']))
    {
        $newUsername = $_POST['account-username'];
        $req = $bdd->prepare('SELECT username FROM account WHERE username = :username');
        $req->execute(array(
        	'username' => $newUsername));
        $result = $req->fetch();
		if($req->rowCount($result) > 0)
		{
			$_SESSION['errorAccountUsernameUsed'] = $errorAccountUsernameUsed;
			header('Location: account.php');
			exit();
		}
       	else
       	{
       		$req->closeCursor();
        	$upd = $bdd->prepare('UPDATE account SET username = :username WHERE id_user = :id_user');
        	$upd->execute(array(
        		'username' => $newUsername,
        		'id_user' => $_SESSION['id_user']));
        	$upd->closeCursor();
        	$_SESSION['username'] = $newUsername;
        	$_SESSION['succesChangeUsername'] = $succesChangeUsername;
        	unset($_SESSION['changeUsername']);
        	header('Location: account.php');
        	exit();
        }  
    }
    else
    {
        $_SESSION['errorAccountUsername'] = $errorAccountUsername;
        header('Location: account.php');
        exit();
    }
}

/* vérification si champs remplis et si nouveaux mdp sont identiques, puis vérification si ancien mdp identique celui bdd, enfin vérification si nouveau mdp bon format et l'ajoute dans la bdd */

if(isset($_POST['account-password'], $_POST['account-newpassword'], $_POST['account-newpassword2'])
	&& $_POST['account-newpassword'] === $_POST['account-newpassword2'])
{
	$req = $bdd->prepare('SELECT password FROM account WHERE id_user = :id_user');
	$req->execute(array(
		'id_user' => $_SESSION['id_user']));
	$result = $req->fetch();
	$isNewPasswordUsed = password_verify($_POST['account-newpassword'], $result['password']);
	$isPasswordCorrect = password_verify($_POST['account-password'], $result['password']);
	$req->closeCursor();
	if(isset($isPasswordCorrect) && $isPasswordCorrect && !$isNewPasswordUsed)
	{
		if(preg_match("#^(?=.{8,30}$)(?![-_*.])(?!.*[-_*.]{2})[a-zA-Z0-9-_*.]+$#", $_POST['account-newpassword']))
		{
			$_POST['account-newpassword'] = htmlspecialchars($_POST['account-newpassword']);
			$newPassword = password_hash($_POST['account-newpassword'], PASSWORD_DEFAULT);
			$upd = $bdd->prepare('UPDATE account SET password = :password WHERE id_user = :id_user');
			$upd->execute(array(
				'password' => $newPassword,
				'id_user' => $_SESSION['id_user']));
			$upd->closeCursor();
			$_SESSION['succesChangePassword'] = $succesChangePassword;
			unset($_SESSION['changePassword']);
			header('Location: account.php');
			exit();
		}
		else
		{
			$_SESSION['errorAccountNewPassword'] = $errorAccountNewPassword;
			header('Location: account.php');
			exit();
		}
	}
	elseif(!$isPasswordCorrect)
	{
		$_SESSION['errorAccountPassword'] = $errorAccountPassword;
		header('Location: account.php');
		exit();
	}
	elseif($isNewPasswordUsed)
	{
		$_SESSION['errorAccountPasswordUsed'] = $errorAccountPasswordUsed;
		header('Location: account.php');
		exit();
	}
}
elseif(isset($_POST['account-password'], $_POST['account-newpassword'], $_POST['account-newpassword2'])
	&& $_POST['account-newpassword'] != $_POST['account-newpassword2'])
{
	$_SESSION['errorAccountNewPassword2'] = $errorAccountNewPassword2;
	header('Location: account.php');
	exit();
}

// vérification si champs remplis, si nouvelle réponse correcte et si différente de l'ancienne
if(isset($_POST['account-secretanswer'], $_POST['account-newsecretanswer']))
{
    $secretAnswer = htmlspecialchars($_POST['account-secretanswer']);
    $newSecretAnswer = htmlspecialchars($_POST['account-newsecretanswer']);
    $req = $bdd->prepare('SELECT reponse FROM account WHERE id_user = :id_user');
    $req->execute(array(
    	'id_user' => $_SESSION['id_user']));
    $resultat = $req->fetch();
    if($secretAnswer === $resultat['reponse'] && $newSecretAnswer != $resultat['reponse'])
    {
    	if(preg_match("#^(?=.{2,20}$)([a-zA-Z]{2,}'?-?[a-zA-Z]{2,}$)#", $newSecretAnswer))
    	{
    		$req->closeCursor();
    		$upd = $bdd->prepare('UPDATE account SET reponse = :reponse WHERE id_user = :id_user');
    		$upd->execute(array(
    			'reponse' => $newSecretAnswer,
    			'id_user' => $_SESSION['id_user']));
    		$upd->closeCursor();
    		$_SESSION['succesChangeSecretAnswer'] = $succesChangeSecretAnswer;
    		unset($_SESSION['changeAnswer']);
    		header('Location: account.php');
    		exit();
    	}
    	else
    	{
    		$_SESSION['errorAccountNewSecretAnswer'] = $errorAccountNewSecretAnswer;
    		header('Location: account.php');
    		exit();
    	}
    }
    elseif($newSecretAnswer === $resultat['reponse'])
    {
    	$_SESSION['errorAccountSecretAnswerUsed'] = $errorAccountSecretAnswerUsed;
    	header('Location: account.php');
    	exit();
    }
    else
    {
    	$_SESSION['errorAccountSecretAnswer'] = $errorAccountSecretAnswer;
    	header('Location: account.php');
    	exit();

    }
}

// vérification si champs remplis et si la question est correcte, puis si elle est différente de l'ancienne
if(isset($_POST['account-secretquestion']) && $_POST['account-secretquestion'] == $secretQuestion1 || $secretQuestion2 || $secretQuestion3 || $secretQuestion4)
{
    $newQuestion = htmlspecialchars($_POST['account-secretquestion']);
    if($newQuestion != $_SESSION['question'])
    {
    	$upd = $bdd->prepare('UPDATE account SET question = :question WHERE id_user = :id_user');
    	$upd->execute(array(
    		'question' => $newQuestion,
    		'id_user' => $_SESSION['id_user']));
    	$upd->closeCursor();
    	$_SESSION['question'] = $newQuestion;
    	$_SESSION['succesChangeSecretQuestion'] = $succesChangeSecretQuestion;
    	unset($_SESSION['changeQuestion']);
    	header('Location: account.php');
    	exit();
    }
    else
    {
    	$_SESSION['errorAccountSecretQuestionUsed'] = $errorAccountSecretQuestionUsed;
    	header('Location: account.php');
    	exit();
    }
}
elseif(isset($_POST['account-secretquestion']) && $_POST['account-secretquestion'] != $secretQuestion1 || $secretQuestion2 || $secretQuestion3 || $secretQuestion4)
{
	$_SESSION['errorAccountSecretQuestion'] = $errorAccountSecretQuestion;
	header('Location: account.php');
	exit();
}

