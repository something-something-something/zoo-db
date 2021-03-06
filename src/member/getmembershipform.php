<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/memuser.php');
	require_once('../func/fancy.php');
	/*visiting this page will print something if loged in*/
	MemUser\restrictPageToLoggedIn();
?>
<?php Fancy\printHeader($db,'Purchase Membership','member'); ?>
<?php
$statment=$db->prepare("select membertype,enddate from MembershipSales where memberid=? and datediff(enddate,curdate())>0");
$statment->bind_param('i',$_SESSION['MEMID']);
$statment->execute();
$statment->bind_result($type,$enddate);
if($statment->fetch()){
	echo '<hr><br><b><p style="text-align:center;">You have a <i>' . $type . ' </i>membership that expires on <i>'.$enddate . '.</i></p></b>';
	$statment->close();
}
else{
	$htmlformmain=<<<HTMLFORMMAIN

	<form action="getmembership.php" method="POST">
	 Type:
	 	family $139<input type="radio" name="type" value="family">
		senior $119<input type="radio" name="type" value="senior">
		single $79<input type="radio" name="type" value="single">
		<input type="hidden" value="{$_SESSION['CSRF']}" name="csrf">
		<input type="submit">
	</form>
HTMLFORMMAIN;
echo $htmlformmain;
}

?>
<?php Fancy\printFooter(); ?>