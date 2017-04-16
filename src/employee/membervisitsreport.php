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
echo "<table width=\"50%\">
  <tr>
    <th>First Name</th>
    <th>Last Name</th> 
    <th>Member ID</th>
    <th>Visit Date</th>
    <th>Number of People</th>
  </tr>";
while($statment->fetch()){
		//echo $numofpeople . ' ';
		$sum += $numofpeople;
		echo '<tr><td align="center">'.$fname.'</td>';
		echo '<td align="center">'.$lname.'</td>';
		echo '<td align="center">'.$memID.'</td>';
		echo '<td align="center">'.$visitDate.'</td>';
		echo '<td align="center">'.$numofpeople.'</td></tr>';
}
echo '</table><br><hr>';
echo "<i>Total number of people visited including guests: " . $sum . '</i>';
$statment->close();
	
?>
<?php Fancy\printFooter(); ?>