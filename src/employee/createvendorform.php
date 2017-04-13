<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../func/dept.php');
	EmplUser\restrictPageToPositions($db,['superUser']);
	require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'Add Vendor','employee','vendor'); ?>
<form action="createvendor.php" method="POST">
	Type of Vendor: 
	<select name="type">
  		<option value="food">Food</option>
  		<option value="retail">Retail</option>
  		<option value="ride">Ride</option>
	</select><br>
	Name: <input type="text" value="" name="name"><br>
	Capacity: <input type="number" value="" name="capacity"><br>
	<?php echo Dept\selectDeptHTML($db); ?><br>
	<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf">
	<input type="submit">
</form>
<?php Fancy\printFooter(); ?>