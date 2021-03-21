<?php
require_once('animal.php');
//ini_set('display_errors', "On");

$animals = $_POST;
//var_dump($animals);

$animal = new Animal();
$animal->animalValidate($animals);
$animal->animalCreate($animals);
?>

<p><a href="index.php">Revenir</a></p>