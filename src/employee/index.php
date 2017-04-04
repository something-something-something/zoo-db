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
See <a href="createuserform.php">Create a User</a> if you are a superUser<br>
See <a href="createdepartmentform.php">Create a Department</a> if you are a superUser<br>
See <a href="createanimalform.php">Create a Animal</a> if you are a superUser<br>
See <a href="createhabform.php">Create a Habitat</a> if you are a superUser<br>
See <a href="animallist.php">the animal list</a> if you are a superUser<br>
See <a href="deptlist.php">the Department list</a> if you are a superUser<br>
