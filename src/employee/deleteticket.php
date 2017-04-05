<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,["superUser","ticketSeller"]);
	require_once('../includes/checkcsrf.php');
?>
<?php

$statment=$db->prepare("delete from Tickets where serialnumber=?");
$statment->bind_param('i',$_POST['num']);
$statment->execute();
$statment->close();
?>
Note this page does not currentl tell if the ticket deletion was sucessfull.