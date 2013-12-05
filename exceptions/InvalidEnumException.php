<?php
class InvalidEnumException extends Exception {
	protected $message;
	public function __InvalidEnumException($message) {
		$this->message = $message;
		throw new $this($message);
	}
}

?>