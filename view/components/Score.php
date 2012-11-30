<?php
/**
*
* @author Saad Shams :: sshams@live.com
*
* Copy, reuse is prohibited.
* 
*/

require_once ('library/Parser.php');

class Score {
	
	public function insert($success) {
		if($success){
			echo file_get_contents("view/templates/success.txt");
		} else {
			echo file_get_contents("view/templates/failure.txt");
		}
	}
	
	public function leaderboard($leaderboard) {
		header('Content-Type: text/xml; charset=UTF-8');
		echo sprintf('<leaderboard rank="%s" name="%s" points="%s">', $leaderboard[1]->rank, $leaderboard[1]->name, $leaderboard[1]->points);
			foreach ($leaderboard[0] as $key){
				echo Parser::parse(file_get_contents("view/templates/leaderboard_row.txt"), $key);
			}
		echo "</leaderboard>";
	}
	
}

?>