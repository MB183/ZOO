<?php 
require_once('dbc_employee.php');

Class Employee extends Dbc_employee
{
	public function employeeUpdate($employees){
		var_dump($employees);
		
	}
}

?>