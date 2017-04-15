<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,["superUser","ticketSeller"]);
	require_once('../includes/checkcsrf.php');
?>
<?php
	
	$statmentCM=$db->prepare("select membertype,enddate from MembershipSales where memberid=? and datediff(enddate,curdate())>0");
	$statmentCM->bind_param('i',$_POST['id']);
	$statmentCM->execute();
	$statmentCM->bind_result($type,$enddate);
	if($statmentCM->fetch()){
		$statmentCM->close();
		$statment=$db->prepare("insert into MemberVisits values(?,NOW(),?)");
		echo $db->error;
		$statment->bind_param('ii',$_POST['id'],$_POST['num']);
		if($statment->execute()){
			header("Location: ./membervisits.php");
			echo 'Added visit';
		}
		else{
			echo '<i>Failed To Add Visit <a href="javascript:history.back()">Go Back</a></i>';
		}
		$statment->close();
	}
	else{
		echo '<i>Failed To Add Visit <a href="javascript:history.back()">Go Back</a></i>';
	}
?>