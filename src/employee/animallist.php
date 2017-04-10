<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../func/fancy.php');
	EmplUser\restrictPageToPositions($db,["superUser"]);
?>
<?php Fancy\printHeader($db,'All animals','employee','animal'); ?>
<?php
//needs more error checking will do later
$statment=$db->prepare("select animalID, Aname,species from Animals");
//$statment->bind_param();
echo $db->error;
$statment->execute();
$statment->bind_result($id,$name,$tax);
echo '<table><thead><th>ID</th><th>Species</th><th>Name</th></thead><tbody>';
while($statment->fetch()){
	//need to escape html charchters will do later
	echo '<tr><td><a href="editanimalform.php?id='.$id.'">'.$id.'</a></td><td>'.$tax.'</td><td> '.$name.'</td></tr>';
}
echo '</tbody></table>';
$statment->close();
?>
<?php Fancy\printFooter(); ?>