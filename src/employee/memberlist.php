<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,["superUser"]);
	require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'Members','employee','member'); ?>
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
	<th>Delete</th>
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
	<td>'.$phone.'</td>';
	echo <<<DELETEMEMBER
		<td><form action="deletemember.php" method="POST">
			<input type="hidden" name="id" value="$id">
			<input type="hidden" value="{$_SESSION['CSRF']}" name="csrf">
			<input value="Delete" type="submit">
		</form></td>
DELETEMEMBER;

	echo '</tr>';
}
echo '</table>';
$statment->close();
?>
<?php Fancy\printFooter(); ?>