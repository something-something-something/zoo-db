<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/memuser.php');
	/*visiting this page will print something if loged in*/
?>
<?php
	MemUser\restrictPageToLoggedIn();
?>
<a href="/member/index.php">Home</a><br>
<?php
$statment=$db->prepare("select firstName, lastName, memberDOB, memberEmail, memberAddress, memberPhone from Members where memberid=?");
echo $db->error;
$statment->bind_param('i',$_SESSION['MEMID']);
$statment->execute();
$statment->bind_result($fname, $lname, $dob, $email, $address, $phone);
if($statment->fetch()){

		echo 'First Name: '.$fname.'<br>';
		echo 'Last Name: '.$lname.'<br>';
		echo 'DOB: '.$dob.'<br>';
		echo 'Address: '.$address.'<br>';
		echo 'E-mail: '.$email.'<br>';
		echo 'Phone: '.$phone.'<br>';
}
$statment->close();
?>