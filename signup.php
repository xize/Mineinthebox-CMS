<?php
session_start();
class signup extends config {
	
	public function checkAlreadyLoggedIn() {
		if(!empty($_SESSION['username']) || isset($_SESSION['username'])) {
			header("Location: index.php");
			return true;
		}
		return false;
	}
	
	//checks specific on email patterns and we use the unsafe String to see
	public function checkEmailRegex($mail) {
		$low = strtolower($mail);
		if(filter_var($low, FILTER_VALIDATE_EMAIL)) {
			return true;
		}
		return false;
	}
	
	//returns when the email already is used!, returns false when the use doesn't exist on this email.
	public function checkEmail($mailAdress) {
		$low = stripcslashes(mysql_real_escape_string(strtolower($mailAdress)));
		if($this->checkEmailRegex($mailAdress)) {
			$sql = mysql_query("SELECT user FROM users WHERE email='" . $low . "'");
			if(!$sql) {
				return false;
			} else {
				return true;
			}
		} else {
			throw new InvalidEmailException("InvalidEmailException: your email is invalid please make sure your email contains A-Z0-9, @, and \".\"");
		}
	}
}

?>