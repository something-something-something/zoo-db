<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,["superUser"]);
?>
<?php
	if(!isset($_GET['id'])||empty($_GET['id'])){
		die('specifiy an employee');
	}
	$statment=$db->prepare("select employeeID,firstName,lastName,eSsn,employeeDOB,position,employeeType,sex,employeeEmail,address from Employee where employeeID=?");
	$statment->bind_param('i',$_GET['id']);
	if(!$statment->execute()){
		die('prepared statment failed');
	}
	$statment->bind_result($id,$fn,$ln,$ssn,$dob,$pos,$type,$sex,$email,$addr);
	if(!$statment->fetch()){
		die('no employee found');
	}
?>

<?php

if($sex=='m'){
	$sexHTML='<label>Male</label><input type="radio" checked name="sex" value="m"><label>Female</label><input type="radio" name="sex" value="f"><br>';
}
else{
	$sexHTML='<label>Male</label><input type="radio" name="sex" value="m">
		<label>Female</label><input type="radio" checked name="sex" value="f"><br>';
}

$selectPosHTML=EmplUser\selectPositionHTML($pos);
$selectTypeHTML=EmplUser\selectTypeHTML($type);
//TODO need to escape stuff
$htmlformmain=<<<HTMLFORMMAIN
ID: $id<br>
	<form action="edituser.php" method="POST">
		first name<input type="text" name="fname" value="$fn"><br>
		last name<input type="text" name="lname" value="$ln"><br>
		ssn<input type="text" name="ssn" value="$ssn"><br>
		$sexHTML
		email:<input type="text" value="$email" name="email"><br>
		dob:<input type="date" value="$dob" name="dob"><br>
		job<br>
		$selectPosHTML
		<br>
		$selectTypeHTML
		<br>
		<textarea name="address">$addr</textarea><br>
		<input type="hidden" value="{$_SESSION['CSRF']}" name="csrf">
		<input type="hidden" value="$id" name="id">
		<input type="submit">
	</form>
HTMLFORMMAIN;

echo $htmlformmain;
?>