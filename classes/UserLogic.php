<?php 

require_once ("C:/wamp64/www/ZOO/dbc_employee.php");

class UserLogic{
	/**
	*Enregistrer employee
	*@param array $userData
	*@return bool $result
	*/
	public static function createUser($userData){
		$result = false;
		$sql = "INSERT INTO employes (NOM, PRENOM, DATE_DE_NAISSANCE, SEXE,
				EMAIL, PASSWORD, ID_POSTE) VALUES (?, ?, ?, ?, ?, ?, ?)";

		// data d'employee dans un array
		$arr = [];
		$arr[] = $userData['lastname'];
		$arr[] = $userData['firstname'];
		$arr[] = $userData['birthday'];
		$arr[] = $userData['gender'];
		$arr[] = $userData['email'];
		$arr[] = password_hash($userData['password'], PASSWORD_DEFAULT);
		$arr[] = $userData['profession'];

		try{
			$dbc_e = new Dbc_employee();
			$stmt = $dbc_e->connect()->prepare($sql);
			$result = $stmt->execute($arr);
			return $result;
		}	catch (\Exception $e){
			return $result;
		}
	}

	/**
	*traitement login
	*@param string $email
	*@param string $password
	*@return bool $result
	*/
	public static function login($email, $password){
		//resultat
		$result = false;
		//rechercher la personne par email 
		$user = self::getUserByEmail($email);

		if (!$user) {
			$_SESSION['msg'] = 'Email ne correspond pas.';
			return $result;
		}
		
		//var_dump($password);
		//var_dump($user['password']);
		//vérification de mots de passe
		if(password_verify($password, $user['PASSWORD'])){
			// login réussi
			session_regenerate_id(true);
			$_SESSION['login_user'] = $user;
			$result = true;
			return $result;
		}

		$_SESSION['msg'] = 'Mots de passe ne correspond pas.';
		//$_SESSION['msg'] = $password;
		//$_SESSION['msg'] = $user['PASSWORD'];
			return $result;
	}

	/**
	*recupérer la personne par email
	*@param string $email
	*@return array bool $user|false
	*/
	public static function getUserByEmail($email){
		// Préparation sql
		// Execute sql
		// Rendre le résultat de sql
		$sql ="SELECT * FROM employes INNER JOIN postes ON employes.ID_POSTE = postes.ID_P WHERE employes.EMAIL = ?";

		// entrer email dans un array
		$arr = [];
		$arr[] = $email;
		
		try{
			$dbc_e = new Dbc_employee();
			$stmt = $dbc_e->connect()->prepare($sql);
			$stmt->execute($arr);
			// Rendre le résultat de sql
			$user = $stmt->fetch();
			return $user;
		}	catch (\Exception $e){
			return false;
		}
	}

	/**
	*login check
	*@param void
	*@return bool $result
	*/
	public static function checkLogin(){
		$result = false;
		// s'il n'y a pas user dans la session = false
		if (isset($_SESSION['login_user']) && $_SESSION['login_user']['ID'] > 0) {
			return $result = true;
		}
		return $result;
	}

	/**
	*traitement logout
	*/
	public static function logout(){
		$_SESSION = array();
		session_destroy();
	}




}
?>