<?php
class account extends config {
	
	private $userName;
	
	//this is our constructor which will wrap our member data like a mini database ;-)
	public function __account($userName) {
		$this->userName = $userName;
	}
	
	//get the name of the currently member in this instance.
	public function getName() {
		return (String)$this->$userName;
	}
	
	//this will return a boolean based if the account is activated by mail or just not.
	public function isValidated() {
		$validate = (int)mysql_query("SELECT validated FROM users WHERE user='" . $this->getName() . "'");
		if($validate > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	//get the number amount of posts this member has posted!
	public function getPosts() {
		$posts = (int)mysql_query("SELECT posts FROM users WHERE user='" . $this->getName() . "'");
		return $posts;
	}
	
	//get the boolean whenever a member is banned or not.
	public function isBanned() {
		$banned = (boolean)mysql_query("SELECT banned FROM users WHERE user='" . $this->getName() . "'");
		return $banned;
	}
	
	//get registration date
	public function getRegistrationDate() {
		$getDate = mysql_query("SELECT regDate FROM users WHERE user='" . $this->getName() . "'");
		return $getDate;
	}
	
	//get password hash for the authencation system to validate accounts, hash will be extra salted with pepper these days.
	public function getAuthHash() {
		$hash = (String)mysql_query("SELECT password FROM users WHERE user='" . $this->getName() . "'");
		return $hash;
	}
	
	//set a new hash also known as password reset.
	public function setAuthHash($hash) {
		mysql_query("INSERT into users (password) VALUES('" . $hash . "')");
	}
	
	//get email adress
	public function getEmail() {
		$email = (String)mysql_query("SELECT email FROM users WHERE user='" . $this->getName() . "'");
		return $email;
	}
	
	//setting email, with basic protection against mysql injections.
	public function setEmail($mail) {
		$query = stripslashes(mysql_real_escape_string(mysql_query("INSERT INTO users (email) VALUES('" .  $mail . "')")));
	}
	
	//get the avater of this member instance (not sure if $img works when the file stream is closed and if it works through the <img> tags)
	public function getAvater() {
		$query = mysql_query("SELECT avater FROM users WHERE user='" . $this->getName() . "'");
		$img = fopen($this->getName(), w);
		fclose($this->getName());
		return $img;
	}
}

?>