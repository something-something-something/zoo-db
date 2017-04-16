<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	// require_once('../func/dept.php');
	EmplUser\restrictPageToPositions($db,["superUser"]);
?>
<?php
	$statment=$db->prepare("update Employee set supid=? where employeeID=?");
	$statment->bind_param('ii',
	$_POST['superid'],
	$_POST['id']);
	if($statment->execute()){
		echo '<i>Successfully Updated</i> <a href="javascript:history.back()">Go Back</a>';
	}
	else{
		echo '<i>Failed To Update</i> <a href="javascript:history.back()">Go Back</a>';
	}
	$statment->close();
?>