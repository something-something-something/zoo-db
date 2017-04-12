<?php
require_once('includes/initses.php');
require_once('includes/aftersetup.php');
require_once('func/empluser.php');
require_once('func/fancy.php');
?>
<?php
if(!EmplUser\loggedIn()){
?>
<?php Fancy\printHeader($db,'Log In'); ?>

	<form action="login.php" method="POST">
		User name:<input type="text" name="user"></br>
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
		<form action="logout.php" method="POST">
			<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf">
			<input type="submit" value="Log out">
		</form>
<?php Fancy\printFooter(); ?>
	
<?php
}
?>