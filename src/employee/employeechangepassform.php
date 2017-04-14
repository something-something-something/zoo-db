<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../func/dept.php');
	EmplUser\restrictPageToLoggedIn();
	require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'Employee Password Change Page','employee','self'); ?>

<form action="employeechangepass.php" method="POST">
	New Password: <input type="password" name="pass"><br>
  Confirm Password: <input type="password" name="pass1"><br>
	<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf">
	<input type="submit">
</form>
<?php Fancy\printFooter(); ?>