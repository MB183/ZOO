<?php
require_once('env.php');


function connect(){
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


function getProfessionList(){
	
	$pdo = connect();
	$sql = "SELECT * from postes";
	$stmt = $pdo->query($sql);
	$result = $stmt ->fetchAll(PDO::FETCH_ASSOC);

	return $result;
	$pdo = null;
}

$professionData =getProfessionList();

?>
