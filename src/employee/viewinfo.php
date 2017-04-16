<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToLoggedIn();
	require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'Current Information','employee','self'); ?>
<hr>
<?php
// needs more error checking will do later
$statment2=$db->prepare("select firstname, lastname, employeeID from Employee");
$statment2->execute();
$statment2->bind_result($firstname,$lastname,$empid);
$emplist = array();
while($statment2->fetch()){
	$emplist[$empid] = $firstname . ' ' . $lastname; 
}
$statment2->close();

$statment2=$db->prepare("select name, departmentID from Department");
$statment2->execute();
$statment2->bind_result($deptname,$deptid);
$deptlist = array();
while($statment2->fetch()){
	$deptlist[$deptid] = $deptname; 
}
$statment2->close();

$statment=$db->prepare("select firstname, lastname, employeeDOB, position, employeeType, sex, employeeEmail, address, departmentID, supid from Employee where employeeID =?");
$statment->bind_param('i',$_SESSION['EMPLID']);
//echo $db->error;
$statment->execute();
$statment->bind_result($fname, $lname, $dob, $position, $employeeType, $sex, $email, $address, $departmentID, $supervisorID);
if($statment->fetch()){
	$supername = "N/A";
	//need to escape html charchters will do later
	if($supervisorID){
		$supername = $emplist[$supervisorID];
	}
	$departmentname = "N/A";
	if($departmentID){
		$departmentname = $deptlist[$departmentID];
	}

	echo "First Name: ". $fname .
	"<br>Last Name: " . $lname .
	"<br>Date of Birth: " . $dob .
	"<br>Sex: " . $sex .
	"<br>Employee Type: " . $employeeType .
	"<br>Position: " . $position .
	"<br>Email: " . $email .
	"<br>Address: " . $address .
	"<br>Department Name: " . $departmentname .
	"<br>Supervisor Name: " . $supername . "<br>";
}
$statment->close();
$statment3=$db->prepare("select employeeid,firstname, lastname, employeeDOB, position, employeeType, sex, employeeEmail, address, departmentID from Employee where supID =?");
$statment3->bind_param('i',$_SESSION['EMPLID']);
$statment3->bind_param('i',$_SESSION['EMPLID']);
//echo $db->error;
$statment3->execute();
$statment3->bind_result($underlingID,$fname, $lname, $dob, $position, $employeeType, $sex, $email, $address, $departmentID);
echo "<h2>You Supervise</h2>";
echo "<table><thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Date of Birth</th><th>Sex</th><th>Employee Type</th><th>Position</th><th>Email</th><th>Address</th><th>Department ID</th></tr></thead><tbody>";
while($statment3->fetch()){
	//need to escape html charchters will do later
	echo "<tr><td>". $underlingID .
	"</td><td>" . $fname .
	"</td><td>" . $lname .
	"</td><td>" . $dob .
	"</td><td> " . $sex .
	"</td><td>" . $employeeType .
	"</td><td>" . $position .
	"</td><td>" . $email .
	"</td><td>" . $address .
	"</td><td>" . $departmentID . "</td></tr>";
}
$statment3->close();
echo '</tbody></table>';
?>
<?php Fancy\printFooter(); ?>