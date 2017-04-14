<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../includes/checkcsrf.php');
		EmplUser\restrictPageToPositions($db,["superUser","quarterMaster","zooKeeper","departmentManager","vendor"]);
		require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'Equipment And Supplies','employee'); ?>
<?php

// TODO add checks to make sure post data is okay
	
	$statment=$db->prepare("update EquipmentAndSupplies set esname=?,estype=?,esquantity=? where esid=? and department=(select departmentid from Employee where employeeid=?)");
	echo $db->error;
	$statment->bind_param('ssiii',
	$_POST['name'],
	$_POST['type'],
	$_POST['quantity'],
	$_POST['id'],
	$_SESSION['EMPLID']);
	if($statment->execute()){
		if($statment->affected_rows>0){
			echo 'updated supply';
		}
		else{
			echo 'Failed to update supply';
		}
	}
	else{
		echo 'Failed to update supply';
	}
	$statment->close();
?>
<?php Fancy\printFooter(); ?>