<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/memuser.php');
	/*visiting this page will print something if loged in*/
	MemUser\restrictPageToLoggedIn();
?>
<a href="/memloginform.php">Logout</a><br>
<?php
$statment=$db->prepare("select firstName, lastName from Members where memberid=?");
echo $db->error;
$statment->bind_param('i',$_SESSION['MEMID']);
$statment->execute();
$statment->bind_result($fname, $lname);
echo 'Welcome ';
if($statment->fetch()){
		echo ''.$fname.' '.$lname.' <br>';
}
$statment->close();
?>
<a href="memberprofile.php">Profile</a>
<a href="membershipinfo.php">Membership</a> <a href="editmemberform.php">Edit</a>
you are logged in now.