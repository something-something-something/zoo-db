<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,["superUser"]);
	require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'Deleted Members','employee','member'); ?>
<?php
//needs more error checking will do later
$statment=$db->prepare("select memberID, firstName, lastName, memberdob, membersex,memberemail,memberaddress,memberphone,deleted from MembersBackup");
//$statment->bind_param();
echo $db->error;
$statment->execute();
$statment->bind_result($id,$fname,$lname,$dob,$sex,$email,$address,$phone,$deleted);
echo "<table>
  <tr>
    <th>ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Date Of Birth</th>
    <th>Sex</th>
    <th>Email</th>
    <th>Address</th>
    <th>Phone</th>
	<th>Deleted</th>
  </tr>";
while($statment->fetch()){
	//need to escape html charchters will do later
	echo '<tr>
	<td>'.$id.'</td>
	<td>'.$fname.'</td>
	<td>'.$lname.'</td>
	<td>'.$dob.'</td>
	<td>'.$sex.'</td>
	<td>'.$email.'</td>
	<td>'.$address.'</td>
	<td>'.$phone.'</td>
	<td>'.$deleted.'</td>';

	echo '</tr>';
}
echo '</table>';
$statment->close();
?>
<?php Fancy\printFooter(); ?>