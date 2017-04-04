<?php
namespace MemUser{
	function add($db,$username,$password,$fn,$ln,$dob,$sex,$email,$addr,$phone){
		$db->query('lock tables Members write,MemberUsers write');

		$statment=$db->prepare('select username from MemberUsers where username=?');
		if(!$statment){
			$db->query('unlock tables');
			return false;
		}
		$statment->bind_param('s',$username);
		if(!$statment->execute()){
			$db->query("unlock tables");
			return false;
		}
		$statment->bind_result($alreadyusedname);
		/*if there are any results then the username is already in use*/
		if($statment->fetch()){
			$statment->close();
			$db->query("unlock tables");
			return false;
		}
		$statment->close();
		/*insert member into members table
		*/
		$statmentMT=$db->prepare("insert into Members values(DEFAULT,?,?,?,?,?,?,?)");
		if(!$statmentMT){
			$db->query("unlock tables");
			return false;
		}
		$statmentMT->bind_param('sssssss',$fn,$ln,$dob,$sex,$email,$addr,$phone);
		
		if(!$statmentMT->execute()){
			$db->query("unlock tables");
			return false;
		}
		$statmentMT->close();
		/*insert member into memberuser table  
		*/
		$statmentUT=$db->prepare("insert into MemberUsers values(?,?,LAST_INSERT_ID())");
		if(!$statmentUT){
			$db->query("unlock tables");
			return false;
		}
		$statmentUT->bind_param('ss',$username,password_hash($password,PASSWORD_DEFAULT));
		if(!$statmentUT->execute()){
			$db->query("unlock tables");
			return false;
		}
		$statmentUT->close();
		$db->query("unlock tables");
		return true;
	}
	function validatePassword($db,$username,$password){
		$statment=$db->prepare("select password from MemberUsers where username=?");
		$statment->bind_param('s',$username);
		if(!$statment->execute()){
			return false;
		}
		$statment->bind_result($hpass);
		if(!$statment->fetch()){
			$statment->close();
			return false;
		}
		$statment->close();
		return password_verify($password,$hpass);
	}
	function getIDFromUserName($db,$username){
		$statment=$db->prepare("select memberID from MemberUsers where username=?");
		$statment->bind_param('s',$username);
		if(!$statment->execute()){
			return false;
		}
		$statment->bind_result($id);
		if(!$statment->fetch()){
			$statment->close();
			return false;
		}
		$statment->close();
		return $id;
	}
	function loggedIn(){
		return isset($_SESSION['MEMID'])&&$_SESSION['MEMID']!==NULL;
	}
	/*nothing below a call to this function will be run if not logged in as employee*/
	function restrictPageToLoggedIn(){
		if(!loggedIn()){
			header('Location: /memloginform.php');
			die();
		}
	}
}
?>