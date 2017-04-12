<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/fancy.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,["superUser","bookKeeper"]);
	$today = date('Y\-m\-d');
?>
<?php Fancy\printHeader($db,'Sales Report','employee'); ?>
<form action="salesreport.php" method="POST">
	From<br>
		<input type="date" value="<?php echo $today;?>" name="startDate"><br>
	To<br>
		<input type="date" value="<?php echo $today;?>" name="endDate"><br>
	
	<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf">
	<input type="submit">
</form>
<?php
echo "<h1>Current Month & Year</h1>";
echo "<h2>Ticket Sales</h2>";

// To retrieve the current month
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

$statment=$db->prepare("SELECT extract(month from date) as ordermonth, extract(year from date) as orderyear, ticketprice from Tickets");
echo $db->error;
$statment->execute();
$statment->bind_result($month, $year, $ticketprice);

$ticketMonthSum = 0;
while($statment->fetch()){
	if($month == $currentmonth && $year == $currentyear){
		$ticketMonthSum += $ticketprice;
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
echo "Total Ticket Sales for the month of " . $month . ": $" . $ticketMonthSum . "<br>";  
$statment->close();

$statment=$db->prepare("SELECT extract(year from date) as orderyear, ticketprice from Tickets");
echo $db->error;
$statment->execute();
$statment->bind_result($year, $ticketprice);

$ticketYearSum = 0;
while($statment->fetch()){
	if($year == $currentyear){
		$ticketYearSum += $ticketprice;
	}
}
echo "Total Ticket Sales for the year of " . $currentyear . ": $" . $ticketYearSum . "<br>";  
$statment->close();

//For the gross vendor sales
$statment=$db->prepare("SELECT extract(month from day) as ordermonth, extract(year from day) as orderyear, saleamount from GrossVendorSales");
echo $db->error;
$statment->execute();
$statment->bind_result($ordermonth, $orderyear, $vendorsale);

$vendorMonthSum = 0;
while($statment->fetch()){
	if($ordermonth == $currentmonth && $year == $orderyear){
		$vendorMonthSum += $vendorsale;
	}
}
echo "<h2>Vendor Sales</h2>";
echo "Total Vendor Sales for the month of " . $month . ": $" . $vendorMonthSum . "<br>";  
$statment->close();

$statment=$db->prepare("SELECT extract(year from day) as orderyear, saleamount from GrossVendorSales");
echo $db->error;
$statment->execute();
$statment->bind_result($year, $saleamount);

$vendorYearSum = 0;
while($statment->fetch()){
	if($year == $currentyear){
		$vendorYearSum += $saleamount;
	}
}
echo "Total Vendor Sales for the year of " . $currentyear . ": $" . $vendorYearSum . "<br>";  
$statment->close();

//For the membership sales
$statment=$db->prepare("SELECT extract(month from startdate) as ordermonth, extract(year from startdate) as orderyear,  membershipprice from MembershipSales");
echo $db->error;
$statment->execute();
$statment->bind_result($ordermonth, $orderyear, $sale);

$membershipMonthSum = 0;
while($statment->fetch()){
	if($ordermonth == $currentmonth && $year == $orderyear){
		$membershipMonthSum += $sale;
	}
}
echo "<h2>Membership Sales</h2>";
echo "Total Membership Sales for the month of " . $month . ": $" . $membershipMonthSum . "<br>";  
$statment->close();

$statment=$db->prepare("SELECT extract(year from startdate) as orderyear, membershipprice from MembershipSales");
echo $db->error;
$statment->execute();
$statment->bind_result($year, $sale);

$membershipYearSum = 0;
while($statment->fetch()){
	if($year == $currentyear){
		$membershipYearSum += $sale;
	}
}
echo "Total Membership Sales for the year of " . $currentyear . ": $" . $membershipYearSum . "<br>";  
$statment->close();

echo "<h1>Total Sales</h1>";
echo "<i>Total Sales in " . $month . ": $" . ($ticketMonthSum + $membershipMonthSum + $vendorMonthSum) . "</i><br>";
echo "<i>Total Sales in " . $currentyear . ": $" . ($ticketYearSum + $membershipYearSum + $vendorYearSum) . "</i><br>";
?>
<?php Fancy\printFooter(); ?>