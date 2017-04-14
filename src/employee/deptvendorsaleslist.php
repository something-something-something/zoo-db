<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,["superUser"]);
	require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'Vendor Sales','employee','vendor'); ?>
<?php
//needs more error checking will do later
$statment=$db->prepare("select ID, day,saleamount from GrossVendorSales where id=(select vendorid from Vendor where department=(select departmentid from Employee where employeeid=?))");
$statment->bind_param('i',$_SESSION['EMPLID']);
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
	<td>'.$id.'</td>
	<td>'.$day.'</td>
	<td>'.$saleamount.'</td>';
}
echo '</table>';
$statment->close();
?>
<?php Fancy\printFooter(); ?>