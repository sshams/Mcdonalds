<?php
/**
*
* @author Saad Shams :: sshams@live.com
*
* Copy, reuse is prohibited.
* 
*/

class CocaCola {
	public static $database;
	private static $hostname;
	private static $username;
	private static $password;
	private static $connection;
	
	public static function getConnection() {
		if($_SERVER['SERVER_NAME'] == "localhost" || $_SERVER['SERVER_NAME'] == "127.0.0.1" || $_SERVER['SERVER_NAME'] == "10.244.153.90") {
			self::$hostname = "127.0.0.1";
			self::$username = "root";
			self::$password = "";
			self::$database = "CocaCola";
		} else {
			self::$hostname = "127.0.0.1";
			self::$username = "facebook_cola";
			self::$password = "";
			self::$database = "facebook_cocacola";
		}
		
		if(!isset(self::$connection)){
			self::$connection = mysql_connect(self::$hostname, self::$username, self::$password) or trigger_error(mysql_error(), E_USER_ERROR);
			mysql_select_db(self::$database, self::$connection);
			mysql_query("SET NAMES utf8");
		}
		
		return self::$connection;
	}
}
?>