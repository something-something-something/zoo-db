<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../func/dept.php');
	EmplUser\restrictPageToPositions($db,['superUser']);
?>
<form action="createanimal.php" method="POST">
	name: <input type="text" value="" name="name"><br>
	Taxonomy: <input type="text" name="tax"><br>
	dob: <input type="date" value="2010-01-19" name="dob"><br>
	Male<input type="radio" name="sex" value="m">
	Female<input type="radio" checked name="sex" value="f"><br>
	<?php echo Dept\selectDeptHTML($db); ?><br>
	<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf">
	<input type="submit">
</form>
