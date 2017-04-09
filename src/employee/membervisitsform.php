<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	
	$today = date('Y\-m\-d');
?>
<form action="membervisitsreport.php" method="POST">
	From Date (yyyy-mm-dd)<br>
		<input type="date" value="<?php echo $today;?>" name="startDate"><br>
	End Date (yyyy-mm-dd)<br>
		<input type="date" value="<?php echo $today;?>" name="endDate"><br>
	
	<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf">
	<input type="submit">
</form>
