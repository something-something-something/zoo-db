<?php
	require_once('includes/initses.php');
	require_once('includes/aftersetup.php');
	require_once('includes/mysqlcon.php');
	require_once('func/fancy.php');
?>
<?php Fancy\printHeader($db,'Register as Member'); ?>
<form action="memregister.php" method="POST">
	<h2>Membership Information</h2>
	First Name<input type="text" value="Jane" name="fname"><br>
	Last Name<input type="text" value="Doe" name="lname"><br>
	Username:<input type="text" value="jDoe" name="username"><br>
	Password:<input type="password" name="pass"><br>
	Address <textarea name="address">12345 Some street</textarea><br>
	DOB:<input type="date" value="2010-10-21" name="dob"><br>
	Male<input type="radio" name="sex" value="m">
	Female<input type="radio" checked name="sex" value="f"><br>
	E-mail:<input type="text" value="jdoe@example.com" name="email"><br>
	Phone:<input type="text" value="111-111-1111" name="phone"><br>
	<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf">
	<input type="submit" value="Register">
</form>
<?php Fancy\printFooter(); ?>