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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Animals`
--

LOCK TABLES `Animals` WRITE;
/*!40000 ALTER TABLE `Animals` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Department`
--

LOCK TABLES `Department` WRITE;
/*!40000 ALTER TABLE `Department` DISABLE KEYS */;
INSERT INTO `Department` VALUES (1,'Insect Department'),(2,'Reptile Department');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Employee`
--

LOCK TABLES `Employee` WRITE;
/*!40000 ALTER TABLE `Employee` DISABLE KEYS */;
INSERT INTO `Employee` VALUES (1,'Test','Lastname','123456789','2010-10-21','superUser','fullTime','m','r@example.com','1234 Some St',1,NULL),(2,'John','Smith','234785567','2010-10-21','zooKeeper','fullTime','m','jsmith@example.com','12345 Some street',2,NULL);
/*!40000 ALTER TABLE `Employee` ENABLE KEYS */;
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
  `status` enum('occupied','empty','undergoing-maintenance') DEFAULT NULL,
  PRIMARY KEY (`HabitatID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Habitats`
--

LOCK TABLES `Habitats` WRITE;
/*!40000 ALTER TABLE `Habitats` DISABLE KEYS */;
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
  `firstname` varchar(99) DEFAULT NULL,
  `lastname` varchar(99) DEFAULT NULL,
  `memberdob` date DEFAULT NULL,
  `memberAddress` text,
  `memberPhone` varchar(20) DEFAULT NULL,
  `memberEmail` varchar(99) DEFAULT NULL,
  `memberSex` enum('m','f') DEFAULT NULL,
  PRIMARY KEY (`memberID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Members`
--

LOCK TABLES `Members` WRITE;
/*!40000 ALTER TABLE `Members` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MembershipSales`
--

LOCK TABLES `MembershipSales` WRITE;
/*!40000 ALTER TABLE `MembershipSales` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tickets`
--

LOCK TABLES `Tickets` WRITE;
/*!40000 ALTER TABLE `Tickets` DISABLE KEYS */;
/*!40000 ALTER TABLE `Tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `username` varchar(60) NOT NULL,
  `password` varchar(500) DEFAULT NULL,
  `employeeID` int(11) DEFAULT NULL,
  `memberID` int(11) DEFAULT NULL,
  PRIMARY KEY (`username`),
  KEY `employeeID` (`employeeID`),
  KEY `memberID` (`memberID`),
  CONSTRAINT `Users_ibfk_1` FOREIGN KEY (`employeeID`) REFERENCES `Employee` (`employeeID`),
  CONSTRAINT `Users_ibfk_2` FOREIGN KEY (`memberID`) REFERENCES `Members` (`memberID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES ('e','$2y$10$olMoy9TwvJsqVihZ3omvHeKiS/iiwlpupee67Lew5rcedY70Z4t4C',1,NULL),('jsmith','$2y$10$abA8LaQWI4VWcv5u44dDYuNnRStwiv8WQx3aM5ufsExKm9BVSqWti',2,NULL);
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Vendor`
--

LOCK TABLES `Vendor` WRITE;
/*!40000 ALTER TABLE `Vendor` DISABLE KEYS */;
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

-- Dump completed on 2017-04-01 18:36:01
