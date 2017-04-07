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
	$statment=$db->prepare("update Members set firstName=?,lastName=?,memberDOB=?, membersex=?,memberEmail=?,memberaddress=?,memberphone=? where memberID=?");
	$statment->bind_param('sssssssi',
	$_POST['fname'],
	$_POST['lname'],
	$_POST['dob'],
	$_POST['sex'],
	$_POST['email'],
	$_POST['address'],
	$_POST['phone'],
	$_POST['id']);
	if($statment->execute()){
		echo 'updated user';
	}
	else{
		echo 'Failed to update user';
	}
	$statment->close();
?>