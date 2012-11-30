<?php
/**
*
* @author Saad Shams :: sshams@live.com
*
* Copy, reuse is prohibited.
* 
*/

require_once ('library//PureMVC_PHP_1_0_2.php');
require_once ('ApplicationFacade.php');
require_once ('view/components/Score.php');

class ScoreMediator extends Mediator implements IMediator {
	
	const NAME = "ScoreMediator";
	
	public function __construct(Score $score) {
		parent::__construct(self::NAME, $score);
	}
	
	public function onRegister(){
	}
	
	public function listNotificationInterests() {
		return array(
			ApplicationFacade::SCORE_SUCCESS,
			ApplicationFacade::LEADERBOARD_SUCCESS,
		);
	}
	
	public function handleNotification(INotification $notification){
		switch($notification->getName()){
			case ApplicationFacade::SCORE_SUCCESS:
				$this->viewComponent->insert(true);
				break;
			case ApplicationFacade::SCORE_FAILURE:
				$this->viewComponent->insert(false);
				break;
			case ApplicationFacade::LEADERBOARD_SUCCESS:
				$this->viewComponent->leaderboard($notification->getBody());
				break;
				
		}
	}
	
	
}

?>