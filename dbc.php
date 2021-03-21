<?php
require_once('env.php');

Class Dbc
{

	protected $table_name;

	//conncecter aux base de données
	protected function dbConnect(){
		$host = DB_HOST;
		$dbname =DB_NAME;		
		$user = DB_USER;
		$pass = DB_PASS;
		$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

		try{
			$dbh = new PDO($dsn, $user, $pass, [
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false,
			]);
		} catch(PDOException $e){
			echo "La connexion a échoué".$e->getMessage();
			exit();
		};

		return $dbh;
	}

	//recupérer le data
	public function getAllAnimal(){
		//echo "Connexion réussie";
		$dbh = $this->dbConnect();
		//$sql = "SELECT * FROM animaux";
		$sql = "
			select a.ID, a.NOM, e.NOM_COMMUN, a.Sexe, a.AGE, a.DATE_DE_DECES, l.NOM_SALLE
			from animaux as a
			inner join espece as e
			on a.ID_ESPECE =  e.ID_E
			inner join lieux as l
			on a.ID_LIEU = l.ID_L
			where SUPPRIMER = 0";
		$stmt = $dbh->query($sql);
		$result = $stmt ->fetchAll(PDO::FETCH_ASSOC);
		//var_dump($result);
		return $result;
		$dbh = null;
	}

	//verifier la connection 
	//var_dump($dbh);

	public function getAnimal($id){
		if(empty($id)){
			exit("L'identifiant n'est pas valide."
			);
		}

		$dbh = $this->dbConnect();

		$stmt = $dbh->prepare('SELECT * FROM animaux 
								inner join espece on animaux.ID_ESPECE = espece.ID_E
								inner join lieux on animaux.ID_LIEU = lieux.ID_L 
								inner join famille on animaux.ID_FAMILLE = famille.ID_F
								where id = :id');
		$stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);

		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		//var_dump($result);

		if (!$result) {
			exit("Cet animal n'existe pas.");
			}
		return $result;
		}

		public function getRoomList(){
			$dbh = $this->dbConnect();

			$sql = "SELECT * from lieux";
			$stmt = $dbh->query($sql);
			$result = $stmt ->fetchAll(PDO::FETCH_ASSOC);
		
			return $result;
			$dbh = null;
		}

		public function getFamilyName(){
			$dbh = $this->dbConnect();

			$sql = "SELECT * from famille";
			$stmt = $dbh->query($sql);
			$result = $stmt ->fetchAll(PDO::FETCH_ASSOC);
		
			return $result;
			$dbh = null;
		}

		public function getEspeceName(){
			$dbh = $this->dbConnect();

			$sql = "SELECT * from espece";
			$stmt = $dbh->query($sql);
			$result = $stmt ->fetchAll(PDO::FETCH_ASSOC);

			return $result;
			$dbh = null;
		}

}

?>
