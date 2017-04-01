<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	/*visiting this page will print something if loged in*/
?>
<?php
	EmplUser\restrictPageToLoggedIn();
?>
you are logged in now. See <a href="employeelist.php">the employee list</a> if you are a superUser<br>
See <a href="createuserform.php">Create a User</a> if you are a superUser