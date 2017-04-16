<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,["superUser","bookKeeper"]);
		require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'Sales Report','employee','finance'); ?>
<?php
// Tickets
$statment=$db->prepare("SELECT serialNumber, ticketType, ticketPrice, date FROM Tickets WHERE date >=? AND date <=?");
echo $db->error;
$statment->bind_param('ss',$_POST['startDate'], $_POST['endDate']);
$statment->execute();
$statment->bind_result($serialNumber, $ticketType, $ticketPrice, $date);
echo "<h2>Ticket Sales</h2>";
echo "<table width=\"50%\">
  <tr>
    <th>Serial Number</th>
    <th>Ticket Type</th> 
    <th>Price</th>
    <th>Date</th>
  </tr>";
$ticketSalesSum = 0;
while($statment->fetch()){
		$ticketSalesSum += $ticketPrice;
		echo '<tr><td align="center">'.$serialNumber.'</td>';
		echo '<td align="center">'.$ticketType.'</td>';
		echo '<td align="center"> $'.$ticketPrice.'</td>';
		echo '<td align="center">'.$date.'</td>';
}
echo '<br></table>';
echo "<i><h3>Total Ticket Sales: $" . $ticketSalesSum . "</h3></i>";
$statment->close();

// Vendor Sales
$statment=$db->prepare("SELECT Vname, vendortype, saleamount, day FROM Vendor, GrossVendorSales WHERE vendorid=ID AND day >=? AND day <=?");
echo $db->error;
$statment->bind_param('ss',$_POST['startDate'], $_POST['endDate']);
$statment->execute();
$statment->bind_result($vName, $vendorType, $saleamount, $date);
echo "<br><h2>Vendor Sales</h2>";
echo "<table width=\"50%\">
  <tr>
    <th>Vendor Name</th>
    <th>Type</th> 
    <th>Sale</th>
    <th>Date</th>
  </tr>";
$vendorSalesSum = 0;
while($statment->fetch()){
		$vendorSalesSum += $saleamount;
		echo '<tr><td align="center">'.$vName.'</td>';
		echo '<td align="center">'.$vendorType.'</td>';
		echo '<td align="center"> $'.$saleamount.'</td>';
		echo '<td align="center">'.$date.'</td>';
}
echo '<br></table>';
echo "<i><h3>Total Vendor Sales: $" . $vendorSalesSum . "</h3></i>";
$statment->close();

// Membership Sales
$statment=$db->prepare("SELECT firstname, lastname, membershipordernum, startdate, membertype, membershipprice FROM MembershipSales AS s, Members AS m WHERE s.memberid=m.memberid AND startdate >=? AND startdate <=?");
echo $db->error;
$statment->bind_param('ss',$_POST['startDate'], $_POST['endDate']);
$statment->execute();
$statment->bind_result($firstname, $lastname, $membershipordernum, $startdate, $membertype, $membershipprice);
echo "<br><h2>Membership Sales</h2>";
echo "<table width=\"50%\">
  <tr>
    <th>Full Name</th>
    <th>Order No.</th> 
    <th>Start Date</th>
    <th>Membership Type</th>
    <th>Price</th>
  </tr>";
$totalMembershipSales = 0;
while($statment->fetch()){
		$totalMembershipSales += $membershipprice;
		echo '<tr><td align="center">'. $firstname . ' ' . $lastname .'</td>';
		echo '<td align="center">'.$membershipordernum.'</td>';
		echo '<td align="center">'.$startdate.'</td>';
		echo '<td align="center">'.$membertype.'</td>';
		echo '<td align="center"> $'.$membershipprice.'</td>';
}
echo '<br></table>';
echo "<i><h3>Total Vendor Sales: $" . $totalMembershipSales . "</h3></i>";
$statment->close();
echo '<hr><i><h2>Total Sales: $' . ($totalMembershipSales + $ticketSalesSum + $vendorSalesSum) . '</i></h2>';
?>
<?php Fancy\printFooter(); ?>