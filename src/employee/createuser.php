<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,['superUser']);
	require_once('../includes/checkcsrf.php');
	require_once('../func/fancy.php');

?>
<?php Fancy\printHeader($db,'Employees','employee','employee'); ?>
<?php
	if(isset(
		$_POST['username'],
		$_POST['pass'],
		$_POST['fname'],
		$_POST['lname'],
		$_POST['ssn'],
		$_POST['dob'],
		$_POST['pos'],
		$_POST['type'],
		$_POST['sex'],
		$_POST['email'],
		$_POST['address'])){
		if($_POST['dept']==='none'){
			$dID=NULL;
		}
		else{
			$dID=$_POST['dept'];
		}
		
		$sID=NULL;
		if(EmplUser\add($db,
		$_POST['username'],
		$_POST['pass'],
		$_POST['fname'],
		$_POST['lname'],
		$_POST['ssn'],
		$_POST['dob'],
		$_POST['pos'],
		$_POST['type'],
		$_POST['sex'],
		$_POST['email'],
		$_POST['address'],
		$dID,$sID)){
			echo 'Employee Created';
		}
		else{
			echo 'Can\'t create Employee';
		}
	}
?>
<?php Fancy\printFooter(); ?>