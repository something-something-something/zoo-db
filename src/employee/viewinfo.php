<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToLoggedIn();
?>
<h2> Current Information </h2>
<?php
// needs more error checking will do later
$statment=$db->prepare("select firstname, lastname, employeeDOB, position, employeeType, sex, employeeEmail, address, departmentID, supid from Employee where employeeID =?");
$statment->bind_param('i',$_SESSION['EMPLID']);
//echo $db->error;
$statment->execute();
$statment->bind_result($fname, $lname, $dob, $position, $employeeType, $sex, $email, $address, $departmentID, $supervisorID);
if($statment->fetch()){
	//need to escape html charchters will do later
	echo "First Name: ". $fname .
	"<br>Last Name: " . $lname .
	"<br>Date of Birth: " . $dob .
	"<br>Sex: " . $sex .
	"<br>Employee Type: " . $employeeType .
	"<br>Position: " . $position .
	"<br>Email: " . $email .
	"<br>Address: " . $address .
	"<br>Department ID: " . $departmentID .
	"<br>Supervisor ID: " . $supervisorID . "<br>";
}
?>
<br>
<form action="/employee/editinfoform.php">
    <input type="submit" value="Edit" />
</form>
<form action="/employee/index.php">
    <input type="submit" value="Go Back" />
</form>