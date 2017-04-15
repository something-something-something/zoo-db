<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../includes/checkcsrf.php');
	EmplUser\restrictPageToPositions($db,["superUser"]);
	require_once('../func/fancy.php');
	
?><?php

if(!$_POST['pass'] || !$_POST['pass1']) {
	Fancy\printHeader($db,'Employees','employee','employee');
	echo 'Error: All the fields must be filled! <a href="javascript:history.back()">Go Back</a>';
	Fancy\printFooter(); 
	die();

}
if($_POST['pass'] !== $_POST['pass1']) {
	Fancy\printHeader($db,'Employees','employee','employee');
	echo 'Error: Passwords do not match <a href="javascript:history.back()">Go Back</a>';
	Fancy\printFooter(); 
	die();
}


	$statment=$db->prepare("UPDATE EmployeeUsers SET password =? WHERE employeeid=?");
	$statment->bind_param('si',password_hash($_POST['pass'], PASSWORD_DEFAULT),$_POST['id']);
	$statment->execute();
	header( 'refresh:3; url=employeelist.php' ); //waits for 3 seconds before redirecting
	echo 'Password successfully changed';

$db->close();

?>
