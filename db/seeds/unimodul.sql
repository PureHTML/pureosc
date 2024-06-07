--
-- Table structure for table `unimodul_transactions`
--

DROP TABLE IF EXISTS `unimodul_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unimodul_transactions` (
  `transactionPK` int(11) NOT NULL AUTO_INCREMENT,
  `uniModulName` varchar(30) NOT NULL,
  `gwOrderNumber` varchar(100) DEFAULT NULL,
  `shopOrderNumber` varchar(30) DEFAULT NULL,
  `shopPairingInfo` varchar(100) DEFAULT NULL,
  `uniModulData` blob DEFAULT NULL,
  `uniAdapterData` blob DEFAULT NULL,
  `forexNote` varchar(200) DEFAULT NULL,
  `orderStatus` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime DEFAULT NULL,
  `gwPairingInfo` varchar(80) DEFAULT NULL,
  `gwAccount` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`transactionPK`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

