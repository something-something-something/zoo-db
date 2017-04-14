<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../func/fancy.php');
	EmplUser\restrictPageToPositions($db,["superUser","ticketSeller"]);
	require_once('../includes/checkcsrf.php');
?><?php Fancy\printHeader($db,'Delete Member Visit','employee'); ?>
<?php
echo $_POST['id'].' '.$_POST['timestamp'];
$statment=$db->prepare("delete from MemberVisits where mid=? and timestamp=?");

$statment->bind_param('is',$_POST['id'],$_POST['timestamp']);
$statment->execute();

$statment->close();
?>
deleted ticket
<?php Fancy\printFooter(); ?>