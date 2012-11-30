<?php
/**
*
* @author Saad Shams :: sshams@live.com
*
* Copy, reuse is prohibited.
* 
*/

require_once ('library/PureMVC_PHP_1_0_2.php');
require_once ('ApplicationFacade.php');
require_once ('view/components/Registration.php');

class RegistrationMediator extends Mediator {
	const NAME = "RegistrationMediator";
	
	public function __construct(Registration $registration) {
		parent::__construct(self::NAME, $registration);
	}
	
	public function listNotificationInterests() {
		return array(
			ApplicationFacade::REGISTRATION_SUCCESS,
			ApplicationFacade::REGISTRATION_EXISTS
		);
	}
	
	public function handleNotification(INotification $notification){
		switch($notification->getName()){
			case ApplicationFacade::REGISTRATION_SUCCESS:
				$this->viewComponent->insert($notification->getBody());
				break;

			case ApplicationFacade::REGISTRATION_EXISTS:
				$this->viewComponent->exists($notification->getBody());
				break;
		}
	}
	
}

?>