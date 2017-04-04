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
$habID=NULL;

if($_POST['dept']==='none'){
	$deptID=NULL;
}
else{
	$deptID=$_POST['dept'];
}
$statment=$db->prepare("insert into Animals values(DEFAULT,?,?,?,?,?,?)");
echo $db->error;
$statment->bind_param('sssisi',$_POST['name'],$_POST['tax'],$_POST['dob'],$habID,$_POST['sex'],$deptID);
if($statment->execute()){
	echo 'added animal';
}
else{
	echo 'can\'t add animal';
}
$statment->close();

?>