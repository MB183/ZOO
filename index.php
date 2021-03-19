<?php 

require_once('dbc.php');
//Afficher le data que j'ai récupéré
$animalData = Animal\Dbc\getAllAnimal();

?>


<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">

	<title>Liste des animaux</title>
</head>
<body>
	<h2>Liste des animaux</h2>
	<p><a href="form.php">Nouvel animal</a></p>
	<table>
		<tr>
			<th>NOM</th>
			<th>Nom commun</th>
			<th>Sexe</th>
			<th>Age</th>
			<th>Date de décès</th>
			<th>Lieu</th>
		</tr>
		<?php foreach ($animalData as $column): ?> 
		<tr>
			<td><?php echo $column['NOM'] ?></td>
			<td><?php echo $column['NOM_COMMUN'] ?></td>
			<td><?php echo $column['Sexe'] ?></td>
			<td><?php echo $column['AGE'] ?></td>
			<td><?php echo $column['DATE_DE_DECES'] ?></td>
			<td><?php echo $column['NOM_SALLE'] ?></td>
			<td><a href="detail.php?id=<?php echo $column['ID'] ?>">Détail</a></td>
		</tr>
		<?php endforeach; ?>
	</table>

</body>
</html>