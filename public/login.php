<?php
session_start();

require_once('../classes/UserLogic.php');



// erreur message
$err = [];

// validation

if(!$email = filter_input(INPUT_POST, 'email')){
	$err['email'] = "Veuillez entrer votre adresse mail.";
}
if(!$password = filter_input(INPUT_POST, 'password')
){
	$err['password'] = "Veuillez entrer votre mots de passe.";
}

//S'il y a au moins un erreur revenir login
if(count($err) > 0){
	//traitement login erreur
	$_SESSION = $err;
	header('Location: login_form.php');
	return;
}
// Quand c'est réussi login
$result = UserLogic::login($email, $password);
//Qunad c'est raté login
if(!$result){
	header('Location: login_form.php');
	return;
}



?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
<!--	<link rel="stylesheet" type="text/css" href="styles.css"> -->
 <!--ログイン完了-->
	<title>Connexion terminée</title>

</head>
<body>
	<h2>Connexion terminée</h2>
	<p>Vous êtes connecté.</p>

	<a href="./mypage.php">Aller vers ma page</a>

</body>
</html>

<!--
///////////////////////////////////////////////
// 自分でつくったぶぶん　あとで変える

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="home.css">
	<title>ZOO</title>
</head>
<body>
	<h1>HOME</h1>

	<div>icon d'employe</div>
	<h2>Bienvenu sur le logiciel de Zoo</h2><br>

	<div>side bar</div>
	<ul>
		<a href="animal_list.php"><li>Animaux</li></a>
		<a href="employee_list.php"><li>Employés</li></a>
		<a href="treatment_list.php"><li>Soins</li></a>
	</ul>

</body>
</html>
-->

