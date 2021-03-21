<?php
require_once('dbc.php');

Class Animal extends Dbc
{
	protected $table_name = 'animal';

	public function animalCreate($animals){
		$sql = 'INSERT INTO
			animaux(ID, NOM, DATE_DE_NAISSANCE, DATE_DE_DECES, AGE, Sexe, ID_FAMILLE, ID_ESPECE, ID_LIEU)
		VALUES
			(:ID, :NOM, :DATE_DE_NAISSANCE, :DATE_DE_DECES, :AGE, :Sexe, :ID_FAMILLE, :ID_ESPECE, :ID_LIEU)';

		$dbh = $this->dbConnect();
		$dbh->beginTransaction();

		try {
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(':NOM', $animals['nom'], PDO::PARAM_STR);
			$stmt->bindValue(':DATE_DE_NAISSANCE', $animals['date_naissance'], PDO::PARAM_STR);
			$stmt->bindValue(':DATE_DE_DECES', $animals['date_deces'],  $animals['date_deces'] == null ? PDO::PARAM_NULL : PDO::PARAM_STR);
			$stmt->bindValue(':AGE', $animals['age'], PDO::PARAM_INT);
			$stmt->bindValue(':Sexe', $animals['radio_sexe'], PDO::PARAM_STR);
			$stmt->bindValue(':ID_FAMILLE', $animals['nom_de_famille'], PDO::PARAM_INT);
			$stmt->bindValue(':ID_ESPECE', $animals['nom_commun'], PDO::PARAM_INT);
			$stmt->bindValue(':ID_LIEU', $animals['nom_de_salle'], PDO::PARAM_INT);
			$stmt->execute();
			$dbh->commit();
			echo 'Un nouvel animal a été ajouté.';
		} catch(PDOExeption $e){
			$dbh->rollBack();
			exit($e);
		}
	}

	public function animalUpdate($animals){
		var_dump($animals);
		$sql = "UPDATE animaux SET
					NOM = :NOM, DATE_DE_DECES = :DATE_DE_DECES, ID_LIEU = :ID_LIEU
		WHERE
			id = :ID";

		$dbh = $this->dbConnect();
		$dbh->beginTransaction();

		try {
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(':NOM', $animals['nom'], PDO::PARAM_STR);
			$stmt->bindValue(':DATE_DE_DECES', $animals['date_deces'], $animals['date_deces'] == '' ? PDO::PARAM_NULL : PDO::PARAM_STR);
			$stmt->bindValue(':ID_LIEU', $animals['nom_de_salle'], PDO::PARAM_INT);
			$stmt->bindValue(':ID', $animals['id'], PDO::PARAM_INT);
			$stmt->execute();
			$dbh->commit();
			echo "Informations mises à jour sur l'animal.";
		} catch(PDOExeption $e){
			$dbh->rollBack();
			exit($e);
		}
	}

	//Validation d'animal
	public function animalValidate($animals){
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
	}

		public function delete($id){

				$sql = "UPDATE animaux SET
						SUPPRIMER = 1
				WHERE
					id = :ID";

				$dbh = $this->dbConnect();
				$dbh->beginTransaction();

				try {
					$stmt = $dbh->prepare($sql);
					$stmt->bindValue(':ID', $id, PDO::PARAM_INT);
					//$stmt->bindValue(':SUPPRIMER', $id['SUPPRIMER'], PDO::PARAM_INT);
					$stmt->execute();
					$dbh->commit();
					echo "L'animal est bien supprimé.";
				} catch(PDOExeption $e){
					$dbh->rollBack();
					exit($e);
				}	
		}
}
?>