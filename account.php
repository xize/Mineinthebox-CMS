<?php
require_once 'config.php';
require_once 'exceptions/InvalidEnumException.php';
class account extends config {
	private $userName;
	
	// this is our constructor which will wrap our member data like a mini database ;-)
	public function __account($userName) {
		$this->userName = $userName;
	}
	
	// get the name of the currently member in this instance.
	public function getName() {
		return ( string ) $this->$userName;
	}
	
	// this will return a boolean based if the account is activated by mail or just not.
	public function isValidated() {
		$validate = ( int ) mysql_query ( "SELECT validated FROM users WHERE user='" . $this->getName () . "'" );
		if ($validate > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// get the number amount of posts this member has posted!
	public function getPosts() {
		$posts = ( int ) mysql_query ( "SELECT posts FROM users WHERE user='" . $this->getName () . "'" );
		return $posts;
	}
	
	// get the boolean whenever a member is banned or not.
	public function isBanned() {
		$banned = ( boolean ) mysql_query ( "SELECT banned FROM users WHERE user='" . $this->getName () . "'" );
		return $banned;
	}
	
	// get registration date
	public function getRegistrationDate() {
		$getDate = mysql_query ( "SELECT regDate FROM users WHERE user='" . $this->getName () . "'" );
		return $getDate;
	}
	
	// get password hash for the authencation system to validate accounts, hash will be extra salted with pepper these days.
	public function getAuthHash() {
		$hash = ( string ) mysql_query ( "SELECT password FROM users WHERE user='" . $this->getName () . "'" );
		return $hash;
	}
	
	// set a new hash also known as password reset.
	public function setAuthHash($hash) {
		mysql_query ( "UPDATE users SET password='" . $hash . "' WHERE user='" . $this->getName () . "'" );
	}
	
	// get email adress
	public function getEmail() {
		$email = ( string ) mysql_query ( "SELECT email FROM users WHERE user='" . $this->getName () . "'" );
		return $email;
	}
	
	// setting email, with basic protection against mysql injections.
	public function setEmail($mail) {
		$query = stripslashes ( mysql_real_escape_string ( mysql_query ( "UPDATE users SET password='" . $mail . "' WHERE user='" . $this->getName () . "'" ) ) );
	}
	
	// get the avater of this member instance (not sure if $img works when the file stream is closed and if it works through the <img> tags)
	// if this not work we need to investigate more towards blob data handling.
	public function getAvater() {
		$query = mysql_query ( "SELECT avater FROM users WHERE user='" . $this->getName () . "'" );
		$img = fopen ( $this->getName (), w );
		fclose ( $this->getName () );
		return $img;
	}
	
	// set avater of this member
	public function setAvater($imgData) {
		// this table need to be blob data.
		$query = strip_tags ( mysql_real_escape_string ( mysql_query ( "UPDATE users SET avater='" . $imgData . "' WHERE user='" . $this->getName () . "'" ) ) );
		return $query;
	}
	
	// get the remote host of this member
	public function getIp() {
		$ip = ( string ) mysql_query ( "SELECT ip FROM users WHERE user='" . $this->getName () . "'" );
		return ip;
	}
	
	// set ip from remote host
	public function setIp() {
		$ip = ( string ) mysql_query ( "UPDATE users SET ip='" . $_SERVER ['REMOTE_ADDR'] . "' WHERE user='" . $this->getName () . "'" );
		return $ip;
	}
	
	// get last active timestamp
	public function getLastOnline() {
		$last = ( array ) mysql_query ( "SELECT lastOnline FROM users WHERE user='" . $this->getName () . "'" );
		return $last;
	}
	
	// update last active timestamp
	public function updateLastOnline() {
		$last = ( boolean ) mysql_query ( "UPDATE users SET lastOnline='" . getDate () . "' WHERE user='" . $this->getName () . "'" );
		return $last;
	}
	
	// this will show all constants like a enum!
	public function ranks() {
		$args = Array (
				"GUEST",
				"CITIZEN",
				"GUIDE",
				"STAFF",
				"OWNER",
				"SPONSER",
				"DONATOR",
				"BANNED"
		);
		return $args;
	}
	
	// gets the rank of this user
	public function getRank() {
		$rank = ( string ) mysql_query ( "SELECT rank FROM users WHERE user='" . $this->getName () . "'" );
		return $rank;
	}
	
	public function setRank($rankEnum) {
		$rankUppercase = strtoupper($rankEnum);
		if(in_array($rankUppercase, $this->ranks())) {
			$setRank = mysql_query("UPDATE users SET rank='" . $rankUppercase . "' WHERE user='" . $this->getName() . "'");
		} else {
			throw new InvalidEnumException("InvalidEnumException: you are trying to use a non existing rank!");
		}
	}
}
?>