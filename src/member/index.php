<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/memuser.php');
	require_once('../func/fancy.php');
	/*visiting this page will print something if loged in*/
	MemUser\restrictPageToLoggedIn();
?>
<?php Fancy\printHeader($db,'Welcome Member','member'); ?>
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
<?php $arrImages=['/img/zoo.png','/img/dino.png']; ?>
<img style="width:100%;height:auto;" src="<?php echo $arrImages[random_int(0,1)]; ?>">
<?php Fancy\printFooter(); ?>