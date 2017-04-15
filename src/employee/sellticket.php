<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,["superUser","ticketSeller"]);
	require_once('../includes/checkcsrf.php');
?>
<?php
	if($_POST['type']==='child'){
		$price=5;
	}
	else if($_POST['type']==='senior'){
		$price=8;
	}
	else if($_POST['type']==='student'){
		$price=7;
	}
	else{
		$price=10;
	}
	$statment=$db->prepare("insert into Tickets values(DEFAULT,?,?,CURDATE())");
	$statment->bind_param('si',$_POST['type'],$price);
	if($statment->execute()){
		header("Location: ./tickets.php");
		echo 'sold ticket';
	}
	else{

		echo 'ticket not sold <a href="javascript:history.back()">Go back</a>';
	}
	$statment->close();
?>