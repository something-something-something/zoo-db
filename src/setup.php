<?php
	require_once('includes/initses.php');
	require_once('includes/beforesetup.php');
	require_once('includes/checkcsrf.php');
	require_once('func/empluser.php');
?>
<?php
if(isset($_POST['host'],$_POST['user'],$_POST['pass'],$_POST['dbname'],$_POST['id'],$_POST['fname'],$_POST['lname'],$_POST['ssn'],$_POST['dob'],$_POST['sex'],$_POST['email'],$_POST['addr'])){
	
	$dbsettings=[];
	$dbsettings["host"]=$_POST['host'];
	$dbsettings["user"]=$_POST['user'];
	$dbsettings["pass"]=$_POST['pass'];
	$dbsettings["name"]=$_POST['dbname'];
	$db_info=$dbsettings;
	$mysqlidb = new mysqli($db_info['host'],$db_info['user'],$db_info['pass'],$db_info['name']);
	if ($mysqlidb->connect_errno) {
		echo 'MYSQLI: '. $mysqlidb->connect_errno . ' '. $mysqlidb->connect_error;
	}
	else{
		/*Not using prepared statments here as there should be no posibility of sql injection*/
		$mysqlidb->query('DROP TABLE IF EXISTS Department');
		$mysqlidb->query("CREATE TABLE Department (departmentID VARCHAR(10),name VARCHAR(10),PRIMARY KEY(departmentID))");

		$mysqlidb->query('DROP TABLE IF EXISTS Employee');
		$mysqlidb->query("CREATE TABLE Employee(employeeID VARCHAR(10),firstName VARCHAR(99) ,lastName VARCHAR(99),eSsn VARCHAR(9) NOT NULL,employeeDOB DATE,position ENUM('zookeeper','waiter','cook','salesperson','superUser'),employeeType ENUM('fulltime','parttime','volunteer'),sex ENUM('m','f'),employeeEmail VARCHAR(999),address text,departmentID VARCHAR(10),supID VARCHAR(10),PRIMARY KEY(employeeID),UNIQUE(Essn), FOREIGN KEY(supID) REFERENCES Employee(employeeID), FOREIGN KEY(departmentID) REFERENCES Department(departmentID))");
		
		$mysqlidb->query('DROP TABLE IF EXISTS Habitats');
		$mysqlidb->query("CREATE TABLE Habitats(HabitatID VARCHAR(10),Htype ENUM('cage','aquarium','fence'),Hname VARCHAR(999),status ENUM('occupied','empty','undergoing-maintenance'),PRIMARY KEY(habitatID))");

		$mysqlidb->query('DROP TABLE IF EXISTS Animals');
		$mysqlidb->query("CREATE TABLE Animals(animalID VARCHAR(10),Aname VARCHAR(99),taxonomy varchar(99),animalDOB DATE,habitatID VARCHAR(10),sex ENUM('m','f'),departmentID VARCHAR(10),PRIMARY KEY(animalID),FOREIGN KEY(departmentID) REFERENCES Department(departmentID),FOREIGN KEY(habitatID) REFERENCES Habitats(habitatID))");

		$mysqlidb->query('DROP TABLE IF EXISTS Vendor');
		$mysqlidb->query("CREATE TABLE Vendor(vendorID VARCHAR(10),vendorType ENUM('food','retail','ride'),Vname VARCHAR(999),department VARCHAR(10),capacity INT,PRIMARY KEY(vendorID),FOREIGN KEY(department) REFERENCES Department(departmentID))");

		$mysqlidb->query('DROP TABLE IF EXISTS EquipmentAndSupplies');
		$mysqlidb->query("CREATE TABLE EquipmentAndSupplies(ESID VARCHAR(10),ESName VARCHAR(999),EStype ENUM('small-tools','large-tools','human-food-meat','vehicle','human-food-vegtable','animal-food-meat','animal-food-vegtable'),ESQuantity INT,department VARCHAR(10),PRIMARY KEY(ESID),FOREIGN KEY(department) REFERENCES Department(departmentID))");

		$mysqlidb->query('DROP TABLE IF EXISTS Members');
		$mysqlidb->query("CREATE TABLE Members(memberID VARCHAR(10), firstname VARCHAR(99),lastname VARCHAR(99),memberdob DATE,memberAddress TEXT,memberPhone VARCHAR(20),memberEmail varchar(99),memberSex ENUM('m','f'),PRIMARY KEY(memberID))");

		$mysqlidb->query('DROP TABLE IF EXISTS MembershipSales');
		$mysqlidb->query("CREATE TABLE MembershipSales(membershipOrderNum INT,startDate DATE,endDate DATE,memberType ENUM('family','senior','single'),membershipPrice DECIMAL(9,2),memberID VARCHAR(10), PRIMARY KEY(membershipOrderNum),FOREIGN KEY(memberID) REFERENCES Members(memberID))");

		$mysqlidb->query('DROP TABLE IF EXISTS Tickets');
		$mysqlidb->query("CREATE TABLE Tickets(serialNumber INT,ticketType ENUM('student','senior','child','adult'),ticketPrice DECIMAL(5,2),date DATE,PRIMARY KEY(serialNumber))");
		
		$mysqlidb->query('DROP TABLE IF EXISTS MemberVisits');
		$mysqlidb->query("CREATE TABLE MemberVisits(MID VARCHAR(10),TimeStamp DATETIME,numOfPeople INT, PRIMARY KEY(MID,TimeStamp), FOREIGN KEY(MID) REFERENCES Members(memberID) )");

		$mysqlidb->query('DROP TABLE IF EXISTS Users');
		$mysqlidb->query("CREATE TABLE Users(username VARCHAR(60),password VARCHAR(500),employeeID VARCHAR(10),memberID VARCHAR(10),PRIMARY KEY(username),FOREIGN KEY(employeeID) REFERENCES Employee(employeeID),FOREIGN KEY(memberID) REFERENCES Members(memberID))");
		
		$mysqlidb->query('DROP TABLE IF EXISTS Manages');
		$mysqlidb->query("CREATE TABLE Manages(eID VARCHAR(10),dID VARCHAR(10),startDATE DATE,endDate DATE,PRIMARY KEY(eID,dID,startDate),FOREIGN KEY(eID) REFERENCES Employee(employeeID),FOREIGN KEY(dID) REFERENCES Department(departmentID))");

		$mysqlidb->query('DROP TABLE IF EXISTS GrossVendorSales');
		$mysqlidb->query("CREATE TABLE GrossVendorSales(ID VARCHAR(10),Day DATE,saleAmount DECIMAL(10,2),PRIMARY KEY(ID,Day),FOREIGN KEY(ID) REFERENCES Vendor(vendorID))");
		
		if(EmplUser\add($mysqlidb,$_POST['id'],$_POST['emplusername'],$_POST['emplpass'],$_POST['fname'],$_POST['lname'],$_POST['ssn'],$_POST['dob'],"superUser",null,$_POST['sex'],$_POST['email'],$_POST['addr'],null,null)){
			file_put_contents('settings/files/db.json',json_encode($dbsettings));
		}
		else{
			echo 'could not add user setup aborted!';
		}
		
	}
}

?>