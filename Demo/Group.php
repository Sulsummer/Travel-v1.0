<?php
namespace Demo;
include_once("../Configuration/MySQL.php");
use Configuration\MySQL;
class Group{
//
//得到一个group的基本信息，但不包括group的成员,也不包括group的announcement
//
	public function getGroupInfo($key,$value){
		$db = MySQL::getInstance();
		switch ($key) {
			case 'group_name':
				$sql = "select * from groups where g_name ='$value'";
				return $group_info = $db -> query($sql);
			
			case 'group_id':
				$sql = "select * from groups where g_id = '$value'";
				return $group_info = $db -> query($sql);
		}
	}
//
//得到一个user建立的所有group
//
	public function getAllSetGroup($user_id){
		$db = MySQL::getInstance();
		$sql = "select * from groups where captain_id = '$user_id'";
		return $db -> queryArr($sql);
	}

//
//得到一个user加入的所有group，不包括自己建立的
//
	public function getAllGroup($user_id){
		$db = MySQL::getInstance();
		$sql = "select * from group_members where m_id = '$user_id'";
		$temp = $db -> queryArr($sql);

		$groupArray = array();
		for($i = 0; $i < count($temp); $i ++){
			$groupid = $temp[$i]["g_id"];
			$sql = "select * from groups where g_id = '$groupid'";
			array_push($groupArray, $db->query($sql));
		}
		return $groupArray;
	}



//
//建立group时，检查group name是否被使用，以及出发时间和返回时间是否逻辑矛盾
//当$key="group_name",$value1为$group_name
//当$key="date",$value1和$value2分别为$date1,$date2
//
	public function isGroupValid($key,$value1="",$value2=""){
		$db = MySQL::getInstance();
		$flag = true;
		switch ($key) {
			case 'group_name':
				$sql = "select * from groups where g_name = '$value1'";
				if($db -> query($sql)){
					return false;
				}
				else return true;
			
			case 'date':
				$array1 = explode("-", $value1);
				$array2 = explode("-", $value2);
				$date1 = mktime(0,0,0,$array1[1],$array1[2],$array1[0]);
				$date2 = mktime(0,0,0,$array2[1],$array2[2],$array2[0]);
				if(($date2 - $date1) < 0){
					return false;
				}
				else return true;
		}
	}
//
//返回小组的所有成员
//
	public function getGroupMember($group_id){
		$db = MySQL::getInstance();
		$sql = "select * from group_members where g_id = '$group_id'";
		return $db -> queryArr($sql);
	}

//
//返回小组的所有公告
//
	public function getGroupAnnouncement($group_id){
		$db = MySQL::getInstance();
		$sql = "select * from group_announcement where g_id = '$group_id'";
		return $db -> queryArr($sql);
	}

//
//发布公告
//
	public function setGroupAnnouncement($group_id){}

//
//返回小组的所有评论
//
	public function getGroupComment($group_id){
		$db = MySQL::getInstance();
		$sql = "select * from group_comment where g_id = '$group_id'";
		return $db -> queryArr($sql);
	}

//
//发表小组评论
//
	public function setGroupComment($group_id,$user_id,$comment){
		$db = MySQL::getInstance();
		$sql = "insert into group_comment(g_id,u_id,comment)
				values ('$group_id','$user_id','$comment')";
		$db -> query($sql);
		return $db -> affectRows();
	}

//
//回复小组评论
//
	public function answerGroupComment($group_id,$user_id,$ref_id,$comment){
		$db = MySQL::getInstance();
		$sql = "insert into group_comment(g_id,u_id,ref_id,comment)
				values ('$g_id','$u_id','$ref_id','$comment')";
		$db -> query($sql);
		return $db -> affectRows();
	}

//
//收藏小组
//
	public function collectGroup($group_id,$user_id){
		$db = MySQL::getInstance();
		$sql = "insert into user_group_collection(u_id,g_id)
				values ('$user_id','$group_id')";
		$db -> query($sql);
		return $db -> affectRows();
	}

//
//点赞小组
//
	public function praiseGroup($group_id,$user_id){
		$db = MySQL::getInstance();
		$sql = "insert into user_group_praise(g_id,u_id)
				values ('$group_id','$user_id')";
		$db -> query($sql);
		$flag1 = $db -> affectRows();
		$group_info = $this->getGroupInfo("group_id",$group_id);
		$popularity = $group_info["popularity"] + 1;
		$sql = "update groups set popularity = '$popularity' where g_id = '$group_id'";
		$db -> query($sql);
		$flag2 = $db -> affectRows();
		return $flag1 && $flag2;
	}

//
//创建小组，小组名和创建者的id必填，出发时间、返回时间以及目的地可以选填
//
	public function setGroup($group_name,$captain_id,$date1="",$date2="",$destination=""){
		$db = MySQL::getInstance();
		$sql = "insert into groups (g_name, captain_id, date1, date2, destination)
				values ('$group_name','$captain_id','$date1','$date2','$destination')";
		$db -> query($sql);
		if($db -> affectRows()){
			return true;
		}
		else
			return false;	
	}

//
//退出小组
//
	public function withdrawGroup($group_id,$user_id){
		$db = MySQL::getInstance();
		$sql = "delete from group_members where g_id = '$group_id' and m_id = '$user_id'";
		$db -> query($sql);
		return $db -> affectRows();
	}
	



}







?>