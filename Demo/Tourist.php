<?php
namespace Demo;
require_once("../Configuration/MySQL.php");
use Configuration\MySQL;
class Tourist{	

	function signUp($email, $nickname, $password){
		$sql = "insert into user (email, nickname, password)
				values ('$email', '$nickname', '$password')";
		$db = MySQL::getInstance();
		$db -> query($sql);
		if($db -> affectRows()){
			return true;
		}

		else
			return false;
	}

	function signIn($email, $password){

		$db = MySQL::getInstance();
		$sql = "select * from user where email = '$email' and password = '$password'";
		if($db -> query($sql)){
			return true;
		}
		else
			return false;
	}

}





?>