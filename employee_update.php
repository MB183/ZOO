<?php 
require_once('employee.php');
//ini_set('display_errors', "On");

$employees = $_POST;

$employee = new Employee();

	if (empty($employees['email'])) {
		exit("Entrez votre email");
	}

// mot de passe 
	
		
$employee->employeeUpdate($employees);

?>

<p><a href="employee_list.php">Revenir</a></p>