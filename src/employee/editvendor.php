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
	$statment=$db->prepare("update Vendor set vendortype=?,vname=?,capacity=? where vendorID=?");
	echo $db->error;
	$statment->bind_param('ssii',
	$_POST['type'],
	$_POST['name'],
	$_POST['capacity'],
	$_POST['id']
	);
	if($statment->execute()){
		echo 'updated Vendor';
	}
	else{
		echo 'Failed to update Vendor';
	}
	$statment->close();
?>