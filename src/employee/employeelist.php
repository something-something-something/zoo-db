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
$statment=$db->prepare("select employeeID, firstName, lastName, position, employeetype, employeeemail from Employee");
//$statment->bind_param();
echo $db->error;
$statment->execute();
$statment->bind_result($id,$fname,$lname, $position, $employeetype, $email);
echo '<table><thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Position</th><th>Employee Type</th><th>Email</th></th><th>Delete</th></tr></thead><tbody>';
$type = "";
$pos = "";
while($statment->fetch()){
	switch($position) {
		case "zooKeeper":
			$pos="Zoo Keeper";
			break;
		case "waiter":
			$pos="Waiter";
			break;
		case "cook":
			$pos="Cook";
			break;
		case "guide":
			$pos="Guide";
			break;
		case "cashier":
			$pos="Cashier";
			break;
		case "superUser":
			$pos="Super User";
			break;
		case "ticketSeller":
			$pos="Ticket Seller";
			break;
		case "quarterMaster":
			$pos="Quarter Master";
			break;
		case "departmentManager":
			$pos="Department Manager";
			break;
		case "vendor":
			$pos="Vendor";
			break;
		case "bookKeeper":
			$pos="Book Keeper";
			break;
		default: 
			$pos="N/A";
	}
	switch($employeetype) {
		case "fullTime":
			$type="Full Time";
			break;
		case "partTime":
			$type="Part Time";
			break;
		case "volunteer":
			$type="Volunteer";
			break;
		default:
			$type="N/A";
	}
	//need to escape html charchters will do later
	echo '<tr><td><a href="edituserform.php?id='.$id.'">'.$id.'</a></td><td>'.$fname.'</td><td>'.$lname.'</td><td>' . $pos. '</td><td>' . $type .'</td><td>' . $email . '</td>';
	echo <<<DELETEEMPLOYEE
		<td><form action="deleteemployee.php" method="POST">
			<input type="hidden" name="id" value="$id">
			<input type="hidden" value="{$_SESSION['CSRF']}" name="csrf">
			<input value="Delete" type="submit">
		</form></td>
DELETEEMPLOYEE;
	echo '</tr>';
}
echo '</tbody></table>';
$statment->close();
?>
<?php Fancy\printFooter(); ?>