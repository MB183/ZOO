<?php

require_once('animal.php');

$animal = new Animal();
$result = $animal->delete($_GET['id']);
?>

<p><a href="animal_list.php">Revenir</a></p>