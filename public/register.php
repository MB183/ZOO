<?php
session_start();
require_once('../classes/UserLogic.php');
// erreur message
$err = [];

$token = filter_input(INPUT_POST, 'csrf_token');
//jeton n'existe pas ou n'est pas compatible ou alors annuler le traitement
if (!isset($_SESSION['csrf_token']) || $token !==$_SESSION['csrf_token']) {
	exit('
Requête incorrect');
}

unset($_SESSION['csrf_token']);

// validation
if(!$lastname = filter_input(INPUT_POST, 'lastname')){
	$err[] = "Veuillez entrer votre nom de famille.";
}
if(!$firstname = filter_input(INPUT_POST, 'firstname')){
	$err[] = "Veuillez entrer votre prénom.";
}
if(!$birthday = filter_input(INPUT_POST, 'birthday')){
	$err[] = "Veuillez entrer votre date de naissance.";
}
if(!$gender = filter_input(INPUT_POST, 'gender')){
	$err[] = "Veuillez entrer votre genre.";
}
if(!$email = filter_input(INPUT_POST, 'email')){
	$err[] = "Veuillez entrer votre adresse mail.";
}
$password = filter_input(INPUT_POST, 'password');
// Huit caractères au moins, au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial
if (!preg_match("#^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$#", $password)) {
	$err[] = "Veuillez saisir votre mot de passe comme suit.
				-Au moins 8 caractères
				-Au moins une lettre majuscule
				-Au moins une lettre minuscule
				-Au moins 1 chiffre
				-Au moins un caractère spécial";
}

$password_conf = filter_input(INPUT_POST, 'password_conf');
if ($password !== $password_conf) {
	$err[] = "Le mot de passe et le mot de passe de confirmation ne correspondent pas.";
}


if(!$profession = filter_input(INPUT_POST, 'profession')){
	$err[] = "Veuillez sélectionner votre profession.";
}


if(count($err) === 0){
	// sans erreur = enregistrer un(e) employé(e)s
	$hasCreated = UserLogic::createUser($_POST);

	if(!$hasCreated){
		$err[] = "L'inscription a échoué.";
	}
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
<!--	<link rel="stylesheet" type="text/css" href="styles.css"> -->
	<title>Inscription réussie</title>
</head>
<body>
<?php if(count($err) > 0) : ?>
	<?php foreach($err as $e) : ?>
		<p><?php echo $e ?></p>
	<?php endforeach?>
<?php else : ?>
	<p>Votre inscription est réussi.</p>
<?php endif ?>
	<a href="signup_form.php">Revenir</a>

</body>
</html>