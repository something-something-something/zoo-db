<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../includes/checkcsrf.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,["superUser","bookKeeper"]);
	require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'Visits Report','employee','finance'); ?>
<?php

$statment=$db->prepare("SELECT firstName, lastName, memberID, TimeStamp, numofpeople FROM Members, MemberVisits WHERE memberid=MID AND TimeStamp >=? AND TimeStamp <=?");
echo $db->error;
$statment->bind_param('ss',$_POST['startDate'], $_POST['endDate']);
$statment->execute();
$statment->bind_result($fname, $lname, $memID, $visitDate, $numofpeople);
$sum = 0;
while($statment->fetch()){
		//echo $numofpeople . ' ';
		$sum += $numofpeople;
		echo 'First Name: '.$fname.' ';
		echo 'Last Name: '.$lname.' ';
		echo 'Member ID: '.$memID.' ';
		echo 'Date: '.$visitDate.' <br>';
}
echo "<i>Total number of people visited including guests: " . $sum . '</i>';
$statment->close();
	
?>
<?php Fancy\printFooter(); ?>