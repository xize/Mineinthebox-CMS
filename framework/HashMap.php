<?php
class HashMap {
	
	/*
	 * A small documentation for myself.
	 * in these kind of arrays a key is present as.
	 * 'key' => 'value' inside the array.
	 * otherwise array_key_exists may not work I guess
	 * So we not going to use array().array() or array(array()) :).
	 */
	
	private final $arg;
	private final $size;
	
	public function __construct() {
		$this->arg = array();
		$this->size = 0;
	}
	
	/**
	 * 
	 * @author xize
	 * @param HashMap Key
	 * @param HashMap Value
	 * @return boolean
	 * 
	 * 
	 */
	//ugh this is not very nice! I can't use '=>' like in a array so instead we do it as a hardcoded String...
	public function put($key, $value) {
		if($this->containsKey($key)) {
			$this->remove($key);
			$semi = "'" .  $key  . "' => '" . $value . "'";
			$this->arg[$this->size++] = semi;
		}
		$semi = "'" .  $key  . "' => '" . $value . "'";
		$this->arg[$this->size++] = semi;
	}
	
	public function containsKey($key) {
		if(array_key_exists($key, $this->arg)) {
			return true;
		}
		return false;
	}
	
	public function containsValue($value) {
		if(in_array($value, array_values($this->arg))) {
			return true;
		}
		return false;
	}
	
	public function size() {
		return array_keys($this->size);
	}
	
	private function IndexOf($obj) {
		if($this->containsKey($obj)) {
			$index = array_key_exists($obj, array_keys($this->arg));
			if((boolean) count($index)) {	
				return $index;
			} else {
				return $index[0];
			}
			return -1;
		}
	}
	
	//hopes that the value gets removed though like as in a row
	//but I don't think this works probably ive remove both value and key.
	public function remove($key) {
		if(in_array($key, array_keys($key))) {
			unset($this->arg[$key]);
			--$this->size;
		}
	}
	
}

?>