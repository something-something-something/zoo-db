<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,['superUser']);
	require_once('../includes/checkcsrf.php');
		require_once('../func/fancy.php');
?>
<?php  ?>
<?php
//TODO validate Posts
//$habID=NULL;

if($_POST['dept']==='none'){
	$deptID=NULL;
}
else{
	$deptID=$_POST['dept'];
}
$statment=$db->prepare("insert into Vendor values(DEFAULT,?,?,?,?)");
$statment->bind_param('ssii',$_POST['type'],$_POST['name'],$deptID,$_POST['capacity']);
if($statment->execute()){
	header("Location: ./vendorlist.php");
	echo 'added vendor';
}
else{
	Fancy\printHeader($db,'Vendors','employee','vendor');
	echo 'can\'t add vendor';
	Fancy\printFooter();
}
$statment->close();

?>