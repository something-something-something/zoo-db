<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../func/dept.php');
	require_once('../func/vend.php');
	EmplUser\restrictPageToPositions($db,['superUser','departmentManager','vendor']);
	require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'Vendor Salses','employee','vendor'); ?>
<form action="deptgrossvendorsales.php" method="POST">
	<h1>Enter Sales Amount</h1>
	Vendor: <?php echo Vendor\selectVendorInEmplDeptHTML($db,$_SESSION['EMPLID']); ?>
	<br>
	Day: <input type="date" name="day"><br>
	Sales Amount: <input type="number" value="" name="saleamount"><br>
	<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf"> <br>
	<input type="submit">
</form>
<?php Fancy\printFooter(); ?>