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
  `taxonomy` varchar(99) DEFAULT NULL,
  `animalDOB` date DEFAULT NULL,
  `habitatID` int(11) DEFAULT NULL,
  `sex` enum('m','f') DEFAULT NULL,
  `departmentID` int(11) DEFAULT NULL,
  PRIMARY KEY (`animalID`),
  KEY `departmentID` (`departmentID`),
  KEY `habitatID` (`habitatID`),
  CONSTRAINT `Animals_ibfk_1` FOREIGN KEY (`departmentID`) REFERENCES `Department` (`departmentID`),
  CONSTRAINT `Animals_ibfk_2` FOREIGN KEY (`habitatID`) REFERENCES `Habitats` (`HabitatID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Animals`
--

LOCK TABLES `Animals` WRITE;
/*!40000 ALTER TABLE `Animals` DISABLE KEYS */;
INSERT INTO `Animals` VALUES (1,'Toothy','Dinosaur','2017-04-08',1,'f',2);
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Department`
--

LOCK TABLES `Department` WRITE;
/*!40000 ALTER TABLE `Department` DISABLE KEYS */;
INSERT INTO `Department` VALUES (1,'IT'),(2,'Reptiles'),(3,'Small Animals'),(4,'Aquatic'),(5,'Large Mammals'),(6,'Food And Beverages'),(7,'Retail'),(8,'Park Maintenance'),(9,'Security'),(10,'Customer Service');
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
  CONSTRAINT `Employee_ibfk_1` FOREIGN KEY (`supID`) REFERENCES `Employee` (`employeeID`),
  CONSTRAINT `Employee_ibfk_2` FOREIGN KEY (`departmentID`) REFERENCES `Department` (`departmentID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Employee`
--

LOCK TABLES `Employee` WRITE;
/*!40000 ALTER TABLE `Employee` DISABLE KEYS */;
INSERT INTO `Employee` VALUES (1,'q','w','123456789','2010-10-21','superUser',NULL,'m','r@example.com','1234 Some St',NULL,NULL),(2,'Sally','Smith','000000000','1995-12-17','cook','fullTime','m','emailuser0@example.com','1234 Some St',NULL,NULL),(3,'Jill','Cunningham','100000000','1976-08-11','cook','fullTime','f','emailuser1@example.com','1234 Some St',NULL,NULL),(4,'Tom','Doe','200000000','1983-03-05','cook','fullTime','f','emailuser2@example.com','1234 Some St',NULL,NULL),(5,'Susan','Poole','300000000','1973-01-04','cook','fullTime','m','emailuser3@example.com','1234 Some St',NULL,NULL),(6,'Abby','Cunningham','400000000','1964-09-15','cook','fullTime','f','emailuser4@example.com','1234 Some St',NULL,NULL),(7,'Lucy','Poole','500000000','1962-01-04','cook','fullTime','m','emailuser5@example.com','1234 Some St',NULL,NULL),(8,'Abby','Cunningham','600000000','1961-12-11','cook','fullTime','f','emailuser6@example.com','1234 Some St',NULL,NULL),(9,'Lucy','Doe','700000000','1975-05-06','cook','fullTime','f','emailuser7@example.com','1234 Some St',NULL,NULL),(10,'Abby','Keeton','800000000','1994-04-20','cook','fullTime','f','emailuser8@example.com','1234 Some St',NULL,NULL),(11,'Tom','Sarasti','900000000','1964-07-15','cook','fullTime','f','emailuser9@example.com','1234 Some St',NULL,NULL),(13,'Abby','Green','110000000','1968-10-16','cook','fullTime','m','emailuser11@example.com','1234 Some St',NULL,NULL),(14,'Jill','Black','120000000','1968-02-09','cook','fullTime','m','emailuser12@example.com','1234 Some St',NULL,NULL),(15,'Ben','Green','130000000','1985-11-10','cook','fullTime','f','emailuser13@example.com','1234 Some St',NULL,NULL),(16,'Ben','Green','140000000','1978-02-17','cook','fullTime','m','emailuser14@example.com','1234 Some St',NULL,NULL),(17,'Helen','Smith','150000000','1970-05-03','cook','fullTime','f','emailuser15@example.com','1234 Some St',NULL,NULL),(18,'Sally','Black','160000000','1993-07-03','cook','fullTime','m','emailuser16@example.com','1234 Some St',NULL,NULL),(19,'Jill','Cunningham','170000000','1960-09-15','cook','fullTime','f','emailuser17@example.com','1234 Some St',NULL,NULL),(20,'William','Black','180000000','1966-01-20','cook','fullTime','f','emailuser18@example.com','1234 Some St',NULL,NULL),(21,'Ben','Green','190000000','1969-06-16','cook','fullTime','m','emailuser19@example.com','1234 Some St',NULL,NULL);
/*!40000 ALTER TABLE `Employee` ENABLE KEYS */;
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
  CONSTRAINT `EmployeeUsers_ibfk_1` FOREIGN KEY (`employeeID`) REFERENCES `Employee` (`employeeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EmployeeUsers`
--

LOCK TABLES `EmployeeUsers` WRITE;
/*!40000 ALTER TABLE `EmployeeUsers` DISABLE KEYS */;
INSERT INTO `EmployeeUsers` VALUES ('e','$2y$10$vhgc6qfVCT77IlFKkjwyQ.LCxO8eo.lMV3bAw3n9mRe1s6QTTEoW2',1),('randomEmployeeUsername0','$2y$10$9MrJI48hQtUUoQZ2dyxzQe6JX8lPs77bbrlRW91J9Ssw4bS6xspFG',2),('randomEmployeeUsername1','$2y$10$z6G.kXl7ydynXyPUPoe19OUin94OtWPYtwWvsM.Cx7.d7J51JIt8C',3),('randomEmployeeUsername11','$2y$10$lBGYi64AogW1sI238vIJCulK.rw0Y4FV4n.7yqVzlUEkCFOQI9XQe',13),('randomEmployeeUsername12','$2y$10$bdIJcJYFDrkXI4FqYGgSu.sz/Gj.ihdMN8xSTWrTYaX11HOnmCIBa',14),('randomEmployeeUsername13','$2y$10$1fxuER3irw7JIbcdf3ZsMeASh90AW4KrqcKyYMai8B.E9916NtpMy',15),('randomEmployeeUsername14','$2y$10$ZId1CYD8rN3P1TSq64zCu.rtB129AkHBlQe0OzfXnU4e7f/3Z181K',16),('randomEmployeeUsername15','$2y$10$Ab8oNAfhw0Lui0A3InGtfOGSk7i/Xo7rQ9505MAL8wJN8DP52Hrpq',17),('randomEmployeeUsername16','$2y$10$lt3ZUvbkL53/iOakOhWKa.TTgi9JKHipnygr1OoGRFAiekTJ.QrSm',18),('randomEmployeeUsername17','$2y$10$KQk4Frn9/.i356nF5f4oP.XeSHIgM3YQvEE3gkY3F0plcwuvLAynm',19),('randomEmployeeUsername18','$2y$10$AdhbsBUmOzwU/KiCG8H2VO8j0P.k/SRe/WcGtKGPp6lHPiASW.5ea',20),('randomEmployeeUsername19','$2y$10$ybrD8HlApBRIVL9P19VqP.cbtZuCeogrqsbrS4KNG5kAmje6s5r96',21),('randomEmployeeUsername2','$2y$10$MJWPeQY3Pc9V8ktbf2jHlOiVhfQdeHrj6wvztizO6pqDJyGu7fApG',4),('randomEmployeeUsername3','$2y$10$/SQmJqSTfckf.Z6ojyFjt.STJOnYIVILNTUvFM2Xzlznz1Yh1Ms/W',5),('randomEmployeeUsername4','$2y$10$CFlburlpitL/xvuf/OddFeu7qpMP/fCnbVwt2m7EqpYGkYui41fJG',6),('randomEmployeeUsername5','$2y$10$YQ7JvVMYeSn37V04bsBtlORB0ULcGwJhUGrK8Wd0oMAQHGlyxN6f2',7),('randomEmployeeUsername6','$2y$10$BzMNs9VG4DABDfGRuQT.F.xtdOQawpasCHhjXC6fYb8l9P4H8djZa',8),('randomEmployeeUsername7','$2y$10$U0zLQizbgIwBV9tLqxmpd.pbWC90R0T054yaOZDan5Odb8Bus4xNC',9),('randomEmployeeUsername8','$2y$10$DowQABDe.ysbtqgzoqmke.gb.sHs20G8yCLOuz/88WPJ2EonaMavG',10),('randomEmployeeUsername9','$2y$10$sgEGkdLt7dTSzA18uiMyaeJY5JBlhrl.cv8WNYmMhCgWAk/trb5za',11);
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
  CONSTRAINT `EquipmentAndSupplies_ibfk_1` FOREIGN KEY (`department`) REFERENCES `Department` (`departmentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EquipmentAndSupplies`
--

LOCK TABLES `EquipmentAndSupplies` WRITE;
/*!40000 ALTER TABLE `EquipmentAndSupplies` DISABLE KEYS */;
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
  CONSTRAINT `GrossVendorSales_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `Vendor` (`vendorID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GrossVendorSales`
--

LOCK TABLES `GrossVendorSales` WRITE;
/*!40000 ALTER TABLE `GrossVendorSales` DISABLE KEYS */;
INSERT INTO `GrossVendorSales` VALUES (1,'2017-03-01',13489.55),(1,'2017-03-02',16548.77),(1,'2017-03-03',1.25),(1,'2017-03-04',6897.20),(1,'2017-03-05',11000.00),(1,'2017-03-06',8000.42),(1,'2017-03-07',8011.42),(1,'2017-03-08',5860.99),(1,'2017-03-09',12345.67),(1,'2017-03-10',3333.55),(1,'2017-03-11',9876.54),(1,'2017-03-12',8888.54),(1,'2017-03-13',78984.10),(1,'2017-03-14',2684.54),(1,'2017-03-15',1111.54),(1,'2017-03-16',2222.54),(1,'2017-03-17',3333.54),(1,'2017-03-18',4444.54),(1,'2017-03-19',5555.54),(1,'2017-03-20',6666.44),(1,'2017-03-21',222.19),(1,'2017-03-22',1234.19),(1,'2017-03-23',5321.19),(1,'2017-03-24',9999.19),(1,'2017-03-25',4561.15),(1,'2017-03-26',461.15),(1,'2017-03-27',19.15),(1,'2017-03-28',9813.12),(1,'2017-03-29',451.15),(1,'2017-03-30',561.10),(1,'2017-03-31',999.99),(1,'2017-04-01',0.99),(1,'2017-04-02',100000.00),(1,'2017-04-03',200000.00),(2,'2017-03-01',1.55),(2,'2017-03-02',2.77),(2,'2017-03-03',1.25),(2,'2017-03-04',7.20),(2,'2017-03-05',11.00),(2,'2017-03-06',8.42),(2,'2017-03-07',1.42),(2,'2017-03-08',0.99),(2,'2017-03-09',5.67),(2,'2017-03-10',3.55),(2,'2017-03-11',6.54),(2,'2017-03-12',8.54),(2,'2017-03-13',4.10),(2,'2017-03-14',4.54),(2,'2017-03-15',1.54),(2,'2017-03-16',2.54),(2,'2017-03-17',3.54),(2,'2017-03-18',4.54),(2,'2017-03-19',5.54),(2,'2017-03-20',6.44),(2,'2017-03-21',2.19),(2,'2017-03-22',4.19),(2,'2017-03-23',1.19),(2,'2017-03-24',9.19),(2,'2017-03-25',1.15),(2,'2017-03-26',1.15),(2,'2017-03-27',1.15),(2,'2017-03-28',3.12),(2,'2017-03-29',1.15),(2,'2017-03-30',1.10),(2,'2017-03-31',9.99),(2,'2017-04-01',10.99),(2,'2017-04-02',10.00),(2,'2017-04-03',2.00);
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
-- Table structure for table `Manages`
--

DROP TABLE IF EXISTS `Manages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Manages` (
  `eID` int(11) NOT NULL,
  `dID` int(11) NOT NULL,
  `startDATE` date NOT NULL,
  `endDate` date DEFAULT NULL,
  PRIMARY KEY (`eID`,`dID`,`startDATE`),
  KEY `dID` (`dID`),
  CONSTRAINT `Manages_ibfk_1` FOREIGN KEY (`eID`) REFERENCES `Employee` (`employeeID`),
  CONSTRAINT `Manages_ibfk_2` FOREIGN KEY (`dID`) REFERENCES `Department` (`departmentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Manages`
--

LOCK TABLES `Manages` WRITE;
/*!40000 ALTER TABLE `Manages` DISABLE KEYS */;
/*!40000 ALTER TABLE `Manages` ENABLE KEYS */;
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
  CONSTRAINT `MemberUsers_ibfk_1` FOREIGN KEY (`memberID`) REFERENCES `Members` (`memberID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MemberUsers`
--

LOCK TABLES `MemberUsers` WRITE;
/*!40000 ALTER TABLE `MemberUsers` DISABLE KEYS */;
INSERT INTO `MemberUsers` VALUES ('randMem0','$2y$10$GwnNT8DJ84ge9f/HvUllmuOw8CIbdGKQHmEsUc4uzzF9ONMWWRb26',1),('randMem1','$2y$10$9K4uir7ppWA.Nuim3dOgJOqivZIT69p0ZqruCbofN01j7euXaaXtq',2),('randMem10','$2y$10$jw.2p57ss080ejdA7XArPOY9P2nGHBCNuCijvPqyhFTdBO1unG0Ve',11),('randMem11','$2y$10$p9OdSiBLERbGYwEpSCg27umW3iqSnlOOHDY5dv.8KAGemQLJFCXnO',12),('randMem12','$2y$10$iS8m11oIxMNenh/0eHGNaOB91UZIaSayWrk7Bq75WnXXpt39NckhG',13),('randMem13','$2y$10$m3kHqFB8Prn9zUWg/0sj0ehLh6FfV926XRbCIvGAQa80ryJgSx6CS',14),('randMem14','$2y$10$qXcrMPC1ikORsmQKbKsZLOdm082RHFnfj6UmHJS9PjexDCOlcHkXO',15),('randMem15','$2y$10$05J.sFq7dCFkVkvw2PT8.ud4Mox/uAPaEEz4yVks//lp.I2vXXp16',16),('randMem16','$2y$10$AkgzZs9WTMUJWX/Fpm4Z8u0h8nfpPI1h/dHo.Ab6tjG/33TwUIsI6',17),('randMem17','$2y$10$QWBok9b4ZmiBnPk3wYRGbOARqRE4Zf6jsbL1I7wzSHb0ZkiOnMw42',18),('randMem18','$2y$10$l1LYAjnaZ0r9EcrpSFmvluvYf9h8yr8k9Wya044KTzYwFVRiYoDlO',19),('randMem19','$2y$10$XxdJ48PaVyY9misRPO4lJu3HdetoTsYL60bZ6GzQSQ49UgL5J34kG',20),('randMem2','$2y$10$8YvqgMU4JIN2cQrylMVzSuzkZSpJqmyf8Hn2f9yoQ2pEfzQ2BOQZq',3),('randMem3','$2y$10$4dgKXaMjsfotZq3wx6C0ReYr1FTGoSqTgm/5DRIA/Iz1cJW4VK9li',4),('randMem4','$2y$10$B/.nT5cHAuAQfopC5Nw/sODfdouYtDBB16t3NxWOMeE6g4XfbVuDa',5),('randMem5','$2y$10$LwhuG/p7f.L0Pq4vEFk2suECbJoJXE.v4i48BUWbPra6Phsa08dx2',6),('randMem6','$2y$10$jNMuPSJ6RnK5s2qwf35riOMTf1ydRDlvrjx2VL.gxFGdwTs5WVVQe',7),('randMem7','$2y$10$28BiDVH1ZONZ.wbCpUzu4up7mon.7PlhsM8sNGpHd.a5JODJSG/.e',8),('randMem8','$2y$10$n1kG5GfPa.awc9khOLM.w.0iFgVaF9WZPni.7jYsOA4lcEkIX6DUO',9),('randMem9','$2y$10$g/CVfYmbW3mklaGPtKYUPOIzGvkV26nrtKhCDOV5hNFrlkOI6Kol2',10);
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
INSERT INTO `MemberVisits` VALUES (1,'2017-03-11 10:45:16',2),(1,'2017-04-08 09:42:16',2);
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
INSERT INTO `Members` VALUES (1,'Jane','Black','1983-08-02','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(2,'Robert','James','1980-01-17','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(3,'John','Sarasti','1975-12-16','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(4,'Sally','Black','1997-10-05','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(5,'Abby','Doe','1976-05-15','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(6,'John','Keeton','1964-06-03','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(7,'Ben','James','1960-07-20','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(8,'Lucy','Cunningham','1971-04-09','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(9,'Lucy','Sarasti','1968-01-12','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(10,'Robert','Green','1992-06-11','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(11,'Sally','Poole','1962-03-02','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(12,'Susan','Sarasti','1965-02-19','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(13,'John','James','1967-12-02','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(14,'Helen','Smith','1980-08-16','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(15,'John','Doe','1987-05-02','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(16,'Robert','Keeton','1984-01-11','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(17,'Jill','Black','1983-09-05','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(18,'Jane','Green','1969-02-14','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(19,'Sally','Poole','1977-07-08','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(20,'Helen','Doe','1978-02-11','f','memberemail@example.com','1234 Some Other St','713 123 4578');
/*!40000 ALTER TABLE `Members` ENABLE KEYS */;
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
  CONSTRAINT `MembershipSales_ibfk_1` FOREIGN KEY (`memberID`) REFERENCES `Members` (`memberID`)
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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tickets`
--

LOCK TABLES `Tickets` WRITE;
/*!40000 ALTER TABLE `Tickets` DISABLE KEYS */;
INSERT INTO `Tickets` VALUES (1,'student',20.00,'2017-03-01'),(2,'student',20.00,'2017-03-01'),(3,'student',20.00,'2017-03-01'),(4,'student',20.00,'2017-03-01'),(5,'child',30.00,'2017-03-01'),(6,'child',30.00,'2017-03-01'),(7,'adult',40.00,'2017-03-01'),(8,'student',20.00,'2017-03-01'),(9,'senior',30.00,'2017-03-01'),(10,'senior',30.00,'2017-03-02'),(11,'child',30.00,'2017-03-02'),(12,'senior',30.00,'2017-03-02'),(13,'senior',30.00,'2017-03-02'),(14,'senior',30.00,'2017-03-02'),(15,'child',30.00,'2017-03-03'),(16,'child',30.00,'2017-03-03'),(17,'child',30.00,'2017-03-03'),(18,'child',30.00,'2017-03-03'),(19,'child',30.00,'2017-03-03'),(20,'adult',40.00,'2017-03-03'),(21,'senior',30.00,'2017-03-03'),(22,'adult',40.00,'2017-03-04'),(23,'adult',40.00,'2017-03-04'),(24,'adult',40.00,'2017-03-04'),(25,'student',20.00,'2017-03-05'),(26,'adult',40.00,'2017-03-06'),(27,'adult',40.00,'2017-03-06'),(28,'adult',40.00,'2017-03-06'),(29,'adult',40.00,'2017-03-06'),(30,'adult',40.00,'2017-03-06'),(31,'adult',40.00,'2017-03-06'),(32,'adult',40.00,'2017-03-06'),(33,'adult',40.00,'2017-03-06'),(34,'adult',40.00,'2017-03-06'),(35,'adult',40.00,'2017-03-06'),(36,'adult',40.00,'2017-03-06'),(37,'adult',40.00,'2017-03-06'),(38,'adult',40.00,'2017-03-06'),(39,'adult',40.00,'2017-03-06'),(40,'adult',40.00,'2017-03-07'),(41,'student',20.00,'2017-03-08'),(42,'student',20.00,'2017-03-09'),(43,'student',20.00,'2017-03-10'),(44,'student',20.00,'2017-03-11'),(45,'senior',30.00,'2017-03-16'),(46,'student',20.00,'2017-03-16'),(47,'senior',30.00,'2017-05-25'),(48,'student',20.00,'2017-05-25');
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
  CONSTRAINT `Vendor_ibfk_1` FOREIGN KEY (`department`) REFERENCES `Department` (`departmentID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Vendor`
--

LOCK TABLES `Vendor` WRITE;
/*!40000 ALTER TABLE `Vendor` DISABLE KEYS */;
INSERT INTO `Vendor` VALUES (1,'food','Peezahute',7,50),(2,'retail','The Junk Store',6,20);
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

-- Dump completed on 2017-04-09  7:28:46
