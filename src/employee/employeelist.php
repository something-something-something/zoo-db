<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,["superUser"]);
	require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'Employees','employee','employee'); ?>
<?php
//needs more error checking will do later
$statment=$db->prepare("select employeeID, firstName, lastName from Employee");
//$statment->bind_param();
echo $db->error;
$statment->execute();
$statment->bind_result($id,$fname,$lname);
echo '<table><thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Delete</th></tr></thead><tbody>';
while($statment->fetch()){
	//need to escape html charchters will do later
	echo '<tr><td><a href="edituserform.php?id='.$id.'">'.$id.'</a></td><td>'.$fname.'</td><td>'.$lname.'</td>';
	echo '<td>Later Tonight</td>';
	echo '</tr>';
}
echo '</tbody></table>';
$statment->close();
?>
<?php Fancy\printFooter(); ?>