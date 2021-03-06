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
	$statment=$db->prepare("select e.employeeID,e.firstName,e.lastName,e.eSsn,e.employeeDOB,e.position,e.employeeType,e.sex,e.employeeEmail,e.address,e.departmentID,u.username from Employee as e join EmployeeUsers as u on (e.employeeid=u.employeeid) where e.employeeID=?");
	$statment->bind_param('i',$_GET['id']);
	if(!$statment->execute()){
		die('prepared statment failed');
	}
	$statment->bind_result($id,$fn,$ln,$ssn,$dob,$pos,$type,$sex,$email,$addr,$dept,$username);
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
Username: $username
	<form action="edituser.php" method="POST">
		First Name<input type="text" name="fname" value="$fn" required><br>
		Last Name<input type="text" name="lname" value="$ln" required><br>
		SSN<input type="text" name="ssn" value="$ssn" required><br>
		$sexHTML
		Email:<input type="text" value="$email" name="email" required><br>
		DOB:<input type="date" value="$dob" name="dob"><br>
		Job<br>
		$selectPosHTML
		<br>
		$selectTypeHTML
		<br>
		Department $selectDeptHTML
		<br>Address<br>
		<textarea name="address">$addr</textarea><br>
		<input type="hidden" value="{$_SESSION['CSRF']}" name="csrf">
		<input type="hidden" value="$id" name="id">
		<input type="submit">
	</form>
HTMLFORMMAIN;
$changepasshtml=<<<CHANGEPASS
<form action="changeanyemplpass.php" method="POST">
	New Password: <input type="password" name="pass"><br>
  Confirm Password: <input type="password" name="pass1"><br>
  	<input type="hidden" value="$id" name="id">
	<input type="hidden" value="{$_SESSION['CSRF']}" name="csrf">
	<input type="submit">
</form>
CHANGEPASS;

echo $htmlformmain;
echo $changepasshtml;
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