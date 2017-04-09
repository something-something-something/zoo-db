<?php
	require_once('includes/initses.php');
	require_once('includes/beforesetup.php');
	require_once('includes/checkcsrf.php');
	require_once('func/empluser.php');
	require_once('func/memuser.php');
?>
<?php

function genRandomPassword(){
	$password='';
	$length=random_int(18,30);
	for($i=0;$i<$length;$i++){
		//echo $i.'<br>';
		$password=$password.chr(random_int(33,126));
	}
	return $password;
}

/*make sure that stuff has actually been submited to this page from the form (probly want to do more to verify that this is proper data)*/
if(isset($_POST['host'],$_POST['user'],$_POST['pass'],$_POST['dbname'],$_POST['fname'],$_POST['lname'],$_POST['ssn'],$_POST['dob'],$_POST['sex'],$_POST['email'],$_POST['addr'])){
	
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
		$statmentDeleteTables=$mysqlidb->prepare('DROP TABLE IF EXISTS GrossVendorSales,Manages,EmployeeUsers,MemberUsers,MemberVisits,Tickets,MembershipSales, Members, Animals, Habitats, EquipmentAndSupplies, Vendor, Employee, Department');
		if(!$statmentDeleteTables->execute()){
			die('failed to delete old databases');
		}
		$statmentDeleteTables->close();
		/*prepare create table statments (maybe should rewrite as an array?)*/
		$stmtCreateDep=$mysqlidb->prepare("CREATE TABLE Department (departmentID INT AUTO_INCREMENT,name VARCHAR(100),PRIMARY KEY(departmentID))");
		
		
		$stmtCreateEmp=$mysqlidb->prepare("CREATE TABLE Employee(employeeID INT AUTO_INCREMENT,firstName VARCHAR(99) ,lastName VARCHAR(99),eSsn VARCHAR(9) NOT NULL,employeeDOB DATE,position ENUM('zooKeeper','waiter','cook','guide','cashier','superUser','ticketSeller','quarterMaster','departmentManager','vendor','bookKeeper'),employeeType ENUM('fullTime','partTime','volunteer'),sex ENUM('m','f'),employeeEmail VARCHAR(999),address text,departmentID INT,supID INT,PRIMARY KEY(employeeID),UNIQUE(Essn), FOREIGN KEY(supID) REFERENCES Employee(employeeID), FOREIGN KEY(departmentID) REFERENCES Department(departmentID))");
		
		
		$stmtCreateHab=$mysqlidb->prepare("CREATE TABLE Habitats(HabitatID INT AUTO_INCREMENT,Htype ENUM('cage','aquarium','fence'),Hname VARCHAR(999),status ENUM('okay','needs-maintenance','undergoing-maintenance'),PRIMARY KEY(habitatID))");

		
		$stmtCreateAni=$mysqlidb->prepare("CREATE TABLE Animals(animalID INT AUTO_INCREMENT,Aname VARCHAR(99),taxonomy varchar(99),animalDOB DATE,habitatID INT,sex ENUM('m','f'),departmentID INT,PRIMARY KEY(animalID),FOREIGN KEY(departmentID) REFERENCES Department(departmentID),FOREIGN KEY(habitatID) REFERENCES Habitats(habitatID))");

		
		$stmtCreateVen=$mysqlidb->prepare("CREATE TABLE Vendor(vendorID INT AUTO_INCREMENT,vendorType ENUM('food','retail','ride'),Vname VARCHAR(999),department INT,capacity INT,PRIMARY KEY(vendorID),FOREIGN KEY(department) REFERENCES Department(departmentID))");

		
		$stmtCreateEqu=$mysqlidb->prepare("CREATE TABLE EquipmentAndSupplies(ESID INT AUTO_INCREMENT,ESName VARCHAR(999),EStype ENUM('small-tools','large-tools','human-food-meat','vehicle','human-food-vegtable','animal-food-meat','animal-food-vegtable'),ESQuantity INT,department INT,PRIMARY KEY(ESID),FOREIGN KEY(department) REFERENCES Department(departmentID))");

		
		$stmtCreateMem=$mysqlidb->prepare("CREATE TABLE Members(memberID INT AUTO_INCREMENT, firstName VARCHAR(99),lastName VARCHAR(99),memberDOB DATE,memberSex ENUM('m','f'),memberEmail varchar(99),memberAddress TEXT,memberPhone VARCHAR(20),PRIMARY KEY(memberID))");

		
		$stmtCreateMemSal=$mysqlidb->prepare("CREATE TABLE MembershipSales(membershipOrderNum INT AUTO_INCREMENT,startDate DATE,endDate DATE,memberType ENUM('family','senior','single'),membershipPrice DECIMAL(9,2),memberID INT, PRIMARY KEY(membershipOrderNum),FOREIGN KEY(memberID) REFERENCES Members(memberID))");

		
		$stmtCreateTic=$mysqlidb->prepare("CREATE TABLE Tickets(serialNumber INT AUTO_INCREMENT,ticketType ENUM('student','senior','child','adult'),ticketPrice DECIMAL(5,2),date DATE,PRIMARY KEY(serialNumber))");
		
		
		$stmtCreateMemVis=$mysqlidb->prepare("CREATE TABLE MemberVisits(MID INT ,TimeStamp DATETIME,numOfPeople INT, PRIMARY KEY(MID,TimeStamp), FOREIGN KEY(MID) REFERENCES Members(memberID) )");


		$stmtCreateEmpUse=$mysqlidb->prepare("CREATE TABLE EmployeeUsers(username VARCHAR(60),password VARCHAR(500),employeeID INT,PRIMARY KEY(username),FOREIGN KEY(employeeID) REFERENCES Employee(employeeID))");

		$stmtCreateMemUse=$mysqlidb->prepare("CREATE TABLE MemberUsers(username VARCHAR(60),password VARCHAR(500),memberID INT,PRIMARY KEY(username),FOREIGN KEY(memberID) REFERENCES Members(memberID))");
		
		
		$stmtCreateMan=$mysqlidb->prepare("CREATE TABLE Manages(eID INT,dID INT,startDATE DATE,endDate DATE,PRIMARY KEY(eID,dID,startDate),FOREIGN KEY(eID) REFERENCES Employee(employeeID),FOREIGN KEY(dID) REFERENCES Department(departmentID))");

		
		$stmtCreateGros=$mysqlidb->prepare("CREATE TABLE GrossVendorSales(ID INT,Day DATE,saleAmount DECIMAL(10,2),PRIMARY KEY(ID,Day),FOREIGN KEY(ID) REFERENCES Vendor(vendorID))");

		/*create tables*/
		if(!$stmtCreateDep->execute()){
			die('Failed to create  Department table');
		}
		$stmtCreateDep->close();
		if(!$stmtCreateEmp->execute()){
			die('Failed to create  Employee table');
		}
		$stmtCreateEmp->close();
		if(!$stmtCreateHab->execute()){
			die('failed to create Habitiats table');
		}
		$stmtCreateHab->close();
		if(!$stmtCreateAni->execute()){
			die('Failed to create Animals table');
		}
		$stmtCreateAni->close();
		if(!$stmtCreateVen->execute()){
			die('Failed to Create Vemdor Table');
		}
		$stmtCreateVen->close();
		if(!$stmtCreateEqu->execute()){
			die('Failed to Create EquipmentAndSupplies table');
		}
		$stmtCreateEqu->close();
		if(!$stmtCreateMem->execute()){
			die('Failed to Create Members table');
		}
		$stmtCreateMem->close();
		if(!$stmtCreateMemSal->execute()){
			die('Failed to Create MembershipSales table');
		}
		$stmtCreateMemSal->close();
		if(!$stmtCreateTic->execute()){
			die('Failed to Create Tickets table');
		}
		$stmtCreateTic->close();
		if(!$stmtCreateMemVis->execute()){
			die('Failed to Create MemberVisits table');
		}
		$stmtCreateMemVis->close();
		if(!$stmtCreateEmpUse->execute()){
			die('Failed to Create Employee Users table');
		}
		$stmtCreateEmpUse->close();
		if(!$stmtCreateMemUse->execute()){
			die('Failed to Create Member Users table');
		}
		$stmtCreateMemUse->close();
		if(!$stmtCreateMan->execute()){
			die('Failed to create Manages table');
		}
		$stmtCreateMan->close();
		if(!$stmtCreateGros->execute()){
			die('Failed to create GrossVendorSales table');
		}
		$stmtCreateGros->close();


		/*adds employee as super user*/
		if(EmplUser\add($mysqlidb,$_POST['emplusername'],$_POST['emplpass'],$_POST['fname'],$_POST['lname'],$_POST['ssn'],$_POST['dob'],"superUser",null,$_POST['sex'],$_POST['email'],$_POST['addr'],null,null)){
			/**/
			file_put_contents('settings/files/db.json',json_encode($dbsettings));
			/*

			testing data
			*/



			$departmentsArr=['IT','Reptiles','Small Animals','Aquatic','Large Mammals','Food And Beverages','Retail','Park Maintenance','Security',	'Customer Service'];
			for($i=0;$i<count($departmentsArr);$i++){
				$deptAddStatment=$mysqlidb->prepare("insert into Department values(DEFAULT,?)");
				$deptAddStatment->bind_param('s',$departmentsArr[$i]);
				$deptAddStatment->execute();
				$deptAddStatment->close();
			}


			$animalsHabitatsTypeArr=['fence','fence','cage'];
			$animalsHabitatsNameArr=['T-Rex pen','T-Rex pen 2','Tiger Pen'];
			$animalsHabitatsNameSatus=['needs-maintenance','okay','okay'];
			
			/*

			INSERT INTO Animals (Aname, taxonomy, animalDOB, habitatID, sex, departmentID)
			VALUES ('Toothy', 'Dinosaur', '2017-04-08', '4', 'f', '2');

			INSERT INTO Vendor (vendorType, Vname, department, capacity)
			VALUES ('food', 'Peezahute', '7', '50');

			INSERT INTO Vendor (vendorType, Vname, department, capacity)
			VALUES ('retail', 'The Junk Store', '6', '20');
			*/

			$fnameArr=['Jane','John','Sally','Jill','Tom','Lucy','Robert','William','Abby','Helen','Ben','Susan','Jukka'];
			$lnameArr=['Smith','Doe','Green','Black','Bates','Keeton','James','Cunningham','Poole','Sarasti'];
			$sexArr=['m','f'];

			/*employees 2-21*/
			for($i=0;$i<20;$i++){
				$emplPass=genRandomPassword();
				//echo $i.' '.$emplPass.'<br>';
				EmplUser\add($mysqlidb,'randomEmployeeUsername'.$i,$emplPass,$fnameArr[random_int(0,count($fnameArr)-1)],$lnameArr[random_int(0,count($lnameArr)-1)],str_pad($i,9,'0'),random_int(1960,1997).'-'.random_int(1,12).'-'.random_int(1,20),"cook",'fullTime',$sexArr[random_int(0,1)],'emailuser'.$i.'@example.com','1234 Some St',null,null);
			}
			/*members 1-20*/
			for($i=0;$i<20;$i++){
				$memPass=genRandomPassword();
				//echo $i.' '.$memPass.'<br>';
				MemUser\add($mysqlidb,'randMem'.$i,$memPass,$fnameArr[random_int(0,count($fnameArr)-1)],$lnameArr[random_int(0,count($lnameArr)-1)],random_int(1960,1997).'-'.random_int(1,12).'-'.random_int(1,20),$sexArr[random_int(0,1)],'memberemail@example.com','1234 Some Other St','713 123 4578');
			}

			/*
			"INSERT INTO MembershipSales (startDate, endDate, memberType, membershipPrice, memberID)
			VALUES ('2016-10-10', '2017-10-10', 'senior', '59.99', '1');

			INSERT INTO MembershipSales (startDate, endDate, memberType, membershipPrice, memberID)
			VALUES ('2016-10-09', '2017-10-09', 'single', '89.99', '2');
			INSERT INTO MemberVisits (MID, TimeStamp, numOfPeople)
			VALUES ('1', '2017-03-11 10:45:16', '2');

			INSERT INTO MemberVisits (MID, TimeStamp, numOfPeople)
			VALUES ('1', '2017-04-08 09:42:16', '2');");*/

			$memSalesArr=[['2016-10-10', '2017-10-10', 'senior', 59.99, 1],['2016-10-09', '2017-10-09', 'single', 89.99, 2]];
			for($i=0;$i<count($memSalesArr);$i++){
				$memSalesCurrArr=$memSalesArr[$i];
				$memSalesStatment=$mysqlidb->prepare("INSERT INTO MembershipSales VALUES (DEFAULT,?, ?, ?, ?, ?)");
				$memSalesStatment->bind_param('sssdi',$memSalesCurrArr[0],$memSalesCurrArr[1],$memSalesCurrArr[2],$memSalesCurrArr[3],$memSalesCurrArr[4]);
				$memSalesStatment->execute();
				$memSalesStatment->close();
			}
			//TODO MAKE INO PREPARED STATMENTS
			$mysqlidb->query("INSERT INTO MemberVisits (MID, TimeStamp, numOfPeople) VALUES ('1', '2017-03-11 10:45:16', '2')");
			$mysqlidb->query("INSERT INTO MemberVisits (MID, TimeStamp, numOfPeople) VALUES ('1', '2017-04-08 09:42:16', '2')");
			
			




			header('Location: /loginform.php');
		}
		else{
			echo 'could not add user setup aborted!';
		}
		
	}
}

?>