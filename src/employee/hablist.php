<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,["superUser"]);
	require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'Habitats','employee','hab'); ?>
<?php
//needs more error checking will do later
$statment=$db->prepare("select HabitatID,Hname,Htype from Habitats");
//$statment->bind_param();
echo $db->error;
$statment->execute();
$statment->bind_result($id,$name,$type);
echo '<table><thead><tr><th>ID</th><th>Name</th><th>Type</th><th>Delete</th></tr></thead><tbody>';
while($statment->fetch()){
	//need to escape html charchters will do later
	echo '<tr><td><a href="edithabform.php?id='.$id.'">'.$id.'</a></td><td>'.$type.'</td><td> '.$name.'</td>';
	echo <<<DELETEHAB
		<td><form action="deletehabitat.php" method="POST">
			<input type="hidden" name="id" value="$id">
			<input type="hidden" value="{$_SESSION['CSRF']}" name="csrf">
		<input type="submit" value="Delete">
		</form></td>
DELETEHAB;
	echo '</tr>';
}
echo '</tbody></table>';
$statment->close();
?>
<?php Fancy\printFooter(); ?>