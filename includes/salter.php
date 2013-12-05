<?php
class salter {
	
	//this will salt a password to URANDOM encryption.
	public function simpleSalt($password) {
		$salt = mcrypt_create_iv (22, MCRYPT_DEV_URANDOM );
		$salt = base64_encode ( $salt );
		$salt = str_replace ( '+', '.', $salt );
		$hash = crypt ($password, '$2y$10$' . $salt . '$');
		echo $hash;
	}
}

$test = new salter();
$test->simpleSalt("testing");

?>