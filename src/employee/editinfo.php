<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../includes/checkcsrf.php');
	EmplUser\restrictPageToLoggedIn();
	require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'Current Information','employee','self'); ?>
<?php
//TODO validate Posts
$statment=$db->prepare("update Employee set employeeEmail=(?), address=(?) where employeeID=?");
echo $db->error;
$statment->bind_param('ssi',$_POST['email'],$_POST['address'],$_SESSION['EMPLID']);

if($statment->execute()){
	echo 'Successfully updated!';
}
else{
	echo 'Failed to update.';
}
$statment->close();

?>
<?php Fancy\printFooter(); ?>