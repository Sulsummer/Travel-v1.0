<?php
namespace Configuration;
class MyArray{
	
	public $id = -1;
	public $arr = array();

	public function __construct($array=array()){
		$this->id ++;
		$this->push($array);
	}

	public function push($array=array()){
		$this->arr = $array;
	}

	public function count(){
		return $this->id + 1;
	}

} 



?>