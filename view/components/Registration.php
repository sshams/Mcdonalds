<?php
/**
*
* @author Saad Shams :: sshams@live.com
*
* Copy, reuse is prohibited.
* 
*/

require_once ('model/valueObjects/RegistrationVO.php');
require_once ('library/Parser.php');

class Registration {

	public function insert(RegistrationVO $registrationVO=null){
		if($registrationVO){
			echo Parser::parse(file_get_contents("view/templates/registration.txt"), $registrationVO);
		} else {
			echo file_get_contents("view/templates/failure.txt");
		}
	}
	
	public function exists(RegistrationVO $registrationVO=null){
		if($registrationVO){
			echo Parser::parse(file_get_contents("view/templates/registration.txt"), $registrationVO);
		} else {
			echo file_get_contents("view/templates/failure.txt");
		}
	}

}

?>