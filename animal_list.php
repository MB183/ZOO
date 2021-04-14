<?php 
session_start();
require_once('classes/UserLogic.php');
require_once('functions.php');

require_once('animal.php');
ini_set('display_errors', "On");

//juger si on est login sinon renvoyer vers créer un compte
$result = UserLogic::checkLogin();

if (!$result) {
	$_SESSION['login_err'] = "Veuillez enregistrer l'utilisateur et vous connecter.";
	header('Location: public/signup_form.php');
	return;
}

	$login_user = $_SESSION['login_user'];


$animal = new Animal();
//var_dump($dbc);

//Afficher le data que j'ai récupéré
$animalData = $animal->getAllAnimal();

// function h($s){
// 	return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
// }

?>


<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">

	<title>Liste des animaux</title>
</head>
<body>
	<h2>Liste des animaux</h2>
	<a href="index.php">Revenir</a>
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
			<td><?php echo h($column['NOM']) ?></td>
			<td><?php echo h($column['NOM_COMMUN']) ?></td>
			<td><?php echo h($column['Sexe']) ?></td>
			<td><?php echo h($column['AGE']) ?></td>
			<td><?php echo h($column['DATE_DE_DECES']) ?></td>
			<td><?php echo h($column['NOM_SALLE']) ?></td>
			<td><a href="detail.php?id=<?php echo $column['ID'] ?>">Détail</a></td>
			<td><a href="update_form.php?id=<?php echo $column['ID'] ?>">Éditer</a></td>
			<td><a href="animal_delete.php?id=<?php echo $column['ID'] ?>">Effacer</a></td>
		</tr>
		<?php endforeach; ?>
	</table>

</body>
</html>