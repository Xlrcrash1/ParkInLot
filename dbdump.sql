-- MySQL dump 10.18  Distrib 10.3.27-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: spstudios
-- ------------------------------------------------------
-- Server version	10.3.27-MariaDB-0+deb10u1

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
-- Table structure for table `Location`
--

DROP TABLE IF EXISTS `Location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Location` (
  `userID` int(6) unsigned NOT NULL,
  `xCoordinate` text DEFAULT NULL,
  `yCoordinate` text DEFAULT NULL,
  PRIMARY KEY (`userID`),
  CONSTRAINT `Location_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Location`
--

LOCK TABLES `Location` WRITE;
/*!40000 ALTER TABLE `Location` DISABLE KEYS */;
/*!40000 ALTER TABLE `Location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Spots`
--

DROP TABLE IF EXISTS `Spots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Spots` (
  `pUserID` int(6) unsigned NOT NULL,
  `rUserID` int(6) unsigned DEFAULT NULL,
  `lPlate` text NOT NULL,
  `parkingLot` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `reqStat` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`pUserID`),
  CONSTRAINT `Spots_ibfk_1` FOREIGN KEY (`pUserID`) REFERENCES `Users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Spots`
--

LOCK TABLES `Spots` WRITE;
/*!40000 ALTER TABLE `Spots` DISABLE KEYS */;
/*!40000 ALTER TABLE `Spots` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`spstudios`@`localhost`*/ /*!50003 Trigger update_tokens_requester After update on Spots For Each Row Update Users SET tokens = tokens - 1 where Users.userID = new.rUserID and new.reqStat = 3 and new.reqStat>old.reqStat */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`spstudios`@`localhost`*/ /*!50003 Trigger update_tokens_poster After update on Spots For Each Row Update Users SET tokens = tokens + 1 where Users.userID = new.pUserID and new.reqStat = 3 and new.reqStat>old.reqStat */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`spstudios`@`localhost`*/ /*!50003 Trigger add_history After Delete on Spots FOR EACH ROW INSERT INTO SpotsHistory (pUserID, rUserID) VALUES(old.pUserID, old.rUserID) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `SpotsHistory`
--

DROP TABLE IF EXISTS `SpotsHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SpotsHistory` (
  `pUserID` int(6) unsigned NOT NULL,
  `rUserID` int(6) unsigned NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`pUserID`,`rUserID`,`date`),
  KEY `rUserID` (`rUserID`),
  CONSTRAINT `SpotsHistory_ibfk_1` FOREIGN KEY (`pUserID`) REFERENCES `Users` (`userID`),
  CONSTRAINT `SpotsHistory_ibfk_2` FOREIGN KEY (`rUserID`) REFERENCES `Users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SpotsHistory`
--

LOCK TABLES `SpotsHistory` WRITE;
/*!40000 ALTER TABLE `SpotsHistory` DISABLE KEYS */;
INSERT INTO `SpotsHistory` VALUES (1,3,'2021-02-27 23:04:39');
/*!40000 ALTER TABLE `SpotsHistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `userID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `make` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `year` int(6) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `licensePlate` varchar(255) DEFAULT NULL,
  `carPhoto` varchar(255) DEFAULT NULL,
  `carNum` int(6) DEFAULT 1,
  `access` int(6) DEFAULT 1,
  `tokens` int(10) unsigned DEFAULT 1,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (1,'Tony','Cervantes','Xlrcrash1','Password','jcervantes23@csub.edu','Toyota','GT86',2017,'Metallic','C777','Raven.jpg',1,10,1),(3,'Terry','Watson','theory','password','twatson6@csub.edu',NULL,NULL,NULL,NULL,NULL,NULL,1,10,1),(4,'Abraham','Aldana','aaldana2','password','aaldana2@csub.edu',NULL,NULL,NULL,NULL,NULL,NULL,1,10,1),(7,'test','test','','test','test@email.com','test','test',2017,'Test','1777',NULL,1,1,1),(24,'my','test','testing','$2y$10$Aulwdxlw6nl1cmC6u2h7AONs7Wx4oiY5XBKK6jMG3MPt0Ei6Uw/mS','testing@gmail.com','Honda','Accord',2019,'Black','JOBS','pic',1,1,1),(25,'Tom','Dom','TestTom','pass','tom@email.com','Toy','123',2018,'Black','4513',NULL,1,1,1),(26,'Test','Test','test1','pass','test1@email.com','Toyota','Camri',2002,'White','1325',NULL,1,1,1),(28,'Terry','Watson','talass','password','talass2@live.com','Pontiac','Firebird',1998,'White','7JIS',NULL,1,1,1),(29,'Lucifer','none','Luci','password','angel@heaven.exists','wings','2nd gen',2020,'White','HVNN',NULL,1,1,1),(30,'Test','test','test','password','test@test.com','test','test',2020,'test','test',NULL,1,1,1),(31,'David','Montes De Oca','davidmontes','password','dmontes-de-oca@csub.edu','Honda','Accord',2012,'Black','TSLA','https://i.imgur.com/RmuwY3r.jpg',1,1,1),(34,'John','Doe','jdoe','$2y$10$TNabc90Z0T4/zy4a/W7NMO0W18vYPT4DaOXDJ2uy4Tw8QBsp.Sbla','jdoe@csub.edu','Tesla','X',2020,'White','TSLA',NULL,1,1,1),(36,'jack','sparrow','jsparrow','$2y$10$oS2MBHi1iLJf8pxzBioG.OPdF4mErvRtuUx6iybuBhIcRTCZxwGBS','jsparrow@csub.edu','BMW','i8',2020,'White','BMR1','https://i.imgur.com/dCVZ53e.png',1,1,1),(37,'Admin','Admin','Admin','$2y$10$fwhuqA6bT8LwsX6JA91UreyuV01dYPv5vvddBiq6y2Sf15g7LHJ.6','admin@admin.com','Admin','Admin',2020,'Admin','Admin',NULL,1,10,1),(39,'admin','admin','admin','$2y$10$pQlO2qEv6Q6V3JlWx.BaluP.kyVF8rl3h5lz8CUuc/rdyug4JPJUO','admin@test.com','admin','admin',2020,'admin','admin',NULL,1,10,1),(40,'tester','tester','tester','$2y$10$TjCSpGcCm4wGFVCxPlzP/OrwFzX.rGXQt7f7l8UUwwTPTcrngSe9O','tester@csub.edu','tester','tester',2020,'tester','tester',NULL,1,1,1),(41,'Albert','Name','1234','$2y$10$7aNvj21QP/ysE68Xqh77mOXcglDpyh77hERR8TqFmncKAVjbeNI66','email@empty.com','Toyota','Gt86',2011,'White','1234',NULL,1,1,1);
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-05 15:34:47
