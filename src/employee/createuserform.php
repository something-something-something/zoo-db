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
	First Name<input type="text" name="fname" value="John" required><br>
	Last Name<input type="text" name="lname" value="Smith" required><br>
	SSN<input type="text" name="ssn" value="234785567" required><br>
	<label>Male</label><input type="radio" checked name="sex" value="m">
	<label>Female</label><input type="radio" name="sex" value="f"><br>
	Username:<input type="text" value="jsmith" name="username" required><br>
	Password:<input type="password" name="pass" required><br>
	Email:<input type="text" value="jsmith@example.com" name="email" required><br>
	DOB:<input type="date" value="2010-10-21" name="dob"><br>
	Job<br>
	<?php echo EmplUser\selectPositionHTML(); ?>
	<br>
	<select required name="type">
		<option value="fullTime">full time</option>
		<option value="partTime">part time</option>
		<option value="volunteer">volunteer</option>
	</select>
	<br>
	Department: <?php echo Dept\selectDeptHTML($db) ?>
	<br>
	Address<br> <textarea name="address" required>12345 Some street</textarea><br>
	<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf">
	<input type="submit">
</form>
<?php Fancy\printFooter(); ?>