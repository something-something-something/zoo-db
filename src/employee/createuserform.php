<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,['superUser']);
	require_once('../func/dept.php');
	require_once('../func/fancy.php');

?>
<?php Fancy\printHeader($db,'Employees','employee','employee'); ?>
<form action="createuser.php" method="POST">
	first name<input type="text" name="fname" value="John"><br>
	last name<input type="text" name="lname" value="Smith"><br>
	ssn<input type="text" name="ssn" value="234785567"><br>
	<label>Male</label><input type="radio" checked name="sex" value="m">
	<label>Female</label><input type="radio" name="sex" value="f"><br>
	username:<input type="text" value="jsmith" name="username"><br>
	Password:<input type="password" name="pass"><br>
	email:<input type="text" value="jsmith@example.com" name="email"><br>
	dob:<input type="date" value="2010-10-21" name="dob"><br>
	job<br>
	<?php echo EmplUser\selectPositionHTML(); ?>
	<br>
	<select required name="type">
		<option value="fullTime">full time</option>
		<option value="partTime">part time</option>
		<option value="volunteer">volunteer</option>
	</select>
	<br>
	<?php echo Dept\selectDeptHTML($db) ?>
	<br>
	<textarea name="address">12345 Some street</textarea><br>
	<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf">
	<input type="submit">
</form>
<?php Fancy\printFooter(); ?>