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
  CONSTRAINT `Employee_ibfk_1` FOREIGN KEY (`supID`) REFERENCES `Employee` (`employeeID`) ON DELETE SET NULL,
  CONSTRAINT `Employee_ibfk_2` FOREIGN KEY (`departmentID`) REFERENCES `Department` (`departmentID`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Employee`
--

LOCK TABLES `Employee` WRITE;
/*!40000 ALTER TABLE `Employee` DISABLE KEYS */;
INSERT INTO `Employee` VALUES (1,'q','w','123456789','2010-10-21','superUser',NULL,'m','r@example.com','1234 Some St',NULL,NULL),(2,'Lucy','Black','000000000','1964-03-04','cook','fullTime','f','emailuser0@example.com','1234 Some St',NULL,NULL),(3,'Ben','Keeton','100000000','1960-11-08','cook','fullTime','f','emailuser1@example.com','1234 Some St',NULL,NULL),(4,'John','James','200000000','1973-09-10','cook','fullTime','m','emailuser2@example.com','1234 Some St',NULL,NULL),(5,'Abby','Smith','300000000','1966-02-10','cook','fullTime','m','emailuser3@example.com','1234 Some St',NULL,NULL),(6,'Jane','James','400000000','1969-01-15','cook','fullTime','m','emailuser4@example.com','1234 Some St',NULL,NULL),(7,'Tom','Keeton','500000000','1993-02-16','cook','fullTime','f','emailuser5@example.com','1234 Some St',NULL,NULL),(8,'Jukka','Green','600000000','1977-04-11','cook','fullTime','m','emailuser6@example.com','1234 Some St',NULL,NULL),(9,'Robert','Cunningham','700000000','1974-04-15','cook','fullTime','m','emailuser7@example.com','1234 Some St',NULL,NULL),(10,'Lucy','James','800000000','1985-01-01','cook','fullTime','f','emailuser8@example.com','1234 Some St',NULL,NULL),(11,'Sally','Cunningham','900000000','1971-08-15','cook','fullTime','f','emailuser9@example.com','1234 Some St',NULL,NULL),(13,'Tom','Smith','110000000','1989-10-04','cook','fullTime','m','emailuser11@example.com','1234 Some St',NULL,NULL),(14,'Sally','Smith','120000000','1974-12-16','cook','fullTime','m','emailuser12@example.com','1234 Some St',NULL,NULL),(15,'Susan','Cunningham','130000000','1972-01-02','cook','fullTime','f','emailuser13@example.com','1234 Some St',NULL,NULL),(16,'Robert','Cunningham','140000000','1969-10-04','cook','fullTime','f','emailuser14@example.com','1234 Some St',NULL,NULL),(17,'Susan','Black','150000000','1963-08-01','cook','fullTime','f','emailuser15@example.com','1234 Some St',NULL,NULL),(18,'Lucy','Bates','160000000','1996-09-18','cook','fullTime','f','emailuser16@example.com','1234 Some St',NULL,NULL),(19,'Sally','Green','170000000','1962-04-14','cook','fullTime','m','emailuser17@example.com','1234 Some St',NULL,NULL),(20,'Jill','Keeton','180000000','1973-08-06','cook','fullTime','m','emailuser18@example.com','1234 Some St',NULL,NULL),(21,'Robert','Bates','190000000','1995-06-01','cook','fullTime','m','emailuser19@example.com','1234 Some St',NULL,NULL);
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
INSERT INTO `EmployeeUsers` VALUES ('e','$2y$10$IGbG0ISsa1w3nS1E8QU9geC2EqbpU7KwBDlTsPTng9guW2DBfcnJ.',1),('randomEmployeeUsername0','$2y$10$apaWZoyZ/P41ChzlhsnJ5uLpygXlfMVcR07nAY3lyAxhKpYYCOaXG',2),('randomEmployeeUsername1','$2y$10$/77BiB726ZDJ0bjb6gyKhuPkSk8NcQ7EbVrdmp6.mIrgjVOEpC8Oy',3),('randomEmployeeUsername11','$2y$10$4XbmfKf21mAtg9kBX8QYSemOJ7hgQ7Y0gcHvTVjxHJubexpKHqfuq',13),('randomEmployeeUsername12','$2y$10$ZhtUid/ukERAtYVpbcFihOL3QxsiLoEwmQ3qWFSfYcTsSwPRT1Iu6',14),('randomEmployeeUsername13','$2y$10$8xPsmCwzCNrdgaQ4oBuKQ.1k8vm2bNC/2sbl5lZSYhAVcWmrR7vc.',15),('randomEmployeeUsername14','$2y$10$v5bcKCOynpbT3cTfi.XwoOvU3ZrfWagbwE5qSxuot7aB4M3.V9cvq',16),('randomEmployeeUsername15','$2y$10$PZVQZG2h8JXxay3EBTKrYeApMacexrgeu4mPx4/HO3aGt7DN0ZJpS',17),('randomEmployeeUsername16','$2y$10$CFHn/JjwIHnFk3C.X7VAZuL6kznlgkxR1lQOEVxAITJY/SOQH0lCq',18),('randomEmployeeUsername17','$2y$10$HeF4VBEa3x19Jd2LPXjJw.SNdc5/OJV5PVDzGQuwrxKxP.O2CSije',19),('randomEmployeeUsername18','$2y$10$V6hmdSm7eVLztBGhJItoF.WdKeFV1lSY2jrgB2sfoOSZ8M0g8/Kgi',20),('randomEmployeeUsername19','$2y$10$RFMgoUNUAShdn5rw6e5PL.v4ybdSQOfwW7pilMphq2Q1SI6QtTs8u',21),('randomEmployeeUsername2','$2y$10$jA6m.Iu2Uwh/aHfaWSkrBOfAWv2mxibzoUQeSK48/N9hml3yiX9vW',4),('randomEmployeeUsername3','$2y$10$94lZPos4ZJdWZeQeWuNi3.TPDivyqXE7eFwZQ1E9Ais1xvQih4Jri',5),('randomEmployeeUsername4','$2y$10$5ZSSkj/QM3vvyW7m.4VizO6RXxKWd4UiymD3lTXxlUhXtpDr1CtLm',6),('randomEmployeeUsername5','$2y$10$llgNftjoPoPPxE9ozky8XOmDJzqljLk9uzbH2DznLHoJVZqg1TpX.',7),('randomEmployeeUsername6','$2y$10$nV2u3E3ORa2bqwEhgYtExOmyaKtQvpQ6uB7GqyY6BwOHaTclYMUXu',8),('randomEmployeeUsername7','$2y$10$oAwKhiPct0SvdjA7bRUI9ec3uNlVfh79miFpB355dsNJUcPpcBo8u',9),('randomEmployeeUsername8','$2y$10$RjrSn4RPT/xKLfrbBUi.7OI5SL5iq9IkfuZjAhSY7rydYr9HObuWC',10),('randomEmployeeUsername9','$2y$10$Po34wvAM/.Ft9liRz0yL/uh.73x3NehJ/Rn.i7IMC12Y43Hbzwqie',11);
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
INSERT INTO `MemberUsers` VALUES ('randMem0','$2y$10$FK7crmVmPB7cFOu04s4mY.tkPeDxrDkHu8hJgZL5sQE5VJw7HK4dm',1),('randMem1','$2y$10$i6xI3ccZGNd2hiLLOtdbO.RWiiFhvMf6pcrv5.ZKqReHFs/ZFgbmm',2),('randMem10','$2y$10$2FmSpAttWl0QzLOrmIxzB.bdiYZSXG3kYT8pJovzb5zNKOoW6HLGK',11),('randMem11','$2y$10$1w88ooEArmJriIArsJb7pu3sG9n6jOiRqnUm4bZn/fSta2OkpUduq',12),('randMem12','$2y$10$MYPELp7cyrMXKpImirjaXOHizOFDTW19ppSFgOgEAFGult0610BXq',13),('randMem13','$2y$10$gPrKiOYZ7UpjP2GVsOMbkebpPRl/T.PRNqtfUXlMzQgw6UDTqbyV6',14),('randMem14','$2y$10$MnDxwuZprVN/YSCm0tLHEuQqIHxbJ89NAgq1A8mcycwG84FBnsUmK',15),('randMem15','$2y$10$Og2FyfAeLzlFwRU8ZGgBY.cbqbOoRSohKJyL6ACTbj34IpU.8oWkO',16),('randMem16','$2y$10$OqSs/LPWvgfEkM6cOtzS1ek3kDTWsZBwsfViAhzqDGjVX.O3uK.JO',17),('randMem17','$2y$10$ecDG2nmlSeyNgC//FkZS/eUcAdBAfFDBbFm/.Ux6q/O11hsGYsWl6',18),('randMem18','$2y$10$11sK5jI8ykpMiMZmazT0VexA6uaWuG5QQgVHvsnKN1NMovzFf71ku',19),('randMem19','$2y$10$Tm1fthi8Y4j8WxwXuSTvb.HOSqWLsnhGCVzN.JDeIk0IxVYX3UQSa',20),('randMem2','$2y$10$q0FeaeJAnSDD5aINy9OVZe/5CD7o169HrP6LvJuzGz.dwLSQFcBNu',3),('randMem3','$2y$10$FU.xp4T4.cKJeVWROBOrju.02pnBRFByAeRSFtE0dQReWcM/DUs/u',4),('randMem4','$2y$10$HVLwsLF8a53XqOtHfUa33uZubbs7uUQHVb448weVeiMVIotmWSGIa',5),('randMem5','$2y$10$xvDzp8uymZYHLKW5aQ18..cZJNq9K3m4Vn3Un8jz2RKHwPJHEXKfe',6),('randMem6','$2y$10$W/Tx8WSKZpxwoP4A2QDeCu8KkGIYuECMDVN0eOmUmoHVnkyGLpzxW',7),('randMem7','$2y$10$zR5SRe64Ru/DT5Ln29UUiOPz8zlywDvTbg84Cfsr/3nIYju2sfAMW',8),('randMem8','$2y$10$R0dWGjC2kOo9.xYhQ.PQ4eUYCAK.Ikw.ju5C.0gJVyuQyGTHzwP2q',9),('randMem9','$2y$10$fANt9KxePTj5YXaFnecd9Oyo/dxEcTdNgGuYUG.9hXvtR7oOg3X3y',10);
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
INSERT INTO `Members` VALUES (1,'Jill','Doe','1960-05-05','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(2,'Susan','Cunningham','1982-03-03','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(3,'William','Black','1972-05-03','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(4,'Susan','Green','1963-12-02','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(5,'Jane','Cunningham','1968-07-01','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(6,'Abby','Keeton','1970-07-17','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(7,'Susan','Black','1969-07-14','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(8,'Tom','Keeton','1979-05-06','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(9,'Sally','Keeton','1961-12-03','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(10,'William','James','1991-09-07','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(11,'Ben','Bates','1996-11-01','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(12,'Ben','Keeton','1970-03-20','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(13,'Ben','Poole','1977-11-07','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(14,'Sally','Doe','1971-02-10','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(15,'Tom','Sarasti','1993-07-14','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(16,'Ben','James','1973-03-14','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(17,'Jill','Sarasti','1961-05-04','f','memberemail@example.com','1234 Some Other St','713 123 4578'),(18,'Lucy','Black','1974-04-14','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(19,'Helen','Black','1987-02-04','m','memberemail@example.com','1234 Some Other St','713 123 4578'),(20,'Jane','Black','1991-01-20','m','memberemail@example.com','1234 Some Other St','713 123 4578');
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
  CONSTRAINT `Vendor_ibfk_1` FOREIGN KEY (`department`) REFERENCES `Department` (`departmentID`) ON DELETE SET NULL
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

-- Dump completed on 2017-04-11 21:49:29
