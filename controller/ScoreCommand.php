<?php
/**
*
* @author Saad Shams :: sshams@live.com
*
* Copy, reuse is prohibited.
* 
*/
require_once ('library/PureMVC_PHP_1_0_2.php');
require_once ('model/ScoreProxy.php');
require_once ('view/mediators/ScoreMediator.php');
require_once ('view/components/Score.php');

class ScoreCommand extends SimpleCommand {
	
	public function execute(INotification $notification) {

		$this->facade->registerMediator(new ScoreMediator(new Score()));
		$this->facade->registerProxy(new ScoreProxy());
		
		switch ($notification->getBody()) {
			case URIProxy::HOME:
				break;
			case URIProxy::INSERT:
				$scoreProxy = $this->facade->retrieveProxy(ScoreProxy::NAME);
				if($scoreProxy->insert()) {
					$this->facade->sendNotification(ApplicationFacade::SCORE_SUCCESS);
				} else {
					$this->facade->sendNotification(ApplicationFacade::SCORE_FAILURE);
				}
				break;
				
			case URIProxy::LEADERBOARD:
				$scoreProxy = $this->facade->retrieveProxy(ScoreProxy::NAME);
				$this->facade->sendNotification(ApplicationFacade::LEADERBOARD_SUCCESS, $scoreProxy->leaderboard());
				break;
		}
		
	}
}
?>