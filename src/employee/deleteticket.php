<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../func/fancy.php');
	EmplUser\restrictPageToPositions($db,["superUser","ticketSeller"]);
	require_once('../includes/checkcsrf.php');
?><?php
$statment=$db->prepare("delete from Tickets where serialnumber=?");
$statment->bind_param('i',$_POST['num']);
$statment->execute();
$statment->close();
header("Location: ./tickets.php");
?>