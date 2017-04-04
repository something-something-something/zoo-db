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
	$statment=$db->prepare("update Habitats set Htype=?,Hname=?,status=? where HabitatID=?");
	$statment->bind_param('sssi',
	$_POST['type'],
	$_POST['name'],
	$_POST['status'],
	$_POST['id']
	);
	if($statment->execute()){
		echo 'updated Habitat';
	}
	else{
		echo 'Failed to update Habitat';
	}
	$statment->close();
?>