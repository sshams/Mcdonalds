<?php
/**
*
* @author Saad Shams :: sshams@live.com
*
* Copy, reuse is prohibited.
* 
*/
require_once ('library/PureMVC_PHP_1_0_2.php');
require_once ('library/SQL.php');
require_once ('model/connections/CocaCola.php');
require_once ('model/valueObjects/RegistrationVO.php');

class RegistrationProxy extends Proxy {
	
    const NAME = "RegistrationProxy";
    private $connection;
	
    public function __construct () {
        parent::__construct(self::NAME, null);
	$this->connection = CocaCola::getConnection();
    }
    
    public function select($uid) {
    	$query_rsRegistration = sprintf("SELECT * FROM registration WHERE uid = %s", SQL::GetSQLValueString($uid, "text"));
    	$rsRegistration = mysql_query($query_rsRegistration, $this->connection) or die(mysql_error());
	$row_rsRegistration = mysql_fetch_assoc($rsRegistration);
	$totalRows_rsRegistration = mysql_num_rows($rsRegistration);
	if($totalRows_rsRegistration > 0){
		$this->setData($row_rsRegistration);
	}
	return $totalRows_rsRegistration;
    }
    
    public function insert() { 
	if ((isset($_REQUEST["uid"])) && $_REQUEST["uid"] != "") {
		if(!$this->select($_REQUEST["uid"])) {
			$_REQUEST['first_name'] = isset($_REQUEST['first_name']) ? $_REQUEST['first_name'] : NULL;
			$_REQUEST['last_name'] = isset($_REQUEST['last_name']) ? $_REQUEST['last_name'] : NULL;
			$_REQUEST['email'] = isset($_REQUEST['email']) ? $_REQUEST['email'] : NULL;
			$_REQUEST['phone'] = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : NULL;
			$_REQUEST['location'] = isset($_REQUEST['location']) ? $_REQUEST['location'] : NULL;
			$_REQUEST['lang'] = isset($_REQUEST['lang']) ? $_REQUEST['lang'] : NULL;
				
			$insertSQL = sprintf("INSERT INTO registration (uid, first_name, last_name, email, phone, location, lang) VALUES (%s, %s, %s, %s, %s, %s, %s)",
					SQL::GetSQLValueString($_REQUEST['uid'], "text"),
					SQL::GetSQLValueString($_REQUEST['first_name'], "text"),
					SQL::GetSQLValueString($_REQUEST['last_name'], "text"),
					SQL::GetSQLValueString($_REQUEST['email'], "text"),
					SQL::GetSQLValueString($_REQUEST['phone'], "text"),
					SQL::GetSQLValueString($_REQUEST['location'], "text"),
					SQL::GetSQLValueString($_REQUEST['lang'], "text"));
			
			$Result1 = mysql_query($insertSQL, $this->connection) or die(mysql_error());
			return new RegistrationVO(mysql_insert_id());
		} else {
			$row_rsRegistration = $this->getData();
			return new RegistrationVO($row_rsRegistration['registration_id']);
		}
	} else {
		return 0;
	}
    }
	
    public function exists() { 
	if ((isset($_REQUEST["uid"])) && ($_REQUEST["uid"] != "")) {
		$query_rsRegistration = sprintf("SELECT registration_id FROM registration WHERE uid = %s", SQL::GetSQLValueString($_REQUEST['uid'], "text"));
		$rsRegistration = mysql_query($query_rsRegistration, $this->connection) or die(mysql_error());
		$row_rsRegistration = mysql_fetch_assoc($rsRegistration);
		$totalRows_rsRegistration = mysql_num_rows($rsRegistration);
			
		if($totalRows_rsRegistration > 0){
			return new RegistrationVO($row_rsRegistration['registration_id']);
		} else {
			return null;
		}
		
	}
    }
    
}
?>