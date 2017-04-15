<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,["superUser"]);
		require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'Vendor List','employee','vendor'); ?>
<?php
//needs more error checking will do later
$statment=$db->prepare("select vendorID, vendortype,vname,department,capacity from Vendor");
//$statment->bind_param();
echo $db->error;
$statment->execute();

$statment->bind_result($id,$type,$name,$department, $capacity);
echo '<table><thead><tr><th>ID</th><th>Name</th><th>Type</th><th>Department</th><th>Capacity</th><th>Delete</th></tr></thead><tbody>';
while($statment->fetch()){
	//need to escape html charchters will do later
	echo '<tr><td><a href="editvendorform.php?id='.$id.'">'.
	$id.'</a></td><td>'.
	$name.'</td><td>'.
	$type.'</td><td>'. 
	$department.'</td><td>'.
	$capacity.'</td>';
	echo <<<DELETEVENDOR
	<td><form action="deletevendor.php" method="POST">
		<input type="hidden" name="id" value="$id">
		<input type="hidden" value="{$_SESSION['CSRF']}" name="csrf">
	<input type="submit" value="Delete">
	</form></td>
DELETEVENDOR;
	echo '</tr>';
}
echo '</tbody></table>';
$statment->close();
?>
<?php Fancy\printFooter(); ?>