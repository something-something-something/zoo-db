<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../func/dept.php');
	EmplUser\restrictPageToLoggedIn();
?>
<h2> Employee Password Change Page </h2>

<?php
?>

<form action="employeechangepass.php" method="POST">
	New Password: <input type="password" name="pass"><br>
  Confirm Password: <input type="password" name="pass1"><br>
	<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf">
	<input type="submit">
</form>
