<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,['superUser']);
	require_once('../includes/checkcsrf.php');
	require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'Equipment And Supplies','employee','sup'); ?>
<?php
//TODO validate Posts
//$habID=NULL;

if($_POST['dept']==='none'){
	$deptID=NULL;
}
else{
	echo $_POST['dept'];
	$deptID=$_POST['dept'];
}                                   
$statment=$db->prepare("insert into EquipmentAndSupplies values(DEFAULT,?,?,?,?)");
echo $db->error;
$statment->bind_param('ssii',$_POST['name'],$_POST['type'],$_POST['quantity'],$deptID);
if($statment->execute()){
	echo 'Succesfully Added Supply';
}
else{
	echo 'Failed to Add Supply';
}
$statment->close();

?>
<?php Fancy\printFooter(); ?>
