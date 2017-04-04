<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../includes/checkcsrf.php');
	EmplUser\restrictPageToPositions($db,["zooKeeper","departmentManager","superUser"]);
?>
<?php

// TODO add checks to make sure post data is okay
	$statment=$db->prepare("update Animals set Animals.Aname=?,Animals.taxonomy=?,Animals.animalDOB=?,Animals.sex=? where animalID=? and departmentID=(select departmentID from Employee where employeeID=?)");
	$statment->bind_param('ssssii',
	$_POST['name'],
	$_POST['tax'],
	$_POST['dob'],
	$_POST['sex'],
	$_POST['id'],
	$_SESSION['EMPLID']);
	if($statment->execute()){
		if($db->affected_rows>0){
			echo 'Updated animal';
		}
		else{
			echo 'failed to update animal';
		}
	}
	else{
		echo 'An error in executing';
	}
	$statment->close();
?>