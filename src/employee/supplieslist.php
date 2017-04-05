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
$statment=$db->prepare("select esID, esname,estype, esquantity, department from equipmentandsupplies");
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
  </tr>";
while($statment->fetch()){
	//need to escape html charchters will do later
	echo '<tr>
	<td>'.$id.'</td>
	<td>'.$name.'</td>
	<td>'.$type.'</td>
	<td>'.$quantity.'</td>
	<td>'.$department.'</td>
	</tr>';
}
echo"
<form action=\"/employee/createsupplyform.php\">
    <input type=\"submit\" value=\"Add\" />
</form>
<form action=\"/employee/index.php\">
    <input type=\"submit\" value=\"Go Back\" />
</form>";
$statment->close();
?>