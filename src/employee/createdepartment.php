<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,['superUser']);
	require_once('../includes/checkcsrf.php');
?>
<?php
//TODO Validate posts
if(!isset($_POST['name'])){
	die();
}
$statment=$db->prepare("insert into Department values(DEFAULT,?)");
$statment->bind_param('s',$_POST['name']);
if($statment->execute()){
	echo 'added Department';
}
else{
	echo 'could not add Department';
}
$statment->close();
?>