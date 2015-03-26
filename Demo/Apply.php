<?php
namespace Demo;
include_once("../Configuration/MySQL.php");
use Configuration\MySQL;


class Apply{

//
//获取所有申请
//$uc_id = $user_id || $captain_id
//
	public function getAllApply($key,$uc_id){
		$db = MySQL::getInstance();
		switch ($key) {
			case 'friend':
				$sql = "select * from friend_apply_box where u_id = '$uc_id'";
				return $db -> queryArr($sql);
			
			case 'group':
				$sql = "select * from group_apply_box where captain_id = '$uc_id'";
				return $db -> queryArr($sql);
		}
	}



//
//好友申请 
//
	public function sendFriendApply($f_id,$u_id,$descritpion=""){
		$db = MySQL::getInstance();
		$sql = "insert into friend_apply_box(f_id,u_id,apply_description)
				values('$f_id','$u_id','$descritpion')";
		$db -> query($sql);
		if($db -> affectRows()){
			return true;
		}
		else return false;			
	}

//
//小组申请
//
	public function sendGroupApply($f_id,$group_id,$descritpion=""){
		$db = MySQL::getInstance();
		$sql = "insert into group_apply_box(f_id,g_id,apply_description)
				values('$f_id','$group_id','$descritpion')";
		$db -> query($sql);
		if($db -> affectRows()){
			return true;
		}
		else return false;
	}

//
//对apply的操作(op)，包括 查看(view)，删除(delete)，同意(agree)，拒绝(reject)
//$uc_id = $user_id || $captain_id
//
	public function operateApply($key,$uc_id,$apply_id,$op){
		$db = MySQL::getInstance();
		switch ($key) {
			case 'friend':
				$this -> stateChange($key,$apply_id);
				if($op == "view"){
					return $this -> getApply($key,$apply_id);
				}
				if($op == "delete"){
					return $this -> deleteApply($key,$apply_id);
				}
				if($op == "agree"){
					return $this -> agreeApply($key,$apply_id);
				}
				if($op == "reject"){
					return $this -> rejectApply($key,$apply_id);
				}
			
			case 'group':
				$this -> stateChange($key,$apply_id);
				if($op == "view"){
					return $this -> getApply($key,$apply_id);
				}
				if($op == "delete"){
					return $this -> deleteApply($key,$apply_id);
				}
				if($op == "agree"){
					return $this -> agreeApply($key,$apply_id);
				}
				if($op == "reject"){
					return $this -> rejectApply($key,$apply_id);
				}
		}

	}


//
//获得一条申请
//
	private function getApply($key,$apply_id){
		$db = MySQL::getInstance();
		switch ($key) {
			case 'friend':
				$sql = "select * from friend_apply_box where id = '$apply_id'";
				return $db -> query($sql);
			
			case 'group':
				$sql = "select * from group_apply_box where id = '$apply_id'";
				return $db -> query($sql);
		}
	}

//
//删除一条申请
//
	private function deleteApply($key,$apply_id){
		$db = MySQL::getInstance();
		switch ($key) {
			case 'friend':
				$sql = "delete from friend_apply_box where id = '$apply_id'";
				$db -> query($sql);
				return $db -> affectRows();
			
			case 'group':
				$sql = "delete from group_apply_box where id = '$apply_id'";
				$db -> query($sql);
				return $db -> affectRows();
		}

	}

//
//同意一条申请
//
	private function agreeApply($key,$apply_id){
		$db = MySQL::getInstance();
		switch ($key) {
			case 'friend':
				$temp = $this -> getApply($key,$apply_id);
				$f_id = $temp["f_id"];
				$u_id = $temp["u_id"];
				$sql = "insert into user_friends(u_id,f_id)
						values('$u_id','$f_id')";
				$db -> query($sql);
				$flag1 = $db -> affectRows();
				$sql = "insert into user_friends(u_id,f_id)
						values('$f_id','$u_id')";
				$db -> query($sql);
				$flag2 = $db -> affectRows();
				if($flag1 && $flag2){
					return true;
				}
				else return false;
			
			case 'group':
				$temp = $this -> getApply($key,$apply_id);
				$f_id = $temp["f_id"];
				$g_id = $temp["g_id"];
				$sql = "insert into group_members(g_id,m_id)
						values('$g_id','$f_id')";
				$db -> query($sql);
				return $db -> affectRows();
		}

	}

//
//拒绝一条申请
//拒绝申请后，暂时设定被拒绝的人不会收到任何提醒
//此条申请也会被收到申请的人删除
//
	private function rejectApply($key,$apply_id){
		$db = MySQL::getInstance();
		switch ($key) {
			case 'friend':
				$sql = "delete from friend_apply_box where id = '$apply_id'";
				$db -> query($sql);
				return $db -> affectRows();
			
			case 'group':
				$sql = "delete from group_apply_box where id = '$apply_id'";
				$db -> query($sql);
				return $db -> affectRows();
		}
	}

//
//首先检查两个apply表中state状态
//state=0 apply未处理
//state=1 apply已处理
//如果state=1，则不进行操作
//如果state=0，则将改为state=1
//没有跟改操作或者跟改失败，都返回false
//
	private function stateChange($key,$apply_id){
		$db = MySQL::getInstance();
		switch ($key) {
			case 'friend':
				$sql = "select * from friend_apply_box where id = '$apply_id'";
				$temp = $db -> query($sql);
				if($temp["state"] == 0){
					$sql = "update friend_apply_box set state = '1' where id = '$apply_id'";
					$db -> query($sql);
					return $db -> affectRows();
				}
				else return false;

			case 'group':
				$sql = "select * fron group_apply_box where id = '$apply_id'";
				$temp = $db -> query($sql);
				if($temp["state"] == 0){
					$sql = "update group_apply_box set state = '1' where id = '$apply_id'";
					$db -> query($sql);
					return $db -> affectRows();
				}
				else return false;
		}
	}




}



?>