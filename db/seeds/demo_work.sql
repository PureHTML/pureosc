LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES
(5,1,'',0,0,'2023-09-19 02:05:27','2024-01-18 01:25:05',0,0,NULL),
(6,1,'',0,999,'2023-09-19 02:05:51','2024-01-18 01:16:26',0,0,NULL),
(7,1,'',0,0,'2023-09-19 02:06:09','2024-01-18 01:44:30',0,0,NULL),
(9,1,'',0,2,'2024-01-18 00:53:47','2024-01-18 01:49:08',0,0,NULL),
(12,1,'',0,2,'2024-01-18 01:07:30','2024-01-18 01:49:54',0,0,NULL),
(13,1,'',0,2,'2024-01-18 01:13:10','2024-01-18 01:49:25',0,0,NULL),
(14,1,'',0,0,'2024-01-18 01:17:45',NULL,0,0,NULL),
(15,1,'',0,2,'2024-01-18 01:25:39','2024-01-18 01:52:37',0,0,NULL),
(16,1,'',0,1,'2024-01-18 01:27:57','2024-01-18 01:50:29',0,0,NULL),
(17,1,'',0,2,'2024-01-18 01:34:07','2024-01-18 01:50:47',0,0,NULL),
(18,1,'',0,1,'2024-01-18 01:35:46','2024-01-18 01:50:13',0,0,NULL),
(19,1,'',0,999,'2024-01-18 01:37:14','2024-01-18 01:52:07',0,0,NULL),
(20,1,'',0,0,'2024-01-18 01:54:56',NULL,0,0,NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `categories_description` WRITE;
/*!40000 ALTER TABLE `categories_description` DISABLE KEYS */;
INSERT INTO `categories_description` VALUES
(5,3,'','','','',''),
(5,5,'eshopy na klíč','<p>self hosted OSS eshop</p>','','',''),
(6,3,'','','','',''),
(6,5,'o nás','','','',''),
(7,3,'eknihy','','','',''),
(7,5,'eknihy - výroba','','','',''),
(9,3,'','','','',''),
(9,5,'ai aplikace','','','',''),
(12,3,'','','','',''),
(12,5,'crypto otp','','','',''),
(13,3,'','','','',''),
(13,5,'big data storage','','','',''),
(14,3,'','','','',''),
(14,5,'webdesign','','','',''),
(15,3,'','','','',''),
(15,5,'osCommerce','','','',''),
(16,3,'','','','',''),
(16,5,'css coding','','','',''),
(17,3,'','','','',''),
(17,5,'eknihy crypto drm','','','',''),
(18,3,'','','','',''),
(18,5,'crypto storage','','','',''),
(19,3,'','','','',''),
(19,5,'blog','','','',''),
(20,3,'','','','',''),
(20,5,'sazba knih','','','','');
/*!40000 ALTER TABLE `categories_description` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES
(2,1,'',NULL,0.0000,'2023-09-19 02:21:01',NULL,'2023-09-19 00:00:00',0.00,1,0,0,0,0,NULL,0,0,0,0,'','',0,'',0,0,'','','','','','','',1,NULL),
(3,0,'',NULL,0.0000,'2024-01-13 00:38:19','2024-01-28 10:19:20','2024-01-13 00:00:00',0.00,1,0,94,1,10,NULL,1,0,0,0,'','',0,'',0,0,'','','','','','','',1,NULL),
(4,1,'',NULL,0.0000,'2024-01-18 01:57:24',NULL,'2024-01-18 00:00:00',0.00,1,0,0,0,0,NULL,0,0,0,0,'','',0,'',0,0,'','','','','','','',1,NULL),
(28,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-18 08:36:50',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(29,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-18 08:36:50',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(30,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-18 22:24:50',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(31,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-18 22:24:51',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(32,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-18 22:29:37',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(33,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-18 22:29:37',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(34,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:06',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(35,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:06',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(36,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:06',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(37,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:06',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(38,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:06',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(39,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:06',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(40,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:07',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(41,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:07',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(42,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:07',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(43,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:07',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(44,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:07',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(45,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:07',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(46,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:08',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(47,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:08',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(48,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:08',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(49,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:08',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(50,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:08',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(51,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:08',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(52,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:08',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(53,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:09',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(54,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:09',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(55,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:09',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(56,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:09',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(57,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:09',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(58,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:09',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(59,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:10',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(60,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:10',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(61,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:10',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(62,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:10',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(63,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:10',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(64,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:10',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(65,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:11',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(66,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:11',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(67,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:11',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(68,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:11',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(69,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:11',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(70,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:11',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(71,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:12',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(72,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:12',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(73,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:12',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(74,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:12',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(75,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:12',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(76,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:12',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(77,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:13',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(78,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:13',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(79,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:13',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(80,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:13',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(81,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:13',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(82,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:13',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(83,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:13',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(84,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:14',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(85,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:14',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(86,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:14',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(87,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:14',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(88,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:14',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(89,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:14',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(90,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:15',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(91,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:15',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(92,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:15',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(93,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:15',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(94,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:15',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(95,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:15',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(96,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:15',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(97,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:16',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(98,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:16',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(99,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:16',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(100,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:16',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(101,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:16',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(102,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:16',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(103,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:17',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(104,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:17',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(105,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:17',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(106,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:17',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(107,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:17',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(108,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:17',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(109,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:18',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(110,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:18',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(111,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:18',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(112,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:18',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(113,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:18',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(114,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:18',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(115,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:18',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(116,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:19',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(117,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:19',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(118,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:19',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(119,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:19',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(120,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:19',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(121,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:19',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(122,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:20',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(123,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:20',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(124,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:20',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(125,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:20',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(126,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:20',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(127,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:20',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(128,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:21',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(129,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:21',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(130,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:21',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(131,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:21',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(132,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:21',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(133,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:21',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(134,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:21',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(135,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:58:22',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(136,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 05:59:12',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(137,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-20 06:00:51',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL),
(138,1,NULL,NULL,0.0000,'1970-01-01 00:00:00',NULL,'2024-01-22 01:38:45',0.00,1,0,1,1,0,NULL,0,0,0,0,'','',0,'',0,0,NULL,'','','','','','',1,NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `products_attributes`
--

LOCK TABLES `products_attributes` WRITE;
/*!40000 ALTER TABLE `products_attributes` DISABLE KEYS */;
INSERT INTO `products_attributes` VALUES
(191,3,1,1,90.9091,1,0.0000,'+',24,'',0,1,1,0,0,0,'','',0,0.00),
(192,3,1,2,109.0909,1,0.0000,'+',76,'',0,2,1,0,0,0,'','',0,0.00);
/*!40000 ALTER TABLE `products_attributes` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Dumping data for table `products_attributes_download`
--

LOCK TABLES `products_attributes_download` WRITE;
/*!40000 ALTER TABLE `products_attributes_download` DISABLE KEYS */;
INSERT INTO `products_attributes_download` VALUES
(138,'anonym--test.pdf',0,0),
(146,'alien--test.pdf',0,0),
(148,'t2.pdf',0,0),
(149,'t2.epub',0,0),
(150,'alien--test.epub',0,0),
(165,'anonym--testovaci-produkt.pdf',0,0),
(177,'krize-pravdy.epub',0,0),
(186,'proc-dnes-cist-hannah-arendtovou.epub',0,0),
(190,'autorsky-test--test-e-knihy.pdf',0,0),
(192,'simon-formanek--automated.pdf',0,0);
/*!40000 ALTER TABLE `products_attributes_download` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Dumping data for table `products_description`
--

LOCK TABLES `products_description` WRITE;
/*!40000 ALTER TABLE `products_description` DISABLE KEYS */;
INSERT INTO `products_description` VALUES
(2,3,'zero server 512MB','','',3,'','',''),
(2,5,'zero server 512MB','<p>zero server 512MB zero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MBzero server 512MB</p>','',53,'','',''),
(3,3,'automated','','',55,'','',''),
(3,5,'automated','<p>text</p>','',96,'','',''),
(4,3,'','','',0,'','',''),
(4,5,'izolace ne cloud','','',0,'','',''),
(28,5,'# kocour','<h1>kocour</h1>\n\n<h2>verze3</h2>\n\n<p>kocour je velky a tlusty.</p>',NULL,0,NULL,NULL,NULL),
(29,5,'# Mame maso, Emu, Mardown','<h1>Mame maso, Emu, Mardown</h1>\n\n<h2>podtitulek</h2>\n\n<p>je to prvni hura text.pejse v milicine\nprochazeli se o hodinu pozdeji</p>\n\n<p>vrana</p>',NULL,0,NULL,NULL,NULL),
(30,5,'# kocour','<h1>kocour</h1>\n\n<h2>verze3</h2>\n\n<p>kocour je velky a tlusty.\na zeleny</p>',NULL,0,NULL,NULL,NULL),
(31,5,'# Mame maso, Emu, Mardown','<h1>Mame maso, Emu, Mardown</h1>\n\n<h2>podtitulek</h2>\n\n<p>je to prvni hura text.pejse v milicine\nprochazeli se o hodinu pozdeji</p>\n\n<p>vrana k vrane seda</p>',NULL,0,NULL,NULL,NULL),
(32,5,'# kocour','<h1>kocour</h1>\n\n<h2>verze3</h2>\n\n<p>kocour je velky a tlusty.\na zeleny</p>',NULL,0,NULL,NULL,NULL),
(33,5,'# Mame maso, Emu, Mardown','<h1>Mame maso, Emu, Mardown</h1>\n\n<h2>podtitulek</h2>\n\n<p>je to prvni hura text.pejse v milicine\nprochazeli se o hodinu pozdeji</p>\n\n<p>vrana k vrane seda</p>',NULL,0,NULL,NULL,NULL),
(34,5,'AiBezpecnostJsouToVaseData.md','<h2>AiBezpecnostJsouToVaseData.md</h2>\n\n<p>ai data jsou to nejcennejší\ndtabáze AI musí být schovaná za datovu diodou</p>\n\n<p>AI server\n* datovou diodou přijímá \n  * interní data o návštěvnosti a prodejích\n  * externí data ze: \n    * sledování konkurence\n    * analýzy médií a vyhleávačů\n* provede inserty\n* ddatovou didodou posílá v pravdielném intervalu v textové podbě pole hodnot pro karmu výrobků</p>\n\n<h2>analýza médií</h2>\n\n<p>Příkad: umře herečka - reindexujeme</p>',NULL,0,NULL,NULL,NULL),
(35,5,'osc AI commmand line interface','<p>osc AI commmand line interface</p>\n\n<h2>OSC configuration</h2>\n\n<p>with pretrained neuron network</p>\n\n<ol>\n<li>reate keys with default values</li>\n<li>updating <em>configurable</em> values again vith default values and additional keywords creates commands database</li>\n<li>adding <em>selected</em> flag to </li>\n</ol>',NULL,0,NULL,NULL,NULL),
(36,5,'# Ai v designu','<h1>Ai v designu</h1>\n\n<p>https://www.lupa.cz/clanky/andrew-doherty-simby-digitalni-produkty-musi-zacit-reagovat-na-emoce-lidi/</p>\n\n<p>Webová aplikace budoucnosti reaguje na chování uživatele, třeba tak, že mu ve vhodnou chvíli \nposkytne kontextovou nápovědu, nebo vycítí emoční rozpoložení uživatele.</p>',NULL,0,NULL,NULL,NULL),
(37,5,'# energetická náročnost AI jako nový problém a výzva pro životní prostředí','<h1>energetická náročnost AI jako nový problém a výzva pro životní prostředí</h1>\n\n<h2>Energeticky efektivně</h2>\n\n<p>Aplikace jako vyhledávač nepotřebují pro část dotazů AI, protože výsledek je daný formálně logickým, energeticky efektivním a rychlým matematickým algoritmem. \nTeprve ve chvíli, kdy výsledek vyhledávání nelze matematicky formalizovat, teprve nyní má smysl se dotazovat orákula.</p>\n\n<p>podíl rychlých a pomalých výpočtů\npomalé výpočty je možé kešovat</p>\n\n<h2>výhoda AI: tréning dítěte lze</h2>\n\n<p>energeticky náročné výpočty lze provádět v době a v místě s přebytkem elektrické enerugei v síti</p>',NULL,0,NULL,NULL,NULL),
(38,5,'## fáze jsou důležité','<h2>fáze jsou důležité</h2>\n\n<ul>\n<li>učení AI</li>\n<li>regexp přiřazování</li>\n<li>věštění s pomocí AI\n<h2>fáze učení je nová, je to betarežim, kdy se AI učí rozumět dotazům. Prosím ptexjte se mně, budu rychlejší.</h2></li>\n</ul>\n\n<h2>první fáze implementace</h2>\n\n<p>máme k dispozici nedokonalý vývojový modul, který komunikuje s AI tui v příkazové řádce.\nprvní odpověď je kešovaná v MYSQL, chvíli později dorazí odpověď od instance\n... tý umělý inteligence, odpověď je pomalá, přibude</p>',NULL,0,NULL,NULL,NULL),
(39,5,'# umělá inteligence','<h1>umělá inteligence</h1>\n\n<h2>doporučené produkty</h2>\n\n<p>Automatické generování doporučených produktů na základě vyhodnocování těchto \nfaktorů:\n* minulé prodeje poldele denní/roční doby\n* populatita klíčového slova ve vlastním vyhledávání\n* návštěvnost stránky produktu v poslední době\n* popularita produktu na vyhledávačích</p>\n\n<h2>změna vzhledu webu podle denní/roční doby</h2>\n\n<p>jako je ranní a večerní rága, tak by mělo weboové prodtředí reagovat na odlišné \nsvětelné podmínky a emoce v nich</p>\n\n<h2>empatie</h2>',NULL,0,NULL,NULL,NULL),
(40,5,'Adam','<p>Adam</p>\n\n<p>Adam je náš virtuální samoučící robot, trénovaný na dvou mužských a jednom ženském nodu</p>',NULL,0,NULL,NULL,NULL),
(42,5,'administrace webové aplikace bývá webová aplikace.','<p>administrace webové aplikace bývá webová aplikace.\npro krizové řízení a maximální efektivitu administrátorů existuje daleko efektivnější cesta: pracovat přímo naserveru s databází eshopu pomocí textového rozhraní.</p>',NULL,0,NULL,NULL,NULL),
(43,5,'extrémně rcyhlé TUI pro nejvyšší produktivitu ','<p>extrémně rcyhlé TUI pro nejvyšší produktivitu \npráce operátorů.</p>\n\n<p>zavolám mcfly s dotazem</p>\n\n<p>uložím výsledek dotazu do souboru FILE pomocí --output-selection</p>\n\n<p>ve druhém okně se periodicky testuje obsah FILE a je \nzobrazen její obsah.</p>',NULL,0,NULL,NULL,NULL),
(44,5,'při uložení objednávky vkládáme do mcfly:','<p>při uložení objednávky vkládáme do mcfly:</p>\n\n<p>KEY<em>AP 15 254\n  KEY</em>AP 33 2223</p>\n\n<p>čísla reprezentují dvojice v pořadí, v jakém byly produkty přidány do košíku.</p>',NULL,0,NULL,NULL,NULL),
(45,5,'#fotomnobil vydrz baterie','<h1>fotomnobil vydrz baterie</h1>\n\n<p>kravina</p>',NULL,0,NULL,NULL,NULL),
(46,5,'Objednávky se musí ukládat u když není databáze','<p>Objednávky se musí ukládat u když není databáze</p>',NULL,0,NULL,NULL,NULL),
(47,5,'jednoducha sazba se slevou ','<p>jednoducha sazba se slevou </p>',NULL,0,NULL,NULL,NULL),
(48,5,'ve chvíli, kdy uchovánáme další ohromné množství informací o chvání našich uživatelů, musíme anonymizovat. ','<p>ve chvíli, kdy uchovánáme další ohromné množství informací o chvání našich uživatelů, musíme anonymizovat. \núroveň anonymizace je možné zvýšit tím, že v anonymní databázi neuchováváme </p>',NULL,0,NULL,NULL,NULL),
(49,5,'','<p>Jedná se o neznalost, nebo o vědomé zkreslování reality v zájmu jisté skupiny \ndodavatelů?\nze studie APEK se dozvídáme, že tím nejméně kvalitním řešením je open source software, \no něco kvalitnější je krabicové řešení a tap nabídku představuje vývoj na míru.</p>\n\n<p>nechci spekulovat o tom, že by studie představoval záměrné zkreslení v zájmu nějakého \nhráče české eCOmmerce, ale reflektuje naprostou regionální deformaci malého českého \ne-commerce rybníčku.</p>\n\n<p>ve světovém platí, že se dnes prakticky každé profesionální řešení staví na OSS \nplatformě, ta je však důkladně a upravena a optimalizována pro potřeby daného eshopu.\nIgnorovat, že na platformě Magento , PrestaShop a osCommerce\nhttps://www.mageworx.com/blog/top-world-brands-on-magento/\nhttps://onilab.com/blog/companies-using-magento-biggest-magento-sites/\nhttps://divante.com/blog/top-50-global-businesses-developed-on-the-magento-ecommerce-platform/\nforrd, coca, cola, swatch, adidas, </p>\n\n<p>že je oss amatérské řešení? nedostatečné zabepečení?</p>\n\n<p>je leší postavit eshop na zákaldu, který používají desítky tisíc firem a nebo si nechat \nnaprogramovat kolo zcela znovu? interním týmem an beo pseudoprofesionální agenturou, \nkterá vytvořila několik desítek shopů střední velikosti? a nebo postavit svůj eshop na \nřešení, které prověřily sovky miliónů uživatelů a které se musely vyrovnat s desítkami \ntisíc hackerských útoků?</p>\n\n<p>založme asociaci implementátorů oss eshopů, protože asociace pro elektronickou komerci \nje pravděpodoběn  lobistická organizace, zastupojící zájmy pocybných čských firem, \nvelkých ráčů čeké e-commerce, kteří </p>',NULL,0,NULL,NULL,NULL),
(50,5,'# also purchased relevance','<h1>also purchased relevance</h1>\n\n<p>order ap by relevance = pocet shod</p>\n\n<p>table ap<em>relevance\nproducts</em>id,\nap<em>products</em>id,\nap_count</p>\n\n<p>products<em>id = vybrany produkt\nap</em>products<em>id = srovnavany produkt,\nap</em>count = pocet</p>\n\n<p>timeframe = čím krastší časové období, tím vyšší bude relevance: sezóna, módní trendy\npokud ale bude období příliš krátké, nenajdou se odpopovídající společně nakoupené produkty</p>\n\n<h2>nejčastější absolutní shoda</h2>\n\n<pre><code>ORDER BY ap_count DESC\n</code></pre>\n\n<h2>poslední shoda</h2>\n\n<pre><code>order by date_urchassed\n</code></pre>',NULL,0,NULL,NULL,NULL),
(51,5,'','<h2>c library webtoolkit + mnogosearch indexed with mcfly</h2>',NULL,0,NULL,NULL,NULL),
(52,5,'jak osetrit, treab povinnym kusem kodu? ze ten soubotr co se objevi v hook sje legitimni. ulkadat ','<p>jak osetrit, treab povinnym kusem kodu? ze ten soubotr co se objevi v hook sje legitimni. ulkadat \nsi kontrloni sucty urcite?</p>',NULL,0,NULL,NULL,NULL),
(53,5,'Cílem nnašho snažení je automatizace','<p>Cílem nnašho snažení je automatizace\nkaždá struktura má tendenci samovolně zvyšovat svoji komplexitu\nkaždá struktura má tendenci samovolně zmožovat monožství tzv. Single Point Of Failure.\nRedukce komplexity a hardwarová izolace procesů, jsme posedlí robustností.\nCo je to jedinečný bod selhání? Typický LAMP eshop funguje ve chvíli, kdy má k dispozici fungující webserver, php engine a neustále dostupnou MySQL databázi.</p>',NULL,0,NULL,NULL,NULL),
(54,5,'Jako jediný dodavatel nabízíme garanci postkvantové bezpečnosti šifrování ','<p>Jako jediný dodavatel nabízíme garanci postkvantové bezpečnosti šifrování </p>\n\n<p>po celou dobu jsou citlivé údaje šifrovány</p>',NULL,0,NULL,NULL,NULL),
(55,5,'Karma produktu se počítá z historických dat výsledků vyhledávání a nákupů','<p>Karma produktu se počítá z historických dat výsledků vyhledávání a nákupů</p>\n\n<h2>rychlost vs. přesnost</h2>\n\n<p>databáze se neustále zvětšuje a s tím náročnost výpočtu karmy</p>\n\n<h2>časový práh</h2>\n\n<p>stará data se hromadí a jejich vypovídací hodnota klesá.\n(if date > treshold) DELETE duplicated events\nuchováváme v databázi poslední nejnovější výskyt\nstačí pouze tento jeden</p>\n\n<h2>časový práh a přesnost vhledávání</h2>\n\n<p>problém přeučení AI\nproblém našeptávače: omezený počet výsledků\npříliš</p>',NULL,0,NULL,NULL,NULL),
(56,5,'Tohle je fiktivní příběh a vypravěč je zaujatý. je to příběh o strmém úspěchu a strmém pádu, díky ','<p>Tohle je fiktivní příběh a vypravěč je zaujatý. je to příběh o strmém úspěchu a strmém pádu, díky \nšetření na nepravém místě.</p>\n\n<p>Tak ku příkladu prodávám trezory. Všecjny smlouvy mám zamčené ve svém trezoru, ale </p>\n\n<p>Když má někdo trezor, tak to je povánka pro kasaře, když se \ndatabáze zákazníků objeví na pastebin.</p>\n\n<p>ten vypravěč a jeho shop toho moc neslibují, ale </p>\n\n<p>Milý začátečníku,\nVítám tě v klubu \nBarevný svět e-commerce, obchodování na internetu, do kterého radostně vstupuješ je místo, kde \nmůžeš pohádkově rychle zbohatnot, ale taky přes noc přijít o všechno.</p>\n\n<p>Tvoje schopnost prodávat stojí na robustnosti tvojí technologie dokázat prodávat za jakýchkoli \nmysiltených obtíží a katastrofických scénářů. </p>\n\n<p>tvůj obchod může v jedné noci přijít o bšechny zákazníky, pokud bude ohrožena jejich důvěra.</p>\n\n<p>tvoje kivity mohou být monitorovány a ty pomalu vykrvácíš, také díky útoku.</p>\n\n<p>tohle všechno tě ale nečeka dřív, než budeš mít úspěch.</p>\n\n<p>Tvůj obchod na je ale vitálně ohrožen především dopadem bezpečnostních incidentů.\nto je minové pole, do kterého vstupuješ a všude jen \nslyšíš, jak je to vše snadné.</p>\n\n<p>Ale mezi těmi hlasy, které Ti slibují pohádkový úspěch jen občas pronikne do Tvé pozornosti nějaký \nwarning. V e-commmerci ja extrémní konkurence a ti chlapci se neštítí ničeho.</p>',NULL,0,NULL,NULL,NULL),
(57,5,'Na webech, které pravidelně čtu, repurrtuju bugy v přístupnosti a musím říci, že ','<p>Na webech, které pravidelně čtu, repurrtuju bugy v přístupnosti a musím říci, že \nvětšinou nechápu, což byl i případ Petra Krčmáře, šífredaktora Root.cz. \nNedávno jsme se rozhodl na serverec Iinfo inzerovat a tak jsme se zmínil o ptom, že v \ntectových kientech jjeich weby posílají naorsrto zmatenou hlavičku title, kvůli jejich \ntreklamnímu systému. K mému překvapení (po předchozích zkušenostech) jsem se dočkal \ntoho, že vývojáři chybu opravili.\nco je to w3m a proč ho používám.\nTechnický popis....\nPoučení: Dávejte si pozor na reklamní systémy, mohou vám zavařit v SEO.</p>\n\n<p>Podobně jsem nedávno reporoval na Seznamu, že jeich Home Page není optialiovaná pro \nIphone SE.</p>',NULL,0,NULL,NULL,NULL),
(58,5,'bacha na google translate!','<p>bacha na google translate!\npreklada cast emailove adresy pred zavinacem, domenu ale necha na pokoji....</p>\n\n<p>If you are interested in renting a hall, please fill in the contact form, write to rentmy@obecnidum.cz, or call 222 ....</p>\n\n<p>rentmy@obecnidum.cz</p>',NULL,0,NULL,NULL,NULL),
(59,5,'hesla','<h1>hesla</h1>\n\n<p>Různí chytráci jako pan Krčmář stále mlví o tom, že hesla jsou passé.\nAle ve skutečnosti helso je to nejsssspolehlivější co máme. Někdo nás mlž edonutit, \nabychom pohlédli do svého mobilu nebo nám přitlačí prst na čtečku otisků prstů, nbo \ntaky když si myjeme ruce kvůli koronaviru, tak se nám setřeo bříška prstů a my \nse najednou nemůžeme přihásit otiskem prstu.</p>\n\n<p>máme správce hesel, ale ten si dáváme na coudovou službu a to heslo ke správci hesel je \ntriviálí. Máme autentifikátor\nheslo je něco jednoduchého, ale většina z nás si nedokáže cokloi zapamatovat. Ale jako \njsme se učili slovíčk v cizím jazyce a psali si je do sešítku, takk si musíme vědomě \nuložit do paměti hesla. Ale my si nemusíme pmatovat hesla samotná, stačí si pamatovat \nbásničku a použít první písmena z jeích slov: \nkočka leze dírou pes oknem\nnebude=li pršet nezmoknem\na mám pěkné heslo: kldponlpn</p>',NULL,0,NULL,NULL,NULL),
(61,5,'# GDPR a soustředění na osobní data jako příležitost a hrozba','<h1>GDPR a soustředění na osobní data jako příležitost a hrozba</h1>\n\n<p>GDPR je jenom začátek, přichází e-privacy.</p>\n\n<p>umělá inteligence možná zruší problém s ochranou soukromí u cílené reklamy: behaviorální techniky AI nepotřebují párovat </p>',NULL,0,NULL,NULL,NULL),
(62,5,'4a','<p>4a</p>',NULL,0,NULL,NULL,NULL),
(63,5,'I. hosting','<p>I. hosting</p>\n\n<h3>dostupnost katalogu: 99,9999</h3>\n\n<h3>průměrná rychlost načtení statického produktu: 2,4 sec.</h3>\n\n<h3>garantovaná rychlost načtení statického produktu: 5 sec.</h3>\n\n<h3>dostupnost eshopu: 99,9</h3>',NULL,0,NULL,NULL,NULL),
(64,5,'základní software je zdarma open-source','<p>základní software je zdarma open-source\nkaždý zákaník má přístup ke všem hotovým modulům\núčtujeme individuální úpravy osCommerce, u komplexních a složitých modulů preferujem crofundingovou kampaň</p>\n\n<p>rozlišujeme úroveň technické podpory:\n* komunitní\n* biznys\n* VIP</p>\n\n<p>zákazník si dále volí úroveň hostingu:\n* ponuze na našem cloudu se zálohováním\n* load balancer virtuální náš cloud + amazon\n* profi vyhrazený server na forpsi + náš cloud + amazon\n* zákaznický dedikovaný server na klíč + amazon cloud\n* správa eshopu na zákazníkově infrastrktuře</p>',NULL,0,NULL,NULL,NULL),
(65,5,'','<p>konfigurce v teminálu s umělou inteligencí\nmáte pomalý web?\n1. mate pomaly server, to ted neresime\na je to velký problém\n1. neúsporný css stylopis je menší průser, ale léčí se obtížněji. Menší průser je to proto, že se načítá jen při prvním načtení stránky na daném začízení a větší problém je v tom, že to znamená stylopis kompletně přepsat do abskraktní podoby. protože rychle prototypujeme v bootstrapu a pak je optimalizujeme.</p>',NULL,0,NULL,NULL,NULL),
(66,5,'','<p>Postřehy z bezpečnosti: reálné chyby virtuálního prostředí:\nhttps://www.root.cz/clanky/postrehy-z-bezpecnosti-realne-chyby-virtualniho-prostredi/</p>',NULL,0,NULL,NULL,NULL),
(67,5,'','<p>Komise strojů</p>',NULL,0,NULL,NULL,NULL),
(68,5,'','<p>https://www.lupa.cz/aktuality/google-predstavil-novou-nahradu-cookies-topics-maji-vystridat-drive-planovany-floc/1165120/?_fid=efw6</p>\n\n<p>Cookie lištu vůbec nepotřebujete, protože pro použití technických cookies GDPR nevyžaduje souhlas. Reklamní kampaně můžete vyhodnocovat z logu webserveru.\nViz moje vyjádření v článku na Podnikateli, v odstavci Výjimkou jsou technické cookies: https://www.podnikatel.cz/clanky/od-ledna-plati-nove-povinnosti-u-cookies-listy-na-co-si-musite-dat-pozor/</p>\n\n<p>Ano, cookie lištu potřebujete pro retargeting, ale dovolil bych si pochybovat o tom, že to funguje, tím spíš, jak říkáte, že jsou z toho neznalí uživatelé zmatení. Vůbec mi nevadí, když třeba na Lupě vidím jen kontextovou reklamu na servery a stává se, že na ní skutečně kliknu, zatímco když na mně juknou tenisky, které jsem si prohlížel před týdnem v eshopu, řeknu si, zatracený eshop, tak to je fakt drzost se mi vnucovat na Lupě. Psal jsem si o tom před časem s panem Krčmářem z Rootu, že chápu upoutávky na Lupu, ale když na odborném linuxovém serveru uvidím upoutávku na článek o biopotravinách z Vitalie, je opravdu minimální šance, že na ní kliknu.</p>\n\n<p>Neschváleno?</p>\n\n<p>Stačí nainstalovat Matomo, umí prakticky všechno co GA. Stáhnout, rozbalit, nakonfigurovat pomocí wizardu. (https://builds.matomo.org/matomo.zip).</p>\n\n<p>A ten retargeting, ok, pro zpravodajský web, který žije z reklamy, asi chápu že ano, ale s většinou svých zákazníků se shodnu na tom, že za ten opruz s cookie lištou event s úřady to nestojí a taky nemáme moc rádi tu firmu Google a co je jí do naší návštěvnosti. Ale já dělám hlavně pro státní sektor a intelektuální nakladatele.</p>',NULL,0,NULL,NULL,NULL),
(69,5,'sofistikovanost v jednoduchosti. Design je následek funkčnosti, je to odhalená funkcionalistiká ','<p>sofistikovanost v jednoduchosti. Design je následek funkčnosti, je to odhalená funkcionalistiká \nkostra.</p>\n\n<p>v prvním paketu musí být jádro informace, celá stránka. Zbytek je ajax a ccs, načítá se následně, \nnikoli asynchroně. Nejpreve </p>\n\n<p>technolaogie existuje, lazyload </p>\n\n<p>a nebo cla stranka v tmy a jde o rychlý rendering \njaždý objekt je ID position absolute stránka nemusí nic počítat.</p>',NULL,0,NULL,NULL,NULL),
(70,5,'','<h1>crypto-engine components</h1>\n\n<ul>\n<li>data diode</li>\n</ul>',NULL,0,NULL,NULL,NULL),
(71,5,'Back to (2015) first version with new priorities list:','<p>Back to (2015) first version with new priorities list:\n* pure shell script with minimal dependencies\n* readable</p>',NULL,0,NULL,NULL,NULL),
(72,5,'mobile first je skvělé řešení, pokud zoufale nemáte peníze a invenci. Určitě to bude fungovat, ale','<p>mobile first je skvělé řešení, pokud zoufale nemáte peníze a invenci. Určitě to bude fungovat, ale\ntyhle weby vypadají jeden jako druhý.</p>\n\n<p>mobile first je lhelem doby, rotže jsou gefici-vývojáři zaskočeni tím požadavkem na gumovost \ndesignu</p>\n\n<p>Mobuilní revoluce nepředstavuje pro dektopovou invenic naprosto žádný problém, je to pouze o \nschopnosti nastavovat breakpointy.. a ty přizpůsobovat pro převažující rozlišení aniž bychom \ndiskrimonovali.</p>',NULL,0,NULL,NULL,NULL),
(73,5,'postup:','<p>postup:</p>\n\n<ol>\n<li>botstrap v admin-frontendu</li>\n<li>genrovani bootstrapu sass/less jen potrebne komponenty</li>\n<li>pure-botstrap-generator mimifikuje: a) nazvy tagu v html a v css</li>\n<li>kazda stranka ma b.css a products_info.css zaklad+special pro sablonu\nvysledek: mininimum vlstniho kodu, jen omrdame bootstrap</li>\n</ol>\n\n<p>a cele se to nacita az pote, co je v prvnich dvou paketech bepecne zobrazena html stranka,s \nminimalnimi styly.</p>',NULL,0,NULL,NULL,NULL),
(74,5,'full version:','<p>full version:\nhttps://www.lupa.cz/clanky/co-neni-online-to-hacker-nenajde-goldilock-na-zabezpeceni-pomoci-fyzickeho-air-gapu-vybral-dalsi-milion-dolaru/nazory/1156890/?_fid=pzdi</p>\n\n<p>Takhle to píše kolega a já zkouším jednodušší variantu, kdy se datovou diodou pošle autentizační požadavek a cryptoserver vrátí druhou datovou diodou OTP pásku, která se lokálně bezpečně uloží po dobu platnosti session. Tohle by mělo fungovat i na pomalé dd vytvořené přes audio nebo sériový port, protože se pásk apošl ljednou na začátku komunikace. </p>\n\n<p>No a na to, abych bezpečně předal novou pásku uživateli, se snažím upravit kazetový magnetofon přidáním mazací hlavy. Fyzická podoba uložení informace na lineárním kontrolvatelném médu mi dá jistotu, že pásku nikdo přede mnou nečetl.</p>',NULL,0,NULL,NULL,NULL),
(75,5,'na rpi 0','<p>na rpi 0</p>',NULL,0,NULL,NULL,NULL),
(76,5,'defaultni chvani shopu se nastavuje:','<p>defaultni chvani shopu se nastavuje:\nod exstremu do extremu</p>\n\n<p>a) RR car\nchci objednavku, povinne udaje nemusi byt kompletni, dulezite ze zakaznik podepsal ze zaplati \nzalohu 100.000 liber</p>\n\n<p>b) rohlíky\nchi perkne vyplnenou objednavku, musi to jit automaticky, nepustim ted al, dokud to nepochopis</p>',NULL,0,NULL,NULL,NULL),
(78,5,'*Stáhli jsme si z vašich serverů kopie zdrojových kódů pro Cyberpunk 2077, Zaklínače 3, *','<p><em>Stáhli jsme si z vašich serverů kopie zdrojových kódů pro Cyberpunk 2077, Zaklínače 3, *\n*Gwent a nikdy nevydanou verzi Zaklínače 3. Také jsme si stáhli všechny dokumenty</em>\n<em>o účetnictví, administrativě, právních záležitostech, personalistice nebo vztazích s investory</em>\ndopis hackerů firmě CD Projekt\nhttps://www.idnes.cz/hry/novinky/cd-projekt-hack-hry.A210209<em>144119</em>bw-novinky_srp</p>',NULL,0,NULL,NULL,NULL),
(79,5,'je nase absolutni meta jako dokonalych remesliniku','<p>je nase absolutni meta jako dokonalych remesliniku</p>\n\n<h2>dokonalé obrázky</h2>',NULL,0,NULL,NULL,NULL),
(80,5,'neviditelne znacky dat vsude:','<p>neviditelne znacky dat vsude:\nobrazky, vektory,vsude kde je nejake pozicovani\nfonty taky muzeme upravit\npozicovani lze tezko odhalit, ale diffem jo, ale zase je to skvela moznost, je to neco, co nejde odparat.\nneco co bude blob na js? neco pravdu neviditelnyho, co by zaroven helbalo s pozicemea obejktu....</p>',NULL,0,NULL,NULL,NULL),
(81,5,'','',NULL,0,NULL,NULL,NULL),
(82,5,'','',NULL,0,NULL,NULL,NULL),
(83,5,'spolupráce je náročná na důvěru a vzájemé pochopení.','<p>spolupráce je náročná na důvěru a vzájemé pochopení.\nna začátku my nechápeme váš byznys a vy nechápete technologické možnosti algoritmiace \nv optimálním případě po několika měsících chápeme </p>\n\n<p>v principu jsme schopni pochopit cokoli, v této chvéli máme rosaáhlé zkušenosti s prodejem knih v tištěné i elektronické podobě včetně DRM \na jistou základní orientaci v oborech jako je prodej kosmetiky, uměleckých děl a autodílů.</p>',NULL,0,NULL,NULL,NULL),
(84,5,'## usnadnit nové elektoronické vydání','<h2>usnadnit nové elektoronické vydání</h2>\n\n<ul>\n<li>editace epubu z administrace OSC</li>\n</ul>\n\n<h2>automatické generování vydání</h2>\n\n<ul>\n<li>zkopírovat eknihu </li>\n<li>automaticky přidělit ISBN a upravit vstupní strany a tiráž</li>\n<li>nejen ePub ale i PDF je plně generováno on demmand</li>\n</ul>',NULL,0,NULL,NULL,NULL),
(85,5,'','<h2>130 Ctrl+C</h2>\n\n<p>produkt byl odebrán z košíku. V důsledku toho dostanou všechna zobrazení v rámci uživatelovy session exit code 130 Cancelled.\ntoto byl poslední produkt, který uživatel prohlížel předtím, než odešel z eshopu.</p>\n\n<h2>not found</h2>\n\n<h2>127 not found</h2>\n\n<p>toto jsou neúspěšné výsledky vyledávání</p>\n\n<h2>exit 126</h2>\n\n<h2>exit 126 cannot execute</h2>\n\n<p>ale jinak začínáme 3:</p>\n\n<h2>exit 3 nekoupeno</h2>\n\n<p>aktivní operace maí exit 0, pak spadnou do stavu 3</p>\n\n<h2>exit 6 špatný produkt satan</h2>\n\n<h2>exit 7 budoucí ještě nenaskladněný produkt</h2>\n\n<h2>exit 8 vyprodáno</h2>',NULL,0,NULL,NULL,NULL),
(86,5,'konečné úzké hrdlo databázové aplikace představuje chvíle, kdy je třeba replikovat','<p>konečné úzké hrdlo databázové aplikace představuje chvíle, kdy je třeba replikovat</p>\n\n<p>úsporná objednávka\n* products<em>name > products</em>id\n* address<em>book</em>id NE vypsaná adresa zákazníka</p>\n\n<h1>Podmínky</h1>\n\n<p>tabulka address<em>book je append</em>only</p>',NULL,0,NULL,NULL,NULL),
(87,5,' ','',NULL,0,NULL,NULL,NULL),
(88,5,'Váš eshop mně naštval cookie lištou','<h1>Váš eshop mně naštval cookie lištou</h1>\n\n<p>Dobrý den,\nmáte štěstí, že jsem sháněl xxxxx a váš produkt je natolik jedinečný, že jsem ho \nobjednal, přestože normálně eshopy s cookie lištou opouštím, pokud mi neumožní jedním kliknutím tu věc \nzavřít a dál neotravovat. (tedy pokud dané zboží mohu koupit někde jinde).\nMimochodem, to že bez cookies nelze nakupovat je problém Vašeho eshopu, je pravda, že \nněkteré systémy to neumožňují, ale je potom potřeba, abyste na to upozornili v košíku, \nnapř přesměrováním na chybovou stránku s omluvou a vysvětlením.\nNa prvním screenshotu vidíte, kolik míst ta věc zabírá na iphone, takže bez potvrzení \nnelze nakupovat, i kdybych měl cookies zapnuté a jenom ten, z mého hledika, jak \nzákazníka, arogantní text ignoroval. Vy přece chcete, aby u vás člověk nakoupil bez \nohledu na to, jaký má vztah k cookies a jaký má prohlížeč. Zbytečně přicházíte o \nzákaníky, i kdyby to mělo být 2% návštěvníků.</p>\n\n<p>Pokud byste měli zájem, dělám eshopy, které fungují ve všech prohlížečích bez ohledu na \ncookies a javacript.</p>\n\n<p>srdečně zdraví </p>',NULL,0,NULL,NULL,NULL),
(89,5,'eshopy','<p>eshopy</p>\n\n<p>typické chyby typického eshopu LAMP:</p>\n\n<p>many zero point of failure</p>\n\n<h1>objednávky jsou synchronní</h1>\n\n<p>eshop musí mít schopnost </p>\n\n<p>dosavadní technologie jsou drahé nebo neefektivní. levné řešení vám nedá jistotu</p>',NULL,0,NULL,NULL,NULL),
(90,5,'#Externí vyhledávač','<h1>Externí vyhledávač</h1>\n\n<p>klíčová slova našeho produktu, například knihy, je třeba průběžně a nekonečně obohacovat, podle toho, jak přibývá kontext.</p>',NULL,0,NULL,NULL,NULL),
(92,5,'features - sklad','<h2>features - sklad</h2>\n\n<p>online kontrola skladové dostupnosti v celém nákupním procesu</p>\n\n<p>Problém: </p>\n\n<p>Řešení: modul PureStockCheck testuje skladovou dostupnost až do posledn9ho okam6iku p5ed odesl8n9m \nobjedn8vky. okamžiku </p>\n\n<p>Nevýhody: \nvysoká databázovvá noročnost, proto lze deaktivovat tam, kde není nutné reálnou \ndostupnost sledovat.</p>',NULL,0,NULL,NULL,NULL),
(93,5,'priority:','<p>priority:</p>\n\n<h2>I.  bezpečnost</h2>\n\n<p>Bezpečnost je podmínka sine qua non, protože následky bezpečnostních incidentů jsou řádově vážnější než ve všech ostatních případech.\n* šifrování\n* row level</p>\n\n<h2>II. ostatní</h2>\n\n<h3>provozní náklady</h3>\n\n<p>Naše technologie průběžně otimalizujeme pro maximální efektivitu: snažíme se šetřit každý přenesený bajt a každou operaci procesoru. \nDíky tomu minimalizujeme náklady na </p>\n\n<p>Provozovatelé se obvykle snaží minimalizovat náklady na implmentaci a vůbec nesledují náklady na získání jednoho zákazníka.\nZejména u malých projektů je obvyklé, že prioritiu při implementaci je její jednoduchost: používají se hotové knihovny a cloudové služby placené pe usage, \ncož ale v případě úspěchu eshopu vede k nekontrolovatelnému růstu nákladů.</p>\n\n<p>Naším cílem je vybudovat mezinárodní značku důvěryhodné a spolehlivé eshopové\nplatformy. \nDůvěryhodné pro zákazníky i provozovatele v tom smyslu, že budou znáty její \nfungování a platforma nikdy nedopustí leak citlivých dat a zároveň platformu \nterá získá důvěru zákaníků, v tom, že budou vědět, že platforma v anonymním režimu \nnesbírá o návštěvnících citlivá data a že veškeré funkce umělé inteligenece jsou \nvolitelné zde fungjí na rincipu opt-in a jsou \nprimárně určeny jao volitelná a privátní služba zákazníkům</p>',NULL,0,NULL,NULL,NULL),
(94,5,'## design','<h2>design</h2>\n\n<p>Table má definvanou šíku v HTML na procenta z celku obrazovky. Css pravidal jsou dodatečná a zajití, že maxcimální šířka tabulky bude 980px a při mašířce okana menší než 760px tabulka zmizí a jednotlivé buňky se promění v divy, vertikálně zarovnané.\nHTML je kostra, Css šaty, javascript líčení modelky.\nves větš koster muí fungovat kostra, ve světě modelek musí být líčení perfektní. Zanadbat každou zmodalit se nevyplácí.\nves větš koster muí fungovat kostra, ve světě modelek musí být líčení perfektní. Zanadbat ktrroukoli zmodalit se nevyplácí.</p>\n\n<p>čím rychlejší stránky, tám spokoljenější majitel serveru (menší traffic) a tím spokojenější uzivatel (rcyhlejší web). většina HTML tagů je nepovinných, prohlížeč si je doplní sám. Head, body, html a odpovídající uzavírající tagy jsou balast. stejný blast jsou uzavírajíc tagy seznamů.</p>\n\n<p>Obsah je v HTML, tak, aby opravdu každý nakoupil.\nCss představuje přizpůsobení pro malá zařízení zrušením tabuky: td display:block\ntento jediný příkaz promění HTML dvousloupcový laoyout pro any browser na mobile-first.</p>\n\n<h2>ale proč teda externě?</h2>\n\n<p>protože nesémantický popis je nnáročnější a protože to samé css použijeme přítěš a my se prostě hezně snažíme,, aby celková velikost stránky nepřesáhna jedne paket.</p>\n\n<h2>jde do meníčka</h2>\n\n<p>co to znamená? otevře se ajax a načte json, ve kterém jsou pouze názvy podkateorií. To se jako obejdete bez URL?</p>\n\n<h2>To se jako obejdete bez URL?</h2>\n\n<p>ano, my si je vyparsujeme z textového popisu.</p>\n\n<h2>a všechyo ahref, ul, li, to sde dělá v javascriptu?</h2>\n\n<p>ano, ale všude je textový fallback, jako když je vžd k dispozici manuální řízení auta, když elektonmika nepracuje.</p>',NULL,0,NULL,NULL,NULL),
(95,5,'# poznámky k financování, na základě stesků gundla na lupě','<h1>poznámky k financování, na základě stesků gundla na lupě</h1>\n\n<ul>\n<li>je dobré mít <strong>produkt</strong> </li>\n</ul>',NULL,0,NULL,NULL,NULL),
(96,5,'A co jste schopni ','<p>A co jste schopni </p>\n\n<p>SEO</p>\n\n<p>AI</p>\n\n<ul>\n<li>API přepravních služeb</li>\n</ul>\n\n<p>komplexní řešení pro nakladatele:\n* SEO redakční systém s pohodlným importem recení a ukázek\n* V redakčním systému uveřejníte annotaci nového bestselleru\n* sledujete \n#</p>\n\n<h2>prodej tištěných knih</h2>\n\n<h2>prodej eknih</h2>\n\n<ul>\n<li>API přepravních služeb</li>\n</ul>\n\n<p>nakladatel může maximálně profitovat z přímého prodeje</p>\n\n<h2>distribuce tištěných knih</h2>\n\n<h2>distribuce e-knih</h2>',NULL,0,NULL,NULL,NULL),
(97,5,'#GDPR, to přřijde na řadu až po úniku dat','<h1>GDPR, to přřijde na řadu až po úniku dat</h1>\n\n<p>základem je tedy, aby nedošlo k úniku dat, pokud k němu dojede, přijde pravděpodobně úřední kontorola GDPR a bude se \ndiskutovat o priměřenosti přijatých opatření, pokud budou uznána jako nepřiměžerná, bude nsloedovat pokuta. Samotný \núnik dat však </p>',NULL,0,NULL,NULL,NULL),
(100,5,'4tu na Google ads doporučení ke koronaviru:','<p>4tu na Google ads doporučení ke koronaviru:\nnahrajte si do počítače důležité kontakty\nprogram screen existuje od roku 1989 a umožňuje efektivně pracovat na vzdáleném serveru...</p>\n\n<p>každá generace obejvuje kolo....</p>',NULL,0,NULL,NULL,NULL),
(102,5,'adobe má 100% trhu (?)','<p>adobe má 100% trhu (?)\nco to obnáší:\nkontrola práv během přihlášení uživatele - zamezit duplicitní\nsleva pro studenty, kteří se zůčastní průzkumu a budou odesílat telemetrická datafg</p>',NULL,0,NULL,NULL,NULL),
(103,5,'Milí přátelé, já jsem Robot Faidros','<p>Milí přátelé, já jsem Robot Faidros\npro intelektualy:jsem uělá inteligence, která si dovolila vyslovit nezávislé orákulum n</p>\n\n<p>![čertík]pro komerci: naučíme vás obsluhhovat si prodejní kanál v podobě vlastního eshopu. tak abyste na něm ydělávali bez \nreklamy. Naučíme vás špinavé SEO triky, které </p>\n\n<p>Pokud budete požadovat hackerský styl ručíme za vaše data, chceme slef hosted řešeníí pro GDPR. </p>\n\n<p>princ lvíšulka, jako každý puberťák z lepší rodiny na našíplanetě Opic</p>\n\n<p>je v době míru zaměstnaný těmito předměty</p>\n\n<p>morální theologie jaderné války.\npraktický cvičení z vedení války technikou genicidy</p>\n\n<p>diplomacie těla, útok na nízké pudy.</p>',NULL,0,NULL,NULL,NULL),
(104,5,'','<p>je nezanedbatelná, a často začínáme svůj virtuální život v iluzi, že náš eshop je něco nehmotného, co se jaksi samo distribuuje po celém světě a to ihned a za pušál, který platím za hosting.</p>\n\n<p>jsou to data, která přenášejí informaci o našem produktu s růnou mírou efektivity.\nPokud nechceme ztratit zákazníky, musíme přidat výkon a platit podle výpočetní kapacity.\nAle přenesená data neeliminujeme.</p>',NULL,0,NULL,NULL,NULL),
(105,5,'','',NULL,0,NULL,NULL,NULL),
(107,5,'naše nabídka jednou větou: děláme tuning open source eshopu osCommerce. ','<p>naše nabídka jednou větou: děláme tuning open source eshopu osCommerce. </p>\n\n<p>Desktop first</p>\n\n<p>Máme sehraný tým tří webových grafiků s 25 letou praxí. Umíme tedy skloubit osobitost daného webu s technickými \nmožnostmi internetu jako média, zejména s ohledem na iphony. Takže si můžete být jisti, že  </p>\n\n<p>Rychlost načítání</p>\n\n<p>podobně jako u automobilového tuningu, první snahou tunera je zvýšit rcyhlost virtuálního auta. Takže osekáváme HTML \nkód a raději píšeme méně úsporný CSS stylopis, přičemž to méně úsporný znamená 5 KB. Naše CSS filosofie je následující: \ni za cenu pomalejšího prvního </p>\n\n<p>Naše UI je postaveno na principu progressive enhancement a zajišťuje 100% přístupnost 1)\nDíky jedinečně robustní architektuře, vedené zásadami gracefull degradation 2) můžeme garantovat uptime s omezenou \nfunkcoionalitou i v případě úspěšného útoku nultého dne.\nRychlost na desktopu pod 500 ms 3) šifrování \ncitlivých dat absolutně neprolomitlenou vernamovou šifrou **), </p>\n\n<p>gracefull degradation</p>\n\n<p>Když jsou naše servery přetížené, nejprve vypneme trénování AI a když je to ještě vážnější, vypneme našeptávač v AI \nvyhledávání. Dokonce i v případě, že dojde k výpadku SQL serveru, zůstává naše tunigová osCommerce funkční.</p>',NULL,0,NULL,NULL,NULL),
(108,5,'','<h2>human readable post-qantum crypptography</h2>',NULL,0,NULL,NULL,NULL),
(109,5,'# TUI hypertext WYSIWYM interface','<h1>TUI hypertext WYSIWYM interface</h1>\n\n<p>Grafické uživatelské rozhraní, které všichni v osmdesátých letech \n20. století považovali za zásadní inovaci proti TUI, se ukázalo \njako slepá cesta, totiž předstírání že počítačové rozhraní je \nmagazín na křídovém papíře. Ale ono je to rozhraní našeho mozku \na my musíme teprve najít optimální funkčnost, přičemž evoluce \nTUI se jeví jako nejnadějnější.</p>\n\n<p>WYSIWYG koncept </p>',NULL,0,NULL,NULL,NULL),
(110,5,'# 100% open source, 100% self-hosted AI powered shop engine ','<h1>100% open source, 100% self-hosted AI powered shop engine</h1>\n\n<h2>based on osCommerce 2x evolution, MySQL row level  mering with mcfly sheell AI</h2>\n\n<h2>kompletně open-source, kompletně self-hosted, rychlá a bezpčená platforma pro distribuci fyzických virtuálních produktů.</h2>\n\n<p>osc+matomo+FlexiBEE+pureCssStatic+PureOTP</p>',NULL,0,NULL,NULL,NULL),
(111,5,'informace/balast','<p>informace/balast\nkolik balstu je třeba na přenesení prostého textu informace</p>\n\n<p>100/300</p>',NULL,0,NULL,NULL,NULL),
(112,5,'inteligence je centrálmí inovace eshopu 2.0','<p>inteligence je centrálmí inovace eshopu 2.0</p>\n\n<p>eshop nulté generace se učil prodávat\neshop první generace umí POUZE prodávat\nesshop druhé genenerace zná svého zákazníka.</p>\n\n<p>AI není nástroj, jak nahnat zákazníky k prodeji, ale naávislá poradní instance</p>\n\n<p>první generace eshopů automatizovala samotný prodej.\ntedy o dotažení konceptu samoobslužného prodeje. Není to skutečná revoluce, pouze pokročilá automatizace samoobsluhy z 50 let 20 století.\nVýsledek: k úspoře došlo, prodavač chybí. Eshop není samoobsluha, tedy ulička, kterou musí zákazník projít.\neshopú je výborné místo pro nakupování robotů.\npokud se rozhodujete podle parametrů a pamatujete si všechny EAN.\nnavíc zásilkovové katalogy na děrných štítcích existují asi 120 let.\neshop to jenom celé automatizuje jako distribuční proces, pouze běh uliččkou nen uličkou ale klíčovými slovy, tedy klíčová slova vyvolávají virtuální místnosti, ve kterých nakupujeme.\nmy jsme jako théseus v labyrintu plnném reklam, které na nás nastražil obchodník.</p>\n\n<p>Ale my chceme, aby náš nákup potravin trval jen 15 sekund. třeba..\nale hlavně každý z nás hledá svou černou labuť.\ndatabáze vypsaná do kategorií je strašně dlouhá ulička, kterou nikdy neprojdmeme. Prodejce si to často naivně myslí.\nkaždý eshop obsahuje poklady, která bych si kouil, pokud bych je v té hromadě zboží objevil.\nčím větší máte shop, tím nepřehlednější je pro klienta katalog, jako bludiště. AI tohle dokáže řešit. Hlasování strojů</p>\n\n<p>chci osobní historii\nnebude zneužita proti mně.</p>\n\n<h2>teprve s AI začíná být eshop zábavný. Protože už začíná záležet, jestli je prodaveč inteligentní.</h2>\n\n<p>eshopy nulté generace někdy fungovaly. Eshopy první genrace fungují, ale uživatel se podřizuje struktuře databáze, tedy pokud doáže cíleně hledat podle parametrů.\nEshop je samoobsluha, kterou projít by obvykle trvalo hodiny.\nv klasickém eshopu chybí kvbalifikovaný prodavač.\npřitom mnoho uživatelů podobně bloudilo, protože nedokážou klást vyhytralé dotazy strašně rcychému a strašně blbému Golemovi.</p>',NULL,0,NULL,NULL,NULL),
(113,5,'pro komerční použit','<p>pro komerční použit</p>\n\n<p>když nezná novou verzi</p>',NULL,0,NULL,NULL,NULL),
(114,5,'','',NULL,0,NULL,NULL,NULL),
(115,5,'Jak s nulovou výchozí znalostí jazyka PHP a minimální znalostí CSS dělat naprosto individuální design','<p>Jak s nulovou výchozí znalostí jazyka PHP a minimální znalostí CSS dělat naprosto individuální design</p>\n\n<p>Tento utorial vychází z naší realizované zakázky: udělat redesign českého zastpupení biokosmetiky DR.Hauschka podle \nněmeckého vzoru, ale pouze jako prezentaci, propojenou s naším eshopem YinYang.cz\nTakže si rozdělíme problém na dílčí úkoly:\n1. instalace CE Phoenix (nová verze osCommerce)\n2. programování\núpravy eshopu tak, aby fungoval pouze jako katalog, který nabízí 3 prodejní kanály:\n* nákup v kamenené prodejně Revoluční\n* přesměrování do českého eshopu yinyang.cz\n* přesměrování do slovenského eshopu yinyang.sk</p>\n\n<p>Phoenix má proti původní osc moduární šablonovací systém detailu produktu, který</p>',NULL,0,NULL,NULL,NULL),
(116,5,'Guru Satrapapa pravil: Spravny web je pro veschny prohlížeče, jinak je to výmuva neschopnosti, ','<p>Guru Satrapapa pravil: Spravny web je pro veschny prohlížeče, jinak je to výmuva neschopnosti, \neventuálně podle netikety arogance. Pro nekompatibilitu existuje dispens, pro </p>',NULL,0,NULL,NULL,NULL),
(117,5,'mcfly + fs','<p>mcfly + fs\nkw se organizují do adresářů jako wiki\nkaždé kw ve svém adresáři je skript, který se vykoná</p>\n\n<p>každé KW je oběkt v mentální mapě\nmap je nekonečné množství a jsou to adresáře, každý s v nořenou kategorií\nfyzikální/barvy/modrý</p>',NULL,0,NULL,NULL,NULL),
(118,5,'GDPR a nástup umělé inteligence vyžaduje refefinici vztahu obchodníka a zákazníka,','<p>GDPR a nástup umělé inteligence vyžaduje refefinici vztahu obchodníka a zákazníka,\nkterý je založený na důvěře, protže online prodej je jedou z oblastí, kde se projeví\nkrize důvěry, vyvolaná skkandálními odhlením volebních manipulací facebooku</p>\n\n<p>PureOSC je bezpečný eshop: kompletní šifrování citlivých údajů unikátním klíčem každého zákazníka a tím\nřeší řadu klíčových požadavků striktně podle GDPR, rychlost, stabilita a nízké nároky na systém jsou bonus. <br />\ntechnicky řečeno: dokud se návštěvník neodhodlá k objednávce,statický katalog\nV typickém dnešném eshopu </p>\n\n<p>a na druhém místě je  důvěra zákazníků. o kterou nechci přijít.</p>\n\n<h2>PureOSC je fork osCommerce 2.3x</h2>\n\n<p>s t2mito rozšířeními:\n* bootstrap responzivní css šablona\n* čeština, ičo, dič\n* GDPR, \n* ROW level security MySQL connector</p>\n\n<p>. OSC je nejstarší živá pen Source\neCommerce platforma,  kteá jako jediná poskytuje cca 1000 klíčových rozšíření eshopu\nzcela zdarma pod licencí GNU/GPL, což vůbec neplatí pro populární platformy jako\nMagento, Prestashop a Woocommerce, kde je obvykle zdarma jen jádro systému a cena \nřešení se výrazně prodražuje nákupem placených doplňků, ktré se instalují několika \nkliknutími. V OSC je ntno editovat zdrojáky. My jsme to udělali za vás a dali jsme \nod své oscommece cca 50 roz[platby kartou][]\nzdrojový kód podle návodu a doufa, že to bude fungovat. P</p>\n\n<p>Proč je šifrování dat v GDPR jako volitelný doplněk administrativních opatření a ne\nnaopak? Byrokracie, no comment. Ale to podstatné je bezpečnost našeho vlastního \nbyznysu, maximum jistoty, že nejsou moje obchodní data odcizena či zneužita a můj \nsystém není ochromen rafinovanou sabotáží. Tohle všechno jsou reálné scénáře \nkonkurenčního boje, pokud se vyskytujete v tržním segmentu ve kterém operují \nstruktury moderního organoizovaného zločinu.</p>\n\n<p>volitelná </p>',NULL,0,NULL,NULL,NULL),
(119,5,'Na to, aby váš eshop zobrazoval novinky a bestselery, nepotřebujete umělou inteligenci.','<p>Na to, aby váš eshop zobrazoval novinky a bestselery, nepotřebujete umělou inteligenci.\nAI systém nám již ale dokáže udělat výpis produktů, který kombinuje oba parametry \na navíc upřednostňuje ve výpisu tzv. černé labutě.</p>\n\n<h1>selected parametr</h1>\n\n<ul>\n<li>slouží pro posílení signálu search query, která vedla k prodeji</li>\n<li>při prodeji posílímvšechna klíčová slova, selected přidám tomu hlavnímu</li>\n</ul>\n\n<h2>černá labuť</h2>\n\n<p>to je produkt, o který prudce stoupl zájem, nebo navinka, \njejíž prodeje překračují očekávání.\nsignlál: neočekávaný zájem\nvýpočet: počet prodejů/návštěv za časovou jednotku stupl o více než N procent.\nzměna trendu: aktuální n. > průměrná návštěvnost &amp;&amp; o hodne</p>\n\n<h3>signál prodeje vs signál návštěvy</h3>\n\n<p>pro každý eshop je nastavení individuální. Jeden prodej představuje N návštěv.</p>\n\n<h2>boost novinek</h2>\n\n<p>přihlášení stávajícího zákazníka: boost všech novinek od mé poslední návštěvy\nanonymní zákazník: boost novinek dle standardní doby expirace novinky.</p>\n\n<h2>modul listing</h2>\n\n<p>generovat N procent novinek a N procent bestselerů a N procent černých labutí</p>\n\n<h2>ai šetří energii</h2>\n\n<ul>\n<li>do statické se generují obecné profily uživatelů,\npersonalizovaná verze se generuje jen tehdy, když chyba překročí hodnotu N</li>\n</ul>\n\n<h1>lematizace</h1>\n\n<p>echo nože|majka  -f  /usr/local/bin/majka.w-lt |sed \'s/:.*//g\'|uniq|wc -l</p>\n\n<h2>špatné výsledky?</h2>\n\n<ul>\n<li>potlačit boostování novinek</li>\n<li>upravit časovou osu</li>\n</ul>\n\n<p>AI našeptávač\nchceme nejlepší výsledky v reálném čase a s omezenou výpočetní kapacitou.\nhalucinace jsou vysloveně nežádoucí. Toto jsou zásadní požadavky na systém, \nv mnoha ohledech protichůdné.</p>\n\n<p>Náš přístup je deterministicko-probabilistický.\n1. omezíme množinu výsledků rychlým SQL dotazem. \nTím omezíme výpočetní náročnost následujícího kroku, zvýšíme přesnost ranku.\n2. vypočítáme AI rank\n3. setřídíme výsledek podle vzdálenosti (proximity search)</p>\n\n<p>k tomu, aby AI v eshopu efektvině fungovala, \nkvalita versus rcyhlost versus akurátnost odpovědi.</p>\n\n<p>Jsou pojmy jao odměna skutečné, nebo naopak nepřípustné abstrakce?</p>\n\n<p>rychlost učení</p>',NULL,0,NULL,NULL,NULL),
(120,5,'#Koncept neutálního vyhledávače','<h1>Koncept neutálního vyhledávače</h1>\n\n<p>Koncept neutrálního vyhledávače\nvětšina konkurenčních systémů se řídí strategií agresivního prodeje.</p>',NULL,0,NULL,NULL,NULL),
(121,5,'většina eshopových platforem distponuje nepřeberným množstvím funkcí, ','<p>většina eshopových platforem distponuje nepřeberným množstvím funkcí, \nv drtivé většině případů vám však nedají uspokoojivou odpověď na tři podstatné otázky:\nbezpečnost, spolehlivost a nízké provozní náklady</p>',NULL,0,NULL,NULL,NULL),
(122,5,'','<p>chcem konkurovat cloudovým službám: tady máte jednoduchý eshop, který hned funguje.\nneProgresivniEvolucni.</p>',NULL,0,NULL,NULL,NULL),
(123,5,'','',NULL,0,NULL,NULL,NULL),
(124,5,'','<p>Anorektická krása je to, co na webu potřebujete\nMilujeme komprimovatelnou krásu</p>',NULL,0,NULL,NULL,NULL),
(125,5,'## kursy oscommerce','<h2>kursy oscommerce</h2>\n\n<h2>administrace oscommmerce-phoenix</h2>\n\n<ul>\n<li>správa objednávek</li>\n</ul>\n\n<h2>disaster recovery</h2>\n\n<ul>\n<li>struktura MySQL databáze oscommerce/phoenix</li>\n<li>struktura pohledů pro zajištění ROw level security</li>\n</ul>\n\n<h2>emergency administrace a  programování hotfixů</h2>\n\n<ul>\n<li>cli administrace admin/bin</li>\n* \n</ul>\n\n<h1>#</h1>',NULL,0,NULL,NULL,NULL),
(126,5,'# kvaltitní ekniha','<h1>kvaltitní ekniha</h1>',NULL,0,NULL,NULL,NULL),
(127,5,'# levná implementace, drahý provoz','<h1>levná implementace, drahý provoz</h1>\n\n<p>eshop si naklikám za pár minut ve frameworku\nne, nemám na mysli vendor-lock cloudových služeb, ale modulárních aplikací. \njskou výborně navržené pro modularitu, nikoli však pro výkon.\njsou to aplikace pro vývojáře, ano, zákazník získá údajmě bonus v bezpečnosti a v aktualizacích atd.\nale to hlvní je výkon, tedy měřitelně vzato, náklady na objednávku.\nJá vím, začínající obchod tohle nejaímá.</p>',NULL,0,NULL,NULL,NULL),
(128,5,'jednoducha sazba se slevou ','<p>jednoducha sazba se slevou </p>',NULL,0,NULL,NULL,NULL),
(129,5,'pouze jeden odkaz, obrazek je pozadi, style je background positon jako u stripe.','<p>pouze jeden odkaz, obrazek je pozadi, style je background positon jako u stripe.\napm nebo jak se ta googli vec jmenuje, je pomale\n15</p>',NULL,0,NULL,NULL,NULL),
(130,5,'Právě programuju šifrování pro OSS eshop osCommerce a řeším to neřešitelné dilema, ','<p>Právě programuju šifrování pro OSS eshop osCommerce a řeším to neřešitelné dilema, \njestli lze uživateli bezpečně nabídnout reset hesla. V této chvíli mám pocit, že pokud \nchci pro každého uživatele šifrovat jeho přihlašovací údaje jeho heslem, je to \nneřešitelné. To znamená, že asi dám uživateli volbu, zdali chce bezpečnější variantu, \nkdy v případě ztráty hesla bude svůj profil muset vyplnit znovu a přijde o historii \nobjednávek a nebo méně bezpečnou varinatu, kdy bude existovat kopie uživatelských údajů \na historie objednávky, zašifrovaná klíčem administrátora.\nA vzhledem k tomu, že ta méně bezpečná varinata znamená, že pokud útočník ovládne \ninterní systém, je šifrováí k ničemu, začínám se přiklánět k varinatě že je lepší, aby \npo resetu hesla přišli dotyční uživatelé o své údaje a historii objednávek.</p>\n\n<p>https://www.lupa.cz/clanky/obelsteni-zamestnanci-uplatek-nebo-selhani-co-zatim-vime-o-hacku-twitteru/</p>',NULL,0,NULL,NULL,NULL),
(131,5,'','<p>https://www.seznamzpravy.cz/clanek/dodavatele-nejluxusnejsich-potravin-prisli-o-odbyt-dovazi-kraby-az-domu-97238</p>\n\n<p>Fakt, že restaurace kvůli bezpečnostním opatřením musely zavřít, dělá vrásky i \ndodavatelům čerstvého zboží. Potvrdila to newyorská společnost Regalis Food, která \nrestauracím dodává ty nejlepší a nejluxusnější produkty – například kaviár, hovězí \nwagyu nebo nejdražší lanýže.</p>\n\n<p>Hlavním zdrojem příjmů pro ni byly ještě před několika týdny zavážky zboží do \nmichelinských restauracích po celém New Yorku. Situace firmy se však během několika \ndnů, kdy vláda přijala opatření proti šíření nového typu koronaviru, radikálně změnila \na společnost se rázem ocitla bez zákazníků.\nPohlreich: Zavřené restaurace? Je to katastrofa, chceme náhrady\n24. 3. 13:00</p>\n\n<p>Vedení Regalis Food ve strachu o přežití podnikání přišlo s řešením. Rozhodlo se \nluxusní produkty alespoň dovážet koncovým zákazníkům přímo ke dveřím jejich domovů. \nZavedení dovozu není sice novinkou v oboru, co je ale unikátní, jsou ceny, za které \nfirma zboží prodává. Zákazník si totiž koupí například prvotřídní hovězí steak nebo \nkraba za velkoobchodní cenu, tedy hodnotu, za jakou by jídlo nakoupila samotná \nrestaurace.</p>\n\n<p>Agentura Bloomberg uvedla příklad: zákazník může pořídit kilogram hovězího wagyu už za \n37 dolarů, což je v přepočtu přibližně 900 korun. Taková cena je oproti maloobchodu \nnebo cenách v restauraci několikanásobně menší. „Zákazníci nejčastěji dělají objednávky \ndo 100 dolarů (2500 korun, pozn. red.). Objednávají si maso, houby, ale také oleje a \nvinné octy,“ informoval zakladatel Regalis Food Ian Purkayastha.\nKdy se otevřou restaurace či automobilky? Vláda má první plány, zmrazí i splácení \npůjček\n29. 3. 12:41</p>\n\n<p>Zároveň sdělil, že Regalis Food denně zpracuje přibližně 50 objednávek. Šéf firmy také \nočekává, že počet objednávek by měl v nejbližších dnech ještě narůst, hned jak spustí \nnové webové stránky, na kterých bude objednávka jednodušší.</p>',NULL,0,NULL,NULL,NULL),
(133,5,'**markdown is a writing subset of html language**','<p><strong>markdown is a writing subset of html language</strong></p>',NULL,0,NULL,NULL,NULL),
(134,5,'neotravujeme uzživale s cookie lištou ','<p>neotravujeme uzživale s cookie lištou \n- analýzu můžeme dělat ve většině případů z logů pomocí serveru matomo\nnaše eshopy jsou přístupné, to znamená nezáleží naprolížečia ni jeho nastavení (odkaz)</p>',NULL,0,NULL,NULL,NULL),
(135,5,'po vložení produktu je vygenerován základní tvar provšechna sémantiká pole (název/kategorie/autor/výrobce/keyword1-n)','<p>po vložení produktu je vygenerován základní tvar provšechna sémantiká pole (název/kategorie/autor/výrobce/keyword1-n)</p>\n\n<p>kategorie</p>\n\n<h3>aktuální kategorie (sloupec \'dir\' v tabulce commands)</h3>\n\n<h3>minulá kategorie (old_dir)</h3>\n\n<p>vyparsujeme si kanonickou kategorii z</p>\n\n<p>teoreticky se zdá, že bude přesnější provést vyhledávání na několik průchodů\nteorii je třeba ověřit, je možné, že jeden fuzzy průchod postačuje\npravděpodobně bude záležet na velikosti databáze: u malé databáze je jeden průchod postačující, u velké nikoli\n1. průchod\npřesná shoda substring products_name</p>\n\n<ol>\n<li><p>průchod\npřesná shoda substring keywords</p></li>\n<li><p>průchod\nfuzzy search title+keywords</p></li>\n</ol>\n\n<p>plnění search:\nhledaná fráze, který vyvolal akci zobrazení se uloží jako error 0\nhledaná fráze, která způsobila objednávku dostane selected\n(první výskyt dostane selected)\nvyužijeme mechanismu search_freq addon Search Tag Cloud</p>\n\n<p>lematizace\nna vstupu dame hledany tvar di porivnuho padu nebo infinitivu\na pak muzem hledat</p>\n\n<h3>syntaxe dotazu:</h3>\n\n<p>mcfly search --old-dir \'kat1\' --dir \'kat2\' \'productsearch multiple keywords --p n\'</p>',NULL,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `products_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `products_images`
--

LOCK TABLES `products_images` WRITE;
/*!40000 ALTER TABLE `products_images` DISABLE KEYS */;
INSERT INTO `products_images` VALUES
(17,226,'pim226-17-2021-senigallia-universita-di-macerata-xxth-meeting-of-the-collegium-politicum-oikos-nomos.-politics-and-economics-in-ancient-thought.jpg','',1),
(18,226,'pim226-18-2021-senigallia-universita-di-macerata-xxth-meeting-of-the-collegium-politicum-oikos-nomos.-politics-and-economics-in-ancient-thought.jpg','',2),
(19,226,'pim226-19-2021-senigallia-universita-di-macerata-xxth-meeting-of-the-collegium-politicum-oikos-nomos.-politics-and-economics-in-ancient-thought.jpg','',3),
(20,226,'pim226-20-2021-senigallia-universita-di-macerata-xxth-meeting-of-the-collegium-politicum-oikos-nomos.-politics-and-economics-in-ancient-thought.jpg','',4),
(21,226,'pim226-21-2021-senigallia-universita-di-macerata-xxth-meeting-of-the-collegium-politicum-oikos-nomos.-politics-and-economics-in-ancient-thought.jpg','',5),
(22,226,'pim226-22-2021-senigallia-universita-di-macerata-xxth-meeting-of-the-collegium-politicum-oikos-nomos.-politics-and-economics-in-ancient-thought.jpg','',6),
(23,226,'pim226-23-2021-senigallia-universita-di-macerata-xxth-meeting-of-the-collegium-politicum-oikos-nomos.-politics-and-economics-in-ancient-thought.jpg','',7),
(24,226,'pim226-24-2021-senigallia-universita-di-macerata-xxth-meeting-of-the-collegium-politicum-oikos-nomos.-politics-and-economics-in-ancient-thought.jpg','',8),
(25,226,'pim226-25-2021-senigallia-universita-di-macerata-xxth-meeting-of-the-collegium-politicum-oikos-nomos.-politics-and-economics-in-ancient-thought.jpg','',9),
(26,226,'pim226-26-2021-senigallia-universita-di-macerata-xxth-meeting-of-the-collegium-politicum-oikos-nomos.-politics-and-economics-in-ancient-thought.jpg','',10),
(27,226,'pim226-27-2021-senigallia-universita-di-macerata-xxth-meeting-of-the-collegium-politicum-oikos-nomos.-politics-and-economics-in-ancient-thought.jpg','',11),
(29,230,'pim230-29-2019-pardubice-university-of-pardubice-xixth-meeting-of-the-collegium-politicum-the-rule-of-people-the-rule-of-law-and-the-role-of-logos-in-the-public-sphere.jpg','',1),
(30,230,'pim230-30-2019-pardubice-university-of-pardubice-xixth-meeting-of-the-collegium-politicum-the-rule-of-people-the-rule-of-law-and-the-role-of-logos-in-the-public-sphere.jpg','',2),
(31,230,'pim230-31-2019-pardubice-university-of-pardubice-xixth-meeting-of-the-collegium-politicum-the-rule-of-people-the-rule-of-law-and-the-role-of-logos-in-the-public-sphere.jpg','',3),
(32,230,'pim230-32-2019-pardubice-university-of-pardubice-xixth-meeting-of-the-collegium-politicum-the-rule-of-people-the-rule-of-law-and-the-role-of-logos-in-the-public-sphere.jpg','',4),
(33,230,'pim230-33-2019-pardubice-university-of-pardubice-xixth-meeting-of-the-collegium-politicum-the-rule-of-people-the-rule-of-law-and-the-role-of-logos-in-the-public-sphere.jpg','',5),
(34,230,'pim230-34-2019-pardubice-university-of-pardubice-xixth-meeting-of-the-collegium-politicum-the-rule-of-people-the-rule-of-law-and-the-role-of-logos-in-the-public-sphere.jpg','',6),
(35,230,'pim230-35-2019-pardubice-university-of-pardubice-xixth-meeting-of-the-collegium-politicum-the-rule-of-people-the-rule-of-law-and-the-role-of-logos-in-the-public-sphere.jpg','',7),
(36,230,'pim230-36-2019-pardubice-university-of-pardubice-xixth-meeting-of-the-collegium-politicum-the-rule-of-people-the-rule-of-law-and-the-role-of-logos-in-the-public-sphere.jpg','',8),
(37,224,'pim224-37-2018-bologna-universita-di-bologna.-xviiith-meeting-of-the-collegium-politicum-god-religion-and-society-in-ancient-thought.jpg','',1),
(38,223,'pim223-38-2017-barcelona-universitat-de-barcelona-universitat-internacional-de-catalunya-xviith-meeting-of-the-collegium-politicum-pain-and-punishment-in-ancient-thought.jpg','',1),
(39,222,'pim222-39-2016-bonn-rheinische-friedrich-wilhelm-universitat-xvith-meeting-of-the-collegium-politicum-universalism-cosmopolitanism-and-the-ius-gentium-in-ancient-political-thought.jpg','',1),
(40,221,'pim221-40-2015-usti-nad-labem--purkyne-university-xvth-meeting-of-the-collegium-politicum-koina-ta-ton-philon.jpg','',1),
(41,232,'pim232-41-next-meeting.jpg','',1);
/*!40000 ALTER TABLE `products_images` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Dumping data for table `products_options`
--

LOCK TABLES `products_options` WRITE;
/*!40000 ALTER TABLE `products_options` DISABLE KEYS */;
INSERT INTO `products_options` VALUES
(1,3,'formát knihy',NULL),
(1,4,'formát knihy',NULL),
(1,5,'formát knihy',NULL);
/*!40000 ALTER TABLE `products_options` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Dumping data for table `products_options_values`
--

LOCK TABLES `products_options_values` WRITE;
/*!40000 ALTER TABLE `products_options_values` DISABLE KEYS */;
INSERT INTO `products_options_values` VALUES
(1,3,'Tištěná',NULL),
(1,4,'Tištěná',NULL),
(1,5,'Tištěná',NULL),
(2,3,'PDF',NULL),
(2,4,'PDF',NULL),
(2,5,'PDF',NULL),
(3,3,'ePub',NULL),
(3,4,'ePub',NULL),
(3,5,'ePub',NULL);
/*!40000 ALTER TABLE `products_options_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `products_related_products`
--

LOCK TABLES `products_related_products` WRITE;
/*!40000 ALTER TABLE `products_related_products` DISABLE KEYS */;
INSERT INTO `products_related_products` VALUES
(1,175,164,0),
(2,164,175,0);
/*!40000 ALTER TABLE `products_related_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `products_to_categories`
--

LOCK TABLES `products_to_categories` WRITE;
/*!40000 ALTER TABLE `products_to_categories` DISABLE KEYS */;
INSERT INTO `products_to_categories` VALUES
(2,7,1,0),
(3,7,1,0),
(4,19,1,0),
(9,19,1,0),
(10,19,1,0),
(15,19,1,0),
(16,19,1,0),
(17,19,1,0),
(18,19,1,0),
(19,19,1,0),
(28,19,1,0),
(29,19,1,0),
(30,19,1,0),
(31,19,1,0),
(32,19,1,0),
(33,19,1,0),
(136,19,1,0),
(137,19,1,0),
(138,19,1,0),
(206,23,1,0),
(207,23,1,0),
(208,23,1,0),
(209,23,1,0),
(210,23,1,0),
(211,23,1,0),
(212,23,1,0),
(213,23,1,0),
(214,23,1,0),
(215,23,1,0),
(216,23,1,0),
(217,23,1,0),
(218,23,1,0),
(219,23,1,0),
(220,23,1,0),
(221,23,1,0),
(222,23,1,0),
(223,23,1,0),
(224,23,1,0),
(226,23,1,0),
(227,24,1,0),
(230,23,1,0),
(232,23,1,0),
(233,23,1,0);
/*!40000 ALTER TABLE `products_to_categories` ENABLE KEYS */;
UNLOCK TABLES;
