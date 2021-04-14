<?php
session_start();
require_once('classes/UserLogic.php');
require_once('functions.php');


require_once('employee.php');

//juger si on est login sinon renvoyer vers créer un compte
$result = UserLogic::checkLogin();

if (!$result) {
	$_SESSION['login_err'] = "Veuillez enregistrer l'utilisateur et vous connecter.";
	header('Location: public/signup_form.php');
	return;
}

	$login_user = $_SESSION['login_user'];

	$employee = new Employee();
	$employeData = $employee->getALLEmployee();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">

	<title>Liste des employés</title>
</head>
<body>
	<h2>Liste des employé</h2>
	<a href="index.php">Revenir</a>

	<table>
		<tr>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Date de naissance</th>
			<th>Gender</th>
			<th>Email</th>
			<th>Poste</th>
		</tr>

		<?php foreach ($employeData as $column): ?> 		
		<tr>
			<td><?php echo h($column['NOM']) ?></td>
			<td><?php echo h($column['PRENOM']) ?></td>
			<td><?php echo h($column['DATE_DE_NAISSANCE']) ?></td>
			<td><?php echo h($column['SEXE']) ?></td>
			<td><?php echo h($column['EMAIL']) ?></td>
			<td><?php echo h($column['NOM_POSTE']) ?></td>
		</tr>
		<?php endforeach; ?>
	</table>	
</body>
</html>

