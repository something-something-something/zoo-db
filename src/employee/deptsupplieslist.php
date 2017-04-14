<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../func/fancy.php');
	EmplUser\restrictPageToPositions($db,["superUser","quarterMaster","zooKeeper","departmentManager","vendor"]);
?>
<?php Fancy\printHeader($db,'Equipment And Supplies','employee'); ?>
<?php
//needs more error checking will do later
$statment=$db->prepare("select esID, esname,estype, esquantity from EquipmentAndSupplies where department=(select departmentid from Employee where employeeid=?)");
$statment->bind_param('i',$_SESSION['EMPLID']);
echo $db->error;
$statment->execute();
$statment->bind_result($id,$name,$type,$quantity);
echo "<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Type</th>
    <th>Quantity</th>
  </tr>";
while($statment->fetch()){
	//need to escape html charchters will do later
	echo '<tr>
	<td><a href="editdeptsupplyform.php?id='.$id.'">'.$id.'</a></td>
	<td>'.$name.'</td>
	<td>'.$type.'</td>
	<td>'.$quantity.'</td>
	</tr>';
}
echo"</table>";
$statment->close();
?>
<?php Fancy\printFooter(); ?>