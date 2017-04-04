<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../includes/checkcsrf.php');
	EmplUser\restrictPageToPositions($db,["superUser"]);
?>
<?php

// TODO add checks to make sure post data is okay
	if($_POST['dept']==='none'){
		$dept=NULL;
	}
	else{
		$dept=$_POST['dept'];
	}
	$statment=$db->prepare("update Employee set firstName=?,lastName=?,eSsn=?,employeeDOB=?,position=?,employeeType=?,sex=?,employeeEmail=?,address=?,departmentID=? where employeeID=?");
	$statment->bind_param('sssssssssii',
	$_POST['fname'],
	$_POST['lname'],
	$_POST['ssn'],
	$_POST['dob'],
	$_POST['pos'],
	$_POST['type'],
	$_POST['sex'],
	$_POST['email'],
	$_POST['address'],
	$dept,
	$_POST['id']);
	if($statment->execute()){
		echo 'updated user';
	}
	else{
		echo 'Failed to update user';
	}
	$statment->close();
?>