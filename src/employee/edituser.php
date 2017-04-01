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
	$statment=$db->prepare("update Employee set firstName=?,lastName=?,eSsn=?,employeeDOB=?,position=?,employeeType=?,sex=?,employeeEmail=?,address=? where employeeID=?");
	$statment->bind_param('sssssssssi',
	$_POST['fname'],
	$_POST['lname'],
	$_POST['ssn'],
	$_POST['dob'],
	$_POST['pos'],
	$_POST['type'],
	$_POST['sex'],
	$_POST['email'],
	$_POST['address'],
	$_POST['id']);
	if($statment->execute()){
		echo 'updated user';
	}
	else{
		echo 'Failed to update user';
	}
?>