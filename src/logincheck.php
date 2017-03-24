<?php
	require_once('includes/initses.php');
	require_once('includes/aftersetup.php');
	require_once('includes/mysqlcon.php');
	require_once('func/empluser.php');
?>
<?php
	EmplUser\restrictPageToLoggedIn();
?>


you are logged in now