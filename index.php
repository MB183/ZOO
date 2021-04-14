<?php

session_start();
require_once('classes/UserLogic.php');
require_once('functions.php');


//juger si on est login sinon renvoyer vers créer un compte
$result = UserLogic::checkLogin();

if (!$result) {
	$_SESSION['login_err'] = "Veuillez enregistrer l'utilisateur et vous connecter.";
	header('Location: public/signup_form.php');
	return;
}

	$login_user = $_SESSION['login_user'];
	
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="index.css">
	<title>ZOO</title>
</head>
<body>
	<h1>HOME</h1>

	<div>icon d'employe</div><a href="public/mypage.php">Ma page</a>
	<h2>Bienvenu sur le logiciel de Zoo</h2><br>

	<ul>
		<a href="animal_list.php"><li>Animaux</li></a>
		<a href="employee_list.php"><li>Employés</li></a>
		<a href="treatment_list.php"><li>Soins</li></a>
	</ul>

</body>
</html>
