<?php
namespace Configuration;

class MySQL{

	static $link;

	private function __construct(){
		$link = mysql_connect("localhost", "summer", "summer");
		mysql_select_db("demo", $link);
	}
//
//查询结果只有一条
//
	function query($sql){
		$res = mysql_query($sql);
		return mysql_fetch_array($res);
	}

//
//查询结果多条
//
	function queryArr($sql){
		$res = mysql_query($sql);
		$arr = array();
		$i = 0;
		while($temp = mysql_fetch_array($res)){
			$arr[$i] = $temp;
			$i ++;
		}
		return $arr;
	}


//????
	function affectRows(){
		if(mysql_affected_rows())
			return true;
		else
			return false;
	}

	function close(){
		mysql_close(self::$link);
	}

	function getInstance(){
		if(self::$link){
			return self::$link;
		}
		else{
			return new self();
		}
	}
}





?>