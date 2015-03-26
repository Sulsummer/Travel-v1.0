<?php
namespace Demo;

include_once("../Configuration/MySQL.php");
use Configuration\MySQL;
include_once("Message.php");
include_once("Apply.php");
include_once("Group.php");





//User可以
//1.创建小组，申请加入小组，退出小组，评论小组，点赞小组
//2.申请加好友，删除好友，评论好友，点赞好友
//3.修改Email，修改昵称，查看自己的所有信息：昵称，邮箱，赞数，好友，
//  加入的小组，领导的小组，收藏的小组
//4.回复评论
//5.查看消息
//6.退出登录
	
	

class User{

	public $user;

	public function __construct($key,$value){
		switch ($key) {
			case 'email':
				$this->user = $this->getUserInfo("email",$value);
				break;
			
			case 'id':
				$this->user = $this->getUserInfo("id",$value);
				break;
		}
	}

//
//得到一个user的基本信息，不包括加入的组、好友等
//
	public function getUserInfo($key,$value){
		$db = MySQL::getInstance();
		switch ($key) {
			case 'email':
				$sql = "select * from user where email ='$value'";
				return $db -> query($sql);
			
			case 'id':
				$sql = "select * from user where u_id = '$value'";
				return $db -> query($sql);
		}
		
	}

//
//返回用户所有好友
//
	public function getUserFriend(){
		$user_id = $this->user["u_id"];
		$db = MySQL::getInstance();
		$sql = "select * from user_friends where u_id = '$user_id'";
		return $db -> queryArr($sql);
	}

//
//返回好友的基本信息
//
	public function getUserFriendInfo($friend_id){
		$user_id = $this->user["u_id"];
		$db = MySQL::getInstance();
		$sql = "select * from user where u_id = '$friend_id'";
		return $db -> query($sql);
	}

//
//登出
//
	public function signOut(){
		isset($_COOKIE["email"])? setcookie("email","",time() - 3600) : setcookie("","");
	}

//
//删除好友
//暂时设定为如果一方删除好友，则双方都不存在对方
//
	public function deleteFriends($friend_id){
		$db = MySQL::getInstance();
		$user_id = $this->user["u_id"];
		$sql1 = "delete from user_friends where u_id = '$user_id' and f_id = '$friend_id'";
		$db -> query($sql1);
		$flag1 = $db -> affectRows();
		$sql2 = "delete from user_friends where u_id = '$friend_id' and f_id = '$user_id'";
		$db -> query($sql2);
		$flag2 = $db -> affectRows();
		return $flag1 && $flag2;
	}


//
//发表用户评论
//
	public function commentUser($friend_id,$comment){
		$user_id = $this->user["u_id"];
		$db = MySQL::getInstance();
		$sql = "insert into user_comment(u_id,f_id,comment)
				values ('$user_id','$friend_id','$comment')";
		$db -> query($sql);
		return $db -> affectRows();
	}

//
//回复用户评论
//
	public function answerUserComment($friend_id,$ref_id,$comment){
		$user_id = $this->user["u_id"];
		$db = MySQL::getInstance();
		$sql = "insert into user_comment(u_id,f_id,ref_id,comment)
				values ('$user_id','$f_id','$ref_id','$comment')";
		$db -> query($sql);
		return $db -> affectRows();
	}

//
//收藏用户
//
	public function collectUser($friend_id){
		$user_id = $this->user["u_id"];
		$db = MySQL::getInstance();
		$sql = "insert into user_user_collection(u_id,f_id)
				values ('$user_id','$friend_id')";
		$db -> query($sql);
		return $db -> affectRows();
	}

//
//点赞用户
//
	public function praiseUser($friend_id){
		$user_id = $this->user["u_id"];
		$db = MySQL::getInstance();
		
		$sql = "insert into user_user_praise(f_id,u_id)
				values ('$friend_id','$user_id')";
		$db -> query($sql);
		$flag1 = $db -> affectRows();
		
		$user_info = $this->getUserInfo("id",$friend_id);
		$popularity = $user_info["popularity"] + 1;
		
		$sql = "update user set popularity = '$popularity' where f_id = '$friend_id'";
		$db -> query($sql);
		$flag2 = $db -> affectRows();
		
		return $flag1 && $flag2;
	}

//
//查看是否已点过赞，不能重复点赞
//
	public function isPraiseUserValid($friend_id){
		$user_id = $this->user["u_id"];
		$db = MySQL::getInstance();
		$sql = "select * from user_user_praise where u_id = '$user_id' and f_id = '$friend_id'";
		if($db -> query($sql)){
			return false;
		}
		else return true;
	}

//
//跟改用户名，暂时设定更改用户名没有限制次数
//
	public function changeName($new_name){
		$user_id = $this->user["u_id"];
		$db = MySQL::getInstance();
		$sql = "update user set nickname = '$new_name' where u_id = '$user_id'";
		$db -> query($sql);
		return $db -> affectRows();
	}

//
//暂时考虑不实现
//
	public function changeEmail(){

	}
}



?>