<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,["superUser"]);
?>
<h2> Equipment And Supplies </h2>
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
	<td><a href="editsupplyform.php?id='.$id.'">'.$id.'</a></td>
	<td>'.$name.'</td>
	<td>'.$type.'</td>
	<td>'.$quantity.'</td>
	</tr>';
}
echo"</table>
<form action=\"/employee/index.php\">
    <input type=\"submit\" value=\"Go Back\" />
</form>";
$statment->close();
?>