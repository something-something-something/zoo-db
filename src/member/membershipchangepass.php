<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/memuser.php');
  require_once('../includes/checkcsrf.php');
  MemUser\restrictPageToLoggedIn();
	/*visiting this page will print something if logged in*/
?>
<?php

if(!$_POST['pass'] || !$_POST['pass1']) {
	header( 'location: membershipchangepassform.php');
	echo 'Error: All the fields must be filled!';

}
if($_POST['pass'] !== $_POST['pass1']) {
	header( 'location: membershipchangepassform.php');
	echo 'Error: Passwords do not match';
}

$hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
if(mysqli_query($db, "UPDATE MemberUsers SET password = '$hash' WHERE username='{$_SESSION['MEMUSERNAME']}'") === TRUE) {
	header( 'refresh:3; url=index.php' ); //waits for 3 seconds before redirecting
	echo 'Password successfully changed';
}else{
	printf("Failed to change password\n");
}
$db->close();

?>
