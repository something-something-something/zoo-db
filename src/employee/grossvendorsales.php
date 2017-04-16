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
	echo $_POST['dept'];
	$deptID=$_POST['dept'];
}
$statment=$db->prepare("insert into GrossVendorSales values(?,?,?)");
echo $db->error;
$statment->bind_param('isi',$_POST['id'],$_POST['day'],$_POST['saleamount']);
if($statment->execute()){
	header("Location: ./vendorsaleslist.php");
	echo 'added Sales';
}
else{
	Fancy\printHeader($db,'Vendor Sales','employee','vendor');
	echo '<i>Failed to add sales</i>';
	Fancy\printFooter(); 
}
$statment->close();
?>