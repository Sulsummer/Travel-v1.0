<?php
	include_once("../Configuration/MySQL.php");
	use Configuration\MySQL;
	include_once("../Configuration/MyArray.php");
	use Configuration\MyArray;
	include_once("../Demo/Group.php");
	use Demo\Group;
	include_once("../Demo/Tourist.php");
	use Demo\Tourist;
	include_once("../Demo/User.php");
	use Demo\User;
	include_once("../Demo/Captain.php");
	use Demo\Captain;
	include_once("../Demo/Message.php");
	use Demo\Message;
	include_once("../Demo/Apply.php");
	use Demo\Apply;

	//$u = new User("sulsummer@hotmail.com");
	//$u -> withdrawGroup("2");

	$flag1= false;
	$flag2= true;

	$f= $flag1 || $flag2;
	var_dump($f);

?>