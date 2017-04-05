<h2> Edit Your Information </h2>
<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../func/dept.php');
?>
<form action="editinfo.php" method="POST">
	Email: <input type="text" value="" name="email"><br>
	Address: <input type="text" name="address"><br>
	<?php echo Dept\selectDeptHTML($db); ?><br>
	<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf">
	<input type="submit">
</form>