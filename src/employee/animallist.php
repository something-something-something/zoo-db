<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,["superUser"]);
?>

<?php
//needs more error checking will do later
$statment=$db->prepare("select animalID, Aname,taxonomy from Animals");
//$statment->bind_param();
echo $db->error;
$statment->execute();
$statment->bind_result($id,$name,$tax);
while($statment->fetch()){
	//need to escape html charchters will do later
	echo '<a href="editanimalform.php?id='.$id.'">'.$id.'</a> '.$tax.' '.$name.'<br>';
}
$statment->close();
?>