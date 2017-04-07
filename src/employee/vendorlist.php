<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,["superUser"]);
?>

<?php
//needs more error checking will do later
$statment=$db->prepare("select vendorID, vendortype,vname,department,capacity from Vendor");
//$statment->bind_param();
echo $db->error;
$statment->execute();
$statment->bind_result($id,$type,$name,$department, $capacity);
while($statment->fetch()){
	//need to escape html charchters will do later
	echo '<a href="editvendorform.php?id='.$id.'">'.
	$id.'</a> '.
	$name.' '.
	$type.' '. 
	$department.' '.
	$capacity.'<br>';
}
$statment->close();
?>