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
		$statmentDeleteTables=$mysqlidb->prepare('DROP TABLE IF EXISTS GrossVendorSales,Manages,EmployeeUsers,MemberUsers,MemberVisits,Tickets,MembershipSales, Members, Animals, Habitats, EquipmentAndSupplies, Vendor, Employee, Department,EmployeeBackup,MembersBackup');
		if(!$statmentDeleteTables->execute()){
			die('failed to delete old databases');
		}
		$statmentDeleteTables->close();


		/*prepare create table statments (maybe should rewrite as an array?)*/
		$stmtCreateDep=$mysqlidb->prepare("CREATE TABLE Department (departmentID INT AUTO_INCREMENT,name VARCHAR(100),PRIMARY KEY(departmentID))");
		
		
		$stmtCreateEmp=$mysqlidb->prepare("CREATE TABLE Employee(employeeID INT AUTO_INCREMENT,firstName VARCHAR(99) ,lastName VARCHAR(99),eSsn VARCHAR(9) NOT NULL,employeeDOB DATE,position ENUM('zooKeeper','waiter','cook','guide','cashier','superUser','ticketSeller','quarterMaster','departmentManager','vendor','bookKeeper'),employeeType ENUM('fullTime','partTime','volunteer'),sex ENUM('m','f'),employeeEmail VARCHAR(999),address text,departmentID INT,supID INT,PRIMARY KEY(employeeID),UNIQUE(Essn), FOREIGN KEY(supID) REFERENCES Employee(employeeID) on delete set null, FOREIGN KEY(departmentID) REFERENCES Department(departmentID) on delete set null)");
		
		
		$stmtCreateHab=$mysqlidb->prepare("CREATE TABLE Habitats(HabitatID INT AUTO_INCREMENT,Htype ENUM('cage','aquarium','fence'),Hname VARCHAR(999),status ENUM('okay','needs-maintenance','undergoing-maintenance'),PRIMARY KEY(habitatID))");

		
		$stmtCreateAni=$mysqlidb->prepare("CREATE TABLE Animals(animalID INT AUTO_INCREMENT,Aname VARCHAR(99),species varchar(99),animalDOB DATE,habitatID INT,sex ENUM('m','f'),departmentID INT,PRIMARY KEY(animalID),FOREIGN KEY(departmentID) REFERENCES Department(departmentID) on delete set null,FOREIGN KEY(habitatID) REFERENCES Habitats(habitatID) on delete set null)");

		
		$stmtCreateVen=$mysqlidb->prepare("CREATE TABLE Vendor(vendorID INT AUTO_INCREMENT,vendorType ENUM('food','retail','ride'),Vname VARCHAR(999),department INT,capacity INT,PRIMARY KEY(vendorID),FOREIGN KEY(department) REFERENCES Department(departmentID) on delete set null)");

		
		$stmtCreateEqu=$mysqlidb->prepare("CREATE TABLE EquipmentAndSupplies(ESID INT AUTO_INCREMENT,ESName VARCHAR(999),EStype ENUM('small-tools','large-tools','human-food-meat','vehicle','human-food-vegtable','animal-food-meat','animal-food-vegtable'),ESQuantity INT,department INT,PRIMARY KEY(ESID),FOREIGN KEY(department) REFERENCES Department(departmentID) on delete set null)");

		
		$stmtCreateMem=$mysqlidb->prepare("CREATE TABLE Members(memberID INT AUTO_INCREMENT, firstName VARCHAR(99),lastName VARCHAR(99),memberDOB DATE,memberSex ENUM('m','f'),memberEmail varchar(99),memberAddress TEXT,memberPhone VARCHAR(20),PRIMARY KEY(memberID))");

		
		$stmtCreateMemSal=$mysqlidb->prepare("CREATE TABLE MembershipSales(membershipOrderNum INT AUTO_INCREMENT,startDate DATE,endDate DATE,memberType ENUM('family','senior','single'),membershipPrice DECIMAL(9,2),memberID INT, PRIMARY KEY(membershipOrderNum),FOREIGN KEY(memberID) REFERENCES Members(memberID) on delete set null)");

		
		$stmtCreateTic=$mysqlidb->prepare("CREATE TABLE Tickets(serialNumber INT AUTO_INCREMENT,ticketType ENUM('student','senior','child','adult'),ticketPrice DECIMAL(5,2),date DATE,PRIMARY KEY(serialNumber))");
		
		
		$stmtCreateMemVis=$mysqlidb->prepare("CREATE TABLE MemberVisits(MID INT ,TimeStamp DATETIME,numOfPeople INT, PRIMARY KEY(MID,TimeStamp), FOREIGN KEY(MID) REFERENCES Members(memberID))");


		$stmtCreateEmpUse=$mysqlidb->prepare("CREATE TABLE EmployeeUsers(username VARCHAR(60),password VARCHAR(500),employeeID INT,PRIMARY KEY(username),FOREIGN KEY(employeeID) REFERENCES Employee(employeeID) on delete cascade)");

		$stmtCreateMemUse=$mysqlidb->prepare("CREATE TABLE MemberUsers(username VARCHAR(60),password VARCHAR(500),memberID INT,PRIMARY KEY(username),FOREIGN KEY(memberID) REFERENCES Members(memberID) on delete cascade)");
				
		$stmtCreateGros=$mysqlidb->prepare("CREATE TABLE GrossVendorSales(ID INT,Day DATE,saleAmount DECIMAL(10,2),PRIMARY KEY(ID,Day),FOREIGN KEY(ID) REFERENCES Vendor(vendorID) on delete cascade)");
		
		$stmtCreateEmpBack=$mysqlidb->prepare("CREATE TABLE EmployeeBackup(employeeID INT,firstName VARCHAR(99) ,lastName VARCHAR(99),eSsn VARCHAR(9) NOT NULL,employeeDOB DATE,position ENUM('zooKeeper','waiter','cook','guide','cashier','superUser','ticketSeller','quarterMaster','departmentManager','vendor','bookKeeper'),employeeType ENUM('fullTime','partTime','volunteer'),sex ENUM('m','f'),employeeEmail VARCHAR(999),address text,departmentID INT,supID INT, deleted timestamp default current_timestamp)");
		
		$stmtCreateMemBack=$mysqlidb->prepare("CREATE TABLE MembersBackup(memberID INT, firstName VARCHAR(99),lastName VARCHAR(99),memberDOB DATE,memberSex ENUM('m','f'),memberEmail varchar(99),memberAddress TEXT,memberPhone VARCHAR(20),deleted timestamp default current_timestamp)");
		

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
		if(!$stmtCreateGros->execute()){
			die('Failed to create GrossVendorSales table');
		}
		$stmtCreateGros->close();
		
		if(!$stmtCreateEmpBack->execute()){
			die('Failed to create EmployeeBackup table');
		}
		$stmtCreateEmpBack->close();

		if(!$mysqlidb->query("create trigger SaveEmployee before delete on Employee for each row insert into EmployeeBackup values(OLD.employeeid,OLD.firstname,OLD.lastname,OLD.essn,OLD.employeedob,OLD.position,OLD.employeetype,OLD.sex,OLD.employeeemail,OLD.address,OLD.departmentid,OLD.supid,DEFAULT)")){
			die('Failed to create EmployeeBackup Trigger');
		}

		if(!$stmtCreateMemBack->execute()){
			die('Failed to create MembersBackup table');
		}
		$stmtCreateMemBack->close();
		if(!$mysqlidb->query("create trigger SaveMember before delete on Members for each row insert into MembersBackup values(OLD.memberid,OLD.firstname,OLD.lastname,OLD.memberdob,OLD.membersex,OLD.memberemail,OLD.memberaddress,OLD.memberphone,DEFAULT)")){
			die('Failed to create MemberBackup Trigger');
		}

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


	
			
			$mysqlidb->query("INSERT INTO Habitats (Htype, Hname, status)
			VALUES ('fence', 'T-Rex pen', 'needs-maintenance');");

			$mysqlidb->query("INSERT INTO Habitats (Htype, Hname, status)
			VALUES ('fence', 'T-Rex pen 2', 'okay');");

			$mysqlidb->query("INSERT INTO Habitats (Htype, Hname, status)
			VALUES ('cage', 'Tiger pen', 'okay');");

			$mysqlidb->query("INSERT INTO Animals (Aname, species, animalDOB, habitatID, sex, departmentID)
			VALUES ('Toothy', 'Dinosaur', '2017-04-08', '1', 'f', '2');");

			$mysqlidb->query("INSERT INTO Vendor (vendorType, Vname, department, capacity)
			VALUES ('food', 'Peezahute', '7', '50');");

			$mysqlidb->query("INSERT INTO Vendor (vendorType, Vname, department, capacity)
			VALUES ('retail', 'The Junk Store', '6', '20');");


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
			$mysqlidb->query("INSERT INTO EquipmentAndSupplies VALUES (DEFAULT,'Shock Baton', 'small-tools', '20', '2')");
			$mysqlidb->query("INSERT INTO EquipmentAndSupplies VALUES (DEFAULT,'Mice', 'animal-food-meat', '20500', '2')");
			$mysqlidb->query("INSERT INTO EquipmentAndSupplies VALUES (DEFAULT,'25ft light Rope', 'small-tools', '3', '2')");
			$mysqlidb->query("INSERT INTO EquipmentAndSupplies VALUES (DEFAULT,'2015 Kawasaki Mule', 'vehicle', '1', '2')");
			$mysqlidb->query("INSERT INTO EquipmentAndSupplies VALUES (DEFAULT,'Post Driver', 'large-tools', '2', '2')");
			$mysqlidb->query("INSERT INTO EquipmentAndSupplies VALUES (DEFAULT,'Ribeye Steak', 'human-food-meat', '50', '6')");
			$mysqlidb->query("INSERT INTO EquipmentAndSupplies VALUES (DEFAULT,'2016 Jeep Wrangler', 'vehicle', '1', '9')");
			$mysqlidb->query("INSERT INTO EquipmentAndSupplies VALUES (DEFAULT,'2014 Jeep Wrangler', 'vehicle', '1', '9')");
			$mysqlidb->query("INSERT INTO EquipmentAndSupplies VALUES (DEFAULT,'Powered Wheelchair', 'vehicle', '5', '10')");
			$mysqlidb->query("INSERT INTO Tickets
			VALUES (DEFAULT,'child', '20000.00', '2015-03-01')");

			$mysqlidb->query("INSERT INTO Tickets
			VALUES (DEFAULT,'student', '20.00', '2017-03-01')");

			$mysqlidb->query("INSERT INTO Tickets
			VALUES (DEFAULT,'student', '20.00', '2017-03-01')");

			$mysqlidb->query("INSERT INTO Tickets 
			VALUES (DEFAULT,'student', '20.00', '2017-03-01')");

			$mysqlidb->query("INSERT INTO Tickets 
			VALUES (DEFAULT,'student', '20.00', '2017-03-01')");

			$mysqlidb->query("INSERT INTO Tickets 
			VALUES (DEFAULT,'child', '30.00', '2017-03-01')");

			$mysqlidb->query("INSERT INTO Tickets 
			VALUES (DEFAULT,'child', '30.00', '2017-03-01')");

			$mysqlidb->query("INSERT INTO Tickets
			VALUES (DEFAULT,'adult', '40.00', '2017-03-01')");

			$mysqlidb->query("INSERT INTO Tickets 
			VALUES (DEFAULT,'student', '20.00', '2017-03-01')");

			$mysqlidb->query("INSERT INTO Tickets 
			VALUES (DEFAULT,'senior', '30.00', '2017-03-01')");

			$mysqlidb->query("INSERT INTO Tickets 
			VALUES (DEFAULT,'senior', '30.00', '2017-03-02')");

			$mysqlidb->query("INSERT INTO Tickets 
			VALUES (DEFAULT,'child', '30.00', '2017-03-02')");

			$mysqlidb->query("INSERT INTO Tickets 
			VALUES (DEFAULT,'senior', '30.00', '2017-03-02')");

			$mysqlidb->query("INSERT INTO Tickets 
			VALUES (DEFAULT,'senior', '30.00', '2017-03-02')");

			$mysqlidb->query("INSERT INTO Tickets
			VALUES (DEFAULT,'senior', '30.00', '2017-03-02')");

			$mysqlidb->query("INSERT INTO Tickets 
			VALUES (DEFAULT,'child', '30.00', '2017-03-03')");

			$mysqlidb->query("INSERT INTO Tickets 
			VALUES (DEFAULT,'child', '30.00', '2017-03-03')");

			$mysqlidb->query("INSERT INTO Tickets
			VALUES (DEFAULT,'child', '30.00', '2017-03-03')");

			$mysqlidb->query("INSERT INTO Tickets
			VALUES (DEFAULT,'child', '30.00', '2017-03-03')");

			$mysqlidb->query("INSERT INTO Tickets
			VALUES (DEFAULT,'child', '30.00', '2017-03-03')");

			$mysqlidb->query("INSERT INTO Tickets
			VALUES (DEFAULT,'adult', '40.00', '2017-03-03')");

			$mysqlidb->query("INSERT INTO Tickets
			VALUES (DEFAULT,'senior', '30.00', '2017-03-03')");

			$mysqlidb->query("IINSERT INTO Tickets 
			VALUES (DEFAULT,'adult', '40.00', '2017-03-04')");

			$mysqlidb->query("IINSERT INTO Tickets 
			VALUES (DEFAULT,'adult', '40.00', '2017-03-04')");

			$mysqlidb->query("IINSERT INTO Tickets
			VALUES (DEFAULT,'adult', '40.00', '2017-03-04')");

			$mysqlidb->query("IINSERT INTO Tickets
			VALUES (DEFAULT,'adult', '40.00', '2017-03-04')");

			$mysqlidb->query("IINSERT INTO Tickets 
			VALUES (DEFAULT,'adult', '40.00', '2017-03-04')");

			$mysqlidb->query("INSERT INTO Tickets 
			VALUES (DEFAULT,'adult', '40.00', '2017-03-04')");

			$mysqlidb->query("INSERT INTO Tickets 
			VALUES (DEFAULT,'adult', '40.00', '2017-03-04')");

			$mysqlidb->query("INSERT INTO Tickets 
			VALUES (DEFAULT,'adult', '40.00', '2017-03-04')");

			$mysqlidb->query("INSERT INTO Tickets
			VALUES (DEFAULT,'student', '20.00', '2017-03-05')");

			$mysqlidb->query("INSERT INTO Tickets 
			VALUES (DEFAULT,'adult', '40.00', '2017-03-06')");

			$mysqlidb->query("INSERT INTO Tickets 
			VALUES (DEFAULT,'adult', '40.00', '2017-03-06')");

			$mysqlidb->query("INSERT INTO Tickets 
			VALUES (DEFAULT,'adult', '40.00', '2017-03-06')");

			$mysqlidb->query("INSERT INTO Tickets 
			VALUES (DEFAULT,'adult', '40.00', '2017-03-06')");

			$mysqlidb->query("INSERT INTO Tickets 
			VALUES (DEFAULT,'adult', '40.00', '2017-03-06')");

			$mysqlidb->query("INSERT INTO Tickets 
			VALUES (DEFAULT,'adult', '40.00', '2017-03-06')");

			$mysqlidb->query("INSERT INTO Tickets 
			VALUES (DEFAULT,'adult', '40.00', '2017-03-06')");

			$mysqlidb->query("INSERT INTO Tickets 
			VALUES (DEFAULT,'adult', '40.00', '2017-03-06')");

			$mysqlidb->query("INSERT INTO Tickets  
			VALUES (DEFAULT,'adult', '40.00', '2017-03-06')");

			$mysqlidb->query("INSERT INTO Tickets  
			VALUES (DEFAULT,'adult', '40.00', '2017-03-06')");

			$mysqlidb->query("	INSERT INTO Tickets  
			VALUES (DEFAULT,'adult', '40.00', '2017-03-06')");

			$mysqlidb->query("	INSERT INTO Tickets  
			VALUES (DEFAULT,'adult', '40.00', '2017-03-06')");

			$mysqlidb->query("	INSERT INTO Tickets  
			VALUES (DEFAULT,'adult', '40.00', '2017-03-06')");

			$mysqlidb->query("	INSERT INTO Tickets  
			VALUES (DEFAULT,'adult', '40.00', '2017-03-06')");

			$mysqlidb->query("	INSERT INTO Tickets  
			VALUES (DEFAULT,'adult', '40.00', '2017-03-07')");

			$mysqlidb->query("	INSERT INTO Tickets  
			VALUES (DEFAULT,'student', '20.00', '2017-03-08')");

			$mysqlidb->query("	INSERT INTO Tickets  
			VALUES (DEFAULT,'student', '20.00', '2017-03-09')");

			$mysqlidb->query("	INSERT INTO Tickets  
			VALUES (DEFAULT,'student', '20.00', '2017-03-10')");

			$mysqlidb->query("	INSERT INTO Tickets  
			VALUES (DEFAULT,'student', '20.00', '2017-03-11')");

			$mysqlidb->query("	INSERT INTO Tickets  
			VALUES (DEFAULT,'senior', '30.00', '2017-03-16')");

			$mysqlidb->query("	INSERT INTO Tickets  
			VALUES (DEFAULT,'student', '20.00', '2017-03-16')");

			$mysqlidb->query("	INSERT INTO Tickets  
			VALUES (DEFAULT,'senior', '30.00', '2017-05-25')");

			$mysqlidb->query("	INSERT INTO Tickets  
			VALUES (DEFAULT,'student', '20.00', '2017-05-25')");		
			
			$mysqlidb->query("INSERT INTO MemberVisits (MID, TimeStamp, numOfPeople)
			VALUES ('1', '2017-03-11 10:45:16', '2');");

			$mysqlidb->query("INSERT INTO MemberVisits (MID, TimeStamp, numOfPeople)
			VALUES ('1', '2017-04-08 09:42:16', '2');");

			$mysqlidb->query("INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-01', '13489.55');");

			$mysqlidb->query("INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-02', '16548.77');");

			$mysqlidb->query("INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-03', '1.25');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-04', '6897.20');");

			$mysqlidb->query("INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-05', '11000');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-06', '8000.42');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-07', '8011.42');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-08', '5860.99');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-09', '12345.67');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-10', '3333.55');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-11', '9876.54');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-12', '8888.54');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-13', '78984.10');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-14', '2684.54');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-15', '1111.54');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-16', '2222.54');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-17', '3333.54');");

			$mysqlidb->query("		INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-18', '4444.54');");

			$mysqlidb->query("		INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-19', '5555.54');");

			$mysqlidb->query("		INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-20', '6666.44');");

			$mysqlidb->query("		INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-21', '222.19');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-22', '1234.19');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-23', '5321.19');");

			$mysqlidb->query("		INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-24', '9999.19');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-25', '4561.15');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-26', '461.15');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-27', '19.15');");

			$mysqlidb->query("		INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-28', '9813.12');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-29', '451.15');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-30', '561.10');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-03-31', '999.99');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-04-01', '0.99');");

			$mysqlidb->query("		INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-04-02', '100000');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('1', '2017-04-03', '200000');");
			$mysqlidb->query("INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-01', '1.55');");

			$mysqlidb->query("INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-02', '2.77');");

			$mysqlidb->query("INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-03', '1.25');");

			$mysqlidb->query("INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-04', '7.20');");

			$mysqlidb->query("INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-05', '11');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-06', '8.42');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-07', '1.42');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-08', '0.99');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-09', '5.67');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-10', '3.55');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-11', '6.54');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-12', '8.54');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-13', '4.10');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-14', '4.54');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-15', '1.54');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-16', '2.54');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-17', '3.54');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-18', '4.54');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-19', '5.54');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-20', '6.44');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-21', '2.19');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-22', '4.19');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-23', '1.19');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-24', '9.19');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-25', '1.15');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-26', '1.15');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-27', '1.15');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-28', '3.12');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-29', '1.15');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-30', '1.10');");

			$mysqlidb->query("INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-03-31', '9.99');");

			$mysqlidb->query("INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-04-01', '10.99');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-04-02', '10');");

			$mysqlidb->query("	INSERT INTO GrossVendorSales (ID, Day, saleAmount)
			VALUES ('2', '2017-04-03', '2');");

			header('Location: /loginform.php');
		}
		else{
			echo 'could not add user setup aborted!';
		}
		
	}
}

?>