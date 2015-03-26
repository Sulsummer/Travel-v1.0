<?php
	include_once("../Demo/Tourist.php");
	
	$act = $_GET["act"];
	$tourist = new \Demo\Tourist();

	if($act == "up"){
		$email = $_POST["sign-up-email"];
		$nickname = $_POST["sign-up-nickname"];
		$password = $_POST["sign-up-password"];
		if($tourist -> signUp($email,$nickname,$password)){
			setcookie("email",$email,time()+3600*7*24,"/");
			echo "success";
		}
		else
			echo "failure";
	}
	else if($act == "in"){
		$email = $_POST["sign-in-email"];
		$password = $_POST["sign-in-password"];
		if($tourist ->signIn($email,$password)){
			setcookie("email",$email,time()+3600*7*24,"/");
			header("Location:../View/selfpage.php?email=$email");
		}
		else
			echo "f";
	}
	else
		echo "ERROR";
?>