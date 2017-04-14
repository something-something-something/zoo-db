<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../func/fancy.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,["superUser","ticketSeller"]);
?>
<?php Fancy\printHeader($db,'Tickets','employee','ticket'); ?>
<form action="addmembervisit.php" method="POST">
	<label>Member id</label><input type="text" name="id"><br>
	<label>Number of people</label><input type="text" name="num"><br>
	<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf">
	<input type="submit">
</form>

<?php
	$statment=$db->prepare("select mid,timestamp,numofpeople from MemberVisits");
	$statment->execute();
	$statment->bind_result($id,$timestamp,$num);
	echo '<table><thead><tr><th>Member ID</th><th>TIME</th><th>Number of people</th><th>Delete</th></thead><tbody>';
	while($statment->fetch()){
		echo '<tr>';
		echo '<td>'.$id.'</td><td>'.$timestamp.'</td><td>'.$num.'';
		echo <<<DELETEMEMBERVISIT
		<td><form action="deletemembervisit.php" method="POST">
			<input type="hidden" name="id" value="$id">
			<input type="hidden" name="timestamp" value="$timestamp">
			<input type="hidden" value="{$_SESSION['CSRF']}" name="csrf">
			<input value="Delete" type="submit">
		</form></td>
DELETEMEMBERVISIT;
		echo '</tr>';
	}
	echo '</tbody></table>';
	$statment->close();
?>
<?php Fancy\printFooter(); ?>