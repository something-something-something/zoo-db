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
	$statment=$db->prepare("update Animals set Aname=?,taxonomy=?,animalDOB=?,sex=?,departmentID=? where animalID=?");
	$statment->bind_param('ssssii',
	$_POST['name'],
	$_POST['tax'],
	$_POST['dob'],
	$_POST['sex'],
	$dept,
	$_POST['id']);
	if($statment->execute()){
		echo 'updated animal';
	}
	else{
		echo 'Failed to update animal';
	}
	$statment->close();
?>