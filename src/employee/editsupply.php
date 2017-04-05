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
	if($_POST['habitat']==='none'){
		$hab=NULL;
	}
	else{
		$hab=$_POST['habitat'];
	}
	$statment=$db->prepare("update EquipmentAndSupplies set esname=?,estype=?,esquantity=?,department=? where esid=?");
	$statment->bind_param('ssiii',
	$_POST['name'],
	$_POST['type'],
	$_POST['quantity'],
	$dept,
	$_POST['id']);
	if($statment->execute()){
		echo 'updated supply';
	}
	else{
		echo 'Failed to update supply';
	}
	$statment->close();
?>