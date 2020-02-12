-- MySQL dump 10.17  Distrib 10.3.17-MariaDB, for debian-linux-gnueabihf (armv7l)
--
-- Host: localhost    Database: db_rfidsys
-- ------------------------------------------------------
-- Server version	10.3.17-MariaDB-0+deb10u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_admin` (
  `u_id` int(15) NOT NULL AUTO_INCREMENT,
  `u_name` varchar(20) DEFAULT NULL,
  `u_password` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_admin`
--

LOCK TABLES `tbl_admin` WRITE;
/*!40000 ALTER TABLE `tbl_admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_useraccounts`
--

DROP TABLE IF EXISTS `tbl_useraccounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_useraccounts` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `rfid_no` varchar(20) DEFAULT NULL,
  `fname` varchar(25) DEFAULT NULL,
  `lname` varchar(25) DEFAULT NULL,
  `img` text DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `address` varchar(30) DEFAULT NULL,
  `mname` varchar(20) DEFAULT NULL,
  `gradelevel` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_useraccounts`
--

LOCK TABLES `tbl_useraccounts` WRITE;
/*!40000 ALTER TABLE `tbl_useraccounts` DISABLE KEYS */;
INSERT INTO `tbl_useraccounts` VALUES (36,'391267624249','christine marie','Acera','/static/assets/img/IMG_8665.JPG','2020-02-08 07:48:38','BRGY ANAKAN GINGOOG CITY','v','G-12 CEPHEUS'),(37,'250207017442','Lyjieme','Barro','./static/assets/img/WIN_20191002_14_06_13_Pro.jpg','2020-02-08 09:30:35','Gingoog City Colleges','Tomaquin','12'),(38,'529997833581','Karen','Zulita','./static/assets/img/81228292_525550531380424_4380281680259186688_o.jpg','2020-02-08 09:32:43','Gingoog City','P','12');
/*!40000 ALTER TABLE `tbl_useraccounts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-08 17:38:33
