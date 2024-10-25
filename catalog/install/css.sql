-- MariaDB dump 10.19  Distrib 10.11.6-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: ruzky
-- ------------------------------------------------------
-- Server version	10.11.6-MariaDB-0+deb12u1

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
-- Table structure for table `css`
--

DROP TABLE IF EXISTS `css`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `css` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `value` longtext DEFAULT NULL,
  `sort_order` int(6) NOT NULL DEFAULT 0,
  `min` int(5) NOT NULL DEFAULT 0,
  `max` int(5) NOT NULL DEFAULT 0,
  `template` varchar(64) NOT NULL DEFAULT '',
  `subtemplate` varchar(64) DEFAULT NULL,
  `tag` varchar(256) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `inline` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `css`
--

LOCK TABLES `css` WRITE;
/*!40000 ALTER TABLE `css` DISABLE KEYS */;
INSERT INTO `css` VALUES
(1,'body','font:18px/26px Helvetica, arial,sans-serif',0,0,0,'','','',1,0),
(2,'html','box-sizing: border-box',0,0,0,'','','',1,0),
(3,'*, *:before, *:after','box-sizing:inherit',0,0,0,'','','',1,0),
(8,'body > table:nth-of-type(1)','width:94vw;height:100vh;margin:auto; border-left:1px solid black;border-right:1px solid black;',0,0,0,'','','',1,0),
(9,'body > table:nth-of-type(1)','width:80vw',0,640,0,'','','',0,0),
(175,'ul:first-of-type','float:right;background:black;padding:1em 1em 1em 0;margin-left:2em',0,0,0,'',NULL,NULL,1,0),
(177,'ul:first-of-type li','list-style-type: none;padding:0;',0,0,0,'','','',1,0),
(178,'body > table:nth-of-type(1) td','padding:0 2em',0,0,0,'','','',1,0),
(183,'hr','border-top:1px solid black;z-index:10;width:110%;left:-5%;position:relative',0,0,0,'','','',1,0),
(184,'ul:first-of-type li a:link','text-decoration:none;color:white',0,0,0,'','','',1,0),
(185,'ul:first-of-type li a:visited','text-decoration:none;color:#ccc',0,0,0,'','','',1,0),
(186,'form:first-of-type','display:inline',0,0,0,'','','',1,0);
/*!40000 ALTER TABLE `css` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-04  3:32:20
