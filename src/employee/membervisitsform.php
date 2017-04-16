<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
		EmplUser\restrictPageToPositions($db,["superUser","bookKeeper"]);
		require_once('../func/fancy.php');
	$today = date('Y\-m\-d');
?>
<?php Fancy\printHeader($db,'Visits Report','employee','finance'); ?>
<h1>Select Dates</h1>
<form action="membervisitsreport.php" method="POST">
	From<br>
		<input type="date" value="<?php echo $today;?>" name="startDate"><br>
	To<br>
		<input type="date" value="<?php echo $today;?>" name="endDate"><br>
	
	<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf">
	<input type="submit">
</form>
<?php
echo "<h2>General Report</h2>";
// Gets Current Month
$statment2=$db->prepare("SELECT MONTH(CURRENT_TIMESTAMP)");
echo $db->error;
$statment2->execute();
$statment2->bind_result($currentmonth);
$statment2->fetch();
$statment2->close();

// To retrieve the current year
$statment2=$db->prepare("SELECT YEAR(CURRENT_TIMESTAMP)");
echo $db->error;
$statment2->execute();
$statment2->bind_result($currentyear);
$statment2->fetch();
$statment2->close();

$statment=$db->prepare("SELECT extract(month from timestamp) as visitmonth, extract(year from timestamp) as visityear, numofpeople from MemberVisits");
echo $db->error;
$statment->execute();
$statment->bind_result($month, $visityear, $numofpeople);

$visitMonthSum = 0;
while($statment->fetch()){
	if($month == $currentmonth && $visityear == $currentyear){
		$visitMonthSum += $numofpeople;
	}
}
$month = "";
switch($currentmonth){
	case 1:
		$month = "January";
		break;
	case 2:
		$month = "February";
		break;
	case 3:
		$month = "March";
		break;
	case 4:
		$month = "April";
		break;	
	case 5:
		$month = "May";
		break;
	case 6:
		$month = "June";
		break;
	case 7:
		$month = "July";
		break;
	case 8:
		$month = "August";
		break;	
	case 9:
		$month = "September";
		break;
	case 10:
		$month = "October";
		break;
	case 11:
		$month = "November";
		break;
	case 12:
		$month = "December";
		break;	
	default:
		$month =  "NULL";
}
echo "<i>Total member visits for the month of " . $month . ": " . $visitMonthSum . " member visits</i><br>";  
$statment->close();

$statment=$db->prepare("SELECT extract(year from timestamp) as orderyear, numofpeople from MemberVisits");
echo $db->error;
$statment->execute();
$statment->bind_result($year, $numofpeople);

$visitorYearSum = 0;
while($statment->fetch()){
	if($year == $currentyear){
		$visitorYearSum += $numofpeople;
	}
}
echo "<i>Total member visits for the year of " . $currentyear . ": " . $visitorYearSum . " member visits</i><br>";  
$statment->close();

?>
<?php Fancy\printFooter(); ?>
