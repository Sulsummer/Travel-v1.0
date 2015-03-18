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

	private $user;

	public function __construct($email){
		//$email = $_COOKIE["email"];
		$this->user = $this->getUserInfo($email);
	}

//
//
//
	public function getUserInfo($email){
		$db = MySQL::getInstance();
		$sql = "select * from user where email ='$email'";
		return $db -> query($sql);
	}

//
//登出
//
	public function signOut(){
		isset($_COOKIE["email"])? setcookie("email","",time() - 3600) : setcookie("","");
	}
	
	public function applyGroup($group_id){
		$apply = new Apply();
		return $apply -> sendGroupApply($this->user["u_id"],$group_id,"u sb");
	}

//
//退出group
//
	public function withdrawGroup($group_id){
		$group = new Group();
		$user_id = $this->user["u_id"];
		return $group -> withdrawGroup($user_id,$group_id);
	}

//
//创建group
//
	public function setUpGroup($group_name,$date1="",$date2="",$destination=""){
		$group = new Group();
		$user_id = $this->user["u_id"];
		return $group -> setGroup($group_name,$user_id,$date1,$date2,$destination);
	}

//
//申请加好友
//$friend_id是目标好友的id
//
	public function applyFriends($friend_id,$description){
		$apply = new Apply();
		$user_id = $this->user["u_id"];
		return $apply -> sendFriendApply($user_id,$friend_id,$description);

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
//发表小组评论
//
	public function commentGroup($group_id,$comment){
		$group = new Group();
		$user_id = $this->user["u_id"];
		return $group -> setGroupComment($group_id,$user_id,$comment);
	}

//
//回复小组评论
//
	public function answerGroupComment($group_id,$ref_id,$comment){
		$group = new Group();
		$user_id = $this->user["u_id"];
		return $group -> answerGroupComment($group_id,$user_id,$ref_id,$comment);
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



	function markGroup(){

	}

	function zanGroup(){

	}

	function zanFriend(){

	}

	function getInfo(){

	}

	function getMessage(){

	}

	function changeName(){

	}

	function changeEmail(){

	}
}



?>