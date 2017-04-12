<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,["superUser","ticketSeller"]);
	require_once('../includes/checkcsrf.php');
?>
<?php

$statment=$db->prepare("delete from grossvendorsales where id=? and day=?");
$statment->bind_param('is',$_POST['id'],$_POST['day']);
$statment->execute();
$statment->close();
header("Location: ./vendorsaleslist.php");
die();
?>