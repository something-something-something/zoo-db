<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,["superUser","ticketSeller"]);
?>
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
	while($statment->fetch()){
		echo 'ticket#'.$num.' '.$type.' '.$price.' '.$date;
		echo <<<DELETETICKET
		<form action="deleteticket.php" method="POST">
			<input type="hidden" name="num" value="$num">
			<input type="hidden" value="{$_SESSION['CSRF']}" name="csrf">
		Delete<input type="submit">
		</form>
DELETETICKET;
	}
	$statment->close();
?>