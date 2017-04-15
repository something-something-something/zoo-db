<?php
require_once('includes/initses.php');
require_once('includes/aftersetup.php');
require_once('func/memuser.php');
require_once('func/fancy.php');
?>
<?php
if(!memUser\loggedIn()){
?>
<?php Fancy\printHeader($db,'Zoo Member Login'); ?>
	<form action="memlogin.php" method="POST">
		<h2>Log On</h2>
		Username:<input type="text" name="user"></br>
		Password:<input type="password" name="pass"><br>
		<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf">
		<input type="submit" value="Log In">
	</form>
<?php Fancy\printFooter(); ?>
<?php

}
else{
?>
<?php Fancy\printHeader($db,'Log Out'); ?>
		<form action="memlogout.php" method="POST">
			<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf">
			<input type="submit" value="Log Out">
		</form>
<?php Fancy\printFooter(); ?>
	
<?php
}
?>