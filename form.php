<?php
require_once('dbc.php');
$roomData = Animal\Dbc\getRoomList();
$familyData = Animal\Dbc\getFamilyName();

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
		<input type="text" name="nom commun">

		<p>Sexe: </p>
		<label><input type="radio" name="radio_age" value="F">Femelle</label>
		<label><input type="radio" name="radio_age" value="M">Mâle</label>
		

		<p>Age: </p>
		<input type="number" name="age">

		<p>Date de naissance: </p>
		<input type="date" name="date_naissance">

		<p>Date de décès: </p>
		<input type="date" name="date_deces">

		<p>Salle: </p>
		<select name="Nom de salle" id="nom_de_salle">
			<option></option>	
			<?php foreach($roomData as $column): ?>
				<option value="<?php echo $column['ID_L'] ?>"><?php echo $column['NOM_SALLE'] ?></option>	
			<?php endforeach; ?>
		</select>

		<p>Nom de famille: </p>
		<select name="Nom de famille" id="nom_de_famille">
			<option></option>
			<?php foreach($familyData as $column): ?>
				<option value="<?php echo $column['ID_F'] ?>"><?php echo $column['NOM_FAMILLE'] ?></option>
			<?php endforeach; ?>
		</select>

		<p>Nom scientifique: </p>
		<input type="text" name="nom_scientifique">
		<br>
		<input type="submit" value="Envoyer">
		
	</form>

</body>
</html>
