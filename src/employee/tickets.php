<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../func/fancy.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,["superUser","ticketSeller"]);
?>
<?php Fancy\printHeader($db,'Tickets','employee'); ?>
<form action="sellticket.php" method="POST">
	<select required name="type">
		<option value="adult">adult $10</option>
		<option value="child">child $5</option>
		<option value="student">student $7</option>
		<option value="senior">senior $8</option>
	</select>
	<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf">
	<input type="submit">
</form>

<?php
	$statment=$db->prepare("select serialnumber,tickettype,ticketprice,date from Tickets");
	$statment->execute();
	$statment->bind_result($num,$type,$price,$date);
	echo '<table><thead><tr><th>Ticket Number</th><th>Type</th><th>Price</th><th>Date</th><th>Delete</th></thead><tbody>';
	while($statment->fetch()){
		echo '<tr>';
		echo '<td>'.$num.'</td><td>'.$type.'</td><td>'.$price.'<td>'.$date.'</td>';
		echo <<<DELETETICKET
		<td><form action="deleteticket.php" method="POST">
			<input type="hidden" name="num" value="$num">
			<input type="hidden" value="{$_SESSION['CSRF']}" name="csrf">
			<input value="Delete" type="submit">
		</form></td>
DELETETICKET;
		echo '</tr>';
	}
	echo '</tbody></table>';
	$statment->close();
?>
<?php Fancy\printFooter(); ?>