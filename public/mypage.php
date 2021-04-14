<?php
session_start();
require_once('../classes/UserLogic.php');
require_once('../functions.php');

//juger si on est login sinon renvoyer vers créer un compte
$result = UserLogic::checkLogin();

if (!$result) {
	$_SESSION['login_err'] = "Veuillez enregistrer l'utilisateur et vous connecter.";
	header('Location: signup_form.php');
	return;
}

	$login_user = $_SESSION['login_user'];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
<!--	<link rel="stylesheet" type="text/css" href="styles.css"> -->
	<title>Ma page</title>
</head>
<body>
	<h3><?php echo h($login_user['PRENOM'].' '.$login_user['NOM']) ?></h3>
	<p>Nom:<?php echo h($login_user['NOM']) ?></p>
	<p>Prénom:<?php echo h($login_user['PRENOM']) ?></p>
	<p>Date de naissance:<?php echo h($login_user['DATE_DE_NAISSANCE']) ?></p>
	<p>Genre:<?php echo h($login_user['SEXE']) ?></p>
	<p>Email:<?php echo h($login_user['EMAIL']) ?></p>
	<p>Poste:<?php echo h($login_user['NOM_POSTE']) ?></p>
	<a href="../index.php">Revenir</a>
	<form action="logout.php" method="POST">
		<input type="submit" name="logout" value="Se déconnecter">
	</form>
</body>
</html>