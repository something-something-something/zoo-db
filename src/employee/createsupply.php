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
//$habID=NULL;

if($_POST['dept']==='none'){
	$deptID=NULL;
}
else{
	$deptID=$_POST['dept'];
}                                   
$statment=$db->prepare("insert into EquipmentAndSupplies values(DEFAULT,?,?,?,?)");
echo $db->error;
$statment->bind_param('ssii',$_POST['name'],$_POST['type'],$_POST['quantity'],$deptID);
if($statment->execute()){
	header("Location: ./supplieslist.php");
	echo 'Succesfully Added Supply';
}
else{
	Fancy\printHeader($db,'Equipment And Supplies','employee','sup');
	echo 'Failed to Add Supply';
	Fancy\printFooter();
}
$statment->close();

?>