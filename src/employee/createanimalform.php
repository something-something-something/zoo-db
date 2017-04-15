<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../func/dept.php');
	require_once('../func/hab.php');
	require_once('../func/fancy.php');
	EmplUser\restrictPageToPositions($db,['superUser']);
?>
<?php Fancy\printHeader($db,'Create an Animal','employee','animal'); ?>
<form action="createanimal.php" method="POST">
	Name: <input type="text" value="" name="name" required><br>
	Species: <input type="text" name="tax" required><br>
	DOB/Date Arrived: <input type="date" value="2010-01-19" name="dob"><br>
	Male<input type="radio" name="sex" value="m">
	Female<input type="radio" checked name="sex" value="f"><br>
	Department: <?php echo Dept\selectDeptHTML($db); ?><br>
	Enclosure: <?php echo Habitat\selectHabitatHTML($db); ?><br>
	<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf">

	<input type="submit">
</form>
<?php Fancy\printFooter(); ?>