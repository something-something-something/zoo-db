<?php
	require_once('includes/initses.php');
	require_once('includes/beforesetup.php');
	require_once('includes/checkcsrf.php');
	require_once('func/empluser.php');
?>
<?php
/*make sure that stuff has actually been submited to this page from the form (probly want to do more to verify that this is proper data)*/
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
		/* delete tables if they exist*/
		$statmentDeleteTables=$mysqlidb->prepare('DROP TABLE IF EXISTS GrossVendorSales,Manages,Users,MemberVisits,Tickets,MembershipSales, Members, Animals, Habitats, EquipmentAndSupplies, Vendor, Employee, Department');
		if(!$statmentDeleteTables->execute()){
			die('failed to delete old databases');
		}

		/*prepare create table statments (maybe should rewrite as an array?)*/
		$stmtCreateDep=$mysqlidb->prepare("CREATE TABLE Department (departmentID VARCHAR(10),name VARCHAR(10),PRIMARY KEY(departmentID))");
		
		
		$stmtCreateEmp=$mysqlidb->prepare("CREATE TABLE Employee(employeeID VARCHAR(10),firstName VARCHAR(99) ,lastName VARCHAR(99),eSsn VARCHAR(9) NOT NULL,employeeDOB DATE,position ENUM('zookeeper','waiter','cook','salesperson','superUser'),employeeType ENUM('fulltime','parttime','volunteer'),sex ENUM('m','f'),employeeEmail VARCHAR(999),address text,departmentID VARCHAR(10),supID VARCHAR(10),PRIMARY KEY(employeeID),UNIQUE(Essn), FOREIGN KEY(supID) REFERENCES Employee(employeeID), FOREIGN KEY(departmentID) REFERENCES Department(departmentID))");
		
		
		$stmtCreateHab=$mysqlidb->prepare("CREATE TABLE Habitats(HabitatID VARCHAR(10),Htype ENUM('cage','aquarium','fence'),Hname VARCHAR(999),status ENUM('occupied','empty','undergoing-maintenance'),PRIMARY KEY(habitatID))");

		
		$stmtCreateAni=$mysqlidb->prepare("CREATE TABLE Animals(animalID VARCHAR(10),Aname VARCHAR(99),taxonomy varchar(99),animalDOB DATE,habitatID VARCHAR(10),sex ENUM('m','f'),departmentID VARCHAR(10),PRIMARY KEY(animalID),FOREIGN KEY(departmentID) REFERENCES Department(departmentID),FOREIGN KEY(habitatID) REFERENCES Habitats(habitatID))");

		
		$stmtCreateVen=$mysqlidb->prepare("CREATE TABLE Vendor(vendorID VARCHAR(10),vendorType ENUM('food','retail','ride'),Vname VARCHAR(999),department VARCHAR(10),capacity INT,PRIMARY KEY(vendorID),FOREIGN KEY(department) REFERENCES Department(departmentID))");

		
		$stmtCreateEqu=$mysqlidb->prepare("CREATE TABLE EquipmentAndSupplies(ESID VARCHAR(10),ESName VARCHAR(999),EStype ENUM('small-tools','large-tools','human-food-meat','vehicle','human-food-vegtable','animal-food-meat','animal-food-vegtable'),ESQuantity INT,department VARCHAR(10),PRIMARY KEY(ESID),FOREIGN KEY(department) REFERENCES Department(departmentID))");

		
		$stmtCreateMem=$mysqlidb->prepare("CREATE TABLE Members(memberID VARCHAR(10), firstname VARCHAR(99),lastname VARCHAR(99),memberdob DATE,memberAddress TEXT,memberPhone VARCHAR(20),memberEmail varchar(99),memberSex ENUM('m','f'),PRIMARY KEY(memberID))");

		
		$stmtCreateMemSal=$mysqlidb->prepare("CREATE TABLE MembershipSales(membershipOrderNum INT,startDate DATE,endDate DATE,memberType ENUM('family','senior','single'),membershipPrice DECIMAL(9,2),memberID VARCHAR(10), PRIMARY KEY(membershipOrderNum),FOREIGN KEY(memberID) REFERENCES Members(memberID))");

		
		$stmtCreateTic=$mysqlidb->prepare("CREATE TABLE Tickets(serialNumber INT,ticketType ENUM('student','senior','child','adult'),ticketPrice DECIMAL(5,2),date DATE,PRIMARY KEY(serialNumber))");
		
		
		$stmtCreateMemVis=$mysqlidb->prepare("CREATE TABLE MemberVisits(MID VARCHAR(10),TimeStamp DATETIME,numOfPeople INT, PRIMARY KEY(MID,TimeStamp), FOREIGN KEY(MID) REFERENCES Members(memberID) )");


		$stmtCreateUse=$mysqlidb->prepare("CREATE TABLE Users(username VARCHAR(60),password VARCHAR(500),employeeID VARCHAR(10),memberID VARCHAR(10),PRIMARY KEY(username),FOREIGN KEY(employeeID) REFERENCES Employee(employeeID),FOREIGN KEY(memberID) REFERENCES Members(memberID))");
		
		
		$stmtCreateMan=$mysqlidb->prepare("CREATE TABLE Manages(eID VARCHAR(10),dID VARCHAR(10),startDATE DATE,endDate DATE,PRIMARY KEY(eID,dID,startDate),FOREIGN KEY(eID) REFERENCES Employee(employeeID),FOREIGN KEY(dID) REFERENCES Department(departmentID))");

		
		$stmtCreateGros=$mysqlidb->prepare("CREATE TABLE GrossVendorSales(ID VARCHAR(10),Day DATE,saleAmount DECIMAL(10,2),PRIMARY KEY(ID,Day),FOREIGN KEY(ID) REFERENCES Vendor(vendorID))");

		/*create tables*/
		if(!$stmtCreateDep->execute()){
			die('Failed to create  Department table');
		}
		if(!$stmtCreateEmp->execute()){
			die('Failed to create  Employee table');
		}
		if(!$stmtCreateHab->execute()){
			die('failed to create Habitiats table');
		}
		if(!$stmtCreateAni->execute()){
			die('Failed to create Animals table');
		}
		if(!$stmtCreateVen->execute()){
			die('Failed to Create Vemdor Table');
		}
		if(!$stmtCreateEqu->execute()){
			die('Failed to Create EquipmentAndSupplies table');
		}
		if(!$stmtCreateMem->execute()){
			die('Failed to Create Members table');
		}
		if(!$stmtCreateMemSal->execute()){
			die('Failed to Create MembershipSales table');
		}
		if(!$stmtCreateTic->execute()){
			die('Failed to Create Tickets table');
		}
		if(!$stmtCreateMemVis->execute()){
			die('Failed to Create MemberVisits table');
		}
		if(!$stmtCreateUse->execute()){
			die('Failed to Create Users table');
		}
		if(!$stmtCreateMan->execute()){
			die('Failed to create Manages table');
		}
		if(!$stmtCreateGros->execute()){
			die('Failed to create GrossVendorSales table');
		}

		/*adds employee as super user*/
		if(EmplUser\add($mysqlidb,$_POST['id'],$_POST['emplusername'],$_POST['emplpass'],$_POST['fname'],$_POST['lname'],$_POST['ssn'],$_POST['dob'],"superUser",null,$_POST['sex'],$_POST['email'],$_POST['addr'],null,null)){
			/**/
			file_put_contents('settings/files/db.json',json_encode($dbsettings));
			header('Location: /loginform.php');
		}
		else{
			echo 'could not add user setup aborted!';
		}
		
	}
}

?>