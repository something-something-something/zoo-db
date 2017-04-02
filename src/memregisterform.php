<?php
	require_once('includes/initses.php');
	require_once('includes/aftersetup.php');
?>
<form action="memregister.php" method="POST">
	first name<input type="text" value="Jane" name="fname"><br>
	last name<input type="text" value="Doe" name="lname"><br>
	username:<input type="text" value="jDoe" name="username"><br>
	Password:<input type="password" name="pass"><br>
	Address <textarea name="address">12345 Some street</textarea><br>
	dob:<input type="date" value="2010-10-21" name="dob"><br>
	Male<input type="radio" name="sex" value="m">
	Female<input type="radio" checked name="sex" value="f"><br>
	email:<input type="text" value="jdoe@example.com" name="email"><br>
	phone:<input type="text" value="111-111-1111" name="phone"><br>
	<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf">
	<input type="submit">
</form>
