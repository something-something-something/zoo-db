<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../func/vend.php');
	require_once('../func/dept.php');
	EmplUser\restrictPageToPositions($db,["superUser"]);
	require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'Edit Vendor','employee','vendor'); ?>
<?php
	if(!isset($_GET['id'])||empty($_GET['id'])){
		die('specifiy a Vendor');
	}
	$statment=$db->prepare("select vendorID, vendortype,vname,department,capacity from Vendor where vendorid=?");
	$statment->bind_param('i',$_GET['id']);
	if(!$statment->execute()){
		die('prepared statment failed');
	}
	$statment->bind_result($id,$type,$name,$department,$capacity);
	if(!$statment->fetch()){
		die('no Vendor found');
	}
	$statment->close();
?>

<?php
$selectDeptHTML=Dept\selectDeptHTML($db,$department);
$selectTypeHTML=Vendor\selectTypeHTML($type);
//TODO need to escape stuff
$htmlformmain=<<<HTMLFORMMAIN
ID: $id<br>
	<form action="editvendor.php" method="POST">
		Name:<input type="text" name="name" value="$name"><br>
		capacity<input type="number" name="capacity" value="$capacity"><br>
		Type: $selectTypeHTML<br>
		Department: $selectDeptHTML<br>
		<input type="hidden" value="{$_SESSION['CSRF']}" name="csrf">
		<input type="hidden" value="$id" name="id">
		<input type="submit">
	</form>
HTMLFORMMAIN;

echo $htmlformmain;
?>
<?php Fancy\printFooter(); ?>