<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../includes/checkcsrf.php');
	EmplUser\restrictPageToPositions($db,["superUser"]);
	require_once('../func/fancy.php');
?><?php
	if($_POST['dept']==='none'){
		$dept=NULL;
	}
	else{
		$dept=$_POST['dept'];
	}
// TODO add checks to make sure post data is okay
	$statment=$db->prepare("update Vendor set vendortype=?,vname=?,capacity=?,department=? where vendorID=?");
	echo $db->error;
	$statment->bind_param('ssiii',
	$_POST['type'],
	$_POST['name'],
	$_POST['capacity'],
	$dept,
	$_POST['id']
	);
	if($statment->execute()){
		header("Location: ./vendorlist.php");
		echo 'updated Vendor';
	}
	else{
		Fancy\printHeader($db,'Edit Vendor','employee','vendor');
		echo 'Failed to update Vendor';
		Fancy\printFooter();
	}
	$statment->close();
?>