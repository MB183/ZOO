<?php 

/**
* Mesure contre XSS : escape
*
*@param string $str Chaîne de caractères cible
*@return string Chaîne traitée
*/
function h($str){
	// $str -> ce que je veux escape, ENT_QUOTES: le contenu d'escape
	return htmlspecialchars($str, ENT_QUOTES, 'utf-8');
}

/**
* Mesure contre CSRF
*@param void
*@return string $csrf_token
*/

function setToken(){
	//Générer un jeton
	//Soumettez ce jeton à partir du formulaire
	//Renseignez-vous sur le jeton à l'écran après l'envoi
	//Supprimer le jeton
	$csrf_token = bin2hex(random_bytes(32));
	$_SESSION['csrf_token'] = $csrf_token;

	return $csrf_token;
}



?>