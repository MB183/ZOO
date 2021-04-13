<?php
session_start();
require_once('../classes/UserLogic.php');

if (!$logout= filter_input(INPUT_POST, 'logout')) {
	exit('Requête incorrect');
}

//juger si on est login si session est terminé alerter 'Connectez vous'
$result = UserLogic::checkLogin();

if (!$result) {
	exit("Votre session a été coupé donc reconnectez-vous s'il vous plaît.");
}
// faire logout
UserLogic::logout();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
<!--	<link rel="stylesheet" type="text/css" href="styles.css"> -->
	<title>Logout</title>
</head>
<body>
	<h2>Logout terminée</h2>
	<p>Vous êtes déconnecté.</p>
	<a href="login_form.php">Vers login page</a>
</body>
</html>