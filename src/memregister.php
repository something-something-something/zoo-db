<?php
	require_once('includes/initses.php');
	require_once('includes/mysqlcon.php');
	require_once('includes/aftersetup.php');
	require_once('func/memuser.php');
	require_once('includes/checkcsrf.php');
	require_once('func/fancy.php');
?>
<?php Fancy\printHeader($db,'Account Created'); ?>
<?php

	//TODO validate POST
	if(MemUser\add($db,$_POST['username'],$_POST['pass'],$_POST['fname'],$_POST['lname'],$_POST['dob'],$_POST['sex'],$_POST['email'],$_POST['address'],$_POST['phone'])){
		echo 'Added member';

	}
	else{
		echo 'Failed to create member';
	}
?>
<?php Fancy\printFooter(); ?>