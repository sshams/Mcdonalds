<?php
/**
*
* @author Saad Shams :: sshams@live.com
*
* Copy, reuse is prohibited.
* 
*/

require_once ('library/PureMVC_PHP_1_0_2.php');
require_once ('model/URIProxy.php');
require_once ('model/RegistrationProxy.php');
require_once ('view/mediators/RegistrationMediator.php');
require_once ('view/components/Registration.php');

class RegistrationCommand extends SimpleCommand {
	
	public function execute(INotification $notification) {
		
		$this->facade->registerProxy(new RegistrationProxy());
		$this->facade->registerMediator(new RegistrationMediator(new Registration()));
		
		$params = $this->facade->retrieveProxy(URIProxy::NAME)->getData();
		
		switch ($params[1]) {
			case URIProxy::INSERT:
				$registrationVO = $this->facade->retrieveProxy(RegistrationProxy::NAME)->insert();
				$this->facade->sendNotification(ApplicationFacade::REGISTRATION_SUCCESS, $registrationVO);
				break;
				
			case URIProxy::EXISTS:
				$registrationProxy = $this->facade->retrieveProxy(RegistrationProxy::NAME);
				$this->facade->sendNotification(ApplicationFacade::REGISTRATION_EXISTS, $registrationProxy->exists());
				break;
		}
		
	}
	
}
?>