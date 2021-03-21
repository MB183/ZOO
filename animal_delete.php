<?php

require_once('animal.php');

$animal = new Animal();
$result = $animal->delete($_GET['id']);
?>

<p><a href="index.php">Revenir</a></p>