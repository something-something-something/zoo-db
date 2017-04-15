<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../func/dept.php');
	EmplUser\restrictPageToLoggedIn();
	require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'Current Information','employee','self'); ?>
<?php
$statment=$db->prepare("select employeeEmail, address from Employee where employeeID=?");
$statment->bind_param('i',$_SESSION['EMPLID']);
//echo $db->error;
$statment->execute();
$statment->bind_result($email, $address);
if(!$statment->fetch()){
	die('can\'t acces your info');
}

?>
<form action="editinfo.php" method="POST">
	<h2>Edit Your Information</h2>
	Email: <input type="text" value="<?php echo $email ?>" name="email"><br>
	Address: <input type="text" value="<?php echo $address ?>" name="address"><br>
	<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf">
	<input type="submit" value="Update Information">
</form>
<?php Fancy\printFooter(); ?>