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
require_once ('ApplicationFacade.php');
class StartupCommand extends SimpleCommand implements ICommand {
	
	public function execute(INotification $notification) {

		//Security Command
		
		$this->facade->registerProxy(new URIProxy());
		$params = $this->facade->retrieveProxy(URIProxy::NAME)->getData();

		switch($params[0]) {
			case URIProxy::HOME:
				header('Content-type: text/html; charset=UTF-8') ;
				echo file_get_contents("index.html");
				break;
			case URIProxy::REGISTRATION:
				$this->facade->sendNotification(ApplicationFacade::REGISTRATION, isset($params[1]) ? $params[1] : URIProxy::HOME);
				break;
			case URIProxy::SCORE:
				$this->facade->sendNotification(ApplicationFacade::SCORE, isset($params[1]) ? $params[1] : URIProxy::HOME);
				break;
		}
	
	}
}
?>