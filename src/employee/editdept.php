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
	$statment=$db->prepare("update Department set name=? where departmentID=?");
	$statment->bind_param('si',
	$_POST['name'],
	$_POST['id']
	);
	if($statment->execute()){
		echo 'updated Department';
	}
	else{
		echo 'Failed to update Department';
	}
	$statment->close();
?>