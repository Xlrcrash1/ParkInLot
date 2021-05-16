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
-- Temporary table structure for view `RequesterDetails`
--

DROP TABLE IF EXISTS `RequesterDetails`;
/*!50001 DROP VIEW IF EXISTS `RequesterDetails`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `RequesterDetails` (
  `pUserID` tinyint NOT NULL,
  `rUserID` tinyint NOT NULL,
  `rUserName` tinyint NOT NULL,
  `rMake` tinyint NOT NULL,
  `rModel` tinyint NOT NULL,
  `rYear` tinyint NOT NULL,
  `rColor` tinyint NOT NULL,
  `rLicensePlate` tinyint NOT NULL,
  `rCarPhoto` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

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
  `postStat` int(10) unsigned DEFAULT 1,
  PRIMARY KEY (`pUserID`),
  CONSTRAINT `Spots_ibfk_1` FOREIGN KEY (`pUserID`) REFERENCES `Users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
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
/*!50003 CREATE*/ /*!50017 DEFINER=`spstudios`@`localhost`*/ /*!50003 Trigger add_history After Delete on Spots for each row insert into SpotsHistory (pUserID, rUserID, reqStat, postStat) values(old.pUserID, old.rUserID, old.reqStat, old.postStat) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Temporary table structure for view `SpotsDetails`
--

DROP TABLE IF EXISTS `SpotsDetails`;
/*!50001 DROP VIEW IF EXISTS `SpotsDetails`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `SpotsDetails` (
  `pUserID` tinyint NOT NULL,
  `userName` tinyint NOT NULL,
  `rUserID` tinyint NOT NULL,
  `make` tinyint NOT NULL,
  `model` tinyint NOT NULL,
  `year` tinyint NOT NULL,
  `color` tinyint NOT NULL,
  `licensePlate` tinyint NOT NULL,
  `carPhoto` tinyint NOT NULL,
  `time` tinyint NOT NULL,
  `longitude` tinyint NOT NULL,
  `latitude` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `SpotsHistory`
--

DROP TABLE IF EXISTS `SpotsHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SpotsHistory` (
  `pUserID` int(6) unsigned NOT NULL,
  `rUserID` int(6) unsigned DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `reqStat` int(10) unsigned DEFAULT NULL,
  `postStat` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`pUserID`,`date`),
  KEY `rUserID` (`rUserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`spstudios`@`localhost`*/ /*!50003 trigger completeSpots After Insert on SpotsHistory for each row update Users set compSpots = compSpots + 1 where (Users.userID = new.pUserID or Users.userID = new.rUserID) and new.reqStat = 3 */;;
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
/*!50003 CREATE*/ /*!50017 DEFINER=`spstudios`@`localhost`*/ /*!50003 trigger updatePostCancel After Insert on SpotsHistory for each row update Users set cancSpots = cancSpots + 1 where Users.userID = new.pUserID and new.postStat = 2 */;;
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
/*!50003 CREATE*/ /*!50017 DEFINER=`spstudios`@`localhost`*/ /*!50003 trigger updateReqCancel After Insert on SpotsHistory for each row update Users set cancSpots = cancSpots + 1 where Users.userID = new.rUserID and new.reqStat = 2 */;;
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
/*!50003 CREATE*/ /*!50017 DEFINER=`spstudios`@`localhost`*/ /*!50003 trigger updateRatings After Insert on SpotsHistory for each row update Users set rating = (compSpots/(cancSpots + compSpots)) * 100 where Users.userID = new.rUserID or Users.userID = new.pUserID */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

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
  `compSpots` int(10) unsigned DEFAULT 1,
  `cancSpots` int(10) unsigned DEFAULT 0,
  `rating` float DEFAULT 100,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lotLocation`
--

DROP TABLE IF EXISTS `lotLocation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lotLocation` (
  `lotID` int(11) NOT NULL AUTO_INCREMENT,
  `lotName` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lotID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `passwordReset`
--

DROP TABLE IF EXISTS `passwordReset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `passwordReset` (
  `requestID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `timeRequested` timestamp NOT NULL DEFAULT current_timestamp(),
  `timeExpires` timestamp NOT NULL DEFAULT (current_timestamp() + interval 5 minute),
  `resetAttempts` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`requestID`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `userLocation`
--

DROP TABLE IF EXISTS `userLocation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userLocation` (
  `userID` int(6) unsigned NOT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`userID`),
  CONSTRAINT `userLocation_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Final view structure for view `RequesterDetails`
--

/*!50001 DROP TABLE IF EXISTS `RequesterDetails`*/;
/*!50001 DROP VIEW IF EXISTS `RequesterDetails`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`spstudios`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `RequesterDetails` AS select `SpotsDetails`.`pUserID` AS `pUserID`,`SpotsDetails`.`rUserID` AS `rUserID`,`Users`.`userName` AS `rUserName`,`Users`.`make` AS `rMake`,`Users`.`model` AS `rModel`,`Users`.`year` AS `rYear`,`Users`.`color` AS `rColor`,`Users`.`licensePlate` AS `rLicensePlate`,`Users`.`carPhoto` AS `rCarPhoto` from (`SpotsDetails` join `Users` on(`SpotsDetails`.`rUserID` = `Users`.`userID`)) where `SpotsDetails`.`rUserID` is not null */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `SpotsDetails`
--

/*!50001 DROP TABLE IF EXISTS `SpotsDetails`*/;
/*!50001 DROP VIEW IF EXISTS `SpotsDetails`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`spstudios`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `SpotsDetails` AS select `Users`.`userID` AS `pUserID`,`Users`.`userName` AS `userName`,`Spots`.`rUserID` AS `rUserID`,`Users`.`make` AS `make`,`Users`.`model` AS `model`,`Users`.`year` AS `year`,`Users`.`color` AS `color`,`Users`.`licensePlate` AS `licensePlate`,`Users`.`carPhoto` AS `carPhoto`,`Spots`.`time` AS `time`,`userLocation`.`longitude` AS `longitude`,`userLocation`.`latitude` AS `latitude` from ((`Users` join `userLocation` on(`Users`.`userID` = `userLocation`.`userID`)) join `Spots` on(`Users`.`userID` = `Spots`.`pUserID`)) order by `Spots`.`time` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-16 13:44:16
