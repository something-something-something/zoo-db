-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: adb
-- ------------------------------------------------------
-- Server version	5.7.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Animals`
--

DROP TABLE IF EXISTS `Animals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Animals` (
  `animalID` int(11) NOT NULL AUTO_INCREMENT,
  `Aname` varchar(99) DEFAULT NULL,
  `species` varchar(99) DEFAULT NULL,
  `animalDOB` date DEFAULT NULL,
  `habitatID` int(11) DEFAULT NULL,
  `sex` enum('m','f') DEFAULT NULL,
  `departmentID` int(11) DEFAULT NULL,
  PRIMARY KEY (`animalID`),
  KEY `departmentID` (`departmentID`),
  KEY `habitatID` (`habitatID`),
  CONSTRAINT `Animals_ibfk_1` FOREIGN KEY (`departmentID`) REFERENCES `Department` (`departmentID`) ON DELETE SET NULL,
  CONSTRAINT `Animals_ibfk_2` FOREIGN KEY (`habitatID`) REFERENCES `Habitats` (`HabitatID`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Animals`
--

LOCK TABLES `Animals` WRITE;
/*!40000 ALTER TABLE `Animals` DISABLE KEYS */;
INSERT INTO `Animals` VALUES (1,'Toothy','T-Rex','2017-04-08',1,'f',2),(2,'Sir Purrsalot','Tiger','2017-04-05',3,'m',5);
/*!40000 ALTER TABLE `Animals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Department`
--

DROP TABLE IF EXISTS `Department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Department` (
  `departmentID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`departmentID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Department`
--

LOCK TABLES `Department` WRITE;
/*!40000 ALTER TABLE `Department` DISABLE KEYS */;
INSERT INTO `Department` VALUES (1,'IT'),(2,'Reptiles'),(3,'Small Animals'),(4,'Aquatic'),(5,'Large Mammals'),(6,'Food And Beverages'),(7,'Retail'),(8,'Park Maintenance'),(9,'Security'),(10,'Customer Service'),(11,'Administration');
/*!40000 ALTER TABLE `Department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Employee`
--

DROP TABLE IF EXISTS `Employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Employee` (
  `employeeID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(99) DEFAULT NULL,
  `lastName` varchar(99) DEFAULT NULL,
  `eSsn` varchar(9) NOT NULL,
  `employeeDOB` date DEFAULT NULL,
  `position` enum('zooKeeper','waiter','cook','guide','cashier','superUser','ticketSeller','quarterMaster','departmentManager','vendor','bookKeeper') DEFAULT NULL,
  `employeeType` enum('fullTime','partTime','volunteer') DEFAULT NULL,
  `sex` enum('m','f') DEFAULT NULL,
  `employeeEmail` varchar(999) DEFAULT NULL,
  `address` text,
  `departmentID` int(11) DEFAULT NULL,
  `supID` int(11) DEFAULT NULL,
  PRIMARY KEY (`employeeID`),
  UNIQUE KEY `eSsn` (`eSsn`),
  KEY `supID` (`supID`),
  KEY `departmentID` (`departmentID`),
  CONSTRAINT `Employee_ibfk_1` FOREIGN KEY (`supID`) REFERENCES `Employee` (`employeeID`) ON DELETE SET NULL,
  CONSTRAINT `Employee_ibfk_2` FOREIGN KEY (`departmentID`) REFERENCES `Department` (`departmentID`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Employee`
--

LOCK TABLES `Employee` WRITE;
/*!40000 ALTER TABLE `Employee` DISABLE KEYS */;
INSERT INTO `Employee` VALUES (1,'Test','Last','123456789','2010-10-21','superUser',NULL,'m','r@example.com','1234 Some St',NULL,NULL),(2,'Robert','Green','000000000','1987-04-09','cook','fullTime','f','emailuser0@example.com','1234 Some St',NULL,NULL),(3,'Tom','Sarasti','100000000','1978-07-10','cook','fullTime','m','emailuser1@example.com','1234 Some St',NULL,NULL),(4,'John','Cunningham','200000000','1991-06-05','cook','fullTime','m','emailuser2@example.com','1234 Some St',NULL,NULL),(5,'Lucy','Black','300000000','1980-04-17','cook','fullTime','f','emailuser3@example.com','1234 Some St',NULL,NULL),(6,'Jill','Keeton','400000000','1987-03-09','cook','fullTime','m','emailuser4@example.com','1234 Some St',NULL,NULL),(7,'John','Green','500000000','1993-01-20','cook','fullTime','m','emailuser5@example.com','1234 Some St',NULL,NULL),(8,'Abby','Green','600000000','1962-04-04','cook','fullTime','f','emailuser6@example.com','1234 Some St',NULL,NULL),(9,'Helen','Black','700000000','1977-06-05','cook','fullTime','f','emailuser7@example.com','1234 Some St',NULL,NULL),(10,'Jukka','Bates','800000000','1963-11-18','cook','fullTime','f','emailuser8@example.com','1234 Some St',NULL,NULL),(11,'Jill','Smith','900000000','1979-02-03','cook','fullTime','m','emailuser9@example.com','1234 Some St',NULL,NULL),(13,'Robert','Green','110000000','1994-06-18','cook','fullTime','f','emailuser11@example.com','1234 Some St',NULL,NULL),(14,'Robert','Cunningham','120000000','1988-11-15','cook','fullTime','m','emailuser12@example.com','1234 Some St',NULL,NULL),(15,'Jukka','Doe','130000000','1960-11-10','cook','fullTime','f','emailuser13@example.com','1234 Some St',NULL,NULL),(16,'Jukka','Sarasti','140000000','1960-06-13','cook','fullTime','m','emailuser14@example.com','1234 Some St',NULL,NULL),(17,'Jane','Green','150000000','1982-08-05','cook','fullTime','f','emailuser15@example.com','1234 Some St',NULL,NULL),(18,'Ben','Cunningham','160000000','1977-08-04','cook','fullTime','f','emailuser16@example.com','1234 Some St',NULL,NULL),(19,'Jukka','Doe','170000000','1972-01-10','cook','fullTime','f','emailuser17@example.com','1234 Some St',NULL,NULL),(20,'William','Green','180000000','1992-06-02','cook','fullTime','f','emailuser18@example.com','1234 Some St',NULL,NULL),(21,'Abby','Bates','190000000','1991-05-16','cook','fullTime','f','emailuser19@example.com','1234 Some St',NULL,NULL);
/*!40000 ALTER TABLE `Employee` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`g20`@`%`*/ /*!50003 trigger SaveEmployee before delete on Employee for each row insert into EmployeeBackup values(OLD.employeeid,OLD.firstname,OLD.lastname,OLD.essn,OLD.employeedob,OLD.position,OLD.employeetype,OLD.sex,OLD.employeeemail,OLD.address,OLD.departmentid,OLD.supid,DEFAULT) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `EmployeeBackup`
--

DROP TABLE IF EXISTS `EmployeeBackup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EmployeeBackup` (
  `employeeID` int(11) DEFAULT NULL,
  `firstName` varchar(99) DEFAULT NULL,
  `lastName` varchar(99) DEFAULT NULL,
  `eSsn` varchar(9) NOT NULL,
  `employeeDOB` date DEFAULT NULL,
  `position` enum('zooKeeper','waiter','cook','guide','cashier','superUser','ticketSeller','quarterMaster','departmentManager','vendor','bookKeeper') DEFAULT NULL,
  `employeeType` enum('fullTime','partTime','volunteer') DEFAULT NULL,
  `sex` enum('m','f') DEFAULT NULL,
  `employeeEmail` varchar(999) DEFAULT NULL,
  `address` text,
  `departmentID` int(11) DEFAULT NULL,
  `supID` int(11) DEFAULT NULL,
  `deleted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EmployeeBackup`
--

LOCK TABLES `EmployeeBackup` WRITE;
/*!40000 ALTER TABLE `EmployeeBackup` DISABLE KEYS */;
/*!40000 ALTER TABLE `EmployeeBackup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EmployeeUsers`
--

DROP TABLE IF EXISTS `EmployeeUsers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EmployeeUsers` (
  `username` varchar(60) NOT NULL,
  `password` varchar(500) DEFAULT NULL,
  `employeeID` int(11) DEFAULT NULL,
  PRIMARY KEY (`username`),
  KEY `employeeID` (`employeeID`),
  CONSTRAINT `EmployeeUsers_ibfk_1` FOREIGN KEY (`employeeID`) REFERENCES `Employee` (`employeeID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EmployeeUsers`
--

LOCK TABLES `EmployeeUsers` WRITE;
/*!40000 ALTER TABLE `EmployeeUsers` DISABLE KEYS */;
INSERT INTO `EmployeeUsers` VALUES ('e','$2y$10$WdlO8hSW/6SXxYIZkS3jIusTm7m77zLYvioG7.SOSzEexUaRdsCCG',1),('randomEmployeeUsername0','$2y$10$DtdKRcRnVEP7z00xyrxig.UcxDOH2qG3ECtmQNMADPJPeYlflhGAO',2),('randomEmployeeUsername1','$2y$10$/uSdeIDusXeB10cgavxUB.FbvJJcOj3slBghpXgDVQPh37R4cmrAe',3),('randomEmployeeUsername11','$2y$10$H9hVR9P2G1DkIvpSzrhaRuvISXMOtrHayHw6OlBM.uGIPwJGbg87W',13),('randomEmployeeUsername12','$2y$10$4CKSk8laSCw9E8FCn4Qlm.piQKp300RVd7gMWlNGxTo956QPZYqWK',14),('randomEmployeeUsername13','$2y$10$K.MVXgYuZT9ZVebqvB/CIOV5Fom8XMYg4mU6gSSBP3fjeha69lTTC',15),('randomEmployeeUsername14','$2y$10$btF5ebEPpyeidv0iR9gNCuCLMNNP/L2uQYX5uuqGtUGpj7rMvbB9i',16),('randomEmployeeUsername15','$2y$10$lyC0Zt4VZkJCUQfTT9IybuDJvmwYvmLUENoOTlhXZMeIZFlDlyfme',17),('randomEmployeeUsername16','$2y$10$MdRrXSDBW2G7rLymowwIT.hhv8bRCSMs939sZp/QrH3uZn8gwXCU2',18),('randomEmployeeUsername17','$2y$10$F1HdrtKQKnHzhs16VrJcFeLmdB8xrJ3HcFsrcGAcIbDpp344k885S',19),('randomEmployeeUsername18','$2y$10$KwZ31zqvEz9J8hqBHgQfTemlspN0mP2rMB2Iw/YQWs4F6xbmORM/u',20),('randomEmployeeUsername19','$2y$10$.Q/S0zJES.un.ECj3w.dJegLeeoSBemcKnI25u4v/JnSRdRtEigBC',21),('randomEmployeeUsername2','$2y$10$imeQ7hHWQtcbyuxLrGwOheVIzne4sfIX/oY5ePSBn/tS8jFI7XXhO',4),('randomEmployeeUsername3','$2y$10$i95X4K73bpho0M88UvuSyuQfTXPvxNRVMnckhe2K0JfIVX.LO0Od6',5),('randomEmployeeUsername4','$2y$10$xtHfXBwgILLvGQyDn8ok/elhexJgK3Pp7e2mx43X7armD.CoErRqO',6),('randomEmployeeUsername5','$2y$10$yD9GRv58dVdJNy1K94qaFOUfgnse/HEMPuXBFCU27EWFv4CDGgHGS',7),('randomEmployeeUsername6','$2y$10$sP94awiDNYZ7mliBaz9C8exFfSIE8lqcLvcq7n/VhZx9P8SOQGLjK',8),('randomEmployeeUsername7','$2y$10$o.rVg6do8HqsBZ75aKBV/e7/Y2QDEMb9Hd94wQuIDtBSrkd5ZyqaS',9),('randomEmployeeUsername8','$2y$10$CQIa.cdZBCaq//g3aG4sj.vOYomUTns5mVZZxElI4qO3VIyRh/4JS',10),('randomEmployeeUsername9','$2y$10$/vM1DpFh6EBiCNHFll8F9eYErZe7/lp44K9.6YTPmV0dU0Crx7Dxe',11);
/*!40000 ALTER TABLE `EmployeeUsers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EquipmentAndSupplies`
--

DROP TABLE IF EXISTS `EquipmentAndSupplies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EquipmentAndSupplies` (
  `ESID` int(11) NOT NULL AUTO_INCREMENT,
  `ESName` varchar(999) DEFAULT NULL,
  `EStype` enum('small-tools','large-tools','human-food-meat','vehicle','human-food-vegtable','animal-food-meat','animal-food-vegtable') DEFAULT NULL,
  `ESQuantity` int(11) DEFAULT NULL,
  `department` int(11) DEFAULT NULL,
  PRIMARY KEY (`ESID`),
  KEY `department` (`department`),
  CONSTRAINT `EquipmentAndSupplies_ibfk_1` FOREIGN KEY (`department`) REFERENCES `Department` (`departmentID`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EquipmentAndSupplies`
--

LOCK TABLES `EquipmentAndSupplies` WRITE;
/*!40000 ALTER TABLE `EquipmentAndSupplies` DISABLE KEYS */;
INSERT INTO `EquipmentAndSupplies` VALUES (1,'Shock Baton','small-tools',20,2),(2,'Mice','animal-food-meat',20500,2),(3,'25ft light Rope','small-tools',3,2),(4,'2015 Kawasaki Mule','vehicle',1,2),(5,'Post Driver','large-tools',2,2),(6,'Ribeye Steak','human-food-meat',50,6),(7,'2016 Jeep Wrangler','vehicle',1,9),(8,'2014 Jeep Wrangler','vehicle',1,9),(9,'Powered Wheelchair','vehicle',5,10);
/*!40000 ALTER TABLE `EquipmentAndSupplies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GrossVendorSales`
--

DROP TABLE IF EXISTS `GrossVendorSales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GrossVendorSales` (
  `ID` int(11) NOT NULL,
  `Day` date NOT NULL,
  `saleAmount` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`ID`,`Day`),
  CONSTRAINT `GrossVendorSales_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `Vendor` (`vendorID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GrossVendorSales`
--

LOCK TABLES `GrossVendorSales` WRITE;
/*!40000 ALTER TABLE `GrossVendorSales` DISABLE KEYS */;
INSERT INTO `GrossVendorSales` VALUES (1,'2015-03-01',1000.00),(1,'2016-02-01',1.00),(1,'2017-03-01',1.00),(1,'2017-03-02',1.00),(1,'2017-03-03',1.00),(1,'2017-03-04',1.00),(1,'2017-03-05',1.00),(1,'2017-03-06',1.00),(1,'2017-03-07',1.00),(1,'2017-03-08',100.00),(1,'2017-03-09',100.00),(1,'2017-03-10',100.00),(1,'2017-03-11',100.00),(1,'2017-03-12',100.00),(1,'2017-03-13',100.00),(1,'2017-03-14',100.00),(1,'2017-03-15',1111.54),(1,'2017-03-16',2222.54),(1,'2017-03-17',3333.54),(1,'2017-03-18',4444.54),(1,'2017-03-19',5555.54),(1,'2017-03-20',6666.44),(1,'2017-03-21',222.19),(1,'2017-03-22',1234.19),(1,'2017-03-23',5321.19),(1,'2017-03-24',9999.19),(1,'2017-03-25',4561.15),(1,'2017-03-26',461.15),(1,'2017-03-27',19.15),(1,'2017-03-28',9813.12),(1,'2017-03-29',451.15),(1,'2017-03-30',561.10),(1,'2017-03-31',999.99),(1,'2017-04-01',0.99),(1,'2017-04-02',100000.00),(1,'2017-04-03',200000.00),(2,'2017-03-01',1.55),(2,'2017-03-02',2.77),(2,'2017-03-03',1.25),(2,'2017-03-04',7.20),(2,'2017-03-05',11.00),(2,'2017-03-06',8.42),(2,'2017-03-07',1.42),(2,'2017-03-08',0.99),(2,'2017-03-09',5.67),(2,'2017-03-10',3.55),(2,'2017-03-11',6.54),(2,'2017-03-12',8.54),(2,'2017-03-13',4.10),(2,'2017-03-14',4.54),(2,'2017-03-15',1.54),(2,'2017-03-16',2.54),(2,'2017-03-17',3.54),(2,'2017-03-18',4.54),(2,'2017-03-19',5.54),(2,'2017-03-20',6.44),(2,'2017-03-21',2.19),(2,'2017-03-22',4.19),(2,'2017-03-23',1.19),(2,'2017-03-24',9.19),(2,'2017-03-25',1.15),(2,'2017-03-26',1.15),(2,'2017-03-27',1.15),(2,'2017-03-28',3.12),(2,'2017-03-29',1.15),(2,'2017-03-30',1.10),(2,'2017-03-31',9.99),(2,'2017-04-01',10.99),(2,'2017-04-02',10.00),(2,'2017-04-03',2.00);
/*!40000 ALTER TABLE `GrossVendorSales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Habitats`
--

DROP TABLE IF EXISTS `Habitats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Habitats` (
  `HabitatID` int(11) NOT NULL AUTO_INCREMENT,
  `Htype` enum('cage','aquarium','fence') DEFAULT NULL,
  `Hname` varchar(999) DEFAULT NULL,
  `status` enum('okay','needs-maintenance','undergoing-maintenance') DEFAULT NULL,
  PRIMARY KEY (`HabitatID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Habitats`
--

LOCK TABLES `Habitats` WRITE;
/*!40000 ALTER TABLE `Habitats` DISABLE KEYS */;
INSERT INTO `Habitats` VALUES (1,'fence','T-Rex pen','needs-maintenance'),(2,'fence','T-Rex pen 2','okay'),(3,'cage','Tiger pen','okay');
/*!40000 ALTER TABLE `Habitats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MemberUsers`
--

DROP TABLE IF EXISTS `MemberUsers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MemberUsers` (
  `username` varchar(60) NOT NULL,
  `password` varchar(500) DEFAULT NULL,
  `memberID` int(11) DEFAULT NULL,
  PRIMARY KEY (`username`),
  KEY `memberID` (`memberID`),
  CONSTRAINT `MemberUsers_ibfk_1` FOREIGN KEY (`memberID`) REFERENCES `Members` (`memberID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MemberUsers`
--

LOCK TABLES `MemberUsers` WRITE;
/*!40000 ALTER TABLE `MemberUsers` DISABLE KEYS */;
INSERT INTO `MemberUsers` VALUES ('randMem0','$2y$10$hAl9.341YXbaKutB5chv2OrqOAsv14DeoMbKyNEmxRXDCQXFcOyHW',1),('randMem1','$2y$10$VSdNsTP3IJIj0i7RLwcqt.DvcRXLLRZB4olDmeSSc4suSTUPW4f6m',2),('randMem10','$2y$10$GEUmsoxNpEnu7fndx2t/1.XAzTAUsQmcfkePz8ZOaWHyr66Ezf7Bm',11),('randMem11','$2y$10$MtJT/Bxw.e78aWEICmOGI.wuSYgORpnhR3JSrhdd22FFyraakafry',12),('randMem12','$2y$10$nXlrAqdurF8Zd4rsSrGXXu9o3056GrD.sfv5Eqk.4MC2RDQ/A0xdq',13),('randMem13','$2y$10$5.REfosCl0xI2beBu2ylPeDJU1tQSkvhoDXUHzGj86crqbDdUxoSK',14),('randMem14','$2y$10$8AsND.b4oNaX.RuJgGHS2ebT/Wta5Mx2ghcHfY4ANTx6/WdDDQ6J6',15),('randMem15','$2y$10$5L20nta7svMGEcV5omNP7OF/xgbv9CVcOLDzP/DjqHJLMiWRnucy.',16),('randMem16','$2y$10$r7rt1Vh2PYrLjyZl/T3ILO9d2mavmYUlE4ZAZHf/72ncENOjHS3WS',17),('randMem17','$2y$10$dgMW/8yLvpq1uiaDG6Q2geL8Izf8kfJNcstV7ZqL2aMkPWGOIx.le',18),('randMem18','$2y$10$14aWM5ngUy5F8H02PLRaWuO8f/IZdR8CZ1hSy5HyMvQxh8Lg2Z70m',19),('randMem19','$2y$10$4H2u3AxhNvcq8R4.D.D6AeO4BaPVVr0lOXDxDNoWFpqD5nIxRdoxq',20),('randMem2','$2y$10$aEBun5R73DNoWFN7fkuXD.RkuxzMGv4JQtytHKQ0GUCjqTgZ/hcIm',3),('randMem3','$2y$10$G2wAK2rgy2FT8E9MUhTYvuSnWFSCaMuV7BC3VSF5VcRWKsqYjX2FO',4),('randMem4','$2y$10$2o6QYLwXIefKs4FXYti0KeH1K4PPC6jW1Y9P42oQ74KeOhOepYwEK',5),('randMem5','$2y$10$kfw6Pr4FT2Sf6fU5BGk6j.gIMznoNdERADMcu/Z1Mm2nk8tHhgWTO',6),('randMem6','$2y$10$FkUfq9KBdreqe95ZGiVPKO8B9W3Hxp9FrZcilFKmdHCbVoB2c4TXq',7),('randMem7','$2y$10$y1EMbDEtThzEbVLslgg4JeomWFo7S5kJuXw5IDs/LXFSKuykdGYye',8),('randMem8','$2y$10$1Xy700hKMmsMMTc19pFhuOZH5J/gnQv4eusL.QZsuc0UupgAsJIsm',9),('randMem9','$2y$10$LA4rQdvMDEgTSlr9aWs1d.e9LKpIyW98k04Jb/xeFFSZ9zU.5r4c.',10);
/*!40000 ALTER TABLE `MemberUsers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MemberVisits`
--

DROP TABLE IF EXISTS `MemberVisits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MemberVisits` (
  `MID` int(11) NOT NULL,
  `TimeStamp` datetime NOT NULL,
  `numOfPeople` int(11) DEFAULT NULL,
  PRIMARY KEY (`MID`,`TimeStamp`),
  CONSTRAINT `MemberVisits_ibfk_1` FOREIGN KEY (`MID`) REFERENCES `Members` (`memberID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MemberVisits`
--

LOCK TABLES `MemberVisits` WRITE;
/*!40000 ALTER TABLE `MemberVisits` DISABLE KEYS */;
INSERT INTO `MemberVisits` VALUES (1,'2014-03-11 10:45:16',1),(1,'2014-04-08 09:42:16',2),(1,'2016-01-01 11:42:16',1),(1,'2017-03-11 10:45:16',2),(1,'2017-04-09 09:42:16',4),(1,'2017-04-10 09:42:16',1),(1,'2017-06-13 09:42:16',1),(1,'2017-06-14 09:42:16',1),(1,'2017-06-15 09:42:16',1),(1,'2017-06-16 09:42:16',1),(1,'2017-06-17 09:42:16',1),(2,'2015-04-08 09:42:16',2),(2,'2017-03-11 11:42:16',1),(2,'2017-04-20 09:42:16',3),(2,'2017-05-07 09:42:16',1),(3,'2015-04-08 09:42:16',5),(3,'2017-05-15 09:42:16',3);
/*!40000 ALTER TABLE `MemberVisits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Members`
--

DROP TABLE IF EXISTS `Members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Members` (
  `memberID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(99) DEFAULT NULL,
  `lastName` varchar(99) DEFAULT NULL,
  `memberDOB` date DEFAULT NULL,
  `memberSex` enum('m','f') DEFAULT NULL,
  `memberEmail` varchar(99) DEFAULT NULL,
  `memberAddress` text,
  `memberPhone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`memberID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Members`
--

LOCK TABLES `Members` WRITE;
/*!40000 ALTER TABLE `Members` DISABLE KEYS */;
INSERT INTO `Members` VALUES (1,'Jill','Sarasti','1967-06-03','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(2,'Helen','James','1971-08-02','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(3,'Jukka','Bates','1988-09-03','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(4,'Abby','Green','1986-08-16','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(5,'Lucy','Bates','1969-08-08','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(6,'Sally','Smith','1991-03-10','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(7,'John','Poole','1994-06-05','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(8,'Lucy','James','1967-05-06','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(9,'John','Green','1997-01-13','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(10,'Sally','Keeton','1961-08-13','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(11,'Lucy','Keeton','1991-02-01','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(12,'Helen','James','1972-06-10','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(13,'Helen','Sarasti','1985-09-09','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(14,'Abby','Cunningham','1976-03-08','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(15,'Jane','Bates','1979-11-07','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(16,'Abby','James','1971-11-03','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(17,'John','Sarasti','1981-05-06','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(18,'Helen','Black','1961-08-09','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(19,'Ben','Smith','1985-04-06','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(20,'Jukka','Black','1974-08-16','f','memberemail@example.com','1234 Some Other St','713 123 4578');
/*!40000 ALTER TABLE `Members` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`g20`@`%`*/ /*!50003 trigger SaveMember before delete on Members for each row insert into MembersBackup values(OLD.memberid,OLD.firstname,OLD.lastname,OLD.memberdob,OLD.membersex,OLD.memberemail,OLD.memberaddress,OLD.memberphone,DEFAULT) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `MembersBackup`
--

DROP TABLE IF EXISTS `MembersBackup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MembersBackup` (
  `memberID` int(11) DEFAULT NULL,
  `firstName` varchar(99) DEFAULT NULL,
  `lastName` varchar(99) DEFAULT NULL,
  `memberDOB` date DEFAULT NULL,
  `memberSex` enum('m','f') DEFAULT NULL,
  `memberEmail` varchar(99) DEFAULT NULL,
  `memberAddress` text,
  `memberPhone` varchar(20) DEFAULT NULL,
  `deleted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MembersBackup`
--

LOCK TABLES `MembersBackup` WRITE;
/*!40000 ALTER TABLE `MembersBackup` DISABLE KEYS */;
/*!40000 ALTER TABLE `MembersBackup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MembershipSales`
--

DROP TABLE IF EXISTS `MembershipSales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MembershipSales` (
  `membershipOrderNum` int(11) NOT NULL AUTO_INCREMENT,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `memberType` enum('family','senior','single') DEFAULT NULL,
  `membershipPrice` decimal(9,2) DEFAULT NULL,
  `memberID` int(11) DEFAULT NULL,
  PRIMARY KEY (`membershipOrderNum`),
  KEY `memberID` (`memberID`),
  CONSTRAINT `MembershipSales_ibfk_1` FOREIGN KEY (`memberID`) REFERENCES `Members` (`memberID`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MembershipSales`
--

LOCK TABLES `MembershipSales` WRITE;
/*!40000 ALTER TABLE `MembershipSales` DISABLE KEYS */;
INSERT INTO `MembershipSales` VALUES (1,'2016-10-10','2017-10-10','senior',59.99,1),(2,'2016-10-09','2017-10-09','single',89.99,2);
/*!40000 ALTER TABLE `MembershipSales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Tickets`
--

DROP TABLE IF EXISTS `Tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Tickets` (
  `serialNumber` int(11) NOT NULL AUTO_INCREMENT,
  `ticketType` enum('student','senior','child','adult') DEFAULT NULL,
  `ticketPrice` decimal(5,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`serialNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tickets`
--

LOCK TABLES `Tickets` WRITE;
/*!40000 ALTER TABLE `Tickets` DISABLE KEYS */;
INSERT INTO `Tickets` VALUES (1,'child',10.00,'2015-03-01'),(2,'child',10.00,'2016-01-01'),(3,'student',20.00,'2017-03-01'),(4,'student',20.00,'2017-03-01'),(5,'student',20.00,'2017-03-01'),(6,'student',20.00,'2017-03-01'),(7,'child',30.00,'2017-03-01'),(8,'child',30.00,'2017-03-01'),(9,'adult',40.00,'2017-03-01'),(10,'student',20.00,'2017-03-01'),(11,'senior',30.00,'2017-03-01'),(12,'senior',30.00,'2017-03-02'),(13,'child',30.00,'2017-03-02'),(14,'senior',30.00,'2017-03-02'),(15,'senior',30.00,'2017-03-02'),(16,'senior',30.00,'2017-03-02'),(17,'child',30.00,'2017-03-03'),(18,'child',30.00,'2017-03-03'),(19,'child',30.00,'2017-03-03'),(20,'child',30.00,'2017-03-03'),(21,'child',30.00,'2017-03-03'),(22,'adult',40.00,'2017-03-03'),(23,'senior',30.00,'2017-03-03'),(24,'adult',40.00,'2017-03-04'),(25,'adult',40.00,'2017-03-04'),(26,'adult',40.00,'2017-03-04'),(27,'student',20.00,'2017-03-05'),(28,'adult',40.00,'2017-03-06'),(29,'adult',40.00,'2017-03-06'),(30,'adult',40.00,'2017-03-06'),(31,'adult',40.00,'2017-03-06'),(32,'adult',40.00,'2017-03-06'),(33,'adult',40.00,'2017-03-06'),(34,'adult',40.00,'2017-03-06'),(35,'adult',40.00,'2017-03-06'),(36,'adult',40.00,'2017-03-06'),(37,'adult',40.00,'2017-03-06'),(38,'adult',40.00,'2017-03-06'),(39,'adult',40.00,'2017-03-06'),(40,'adult',40.00,'2017-03-06'),(41,'adult',40.00,'2017-03-06'),(42,'adult',40.00,'2017-03-07'),(43,'student',20.00,'2017-03-08'),(44,'student',20.00,'2017-03-09'),(45,'student',20.00,'2017-03-10'),(46,'student',20.00,'2017-03-11'),(47,'senior',30.00,'2017-03-16'),(48,'student',20.00,'2017-03-16'),(49,'senior',30.00,'2017-05-25'),(50,'student',20.00,'2017-05-25');
/*!40000 ALTER TABLE `Tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Vendor`
--

DROP TABLE IF EXISTS `Vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Vendor` (
  `vendorID` int(11) NOT NULL AUTO_INCREMENT,
  `vendorType` enum('food','retail','ride') DEFAULT NULL,
  `Vname` varchar(999) DEFAULT NULL,
  `department` int(11) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  PRIMARY KEY (`vendorID`),
  KEY `department` (`department`),
  CONSTRAINT `Vendor_ibfk_1` FOREIGN KEY (`department`) REFERENCES `Department` (`departmentID`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Vendor`
--

LOCK TABLES `Vendor` WRITE;
/*!40000 ALTER TABLE `Vendor` DISABLE KEYS */;
INSERT INTO `Vendor` VALUES (1,'food','Peezahute',6,50),(2,'retail','The Junk Store',7,20);
/*!40000 ALTER TABLE `Vendor` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-16  3:03:48
