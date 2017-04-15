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
$statment2=$db->prepare("select Hname,habitatid from Habitats");
$statment2->execute();
$statment2->bind_result($Hname, $hid);
$habitats = array();
while($statment2->fetch()){
	$habitats[$hid]=$Hname;
};
$statment2->close();

$statment=$db->prepare("select animalID, Aname,species, habitatid from Animals");
//$statment->bind_param();
echo $db->error;
$statment->execute();
$statment->bind_result($id,$name,$tax, $hid);
echo '<table><thead><th>ID</th><th>Species</th><th>Name</th><th>Enclosure</th><th>Delete</th></thead><tbody>';
while($statment->fetch()){
	//need to escape html charchters will do later
	if($hid) {
		echo '<tr><td><a href="editanimalform.php?id='.$id.'">'.$id.'</a></td><td>'.$tax.'</td><td> '.$name.'</td><td> ' .$habitats[$hid] . '</td>';
	} else {
		echo '<tr><td><a href="editanimalform.php?id='.$id.'">'.$id.'</a></td><td>'.$tax.'</td><td> '.$name.'</td><td> ' .'N/A' . '</td>';
	}
		echo <<<DELETEANIMAL
		<td><form action="deleteanimal.php" method="POST">
			<input type="hidden" name="id" value="$id">
			<input type="hidden" value="{$_SESSION['CSRF']}" name="csrf">
		<input type="submit" value="Delete">
		</form></td>
DELETEANIMAL;
	echo '</tr>';

}
echo '</tbody></table>';
$statment->close();
?>
<?php Fancy\printFooter(); ?>