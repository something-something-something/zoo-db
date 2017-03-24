<?php
namespace EmplUser{
	function add($db,$id,$username,$password,$fn,$ln,$ssn,$dob,$pos,$type,$sex,$email,$addr,$dID,$sID){
		$db->query("lock tables Users,Employee write");
		
		$statment=$db->prepare("select username from Users where username=?");
		if(!$statment){
			$db->query("unlock tables");
			return false;
		}
		$statment->bind_param('s',$username);
		if(!$statment->execute()){
			$db->query("unlock tables");
			return false;
		}
		$statment->bind_result($alreadyusedname);

		if($statment->fetch()){
			$db->query("unlock tables");
			return false;
		}
		$statmentET=$db->prepare("insert into Employee values(?,?,?,?,?,?,?,?,?,?,?,?)");
		if(!$statmentET){
			$db->query("unlock tables");
			return false;
		}
		$statmentET->bind_param('ssssssssssss',$id,$fn,$ln,$ssn,$dob,$pos,$type,$sex,$email,$addr,$dID,$sID);
		
		if(!$statmentET->execute()){
			$db->query("unlock tables");
			return false;
		}
		$statmentUT=$db->prepare("insert into Users values(?,?,?,?)");
		if(!$statmentUT){
			$db->query("unlock tables");
			return false;
		}

		$memID=NULL;
		$statmentUT->bind_param('ssss',$username,password_hash($password,PASSWORD_DEFAULT),$id,$memID);
		if(!$statmentUT->execute()){
			$db->query("unlock tables");
			return false;
		}
		$db->query("unlock tables");
		return true;
	}
	function getUserName($db,$id){
		$statment->$db->prepare("select username from Users where employeeID=?");
		if(!$statment){
			return false;
		}
		$statment->bind_param('s',$id);
		if(!$statment->execute()){
			return false;
		}
		$statment->bind_result($uname);
		if(!$statment->fetch()){
			return false;
		}
		else{
			return $uname;
		}
	}
	function validatePassword($db,$username,$password){
		$statment=$db->prepare("select password from Users where username=?");
		$statment->bind_param('s',$username);
		if(!$statment->execute()){
			return false;
		}
		$statment->bind_result($hpass);
		if(!$statment->fetch()){
			return false;
		}
		return password_verify($password,$hpass);
	}
	function getIDFromUserName($db,$username){
		$statment=$db->prepare("select employeeID from Users where username=?");
		$statment->bind_param('s',$username);
		if(!$statment->execute()){
			return false;
		}
		$statment->bind_result($id);
		if(!$statment->fetch()){
			return false;
		}
		return $id;
	}
	function loggedIn(){
		return isset($_SESSION['EMPLID'])&&$_SESSION['EMPLID']!==NULL;
	}
	function restrictPageToLoggedIn(){
		if(!loggedIn()){
			die();
		}
	}
	function restrictPageToPositions($db,$positions){
		if(!loggedIn()){
			die();
		}
		$statment=$db->prepare("select position from Employee where employeeID=?");
		$statment->bind_param('s',$_SESSION['EMPLID']);
		if(!$statment->execute()){
			die();
		}
		$statment->bind_result($userposition);
		if(!$statment->fetch()){
			die();
		}

		$hasApprovedPosition=false;
		foreach($positions as $pos){
			if($pos===$userposition){
				$hasApprovedPosition=true;
			}
		}
		if(!$hasApprovedPosition){
			die();
		}
	}
}
?>