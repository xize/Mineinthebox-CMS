<?php
/**
 * 
 * 
 * @author xize
 * @return ArrayList
 * 
 *
 */
class ArrayList {
	
	private final $ar;
	private final $size;
	
	public function __construct() {
		$this->ar = array();
		$this->size = 0;
	}
	
	/**
	 * 
	 * @author xize
	 * @return void
	 * 
	 */
	public function add($obj) {
		$this->ar[$this->size++] = $obj;
	}
	
	/**
	 * 
	 * @author xize
	 * @return mixed
	 * 
	 */
	public function get($obj) {
		if(isset($this->ar[$obj])) {
			return $this->ar[$obj];
		}
		return null;
	}
	
	/**
	 * 
	 * 
	 * @author xize
	 * @return integer
	 * 
	 * 
	 */
	public function indexOf($obj) {
		if(in_array($obj, $this->ar)) {
			$index = array_key_exists($this->ar, $obj);
			if((boolean) count($index)) {
				return $index;
			} else {
				return $index[0];
			}
		}
		return -1;
	}
	
	/**
	 * 
	 * @author xize
	 * @return boolean
	 *
	 */
	public function isEmpty() {
		return $this->size == 0;
	}
	
	/**
	 * 
	 * @author xize
	 * @return number
	 * 
	 */
	public function size() {
		return $this->size;
	}
	
	/**
	 * 
	 * @author xize
	 * @return array;
	 * 
	 */
	public function toArray() {
		return $this->ar;
	}
	
	public function lastIndexOf($obj) {
		$get = $this->indexOf($obj);
		if(is_array($get)) {
			return $get[(count($get)-1)];
		}
	}
	
	/**
	 * 
	 * @author xize
	 * @return boolean
	 * 
	 */
	public function remove($obj) {
		if(is_numeric($obj)) {
			$newobjs = $this->lastIndexOf($obj);
			if(in_array($newobjs, $this->ar) || $newobjs != -1) {
				foreach($newobjs as $index) {
					unset($this->ar[$index]);
					--$this->size;
				}
				return true;
			}
			return false;
		} else {
			if($obj < $this->size) {
				unset($this->ar[$obj]);
				$this->ar = array_values($this->ar);
				--$this->size;
				return true;
			}
		}
		return false;
	}
	
	/**
	 * 
	 * @author xize
	 * @return boolean
	 * 
	 */
	public function contains($obj) {
		if(in_array($obj, $this->ar)) {
			return true;
		}
		return false;
	}
	
	/**
	 * 
	 * @author xize
	 * @param put a Array in the ArrayList
	 *
	 */
	public function addAll($args) {
		foreach($args as $arg) {
			$this->add($arg);
		}
	}
	
	/**
	 * 
	 * @author xize
	 * @return boolean
	 * 
	 * 
	 */
	public function clear() {
		$this->ar = array();
		$this->size = 0;
		return true;
	}
		
}
?>