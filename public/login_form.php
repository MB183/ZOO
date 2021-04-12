<?php
require_once('../dbc_employee.php');

session_start();

$err = $_SESSION;
//$professionData = $pdo->getProfessionList();
// effacer la session
$_SESSION = array(); 
session_destroy();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<!--<link rel="stylesheet" type="text/css" href="styles.css">-->
	<title>Login</title>
</head>
<body>
	<h2>Formulaire de connexion</h2>
		<?php if(isset($err['msg'])) : ?>
			<p><?php echo $err['msg']; ?></p>
		<?php endif; ?>
	<form action="login.php" method="POST">		
		<p>
			<label for="email">Email: </label>	
			<input type="email" name="email">
			<?php if(isset($err['email'])) : ?>
				<p><?php echo $err['email']; ?></p>
			<?php endif; ?>
		</p>
		<p>
			<label for="password">Mot de passe: </label>	
			<input type="password" name="password">
			<?php if(isset($err['password'])) : ?>
				<p><?php echo $err['password']; ?></p>
			<?php endif; ?>
		</p>		
		<p>
			<input type="submit" value="Login">
		</p>	
	</form>
	<a href="signup_form.php">Créer un compte</a>

</body>
</html>