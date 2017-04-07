<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,["superUser"]);
?>

<?php
//needs more error checking will do later
$statment=$db->prepare("select ID, day,saleamount from GrossVendorSales");
//$statment->bind_param();
echo $db->error;
$statment->execute();
$statment->bind_result($id,$day,$saleamount);
	//need to escape html charchters will do later
	echo "<table>
  <tr>
    <th>Vendor ID</th>
    <th>Day</th>
    <th>Sale Amount</th>
  </tr>";
while($statment->fetch()){
	//need to escape html charchters will do later
	echo '<tr>
	<td><a href="editsaleform.php?id='.$id.'">'.$id.'</a></td>
	<td>'.$day.'</td>
	<td>'.$saleamount.'</td>
	</tr>';
}
echo '</table>';
$statment->close();
?>