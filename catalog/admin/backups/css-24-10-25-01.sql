-- MariaDB dump 10.19  Distrib 10.11.6-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: pureosc
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
  `subtemplate` varchar(64) NOT NULL DEFAULT '',
  `tag` varchar(256) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT 1,
  `inline` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=299 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
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
(8,'body','width:94vw;margin:auto;',0,0,0,'','','',1,0),
(186,'form:first-of-type','display:inline;',0,0,0,'','','',1,0),
(190,'form:first-of-type > button:first-of-type','float:right;z-index:1;opacity: 0.85 !important;\r\nborder:0;max-width: 4%; width:30px;height:30px;background:url(\"data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAiIGhlaWdodD0iMzAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTEwLDE4YzEuODQ2LDAsMy41NDMtMC42MzUsNC44OTctMS42ODhsNC4zOTYsNC4zOTZsMS40MTQtMS40MTRsLTQuMzk2LTQuMzk2QzE3LjM2NSwxMy41NDMsMTgsMTEuODQ2LDE4LDEwIGMwLTQuNDExLTMuNTg5LTgtOC04cy04LDMuNTg5LTgsOFM1LjU4OSwxOCwxMCwxOHogTTEwLDRjMy4zMDksMCw2LDIuNjkxLDYsNnMtMi42OTEsNi02LDZzLTYtMi42OTEtNi02UzYuNjkxLDQsMTAsNHoiLz48L3N2Zz4K\")',0,0,0,'','','',1,0),
(193,'input,button','border-radius:0; border:1px solid #ccc',0,0,0,'','','',1,0),
(194,'input[name=\"keywords\"]','font-size:110%;width:30vw; max-width:700px',0,0,0,'','','',1,0),
(195,'a','text-decoration:none',0,0,0,'','','',1,1),
(196,'p a','text-decoration:underline',0,0,0,'','','',1,1),
(203,'a[href$=\"account.php\"]','background:url(\"data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAiIGhlaWdodD0iMzAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxjaXJjbGUgZmlsbD0ibm9uZSIgY3g9IjEyIiBjeT0iNyIgcj0iMyIvPjxwYXRoIGQ9Ik0xMiAyQzkuMjQzIDIgNyA0LjI0MyA3IDdzMi4yNDMgNSA1IDUgNS0yLjI0MyA1LTVTMTQuNzU3IDIgMTIgMnpNMTIgMTBjLTEuNjU0IDAtMy0xLjM0Ni0zLTNzMS4zNDYtMyAzLTMgMyAxLjM0NiAzIDNTMTMuNjU0IDEwIDEyIDEwek0yMSAyMXYtMWMwLTMuODU5LTMuMTQxLTctNy03aC00Yy0zLjg2IDAtNyAzLjE0MS03IDd2MWgydi0xYzAtMi43NTcgMi4yNDMtNSA1LTVoNGMyLjc1NyAwIDUgMi4yNDMgNSA1djFIMjF6Ii8+Cjwvc3ZnPg==\")\r\n',0,0,0,'','','devel',0,0),
(204,'a[href$=\"shopping_cart.php\"]','background:url(\"data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAiIGhlaWdodD0iMzAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxwYXRoIGQ9Ik0yMS44MjIsNy40MzFDMjEuNjM1LDcuMTYxLDIxLjMyOCw3LDIxLDdINy4zMzNMNi4xNzksNC4yM0M1Ljg2NywzLjQ4Miw1LjE0MywzLDQuMzMzLDNIMnYyaDIuMzMzbDQuNzQ0LDExLjM4NSBDOS4yMzIsMTYuNzU3LDkuNTk2LDE3LDEwLDE3aDhjMC40MTcsMCwwLjc5LTAuMjU5LDAuOTM3LTAuNjQ4bDMtOEMyMi4wNTIsOC4wNDQsMjIuMDA5LDcuNywyMS44MjIsNy40MzF6IE0xNy4zMDcsMTVoLTYuNjQgbC0yLjUtNmgxMS4zOUwxNy4zMDcsMTV6Ii8+PGNpcmNsZSBjeD0iMTAuNSIgY3k9IjE5LjUiIHI9IjEuNSIvPjxjaXJjbGUgY3g9IjE3LjUiIGN5PSIxOS41IiByPSIxLjUiLz4KPC9zdmc+Cg==\")\r\n',0,0,0,'','','devel',0,0),
(205,'a[href$=\"wishlist.php\"]','background:url(\"data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAiIGhlaWdodD0iMzAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxwYXRoIGQ9Ik0xMiw0LjU5NWMtMS4xMDQtMS4wMDYtMi41MTItMS41NTgtMy45OTYtMS41NThjLTEuNTc4LDAtMy4wNzIsMC42MjMtNC4yMTMsMS43NThjLTIuMzUzLDIuMzYzLTIuMzUyLDYuMDU5LDAuMDAyLDguNDEyIGw3LjMzMiw3LjMzMmMwLjE3LDAuMjk5LDAuNDk4LDAuNDkyLDAuODc1LDAuNDkyYzAuMzIyLDAsMC42MDktMC4xNjMsMC43OTItMC40MDlsNy40MTUtNy40MTUgYzIuMzU0LTIuMzU0LDIuMzU0LTYuMDQ5LTAuMDAyLTguNDE2Yy0xLjEzNy0xLjEzMS0yLjYzMS0xLjc1NC00LjIwOS0xLjc1NEMxNC41MTMsMy4wMzcsMTMuMTA0LDMuNTg5LDEyLDQuNTk1eiBNMTguNzkxLDYuMjA1IGMxLjU2MywxLjU3MSwxLjU2NCw0LjAyNSwwLjAwMiw1LjU4OEwxMiwxOC41ODZsLTYuNzkzLTYuNzkzQzMuNjQ1LDEwLjIzLDMuNjQ2LDcuNzc2LDUuMjA1LDYuMjA5IGMwLjc2LTAuNzU2LDEuNzU0LTEuMTcyLDIuNzk5LTEuMTcyczIuMDM1LDAuNDE2LDIuNzg5LDEuMTdsMC41LDAuNWMwLjM5MSwwLjM5MSwxLjAyMywwLjM5MSwxLjQxNCwwbDAuNS0wLjUgQzE0LjcxOSw0LjY5OCwxNy4yODEsNC43MDIsMTguNzkxLDYuMjA1eiIvPgo8L3N2Zz4=\")\r\n',0,0,0,'','','devel',0,0),
(206,'a:visited','color:#666',0,0,0,'','','',1,0),
(207,'a:link','color:#333',0,0,0,'','','',1,0),
(214,'a:active','color: red',0,0,0,'','','',1,0),
(216,'input[name=\"keywords\"]','width:95% !important;z-index: 0',0,0,768,'','','',1,0),
(230,'a[href$=\"index.php\"]','color: #ccc;font-size:2em;font-weight:700; background: #000;  padding: 0 .3em;',0,0,0,'','','',1,0),
(252,'h3','margin-bottom:0',0,0,0,'','','',1,0),
(253,'.flc a','float:left;margin-right:1em',0,0,0,'','','',1,0),
(255,'td','display:block; width:100%',0,0,768,'','','',1,1),
(256,'table','border:1px solid #555 !important',0,0,0,'','','debug',0,0),
(257,'#m:target','display: table-cell',0,0,0,'','','',1,0),
(261,'#m > a','color: #fff; display: inline-block; margin-right:2em',0,0,0,'','','',1,0),
(262,'b','display:none',0,0,0,'','','',1,0),
(265,'#cim > a > img, #cim > a','float:left; margin-right:1em',0,0,0,'','','',1,0),
(266,'body > center > table:last-of-type > tbody >  tr > td ','text-align:center',0,0,0,'','','',1,0),
(267,'#f','border-top: 2px dashed gray;1em;padding-top:.6em',0,0,0,'','','footer',1,0),
(268,'body > center > table:last-of-type, body > center > table:nth-child(2)','margin-top:1em !important',0,0,0,'','','',1,0),
(269,'#m','display: none',0,0,768,'','','',1,0),
(272,'table','border-spacing: 0px',0,0,0,'','','',0,0),
(273,'body > center > table','max-width:1680px',0,0,0,'','','',1,0),
(282,'table','border-spacing:0px',0,0,0,'','','',1,0),
(283,'#m','background:#000',0,0,0,'','','',1,0),
(287,'body > center > table:nth-child(1) > tbody > tr:nth-child(1) > td:nth-child(n+2)','float:right',0,0,0,'','','',1,0),
(290,'body > center > table:nth-child(1) > tbody > tr:nth-child(1) > td:nth-child(-n+2)','display: inline-block !important; width:49%',0,0,768,'','','',1,0),
(292,'a[href=\"#m\"]','display:none',0,768,0,'','','',1,0),
(293,'a[href=\"#m\"], a[href$=\"account.php\"], a[href$=\"shopping_cart.php\"], a[href$=\"wishlist.php\"]','font-size:150%',0,0,0,'','','',1,0),
(298,'a[href$=\"index.php\"]','font-size:1.2em !important;position:relative; top:-4px;left:1em',0,0,768,'','','',1,0);
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

-- Dump completed on 2024-10-25  6:19:04
