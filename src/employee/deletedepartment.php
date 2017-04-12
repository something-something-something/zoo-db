<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,["superUser","ticketSeller"]);
	require_once('../includes/checkcsrf.php');
?>
<?php

$statment=$db->prepare("delete from department where departmentID=?");
$statment->bind_param('i',$_POST['id']);
$statment->execute();
$statment->close();
header("Location: ./deptlist.php");
die();
?>