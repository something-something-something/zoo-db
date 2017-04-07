<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,["superUser"]);
?>

<?php
//needs more error checking will do later
$statment=$db->prepare("select memberID, firstName, lastName, memberdob, membersex,memberemail,memberaddress,memberphone from Members");
//$statment->bind_param();
echo $db->error;
$statment->execute();
$statment->bind_result($id,$fname,$lname,$dob,$sex,$email,$address,$phone);
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
  </tr>";
while($statment->fetch()){
	//need to escape html charchters will do later
	echo '<tr>
	<td><a href="editmemberform.php?id='.$id.'">'.$id.'</a></td>
	<td>'.$fname.'</td>
	<td>'.$lname.'</td>
	<td>'.$dob.'</td>
	<td>'.$sex.'</td>
	<td>'.$email.'</td>
	<td>'.$address.'</td>
	<td>'.$phone.'</td>
	</tr>';
}
echo '</table>';
$statment->close();