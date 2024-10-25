DROP TABLE IF EXISTS `zones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zones` (
  `zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_country_id` int(11) NOT NULL,
  `zone_code` varchar(32) NOT NULL,
  `zone_name` varchar(255) NOT NULL,
  PRIMARY KEY (`zone_id`),
  KEY `idx_zones_country_id` (`zone_country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4316 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zones`
--

LOCK TABLES `zones` WRITE;
/*!40000 ALTER TABLE `zones` DISABLE KEYS */;
INSERT INTO `zones` VALUES
(908,56,'US','Ústecký'),
(909,56,'JC','Jihočeský'),
(910,56,'JM','Jihomoravský'),
(911,56,'KA','Karlovarský'),
(912,56,'KR','Královéhradecký'),
(913,56,'LI','Liberecký'),
(914,56,'MO','Moravskoslezský'),
(915,56,'OL','Olomoucký'),
(916,56,'PA','Pardubický'),
(917,56,'PL','Plzeňský'),
(918,56,'PR','Hlavní město Praha'),
(919,56,'ST','Středočeský'),
(920,56,'VY','Vysočina'),
(921,56,'ZL','Zlínský');
/*!40000 ALTER TABLE `zones` ENABLE KEYS */;
UNLOCK TABLES;
