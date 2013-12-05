<?php
class connection {
	
	protected $dbnetwork;
	protected $dbuser;
	protected $dbpass;
	protected $db;
	
	public final function setHost($host) {
		$network = $host;
	}
	
	public function setUser($user) {
		$dbuser = $user;
	}
	
	public function setPass($pass) {
		$dbpass = $pass;
	}
	
	public function setDatabase($database) {
		$db = $database;
	}
	
	public function testConnect($network, $user, $pass, $db) {
		try {
			if(mysql_connect($network, $user, $pass)) {
				if(mysql_select_db($db)) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		} catch(Exception $a) {
			$a->getTrace();
		}
	}
	
	public function onConnect() {
		try {
			if(mysql_connect($this->$dbnetwork, $this->$dbuser, $this->$dbpass)) {
				if(mysql_select_db($this->$db)) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		} catch(Exception $a) {
			$a->getTrace();
		}
	}
}

?>