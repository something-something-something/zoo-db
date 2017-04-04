<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,['superUser']);
	require_once('../includes/checkcsrf.php');
?>
<?php
//TODO validate Posts


$statment=$db->prepare("insert into Habitats values(DEFAULT,?,?,?)");
echo $db->error;
$statment->bind_param('sss',$_POST['type'],$_POST['name'],$_POST['status']);
if($statment->execute()){
	echo 'added habitat';
}
else{
	echo 'can\'t add habitat';
}
$statment->close();

?>