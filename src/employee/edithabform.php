<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../func/hab.php');
	EmplUser\restrictPageToPositions($db,["superUser"]);
	require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'Habitats','employee','hab'); ?>
<?php
	if(!isset($_GET['id'])||empty($_GET['id'])){
		die('specifiy a Habitat');
	}
	$statment=$db->prepare("select HabitatID,Htype,Hname,status from Habitats where HabitatID=?");
	$statment->bind_param('i',$_GET['id']);
	if(!$statment->execute()){
		die('prepared statment failed');
	}
	$statment->bind_result($id,$type,$name,$status);
	if(!$statment->fetch()){
		die('no Habitat found');
	}
	$statment->close();
?>

<?php


$selectStatusHTML=Habitat\selectStatusHTML($status);
$selectTypeHTML=Habitat\selectTypeHTML($type);
//TODO need to escape stuff
$htmlformmain=<<<HTMLFORMMAIN
ID: $id<br>
	<form action="edithab.php" method="POST">
		name<input type="text" name="name" value="$name"><br>
		type: $selectTypeHTML
		<br>
		status: $selectStatusHTML
		<br>
		<input type="hidden" value="{$_SESSION['CSRF']}" name="csrf">
		<input type="hidden" value="$id" name="id">
		<input type="submit">
	</form>
HTMLFORMMAIN;

echo $htmlformmain;
?>
<?php Fancy\printFooter(); ?>