<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../func/dept.php');
	EmplUser\restrictPageToPositions($db,['superUser']);
?>
<form action="grossvendorsales.php" method="POST">
	<h1>Enter Sales Amount</h1>
	Vendor ID: <input type="number" name="id"><br>
	Day: <input type="date" name="day"><br>
	Sales Amount: <input type="number" value="" name="saleamount"><br>
	<?php echo Dept\selectDeptHTML($db); ?><br>
	<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf"> <br>
	<input type="submit">
</form>
