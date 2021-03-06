<?php
session_start();
require_once('classes/UserLogic.php');
require_once('functions.php');

require_once('dbc.php');

//juger si on est login sinon renvoyer vers créer un compte
$result = UserLogic::checkLogin();

if (!$result) {
	$_SESSION['login_err'] = "Veuillez enregistrer l'utilisateur et vous connecter.";
	header('Location: public/signup_form.php');
	return;
}

	$login_user = $_SESSION['login_user'];

$dbc = new Dbc();
$roomData = $dbc->getRoomList();
$familyData = $dbc->getFamilyName();
$especeData = $dbc->getEspeceName();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>AnimalForm</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<h2>Formulaire d'animal</h2>
	<form action="animal_create.php" method="POST">
		<p>Nom: </p>
		<input type="text" name="nom">

		<p>Nom commun: </p>
		<select name="nom commun" id="nom_commun">
			<option></option>	
			<?php foreach($especeData as $column): ?>
				<option value="<?php echo $column['ID_E'] ?>"><?php echo $column['NOM_COMMUN'] ?></option>	
			<?php endforeach; ?>
		</select>

		<p>Sexe: </p>
		<label><input type="radio" name="radio_sexe" value="F">Femelle</label>
		<label><input type="radio" name="radio_sexe" value="M">Mâle</label>
		

		<p>Age: </p>
		<input type="number" name="age">

		<p>Date de naissance: </p>
		<input type="date" name="date_naissance">

		<p>Date de décès: </p>
		<input type="date" name="date_deces">

		<p>Salle: </p>
		<select name="nom de salle" id="nom_de_salle">
			<option></option>	
			<?php foreach($roomData as $column): ?>
				<option value="<?php echo $column['ID_L'] ?>"><?php echo $column['NOM_SALLE'] ?></option>	
			<?php endforeach; ?>
		</select>

		<p>Nom de famille: </p>
		<select name="nom de famille" id="nom_de_famille">
			<option></option>
			<?php foreach($familyData as $column): ?>
				<option value="<?php echo $column['ID_F'] ?>"><?php echo $column['NOM_FAMILLE'] ?></option>
			<?php endforeach; ?>
		</select>

		<br>
		<br>
		<input type="submit" value="Envoyer">
		
	</form>
	<p><a href="animal_list.php">Revenir</a></p>

</body>
</html>
