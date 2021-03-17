<?php 

require_once('dbc.php');

//$id = $_GET['id'];
//echo $id;
use Animal\Dbc;

$result = Dbc\getAnimal($_GET['id']);

/*
function dbConnect(){
	$dsn = "mysql:host=localhost;dbname=zoo_project;charset=utf8";
	$user = "mayuko";
	$pass = "x13MayB8";

	try{
		$dbh = new PDO($dsn, $user, $pass, [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_EMULATE_PREPARES => false,
		]);
	} catch(PDOException $e){
		echo "La connexion a échoué".$e->getMessage();
		exit();
	};

	return $dbh;
}
*/




?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Détail animal</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<h2>Détail animal</h2>
	<h3>Nom: <?php echo $result['NOM'] ?></h3>
	<p>Nom commun: <?php echo $result['NOM_COMMUN'] ?></p>
	<p>Sexe: <?php echo $result['Sexe'] ?></p>
	<p>Age: <?php echo $result['AGE'] ?></p>
	<p>Date de naissance: <?php echo $result['DATE_DE_NAISSANCE'] ?></p>

	<?php if ($result['DATE_DE_DECES'] == null) {
		
	} else echo '<p>Date de décès: '. $result['DATE_DE_DECES'] . '</p>';
	?>
	<p>Salle: <?php echo $result['NOM_SALLE'] ?></p>
	<p>Nom de famille: <?php echo $result['NOM_FAMILLE'] ?></p>
	<p>Nom scientifique: <?php echo $result['NOM_SCIENTIFIQUE'] ?></p>
</body>
</html>