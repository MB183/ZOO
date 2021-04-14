<?php 
require_once('env.php');

Class Dbc_treatment
{
	public function connectTreatment(){
		$host = DB_HOST;
		$dbname =DB_NAME;		
		$user = DB_USER;
		$pass = DB_PASS;
		$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

		try{
			$pdo = new PDO($dsn, $user, $pass, [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
			]);
			return $pdo;
			//echo "La connexion est réussite";
		} catch(PDOException $e){
			echo "La connexion a échoué".$e->getMessage();
			exit();
		}
		return $pdo;
	}

	public function getALLMedicalTreatment(){
		$pdo = $this->connectTreatment();
		$sql = "SELECT s.ID, ts.NOM as TYPE_NOM_SOIN, s.DATE, e.NOM as NOM_EPLOYEE, postes.NOM_POSTE, a.NOM as NOM_ANIMAL, espece.NOM_COMMUN, l.NOM_SALLE 
			FROM soins_medico as s 
			INNER JOIN type_soins as ts ON s.ID_TYPE_SOIN = ts.ID 
			INNER JOIN employes as e ON s.ID_EMPLOYE = e.ID 
            LEFT OUTER JOIN postes ON e.ID_POSTE = postes.ID_P
			INNER JOIN animaux as a ON s.ID_ANIMAL = a.ID 
            LEFT OUTER JOIN espece ON a.ID_ESPECE = espece.ID_E
			INNER JOIN lieux as l ON s.ID_LIEU = l.ID_L";
		$stmt = $pdo->query($sql);
		$result = $stmt ->fetchAll(PDO::FETCH_ASSOC);

		return $result;
		$pdo = null;
	}

	public function getALLDailyTreatment(){
		$pdo = $this->connectTreatment();
		$sql = "SELECT sq.ID, tq.NOM as TYPE_NOM_QUOTI, sq.DATE, e.NOM as NOM_EMPLOYEE, p.NOM_POSTE, lieux.NOM_SALLE
			FROM soins_quoti as sq 
			INNER JOIN type_quoti as tq ON sq.ID_TYPE_QUOTI = tq.ID
			INNER JOIN employes as e ON sq.ID_EMPLOYE = e.ID
			LEFT OUTER JOIN postes as p ON e.ID_POSTE = p.ID_P
			INNER JOIN lieux ON sq.ID_LIEU = lieux.ID_L";
		$stmt = $pdo->query($sql);
		$result = $stmt ->fetchAll(PDO::FETCH_ASSOC);

		return $result;
		$pdo = null;
	}
}

?>