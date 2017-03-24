<?php
require_once('includes/initses.php');
require_once('includes/aftersetup.php');
?>
<!doctype html>
<html>
	<head>
		<title>
		</title>
	</head>
	<body>
	<form action="login.php" method="POST">
		User name:<input type="text" name="user"></br>
		Password:<input type="password" name="pass"><br>
		<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf">
		<input type="submit">
	</form>
	</body>
</html>