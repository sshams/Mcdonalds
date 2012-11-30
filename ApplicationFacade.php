<?php
/**
*
* @author Saad Shams :: sshams@live.com
*
* Copy, reuse is prohibited.
* 
*/
require_once ('library/PureMVC_PHP_1_0_2.php');
require_once ('controller/StartupCommand.php');
require_once ('controller/RegistrationCommand.php');
require_once ('controller/ScoreCommand.php');
class ApplicationFacade extends Facade implements IFacade {
	
	//for commands
	const STARTUP = "startup";
	const REGISTRATION = "registration";
	const SCORE = "score";
	
	//for communication
	const REGISTRATION_SUCCESS = "registrationSuccess"; 
	const REGISTRATION_FAILURE = "registrationFailure";
	const REGISTRATION_EXISTS = "registrationExists";
	
	const SCORE_SUCCESS = "scoreSuccess";
	const SCORE_FAILURE = "scoreFailure";
	
	const LEADERBOARD_SUCCESS = "leaderboardSuccess";
	const USER_SCORE = "userScore"; 
	const USER_SCORE_FAILURE = "userScoreFailure";
	
	public static function getInstance() {
		if(parent::$instance == null) {
			parent::$instance = new ApplicationFacade();
		}
		return parent::$instance;
	}
	
	protected function initializeController() {
		parent::initializeController();
		$this->registerCommand(self::STARTUP, 'StartupCommand'); 
		$this->registerCommand(self::REGISTRATION, 'RegistrationCommand');
		$this->registerCommand(self::SCORE, 'ScoreCommand');
	}
	
	public function startup($params=null) {
		$this->sendNotification(self::STARTUP);
	}
	
}
?>