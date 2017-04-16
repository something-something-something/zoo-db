<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/memuser.php');
	require_once('../func/fancy.php');
	/*visiting this page will print something if loged in*/
	MemUser\restrictPageToLoggedIn();
?>
<?php Fancy\printHeader($db,'Edit Info','member'); ?>
<?php
$statment=$db->prepare("select firstname,lastname,memberdob,membersex,memberemail,memberaddress,memberphone from Members where memberid=?");
$statment->bind_param('i',$_SESSION['MEMID']);
if(!$statment->execute()){
	die('can not execute statment');
}
$statment->bind_result($fname,$lname,$dob,$sex,$email,$address,$phone);
if(!$statment->fetch()){
		die('no member found');
}

if($sex=='m'){
	$sexHTML='<label>Male</label><input type="radio" checked name="sex" value="m"><label>Female</label><input type="radio" name="sex" value="f"><br>';
}
else{
	$sexHTML='<label>Male</label><input type="radio" name="sex" value="m">
		<label>Female</label><input type="radio" checked name="sex" value="f"><br>';
}

//TODO need to escape stuff
$htmlformmain=<<<HTMLFORMMAIN
ID: {$_SESSION['MEMID']}<br>
	<form action="editmember.php" method="POST">
		first name<input type="text" name="fname" value="$fname"><br>
		last name<input type="text" name="lname" value="$lname"><br>
		$sexHTML
		dob:<input type="date" value="$dob" name="dob"><br>
		email<input type="text" name="email" value="$email"><br>
		address<input type="text" name="address" value="$address"><br>
		phone<input type="text" name="phone" value="$phone"><br>
		<input type="hidden" value="{$_SESSION['CSRF']}" name="csrf">
		<input type="submit">
	</form>
HTMLFORMMAIN;

echo $htmlformmain;

?>
<?php Fancy\printFooter(); ?>
