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
class URIProxy extends Proxy implements IProxy {
	
	const NAME = "URIProxy";
	
	const HOME = '/';
	const REGISTRATION = 'registration';
	const SCORE = "score";
	
	const SELECT = "select";
	const INSERT = "insert";
	const UPDATE = "update";
	const DELETE = "delete";
	const EXISTS = "exists";
	const USER = "user";
	const TOTAL = "total";
	
	const LEADERBOARD = "leaderboard";
	
	public function __construct() {
		parent::__construct(self::NAME, isset($_SERVER['PATH_INFO']) ? explode("/", trim($_SERVER['PATH_INFO'], "/")) : self::HOME);
	}
	
}
?>