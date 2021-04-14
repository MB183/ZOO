<?php
require_once('env.php');

Class Dbc_employee
{
	public function connect(){
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

	public function getALLEmployee(){
		$pdo = $this->connect();
		$sql = "SELECT e.ID, e.NOM, e.PRENOM, e.DATE_DE_NAISSANCE, e.SEXE, e.EMAIL, p.NOM_POSTE 
				from employes as e
				inner join postes as p
				on e.ID_POSTE = p.ID_P";
		$stmt = $pdo->query($sql);
		$result = $stmt ->fetchAll(PDO::FETCH_ASSOC);

		return $result;
		$pdo = null;
	}

	public function getProfessionList(){
	
		$pdo = $this->connect();
		$sql = "SELECT * from postes";
		$stmt = $pdo->query($sql);
		$result = $stmt ->fetchAll(PDO::FETCH_ASSOC);

		return $result;
		$pdo = null;
	}



}


?>
