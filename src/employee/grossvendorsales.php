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
	echo 'added Sales';
}
else{
	echo 'can\'t add Sales';
}
$statment->close();
?>