<?php
require_once('dbc.php');
use Animal\Dbc;

$animals = $_POST;
//var_dump($animals);

if (empty($animals['nom'])) {
	exit("Entrez le nom d'animal");
}

if (mb_strlen($animals['nom']) > 255){
	exit("Le caractère d'entrée dépasse 255 caractères");
}
if (empty($animals['nom_commun'])) {
	exit("Entrez le nom commun d'animal");
}

if (empty($animals['radio_sexe'])) {
	exit("Sélectionnez le sexe d'animal");
}

if (empty($animals['age'])) {
	exit("Entrez l'age' d'animal");
}
if (empty($animals['date_naissance'])) {
	exit("Sélectionnez la date de naissance d'animal");
}
if (empty($animals['nom_de_salle'])) {
	exit("Sélectionnez le nom de salle d'animal");
}
if (empty($animals['nom_de_famille'])) {
	exit("Sélectionnez le nom de famille d'animal");
}

$sql = 'INSERT INTO
			animaux(NOM, DATE_DE_NAISSANCE, DATE_DE_DECES, AGE, Sexe, ID_FAMILLE, ID_ESPECE, ID_LIEU)
		VALUES
			(:NOM, :DATE_DE_NAISSANCE, :DATE_DE_DECES, :AGE, :Sexe, :ID_FAMILLE, :ID_ESPECE, :ID_LIEU)';

$dbh = Dbc\dbConnect();
$dbh->beginTransaction();

try {
	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(':NOM', $animals['nom'], \PDO::PARAM_STR);
	$stmt->bindValue(':DATE_DE_NAISSANCE', $animals['date_naissance'], \PDO::PARAM_STR);
	$stmt->bindValue(':DATE_DE_DECES', $animals['date_deces'],  $animals['date_deces'] == null ? \PDO::PARAM_NULL : \PDO::PARAM_STR);
	$stmt->bindValue(':AGE', $animals['age'], \PDO::PARAM_INT);
	$stmt->bindValue(':Sexe', $animals['radio_sexe'], \PDO::PARAM_STR);
	$stmt->bindValue(':ID_FAMILLE', $animals['nom_de_famille'], \PDO::PARAM_INT);
	$stmt->bindValue(':ID_ESPECE', $animals['nom_commun'], \PDO::PARAM_INT);
	$stmt->bindValue(':ID_LIEU', $animals['nom_de_salle'], \PDO::PARAM_INT);
	$stmt->execute();
	$dbh->commit();
	echo 'Un nouvel animal a été ajouté.';
} catch(PDOExeption $e){
	$dbh->rollBack();
	exit($e);
}

?>