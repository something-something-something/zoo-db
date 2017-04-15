<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../func/dept.php');
	EmplUser\restrictPageToPositions($db,["superUser"]);
	require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'Members','employee','member'); ?>
<?php
	if(!isset($_GET['id'])||empty($_GET['id'])){
		die('Specify a Member');
	}
	$statment=$db->prepare("select memberID,firstName,lastName,memberDOB,membersex,memberemail,memberaddress,memberphone from Members where memberID=?");
	$statment->bind_param('i',$_GET['id']);
	if(!$statment->execute()){
		die('prepared statment failed');
	}
	$statment->bind_result($id,$fn,$ln,$dob,$sex,$email,$address,$phone);
	if(!$statment->fetch()){
		die('no employee found');
	}
	$statment->close();
?>

<?php

if($sex=='m'){
	$sexHTML='<label>Male</label><input type="radio" checked name="sex" value="m"><label>Female</label><input type="radio" name="sex" value="f"><br>';
}
else{
	$sexHTML='<label>Male</label><input type="radio" name="sex" value="m">
		<label>Female</label><input type="radio" checked name="sex" value="f"><br>';
}
//TODO need to escape stuff
$htmlformmain=<<<HTMLFORMMAIN
ID: $id<br>
	<form action="editmember.php" method="POST">
		First Name<input type="text" name="fname" value="$fn" required><br>
		Last Name<input type="text" name="lname" value="$ln" required ><br>
		DOB<input type="date" name="dob" value="$dob"><br>
		$sexHTML
		Email:<input type="text" value="$email" name="email" required><br>
		Address:<input type="text" value="$address" name="address" required>
		<br>
		Phone:<input type="text" value="$phone" name="phone" required>
		<br>

		<input type="hidden" value="{$_SESSION['CSRF']}" name="csrf">
		<input type="hidden" value="$id" name="id">
		<input type="submit">
	</form>
HTMLFORMMAIN;

echo $htmlformmain;
?>
<?php Fancy\printFooter(); ?>