<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/memuser.php');
		require_once('../func/fancy.php');
	/*visiting this page will print something if loged in*/
	MemUser\restrictPageToLoggedIn();
	require_once('../includes/checkcsrf.php');
?>
<?php Fancy\printHeader($db,'Purchased Membership','member'); ?>
<?php
if($_POST['type']==='senior'){
	$price=119;
}
else if($_POST['type']==='single'){
	$price=79;
}
else{
	$price=139;
}

$statment=$db->prepare("insert into MembershipSales values(DEFAULT,CURDATE(),CURDATE() + INTERVAL 1 YEAR,?,?,?)");
$statment->bind_param('sii',$_POST['type'],$price,$_SESSION['MEMID']);
$statment->execute();
?>
<?php Fancy\printFooter(); ?>