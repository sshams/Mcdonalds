<?php
/**
*
* @author Saad Shams :: sshams@live.com
*
* Copy, reuse is prohibited.
* 
*/

class LeaderboardVO {
	
	public $rank;
	public $name;
	public $points;
	
	function __construct($rank, $name, $points) {
		$this->rank = $rank;
		$this->name = $name;
		$this->points = $points;
	}
	
	public function __toString() {
		return $this->rank . ", " . $this->name . ", " . $this->points;
	}
	
}
?>