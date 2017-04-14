<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../func/dept.php');
	EmplUser\restrictPageToPositions($db,["superUser"]);
	require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'Employees','employee','employee'); ?>
<?php
	if(!isset($_GET['id'])||empty($_GET['id'])){
		die('specifiy an employee');
	}
	$statment=$db->prepare("select employeeID,firstName,lastName,eSsn,employeeDOB,position,employeeType,sex,employeeEmail,address,departmentID from Employee where employeeID=?");
	$statment->bind_param('i',$_GET['id']);
	if(!$statment->execute()){
		die('prepared statment failed');
	}
	$statment->bind_result($id,$fn,$ln,$ssn,$dob,$pos,$type,$sex,$email,$addr,$dept);
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

$selectPosHTML=EmplUser\selectPositionHTML($pos);
$selectTypeHTML=EmplUser\selectTypeHTML($type);
$selectDeptHTML=Dept\selectDeptHTML($db,$dept);
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
		$selectDeptHTML
		<br>
		<textarea name="address">$addr</textarea><br>
		<input type="hidden" value="{$_SESSION['CSRF']}" name="csrf">
		<input type="hidden" value="$id" name="id">
		<input type="submit">
	</form>
HTMLFORMMAIN;

echo $htmlformmain;
?>
<?php
	if(!isset($_GET['id'])||empty($_GET['id'])){
		die('specifiy an employee');
	}
	$statment=$db->prepare("select employeeid, firstname, lastname, supid from Employee where employeeID=?");
	$statment->bind_param('i',$_GET['id']);
	if(!$statment->execute()){
		die('prepared statment failed');
	}
	$statment->bind_result($id, $efname, $elname, $supid);
	if(!$statment->fetch()){
		die('no employee found');
	}
	$statment->close();

	if($supid){
		$query = "select firstname, lastname from Employee where employeeID=" . $supid;
		$statment=$db->prepare($query);
		$statment->execute();
		$statment->bind_result($fname, $lname);
		if(!$statment->fetch()){
			die('no employee found');
		}
		$statment->close();
	} else {
		$fname='N/A';
		$lname='';
	}
?>

<?php
echo "<h1>Select New Supervisor For " . $efname . " " . $elname . "</h1>";
echo "<p>Current Supervisor: " . $fname . ' '. $lname. "</p>";
echo '<p><form action="editsupervisor.php" method="POST">
		Enter Supervisor ID:<input type="number" name="superid"><br>
		<input type="hidden" value="{$_SESSION[\'CSRF\']}" name="csrf">
		<input type="hidden" value="'. $id . '" name="id">
		<input type="submit">
	</form></p>';

$statment=$db->prepare("select employeeID, firstName, lastName from Employee where employeeID !=" . $id);
//$statment->bind_param();
echo $db->error;
$statment->execute();
$statment->bind_result($id,$fname,$lname);
echo "<h1>Employees</h1>";
echo "<table>
  <tr>
    <th>ID</th>
    <th>First Name</th>
    <th>Last Name</th>
  </tr>";
while($statment->fetch()){
		echo '<tr>
	<td>'.$id.'</td>
	<td>'.$fname.'</td>
	<td>'.$lname.
	'</td></tr>';
}
echo '</table>';
$statment->close();
?>
<?php Fancy\printFooter(); ?>