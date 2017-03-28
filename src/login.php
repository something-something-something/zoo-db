<?php
require_once('includes/initses.php');
require_once('includes/aftersetup.php');
require_once('includes/mysqlcon.php');
require_once('func/empluser.php');
require_once('includes/checkcsrf.php');
/*logs user in if they are who they claim to be.*/
if(!isset($_POST['user'],$_POST['pass'])){
	header('Location: /loginform.php');
	die();
}
if(EmplUser\validatePassword($db,$_POST['user'],$_POST['pass'])){
	$id=EmplUser\getIDFromUserName($db,$_POST['user']);
	if($id!==false){
		$_SESSION['EMPLID']=$id;
		header('Location: /logincheck.php');
	}
	else{
		header('Location: /loginform.php');
	}
}
else{
	header('Location: /loginform.php');
}
?>