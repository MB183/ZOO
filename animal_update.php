<?php 
require_once('animal.php');
//ini_set('display_errors', "On");

$animals = $_POST;

$animal = new Animal();

	if (empty($animals['nom'])) {
		exit("Entrez le nom d'animal");
	}

	if (mb_strlen($animals['nom']) > 255){
		exit("Le caractère d'entrée dépasse 255 caractères");
	}
	
	if (empty($animals['nom_de_salle'])) {
		exit("Sélectionnez le nom de salle d'animal");
	}
		
$animal->animalUpdate($animals);

?>

<p><a href="index.php">Revenir</a></p>