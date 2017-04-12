<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/memuser.php');
	require_once('../func/fancy.php');
	/*visiting this page will print something if loged in*/
	MemUser\restrictPageToLoggedIn();
?>
<?php Fancy\printHeader($db,'Membership History','member'); ?>
<?php
$statment=$db->prepare("select startDate, endDate, memberType from MembershipSales where memberid=?");
echo $db->error;
$statment->bind_param('i',$_SESSION['MEMID']);
$statment->execute();
$statment->bind_result($startDate, $endDate, $type);
echo '<table><thead><tr><th>Start Date</th><th>Expireation Date</th><th>Type</th></tr></thead><tbody>';
while($statment->fetch()){
	echo '<tr><td>'.$startDate.'</td><td>'.$endDate.'</td><td>'.$type.'</td></tr>';
}
echo '</tbody></table>';
$statment->close();
?>
<?php Fancy\printFooter(); ?>