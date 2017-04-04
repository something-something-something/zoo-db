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
$statment=$db->prepare("insert into Vendor values(DEFAULT,?,?,?,?)");
echo $db->error;
$statment->bind_param('ssii',$_POST['type'],$_POST['name'],$deptID,$_POST['capacity']);
if($statment->execute()){
	echo 'added vendor';
}
else{
	echo 'can\'t add vendor';
}
$statment->close();

?>