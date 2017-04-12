<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/memuser.php');
	require_once('../includes/checkcsrf.php');
	require_once('../func/fancy.php');
	MemUser\restrictPageToLoggedIn();

?>
<?php Fancy\printHeader($db,'Editing','member'); ?>
<?php

// TODO add checks to make sure post data is okay
	$statment=$db->prepare("update Members set firstname=?,lastname=?,membersex=?,memberemail=?,memberaddress=?,memberphone=?,memberdob=? where memberid=?");
	$statment->bind_param('sssssssi',
	$_POST['fname'],
	$_POST['lname'],
	$_POST['sex'],
	$_POST['email'],
	$_POST['address'],
	$_POST['phone'],
	$_POST['dob'],
	$_SESSION['MEMID']);
	if($statment->execute()){
		if($db->affected_rows>0){
			echo 'Updated member';
		}
		else{
			echo 'failed to update member';
		}
	}
	else{
		echo 'An error in executing';
	}
	$statment->close();
?>
<?php Fancy\printFooter(); ?>