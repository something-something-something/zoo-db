<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../includes/checkcsrf.php');
?>
<?php
$statment=$db->prepare("SELECT firstName, lastName, memberID, TimeStamp FROM Members, MemberVisits WHERE memberid=MID AND TimeStamp >=? AND TimeStamp <=?");
echo $db->error;
$statment->bind_param('ss',$_POST['startDate'], $_POST['endDate']);
$statment->execute();
$statment->bind_result($fname, $lname, $memID, $visitDate);
while($statment->fetch()){

		echo 'First Name: '.$fname.' ';
		echo 'Last Name: '.$lname.' ';
		echo 'Member ID: '.$memID.' ';
		echo 'Date: '.$visitDate.' <br>';
}
$statment->close();
	
?>