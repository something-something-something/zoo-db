<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../func/dept.php');
	require_once('../func/vend.php');
	EmplUser\restrictPageToPositions($db,['superUser']);
	require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'Vendor Sales','employee','vendor'); ?>
<form action="grossvendorsales.php" method="POST">
	<h2>Enter Sales Amount</h2>
	Vendor: <?php echo Vendor\selectVendorHTML($db); ?>
	<br>
	Day: <input type="date" name="day"><br>
	Sales Amount: <input type="number" value="" name="saleamount" required><br>
	<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf"> <br>
	<input type="submit" value="Add New Sales">
</form>
<?php Fancy\printFooter(); ?>