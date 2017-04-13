<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,["superUser"]);
	require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'Deleted Employees','employee','employee'); ?>
<?php
//needs more error checking will do later
$statment=$db->prepare("select employeeID, firstName, lastName,deleted from EmployeeBackup");
//$statment->bind_param();
echo $db->error;
$statment->execute();
$statment->bind_result($id,$fname,$lname,$deleted);
echo '<table><thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Deleted on</th></tr></thead><tbody>';
while($statment->fetch()){
	//need to escape html charchters will do later
	echo '<tr><td>'.$id.'</td><td>'.$fname.'</td><td>'.$lname.'</td><td>'.$deleted.'</td>';
	echo '</tr>';
}
echo '</tbody></table>';
$statment->close();
?>
<?php Fancy\printFooter(); ?>