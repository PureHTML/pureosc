CREATE TABLE IF NOT EXISTS `unimodul_transactions` (
  `transactionPK` int(11) NOT NULL AUTO_INCREMENT,
  `uniModulName` varchar(30) NOT NULL,
  `gwOrderNumber` varchar(100) DEFAULT NULL,
  `shopOrderNumber` varchar(30) DEFAULT NULL,
  `shopPairingInfo` varchar(100) DEFAULT NULL,
  `uniModulData` blob,
  `uniAdapterData` blob,
  `forexNote` varchar(200) DEFAULT NULL,
  `orderStatus` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime DEFAULT NULL,
  `gwPairingInfo` varchar(80) DEFAULT NULL,
  `gwAccount` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`transactionPK`)
) DEFAULT CHARSET=utf8;