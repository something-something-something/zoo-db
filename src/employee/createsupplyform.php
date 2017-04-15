<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../func/dept.php');
	EmplUser\restrictPageToPositions($db,['superUser']);
	require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'New Equipment or Supply','employee','sup'); ?>
<form action="createsupply.php" method="POST">
<h2>New Inventory Information</h2>
	Name: <input type="text" value="" name="name"><br>
	Type of Supply:
	<select name="type">
  		<option value="small-tools">Small Tools</option>
  		<option value="large-tools">Large Tools</option>
  		<option value="human-food-meat">Human Food - Meat</option>
  		<option value="vehicle">Vehicle</option>
  		<option value="human-food-vegtable">Human Food - Vegetable</option>
  		<option value="animal-food-meat">Animal Food - Meat</option>
  		<option value="animal-food-vegtable">Animal Food - Vegetable</option>
	</select><br>
	Quantity: <input type="number" value="0" name="quantity"><br>
	Department: <?php echo Dept\selectDeptHTML($db); ?><br>
	<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf">
	<input type="submit" value="Add Inventory">
</form>
<?php Fancy\printFooter(); ?>