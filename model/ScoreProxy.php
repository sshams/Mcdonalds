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
require_once ('model/valueObjects/LeaderboardVO.php');

class ScoreProxy extends Proxy implements IProxy {
	
    const NAME = "RegistrationProxy";
    private $connection;
	
    public function __construct () {
        parent::__construct(self::NAME, null);
	$this->connection = CocaCola::getConnection();
    }
    
    public function insert() { //
	if ((isset($_REQUEST["registration_id"])) && ($_REQUEST["registration_id"] != "")) {
	  $_REQUEST['points'] = isset($_REQUEST['points']) ? $_REQUEST['points'] : NULL;
	  $_REQUEST['time'] = isset($_REQUEST['time']) ? $_REQUEST['time'] : NULL;
	  $_REQUEST['rounds'] = isset($_REQUEST['rounds']) ? $_REQUEST['rounds'] : NULL;
			
	  $insertSQL = sprintf("INSERT INTO score (points, `time`, rounds, registration_id) VALUES (%s, %s, %s, %s)",
	                       SQL::GetSQLValueString($_REQUEST['points'], "int"),
	                       SQL::GetSQLValueString($_REQUEST['time'], "int"),
	                       SQL::GetSQLValueString($_REQUEST['rounds'], "int"),
	                       SQL::GetSQLValueString($_REQUEST['registration_id'], "int"));
		
	  $Result1 = mysql_query($insertSQL, $this->connection) or die(mysql_error());
	  return true;
	} else {
	return false;
	}
    }
    
    public function leaderboard() { //
	$query_rsScore = "SELECT registration.first_name, registration.last_name, max(score.points) AS points FROM registration, score WHERE score.registration_id = registration.registration_id GROUP BY score.registration_id ORDER BY points DESC, score.time DESC";
    	$query_limit_rsScore = sprintf("%s LIMIT %d, %d", $query_rsScore, 0, 10);
    	$rsScore = mysql_query($query_limit_rsScore, $this->connection) or die(mysql_error());
    	$row_rsScore = mysql_fetch_assoc($rsScore);
	$totalRows_rsScore = mysql_num_rows($rsScore);
		
	$leaderboardVOs = array();
	$rank = 0;
	if($totalRows_rsScore > 0) {
		do { 
			$rank++;
			array_push($leaderboardVOs, new LeaderboardVO(($rank < 10) ? "0" . $rank : $rank, $row_rsScore['first_name'] . " " . $row_rsScore['last_name'], $row_rsScore['points']));		
		} while($row_rsScore = mysql_fetch_assoc($rsScore));
	}
	mysql_free_result($rsScore);
	
	if ((isset($_REQUEST["registration_id"])) && ($_REQUEST["registration_id"] != "")) {
		return array($leaderboardVOs, $this->score($_REQUEST["registration_id"]));
    	} else {
		return array($leaderboardVOs, new LeaderboardVO("", "", ""));
    	}
		
	
    }
    
    public function score($registration_id) {
    	$found = false;
    	$query_rsScore = "SELECT registration.registration_id, registration.first_name, registration.last_name, max(score.points) AS points FROM registration, score WHERE registration.registration_id = score.registration_id GROUP BY score.registration_id ORDER BY points DESC, score.time DESC";
	$rsScore = mysql_query($query_rsScore, $this->connection) or die(mysql_error());
	$row_rsScore = mysql_fetch_assoc($rsScore);
	$totalRows_rsScore = mysql_num_rows($rsScore);

	$rank = 0;
	if($totalRows_rsScore > 0){
		do {
			$rank++;
			if($row_rsScore['registration_id'] == $registration_id){
				$found = true;
				break;
			}
		} while ($row_rsScore = mysql_fetch_assoc($rsScore));
		mysql_free_result($rsScore);
			
		if(!$found) { 
			$rank = "";
		}
		return new LeaderboardVO(($rank < 10 && $rank != "") ? "0" . $rank : $rank, $row_rsScore['first_name'] . " " . $row_rsScore['last_name'], $row_rsScore['points']);
	} else {
		return null;
	}
	
    }
    
}
?>