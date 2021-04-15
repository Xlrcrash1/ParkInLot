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
  `postStat` int(10) unsigned DEFAULT 1,
  PRIMARY KEY (`pUserID`),
  CONSTRAINT `Spots_ibfk_1` FOREIGN KEY (`pUserID`) REFERENCES `Users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Spots`
--

LOCK TABLES `Spots` WRITE;
/*!40000 ALTER TABLE `Spots` DISABLE KEYS */;
INSERT INTO `Spots` VALUES (26,30,'1325','F','2021-04-09 19:33:47',1,1),(36,89,'ACCO','F','2021-03-13 23:58:55',0,1),(63,97,'G251','A','2021-04-09 19:07:48',1,1);
/*!40000 ALTER TABLE `Spots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `SpotsDetails`
--

DROP TABLE IF EXISTS `SpotsDetails`;
/*!50001 DROP VIEW IF EXISTS `SpotsDetails`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `SpotsDetails` (
  `userID` tinyint NOT NULL,
  `userName` tinyint NOT NULL,
  `make` tinyint NOT NULL,
  `model` tinyint NOT NULL,
  `year` tinyint NOT NULL,
  `color` tinyint NOT NULL,
  `licensePlate` tinyint NOT NULL,
  `carPhoto` tinyint NOT NULL,
  `time` tinyint NOT NULL
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
  `rUserID` int(6) unsigned NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `reqStat` int(10) unsigned DEFAULT NULL,
  `postStat` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`pUserID`,`rUserID`,`date`),
  KEY `rUserID` (`rUserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SpotsHistory`
--

LOCK TABLES `SpotsHistory` WRITE;
/*!40000 ALTER TABLE `SpotsHistory` DISABLE KEYS */;
INSERT INTO `SpotsHistory` VALUES (1,3,'2021-02-27 23:04:39',NULL,NULL),(1,30,'2021-03-26 19:59:17',0,1),(1,95,'2021-04-07 06:20:02',2,1),(1,95,'2021-04-07 06:22:26',2,1),(29,29,'2021-04-13 07:37:54',2,1),(30,30,'2021-04-05 03:11:20',0,1),(34,93,'2021-04-07 05:56:08',3,1),(63,63,'2021-03-14 09:23:01',NULL,NULL),(63,93,'2021-03-18 05:08:31',NULL,NULL),(63,93,'2021-03-27 22:29:49',2,1),(63,95,'2021-04-07 05:58:09',3,1),(93,36,'2021-03-16 07:08:36',NULL,NULL),(93,63,'2021-03-16 06:50:34',NULL,NULL),(93,93,'2021-03-14 09:36:51',NULL,NULL),(93,93,'2021-03-16 06:59:16',NULL,NULL),(93,93,'2021-03-16 07:06:04',NULL,NULL),(93,93,'2021-03-16 07:07:40',NULL,NULL),(93,93,'2021-03-16 22:47:22',NULL,NULL),(93,93,'2021-03-18 04:29:52',NULL,NULL),(93,93,'2021-03-19 03:28:30',NULL,NULL),(95,63,'2021-04-07 05:13:49',1,2),(95,63,'2021-04-07 05:17:49',1,2),(95,95,'2021-03-28 01:38:37',2,1),(95,95,'2021-04-07 05:12:43',0,2),(95,95,'2021-04-09 19:18:48',2,1);
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
  `compSpots` int(10) unsigned DEFAULT 1,
  `cancSpots` int(10) unsigned DEFAULT 0,
  `rating` float DEFAULT 100,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (1,'Tony','Cervantes','Xlrcrash1','Password','jcervantes23@csub.edu','Toyota','GT86',2017,'Metallic','C777','https://i.imgur.com/1wGKIKS.jpg',1,10,1,1,0,100),(3,'Terry','Watson','theory','password','twatson6@csub.edu',NULL,NULL,NULL,NULL,NULL,NULL,1,10,1,1,0,100),(4,'Abraham','Aldana','aaldana2','$2y$10$h5TgGRRRygYBgYBjo38f5uKl.lWIeAdWRvYnXRbEIRFVQ52vlOzka','aaldana2@csub.edu','Honda','Civic',2014,'Red','1234',NULL,1,10,1,1,0,100),(24,'my','test','testing','$2y$10$Aulwdxlw6nl1cmC6u2h7AONs7Wx4oiY5XBKK6jMG3MPt0Ei6Uw/mS','testing@gmail.com','Honda','Accord',2019,'Black','JOBS','pic',1,1,1,1,0,100),(25,'Tom','Dom','TestTom','pass','tom@email.com','Toy','123',2018,'Black','4513',NULL,1,1,1,1,0,100),(26,'Test','Test','test1','pass','test1@email.com','Toyota','Camri',2002,'White','1325',NULL,1,1,1,1,0,100),(28,'Terry','Watson','talass','password','talass2@live.com','Pontiac','Firebird',1998,'White','7JIS',NULL,1,1,1,1,0,100),(29,'Lucifer','none','Luci','password','angel@heaven.exists','wings','2nd gen',2020,'White','HVNN',NULL,1,1,1,1,1,50),(30,'Test','test','test','password','test@test.com','test','test',2020,'test','test',NULL,1,1,1,1,0,100),(31,'david','montes','davidmontes','$2y$10$vl6UGRRfqiNxQHdzl9hr2OgU/O64HgLnRuUDDWNPIhRnBW.tQAQhW','dmontes-de-oca@csub.edu','Honda','Accord',2012,'RED','TSLA','https://i.imgur.com/3ZIHPaY.png',1,10,1,1,0,100),(34,'John','Doe','jdoe','$2y$10$TNabc90Z0T4/zy4a/W7NMO0W18vYPT4DaOXDJ2uy4Tw8QBsp.Sbla','jdoe@csub.edu','Tesla','X',2020,'White','TSLA','https://i.imgur.com/C5EcVfj.jpg',1,1,2,2,0,100),(36,'Jack','Sparrow','jsparrow','$2y$10$oS2MBHi1iLJf8pxzBioG.OPdF4mErvRtuUx6iybuBhIcRTCZxwGBS','jsparrow@test.com','Honda','Accord',2020,'White','ACCO','https://i.imgur.com/1F5KHW4.jpg',1,1,1,1,0,100),(37,'Admin','Admin','Admin','$2y$10$fwhuqA6bT8LwsX6JA91UreyuV01dYPv5vvddBiq6y2Sf15g7LHJ.6','admin@admin.com','Admin','Admin',2020,'Admin','Admin',NULL,1,10,1,1,0,100),(39,'admin','admin','admin','$2y$10$pQlO2qEv6Q6V3JlWx.BaluP.kyVF8rl3h5lz8CUuc/rdyug4JPJUO','admin@test.com','admin','admin',2020,'admin','admin',NULL,1,10,1,1,0,100),(40,'tester','tester','tester','$2y$10$TjCSpGcCm4wGFVCxPlzP/OrwFzX.rGXQt7f7l8UUwwTPTcrngSe9O','tester@csub.edu','tester','tester',2020,'tester','tester',NULL,1,1,1,1,0,100),(41,'Albert','Name','1234','$2y$10$7aNvj21QP/ysE68Xqh77mOXcglDpyh77hERR8TqFmncKAVjbeNI66','email@empty.com','Toyota','Gt86',2011,'White','1234',NULL,1,5,1,1,0,100),(42,'user','user','user','$2y$10$4bkxZypL9HvlZndTSUPX4ui1577tPTXjd7ZelXGPKiJjd3A6JDQn6','user@test.com','Toyota','GT86',2020,'Green','HELO',NULL,1,1,1,1,0,100),(63,'David','Test','dtest','$2y$10$BTM15Zpr.z0H2nZvswsnzuZE90KzAz3nxCYEHQ3/tmPTKtKrSWfoa','d@test.com','Toyota','GT86',2020,'Black','G251','https://i.imgur.com/6hZuokQ.jpg',1,1,2,2,0,100),(69,'cool','cool','cool','$2y$10$Yar3qYTAvhUe/57AmB/NBugH0s1ly7m6r6sKII/iSoAXK5K8JibLO','cool@cool.com','cool','cool',1234,'cool','cool','https://i.imgur.com/gWZqnGQ.jpg',1,1,1,1,0,100),(89,'david','test','davidtest','$2y$10$qUZ1rLV9arQEMA8jkCb/yOa3Ub85tDX9TMmr2rRrov97/CnWHfFAK','dtest@test.com','Toyota','GT86',2017,'Black','DDDD','https://i.imgur.com/cLiY2V1.png',1,1,1,1,0,100),(94,'Terry','Watson','test1234','$2y$10$OxArh7H7EtUTmmyqGlktjutuRPUoZraunN1g9PmnsFjNptoaOBinG','talass3@live.com','Pontiac','Firebird',1998,'White','7JZ8','https://i.imgur.com/Md4ysrU.jpg',1,1,1,1,0,100),(95,'Elon','Musk','elon','$2y$10$.D9R/zp0uUhMf9R6m1B5xOMTqJoFdnjdnVChx.I5ry0rYWIwe3oGC','elon@csub.edu','Tesla','X',2020,'Black','DALL','https://i.imgur.com/B8IXZ1K.jpg',1,1,5,2,3,40),(96,'Test','Mando','mando','$2y$10$XKzDzeOr9baZH5FgoNPd7.i7Vi1PCoz5O5mqANDmchqNjsAKEMAyC','test20@email.com','Toyota','Camri',1998,'White','7K21',NULL,1,1,1,1,0,100),(97,'Ford','Ranger','fordRangerguy','$2y$10$a8r9LCvvnZYMUoFuJNeMEOrOmSFIJLr9gy.HkwW4RdHhfp5k/6ocK','test2021@email.com','Ford','Ranger',1998,'White','Y890',NULL,1,1,1,1,0,100);
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passwordReset`
--

LOCK TABLES `passwordReset` WRITE;
/*!40000 ALTER TABLE `passwordReset` DISABLE KEYS */;
INSERT INTO `passwordReset` VALUES (1,'jcervantes23@csub.edu','eaa9bb753d3d217930b8f717033aad0077d7908d1aab095729afe3eef09927fd725ee5ad65302292bb9cc8180ce047a20625','2021-03-13 08:33:44','2021-03-13 08:38:44',NULL,0),(2,'jcervantes23@csub.edu','a5327449bde435850761f9e23a7dcb42b5e545ed4fec7f03cb569cfc32e695bb333746fa59cf876b8bdbf10307b87df7e883','2021-03-13 08:49:49','2021-03-13 08:54:49',NULL,0),(3,'jcervantes23@csub.edu','e44c34654a493ec1fadcf646a6c82ea07ae823f94e602cf23ecd0dd7ad06ba6a417cffb86b2e223f8374cbfe7df06e5cbb1e','2021-03-13 09:14:57','2021-03-13 09:19:57',NULL,0),(4,'jcervantes23@csub.edu','189aa1cc1bd98cd5304725bc73f0ca919e243c2bde898d863eea30d28faba4ce9a2f6fb277043b7bc336bfc64f77321b6cdd','2021-03-13 09:17:50','2021-03-13 09:22:50',NULL,0),(5,'jcervantes23@csub.edu','f63db4102d14801caedbe021ed1c9524e88152f814e10687f436d32db363eb999b522ba47a0f639a1bda7020da067501cff2','2021-03-13 09:23:20','2021-03-13 09:28:20',NULL,0),(6,'jcervantes23@csub.edu','389739fe3d6da91fd4668d1a581784863caf5f3e9d1d7c44f21dd9a2a48dee482cce63827475c79293ecf8f92be43da79834','2021-03-13 09:28:29','2021-03-13 09:33:29',NULL,0),(7,'jcervantes23@csub.edu','b18d9e8abd34699cdb17b5fff32a6a155f6d71b95351553b1fb2bd0b7ee83241d91d88edb04e6566dd970bfb32b7e6a99217','2021-03-13 11:12:48','2021-03-13 11:17:48',NULL,0),(8,'jcervantes23@csub.edu','a4307885cb450d877e133c12d80cfc9fefcb764c770ffddc6b071dbcc4aebf1c1f49ccbc6627bb18d038d94cc93c22599b19','2021-03-13 11:22:48','2021-03-13 11:27:48',NULL,0),(9,'jcervantes23@csub.edu','c4d6217827149219ca534ef3cf01a1bedb5ded9fcc14eac638763ae8ebf849021aab636b1658a1b4f885739d9bf2515c7fc8','2021-03-13 11:32:24','2021-03-13 11:37:24',NULL,0),(10,'jcervantes23@csub.edu','fc885def2de11a5c77dfbe950959de88f04b2f062bc1e56bf6b8c137d59c54a93dba8a74fecb15707a1d745ca5c3aef511fd','2021-03-13 11:35:04','2021-03-13 11:40:04',NULL,0),(11,'jcervantes23@csub.edu','3cfcf0101e7a4e791c12ce46013bee3d65298372d7c113bf88e121e449232631cdaf81cf2a260128af4b8bbca338ef27ae4a','2021-03-13 11:40:58','2021-03-13 11:45:58',NULL,0),(12,'jcervantes23@csub.edu','c438e31861921eedf6574e18d6ba8fbedf563ac70dc68869dbf5c4b1a378c2856cf65cf639780a5a2498bff2b4990e4d71c2','2021-03-13 11:50:26','2021-03-13 11:55:26',NULL,0),(13,'jcervantes23@csub.edu','c45015c8097e00e0f0d83a47a9f6f53d596a4645fa6231749608b86ebda1f74b7e982e151dbf43b9d0c5d0fc1dbb3cd38af0','2021-03-13 12:05:04','2021-03-13 12:10:04',NULL,0),(14,'jcervantes23@csub.edu','eb90824488d8b2a650e6be4dc1c2538843444c8b857fcbf99ea9f044a2586f18e937cd485d930471ea1c1971f8bb48c81717','2021-03-13 12:11:35','2021-03-13 12:16:35',NULL,0),(15,'jcervantes23@csub.edu','cd898f75a495696d998d4a0c1e728b90a22b6a04933c8280ce13f63297101a5f8d43ce6bb2eb6f4034b8b89861ebcdd010c6','2021-03-13 12:16:51','2021-03-13 12:21:51',NULL,0),(16,'jcervantes23@csub.edu','4ec2555680c3aa0983e01d3f099cc517fc3280721accbdaa433bedabccb03b60e37b105ac8448317813a08e06e83f71091b8','2021-03-13 12:19:23','2021-03-13 12:24:23',NULL,0),(17,'jcervantes23@csub.edu','d3612bdcedeb0c2c1fa8d6dc11395f0c4d7a52ca44748f12ce05fcc4e711831b9e5ab362e421a5ad6612f71bd3ce1c456f5f','2021-03-13 12:21:02','2021-03-13 12:26:02',NULL,0),(18,'jcervantes23@csub.edu','230377ff0af51ccd1cff52f3294eba0af4f013847dfd6150be051310d50d16160b6f2c3e7e297d0bda623626d695ebb9d235','2021-03-14 02:18:06','2021-03-14 02:23:06',NULL,0),(19,'jcervantes23@csub.edu','ad0e60a32529f56fa63f09d719c37f3bf7bf9609b6b47d13074c2bce9770fc7da8c31b1ca581130e324412910d8b8c0ac356','2021-03-15 07:27:46','2021-03-15 07:32:46',NULL,0),(20,'jcervantes23@csub.edu','be1c32be9d58bd82f857ffbeee184529310b4b0d447a77c889a5e106f4875473ed81855691959ab11befffa6a39158ec9c43','2021-03-15 07:47:09','2021-03-15 07:52:09',NULL,0),(21,'jcervantes23@csub.edu','d9d6cee548c1efd8bb3e3df96735c262b11398704e6e24d22a38d149de2acf33aed10e120b025c4a820d8ebda7a283ab6b5c','2021-03-15 08:10:11','2021-03-15 08:15:11',NULL,0),(22,'jcervantes23@csub.edu','5b3a4b3ef63d4e82957e88837d540fb7fddfc0d0f8c3d27838bf55cdf964926686a701ec347383e4e767e589d6dd7f115291','2021-03-15 08:12:34','2021-03-15 08:17:34',NULL,0),(23,'jcervantes23@csub.edu','061a4e57818383fdacae4535e8361c9c39e24fecfaab2003845a2b04ab6fc7b0553eb005dec15034ef9ec6099eca1c650e41','2021-03-15 08:15:12','2021-03-15 08:20:12',NULL,0),(24,'jcervantes23@csub.edu','0a05c490ee64cc7aa020dea9f0503a7e50bda64e3cf50a70f91fd290956f388ccf3c87816bbadd1b903ee587783800d294e0','2021-03-15 08:31:40','2021-03-15 08:36:40',NULL,0),(25,'jcervantes23@csub.edu','62e81c8b4fdc1bbd996af3963741a393864bf2bb1f307ea45f16cc263537944d3753e9c227ba80c48fefe1aaef355b01caa5','2021-03-15 08:39:50','2021-03-15 08:44:50',NULL,0),(26,'jcervantes23@csub.edu','3cc356224fd893e17ca09533d1603265ea602ddb36240e3583ade77c0117ac0b388ef9ae4e1a2075361b4addd7c34a0dddad','2021-03-15 08:48:40','2021-03-15 08:53:40',NULL,0),(27,'jcervantes23@csub.edu','a48daf276caaca6347cfebd473b4f900838c16895245a2ea65db1024d416d1829227c63d2aecf557da47796008f944a40d9e','2021-03-15 08:59:27','2021-03-15 09:04:27',NULL,0),(28,'jcervantes23@csub.edu','e844f5be1a5c4ed75cecf348641f68689d0385c4f946cbefe01117e58750905cf0b64e138e91228a3c52dc912bc025df34a9','2021-03-15 09:05:59','2021-03-15 09:10:59',NULL,0),(29,'jcervantes23@csub.edu','c43c012173b21adcedb97ab5a6dc587411ab248580253c9394fa625f83cb8e9b010379b5f927c2bac9f6784b88cd2f0a5e03','2021-03-15 20:55:43','2021-03-15 21:00:43',NULL,0),(30,'jcervantes23@csub.edu','5dde7166c0ed1a3146db56f8b9db8288f9047ea2f5c66fad832bb65026453498bdd9dc60d477b9416446c6373d09f67dec52','2021-03-15 21:27:16','2021-03-15 21:32:16',NULL,0),(31,'jcervantes23@csub.edu','a95ee62718640bacc00091da70a76cd6dbecb72657d76f9aaeb7f112bed55827a9429c7197eee9a67af9b786540af3281c0b','2021-03-15 21:34:51','2021-03-15 21:39:51',NULL,0),(32,'jcervantes23@csub.edu','1544242ba3db3b8c3eed7914b5afecbcdc3465f5cf825a48431dcc7d13ffe7ef4f4bc893a4a0265b83e5f643c1baab4c660f','2021-03-15 21:37:01','2021-03-15 21:42:01',NULL,0),(33,'dmontes-de-oca@csub.edu','547af42f249026547ea19b2335e7637563124e4fc8135103dbf56a77631c8244879bfbc8a801ede123bab9dba601d5e4cce0','2021-03-16 00:28:30','2021-03-16 00:33:30',NULL,0),(34,'dmontes-de-oca@csub.edu','1755317a115c8e413b05823dd4756e0afc7d93fee8a26c78e13811671a178986efce662608e37150d1e3f1e0803cdf64b173','2021-03-16 00:39:00','2021-03-16 00:44:00',NULL,0),(35,'dmontes-de-oca@csub.edu','be57312f276cb9033e3fbe30a7361fcf73b0fdfcbc6c814b38d490a478013edcc88adcb412716323b25ea67379bd58e4992f','2021-03-16 03:01:23','2021-03-16 03:06:23',NULL,0),(36,'dmontes-de-oca@csub.edu','4444e3999fb03b54bdb08b9da01e731f08cbda3e17656d04dfaf8cf0077f57d86e36da66d57f6b22fb9e007cdb5c40bd62c4','2021-03-16 03:02:31','2021-03-16 03:07:31',NULL,0),(37,'dmontes-de-oca@csub.edu','f7ebf00758d6bef54fe55133a5f337b5ad85e6539cb914c97a3f5d9a655ea6933043ec57c438c23d2c057bc3a6769fc03989','2021-03-16 03:08:20','2021-03-16 03:13:20',NULL,0),(38,'dmontes-de-oca@csub.edu','e3d751b7090219fa820997582b25e57edc27bf29622509b0d875e5af2ab5d96484f43d0bf0f05afced6572cb35b7b405bd79','2021-03-16 03:13:41','2021-03-16 03:18:41',NULL,0),(39,'dmontes-de-oca@csub.edu','ffdd22d792626181266e26c3a19fb855f0353e43b606d8d116a1efc667090b8ffedb329f1bf2171bc35558de404efe8996d1','2021-03-16 03:15:10','2021-03-16 03:20:10',NULL,0),(40,'dmontes-de-oca@csub.edu','196c0428ba7d1bd6391d8f4e50fc13327eb3278286529f9e012ba7ea1b4beb037fd99cc5ab0a4d3d84d764f6600ccae0ebe9','2021-03-16 03:18:40','2021-03-16 03:23:40',NULL,0),(41,'dmontes-de-oca@csub.edu','80c3d153fd017d5639e191e2897e91fbd812dfc5a9f6697a6596cf48158cd71afc8d5f154835bf54cf5981541abfe09fcb7c','2021-03-16 03:21:12','2021-03-16 03:26:12',NULL,0),(42,'dmontes-de-oca@csub.edu','57166eb2156725619655bc89034ce82ca7e0bc19e1c4e596579097833cd1c952f37574c33d98d5ad5531b5f4b3738679d444','2021-03-16 03:24:11','2021-03-16 03:29:11',NULL,0),(43,'dmontes-de-oca@csub.edu','98a86d15a6a6358acd32b3a3598b3e42c1af7404a2bb8f3423d02791a4a653cb3d1e77f487cc97f9ccf89ceebf593e4f3b66','2021-03-16 03:25:42','2021-03-16 03:30:42',NULL,0),(44,'dmontes-de-oca@csub.edu','dbfe90b8aa0a19c8b6331b0a9b4d6bf203e4401bb154fa78546a695cfaadc7cdf102f7e7fede51cb92184042027744d98423','2021-03-16 03:46:00','2021-03-16 03:51:00',NULL,0),(45,'dmontes-de-oca@csub.edu','4e2c4bbb3f94ef5eb60ca19c966a3ce74489a7e4547ad5c67413bc47acaa38cd86ee239e6df1b9037b5c52583d68eef94fda','2021-03-16 03:55:17','2021-03-16 04:00:17',NULL,0),(46,'dmontes-de-oca@csub.edu','f46512c215d3f90d690a14f4ebc5e96ac43525ec96a3dbf36d05a22d03c931c6d8a4e80a0253bc0a9b12a48e8665331034bc','2021-03-16 04:05:28','2021-03-16 04:10:28',NULL,0),(47,'jcervantes23@csub.edu','b91e5d3ac4cdfa48ba28e5cd81378dab7dbdd9872224f9092564cd0289a05b6de5128d08a061a61974f54e088e84dc84f6ea','2021-04-03 06:06:20','2021-04-03 06:11:20',NULL,0),(48,'aaldana2@csub.edu','69b9bc51bd635f0b1d5e9ac768a29f0287e70c73ec48963fa863a85672d7a48de96f4c892e06e6ef652541d9919712a67f07','2021-04-07 01:00:33','2021-04-07 01:05:33',NULL,0),(49,'jcervantes23@csub.edu','70c0b4b470a13d465a983beebbccaccf8778a32a7ae90084147a326312c85bcc810ec86d3c96cc3f8ebaf6997ffb4331970a','2021-04-09 09:07:32','2021-04-09 09:12:32',NULL,1),(50,'talass2@live.com','6dc1f3cdd3f248eb77cb959ef8c3581d8f122a6ca3bbf8232e7b7acf2786af35d0820387598115976873bcb8dae5bcc7838c','2021-04-09 19:36:31','2021-04-09 19:41:31',NULL,1);
/*!40000 ALTER TABLE `passwordReset` ENABLE KEYS */;
UNLOCK TABLES;

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
/*!50001 VIEW `SpotsDetails` AS select `Users`.`userID` AS `userID`,`Users`.`userName` AS `userName`,`Users`.`make` AS `make`,`Users`.`model` AS `model`,`Users`.`year` AS `year`,`Users`.`color` AS `color`,`Users`.`licensePlate` AS `licensePlate`,`Users`.`carPhoto` AS `carPhoto`,`Spots`.`time` AS `time` from (`Users` join `Spots` on(`Users`.`userID` = `Spots`.`pUserID`)) order by `Spots`.`time` */;
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

-- Dump completed on 2021-04-14 21:32:55
