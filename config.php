<?php
require_once 'includes/connection.php';
class config extends connection {
	###########################################
	#   Fill here your database information   #
	###########################################
	
	public $host = "localhost";
	public $username = "yourname";
	public $password = "yourpass";
	public $db = "your database";

	# end of configuration line, do not edit anything under this tag.
	public function setConnection() {
		$this->setHost($this->$host);
		$this->setUser($this->$username);
		$this->setPass($this->$password);
		$this->setDatabase($this->$db);
	}
}
$connect = new connection();
$connect->onConnect();
?>