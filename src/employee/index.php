<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../func/fancy.php');
	/*visiting this page will print something if loged in*/
?>
<?php
	EmplUser\restrictPageToLoggedIn();
?>
<?php Fancy\printHeader($db,'Welcome Employee','employee'); ?>
you are logged in now. <a href="/loginform.php">Logout</a><br>
See <a href="employeelist.php">the employee list</a> if you are a superUser<br>
See <a href="createuserform.php">Create a User</a> if you are a superUser<br>
See <a href="createdepartmentform.php">Create a Department</a> if you are a superUser<br>
See <a href="createanimalform.php">Create a Animal</a> if you are a superUser<br>
See <a href="createhabform.php">Create a Habitat</a> if you are a superUser<br>
See <a href="createvendorform.php">Create a Vendor</a> if you are a superUser<br>
See <a href="createsupplyform.php">Create Supplies</a> if you are a superUser<br>
See <a href="animallist.php">the animal list</a> if you are a superUser<br>
See <a href="deptlist.php">the Department list</a> if you are a superUser<br>
See <a href="hablist.php">the Habitat list</a> if you are a superUser<br>
See <a href="supplieslist.php">supplies list</a> if you are a superUser<br>
See <a href="deptsupplieslist.php">depart supplies list</a> if you are a superUserZookeeper or dept manager or quatermater<br>
See <a href="deptanimallist.php">the animal list</a> if you are a superUser,departmentManager, or zooKeeper<br>
<?php Fancy\printFooter(); ?>