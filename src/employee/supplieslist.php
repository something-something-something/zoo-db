<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,["superUser"]);
	require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'Equipment and Supply List','employee','sup'); ?>
<?php
//needs more error checking will do later
$statment=$db->prepare("select esID, esname,estype, esquantity, department from EquipmentAndSupplies");
//$statment->bind_param();
echo $db->error;
$statment->execute();
$statment->bind_result($id,$name,$type,$quantity, $department);
echo "<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Type</th>
    <th>Quantity</th>
    <th>Department</th>
	<th>Delete</th>
  </tr>";
while($statment->fetch()){
	//need to escape html charchters will do later
	echo '<tr>
	<td><a href="editsupplyform.php?id='.$id.'">'.$id.'</a></td>
	<td>'.$name.'</td>
	<td>'.$type.'</td>
	<td>'.$quantity.'</td>
	<td>'.$department.'</td>';
	echo <<<DELETEEQUIP
	<td><form action="deleteequipment.php" method="POST">
		<input type="hidden" name="id" value="$id">
		<input type="hidden" value="{$_SESSION['CSRF']}" name="csrf">
	<input type="submit" value="Delete">
	</form></td></tr>
DELETEEQUIP;
}
echo '</table>';
$statment->close();
?>
<?php Fancy\printFooter(); ?>