<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../func/dept.php');
	require_once('../func/hab.php');
	require_once('../func/equisup.php');
	EmplUser\restrictPageToPositions($db,["superUser"]);
?>
<?php
	if(!isset($_GET['id'])||empty($_GET['id'])){
		die('specifiy a supply');
	}
	$statment=$db->prepare("select esid,esname,estype,esquantity from EquipmentAndSupplies where ESID=? and department=(select departmentid from Employee where employeeid=?)");
	$statment->bind_param('ii',$_GET['id'],$_SESSION['EMPLID']);
	if(!$statment->execute()){
		die('prepared statment failed');
	}
	$statment->bind_result($id,$name,$type,$quan,$dept);
	if(!$statment->fetch()){
		die('no Supply found');
	}
	$statment->close();
?>

<?php

$selectTypeHTML=EquiSup\selectTypeHTML($type);
//TODO need to escape stuff
$htmlformmain=<<<HTMLFORMMAIN
ID: $id<br>
	<form action="editsupply.php" method="POST">
		name<input type="text" name="name" value="$name"><br>
		quantity<input type="number" name="quantity" value="$quan"><br>
		<br>
		$selectTypeHTML
		<br>
		<input type="hidden" value="{$_SESSION['CSRF']}" name="csrf">
		<input type="hidden" value="$id" name="id">
		<input type="submit">
	</form>
HTMLFORMMAIN;

echo $htmlformmain;
?>