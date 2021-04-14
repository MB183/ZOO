<?php
session_start();
require_once('classes/UserLogic.php');
require_once('functions.php');

require_once('treatment.php');

//juger si on est login sinon renvoyer vers créer un compte
$result = UserLogic::checkLogin();

if (!$result) {
	$_SESSION['login_err'] = "Veuillez enregistrer l'utilisateur et vous connecter.";
	header('Location: public/signup_form.php');
	return;
}

	$login_user = $_SESSION['login_user'];

	$treatment = new Treatment();
	$treatmentMedicalData = $treatment->getALLMedicalTreatment();
	$treatmentDailyData = $treatment->getALLDailyTreatment();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">

	<title>Liste des soins</title>
</head>
<body>
	<h2>Liste des soins</h2>
	<a href="index.php">Revenir</a>

	<p><a href="">Nouvel soin</a></p>

	<p>Soins médicaux</p>
	<table>
		<tr>
			<th>Type</th>
			<th>Date</th>
			<th>Nom d'employé</th>
			<th>Poste d'employé</th>
			<th>Nom d'animal</th>
			<th>Nom commun</th>
			<th>Lieu</th>
		</tr>
		<?php foreach ($treatmentMedicalData as $column): ?>
		<tr>
			<td><?php echo h($column['TYPE_NOM_SOIN']) ?></td>
			<td><?php echo h($column['DATE']) ?></td>
			<td><?php echo h($column['NOM_EPLOYEE']) ?></td>
			    <td><?php echo h($column['NOM_POSTE']) ?></td>
			<td><?php echo h($column['NOM_ANIMAL']) ?></td>
				<td><?php echo h($column['NOM_COMMUN']) ?></td>
			<td><?php echo h($column['NOM_SALLE']) ?></td>
		</tr>
		<?php endforeach; ?>
	</table>

	<p>Soins quotidiens</p>
	<table>
		<tr>
			<th>Type</th>
			<th>Date</th>
			<th>Nom d'employé</th>
			<th>Poste d'employé</th>
			<th>Lieu</th>
		</tr>
		<?php foreach ($treatmentDailyData as $column): ?>
		<tr>
			<td><?php echo h($column['TYPE_NOM_QUOTI']) ?></td>
			<td><?php echo h($column['DATE']) ?></td>
			<td><?php echo h($column['NOM_EMPLOYEE']) ?></td>
			<td><?php echo h($column['NOM_POSTE']) ?></td>
			<td><?php echo h($column['NOM_SALLE']) ?></td>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>	


<!-- 
<?php foreach ($animalData as $column): ?> 
<td><a href="detail.php?id=<?php echo $column['ID'] ?>">Détail</a></td>
			<td><a href="update_form.php?id=<?php echo $column['ID'] ?>">Éditer</a></td>
			<td><a href="animal_delete.php?id=<?php echo $column['ID'] ?>">Effacer</a>
				<?php endforeach; ?>
-->

</body>
</html>