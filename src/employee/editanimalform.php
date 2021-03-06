<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../func/dept.php');
	require_once('../func/hab.php');
	require_once('../func/fancy.php');
	EmplUser\restrictPageToPositions($db,["superUser"]);
?>
<?php Fancy\printHeader($db,'Edit animal','employee','animal'); ?>
<?php
	if(!isset($_GET['id'])||empty($_GET['id'])){
		die('specifiy an animal');
	}
	$statment=$db->prepare("select animalID,Aname,species,animalDOB,habitatID,sex,departmentID from Animals where animalID=?");
	$statment->bind_param('i',$_GET['id']);
	if(!$statment->execute()){
		die('prepared statment failed');
	}
	$statment->bind_result($id,$name,$tax,$dob,$hID,$sex,$dept);
	if(!$statment->fetch()){
		die('no Animal found');
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
$selectDeptHTML=Dept\selectDeptHTML($db,$dept);
$selectHabHTML=Habitat\selectHabitatHTML($db,$hID);
//TODO need to escape stuff
$htmlformmain=<<<HTMLFORMMAIN
ID: $id<br>
	<form action="editanimal.php" method="POST">
		Name<input type="text" name="name" value="$name" required><br>
		Species<input type="text" name="tax" value="$tax" required><br>
		$sexHTML
		DOB/Date Arrived:<input type="date" value="$dob" name="dob"><br>
		Department: $selectDeptHTML
		<br>
		Enclosure: $selectHabHTML
		<br>
		<input type="hidden" value="{$_SESSION['CSRF']}" name="csrf">
		<input type="hidden" value="$id" name="id">
		<input type="submit">
	</form>
HTMLFORMMAIN;

echo $htmlformmain;
?>
<?php Fancy\printFooter(); ?>