<?php
session_start();
require_once('../dbc_employee.php');
require_once('../functions.php');



?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<title>Créer utilisateur</title>
</head>
<body>
	<h2>Formulaire d'utilisateur</h2>
	<form action="register.php" method="POST">
		<p>
			<label for="lastname">Nom: </label>	
			<input type="text" name="lastname">
		</p>
		<p>
			<label for="firstname">Prénom: </label>	
			<input type="text" name="firstname">
		</p>
		<p>
			<label for="birthday">Date de naissance: </label>	
			<input type="date" name="birthday">
		</p>
		<p>
			<label for="female" id="female">Femme</label>	
			<input type="radio" name="gender" value="F">
			<label for="male" id="male">Homme</label>	
			<input type="radio" name="gender" value="H">
			<label for="other" id="other">Neutre</label>	
			<input type="radio" name="gender" value="X">
		</p>
		<p>
			<label for="email">Email: </label>	
			<input type="email" name="email">
		</p>
		<p>	Attention!<br>	
				-Au moins 8 caractères<br>
				-Au moins une lettre majuscule<br>
				-Au moins une lettre minuscule<br>
				-Au moins 1 chiffre<br>
				-Au moins un caractère spécial</p>
		<p>
			<label for="password">Mot de passe: </label>	
			<input type="password" name="password">
		</p>
		<p>
			<label for="password_conf">Confirmation du mot de passe: </label>	
			<input type="password" name="password_conf">
		</p>
		<p>Rôle: </p>
		<select name="profession" id="profession">
			<option></option>
			<?php foreach($professionData as $column): ?>
			<option value="<?php echo $column['ID'] ?>"><?php echo $column['NOM'] ?></option>
			<?php endforeach; ?>
		</select>

		<p>
			<input type="hidden" name="csrf_token" 
			value="<?php echo h(setToken()); ?>">
		</p>
		<p>
			<input type="submit" value="Inscription">
		</p>

		

		
	</form>

</body>
</html>