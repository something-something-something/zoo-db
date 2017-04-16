<?php
	require_once('includes/initses.php');
	require_once('includes/beforesetup.php');
?>
<!doctype html>
<html>
	<head>
		<title>
		</title>
	</head>
	<body>
	<form action="setup.php" method="POST">
		Database host:<input type="text" name="host"><br>
		User name:<input type="text" name="user"></br>
		Password:<input type="password" name="pass"><br>
		Database name:<input type="text" name="dbname"><br>
		<br>New Employee Details<br>
		first Name::<input type="text" name="fname"><br>
		last name:<input type="text" name="lname"><br>
		<!--id:<input type="text" value="0" name="id"><br>-->
		username:<input type="text" name="emplusername"><br>
		Password:<input type="password" name="emplpass"><br>
		sex:<input type="text" value="m" name="sex"><br>
		ssn:<input type="text" value="123456789" name="ssn"><br>
		email:<input type="text" value="r@example.com" name="email"><br>
		address:<input type="text" value="1234 Some St" name="addr"><br>
		dob:<input type="date" value="2010-10-21" name="dob"><br>
		<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf">
		<input type="submit">
	</form>
	</body>
</html>
