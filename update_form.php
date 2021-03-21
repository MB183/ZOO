<?php

require_once('animal.php');

$animal = new Animal();
$result = $animal->getAnimal($_GET['id']);
$roomData = $animal->getRoomList();


$id = $result['ID'];
$name = $result['NOM'];
$communName = $result['NOM_COMMUN'];
$sexe = $result['Sexe'];
$age = (int)$result['AGE'];
$dateOfBirth = $result['DATE_DE_NAISSANCE'];
$dateOfDeath = $result['DATE_DE_DECES'];
$roomName = $result['NOM_SALLE'];
$roomId = $result['ID_LIEU'];
$family = $result['NOM_FAMILLE'];
$binominal = $result['NOM_SCIENTIFIQUE'];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>AnimalForm</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<h2>Formulaire modification d'animal</h2>
	<form action="animal_update.php" method="POST">
		<input type="hidden" name="id" value="<?php echo $id ?>">
		<p>Nom: </p>
		<input type="text" name="nom" value="<?php echo $name ?>">

		<p>Nom commun: </p>
		<?php echo $communName ?>

		<p>Sexe: </p>
		<?php echo $sexe ?>
	
		<p>Age: </p>
		<?php echo $age ?>

		<p>Date de naissance: </p>
		<?php echo $dateOfBirth ?>

		<p>Date de décès: </p>
		<?php echo ($dateOfDeath == null ? '<input type="date" name="date_deces">' : $dateOfDeath); ?>

		<p>Salle: </p>
		<select name="nom de salle" id="nom_de_salle">
			<option value="<?php echo $roomId ?>"><?php if($roomName != null) echo $roomName ?></option>
			<option></option>

			<?php foreach($roomData as $column): ?>
				<option value="<?php echo $column['ID_L'] ?>"><?php echo $column['NOM_SALLE'] ?></option>	
			<?php endforeach; ?>
		</select>

		<p>Nom de famille: </p>
		<?php echo $family ?>

		<p>Nom de scientifique: </p>
		<?php echo $binominal ?>

		<br>
		<br>
		<input type="submit" value="Envoyer">
		
	</form>
	<p><a href="index.php">Revenir</a></p>

</body>
</html>
