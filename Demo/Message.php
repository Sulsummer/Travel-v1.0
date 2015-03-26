<?php
namespace Demo;
include_once("../Configuration/MySQL.php");
use Configuration\MySQL;
include_once("User.php");

class Message{



//
//返回发件人或收件人的所有信息
//
	public function getAllMessage($key,$user_id){
		$db = MySQL::getInstance();
		$msg = array();
		switch ($key) {
			case 's':
				$sql = "select * from message_sender_box where sender_id = '$user_id'";
				$temp = $db -> queryArr($sql);
				$newUser = new User("id",$user_id);
				for($i = 0; $i < count($temp); $i ++){
					$temp1 = $db -> getUserInfo("id",$temp[$i]["receiver_id"]);
					$temp[$i]["receiver_name"] = $temp1["nickname"];
				}
				return $temp;
			
			case 'r':
				$sql = "select * from message_receiver_box where receiver_id = '$user_id'";
				$temp = $db -> queryArr($sql);
				$newUser = new User("id",$user_id);
				for($i = 0; $i < count($temp); $i ++){
					$temp1 = $db -> getUserInfo("id",$temp[$i]["sender_id"]);
					$temp[$i]["sender_name"] = $temp1["nickname"];
				}
				return $temp;
		}
	}

//
//返回单条信息
//
	private function getMessage($key,$msg_id){
		$db = MySQL::getInstance();
		switch ($key) {
			case 's':
				$sql = "select * from message_sender_box where id = '$msg_id'";
				return $db -> query($sql);
			
			case 'r':
				$sql = "select * from message_receiver_box where id = '$msg_id'";
				return $db -> query($sql);
		}
	}

//
//发送信息
//
	public function sendMessage($sender_id,$receiver_id,$msg){
		$db = MySQL::getInstance();
		
		$sql = "insert into message_sender_box(sender_id,receiver_id,message)
				values('$sender_id','$receiver_id','$msg')";
		$db -> query($sql);
		$flag1 = $db -> affectRows();

		$sql = "insert into message_receiver_box(sender_id,receiver_id,message)
				values('$sender_id','$receiver_id','$msg')";
		$db -> query($sql);
		$flag2 = $db -> affectRows();

		if($flag1 && $flag2){
			return true;
		}
		else
			return false;
	}

//
//回复信息
//	
	private function answerMessage($sender_id,$receiver_id,$msg_id,$answer){
		$db = MySQL::getInstance();
		
		$sql = "insert into message_sender_box(ref_id,sender_id,receiver_id,message)
				values('$msg_id','$sender_id','$receiver_id','$answer')";
		$db -> query($sql);
		$flag1 = $db -> affectRows();
		
		$sql =  "insert into message_receiver_box(ref_id,sender_id,receiver_id,message)
				values('$msg_id','$sender_id','$receiver_id','$answer')";
		$db -> query($sql);
		$flag2 = $db -> affectRows();
		
		if($flag1 && $flag2){
			return true;
		}
		else
			return false;
	}

/*
//
//记录第一次操作的时间
//
	private function operateTime($key,$msg_id){
		$db = MySQL::getInstance();
		$clicktime = date("Y-m-d H:i:s");
		switch ($key) {
			case 's':
				$sql = "update sender_box set click_time = '$clicktime' where id = '$msg_id'";
				$db -> query($sql);
				return $db -> affectRows();
			
			case 'r':
				$sql = "update receiver_box set click_time = '$clicktime' where id = '$msg_id'";
				$db -> query($sql);
				return $db -> affectRows();
		}
	}	
*/

//
//首先检查receiver_box表中state状态
//state=0 消息未读
//state=1 消息已读
//如果state=1，则不进行操作
//如果state=0，则将改为state=1
//没有跟改操作或者跟改失败，都返回false
//
	private function operateState($msg_id){
		$db = MySQL::getInstance();
		$sql = "select * from message_receiver_box where id = '$msg_id'";
		$temp = $db -> query($sql);
		if($temp["state"] == 0){
			$sql = "update message_receiver_box set state = '1' where id = '$msg_id'";
			$db -> query($sql);
			return $db -> affectRows();
		}
		else{
			return false;
		}
	}

//
//发件人或收件人对信息的操作(op)，包括 查看(view)，删除(delete)，回复(answer)
//
	public function operateMessage($key,$user_id,$msg_id,$op,$answer=""){
		$db = MySQL::getInstance();
		switch ($key) {
			case 's':
				//$this -> operateTime("s",$msg_id);
				if($op == "view"){
					return $this->getMessage("s",$msg_id);
				}
				if($op == "delete"){
					$sql = "delete from message_sender_box where id = '$msg_id'";
					$db -> query($sql);
					return $db -> affectRows();
				}
				if($op == "answer"){
					return $this -> answerMessage($user_id,$user_id,$msg_id,$answer);
				}
			
			case 'r':
				//$this -> operateTime("r",$msg_id);
				$this -> operateState($msg_id);
				if($op == "view"){
					return $this->getMessage("r",$msg_id);
				}
				if($op == "delete"){
					$sql = "delete from message_receiver_box where id = '$msg_id'";
					$db -> query($sql);
					return $db -> affectRows();
				}
				if($op == "answer"){
					$sql = "select * from message_receiver_box where id = '$msg_id'";
					$temp = $db -> query($sql);
					return $this -> answerMessage($user_id,$temp["sender_id"],$msg_id,$answer);
				}
		}
	}


}


?>