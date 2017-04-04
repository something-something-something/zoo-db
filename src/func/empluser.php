<?php
namespace EmplUser{
	const POSITIONS=[['zooKeeper','Zoo Keeper'],['waiter','Waiter'],['cook','Cook'],['guide','Guide'],['cashier','Cashier'],['superUser','Super User'],['ticketSeller','Ticket Salesperson'],['quarterMaster','Quarter Master'],['departmentManager','Department Manager'],['vendor','Vendor'],['bookKeeper','Book Keeper']];
	const TYPES=[['fullTime','Full Time'],['partTime','Part Time'],['volunteer','Volunteer']];
	/*for all the below functions $db is the databse connection*/
	
	/* adds an employee user some of these if statments are probaly excesive*/
	function add($db,$username,$password,$fn,$ln,$ssn,$dob,$pos,$type,$sex,$email,$addr,$dID,$sID){
		/* Locks the tables not 100% sure this syntax is right
		seems they do not suport prepared statments.
		Done to make sure that no user names are added that could conflit with the one we are trying to add affter we make sure it is avalible
		returns true on sucsess and false on faliure.
		*/

		$db->query('lock tables EmployeeUsers write, Employee write');

		/* checks if username is already used exists 
		*/
		$statment=$db->prepare("select username from EmployeeUsers where username=?");
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
			$statment->close();
			$db->query("unlock tables");
			return false;
		}
		$statment->close();
		/*insert employee into employee table
		*/
		$statmentET=$db->prepare("insert into Employee values(DEFAULT,?,?,?,?,?,?,?,?,?,?,?)");
		if(!$statmentET){
			$db->query("unlock tables");
			return false;
		}
		$statmentET->bind_param('sssssssssss',$fn,$ln,$ssn,$dob,$pos,$type,$sex,$email,$addr,$dID,$sID);
		
		if(!$statmentET->execute()){
			$statmentET->close();
			$db->query("unlock tables");
			return false;
		}
		$statmentET->close();
		/*insert employee into user table  
		*/
		$statmentUT=$db->prepare("insert into EmployeeUsers values(?,?,LAST_INSERT_ID())");
		if(!$statmentUT){
			$db->query("unlock tables");
			return false;
		}
		$statmentUT->bind_param('ss',$username,password_hash($password,PASSWORD_DEFAULT));
		if(!$statmentUT->execute()){
			$statmentUT->close();
			$db->query("unlock tables");
			return false;
		}
		$statmentUT->close();
		$db->query("unlock tables");
		return true;
	}
	/* gets a user name from the employee id returns the username or false on faliure*/
	function getUserName($db,$id){
		$statment->$db->prepare("select username from EmployeeUsers where employeeID=?");
		if(!$statment){
			return false;
		}
		$statment->bind_param('i',$id);
		if(!$statment->execute()){
			$statment->close();
			return false;
		}
		$statment->bind_result($uname);
		if(!$statment->fetch()){
			$statment->close();
			return false;
		}
		else{
			$statment->close();
			return $uname;
		}
	}
	/*validates the password matches the hash for a user*/
	function validatePassword($db,$username,$password){
		$statment=$db->prepare("select password from EmployeeUsers where username=?");
		$statment->bind_param('s',$username);
		if(!$statment->execute()){
			$statment->close();
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
	/*gets the id from anemplyee username returns false on faliure (might want to handle null employeeid's')*/
	function getIDFromUserName($db,$username){
		$statment=$db->prepare("select employeeID from EmployeeUsers where username=?");
		$statment->bind_param('s',$username);
		if(!$statment->execute()){
			$statment->close();
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
	/*returns true if logedin or false if not loggedin*/
	function loggedIn(){
		return isset($_SESSION['EMPLID'])&&$_SESSION['EMPLID']!==NULL;
	}
	/*nothing below a call to this function will be run if not logged in as employee*/
	function restrictPageToLoggedIn(){
		if(!loggedIn()){
			header('Location: /loginform.php');
			die();
		}
	}
	/* $positions is an array of strings
	nothing below a call to this function will be run if the user is not loged in and a member of at least one position in $positions  */
	function restrictPageToPositions($db,$positions){
		if(!loggedIn()){
			header('Location: /loginform.php');
			die();
		}
		$statment=$db->prepare("select position from Employee where employeeID=?");
		$statment->bind_param('i',$_SESSION['EMPLID']);
		if(!$statment->execute()){
			$statment->close();
			die();
		}
		$statment->bind_result($userposition);
		if(!$statment->fetch()){
			$statment->close();
			die();
		}

		$hasApprovedPosition=false;
		foreach($positions as $pos){
			if($pos===$userposition){
				$hasApprovedPosition=true;
			}
		}
		if(!$hasApprovedPosition){
			$statment->close();
			header('Location: /loginform.php');
			die();
		}
		$statment->close();
	}
	function selectPositionHTML($posSelected='superUser',$name='pos'){
		$positionSelectHTML='<select required name="'.$name.'">';
		foreach(POSITIONS as $posOp){
			if($posSelected===$posOp[0]){
				$positionSelectHTML.='<option selected value="'.$posOp[0].'">'.$posOp[1].'</option>';	
			}
			else{
				$positionSelectHTML.='<option value="'.$posOp[0].'">'.$posOp[1].'</option>';
			}
		}
		return $positionSelectHTML.'</select>';
	}
	function selectTypeHTML($typeSelected='fullTime',$name='type'){
		$typeSelectHTML='<select required name="'.$name.'">';
		foreach(TYPES as $typeOp){
			if($typeSelected===$typeOp[0]){
				$typeSelectHTML.='<option selected value="'.$typeOp[0].'">'.$typeOp[1].'</option>';	
			}
			else{
				$typeSelectHTML.='<option value="'.$typeOp[0].'">'.$typeOp[1].'</option>';
			}
		}
		return $typeSelectHTML.'</select>';
	}
}
?>