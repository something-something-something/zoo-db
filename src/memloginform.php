<?php
require_once('includes/initses.php');
require_once('includes/aftersetup.php');
require_once('func/memuser.php');
?>
<?php
if(!memUser\loggedIn()){
?>
<!doctype html>
<html>
	<head>
		<title>
		</title>
	</head>
	<body>MEMBER LOGIN
	<form action="memlogin.php" method="POST">
		User name:<input type="text" name="user"></br>
		Password:<input type="password" name="pass"><br>
		<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf">
		<input type="submit">
	</form>
	</body>
</html>
<?php

}
else{
?>
	<!doctype html>
	<html>
		<head>
			<title>
			</title>
		</head>
		<body>
		MEMBER logout
		<form action="memlogout.php" method="POST">
			<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf">
			<input type="submit">
		</form>
		</body>
	</html>
	
<?php
}
?>