<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/memuser.php');
  require_once('../includes/checkcsrf.php');
  MemUser\restrictPageToLoggedIn();
	/*visiting this page will print something if logged in*/
?><?php

if(!$_POST['pass'] || !$_POST['pass1']) {
	header( 'location: membershipchangepassform.php');
	echo 'Error: All the fields must be filled!';
		die();

}
if($_POST['pass'] !== $_POST['pass1']) {
	header( 'location: membershipchangepassform.php');
	echo 'Error: Passwords do not match';
	die();
}

	$statment=$db->prepare("UPDATE MemberUsers SET password = ? WHERE memberid=? ");
	$statment->bind_param('si',password_hash($_POST['pass'], PASSWORD_DEFAULT),$_SESSION['MEMID']);
	$statment->execute();
	header( 'refresh:3; url=index.php' ); //waits for 3 seconds before redirecting
	echo 'Password successfully changed';

	

$db->close();

?>
