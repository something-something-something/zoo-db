<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/memuser.php');
  MemUser\restrictPageToLoggedIn();
	/*visiting this page will print something if logged in*/
?>
<h2> Member Password Change Page </h2>

<?php
?>

<form action="membershipchangepass.php" method="POST">
	New Password: <input type="password" name="pass"><br>
  Confirm Password: <input type="password" name="pass1"><br>
	<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf">
	<input type="submit">
</form>
