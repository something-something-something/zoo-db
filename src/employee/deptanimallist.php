<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	EmplUser\restrictPageToPositions($db,["zooKeeper","departmentManager","superUser"]);
?>

<?php
//needs more error checking will do later
$statment=$db->prepare("select Animals.animalID,Animals.Aname,Animals.species from Animals,Employee where Employee.employeeID=? and Employee.departmentID=Animals.departmentID");
$statment->bind_param(i,$_SESSION['EMPLID']);
echo $db->error;
$statment->execute();
$statment->bind_result($id,$name,$tax);
while($statment->fetch()){
	//need to escape html charchters will do later
	echo '<a href="editdeptanimalform.php?id='.$id.'">'.$id.'</a> '.$tax.' '.$name.'<br>';
}
$statment->close();
?>