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
  CONSTRAINT `Animals_ibfk_1` FOREIGN KEY (`departmentID`) REFERENCES `Department` (`departmentID`),
  CONSTRAINT `Animals_ibfk_2` FOREIGN KEY (`habitatID`) REFERENCES `Habitats` (`HabitatID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Animals`
--

LOCK TABLES `Animals` WRITE;
/*!40000 ALTER TABLE `Animals` DISABLE KEYS */;
INSERT INTO `Animals` VALUES (1,'Toothy','Dinosaur','2017-04-08',1,'f',2),(2,'Test','test species2','2010-01-19',NULL,'m',3);
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
INSERT INTO `Employee` VALUES (1,'q','w','123456789','2010-10-21','superUser',NULL,'m','r@example.com','1234 Some St',NULL,NULL),(2,'Tom','Cunningham','000000000','1966-10-19','cook','fullTime','m','emailuser0@example.com','1234 Some St',NULL,NULL),(3,'Robert','James','100000000','1987-01-13','cook','fullTime','m','emailuser1@example.com','1234 Some St',NULL,NULL),(4,'Helen','Doe','200000000','1974-02-02','cook','fullTime','m','emailuser2@example.com','1234 Some St',NULL,NULL),(5,'Tom','Doe','300000000','1963-04-17','cook','fullTime','m','emailuser3@example.com','1234 Some St',NULL,NULL),(6,'Robert','Keeton','400000000','1984-01-03','cook','fullTime','m','emailuser4@example.com','1234 Some St',NULL,NULL),(7,'Jukka','Bates','500000000','1990-11-01','cook','fullTime','f','emailuser5@example.com','1234 Some St',NULL,NULL),(8,'Jukka','Green','600000000','1963-06-10','cook','fullTime','f','emailuser6@example.com','1234 Some St',NULL,NULL),(9,'Jane','Poole','700000000','1981-04-20','cook','fullTime','m','emailuser7@example.com','1234 Some St',NULL,NULL),(10,'Ben','Doe','800000000','1991-02-12','cook','fullTime','m','emailuser8@example.com','1234 Some St',NULL,NULL),(11,'Robert','Cunningham','900000000','1970-07-12','cook','fullTime','m','emailuser9@example.com','1234 Some St',NULL,NULL),(13,'Jukka','Doe','110000000','1969-02-07','cook','fullTime','m','emailuser11@example.com','1234 Some St',NULL,NULL),(14,'Jukka','Doe','120000000','1979-04-17','cook','fullTime','m','emailuser12@example.com','1234 Some St',NULL,NULL),(15,'Jukka','Green','130000000','1983-02-06','cook','fullTime','m','emailuser13@example.com','1234 Some St',NULL,NULL),(16,'Abby','Sarasti','140000000','1970-11-06','cook','fullTime','m','emailuser14@example.com','1234 Some St',NULL,NULL),(17,'Tom','Bates','150000000','1987-09-11','cook','fullTime','m','emailuser15@example.com','1234 Some St',NULL,NULL),(18,'William','Black','160000000','1975-12-10','cook','fullTime','m','emailuser16@example.com','1234 Some St',NULL,NULL),(19,'Abby','Poole','170000000','1966-02-07','cook','fullTime','f','emailuser17@example.com','1234 Some St',NULL,NULL),(20,'Robert','Poole','180000000','1984-01-04','cook','fullTime','f','emailuser18@example.com','1234 Some St',NULL,NULL),(21,'Ben','James','190000000','1987-10-13','cook','fullTime','m','emailuser19@example.com','1234 Some St',NULL,NULL);
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
INSERT INTO `EmployeeUsers` VALUES ('e','$2y$10$gT9VSR.Rb1qgufb2MPE4geaeaiQENm6R8LSIwoVMu2vYqXf.Ofvjm',1),('randomEmployeeUsername0','$2y$10$HWloCTc6nFgOUqJKHsxJCuYZZ4BKR5NTQAuanyItpuXoAy8uqgSke',2),('randomEmployeeUsername1','$2y$10$YVnsy5y4Nd/Ikd0dnARJfee5MKbzLR2fhyY1jyaSZxsCU2s9IjRry',3),('randomEmployeeUsername11','$2y$10$ju.FJmboyAQPR.vsvVkgROq1S3/bdvkwOJ2A5y9Dl2BtaYwsX1SqC',13),('randomEmployeeUsername12','$2y$10$NC/o.t2.UxqRB93COLgfR.QX3d7/ALZePvyt9NVlRwB5TE1AW6/0u',14),('randomEmployeeUsername13','$2y$10$y2Z/LxZx/1s0yCewIV68q.O8GEwMR.X1VAEe6cKL.2AfKzTolZVOe',15),('randomEmployeeUsername14','$2y$10$QLq5fkdft0enmFqsdJL/z.VRNqZ0gvzO31e1jbgwggYW4CDk6Z3/y',16),('randomEmployeeUsername15','$2y$10$q1LM2NcNVD.2CuT0G5PSAucdM7svci..n0YI6wTSbP3IqHI528Nd.',17),('randomEmployeeUsername16','$2y$10$lrN215oNdwHjeuqkTAS2.uS4wqp8XRnOxN08EZOabcMoUN/lhYOQq',18),('randomEmployeeUsername17','$2y$10$eEE.uQ8IOyDHGwq1N/D.qu65X.VEi6HKribQ89x.du8/o/TH0Tb5W',19),('randomEmployeeUsername18','$2y$10$B3ggBsLm4CykGSAcqrS22ubYq9v8HJkdlOYJyrqwCM/fQmRnzf0Hi',20),('randomEmployeeUsername19','$2y$10$d1mNKDqDmJOX0A6HCUS9geULSWjcvwJ.7sX64j.8qawAm5ikhXTbu',21),('randomEmployeeUsername2','$2y$10$hSzi5WNxjprkqs5hCLxLouRSLI60L3VoLFWOD6l0UXCDeykjSfQ02',4),('randomEmployeeUsername3','$2y$10$YQJnrm5LnMAYcg7yPqy/1OheNlYxcVP5ZwHirCZHPNrxy9FHk4af2',5),('randomEmployeeUsername4','$2y$10$4dzO/ke9pr68CRGPw3VQSOPys4ly0ToxKCa9PRXIoIiw8d5JGwTeq',6),('randomEmployeeUsername5','$2y$10$U5zZNjgCHtYz6SHZaU7SaulnJvfwj1QFBq6Ek0AGg8f92JoadXfX2',7),('randomEmployeeUsername6','$2y$10$bfMkMZStdWmCKZvgNbmafeKyiR5qau.VOulJ.nhY27XP8Gc6XSwQy',8),('randomEmployeeUsername7','$2y$10$51noLUVn0s6RkL7XlVxs3eGLyIbmS9RWJIG.adDq5rlperI2U0jdG',9),('randomEmployeeUsername8','$2y$10$B6a2A6w9EQEeU9QBgcFEfuvUH.vPALmsN0m8bKTu/Wje7GAcw7B3O',10),('randomEmployeeUsername9','$2y$10$OCaneaxB19CgnXvaPjbj7ep5oBImadVh0KUHuhUrzutZBnQV1of2C',11);
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
INSERT INTO `MemberUsers` VALUES ('randMem0','$2y$10$7TP/j2cKYXYcX89q6mvOjueDEbjKYutEOS0fo8Z/4x3BpUeohRW.K',1),('randMem1','$2y$10$nr7QilrlXrnUBalZAlsds.MRFFQ4ZZISRmZJ5c4jl.E9E1wM24VuG',2),('randMem10','$2y$10$TkFbBhWxAGMZxXS5cAqi8uqqn1n22NwInqHRfi//wbBgFe3ij1PZW',11),('randMem11','$2y$10$lo0zneZe5busLf1WiYKFU.SYpuX02cuaJsqfC.O0W4/XIR7ik/Nxu',12),('randMem12','$2y$10$wxwhpHMSHM7rnPSd3MFbYuG6Btfhl/og1IoTzsEv3ogFB1GuiV5w2',13),('randMem13','$2y$10$ovDsOlGAEqfrGyUdpUnCAOwVHgJn.DUczmVcF0loS/xnTAoamCy2a',14),('randMem14','$2y$10$Zs.9fgtVVLL0rtMpQ3dPUOKEXM7GFpNUI50pWigxS.PVKrd5AbD1u',15),('randMem15','$2y$10$MNfqDzt9MCqYYcLqufDOHu7eWTnDbo0Nw7JTfd6DD/bg2DbUcM1Ta',16),('randMem16','$2y$10$yT08jzPnH1uGaJ100M1obuRatKrQihfAYYo4mTDxYjg3UDg1ecHEG',17),('randMem17','$2y$10$wsc3b53/ppEWBVjtM.CvieT8ERzlUgW45t8VFEzXwotQyTZO51bS6',18),('randMem18','$2y$10$PTg4bV2Lad/FHacEz/Xdx.va7UJjQ4f55A1ZIC90UibY2buedZSxG',19),('randMem19','$2y$10$OjKQJGQfGvN78zMvmHIytOJC.Nw54ywVUBTQWvQiBRTzpAPT1arwy',20),('randMem2','$2y$10$irbUVdGwFleXwP6VI6WWzeCjzBEBpat/Hc7WKhU/ZN.UcwKlULtfm',3),('randMem3','$2y$10$rBhOTAl5RMkJ8Fb70yqZOeUvHri1T8R3sC1qhI8TJYSDOMCKOcJOe',4),('randMem4','$2y$10$4hwspOeuovGn51gKCBrlGen1DlnNh0sw8uh72NF6..Fw81VSiRRAi',5),('randMem5','$2y$10$QrVo23ZxoZ43pV.Ec9xdP.GXBix.CbUHXfhoWY7/hbsCOViV31YPq',6),('randMem6','$2y$10$ah1gR/OEwUcwpFe0Jc8sQeXPntPR5nOFRzeYOo3q7AR06kGpkJqx2',7),('randMem7','$2y$10$zZoeOyREXqD4TZiKk9Ota..1hFJ8q8zEw.EyFMLkuISYrbL/chtKC',8),('randMem8','$2y$10$D0vG8rIIsPjQzJBoHxb5a.hcu9q/J0AFGNULx9f9U15L2q8x6H3d2',9),('randMem9','$2y$10$Atpv2FDEvpnawUdRzFrwXu65eFUKwv8QedCgpGAr/N/KY6qBm6Hei',10);
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
INSERT INTO `Members` VALUES (1,'Robert','Cunningham','1986-07-07','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(2,'Susan','Bates','1968-12-08','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(3,'Susan','Smith','1989-10-16','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(4,'Ben','Smith','1965-08-14','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(5,'Robert','Bates','1963-04-08','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(6,'Jukka','Doe','1980-09-08','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(7,'Jukka','James','1997-04-10','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(8,'Jill','James','1961-12-15','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(9,'Jane','Doe','1995-01-13','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(10,'Tom','James','1964-03-06','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(11,'Abby','Poole','1970-12-02','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(12,'Jill','Black','1972-07-02','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(13,'Jukka','Black','1978-05-19','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(14,'Robert','Black','1966-02-03','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(15,'Robert','Smith','1964-09-04','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(16,'Tom','Bates','1976-08-13','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(17,'Ben','Keeton','1983-10-18','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(18,'Abby','Poole','1971-11-16','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(19,'Tom','Green','1975-02-04','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(20,'Jill','Bates','1996-06-03','m','memberemail@example.com','1234 Some Other St','713 123 4578');
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

-- Dump completed on 2017-04-09 17:27:50
