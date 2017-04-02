<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/memuser.php');
	/*visiting this page will print something if loged in*/
?>
<?php
	MemUser\restrictPageToLoggedIn();
?>
you are logged in now.