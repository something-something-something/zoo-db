<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/memuser.php');
	/*visiting this page will print something if loged in*/
?>
<?php
	MemUser\restrictPageToLoggedIn();
?>
<a href="/member/index.php">Home</a><br>
<?php
$statment=$db->prepare("select memberID, startDate, endDate, memberType from MembershipSales where memberid=?");
echo $db->error;
$statment->bind_param('i',$_SESSION['MEMID']);
$statment->execute();
$statment->bind_result($memberID, $startDate, $endDate, $type);
while($statment->fetch()){
		echo 'Start Date: '.$fname.'<br>';
		echo 'End Date: '.$lname.'<br>';
		echo 'Type: '.$dob.'<br>';
}
$statment->close();
?>