<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../includes/checkcsrf.php');
	EmplUser\restrictPageToPositions($db,["superUser"]);
	require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'Equipment And Supplies','employee','sup'); ?>
<?php

// TODO add checks to make sure post data is okay
	if($_POST['dept']==='none'){
		$dept=NULL;
	}
	else{
		$dept=$_POST['dept'];
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
<?php Fancy\printFooter(); ?>