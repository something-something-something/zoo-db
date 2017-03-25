<?php
namespace EmplUser{
	/*for all the below functions $db id=s the databse connection*/
	
	/* adds an employee user some of these if statments are probaly excesive*/
	function add($db,$id,$username,$password,$fn,$ln,$ssn,$dob,$pos,$type,$sex,$email,$addr,$dID,$sID){
		/* Locks the tables not 100% sure tis syntax is right
		Done to make sure that no user names are added that could conflit with the one we are trying to add affter we make sure it is avalible
		returns true on sucsess and false on faliure.
		*/
		$db->query("lock tables Users,Employee write");
		/* checks if username is already used exists 
		*/
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
		/*if there are any results then the username is already in use*/
		if($statment->fetch()){
			$db->query("unlock tables");
			return false;
		}
		/*insert employee into employee table
		*/
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
		/*insert employee into user table  
		*/
		$statmentUT=$db->prepare("insert into Users values(?,?,?,?)");
		if(!$statmentUT){
			$db->query("unlock tables");
			return false;
		}
		/* Seems php does not like directly putting NULLs into bind_param() */
		$memID=NULL;
		$statmentUT->bind_param('ssss',$username,password_hash($password,PASSWORD_DEFAULT),$id,$memID);
		if(!$statmentUT->execute()){
			$db->query("unlock tables");
			return false;
		}
		$db->query("unlock tables");
		return true;
	}
	/* gets a user name from the employee id returns the username or false on faliure*/
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
	/*validates the password matches the hash for a user*/
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
	/*gets the id from anemplyee username returns false on faliure (might want to handle null employeeid's')*/
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
	/*returns true if logedin or false if not loggedin*/
	function loggedIn(){
		return isset($_SESSION['EMPLID'])&&$_SESSION['EMPLID']!==NULL;
	}
	/*nothing below a call to this function will be run if not logged in as employee*/
	function restrictPageToLoggedIn(){
		if(!loggedIn()){
			die();
		}
	}
	/* $positions is an array of strings
	nothing below a call to this function will be run if the user is not loged in and a member of at least one position in $positions  */
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