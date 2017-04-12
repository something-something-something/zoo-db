<?php
require_once('includes/initses.php');
require_once('includes/aftersetup.php');
require_once('includes/mysqlcon.php');
require_once('func/memuser.php');
require_once('includes/checkcsrf.php');
/*logs user in if they are who they claim to be.*/
if(!isset($_POST['user'],$_POST['pass'])){
	header('Location: /memloginform.php');
	die();
}
if(MemUser\validatePassword($db,$_POST['user'],$_POST['pass'])){
	$_SESSION['MEMUSERNAME']=$_POST['user'];
	$id=MemUser\getIDFromUserName($db,$_POST['user']);
	if($id!==false){
		$_SESSION['MEMID']=$id;
		header('Location: /member/index.php');
	}
	else{
		header('Location: /memloginform.php');
	}
}
else{
	header('Location: /memloginform.php');
}
?>
