<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../includes/checkcsrf.php');
	EmplUser\restrictPageToLoggedIn();
?>
<?php

if(!$_POST['pass'] || !$_POST['pass1']) {
	header( 'location: employeechangepassform.php');
	echo 'Error: All the fields must be filled!';

}
if($_POST['pass'] !== $_POST['pass1']) {
	header( 'location: employeechangepassform.php');
	echo 'Error: Passwords do not match';
}

$hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
if(mysqli_query($db, "UPDATE EmployeeUsers SET password = '$hash' WHERE username='{$_SESSION['EMPLUSERNAME']}'") === TRUE) {
	header( 'refresh:3; url=index.php' ); //waits for 3 seconds before redirecting
	echo 'Password successfully changed';
}else{
	printf("Failed to change password\n");
}
$db->close();

?>
