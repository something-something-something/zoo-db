<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,['superUser']);
	require_once('../includes/checkcsrf.php');
	require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'Vendor Sales','employee','vendor'); ?>
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

$stValID=$db->prepare("select id from GrossVendorSales where id=(select vendorid from Vendor where department=(select departmentid from Employee where employeeid=?))");
$stValID->bind_param('i',$_SESSION['EMPLID']);
$idokay=false;
$stValID->execute();
$stValID->bind_result($valID);
while($stValID->fetch()){

	if($valID===$_POST['id']){
		$idokay=true;
	}
}
if($idokay){
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
}
else{
	echo 'invalid id';
}

?>
<?php Fancy\printFooter(); ?>