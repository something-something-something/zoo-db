<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,['superUser']);
	require_once('../includes/checkcsrf.php');
	require_once('../func/fancy.php');
?><?php
//TODO Validate posts
if(!isset($_POST['name'])){
	die();
}
$statment=$db->prepare("insert into Department values(DEFAULT,?)");
$statment->bind_param('s',$_POST['name']);
if($statment->execute()){
	header("Location: ./deptlist.php");
	echo 'added Department';
}
else{
	Fancy\printHeader($db,'Create Department','employee','dept');
	echo 'could not add Department';
	Fancy\printFooter();
}
$statment->close();
	
?>
