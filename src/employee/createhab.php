<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,['superUser']);
	require_once('../includes/checkcsrf.php');
	require_once('../func/fancy.php');
?><?php
//TODO validate Posts


$statment=$db->prepare("insert into Habitats values(DEFAULT,?,?,?)");
$statment->bind_param('sss',$_POST['type'],$_POST['name'],$_POST['status']);
if($statment->execute()){
	header("Location: ./hablist.php");
	echo 'added habitat';
}
else{
	Fancy\printHeader($db,'Habitats','employee','hab');
	echo 'can\'t add habitat';
	 Fancy\printFooter();
}
$statment->close();

?>