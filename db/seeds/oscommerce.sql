-- MariaDB dump 10.19  Distrib 10.11.4-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: ruzky
-- ------------------------------------------------------
-- Server version	10.11.4-MariaDB-1~deb12u1

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
-- Table structure for table `action_recorder`
--

DROP TABLE IF EXISTS `action_recorder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `action_recorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `identifier` varchar(255) NOT NULL,
  `success` char(1) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_action_recorder_module` (`module`),
  KEY `idx_action_recorder_user_id` (`user_id`),
  KEY `idx_action_recorder_identifier` (`identifier`),
  KEY `idx_action_recorder_date_added` (`date_added`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Temporary table structure for view `address_book`
--

DROP TABLE IF EXISTS `address_book`;
/*!50001 DROP VIEW IF EXISTS `address_book`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `address_book` AS SELECT
 1 AS `address_book_id`,
  1 AS `customers_id`,
  1 AS `entry_gender`,
  1 AS `entry_company`,
  1 AS `entry_company_number`,
  1 AS `entry_vat_number`,
  1 AS `entry_firstname`,
  1 AS `entry_lastname`,
  1 AS `entry_street_address`,
  1 AS `entry_suburb`,
  1 AS `entry_postcode`,
  1 AS `entry_city`,
  1 AS `entry_state`,
  1 AS `entry_country_id`,
  1 AS `entry_zone_id`,
  1 AS `entry_carrier_point_id`,
  1 AS `tmp` */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `address_book_real`
--

DROP TABLE IF EXISTS `address_book_real`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address_book_real` (
  `address_book_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `entry_gender` char(1) DEFAULT NULL,
  `entry_company` text DEFAULT NULL,
  `entry_company_number` text DEFAULT NULL,
  `entry_vat_number` text DEFAULT NULL,
  `entry_firstname` text DEFAULT NULL,
  `entry_lastname` text DEFAULT NULL,
  `entry_street_address` text DEFAULT NULL,
  `entry_suburb` text DEFAULT NULL,
  `entry_postcode` text DEFAULT NULL,
  `entry_city` text DEFAULT NULL,
  `entry_state` varchar(255) DEFAULT NULL,
  `entry_country_id` int(11) NOT NULL DEFAULT 0,
  `entry_zone_id` int(11) NOT NULL DEFAULT 0,
  `entry_carrier_point_id` int(11) DEFAULT NULL,
  `tmp` int(1) DEFAULT NULL,
  PRIMARY KEY (`address_book_id`),
  KEY `idx_address_book_customers_id` (`customers_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `address_format`
--

DROP TABLE IF EXISTS `address_format`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address_format` (
  `address_format_id` int(11) NOT NULL AUTO_INCREMENT,
  `address_format` varchar(128) NOT NULL,
  `address_summary` varchar(48) NOT NULL,
  PRIMARY KEY (`address_format_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `administrators`
--

DROP TABLE IF EXISTS `administrators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_administrator_user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authors` (
  `authors_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `authors_name` varchar(64) DEFAULT NULL,
  `authors_status` int(1) NOT NULL DEFAULT 1,
  `authors_email` varchar(64) NOT NULL DEFAULT '',
  `authors_image` varchar(64) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `special_flags` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`authors_id`),
  KEY `IDX_AUTHORS_NAME` (`authors_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `authors_info`
--

DROP TABLE IF EXISTS `authors_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authors_info` (
  `authors_id` int(11) NOT NULL DEFAULT 0,
  `languages_id` int(11) NOT NULL DEFAULT 0,
  `authors_description` text DEFAULT NULL,
  `authors_url` varchar(255) NOT NULL,
  `url_clicked` int(5) NOT NULL DEFAULT 0,
  `date_last_click` datetime DEFAULT NULL,
  PRIMARY KEY (`authors_id`,`languages_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `balikovna`
--

DROP TABLE IF EXISTS `balikovna`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `balikovna` (
  `id` int(11) NOT NULL DEFAULT 0,
  `name` tinytext NOT NULL,
  `special` tinytext NOT NULL,
  `place` varchar(64) NOT NULL DEFAULT '',
  `street` varchar(128) NOT NULL DEFAULT '',
  `city` varchar(128) NOT NULL DEFAULT '',
  `zip` varchar(16) NOT NULL DEFAULT '',
  `country` varchar(8) NOT NULL DEFAULT '',
  `currency` varchar(8) NOT NULL DEFAULT '',
  `statusid` int(8) NOT NULL DEFAULT 0,
  `description` varchar(64) DEFAULT NULL,
  `url` varchar(256) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `balikovna`
--

LOCK TABLES `balikovna` WRITE;
/*!40000 ALTER TABLE `balikovna` DISABLE KEYS */;
/*!40000 ALTER TABLE `balikovna` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `balikovna_tmp`
--

DROP TABLE IF EXISTS `balikovna_tmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `balikovna_tmp` (
  `id` int(11) NOT NULL DEFAULT 0,
  `name` tinytext NOT NULL,
  `special` tinytext NOT NULL,
  `place` varchar(64) NOT NULL DEFAULT '',
  `street` varchar(128) NOT NULL DEFAULT '',
  `city` varchar(128) NOT NULL DEFAULT '',
  `zip` varchar(16) NOT NULL DEFAULT '',
  `country` varchar(8) NOT NULL DEFAULT '',
  `currency` varchar(8) NOT NULL DEFAULT '',
  `statusid` int(8) NOT NULL DEFAULT 0,
  `description` varchar(64) DEFAULT NULL,
  `url` varchar(256) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `balikovna_tmp`
--

LOCK TABLES `balikovna_tmp` WRITE;
/*!40000 ALTER TABLE `balikovna_tmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `balikovna_tmp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banned_ip`
--

DROP TABLE IF EXISTS `banned_ip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banned_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `ip_status` int(1) NOT NULL DEFAULT 0,
  `reason` tinytext DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17168 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Banned IP addresses that are not allowed to access website';
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banners` (
  `banners_id` int(11) NOT NULL AUTO_INCREMENT,
  `banners_title` varchar(64) NOT NULL,
  `banners_url` varchar(255) NOT NULL,
  `banners_image` varchar(64) NOT NULL,
  `banners_group` varchar(10) NOT NULL,
  `banners_html_text` text DEFAULT NULL,
  `expires_impressions` int(7) DEFAULT 0,
  `expires_date` datetime DEFAULT NULL,
  `date_scheduled` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `date_status_change` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`banners_id`),
  KEY `idx_banners_group` (`banners_group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `banners_history`
--

DROP TABLE IF EXISTS `banners_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banners_history` (
  `banners_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `banners_id` int(11) NOT NULL,
  `banners_shown` int(5) NOT NULL DEFAULT 0,
  `banners_clicked` int(5) NOT NULL DEFAULT 0,
  `banners_history_date` datetime NOT NULL,
  PRIMARY KEY (`banners_history_id`),
  KEY `idx_banners_history_banners_id` (`banners_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners_history`
--

LOCK TABLES `banners_history` WRITE;
/*!40000 ALTER TABLE `banners_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `banners_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `cache_id` varchar(32) NOT NULL DEFAULT '',
  `cache_language_id` tinyint(1) NOT NULL DEFAULT 0,
  `cache_name` varchar(255) NOT NULL DEFAULT '',
  `cache_data` mediumtext NOT NULL,
  `cache_global` tinyint(1) NOT NULL DEFAULT 1,
  `cache_gzip` tinyint(1) NOT NULL DEFAULT 1,
  `cache_method` varchar(20) NOT NULL DEFAULT 'RETURN',
  `cache_date` datetime NOT NULL,
  `cache_expires` datetime NOT NULL,
  PRIMARY KEY (`cache_id`,`cache_language_id`),
  KEY `cache_id` (`cache_id`),
  KEY `cache_language_id` (`cache_language_id`),
  KEY `cache_global` (`cache_global`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL AUTO_INCREMENT,
  `categories_status` tinyint(1) NOT NULL DEFAULT 1,
  `categories_image` varchar(256) NOT NULL DEFAULT '',
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `sort_order` int(3) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `categories_web_mask` int(1) NOT NULL DEFAULT 1,
  `is_topic` int(1) NOT NULL DEFAULT 0,
  `kn_id` int(5) DEFAULT NULL,
  PRIMARY KEY (`categories_id`),
  KEY `idx_categories_parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;



--
-- Table structure for table `categories_description`
--

DROP TABLE IF EXISTS `categories_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories_description` (
  `categories_id` int(11) NOT NULL DEFAULT 0,
  `language_id` int(11) NOT NULL DEFAULT 1,
  `categories_name` varchar(32) NOT NULL,
  `categories_description` text NOT NULL,
  `categories_seo_title` varchar(128) NOT NULL DEFAULT '',
  `categories_seo_description` text DEFAULT NULL,
  `categories_seo_keywords` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`categories_id`,`language_id`),
  KEY `idx_categories_name` (`categories_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `configuration`
--

DROP TABLE IF EXISTS `configuration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuration` (
  `configuration_id` int(11) NOT NULL AUTO_INCREMENT,
  `configuration_title` varchar(255) NOT NULL,
  `configuration_key` varchar(255) NOT NULL,
  `configuration_value` text NOT NULL,
  `configuration_description` varchar(255) NOT NULL,
  `configuration_group_id` int(11) NOT NULL,
  `sort_order` int(5) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `use_function` varchar(255) DEFAULT NULL,
  `set_function` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`configuration_id`)
) ENGINE=InnoDB AUTO_INCREMENT=634 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuration`
--

LOCK TABLES `configuration` WRITE;
/*!40000 ALTER TABLE `configuration` DISABLE KEYS */;
INSERT INTO `configuration` VALUES
(1,'Store Name','STORE_NAME','PureHTML','The name of my store',1,1,'2023-09-18 22:21:13','2021-12-19 21:19:22',NULL,NULL),
(2,'Store Owner','STORE_OWNER','PureHTML','The name of my store owner',1,2,'2023-09-18 22:21:40','2021-12-19 21:19:22',NULL,NULL),
(3,'E-Mail Address','STORE_OWNER_EMAIL_ADDRESS','f@simonformanek.cz','The e-mail address of my store owner',1,3,'2023-09-18 22:22:34','2021-12-19 21:19:22',NULL,NULL),
(4,'E-Mail From','EMAIL_FROM','f@simonformanek.cz','The e-mail address used in (sent) e-mails',1,4,'2023-09-18 22:22:43','2021-12-19 21:19:22',NULL,NULL),
(5,'Country','STORE_COUNTRY','56','The country my store is located in <br /><br /><strong>Note: Please remember to update the store zone.</strong>',1,6,'2022-01-12 21:50:49','2021-12-19 21:19:22','tep_get_country_name','tep_cfg_pull_down_country_list('),
(6,'Zone','STORE_ZONE','918','The zone my store is located in',1,7,'2022-12-08 00:49:13','2021-12-19 21:19:22','tep_cfg_get_zone_name','tep_cfg_pull_down_zone_list('),
(7,'Expected Sort Order','EXPECTED_PRODUCTS_SORT','asc','This is the sort order used in the expected products box.',1,8,'2022-03-17 17:51:00','2021-12-19 21:19:22',NULL,'tep_cfg_select_option(array(\'asc\', \'desc\'), '),
(8,'Expected Sort Field','EXPECTED_PRODUCTS_FIELD','date_expected','The column to sort by in the expected products box.',1,9,NULL,'2021-12-19 21:19:22',NULL,'tep_cfg_select_option(array(\'products_name\', \'date_expected\'), '),
(9,'Switch To Default Language Currency','USE_DEFAULT_LANGUAGE_CURRENCY','true','Automatically switch to the language\'s currency when it is changed',1,10,'2021-12-20 22:53:12','2021-12-19 21:19:22',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(10,'Send Extra Order Emails To','SEND_EXTRA_ORDER_EMAILS_TO','','Send extra order emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;',1,11,'2023-09-18 22:22:53','2021-12-19 21:19:22',NULL,NULL),
(11,'Use Search-Engine Safe URLs','SEARCH_ENGINE_FRIENDLY_URLS','false','Use search-engine safe urls for all site links',1,12,NULL,'2021-12-19 21:19:22',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(12,'Display Cart After Adding Product','DISPLAY_CART','true','Display the shopping cart after adding a product (or return back to their origin)',1,14,NULL,'2021-12-19 21:19:22',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(13,'Allow Guest To Tell A Friend','ALLOW_GUEST_TO_TELL_A_FRIEND','false','Allow guests to tell a friend about a product',1,15,NULL,'2021-12-19 21:19:22',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(14,'Default Search Operator','ADVANCED_SEARCH_DEFAULT_OPERATOR','and','Default search operators',1,17,NULL,'2021-12-19 21:19:22',NULL,'tep_cfg_select_option(array(\'and\', \'or\'), '),
(15,'Store Address and Phone','STORE_NAME_ADDRESS','','This is the Store Name, Address and Phone used on printable documents and displayed online',1,18,'2023-09-18 22:23:04','2021-12-19 21:19:22',NULL,'tep_cfg_textarea('),
(16,'Show Category Counts','SHOW_COUNTS','false','Count recursively how many products are in each category',1,19,'2021-12-20 22:53:38','2021-12-19 21:19:22',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(17,'Tax Decimal Places','TAX_DECIMAL_PLACES','0','Pad the tax value this amount of decimal places',1,20,NULL,'2021-12-19 21:19:22',NULL,NULL),
(18,'Display Prices with Tax','DISPLAY_PRICE_WITH_TAX','true','Display prices with tax included (true) or add the tax at the end (false)',1,21,'2021-12-20 23:02:16','2021-12-19 21:19:22',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(19,'First Name','ENTRY_FIRST_NAME_MIN_LENGTH','2','Minimum length of first name',2,1,NULL,'2021-12-19 21:19:22',NULL,NULL),
(20,'Last Name','ENTRY_LAST_NAME_MIN_LENGTH','2','Minimum length of last name',2,2,NULL,'2021-12-19 21:19:22',NULL,NULL),
(21,'Date of Birth','ENTRY_DOB_MIN_LENGTH','10','Minimum length of date of birth',2,3,NULL,'2021-12-19 21:19:22',NULL,NULL),
(22,'E-Mail Address','ENTRY_EMAIL_ADDRESS_MIN_LENGTH','6','Minimum length of e-mail address',2,4,NULL,'2021-12-19 21:19:22',NULL,NULL),
(23,'Street Address','ENTRY_STREET_ADDRESS_MIN_LENGTH','5','Minimum length of street address',2,5,NULL,'2021-12-19 21:19:22',NULL,NULL),
(24,'Company','ENTRY_COMPANY_MIN_LENGTH','2','Minimum length of company name',2,6,NULL,'2021-12-19 21:19:22',NULL,NULL),
(25,'Post Code','ENTRY_POSTCODE_MIN_LENGTH','4','Minimum length of post code',2,7,NULL,'2021-12-19 21:19:22',NULL,NULL),
(26,'City','ENTRY_CITY_MIN_LENGTH','3','Minimum length of city',2,8,NULL,'2021-12-19 21:19:22',NULL,NULL),
(27,'State','ENTRY_STATE_MIN_LENGTH','2','Minimum length of state',2,9,NULL,'2021-12-19 21:19:22',NULL,NULL),
(28,'Telephone Number','ENTRY_TELEPHONE_MIN_LENGTH','3','Minimum length of telephone number',2,10,NULL,'2021-12-19 21:19:22',NULL,NULL),
(29,'Password','ENTRY_PASSWORD_MIN_LENGTH','5','Minimum length of password',2,11,NULL,'2021-12-19 21:19:22',NULL,NULL),
(30,'Credit Card Owner Name','CC_OWNER_MIN_LENGTH','3','Minimum length of credit card owner name',2,12,NULL,'2021-12-19 21:19:22',NULL,NULL),
(31,'Credit Card Number','CC_NUMBER_MIN_LENGTH','10','Minimum length of credit card number',2,13,NULL,'2021-12-19 21:19:22',NULL,NULL),
(32,'Review Text','REVIEW_TEXT_MIN_LENGTH','4','Minimum length of review text',2,14,'2022-03-03 18:44:49','2021-12-19 21:19:22',NULL,NULL),
(33,'Best Sellers','MIN_DISPLAY_BESTSELLERS','1','Minimum number of best sellers to display',2,15,NULL,'2021-12-19 21:19:22',NULL,NULL),
(34,'Also Purchased','MIN_DISPLAY_ALSO_PURCHASED','1','Minimum number of products to display in the \'This Customer Also Purchased\' box',2,16,NULL,'2021-12-19 21:19:22',NULL,NULL),
(35,'Address Book Entries','MAX_ADDRESS_BOOK_ENTRIES','5','Maximum address book entries a customer is allowed to have',3,1,NULL,'2021-12-19 21:19:22',NULL,NULL),
(36,'Search Results','MAX_DISPLAY_SEARCH_RESULTS','9999','Amount of products to list',3,2,'2022-03-17 23:24:45','2021-12-19 21:19:22',NULL,NULL),
(37,'Page Links','MAX_DISPLAY_PAGE_LINKS','5','Number of \'number\' links use for page-sets',3,3,NULL,'2021-12-19 21:19:22',NULL,NULL),
(38,'Special Products','MAX_DISPLAY_SPECIAL_PRODUCTS','9','Maximum number of products on special to display',3,4,NULL,'2021-12-19 21:19:22',NULL,NULL),
(39,'New Products Module','MAX_DISPLAY_NEW_PRODUCTS','3','Maximum number of new products to display in a category',3,5,'2022-02-28 22:03:27','2021-12-19 21:19:22',NULL,NULL),
(40,'Products Expected','MAX_DISPLAY_UPCOMING_PRODUCTS','1000','Maximum number of products expected to display',3,6,'2022-03-17 16:06:18','2021-12-19 21:19:22',NULL,NULL),
(41,'Manufacturers List','MAX_DISPLAY_MANUFACTURERS_IN_A_LIST','0','Used in manufacturers box; when the number of manufacturers exceeds this number, a drop-down list will be displayed instead of the default list',3,7,NULL,'2021-12-19 21:19:22',NULL,NULL),
(42,'Manufacturers Select Size','MAX_MANUFACTURERS_LIST','1','Used in manufacturers box; when this value is \'1\' the classic drop-down list will be used for the manufacturers box. Otherwise, a list-box with the specified number of rows will be displayed.',3,7,NULL,'2021-12-19 21:19:22',NULL,NULL),
(43,'Length of Manufacturers Name','MAX_DISPLAY_MANUFACTURER_NAME_LEN','15','Used in manufacturers box; maximum length of manufacturers name to display',3,8,NULL,'2021-12-19 21:19:22',NULL,NULL),
(44,'New Reviews','MAX_DISPLAY_NEW_REVIEWS','6','Maximum number of new reviews to display',3,9,NULL,'2021-12-19 21:19:22',NULL,NULL),
(45,'Selection of Random Reviews','MAX_RANDOM_SELECT_REVIEWS','10','How many records to select from to choose one random product review',3,10,NULL,'2021-12-19 21:19:22',NULL,NULL),
(46,'Selection of Random New Products','MAX_RANDOM_SELECT_NEW','10','How many records to select from to choose one random new product to display',3,11,NULL,'2021-12-19 21:19:22',NULL,NULL),
(47,'Selection of Products on Special','MAX_RANDOM_SELECT_SPECIALS','10','How many records to select from to choose one random product special to display',3,12,NULL,'2021-12-19 21:19:22',NULL,NULL),
(48,'Categories To List Per Row','MAX_DISPLAY_CATEGORIES_PER_ROW','3','How many categories to list per row',3,13,NULL,'2021-12-19 21:19:22',NULL,NULL),
(49,'New Products Listing','MAX_DISPLAY_PRODUCTS_NEW','30','Maximum number of new products to display in new products page',3,14,'2022-03-03 12:53:20','2021-12-19 21:19:22',NULL,NULL),
(50,'Best Sellers','MAX_DISPLAY_BESTSELLERS','10','Maximum number of best sellers to display',3,15,NULL,'2021-12-19 21:19:22',NULL,NULL),
(51,'Also Purchased','MAX_DISPLAY_ALSO_PURCHASED','6','Maximum number of products to display in the \'This Customer Also Purchased\' box',3,16,NULL,'2021-12-19 21:19:22',NULL,NULL),
(52,'Customer Order History Box','MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX','6','Maximum number of products to display in the customer order history box',3,17,NULL,'2021-12-19 21:19:22',NULL,NULL),
(53,'Order History','MAX_DISPLAY_ORDER_HISTORY','10','Maximum number of orders to display in the order history page',3,18,NULL,'2021-12-19 21:19:22',NULL,NULL),
(54,'Product Quantities In Shopping Cart','MAX_QTY_IN_CART','99','Maximum number of product quantities that can be added to the shopping cart (0 for no limit)',3,19,NULL,'2021-12-19 21:19:22',NULL,NULL),
(55,'Small Image Width','SMALL_IMAGE_WIDTH','200','The pixel width of small images',4,1,NULL,'2021-12-19 21:19:22',NULL,NULL),
(56,'Small Image Height','SMALL_IMAGE_HEIGHT','160','The pixel height of small images',4,2,NULL,'2021-12-19 21:19:22',NULL,NULL),
(57,'Heading Image Width','HEADING_IMAGE_WIDTH','57','The pixel width of heading images',4,3,NULL,'2021-12-19 21:19:22',NULL,NULL),
(58,'Heading Image Height','HEADING_IMAGE_HEIGHT','40','The pixel height of heading images',4,4,NULL,'2021-12-19 21:19:22',NULL,NULL),
(59,'Subcategory Image Width','SUBCATEGORY_IMAGE_WIDTH','300','The pixel width of subcategory images',4,5,'2023-01-23 03:59:47','2021-12-19 21:19:22',NULL,NULL),
(60,'Subcategory Image Height','SUBCATEGORY_IMAGE_HEIGHT','200','The pixel height of subcategory images',4,6,'2023-01-23 04:00:03','2021-12-19 21:19:22',NULL,NULL),
(61,'Calculate Image Size','CONFIG_CALCULATE_IMAGE_SIZE','true','Calculate the size of images?',4,7,NULL,'2021-12-19 21:19:22',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(62,'Image Required','IMAGE_REQUIRED','true','Enable to display broken images. Good for development.',4,8,NULL,'2021-12-19 21:19:22',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(63,'Gender','ACCOUNT_GENDER','false','Display gender in the customers account',5,1,'2022-02-12 03:17:51','2021-12-19 21:19:22',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(64,'Date of Birth','ACCOUNT_DOB','false','Display date of birth in the customers account',5,2,'2022-02-12 03:18:00','2021-12-19 21:19:22',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(65,'Company','ACCOUNT_COMPANY','true','Display company in the customers account',5,3,NULL,'2021-12-19 21:19:22',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(66,'Suburb','ACCOUNT_SUBURB','false','Display suburb in the customers account',5,4,'2022-02-12 03:18:18','2021-12-19 21:19:22',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(67,'State','ACCOUNT_STATE','false','Display state in the customers account',5,5,'2022-02-12 03:18:11','2021-12-19 21:19:22',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(68,'Installed Modules','MODULE_PAYMENT_INSTALLED','cod.php;gpwebpaygpebinder.php;moneyorder.php','List of payment module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: cod.php;paypal_express.php)',6,0,'2022-03-10 01:29:05','2021-12-19 21:19:22',NULL,NULL),
(69,'Installed Modules','MODULE_ORDER_TOTAL_INSTALLED','ot_subtotal.php;ot_shipping.php;ot_tax.php;ot_cod_fee.php;ot_total.php','List of order_total module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_total.php)',6,0,'2022-03-13 00:31:32','2021-12-19 21:19:22',NULL,NULL),
(70,'Installed Modules','MODULE_SHIPPING_INSTALLED','table.php','List of shipping module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ups.php;flat.php;item.php)',6,0,'2022-10-15 01:04:52','2021-12-19 21:19:23',NULL,NULL),
(71,'Installed Modules','MODULE_ACTION_RECORDER_INSTALLED','ar_admin_login.php;ar_contact_us.php;ar_reset_password.php;ar_tell_a_friend.php','List of action recorder module filenames separated by a semi-colon. This is automatically updated. No need to edit.',6,0,NULL,'2021-12-19 21:19:23',NULL,NULL),
(72,'Installed Modules','MODULE_SOCIAL_BOOKMARKS_INSTALLED','sb_email.php;sb_google_plus_share.php;sb_facebook.php;sb_twitter.php;sb_pinterest.php','List of social bookmark module filenames separated by a semi-colon. This is automatically updated. No need to edit.',6,0,'2022-02-27 20:29:21','2021-12-19 21:19:23',NULL,NULL),
(82,'Default Currency','DEFAULT_CURRENCY','CZK','Default Currency',6,0,NULL,'2021-12-19 21:19:23',NULL,NULL),
(83,'Default Language','DEFAULT_LANGUAGE','cs','Default Language',6,0,NULL,'2021-12-19 21:19:23',NULL,NULL),
(84,'Default Order Status For New Orders','DEFAULT_ORDERS_STATUS_ID','1','When a new order is created, this order status will be assigned to it.',6,0,NULL,'2021-12-19 21:19:23',NULL,NULL),
(85,'Display Shipping','MODULE_ORDER_TOTAL_SHIPPING_STATUS','true','Do you want to display the order shipping cost?',6,1,NULL,'2021-12-19 21:19:23',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(86,'Sort Order','MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER','2','Sort order of display.',6,2,NULL,'2021-12-19 21:19:23',NULL,NULL),
(87,'Allow Free Shipping','MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING','false','Do you want to allow free shipping?',6,3,NULL,'2021-12-19 21:19:23',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(88,'Free Shipping For Orders Over','MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER','1150','Provide free shipping for orders over the set amount.',6,4,NULL,'2021-12-19 21:19:23','currencies->format',NULL),
(89,'Provide Free Shipping For Orders Made','MODULE_ORDER_TOTAL_SHIPPING_DESTINATION','both','Provide free shipping for orders sent to the set destination.',6,5,NULL,'2021-12-19 21:19:23',NULL,'tep_cfg_select_option(array(\'national\', \'international\', \'both\'), '),
(90,'Display Sub-Total','MODULE_ORDER_TOTAL_SUBTOTAL_STATUS','true','Do you want to display the order sub-total cost?',6,1,NULL,'2021-12-19 21:19:23',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(91,'Sort Order','MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER','1','Sort order of display.',6,2,NULL,'2021-12-19 21:19:23',NULL,NULL),
(92,'Display Tax','MODULE_ORDER_TOTAL_TAX_STATUS','true','Do you want to display the order tax value?',6,1,NULL,'2021-12-19 21:19:23',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(93,'Sort Order','MODULE_ORDER_TOTAL_TAX_SORT_ORDER','3','Sort order of display.',6,2,NULL,'2021-12-19 21:19:23',NULL,NULL),
(94,'Display Total','MODULE_ORDER_TOTAL_TOTAL_STATUS','true','Do you want to display the total order value?',6,1,NULL,'2021-12-19 21:19:23',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(95,'Sort Order','MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER','4','Sort order of display.',6,2,NULL,'2021-12-19 21:19:23',NULL,NULL),
(96,'Minimum Minutes Per E-Mail','MODULE_ACTION_RECORDER_CONTACT_US_EMAIL_MINUTES','1','Minimum number of minutes to allow 1 e-mail to be sent (eg, 15 for 1 e-mail every 15 minutes)',6,0,NULL,'2021-12-19 21:19:23',NULL,NULL),
(97,'Minimum Minutes Per E-Mail','MODULE_ACTION_RECORDER_TELL_A_FRIEND_EMAIL_MINUTES','1500000','Minimum number of minutes to allow 1 e-mail to be sent (eg, 15 for 1 e-mail every 15 minutes)',6,0,NULL,'2021-12-19 21:19:23',NULL,NULL),
(98,'Allowed Minutes','MODULE_ACTION_RECORDER_ADMIN_LOGIN_MINUTES','5','Number of minutes to allow login attempts to occur.',6,0,NULL,'2021-12-19 21:19:23',NULL,NULL),
(99,'Allowed Attempts','MODULE_ACTION_RECORDER_ADMIN_LOGIN_ATTEMPTS','3','Number of login attempts to allow within the specified period.',6,0,NULL,'2021-12-19 21:19:23',NULL,NULL),
(100,'Allowed Minutes','MODULE_ACTION_RECORDER_RESET_PASSWORD_MINUTES','5','Number of minutes to allow password resets to occur.',6,0,NULL,'2021-12-19 21:19:23',NULL,NULL),
(101,'Allowed Attempts','MODULE_ACTION_RECORDER_RESET_PASSWORD_ATTEMPTS','1','Number of password reset attempts to allow within the specified period.',6,0,NULL,'2021-12-19 21:19:23',NULL,NULL),
(102,'Enable E-Mail Module','MODULE_SOCIAL_BOOKMARKS_EMAIL_STATUS','True','Do you want to allow products to be shared through e-mail?',6,1,NULL,'2021-12-19 21:19:23',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(103,'Sort Order','MODULE_SOCIAL_BOOKMARKS_EMAIL_SORT_ORDER','10','Sort order of display. Lowest is displayed first.',6,0,NULL,'2021-12-19 21:19:23',NULL,NULL),
(104,'Enable Google+ Share Module','MODULE_SOCIAL_BOOKMARKS_GOOGLE_PLUS_SHARE_STATUS','True','Do you want to allow products to be shared through Google+?',6,1,NULL,'2021-12-19 21:19:23',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(105,'Annotation','MODULE_SOCIAL_BOOKMARKS_GOOGLE_PLUS_SHARE_ANNOTATION','None','The annotation to display next to the button.',6,1,NULL,'2021-12-19 21:19:23',NULL,'tep_cfg_select_option(array(\'Inline\', \'Bubble\', \'Vertical-Bubble\', \'None\'), '),
(106,'Width','MODULE_SOCIAL_BOOKMARKS_GOOGLE_PLUS_SHARE_WIDTH','','The maximum width of the button.',6,0,NULL,'2021-12-19 21:19:23',NULL,NULL),
(107,'Height','MODULE_SOCIAL_BOOKMARKS_GOOGLE_PLUS_SHARE_HEIGHT','15','Sets the height of the button.',6,1,NULL,'2021-12-19 21:19:23',NULL,'tep_cfg_select_option(array(\'15\', \'20\', \'24\', \'60\'), '),
(108,'Alignment','MODULE_SOCIAL_BOOKMARKS_GOOGLE_PLUS_SHARE_ALIGN','Left','The alignment of the button assets.',6,1,NULL,'2021-12-19 21:19:23',NULL,'tep_cfg_select_option(array(\'Left\', \'Right\'), '),
(109,'Sort Order','MODULE_SOCIAL_BOOKMARKS_GOOGLE_PLUS_SHARE_SORT_ORDER','20','Sort order of display. Lowest is displayed first.',6,0,NULL,'2021-12-19 21:19:23',NULL,NULL),
(110,'Enable Facebook Module','MODULE_SOCIAL_BOOKMARKS_FACEBOOK_STATUS','True','Do you want to allow products to be shared through Facebook?',6,1,NULL,'2021-12-19 21:19:23',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(111,'Sort Order','MODULE_SOCIAL_BOOKMARKS_FACEBOOK_SORT_ORDER','30','Sort order of display. Lowest is displayed first.',6,0,NULL,'2021-12-19 21:19:23',NULL,NULL),
(112,'Enable Twitter Module','MODULE_SOCIAL_BOOKMARKS_TWITTER_STATUS','True','Do you want to allow products to be shared through Twitter?',6,1,NULL,'2021-12-19 21:19:23',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(113,'Sort Order','MODULE_SOCIAL_BOOKMARKS_TWITTER_SORT_ORDER','40','Sort order of display. Lowest is displayed first.',6,0,NULL,'2021-12-19 21:19:23',NULL,NULL),
(114,'Enable Pinterest Module','MODULE_SOCIAL_BOOKMARKS_PINTEREST_STATUS','True','Do you want to allow Pinterest Button?',6,1,NULL,'2021-12-19 21:19:23',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(115,'Layout Position','MODULE_SOCIAL_BOOKMARKS_PINTEREST_BUTTON_COUNT_POSITION','None','Horizontal or Vertical or None',6,2,NULL,'2021-12-19 21:19:23',NULL,'tep_cfg_select_option(array(\'Horizontal\', \'Vertical\', \'None\'), '),
(116,'Sort Order','MODULE_SOCIAL_BOOKMARKS_PINTEREST_SORT_ORDER','50','Sort order of display. Lowest is displayed first.',6,0,NULL,'2021-12-19 21:19:23',NULL,NULL),
(117,'Country of Origin','SHIPPING_ORIGIN_COUNTRY','223','Select the country of origin to be used in shipping quotes.',7,1,NULL,'2021-12-19 21:19:23','tep_get_country_name','tep_cfg_pull_down_country_list('),
(118,'Postal Code','SHIPPING_ORIGIN_ZIP','NONE','Enter the Postal Code (ZIP) of the Store to be used in shipping quotes.',7,2,NULL,'2021-12-19 21:19:23',NULL,NULL),
(119,'Enter the Maximum Package Weight you will ship','SHIPPING_MAX_WEIGHT','50','Carriers have a max weight limit for a single package. This is a common one for all.',7,3,NULL,'2021-12-19 21:19:23',NULL,NULL),
(120,'Package Tare weight.','SHIPPING_BOX_WEIGHT','3','What is the weight of typical packaging of small to medium packages?',7,4,NULL,'2021-12-19 21:19:23',NULL,NULL),
(121,'Larger packages - percentage increase.','SHIPPING_BOX_PADDING','10','For 10% enter 10',7,5,NULL,'2021-12-19 21:19:23',NULL,NULL),
(122,'Allow Orders Not Matching Defined Shipping Zones ','SHIPPING_ALLOW_UNDEFINED_ZONES','False','Should orders be allowed to shipping addresses not matching defined shipping module shipping zones?',7,5,NULL,'2021-12-19 21:19:23',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(123,'Display Product Image','PRODUCT_LIST_IMAGE','1','Do you want to display the Product Image?',8,1,NULL,'2021-12-19 21:19:23',NULL,NULL),
(124,'Display Product Manufacturer Name','PRODUCT_LIST_MANUFACTURER','0','Do you want to display the Product Manufacturer Name?',8,2,NULL,'2021-12-19 21:19:23',NULL,NULL),
(125,'Display Product Model','PRODUCT_LIST_MODEL','0','Do you want to display the Product Model?',8,3,NULL,'2021-12-19 21:19:23',NULL,NULL),
(126,'Display Product Name','PRODUCT_LIST_NAME','2','Do you want to display the Product Name?',8,4,NULL,'2021-12-19 21:19:23',NULL,NULL),
(127,'Display Product Price','PRODUCT_LIST_PRICE','3','Do you want to display the Product Price',8,5,NULL,'2021-12-19 21:19:23',NULL,NULL),
(128,'Display Product Quantity','PRODUCT_LIST_QUANTITY','0','Do you want to display the Product Quantity?',8,6,NULL,'2021-12-19 21:19:23',NULL,NULL),
(129,'Display Product Weight','PRODUCT_LIST_WEIGHT','0','Do you want to display the Product Weight?',8,7,NULL,'2021-12-19 21:19:23',NULL,NULL),
(130,'Display Buy Now column','PRODUCT_LIST_BUY_NOW','4','Do you want to display the Buy Now column?',8,8,NULL,'2021-12-19 21:19:23',NULL,NULL),
(131,'Display Category/Manufacturer Filter (0=disable; 1=enable)','PRODUCT_LIST_FILTER','1','Do you want to display the Category/Manufacturer Filter?',8,9,NULL,'2021-12-19 21:19:23',NULL,NULL),
(132,'Location of Prev/Next Navigation Bar (1-top, 2-bottom, 3-both)','PREV_NEXT_BAR_LOCATION','2','Sets the location of the Prev/Next Navigation Bar (1-top, 2-bottom, 3-both)',8,10,NULL,'2021-12-19 21:19:23',NULL,NULL),
(133,'Check stock level','STOCK_CHECK','true','Check to see if sufficent stock is available',9,1,NULL,'2021-12-19 21:19:23',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(134,'Subtract stock','STOCK_LIMITED','true','Subtract product in stock by product orders',9,2,NULL,'2021-12-19 21:19:23',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(135,'Allow Checkout','STOCK_ALLOW_CHECKOUT','false','Allow customer to checkout even if there is insufficient stock',9,3,'2021-12-21 00:00:17','2021-12-19 21:19:23',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(136,'Mark product out of stock','STOCK_MARK_PRODUCT_OUT_OF_STOCK','***','Display something on screen so customer can see which product has insufficient stock',9,4,NULL,'2021-12-19 21:19:23',NULL,NULL),
(137,'Stock Re-order level','STOCK_REORDER_LEVEL','5','Define when stock needs to be re-ordered',9,5,NULL,'2021-12-19 21:19:23',NULL,NULL),
(138,'Store Page Parse Time','STORE_PAGE_PARSE_TIME','false','Store the time it takes to parse a page',10,1,NULL,'2021-12-19 21:19:24',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(139,'Log Destination','STORE_PAGE_PARSE_TIME_LOG','/var/log/www/tep/page_parse_time.log','Directory and filename of the page parse time log',10,2,NULL,'2021-12-19 21:19:24',NULL,NULL),
(140,'Log Date Format','STORE_PARSE_DATE_TIME_FORMAT','%d/%m/%Y %H:%M:%S','The date format',10,3,NULL,'2021-12-19 21:19:24',NULL,NULL),
(141,'Display The Page Parse Time','DISPLAY_PAGE_PARSE_TIME','true','Display the page parse time (store page parse time must be enabled)',10,4,NULL,'2021-12-19 21:19:24',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(142,'Store Database Queries','STORE_DB_TRANSACTIONS','false','Store the database queries in the page parse time log',10,5,NULL,'2021-12-19 21:19:24',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(143,'Use Cache','USE_CACHE','false','Use caching features',11,1,NULL,'2021-12-19 21:19:24',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(144,'Cache Directory','DIR_FS_CACHE','/tmp/','The directory where the cached files are saved',11,2,NULL,'2021-12-19 21:19:24',NULL,NULL),
(145,'E-Mail Transport Method','EMAIL_TRANSPORT','sendmail','Defines if this server uses a local connection to sendmail or uses an SMTP connection via TCP/IP. Servers running on Windows and MacOS should change this setting to SMTP.',12,1,NULL,'2021-12-19 21:19:24',NULL,'tep_cfg_select_option(array(\'sendmail\', \'smtp\'),'),
(146,'E-Mail Linefeeds','EMAIL_LINEFEED','LF','Defines the character sequence used to separate mail headers.',12,2,NULL,'2021-12-19 21:19:24',NULL,'tep_cfg_select_option(array(\'LF\', \'CRLF\'),'),
(147,'Use MIME HTML When Sending Emails','EMAIL_USE_HTML','false','Send e-mails in HTML format',12,3,NULL,'2021-12-19 21:19:24',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(148,'Verify E-Mail Addresses Through DNS','ENTRY_EMAIL_ADDRESS_CHECK','false','Verify e-mail address through a DNS server',12,4,NULL,'2021-12-19 21:19:24',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(149,'Send E-Mails','SEND_EMAILS','true','Send out e-mails',12,5,NULL,'2021-12-19 21:19:24',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(150,'Enable download','DOWNLOAD_ENABLED','true','Enable the products download functions.',13,1,'2022-01-29 19:37:32','2021-12-19 21:19:24',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(151,'Download by redirect','DOWNLOAD_BY_REDIRECT','false','Use browser redirection for download. Disable on non-Unix systems.',13,2,NULL,'2021-12-19 21:19:24',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(152,'Expiry delay (days)','DOWNLOAD_MAX_DAYS','0','Set number of days before the download link expires. 0 means no limit.',13,3,'2022-01-29 19:38:09','2021-12-19 21:19:24',NULL,''),
(153,'Maximum number of downloads','DOWNLOAD_MAX_COUNT','0','Set the maximum number of downloads. 0 means no download authorized.',13,4,'2022-01-29 19:38:31','2021-12-19 21:19:24',NULL,''),
(154,'Enable GZip Compression','GZIP_COMPRESSION','false','Enable HTTP GZip compression.',14,1,NULL,'2021-12-19 21:19:24',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(155,'Compression Level','GZIP_LEVEL','5','Use this compression level 0-9 (0 = minimum, 9 = maximum).',14,2,NULL,'2021-12-19 21:19:24',NULL,NULL),
(156,'Session Directory','SESSION_WRITE_DIRECTORY','/tmp','If sessions are file based, store them in this directory.',15,1,NULL,'2021-12-19 21:19:24',NULL,NULL),
(157,'Force Cookie Use','SESSION_FORCE_COOKIE_USE','False','Force the use of sessions when cookies are only enabled.',15,2,NULL,'2021-12-19 21:19:24',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(158,'Check SSL Session ID','SESSION_CHECK_SSL_SESSION_ID','False','Validate the SSL_SESSION_ID on every secure HTTPS page request.',15,3,NULL,'2021-12-19 21:19:24',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(159,'Check User Agent','SESSION_CHECK_USER_AGENT','False','Validate the clients browser user agent on every page request.',15,4,NULL,'2021-12-19 21:19:24',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(160,'Check IP Address','SESSION_CHECK_IP_ADDRESS','False','Validate the clients IP address on every page request.',15,5,NULL,'2021-12-19 21:19:24',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(161,'Prevent Spider Sessions','SESSION_BLOCK_SPIDERS','True','Prevent known spiders from starting a session.',15,6,NULL,'2021-12-19 21:19:24',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(162,'Recreate Session','SESSION_RECREATE','True','Recreate the session to generate a new session ID when the customer logs on or creates an account (PHP >=4.1 needed).',15,7,NULL,'2021-12-19 21:19:24',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(163,'Last Update Check Time','LAST_UPDATE_CHECK_TIME','','Last time a check for new versions of osCommerce was run',6,0,NULL,'2021-12-19 21:19:24',NULL,NULL),
(182,'Installed Modules','MODULE_HEADER_TAGS_INSTALLED','ht_manufacturer_title.php;ht_category_title.php;ht_product_title.php;ht_canonical.php;ht_robot_noindex.php','List of header tag module filenames separated by a semi-colon. This is automatically updated. No need to edit.',6,0,'2022-02-07 00:52:52','2021-12-19 21:19:28',NULL,NULL),
(183,'Enable Category Title Module','MODULE_HEADER_TAGS_CATEGORY_TITLE_STATUS','True','Do you want to allow category titles to be added to the page title?',6,1,NULL,'2021-12-19 21:19:28',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(184,'Sort Order','MODULE_HEADER_TAGS_CATEGORY_TITLE_SORT_ORDER','200','Sort order of display. Lowest is displayed first.',6,0,NULL,'2021-12-19 21:19:28',NULL,NULL),
(185,'Enable Manufacturer Title Module','MODULE_HEADER_TAGS_MANUFACTURER_TITLE_STATUS','True','Do you want to allow manufacturer titles to be added to the page title?',6,1,NULL,'2021-12-19 21:19:28',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(186,'Sort Order','MODULE_HEADER_TAGS_MANUFACTURER_TITLE_SORT_ORDER','100','Sort order of display. Lowest is displayed first.',6,0,NULL,'2021-12-19 21:19:28',NULL,NULL),
(187,'Enable Product Title Module','MODULE_HEADER_TAGS_PRODUCT_TITLE_STATUS','True','Do you want to allow product titles to be added to the page title?',6,1,NULL,'2021-12-19 21:19:28',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(188,'Sort Order','MODULE_HEADER_TAGS_PRODUCT_TITLE_SORT_ORDER','300','Sort order of display. Lowest is displayed first.',6,0,NULL,'2021-12-19 21:19:28',NULL,NULL),
(189,'Enable Canonical Module','MODULE_HEADER_TAGS_CANONICAL_STATUS','True','Do you want to enable the Canonical module?',6,1,NULL,'2021-12-19 21:19:28',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(190,'Sort Order','MODULE_HEADER_TAGS_CANONICAL_SORT_ORDER','400','Sort order of display. Lowest is displayed first.',6,0,NULL,'2021-12-19 21:19:28',NULL,NULL),
(191,'Enable Robot NoIndex Module','MODULE_HEADER_TAGS_ROBOT_NOINDEX_STATUS','True','Do you want to enable the Robot NoIndex module?',6,1,NULL,'2021-12-19 21:19:28',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(192,'Pages','MODULE_HEADER_TAGS_ROBOT_NOINDEX_PAGES','account.php;account_edit.php;account_history.php;account_history_info.php;account_newsletters.php;account_notifications.php;account_password.php;address_book.php;address_book_process.php;checkout_confirmation.php;checkout_payment.php;checkout_payment_address.php;checkout_process.php;checkout_shipping.php;checkout_shipping_address.php;checkout_success.php;cookie_usage.php;create_account.php;create_account_success.php;login.php;logoff.php;password_forgotten.php;password_reset.php;product_reviews_write.php;shopping_cart.php;ssl_check.php;tell_a_friend.php','The pages to add the meta robot noindex tag to.',6,0,NULL,'2021-12-19 21:19:28','ht_robot_noindex_show_pages','ht_robot_noindex_edit_pages('),
(193,'Sort Order','MODULE_HEADER_TAGS_ROBOT_NOINDEX_SORT_ORDER','500','Sort order of display. Lowest is displayed first.',6,0,NULL,'2021-12-19 21:19:28',NULL,NULL),
(194,'Installed Modules','MODULE_ADMIN_DASHBOARD_INSTALLED','d_total_revenue.php;d_total_customers.php;d_orders.php;d_customers.php;d_admin_logins.php;d_reviews.php','List of Administration Tool Dashboard module filenames separated by a semi-colon. This is automatically updated. No need to edit.',6,0,NULL,'2021-12-19 21:19:28',NULL,NULL),
(195,'Enable Administrator Logins Module','MODULE_ADMIN_DASHBOARD_ADMIN_LOGINS_STATUS','True','Do you want to show the latest administrator logins on the dashboard?',6,1,NULL,'2021-12-19 21:19:28',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(196,'Sort Order','MODULE_ADMIN_DASHBOARD_ADMIN_LOGINS_SORT_ORDER','500','Sort order of display. Lowest is displayed first.',6,0,NULL,'2021-12-19 21:19:28',NULL,NULL),
(197,'Enable Customers Module','MODULE_ADMIN_DASHBOARD_CUSTOMERS_STATUS','True','Do you want to show the newest customers on the dashboard?',6,1,NULL,'2021-12-19 21:19:28',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(198,'Sort Order','MODULE_ADMIN_DASHBOARD_CUSTOMERS_SORT_ORDER','400','Sort order of display. Lowest is displayed first.',6,0,NULL,'2021-12-19 21:19:28',NULL,NULL),
(203,'Enable Orders Module','MODULE_ADMIN_DASHBOARD_ORDERS_STATUS','True','Do you want to show the latest orders on the dashboard?',6,1,NULL,'2021-12-19 21:19:28',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(204,'Sort Order','MODULE_ADMIN_DASHBOARD_ORDERS_SORT_ORDER','300','Sort order of display. Lowest is displayed first.',6,0,NULL,'2021-12-19 21:19:28',NULL,NULL),
(207,'Enable Total Customers Module','MODULE_ADMIN_DASHBOARD_TOTAL_CUSTOMERS_STATUS','True','Do you want to show the total customers chart on the dashboard?',6,1,NULL,'2021-12-19 21:19:28',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(208,'Sort Order','MODULE_ADMIN_DASHBOARD_TOTAL_CUSTOMERS_SORT_ORDER','200','Sort order of display. Lowest is displayed first.',6,0,NULL,'2021-12-19 21:19:28',NULL,NULL),
(209,'Enable Total Revenue Module','MODULE_ADMIN_DASHBOARD_TOTAL_REVENUE_STATUS','True','Do you want to show the total revenue chart on the dashboard?',6,1,NULL,'2021-12-19 21:19:28',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(210,'Sort Order','MODULE_ADMIN_DASHBOARD_TOTAL_REVENUE_SORT_ORDER','100','Sort order of display. Lowest is displayed first.',6,0,NULL,'2021-12-19 21:19:28',NULL,NULL),
(213,'Enable Latest Reviews Module','MODULE_ADMIN_DASHBOARD_REVIEWS_STATUS','True','Do you want to show the latest reviews on the dashboard?',6,1,NULL,'2021-12-19 21:19:28',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(214,'Sort Order','MODULE_ADMIN_DASHBOARD_REVIEWS_SORT_ORDER','1000','Sort order of display. Lowest is displayed first.',6,0,NULL,'2021-12-19 21:19:28',NULL,NULL),
(217,'Installed Modules','MODULE_BOXES_INSTALLED','bm_categories.php','List of box module filenames separated by a semi-colon. This is automatically updated. No need to edit.',6,0,'2023-09-19 02:02:34','2021-12-19 21:19:28',NULL,NULL),
(267,'Installed Template Block Groups','TEMPLATE_BLOCK_GROUPS','boxes;header_tags','This is automatically updated. No need to edit.',6,0,NULL,'2021-12-19 21:19:30',NULL,NULL),
(268,'Installed Modules','MODULE_CONTENT_INSTALLED','account/cm_account_set_password;checkout_success/cm_cs_redirect_old_order;login/cm_login_form;login/cm_create_account_link','This is automatically updated. No need to edit.',6,0,NULL,'2021-12-19 21:19:30',NULL,NULL),
(269,'Enable Set Account Password','MODULE_CONTENT_ACCOUNT_SET_PASSWORD_STATUS','True','Do you want to enable the Set Account Password module?',6,1,NULL,'2021-12-19 21:19:30',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(270,'Allow Local Passwords','MODULE_CONTENT_ACCOUNT_SET_PASSWORD_ALLOW_PASSWORD','True','Allow local account passwords to be set.',6,1,NULL,'2021-12-19 21:19:30',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(271,'Sort Order','MODULE_CONTENT_ACCOUNT_SET_PASSWORD_SORT_ORDER','100','Sort order of display. Lowest is displayed first.',6,0,NULL,'2021-12-19 21:19:30',NULL,NULL),
(272,'Enable Redirect Old Order Module','MODULE_CONTENT_CHECKOUT_SUCCESS_REDIRECT_OLD_ORDER_STATUS','True','Should customers be redirected when viewing old checkout success orders?',6,1,NULL,'2021-12-19 21:19:30',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(273,'Redirect Minutes','MODULE_CONTENT_CHECKOUT_SUCCESS_REDIRECT_OLD_ORDER_MINUTES','60','Redirect customers to the My Account page after an order older than this amount is viewed.',6,0,NULL,'2021-12-19 21:19:30',NULL,NULL),
(274,'Sort Order','MODULE_CONTENT_CHECKOUT_SUCCESS_REDIRECT_OLD_ORDER_SORT_ORDER','500','Sort order of display. Lowest is displayed first.',6,0,NULL,'2021-12-19 21:19:30',NULL,NULL),
(281,'Enable Login Form Module','MODULE_CONTENT_LOGIN_FORM_STATUS','True','Do you want to enable the login form module?',6,1,NULL,'2021-12-19 21:19:30',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(282,'Content Width','MODULE_CONTENT_LOGIN_FORM_CONTENT_WIDTH','Half','Should the content be shown in a full or half width container?',6,1,NULL,'2021-12-19 21:19:30',NULL,'tep_cfg_select_option(array(\'Full\', \'Half\'), '),
(283,'Sort Order','MODULE_CONTENT_LOGIN_FORM_SORT_ORDER','1000','Sort order of display. Lowest is displayed first.',6,0,NULL,'2021-12-19 21:19:30',NULL,NULL),
(284,'Enable New User Module','MODULE_CONTENT_CREATE_ACCOUNT_LINK_STATUS','True','Do you want to enable the new user module?',6,1,NULL,'2021-12-19 21:19:30',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(285,'Content Width','MODULE_CONTENT_CREATE_ACCOUNT_LINK_CONTENT_WIDTH','Half','Should the content be shown in a full or half width container?',6,1,NULL,'2021-12-19 21:19:30',NULL,'tep_cfg_select_option(array(\'Full\', \'Half\'), '),
(286,'Sort Order','MODULE_CONTENT_CREATE_ACCOUNT_LINK_SORT_ORDER','2000','Sort order of display. Lowest is displayed first.',6,0,NULL,'2021-12-19 21:19:30',NULL,NULL),
(301,'Use CKEditor','USE_CKEDITOR_ADMIN_TEXTAREA','true','Use CKEditor for WYSIWYG editing of textarea fields in admin',1,99,NULL,'2022-01-29 04:24:59',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(302,'Enable Online credit card payment - GP webpay Module','MODULE_PAYMENT_GPWEBPAYGPE_STATUS','True','GPWebPayGpe',6,1,NULL,'2022-01-30 00:43:33',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), '),
(303,'Sort order of display.','MODULE_PAYMENT_GPWEBPAYGPE_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2022-01-30 00:43:33',NULL,NULL),
(304,'Payment Zone','MODULE_PAYMENT_GPWEBPAYGPE_ZONE','0','If a zone is selected, only enable this payment method for that zone.',6,2,NULL,'2022-01-30 00:43:33','zen_get_zone_class_title','zen_cfg_pull_down_zone_classes('),
(305,'Aktivační klíč','MODULE_PAYMENT_GPWEBPAYGPE_ACTIVATIONKEY','28d7-e7d4-c7a6-13','',6,0,NULL,'2022-01-30 00:43:33',NULL,NULL),
(306,'Testovací brána','MODULE_PAYMENT_GPWEBPAYGPE_ISTEST','0','ano .. 1, ne .. 0',6,1,NULL,'2022-01-30 00:43:33',NULL,'zen_cfg_select_option(array (\n  0 => 1,\n  1 => 0,\n), '),
(307,'Číslo obchodníka','MODULE_PAYMENT_GPWEBPAYGPE_MERCHANTNUMBER','2200000568','',6,0,NULL,'2022-01-30 00:43:33',NULL,NULL),
(308,'Soubor privátního klíče obchodníka','MODULE_PAYMENT_GPWEBPAYGPE_PRIVATEKEYFILE','gpwebpay-pvk.key','',6,0,NULL,'2022-01-30 00:43:33',NULL,NULL),
(309,'Heslo privátního klíče obchodníka','MODULE_PAYMENT_GPWEBPAYGPE_PRIVATEKEYPASS','hM9GVBJsQdnjWqSS','',6,0,NULL,'2022-01-30 00:43:33',NULL,NULL),
(310,'Převod peněz','MODULE_PAYMENT_GPWEBPAYGPE_DEPOSITFLAG','1','převést ihned .. 1, pouze předautorizace .. 0',6,1,NULL,'2022-01-30 00:43:33',NULL,'zen_cfg_select_option(array (\n  0 => 1,\n  1 => 0,\n), '),
(311,'Číslo první platby na platební bráně (nastavit na 1000 a pak už neměnit)','MODULE_PAYMENT_GPWEBPAYGPE_GWORDERNUMBEROFFSET','1000','',6,0,NULL,'2022-01-30 00:43:33',NULL,NULL),
(312,'Podporované měny (3-písmené ISO kódy oddělené mezerou, např. \"CZK EUR\")','MODULE_PAYMENT_GPWEBPAYGPE_SUPPORTEDCURRENCIES','CZK','',6,0,NULL,'2022-01-30 00:43:33',NULL,NULL),
(313,'Stav objednávky po úspěšném zaplacení','MODULE_PAYMENT_GPWEBPAYGPE_ORDERSTATUSSUCCESSFULL','108','',6,44,NULL,'2022-01-30 00:43:33','zen_get_order_status_name','zen_cfg_pull_down_order_statuses('),
(326,'Cookie usage consent required','CONSENT_REQUIRED','false','Show cookie-consent form while not accepted',1,22,'2022-02-22 20:50:28','0000-00-00 00:00:00',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(346,'Enable Check/Money Order Module','MODULE_PAYMENT_MONEYORDER_STATUS','True','Do you want to accept Check/Money Order payments?',6,1,NULL,'2022-02-23 21:29:15',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(347,'Make Payable to:','MODULE_PAYMENT_MONEYORDER_PAYTO','6581448002/5500','Who should payments be made payable to?',6,1,NULL,'2022-02-23 21:29:15',NULL,NULL),
(348,'Sort order of display.','MODULE_PAYMENT_MONEYORDER_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2022-02-23 21:29:15',NULL,NULL),
(349,'Payment Zone','MODULE_PAYMENT_MONEYORDER_ZONE','0','If a zone is selected, only enable this payment method for that zone.',6,2,NULL,'2022-02-23 21:29:15','tep_get_zone_class_title','tep_cfg_pull_down_zone_classes('),
(350,'Set Order Status','MODULE_PAYMENT_MONEYORDER_ORDER_STATUS_ID','0','Set the status of orders made with this payment module to this value',6,0,NULL,'2022-02-23 21:29:15','tep_get_order_status_name','tep_cfg_pull_down_order_statuses('),
(356,'Max display Selected Products HomePage','MAX_DISPLAY_PRODUCTS_HP','6','MAX_DISPLAY_PRODUCTS_HP',3,9999,'2022-02-28 22:23:49','2022-02-28 22:23:49',NULL,NULL),
(357,'LISTING_SORT_ORDER','LISTING_SORT_ORDER','products_date_available DESC, products_date_added DESC','LISTING_SORT_ORDER',1,9999,'2022-03-01 16:01:15','2022-03-01 16:01:15',NULL,NULL),
(360,'Lenght of Products Description snippet in listing and HP','PRODUCTS_DESCRIPTION_SNIPPET','200','PRODUCTS_DESCRIPTION_SNIPPET',1,9999,'2022-03-01 16:35:41','2022-03-01 16:29:58',NULL,NULL),
(361,'Current Version','RELATED_PRODUCTS_VERSION_INSTALLED','4.0','This key is used by the SQL install to automatically update your database during upgrades. It is read only.',16,0,NULL,'2022-03-05 20:08:04',NULL,'tep_version_readonly('),
(362,'Display Thumbnail Images','RELATED_PRODUCTS_SHOW_THUMBS','True','Show Product Image',16,1,'2022-03-07 11:43:54','2022-03-05 20:08:04',NULL,'tep_cfg_select_option(array(\'True\', \'False\'),'),
(363,'Display Product Name','RELATED_PRODUCTS_SHOW_NAME','True','Show Product Name',16,2,NULL,'2022-03-05 20:08:04',NULL,'tep_cfg_select_option(array(\'True\', \'False\'),'),
(364,'Display Product Model','RELATED_PRODUCTS_SHOW_MODEL','False','Show Product Model',16,3,NULL,'2022-03-05 20:08:04',NULL,'tep_cfg_select_option(array(\'True\', \'False\'),'),
(365,'Display Price','RELATED_PRODUCTS_SHOW_PRICE','False','Show Product Price',16,4,'2022-03-06 06:02:55','2022-03-05 20:08:04',NULL,'tep_cfg_select_option(array(\'True\', \'False\'),'),
(366,'Display Quantity Available','RELATED_PRODUCTS_SHOW_QUANTITY','False','Show Product Quantity',16,5,NULL,'2022-03-05 20:08:04',NULL,'tep_cfg_select_option(array(\'True\', \'False\'),'),
(367,'Display Buy Now Button','RELATED_PRODUCTS_SHOW_BUY_NOW','False','Show Buy Now Button',16,6,NULL,'2022-03-05 20:08:04',NULL,'tep_cfg_select_option(array(\'True\', \'False\'),'),
(368,'Split Display Into Rows','RELATED_PRODUCTS_USE_ROWS','False','Set this option to True to display Related Products in multiple rows.',16,7,NULL,'2022-03-05 20:08:04',NULL,'tep_cfg_select_option(array(\'True\', \'False\'),'),
(369,'Define Number of Items Per Row','RELATED_PRODUCTS_PER_ROW','3','Maximum number of items to display per row when Split Display Into Rows is set to True.',16,8,NULL,'2022-03-05 20:08:04',NULL,''),
(370,'Define Number of Items to Display','RELATED_PRODUCTS_MAX_DISP','0','Maximum number of Related Products to display. 0 is unlimited.',16,9,NULL,'2022-03-05 20:08:04',NULL,''),
(371,'Use Random Display Order','RELATED_PRODUCTS_RANDOMIZE','False','Adds random sort order to products displayed. Recommended if maximum number of products is set.',16,10,NULL,'2022-03-05 20:08:04',NULL,'tep_cfg_select_option(array(\'True\', \'False\'),'),
(372,'Admin Display: Maximum Rows','RELATED_PRODUCTS_MAX_ROW_LISTS_OPTIONS','10','Sets the maximum number of rows to display per page.',16,11,NULL,'2022-03-05 20:08:04',NULL,''),
(373,'Admin Display: Drop-Down List Maximum Length','RELATED_PRODUCTS_MAX_NAME_LENGTH','25','Sets the maximum length (in characters) of product name displayed in drop-down lists. Enter \'0\' to set this option to false.',16,12,NULL,'2022-03-05 20:08:04',NULL,''),
(374,'Admin Display: Display List Maximum Length','RELATED_PRODUCTS_MAX_DISPLAY_LENGTH','0','Sets the maximum length (in characters) of product name displayed in list. Enter \'0\' to set this option to false.',16,13,NULL,'2022-03-05 20:08:04',NULL,''),
(375,'Admin Display: Use Product Model','RELATED_PRODUCTS_ADMIN_USE_MODEL','False','Uses Product Model in lists. When Product Name is also selected, Product Model is displayed first.',16,14,NULL,'2022-03-05 20:08:04',NULL,'tep_cfg_select_option(array(\'True\', \'False\'),'),
(376,'Admin Display: Use Product Name','RELATED_PRODUCTS_ADMIN_USE_NAME','True','Uses Product Name in lists. When Product Model is also selected, Product Model is displayed first.',16,15,NULL,'2022-03-05 20:08:04',NULL,'tep_cfg_select_option(array(\'True\', \'False\'),'),
(377,'Admin Display: Combine Model and Name separator','RELATED_PRODUCTS_ADMIN_MODEL_SEPARATOR',': ','Enter the characters you would like to separate Model from Name, when using both. Leave empty if only using Model.',16,16,NULL,'2022-03-05 20:08:04',NULL,''),
(378,'Admin Function: Use Delete Confirmation','RELATED_PRODUCTS_CONFIRM_DELETE','True','When set to True, a confirmation box will pop-up when deleting an association. Set to False to Delete without confirmation.',16,17,NULL,'2022-03-05 20:08:04',NULL,'tep_cfg_select_option(array(\'True\', \'False\'),'),
(379,'Admin Function: Combine Insert with Inherit','RELATED_PRODUCTS_INSERT_AND_INHERIT','True','When set to True, clicking on Inherit will also Insert the product association. When False, Inherit works as before.',16,18,NULL,'2022-03-05 20:08:04',NULL,'tep_cfg_select_option(array(\'True\', \'False\'),'),
(380,'Articles category ID','ARTICLES_CATEGORY_ID','2','ARTICLES_CATEGORY_ID',1,9999,'2022-03-06 17:15:04','2022-03-06 17:15:04',NULL,NULL),
(381,'Blog category ID','BLOG_CATEGORY_ID','3','BLOG_CATEGORY_ID',1,9999,'2022-03-06 17:15:41','2022-03-06 17:15:41',NULL,NULL),
(382,'Max display New articles','MAX_DISPLAY_NEW_ARTICLES','3','MAX_DISPLAY_NEW_ARTICLES',3,9999,'2022-03-06 18:24:35','2022-03-06 18:24:35',NULL,NULL),
(383,'Max display New Blog','MAX_DISPLAY_NEW_BLOG','3','MAX_DISPLAY_NEW_BLOG',3,9999,'2022-03-06 20:15:54','2022-03-06 20:15:54',NULL,NULL),
(384,'Enable SEO URLs?','SEO_ENABLED','false','Enable the SEO URLs?  This is a global setting and will turn them off completely.',17,0,'2022-12-07 05:29:19','2022-03-08 18:11:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(385,'Add cPath to product URLs?','SEO_ADD_CID_TO_PRODUCT_URLS','false','This setting will append the cPath to the end of product URLs (i.e. - some-product-p-1.html?cPath=xx).',17,1,'2022-03-08 18:11:42','2022-03-08 18:11:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(386,'Add category parent to product URLs?','SEO_ADD_CPATH_TO_PRODUCT_URLS','true','This setting will append the category parent(s) name to the product URLs (i.e. - parent-some-product-p-1.html).',17,2,'2022-03-08 18:13:11','2022-03-08 18:11:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(387,'Add category parent to begining of URLs?','SEO_ADD_CAT_PARENT','true','This setting will add the category parent(s) name to the beginning of the category URLs (i.e. - parent-category-c-1.html).',17,3,'2022-03-09 13:01:56','2022-03-08 18:11:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(388,'Filter Short Words','SEO_URLS_FILTER_SHORT_WORDS','0','This setting will filter words less than or equal to the value from the URL.',17,4,'2022-03-08 18:13:23','2022-03-08 18:11:42',NULL,NULL),
(389,'Output W3C valid URLs (parameter string)?','SEO_URLS_USE_W3C_VALID','true','This setting will output W3C valid URLs.',17,5,'2022-03-08 18:11:42','2022-03-08 18:11:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(390,'Enable SEO cache to save queries?','USE_SEO_CACHE_GLOBAL','false','This is a global setting and will turn off caching completely.',17,6,'2022-03-08 18:13:44','2022-03-08 18:11:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(391,'Enable product cache?','USE_SEO_CACHE_PRODUCTS','true','This will turn off caching for the products.',17,7,'2022-03-08 18:11:42','2022-03-08 18:11:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(392,'Enable categories cache?','USE_SEO_CACHE_CATEGORIES','true','This will turn off caching for the categories.',17,8,'2022-03-08 18:11:42','2022-03-08 18:11:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(393,'Enable manufacturers cache?','USE_SEO_CACHE_MANUFACTURERS','false','This will turn off caching for the manufacturers.',17,9,'2022-03-08 18:19:35','2022-03-08 18:11:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(394,'Enable Articles Manager Articles cache?','USE_SEO_CACHE_ARTICLES','false','This will turn off caching for the Articles Manager articles.',17,10,'2022-03-08 18:11:42','2022-03-08 18:11:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(395,'Enable Articles Manager Topics cache?','USE_SEO_CACHE_TOPICS','false','This will turn off caching for the Articles Manager topics.',17,11,'2022-03-08 18:11:42','2022-03-08 18:11:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(396,'Enable FAQDesk Categories cache?','USE_SEO_CACHE_FAQDESK_CATEGORIES','false','This will turn off caching for the FAQDesk Category pages.',17,12,'2022-03-08 18:11:42','2022-03-08 18:11:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(397,'Enable Information Pages cache?','USE_SEO_CACHE_INFO_PAGES','false','This will turn off caching for Information Pages.',17,13,'2022-03-08 18:11:42','2022-03-08 18:11:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(398,'Enable Links Manager cache?','USE_SEO_CACHE_LINKS','false','This will turn off caching for the Links Manager category pages.',17,14,'2022-03-08 18:11:42','2022-03-08 18:11:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(399,'Enable NewsDesk Articles cache?','USE_SEO_CACHE_NEWSDESK_ARTICLES','false','This will turn off caching for the NewsDesk Article pages.',17,15,'2022-03-08 18:11:42','2022-03-08 18:11:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(400,'Enable NewsDesk Categories cache?','USE_SEO_CACHE_NEWSDESK_CATEGORIES','false','This will turn off caching for the NewsDesk Category pages.',17,16,'2022-03-08 18:11:42','2022-03-08 18:11:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(401,'Enable Pollbooth cache?','USE_SEO_CACHE_POLLBOOTH','false','This will turn off caching for Pollbooth.',17,17,'2022-03-08 18:11:42','2022-03-08 18:11:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(402,'Enable Page Editor cache?','USE_SEO_CACHE_PAGE_EDITOR','false','This will turn off caching for the Page Editor pages.',17,18,'2022-03-08 18:11:42','2022-03-08 18:11:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(403,'Enable automatic redirects?','USE_SEO_REDIRECT','false','This will activate the automatic redirect code and send 301 headers for old to new URLs.',17,19,'2022-03-22 05:35:08','2022-03-08 18:11:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(404,'Enable use Header Tags SEO as name?','USE_SEO_HEADER_TAGS','false','This will cause the title set in Header Tags SEO to be used instead of the categories or products name.',17,20,'2022-03-08 18:11:42','2022-03-08 18:11:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(405,'Enable performance checker?','USE_SEO_PERFORMANCE_CHECK','false','This will cause the code to track all database queries so that its affect on the speed of the page can be determined. Enabling it will cause a small speed loss.',17,21,'2022-03-08 18:11:43','2022-03-08 18:11:43',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(406,'Choose URL Rewrite Type','SEO_REWRITE_TYPE','Rewrite','Choose which SEO URL format to use.',17,22,'2022-03-08 18:11:43','2022-03-08 18:11:43',NULL,'tep_cfg_select_option(array(\'Rewrite\'),'),
(407,'Enter special character conversions','SEO_CHAR_CONVERT_SET','','This setting will convert characters.<br><br>The format <b>MUST</b> be in the form: <b>char=>conv,char2=>conv2</b>',17,23,'2022-03-08 18:11:43','2022-03-08 18:11:43',NULL,NULL),
(408,'Remove all non-alphanumeric characters?','SEO_REMOVE_ALL_SPEC_CHARS','false','This will remove all non-letters and non-numbers.  This should be handy to remove all special characters with 1 setting.',17,24,'2022-03-08 18:11:43','2022-03-08 18:11:43',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(409,'Reset SEO URLs Cache','SEO_URLS_CACHE_RESET','reset','This will reset the cache data for SEO',17,25,'2022-03-08 18:36:38','2022-03-08 18:11:43','tep_reset_cache_data_seo_urls','tep_cfg_select_option(array(\'reset\', \'false\'),'),
(410,'Uninstall Ultimate SEO','SEO_URLS_DB_UNINSTALL','false','This will delete all of the entries in the configuration table for SEO',17,26,'2022-03-08 18:11:43','2022-03-08 18:11:43','tep_reset_cache_data_seo_urls','tep_cfg_select_option(array(\'uninstall\', \'false\'),'),
(411,'Products canonical type','PRODUCTS_CANONICAL_TYPE','c','Type: c=category (category/product), m=manufacturer (manuf-name/product)',17,17,'2022-03-09 12:58:52','2022-03-09 12:58:52',NULL,NULL),
(429,'COD Fee for Servicepakke','MODULE_ORDER_TOTAL_COD_FEE_SERVICEPAKKE','NO:69','Servicepakke: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,12,NULL,'2022-03-10 01:21:56',NULL,NULL),
(430,'COD Fee for FedEx','MODULE_ORDER_TOTAL_COD_FEE_FEDEX','US:3.00','FedEx: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,12,NULL,'2022-03-10 01:21:56',NULL,NULL),
(433,'Enable Cash On Delivery Module','MODULE_PAYMENT_COD_STATUS','True','Do you want to accept Cash On Delevery payments?',6,1,NULL,'2022-03-10 01:29:05',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(434,'Payment Zone','MODULE_PAYMENT_COD_ZONE','2','If a zone is selected, only enable this payment method for that zone.',6,2,NULL,'2022-03-10 01:29:05','tep_get_zone_class_title','tep_cfg_pull_down_zone_classes('),
(435,'Sort order of display.','MODULE_PAYMENT_COD_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2022-03-10 01:29:05',NULL,NULL),
(436,'Set Order Status','MODULE_PAYMENT_COD_ORDER_STATUS_ID','0','Set the status of orders made with this payment module to this value',6,0,NULL,'2022-03-10 01:29:05','tep_get_order_status_name','tep_cfg_pull_down_order_statuses('),
(437,'Enable Table Method','MODULE_SHIPPING_TABLE_STATUS','True','Do you want to offer table rate shipping?',6,0,NULL,'2022-03-10 01:48:21',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(438,'Shipping Table','MODULE_SHIPPING_TABLE_COST','1150:80,1000000:0','The shipping cost is based on the total cost or weight of items. Example: 25:8.50,50:5.50,etc.. Up to 25 charge 8.50, from there to 50 charge 5.50, etc',6,0,NULL,'2022-03-10 01:48:21',NULL,NULL),
(439,'Table Method','MODULE_SHIPPING_TABLE_MODE','price','The shipping cost is based on the order total or the total weight of the items ordered.',6,0,NULL,'2022-03-10 01:48:21',NULL,'tep_cfg_select_option(array(\'weight\', \'price\'), '),
(440,'Handling Fee','MODULE_SHIPPING_TABLE_HANDLING','0','Handling fee for this shipping method.',6,0,NULL,'2022-03-10 01:48:21',NULL,NULL),
(441,'Tax Class','MODULE_SHIPPING_TABLE_TAX_CLASS','0','Use the following tax class on the shipping fee.',6,0,NULL,'2022-03-10 01:48:21','tep_get_tax_class_title','tep_cfg_pull_down_tax_classes('),
(442,'Shipping Zone','MODULE_SHIPPING_TABLE_ZONE','0','If a zone is selected, only enable this shipping method for that zone.',6,0,NULL,'2022-03-10 01:48:21','tep_get_zone_class_title','tep_cfg_pull_down_zone_classes('),
(443,'Sort Order','MODULE_SHIPPING_TABLE_SORT_ORDER','0','Sort order of display.',6,0,NULL,'2022-03-10 01:48:21',NULL,NULL),
(444,'Default products sort order','DEFAULT_PRODUCTS_SORT_ORDER','products_date_available DESC','8',1,9999,'2022-12-10 08:24:46','2022-03-12 00:47:29',NULL,NULL),
(451,'Display COD','MODULE_ORDER_TOTAL_COD_STATUS','true','Do you want this module to display?',6,1,NULL,'2022-03-13 00:31:32',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(452,'Sort Order','MODULE_ORDER_TOTAL_COD_SORT_ORDER','4','Sort order of display.',6,2,NULL,'2022-03-13 00:31:32',NULL,NULL),
(453,'COD Fee for FLAT','MODULE_ORDER_TOTAL_COD_FEE_FLAT','CZ:40','FLAT: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,3,NULL,'2022-03-13 00:31:32',NULL,NULL),
(454,'COD Fee for ITEM','MODULE_ORDER_TOTAL_COD_FEE_ITEM','AT:3.00,DE:3.58,00:9.99','ITEM: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,4,NULL,'2022-03-13 00:31:32',NULL,NULL),
(455,'COD Fee for TABLE','MODULE_ORDER_TOTAL_COD_FEE_TABLE','CZ:40','TABLE: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,5,NULL,'2022-03-13 00:31:32',NULL,NULL),
(456,'COD Fee for ZASILKOVNA','MODULE_ORDER_TOTAL_COD_FEE_ZAS','CZ:40.00,SK:50,00','ZASILKOVNA: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,11,NULL,'2022-03-13 00:31:32',NULL,NULL),
(457,'COD Fee for UPS','MODULE_ORDER_TOTAL_COD_FEE_UPS','CA:4.50,US:3.00,00:9.99','UPS: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,6,NULL,'2022-03-13 00:31:32',NULL,NULL),
(458,'COD Fee for USPS','MODULE_ORDER_TOTAL_COD_FEE_USPS','CA:4.50,US:3.00,00:9.99','USPS: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,7,NULL,'2022-03-13 00:31:32',NULL,NULL),
(459,'COD Fee for ZONES','MODULE_ORDER_TOTAL_COD_FEE_ZONES','CZ:40','ZONES: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,8,NULL,'2022-03-13 00:31:32',NULL,NULL),
(460,'COD Fee for Austrian Post','MODULE_ORDER_TOTAL_COD_FEE_AP','AT:3.63,00:9.99','Austrian Post: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,9,NULL,'2022-03-13 00:31:32',NULL,NULL),
(461,'COD Fee for German Post','MODULE_ORDER_TOTAL_COD_FEE_DP','DE:3.58,00:9.99','German Post: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,10,NULL,'2022-03-13 00:31:32',NULL,NULL),
(462,'COD Fee for Servicepakke','MODULE_ORDER_TOTAL_COD_FEE_SERVICEPAKKE','NO:69','Servicepakke: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,12,NULL,'2022-03-13 00:31:32',NULL,NULL),
(463,'COD Fee for FedEx','MODULE_ORDER_TOTAL_COD_FEE_FEDEX','US:3.00','FedEx: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,12,NULL,'2022-03-13 00:31:32',NULL,NULL),
(464,'COD Fee for DHL Worldwide','MODULE_ORDER_TOTAL_COD_FEE_DHL','DE:3.58,00:9.99','DHL Worldwide: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,10,NULL,'2022-03-13 00:31:32',NULL,NULL),
(465,'Tax Class','MODULE_ORDER_TOTAL_COD_TAX_CLASS','0','Use the following tax class on the COD fee.',6,11,NULL,'2022-03-13 00:31:32','tep_get_tax_class_title','tep_cfg_pull_down_tax_classes('),
(466,'CONFIG_TITLE_COMISSION_PERCENTAGE','COMISSION_PERCENTAGE','0','CONFIG_DESCRIPTION_COMISSION_PERCENTAGE',1,99,NULL,'2022-03-20 01:11:01',NULL,NULL),
(467,'Webmaster email','WEBMASTER_EMAIL_ADDRESS','f@simonformanek.cz','Enter webmaster email needed for security warnings',1,9999,'2023-01-26 06:01:13','2022-03-22 01:18:56',NULL,NULL),
(468,'Default insert: Article or Product','IS_ARTICLE','0','Default insert for table products:0= Product,1=Article',1,9999,'2022-04-07 19:11:39','2022-04-07 19:11:39',NULL,NULL),
(469,'Must accept when registering','MATC_AT_REGISTER','false','<b>If true</b>, the customer must accept the Terms &amp; Conditions <b>when registrating</b>.',73,1,'2022-05-18 03:57:09','2022-05-18 03:19:33',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(470,'Must accept at checkout','MATC_AT_CHECKOUT','true','<b>If true</b>, the customer must accept the Terms &amp; Conditions <b>at the order confirmation</b>.',73,2,'2022-05-18 03:57:21','2022-05-18 03:19:33',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(471,'Link - Show?','MATC_SHOW_LINK','true','<b>If true</b>, a link to the Terms &amp; Conditions will be <b>displayed</b> next to the checkbox.',73,3,NULL,'2022-05-18 03:19:33',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(472,'Link - Filename','MATC_FILENAME','/info/obchodni-podminky/','This is the filename of the terms and conditions. <br><br><b>Example:</b> <i>conditions.php</i>',73,4,'2022-05-18 03:57:54','2022-05-18 03:19:33',NULL,''),
(473,'Link - Parameters','MATC_PARAMETERS','','This is the parameters to use together with the filename in the URL. This will need to be used only when certain other contributions is installed. <br><br><b>Example:</b> <i>hello=world&foo=bar</i>',73,5,NULL,'2022-05-18 03:19:33',NULL,''),
(474,'Textarea - Show?','MATC_SHOW_TEXTAREA','false','<b>If true</b>, the Terms &amp; Conditions will be displayed in a <b>textarea at the same page</b>.',73,6,'2022-05-18 03:58:15','2022-05-18 03:19:33',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(475,'Textarea - Languagefile Filename','MATC_TEXTAREA_FILENAME','conditions.php','Pick a languagefile to require. If set to nothing, nothing will be required. <br><br><b>Example:</b> <i>conditions.php</i>',73,7,NULL,'2022-05-18 03:19:33',NULL,''),
(476,'Textarea - Mode (How to get the contents)','MATC_TEXTAREA_MODE','Returning code','Returning code will be \"php-evaluated\" and should return the text. SQL should be a string and have the text aliased to \"thetext\".<br><br><b>Default:</b> <i>Returning code</i>',73,8,NULL,'2022-05-18 03:19:33',NULL,'tep_cfg_select_option(array(\'Returning code\', \'SQL\'), '),
(477,'Textarea - Returning Code','MATC_TEXTAREA_RETURNING_CODE','TEXT_INFORMATION','A <b>pice of code which returns</b> the contents of the textarea. This can for example be a definition that you loaded from the languagefile.<br><br><b>Example:</b> <i>TEXT_INFORMATION</i>',73,9,NULL,'2022-05-18 03:19:33',NULL,''),
(478,'Textarea - SQL','MATC_TEXTAREA_SQL','\"SELECT products_description AS thetext FROM \".TABLE_PRODUCTS_DESCRIPTION.\" WHERE language_id = \".$languages_id.\" AND products_id = 1;\"','SQL should be a string and have the text aliased to \"thetext\".<br><br><b>Example:</b> <i>\"SELECT products_description AS thetext FROM \".TABLE_PRODUCTS_DESCRIPTION.\" WHERE language_id = \".$languages_id.\" AND products_id = 1;\"</i>',73,10,NULL,'2022-05-18 03:19:33',NULL,''),
(479,'Textarea - Use HTML to Plain text convertion tool?','MATC_TEXTAREA_HTML_2_PLAIN_TEXT_CONVERT','true','<b>If true</b>, the loaded text will be converted from html <b>to plain text</b>, using this conversion tool: <a href=\"http://www.chuggnutt.com/html2text.php\" style=\"color:green;\">http://www.chuggnutt.com/html2text.php</a>',73,11,NULL,'2022-05-18 03:19:33',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(480,'Disabled buttonstyle','MATC_BUTTONSTYLE','transparent','<b><i>&quot;transparent&quot;</i></b> will work on all servers but <b><i>&quot;gray&quot;</i></b> requires php version >= 5 ',73,11,NULL,'2022-05-18 03:19:33',NULL,'tep_cfg_select_option(array(\'transparent\', \'gray\'), '),
(486,'Canonical Type','WEB_CANON_TYPE','categ','categ || author',1,9999,'2023-01-13 04:19:00','2023-01-13 04:19:00',NULL,NULL),
(487,'HP_BANNER_STATIC_ID','HP_BANNER_STATIC_ID','235','HP_BANNER_STATIC_ID',1,9999,'2023-01-17 23:17:32','2023-01-17 23:17:32',NULL,NULL),
(488,'Debug:TableBorder','BORDER','0','BORDER',1,9999,'2023-09-18 23:22:47','2023-09-18 23:22:47',NULL,NULL),
(489,'Enable Categories Module','MODULE_BOXES_CATEGORIES_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2023-09-19 02:02:34',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(490,'Content Placement','MODULE_BOXES_CATEGORIES_CONTENT_PLACEMENT','Right Column','Should the module be loaded in the left or right column?',6,1,NULL,'2023-09-19 02:02:34',NULL,'tep_cfg_select_option(array(\'Left Column\', \'Right Column\'), '),
(491,'Sort Order','MODULE_BOXES_CATEGORIES_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2023-09-19 02:02:34',NULL,NULL),
(612,'Tape Timeout','LOGIN_SLEEP_TIMEOUT','1','Waiting for crypto tape.',1,9999,'2024-01-20 23:09:31','2024-01-20 23:09:31',NULL,NULL),
(623,'OTP Password hash str. lenght','OTP10_PASSWORD_HASH_LENGHT','64','OTP10_PASSWORD_HASH_LENGHT',1,9999,'2024-01-21 06:57:05','2024-01-21 06:57:05',NULL,NULL),
(632,'New customers id reserve','NEW_CUSTOMERS_ID_RESERVE','5','Amount of new customers reserve',1,23,NULL,'2024-01-28 09:02:40',NULL,NULL),
(633,'New customers to generate','NEW_CUSTOMERS_ID_TO_GENERATE','10','How much generate new customers IDs?',1,24,NULL,'2024-01-28 09:02:40',NULL,NULL);
/*!40000 ALTER TABLE `configuration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuration_group`
--

DROP TABLE IF EXISTS `configuration_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuration_group` (
  `configuration_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `configuration_group_title` varchar(64) NOT NULL,
  `configuration_group_description` varchar(255) NOT NULL,
  `sort_order` int(5) DEFAULT NULL,
  `visible` int(1) DEFAULT 1,
  PRIMARY KEY (`configuration_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuration_group`
--

LOCK TABLES `configuration_group` WRITE;
/*!40000 ALTER TABLE `configuration_group` DISABLE KEYS */;
INSERT INTO `configuration_group` VALUES
(1,'My Store','General information about my store',1,1),
(2,'Minimum Values','The minimum values for functions / data',2,1),
(3,'Maximum Values','The maximum values for functions / data',3,1),
(4,'Images','Image parameters',4,1),
(5,'Customer Details','Customer account configuration',5,1),
(6,'Module Options','Hidden from configuration',6,0),
(7,'Shipping/Packaging','Shipping options available at my store',7,1),
(8,'Product Listing','Product Listing    configuration options',8,1),
(9,'Stock','Stock configuration options',9,1),
(10,'Logging','Logging configuration options',10,1),
(11,'Cache','Caching configuration options',11,1),
(12,'E-Mail Options','General setting for E-Mail transport and HTML E-Mails',12,1),
(13,'Download','Downloadable products options',13,1),
(14,'GZip Compression','GZip compression options',14,1),
(15,'Sessions','Session options',15,1),
(16,'Related Products','Optional Related Products module',999,1),
(17,'SEO URLs','Options for Ultimate SEO URLs by Chemo',1000,1),
(73,'Terms &amp; Conditions','Configuration options for Terms &amp; Conditions.',72,1);
/*!40000 ALTER TABLE `configuration_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consents`
--

DROP TABLE IF EXISTS `consents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sess_id` varchar(128) NOT NULL DEFAULT '',
  `consent_mask` int(3) NOT NULL DEFAULT 1,
  `create_time` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `counter`
--

DROP TABLE IF EXISTS `counter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `counter` (
  `startdate` char(8) DEFAULT NULL,
  `counter` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `counter_history`
--

DROP TABLE IF EXISTS `counter_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `counter_history` (
  `month` char(8) DEFAULT NULL,
  `counter` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `countries_id` int(11) NOT NULL AUTO_INCREMENT,
  `countries_name` varchar(255) NOT NULL,
  `countries_iso_code_2` char(2) NOT NULL,
  `countries_iso_code_3` char(3) NOT NULL,
  `address_format_id` int(11) NOT NULL,
  PRIMARY KEY (`countries_id`),
  KEY `IDX_COUNTRIES_NAME` (`countries_name`)
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES
(1,'Afghanistan','AF','AFG',1),
(2,'Albania','AL','ALB',1),
(3,'Algeria','DZ','DZA',1),
(4,'American Samoa','AS','ASM',1),
(5,'Andorra','AD','AND',1),
(6,'Angola','AO','AGO',1),
(7,'Anguilla','AI','AIA',1),
(8,'Antarctica','AQ','ATA',1),
(9,'Antigua and Barbuda','AG','ATG',1),
(10,'Argentina','AR','ARG',1),
(11,'Armenia','AM','ARM',1),
(12,'Aruba','AW','ABW',1),
(13,'Australia','AU','AUS',1),
(14,'Austria','AT','AUT',5),
(15,'Azerbaijan','AZ','AZE',1),
(16,'Bahamas','BS','BHS',1),
(17,'Bahrain','BH','BHR',1),
(18,'Bangladesh','BD','BGD',1),
(19,'Barbados','BB','BRB',1),
(20,'Belarus','BY','BLR',1),
(21,'Belgium','BE','BEL',1),
(22,'Belize','BZ','BLZ',1),
(23,'Benin','BJ','BEN',1),
(24,'Bermuda','BM','BMU',1),
(25,'Bhutan','BT','BTN',1),
(26,'Bolivia','BO','BOL',1),
(27,'Bosnia and Herzegowina','BA','BIH',1),
(28,'Botswana','BW','BWA',1),
(29,'Bouvet Island','BV','BVT',1),
(30,'Brazil','BR','BRA',1),
(31,'British Indian Ocean Territory','IO','IOT',1),
(32,'Brunei Darussalam','BN','BRN',1),
(33,'Bulgaria','BG','BGR',1),
(34,'Burkina Faso','BF','BFA',1),
(35,'Burundi','BI','BDI',1),
(36,'Cambodia','KH','KHM',1),
(37,'Cameroon','CM','CMR',1),
(38,'Canada','CA','CAN',1),
(39,'Cape Verde','CV','CPV',1),
(40,'Cayman Islands','KY','CYM',1),
(41,'Central African Republic','CF','CAF',1),
(42,'Chad','TD','TCD',1),
(43,'Chile','CL','CHL',1),
(44,'China','CN','CHN',1),
(45,'Christmas Island','CX','CXR',1),
(46,'Cocos (Keeling) Islands','CC','CCK',1),
(47,'Colombia','CO','COL',1),
(48,'Comoros','KM','COM',1),
(49,'Congo','CG','COG',1),
(50,'Cook Islands','CK','COK',1),
(51,'Costa Rica','CR','CRI',1),
(52,'Cote D\'Ivoire','CI','CIV',1),
(53,'Croatia','HR','HRV',1),
(54,'Cuba','CU','CUB',1),
(55,'Cyprus','CY','CYP',1),
(56,'Czech Republic','CZ','CZE',1),
(57,'Denmark','DK','DNK',1),
(58,'Djibouti','DJ','DJI',1),
(59,'Dominica','DM','DMA',1),
(60,'Dominican Republic','DO','DOM',1),
(61,'East Timor','TP','TMP',1),
(62,'Ecuador','EC','ECU',1),
(63,'Egypt','EG','EGY',1),
(64,'El Salvador','SV','SLV',1),
(65,'Equatorial Guinea','GQ','GNQ',1),
(66,'Eritrea','ER','ERI',1),
(67,'Estonia','EE','EST',1),
(68,'Ethiopia','ET','ETH',1),
(69,'Falkland Islands (Malvinas)','FK','FLK',1),
(70,'Faroe Islands','FO','FRO',1),
(71,'Fiji','FJ','FJI',1),
(72,'Finland','FI','FIN',1),
(73,'France','FR','FRA',1),
(74,'France, Metropolitan','FX','FXX',1),
(75,'French Guiana','GF','GUF',1),
(76,'French Polynesia','PF','PYF',1),
(77,'French Southern Territories','TF','ATF',1),
(78,'Gabon','GA','GAB',1),
(79,'Gambia','GM','GMB',1),
(80,'Georgia','GE','GEO',1),
(81,'Germany','DE','DEU',5),
(82,'Ghana','GH','GHA',1),
(83,'Gibraltar','GI','GIB',1),
(84,'Greece','GR','GRC',1),
(85,'Greenland','GL','GRL',1),
(86,'Grenada','GD','GRD',1),
(87,'Guadeloupe','GP','GLP',1),
(88,'Guam','GU','GUM',1),
(89,'Guatemala','GT','GTM',1),
(90,'Guinea','GN','GIN',1),
(91,'Guinea-bissau','GW','GNB',1),
(92,'Guyana','GY','GUY',1),
(93,'Haiti','HT','HTI',1),
(94,'Heard and Mc Donald Islands','HM','HMD',1),
(95,'Honduras','HN','HND',1),
(96,'Hong Kong','HK','HKG',1),
(97,'Hungary','HU','HUN',1),
(98,'Iceland','IS','ISL',1),
(99,'India','IN','IND',1),
(100,'Indonesia','ID','IDN',1),
(101,'Iran (Islamic Republic of)','IR','IRN',1),
(102,'Iraq','IQ','IRQ',1),
(103,'Ireland','IE','IRL',1),
(104,'Israel','IL','ISR',1),
(105,'Italy','IT','ITA',1),
(106,'Jamaica','JM','JAM',1),
(107,'Japan','JP','JPN',1),
(108,'Jordan','JO','JOR',1),
(109,'Kazakhstan','KZ','KAZ',1),
(110,'Kenya','KE','KEN',1),
(111,'Kiribati','KI','KIR',1),
(112,'Korea, Democratic People\'s Republic of','KP','PRK',1),
(113,'Korea, Republic of','KR','KOR',1),
(114,'Kuwait','KW','KWT',1),
(115,'Kyrgyzstan','KG','KGZ',1),
(116,'Lao People\'s Democratic Republic','LA','LAO',1),
(117,'Latvia','LV','LVA',1),
(118,'Lebanon','LB','LBN',1),
(119,'Lesotho','LS','LSO',1),
(120,'Liberia','LR','LBR',1),
(121,'Libyan Arab Jamahiriya','LY','LBY',1),
(122,'Liechtenstein','LI','LIE',1),
(123,'Lithuania','LT','LTU',1),
(124,'Luxembourg','LU','LUX',1),
(125,'Macau','MO','MAC',1),
(126,'Macedonia, The Former Yugoslav Republic of','MK','MKD',1),
(127,'Madagascar','MG','MDG',1),
(128,'Malawi','MW','MWI',1),
(129,'Malaysia','MY','MYS',1),
(130,'Maldives','MV','MDV',1),
(131,'Mali','ML','MLI',1),
(132,'Malta','MT','MLT',1),
(133,'Marshall Islands','MH','MHL',1),
(134,'Martinique','MQ','MTQ',1),
(135,'Mauritania','MR','MRT',1),
(136,'Mauritius','MU','MUS',1),
(137,'Mayotte','YT','MYT',1),
(138,'Mexico','MX','MEX',1),
(139,'Micronesia, Federated States of','FM','FSM',1),
(140,'Moldova, Republic of','MD','MDA',1),
(141,'Monaco','MC','MCO',1),
(142,'Mongolia','MN','MNG',1),
(143,'Montserrat','MS','MSR',1),
(144,'Morocco','MA','MAR',1),
(145,'Mozambique','MZ','MOZ',1),
(146,'Myanmar','MM','MMR',1),
(147,'Namibia','NA','NAM',1),
(148,'Nauru','NR','NRU',1),
(149,'Nepal','NP','NPL',1),
(150,'Netherlands','NL','NLD',1),
(151,'Netherlands Antilles','AN','ANT',1),
(152,'New Caledonia','NC','NCL',1),
(153,'New Zealand','NZ','NZL',1),
(154,'Nicaragua','NI','NIC',1),
(155,'Niger','NE','NER',1),
(156,'Nigeria','NG','NGA',1),
(157,'Niue','NU','NIU',1),
(158,'Norfolk Island','NF','NFK',1),
(159,'Northern Mariana Islands','MP','MNP',1),
(160,'Norway','NO','NOR',1),
(161,'Oman','OM','OMN',1),
(162,'Pakistan','PK','PAK',1),
(163,'Palau','PW','PLW',1),
(164,'Panama','PA','PAN',1),
(165,'Papua New Guinea','PG','PNG',1),
(166,'Paraguay','PY','PRY',1),
(167,'Peru','PE','PER',1),
(168,'Philippines','PH','PHL',1),
(169,'Pitcairn','PN','PCN',1),
(170,'Poland','PL','POL',1),
(171,'Portugal','PT','PRT',1),
(172,'Puerto Rico','PR','PRI',1),
(173,'Qatar','QA','QAT',1),
(174,'Reunion','RE','REU',1),
(175,'Romania','RO','ROM',1),
(176,'Russian Federation','RU','RUS',1),
(177,'Rwanda','RW','RWA',1),
(178,'Saint Kitts and Nevis','KN','KNA',1),
(179,'Saint Lucia','LC','LCA',1),
(180,'Saint Vincent and the Grenadines','VC','VCT',1),
(181,'Samoa','WS','WSM',1),
(182,'San Marino','SM','SMR',1),
(183,'Sao Tome and Principe','ST','STP',1),
(184,'Saudi Arabia','SA','SAU',1),
(185,'Senegal','SN','SEN',1),
(186,'Seychelles','SC','SYC',1),
(187,'Sierra Leone','SL','SLE',1),
(188,'Singapore','SG','SGP',4),
(189,'Slovakia (Slovak Republic)','SK','SVK',1),
(190,'Slovenia','SI','SVN',1),
(191,'Solomon Islands','SB','SLB',1),
(192,'Somalia','SO','SOM',1),
(193,'South Africa','ZA','ZAF',1),
(194,'South Georgia and the South Sandwich Islands','GS','SGS',1),
(195,'Spain','ES','ESP',3),
(196,'Sri Lanka','LK','LKA',1),
(197,'St. Helena','SH','SHN',1),
(198,'St. Pierre and Miquelon','PM','SPM',1),
(199,'Sudan','SD','SDN',1),
(200,'Suriname','SR','SUR',1),
(201,'Svalbard and Jan Mayen Islands','SJ','SJM',1),
(202,'Swaziland','SZ','SWZ',1),
(203,'Sweden','SE','SWE',1),
(204,'Switzerland','CH','CHE',1),
(205,'Syrian Arab Republic','SY','SYR',1),
(206,'Taiwan','TW','TWN',1),
(207,'Tajikistan','TJ','TJK',1),
(208,'Tanzania, United Republic of','TZ','TZA',1),
(209,'Thailand','TH','THA',1),
(210,'Togo','TG','TGO',1),
(211,'Tokelau','TK','TKL',1),
(212,'Tonga','TO','TON',1),
(213,'Trinidad and Tobago','TT','TTO',1),
(214,'Tunisia','TN','TUN',1),
(215,'Turkey','TR','TUR',1),
(216,'Turkmenistan','TM','TKM',1),
(217,'Turks and Caicos Islands','TC','TCA',1),
(218,'Tuvalu','TV','TUV',1),
(219,'Uganda','UG','UGA',1),
(220,'Ukraine','UA','UKR',1),
(221,'United Arab Emirates','AE','ARE',1),
(222,'United Kingdom','GB','GBR',1),
(223,'United States','US','USA',2),
(224,'United States Minor Outlying Islands','UM','UMI',1),
(225,'Uruguay','UY','URY',1),
(226,'Uzbekistan','UZ','UZB',1),
(227,'Vanuatu','VU','VUT',1),
(228,'Vatican City State (Holy See)','VA','VAT',1),
(229,'Venezuela','VE','VEN',1),
(230,'Viet Nam','VN','VNM',1),
(231,'Virgin Islands (British)','VG','VGB',1),
(232,'Virgin Islands (U.S.)','VI','VIR',1),
(233,'Wallis and Futuna Islands','WF','WLF',1),
(234,'Western Sahara','EH','ESH',1),
(235,'Yemen','YE','YEM',1),
(236,'Yugoslavia','YU','YUG',1),
(237,'Zaire','ZR','ZAR',1),
(238,'Zambia','ZM','ZMB',1),
(239,'Zimbabwe','ZW','ZWE',1);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

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
(175,'nav > ul','float:right;background:black;padding:1em 1em 1em 0;margin-left:2em',0,0,0,'',NULL,NULL,1,0),
(177,'ul:first-of-type li','list-style-type: none;padding:0;',0,0,0,'','','',1,0),
(178,'body > table:nth-of-type(1) td','padding:0 2em',0,0,0,'','','',1,0),
(183,'hr','border-top:1px solid black;z-index:10;width:110%;left:-5%;position:relative',0,0,0,'','','',1,0),
(184,'ul:first-of-type li a:link','text-decoration:none;color:white',0,0,0,'','','',1,0),
(185,'ul:first-of-type li a:visited','text-decoration:none;color:#ccc',0,0,0,'','','',1,0),
(186,'form:first-of-type','display:inline',0,0,0,'','','',1,0);
/*!40000 ALTER TABLE `css` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `css_old`
--

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currencies` (
  `currencies_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `code` char(3) NOT NULL,
  `symbol_left` varchar(12) DEFAULT NULL,
  `symbol_right` varchar(12) DEFAULT NULL,
  `decimal_point` char(1) DEFAULT NULL,
  `thousands_point` char(1) DEFAULT NULL,
  `decimal_places` char(1) DEFAULT NULL,
  `value` float(13,8) DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`currencies_id`),
  KEY `idx_currencies_code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES
(3,'Česká koruna','CZK','','Kč',',','.','0',1.00000000,NULL);
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!50001 DROP VIEW IF EXISTS `customers`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `customers` AS SELECT
 1 AS `customers_id`,
  1 AS `customers_gender`,
  1 AS `customers_firstname`,
  1 AS `customers_lastname`,
  1 AS `customers_dob`,
  1 AS `customers_email_address`,
  1 AS `customers_email_hash`,
  1 AS `customers_default_address_id`,
  1 AS `customers_telephone`,
  1 AS `customers_fax`,
  1 AS `customers_password`,
  1 AS `customers_newsletter` */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `customers_basket`
--

DROP TABLE IF EXISTS `customers_basket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers_basket` (
  `customers_basket_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `products_id` tinytext NOT NULL,
  `customers_basket_quantity` int(2) NOT NULL,
  `final_price` decimal(15,4) DEFAULT NULL,
  `customers_basket_date_added` char(8) DEFAULT NULL,
  PRIMARY KEY (`customers_basket_id`),
  KEY `idx_customers_basket_customers_id` (`customers_id`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers_basket`
--

LOCK TABLES `customers_basket` WRITE;
/*!40000 ALTER TABLE `customers_basket` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers_basket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers_basket_attributes`
--

DROP TABLE IF EXISTS `customers_basket_attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers_basket_attributes` (
  `customers_basket_attributes_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `products_id` tinytext NOT NULL,
  `products_options_id` int(11) NOT NULL,
  `products_options_value_id` int(11) NOT NULL,
  PRIMARY KEY (`customers_basket_attributes_id`),
  KEY `idx_customers_basket_att_customers_id` (`customers_id`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `customers_info`
--

DROP TABLE IF EXISTS `customers_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers_info` (
  `customers_info_id` int(11) NOT NULL,
  `customers_info_date_of_last_logon` datetime DEFAULT NULL,
  `customers_info_number_of_logons` int(5) DEFAULT NULL,
  `customers_info_date_account_created` datetime DEFAULT NULL,
  `customers_info_date_account_last_modified` datetime DEFAULT NULL,
  `global_product_notifications` int(1) DEFAULT 0,
  `password_reset_key` char(40) DEFAULT NULL,
  `password_reset_date` datetime DEFAULT NULL,
  PRIMARY KEY (`customers_info_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `customers_real`
--

DROP TABLE IF EXISTS `customers_real`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers_real` (
  `customers_id` int(11) NOT NULL,
  `customers_status` tinyint(4) DEFAULT 0 COMMENT '0=not active yet, 1=active, 2=to be deleted PWA, 3=user demand to be deleted, 8=deleted from client and admin, 9=deleted and fully anonymized',
  `customers_gender` char(1) DEFAULT NULL,
  `customers_firstname` text DEFAULT NULL,
  `customers_lastname` text DEFAULT NULL,
  `customers_dob` text DEFAULT NULL,
  `customers_email_address` text DEFAULT NULL,
  `customers_email_hash` text DEFAULT NULL,
  `customers_default_address_id` int(11) DEFAULT NULL,
  `customers_telephone` text DEFAULT NULL,
  `customers_fax` text DEFAULT NULL,
  `customers_password` varchar(60) NOT NULL,
  `customers_newsletter` char(1) DEFAULT NULL,
  `mmstatus` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`customers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `customers_searches`
--

DROP TABLE IF EXISTS `customers_searches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers_searches` (
  `search` varchar(255) DEFAULT NULL,
  `language_id` int(11) unsigned DEFAULT NULL,
  `freq` int(10) unsigned DEFAULT 0,
  `search_id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`search_id`),
  KEY `lang` (`language_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers_searches`
--

LOCK TABLES `customers_searches` WRITE;
/*!40000 ALTER TABLE `customers_searches` DISABLE KEYS */;
INSERT INTO `customers_searches` VALUES
('kniha',2,3,1),
('foucault',2,1,2),
('x',2,1,3),
('2018',2,3,4),
('2018',3,2,5);
/*!40000 ALTER TABLE `customers_searches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `geo_zones`
--

DROP TABLE IF EXISTS `geo_zones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `geo_zones` (
  `geo_zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `geo_zone_name` varchar(32) NOT NULL,
  `geo_zone_description` varchar(255) NOT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`geo_zone_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `geo_zones`
--

LOCK TABLES `geo_zones` WRITE;
/*!40000 ALTER TABLE `geo_zones` DISABLE KEYS */;
INSERT INTO `geo_zones` VALUES
(1,'EU','','2015-12-19 14:54:46','2015-12-19 14:54:46'),
(2,'ČR','Česká republika',NULL,'2017-12-10 03:46:29');
/*!40000 ALTER TABLE `geo_zones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages` (
  `languages_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `code` char(2) NOT NULL,
  `image` varchar(64) DEFAULT NULL,
  `directory` varchar(32) DEFAULT NULL,
  `sort_order` int(3) DEFAULT NULL,
  PRIMARY KEY (`languages_id`),
  KEY `IDX_LANGUAGES_NAME` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES
(3,'english','en','icon.gif','english',2),
(5,'czech','cs','icon.gif','czech',1);
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `last_empty_customers_id`
--

DROP TABLE IF EXISTS `last_empty_customers_id`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `last_empty_customers_id` (
  `customers_id` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;



--
-- Table structure for table `manufacturers`
--

DROP TABLE IF EXISTS `manufacturers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manufacturers` (
  `manufacturers_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `manufacturers_name` varchar(255) DEFAULT NULL,
  `manufacturers_status` int(1) NOT NULL DEFAULT 1,
  `manufacturers_email` varchar(64) NOT NULL DEFAULT '',
  `manufacturers_image` varchar(64) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `special_flags` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`manufacturers_id`),
  KEY `IDX_MANUFACTURERS_NAME` (`manufacturers_name`)
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `manufacturers_info`
--

DROP TABLE IF EXISTS `manufacturers_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manufacturers_info` (
  `manufacturers_id` int(11) NOT NULL,
  `languages_id` int(11) NOT NULL,
  `manufacturers_url` varchar(255) NOT NULL,
  `url_clicked` int(5) NOT NULL DEFAULT 0,
  `date_last_click` datetime DEFAULT NULL,
  PRIMARY KEY (`manufacturers_id`,`languages_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `new_customer_id`
--

DROP TABLE IF EXISTS `new_customer_id`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `new_customer_id` (
  `customers_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` tinyint(4) NOT NULL,
  PRIMARY KEY (`customers_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `newsletters`
--

DROP TABLE IF EXISTS `newsletters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletters` (
  `newsletters_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `module` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_sent` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `locked` int(1) DEFAULT 0,
  PRIMARY KEY (`newsletters_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!50001 DROP VIEW IF EXISTS `orders`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `orders` AS SELECT
 1 AS `orders_id`,
  1 AS `customers_id`,
  1 AS `customers_name`,
  1 AS `customers_company`,
  1 AS `customers_company_number`,
  1 AS `customers_vat_number`,
  1 AS `customers_street_address`,
  1 AS `customers_suburb`,
  1 AS `customers_city`,
  1 AS `customers_postcode`,
  1 AS `customers_state`,
  1 AS `customers_country`,
  1 AS `customers_telephone`,
  1 AS `customers_email_address`,
  1 AS `customers_address_format_id`,
  1 AS `delivery_name`,
  1 AS `delivery_company`,
  1 AS `delivery_company_number`,
  1 AS `delivery_vat_number`,
  1 AS `delivery_street_address`,
  1 AS `delivery_suburb`,
  1 AS `delivery_city`,
  1 AS `delivery_postcode`,
  1 AS `delivery_state`,
  1 AS `delivery_country`,
  1 AS `delivery_address_format_id`,
  1 AS `billing_name`,
  1 AS `billing_company`,
  1 AS `billing_company_number`,
  1 AS `billing_vat_number`,
  1 AS `billing_street_address`,
  1 AS `billing_suburb`,
  1 AS `billing_city`,
  1 AS `billing_postcode`,
  1 AS `billing_state`,
  1 AS `billing_country`,
  1 AS `billing_address_format_id`,
  1 AS `payment_method`,
  1 AS `cc_type`,
  1 AS `cc_owner`,
  1 AS `cc_number`,
  1 AS `cc_expires`,
  1 AS `last_modified`,
  1 AS `date_purchased`,
  1 AS `orders_status`,
  1 AS `orders_date_finished`,
  1 AS `currency`,
  1 AS `currency_value`,
  1 AS `customer_service_id`,
  1 AS `shipping_module` */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `orders_products`
--

DROP TABLE IF EXISTS `orders_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_products` (
  `orders_products_id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `products_model` varchar(12) DEFAULT NULL,
  `products_name` varchar(64) NOT NULL,
  `products_price` decimal(15,4) NOT NULL,
  `final_price` decimal(15,4) NOT NULL,
  `products_tax` decimal(7,4) NOT NULL,
  `products_quantity` int(2) NOT NULL,
  PRIMARY KEY (`orders_products_id`),
  KEY `idx_orders_products_orders_id` (`orders_id`),
  KEY `idx_orders_products_products_id` (`products_id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `orders_products_attributes`
--

DROP TABLE IF EXISTS `orders_products_attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_products_attributes` (
  `orders_products_attributes_id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL,
  `orders_products_id` int(11) NOT NULL,
  `products_options` varchar(32) NOT NULL,
  `products_options_values` varchar(32) NOT NULL,
  `products_options_id` int(11) NOT NULL DEFAULT 0,
  `products_options_values_id` int(11) NOT NULL DEFAULT 0,
  `options_values_price` decimal(15,4) NOT NULL,
  `options_values_price_spec` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `options_values_tax_rate` int(2) NOT NULL DEFAULT 0,
  `options_values_tax_title` varchar(32) NOT NULL DEFAULT '',
  `price_prefix` char(1) NOT NULL,
  PRIMARY KEY (`orders_products_attributes_id`),
  KEY `idx_orders_products_att_orders_id` (`orders_id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `orders_products_download`
--

DROP TABLE IF EXISTS `orders_products_download`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_products_download` (
  `orders_products_download_id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL DEFAULT 0,
  `orders_products_id` int(11) NOT NULL DEFAULT 0,
  `orders_products_filename` varchar(255) NOT NULL DEFAULT '',
  `download_maxdays` int(2) NOT NULL DEFAULT 0,
  `download_count` int(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`orders_products_download_id`),
  KEY `idx_orders_products_download_orders_id` (`orders_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `orders_real`
--

DROP TABLE IF EXISTS `orders_real`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_real` (
  `orders_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `customers_name` text DEFAULT NULL,
  `customers_company` text DEFAULT NULL,
  `customers_company_number` text DEFAULT NULL,
  `customers_vat_number` text DEFAULT NULL,
  `customers_street_address` text DEFAULT NULL,
  `customers_suburb` text DEFAULT NULL,
  `customers_city` text DEFAULT NULL,
  `customers_postcode` text DEFAULT NULL,
  `customers_state` varchar(255) DEFAULT NULL,
  `customers_country` varchar(255) NOT NULL,
  `customers_telephone` text DEFAULT NULL,
  `customers_email_address` varchar(255) NOT NULL,
  `customers_address_format_id` int(5) NOT NULL,
  `delivery_name` text DEFAULT NULL,
  `delivery_company` text DEFAULT NULL,
  `delivery_company_number` text DEFAULT NULL,
  `delivery_vat_number` text DEFAULT NULL,
  `delivery_street_address` text DEFAULT NULL,
  `delivery_suburb` text DEFAULT NULL,
  `delivery_city` text DEFAULT NULL,
  `delivery_postcode` text DEFAULT NULL,
  `delivery_state` varchar(255) DEFAULT NULL,
  `delivery_country` varchar(255) NOT NULL,
  `delivery_address_format_id` int(5) NOT NULL,
  `billing_name` text DEFAULT NULL,
  `billing_company` text DEFAULT NULL,
  `billing_company_number` text DEFAULT NULL,
  `billing_vat_number` text DEFAULT NULL,
  `billing_street_address` text DEFAULT NULL,
  `billing_suburb` text DEFAULT NULL,
  `billing_city` text DEFAULT NULL,
  `billing_postcode` text DEFAULT NULL,
  `billing_state` varchar(255) DEFAULT NULL,
  `billing_country` varchar(255) NOT NULL,
  `billing_address_format_id` int(5) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `cc_type` text DEFAULT NULL,
  `cc_owner` text DEFAULT NULL,
  `cc_number` text DEFAULT NULL,
  `cc_expires` text DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_purchased` datetime DEFAULT NULL,
  `orders_status` int(5) NOT NULL,
  `orders_date_finished` datetime DEFAULT NULL,
  `currency` char(3) DEFAULT NULL,
  `currency_value` decimal(14,6) DEFAULT NULL,
  `customer_service_id` varchar(15) DEFAULT NULL,
  `shipping_module` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`orders_id`),
  KEY `idx_orders_customers_id` (`customers_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `orders_status`
--

DROP TABLE IF EXISTS `orders_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_status` (
  `orders_status_id` int(11) NOT NULL DEFAULT 0,
  `language_id` int(11) NOT NULL DEFAULT 1,
  `orders_status_name` varchar(64) DEFAULT NULL,
  `public_flag` int(11) DEFAULT 1,
  `downloads_flag` int(11) DEFAULT 0,
  PRIMARY KEY (`orders_status_id`,`language_id`),
  KEY `idx_orders_status_name` (`orders_status_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_status`
--

LOCK TABLES `orders_status` WRITE;
/*!40000 ALTER TABLE `orders_status` DISABLE KEYS */;
INSERT INTO `orders_status` VALUES
(1,3,'Nevyřízená',1,0),
(1,4,'Nevyřízená',1,0),
(1,5,'Nevyřízená',1,0),
(2,3,'Zpracovává se',1,0),
(2,4,'Zpracovává se',1,0),
(2,5,'Zpracovává se',1,0),
(3,3,'Zrušená',1,0),
(3,4,'Zrušená',1,0),
(3,5,'Zrušená',1,0),
(4,3,'Čeká na připsání platby',1,0),
(4,4,'Čeká na připsání platby',1,0),
(4,5,'Čeká na připsání platby',1,0),
(5,3,'Připraveno k vyzvednutí [os. odběr]',1,0),
(5,4,'Připraveno k vyzvednutí [os. odběr]',1,0),
(5,5,'Připraveno k vyzvednutí [os. odběr]',1,0),
(9,3,'Osobní odběr',1,0),
(9,4,'Osobní odběr',1,0),
(9,5,'Osobní odběr',1,0),
(10,3,'Odesláno [Platba předem]',1,0),
(10,4,'Odesláno [Platba předem]',1,0),
(10,5,'Odesláno [Platba předem]',1,0),
(11,3,'Zaplaceno v hotovosti [os. odběr]',1,0),
(11,4,'Zaplaceno v hotovosti [os. odběr]',1,0),
(11,5,'Zaplaceno v hotovosti [os. odběr]',1,0),
(12,3,'Odesláno [Platba na fakturu]',1,0),
(12,4,'Odesláno [Platba na fakturu]',1,0),
(12,5,'Odesláno [Platba na fakturu]',1,0),
(101,3,'Vyřízená',1,0),
(101,4,'Vyřízená',1,0),
(101,5,'Vyřízená',1,0),
(108,3,'Zaplaceno kartou',1,0),
(108,4,'Zaplaceno kartou',1,0),
(108,5,'Zaplaceno kartou',1,0),
(109,3,'[gpwebpay ERR] neznámá chyba OSC modulu',1,0),
(109,4,'[gpwebpay ERR] neznámá chyba OSC modulu',1,0),
(109,5,'[gpwebpay ERR] neznámá chyba OSC modulu',1,0),
(110,3,'[gpwebpay ERR] 35 Session Expired',1,0),
(110,4,'[gpwebpay ERR] 35 Session Expired',1,0),
(110,5,'[gpwebpay ERR] 35 Session Expired',1,0),
(111,3,'[gpwebpay ERR] 17 Částka překročena',1,0),
(111,4,'[gpwebpay ERR] 17 Částka překročena',1,0),
(111,5,'[gpwebpay ERR] 17 Částka překročena',1,0),
(112,3,'[gpwebpay ERR] 1000 Technický problém',1,0),
(112,4,'[gpwebpay ERR] 1000 Technický problém',1,0),
(112,5,'[gpwebpay ERR] 1000 Technický problém',1,0),
(113,3,'[gpwebpay ERR] 50 zrušeno vlastníkem',1,0),
(113,4,'[gpwebpay ERR] 50 zrušeno vlastníkem',1,0),
(113,5,'[gpwebpay ERR] 50 zrušeno vlastníkem',1,0),
(114,3,'Zaplaceno převodem',1,0),
(114,4,'Zaplaceno převodem',1,0),
(114,5,'Zaplaceno převodem',1,0),
(115,3,'Authorize.net [Transactions]',1,0),
(115,4,'Authorize.net [Transactions]',1,0),
(115,5,'Authorize.net [Transactions]',1,0);
/*!40000 ALTER TABLE `orders_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_status_history`
--

DROP TABLE IF EXISTS `orders_status_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_status_history` (
  `orders_status_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL,
  `orders_status_id` int(5) NOT NULL,
  `date_added` datetime NOT NULL,
  `customer_notified` int(1) DEFAULT 0,
  `comments` text DEFAULT NULL,
  PRIMARY KEY (`orders_status_history_id`),
  KEY `idx_orders_status_history_orders_id` (`orders_id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `orders_total`
--

DROP TABLE IF EXISTS `orders_total`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_total` (
  `orders_total_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `value` decimal(15,4) NOT NULL,
  `class` varchar(32) NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`orders_total_id`),
  KEY `idx_orders_total_orders_id` (`orders_id`)
) ENGINE=InnoDB AUTO_INCREMENT=257 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `phpids_intrusions`
--

DROP TABLE IF EXISTS `phpids_intrusions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpids_intrusions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `value` text NOT NULL,
  `page` varchar(255) NOT NULL,
  `tags` varchar(128) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `ip2` varchar(15) NOT NULL,
  `impact` int(11) NOT NULL,
  `origin` varchar(15) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=649009 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='PHPIDS Log';
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `products_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_quantity` int(4) NOT NULL,
  `products_model` varchar(255) DEFAULT NULL,
  `products_image` varchar(255) DEFAULT NULL,
  `products_price` decimal(15,4) NOT NULL,
  `products_date_added` datetime NOT NULL,
  `products_last_modified` datetime DEFAULT NULL,
  `products_date_available` datetime NOT NULL DEFAULT current_timestamp(),
  `products_weight` decimal(5,2) NOT NULL,
  `products_status` tinyint(1) NOT NULL,
  `products_tax_class_id` int(11) NOT NULL,
  `manufacturers_id` int(11) DEFAULT NULL,
  `authors_id` int(11) NOT NULL DEFAULT 0,
  `products_ordered` int(11) NOT NULL DEFAULT 0,
  `products_gtin` char(14) DEFAULT NULL,
  `products_ebook` tinyint(1) NOT NULL DEFAULT 0,
  `products_sort_order` int(9) NOT NULL DEFAULT 0,
  `sort_order_new_products` int(5) NOT NULL DEFAULT 0,
  `products_hp` tinyint(1) NOT NULL DEFAULT 0,
  `original_language` varchar(32) NOT NULL DEFAULT '',
  `original_publisher` varchar(64) NOT NULL DEFAULT '',
  `original_year` int(4) NOT NULL DEFAULT 0,
  `translators_name` varchar(128) NOT NULL DEFAULT '',
  `version` int(4) NOT NULL DEFAULT 0,
  `is_article` int(1) NOT NULL DEFAULT 0,
  `contributor` varchar(255) DEFAULT NULL,
  `creator_opfrole_aft` varchar(255) NOT NULL DEFAULT '',
  `creator_opfrole_bkd` varchar(255) NOT NULL DEFAULT '',
  `creator_opfrole_cov` varchar(255) NOT NULL DEFAULT '',
  `creator_opfrole_trl` varchar(255) NOT NULL DEFAULT '',
  `rights` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(255) NOT NULL DEFAULT '',
  `products_web_mask` int(2) NOT NULL DEFAULT 1,
  `sort_order` int(6) DEFAULT NULL,
  PRIMARY KEY (`products_id`),
  KEY `idx_products_model` (`products_model`),
  KEY `idx_products_date_added` (`products_date_added`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `products_attributes`
--

DROP TABLE IF EXISTS `products_attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_attributes` (
  `products_attributes_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL,
  `options_id` int(11) NOT NULL,
  `options_values_id` int(11) NOT NULL,
  `options_values_price` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `options_values_tax_id` int(3) DEFAULT NULL,
  `options_values_price_spec` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `price_prefix` char(1) NOT NULL,
  `options_values_quantity` int(4) DEFAULT NULL,
  `options_values_isbn` varchar(32) NOT NULL DEFAULT '',
  `options_values_subscript_id` int(11) NOT NULL DEFAULT 0,
  `sort_order` int(6) DEFAULT NULL,
  `options_values_active` int(1) DEFAULT 1,
  `options_values_nobuy` int(1) DEFAULT 0,
  `options_values_year` int(4) NOT NULL DEFAULT 0,
  `options_values_page` int(4) NOT NULL DEFAULT 0,
  `options_values_bind` varchar(16) NOT NULL DEFAULT '',
  `options_values_format` varchar(16) NOT NULL DEFAULT '',
  `options_values_saled` int(11) NOT NULL DEFAULT 0,
  `options_values_weight` decimal(5,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`products_attributes_id`),
  KEY `idx_products_attributes_products_id` (`products_id`)
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `products_attributes_download`
--

DROP TABLE IF EXISTS `products_attributes_download`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_attributes_download` (
  `products_attributes_id` int(11) NOT NULL,
  `products_attributes_filename` varchar(255) NOT NULL DEFAULT '',
  `products_attributes_maxdays` int(2) DEFAULT 0,
  `products_attributes_maxcount` int(2) DEFAULT 0,
  PRIMARY KEY (`products_attributes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `products_description`
--

DROP TABLE IF EXISTS `products_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_description` (
  `products_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL DEFAULT 1,
  `products_name` varchar(255) DEFAULT NULL,
  `products_description` text DEFAULT NULL,
  `products_url` varchar(255) DEFAULT NULL,
  `products_viewed` int(5) DEFAULT 0,
  `products_seo_description` varchar(255) DEFAULT NULL,
  `products_seo_keywords` varchar(255) DEFAULT NULL,
  `products_seo_title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`products_id`,`language_id`),
  KEY `products_name` (`products_name`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `products_images`
--

DROP TABLE IF EXISTS `products_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL,
  `image` varchar(256) NOT NULL DEFAULT '',
  `htmlcontent` text DEFAULT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `products_images_prodid` (`products_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `products_notifications`
--

DROP TABLE IF EXISTS `products_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_notifications` (
  `products_id` int(11) NOT NULL,
  `customers_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`products_id`,`customers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_notifications`
--

LOCK TABLES `products_notifications` WRITE;
/*!40000 ALTER TABLE `products_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_options`
--

DROP TABLE IF EXISTS `products_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_options` (
  `products_options_id` int(11) NOT NULL DEFAULT 0,
  `language_id` int(11) NOT NULL DEFAULT 1,
  `products_options_name` varchar(255) NOT NULL,
  `sort_order` int(3) DEFAULT NULL,
  PRIMARY KEY (`products_options_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `products_options_values`
--

DROP TABLE IF EXISTS `products_options_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_options_values` (
  `products_options_values_id` int(11) NOT NULL DEFAULT 0,
  `language_id` int(11) NOT NULL DEFAULT 1,
  `products_options_values_name` varchar(255) NOT NULL,
  `sort_order` int(3) DEFAULT NULL,
  PRIMARY KEY (`products_options_values_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `products_options_values_to_products_options`
--

DROP TABLE IF EXISTS `products_options_values_to_products_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_options_values_to_products_options` (
  `products_options_values_to_products_options_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_options_id` int(11) NOT NULL,
  `products_options_values_id` int(11) NOT NULL,
  PRIMARY KEY (`products_options_values_to_products_options_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_options_values_to_products_options`
--

LOCK TABLES `products_options_values_to_products_options` WRITE;
/*!40000 ALTER TABLE `products_options_values_to_products_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_options_values_to_products_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_related_products`
--

DROP TABLE IF EXISTS `products_related_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_related_products` (
  `pop_id` int(11) NOT NULL AUTO_INCREMENT,
  `pop_products_id_master` int(11) NOT NULL DEFAULT 0,
  `pop_products_id_slave` int(11) NOT NULL DEFAULT 0,
  `pop_order_id` smallint(6) NOT NULL DEFAULT 0,
  PRIMARY KEY (`pop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `products_to_categories`
--

DROP TABLE IF EXISTS `products_to_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_to_categories` (
  `products_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `canonical` int(1) DEFAULT NULL,
  `sort_order` int(6) NOT NULL DEFAULT 0,
  PRIMARY KEY (`products_id`,`categories_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `reviews_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL,
  `customers_id` int(11) DEFAULT NULL,
  `customers_name` varchar(255) NOT NULL,
  `reviews_rating` int(1) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `reviews_status` tinyint(1) NOT NULL DEFAULT 0,
  `reviews_read` int(5) NOT NULL DEFAULT 0,
  PRIMARY KEY (`reviews_id`),
  KEY `idx_reviews_products_id` (`products_id`),
  KEY `idx_reviews_customers_id` (`customers_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews_description`
--

DROP TABLE IF EXISTS `reviews_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews_description` (
  `reviews_id` int(11) NOT NULL,
  `languages_id` int(11) NOT NULL,
  `reviews_text` text NOT NULL,
  PRIMARY KEY (`reviews_id`,`languages_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews_description`
--

LOCK TABLES `reviews_description` WRITE;
/*!40000 ALTER TABLE `reviews_description` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviews_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sec_directory_whitelist`
--

DROP TABLE IF EXISTS `sec_directory_whitelist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sec_directory_whitelist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `directory` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sec_directory_whitelist`
--

LOCK TABLES `sec_directory_whitelist` WRITE;
/*!40000 ALTER TABLE `sec_directory_whitelist` DISABLE KEYS */;
/*!40000 ALTER TABLE `sec_directory_whitelist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `sesskey` varchar(128) NOT NULL,
  `expiry` int(11) unsigned NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`sesskey`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `specials`
--

DROP TABLE IF EXISTS `specials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specials` (
  `specials_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL,
  `specials_new_products_price` decimal(15,4) NOT NULL,
  `specials_date_added` datetime DEFAULT NULL,
  `specials_last_modified` datetime DEFAULT NULL,
  `expires_date` datetime DEFAULT NULL,
  `date_status_change` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`specials_id`),
  KEY `idx_specials_products_id` (`products_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specials`
--

LOCK TABLES `specials` WRITE;
/*!40000 ALTER TABLE `specials` DISABLE KEYS */;
/*!40000 ALTER TABLE `specials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tax_class`
--

DROP TABLE IF EXISTS `tax_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tax_class` (
  `tax_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_class_title` varchar(32) NOT NULL,
  `tax_class_description` varchar(255) NOT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`tax_class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tax_class`
--

LOCK TABLES `tax_class` WRITE;
/*!40000 ALTER TABLE `tax_class` DISABLE KEYS */;
INSERT INTO `tax_class` VALUES
(1,'DPH 10%','DPH 10%','2021-01-28 21:36:28','2020-10-24 02:05:03'),
(2,'DPH 15%','DPH 15%','2022-03-04 15:54:55','2021-04-05 20:48:30'),
(3,'DPH 21%','DPH 21%','2022-03-04 15:54:44','2021-04-05 20:51:04'),
(4,'DPH 0%','DPH 0%','2022-03-04 15:56:49','2022-03-04 12:18:06');
/*!40000 ALTER TABLE `tax_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tax_rates`
--

DROP TABLE IF EXISTS `tax_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tax_rates` (
  `tax_rates_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_zone_id` int(11) NOT NULL,
  `tax_class_id` int(11) NOT NULL,
  `tax_priority` int(5) DEFAULT 1,
  `tax_rate` decimal(7,4) NOT NULL,
  `tax_description` varchar(255) NOT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`tax_rates_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tax_rates`
--

LOCK TABLES `tax_rates` WRITE;
/*!40000 ALTER TABLE `tax_rates` DISABLE KEYS */;
INSERT INTO `tax_rates` VALUES
(1,1,1,2,10.0000,'VAT TAX 10%','2022-03-04 12:18:42','2020-10-24 02:05:03'),
(2,1,2,2,15.0000,'VAT TAX 15%','2021-06-22 15:24:31','2021-04-05 20:49:42'),
(3,1,3,3,21.0000,'VAT TAX 21%','2021-06-22 15:24:48','2021-04-05 20:52:34'),
(4,2,4,1,0.0000,'DPH 0%','2022-03-04 15:58:22','2022-03-04 12:16:20');
/*!40000 ALTER TABLE `tax_rates` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `whos_online`
--

DROP TABLE IF EXISTS `whos_online`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `whos_online` (
  `customer_id` int(11) DEFAULT NULL,
  `full_name` text DEFAULT NULL,
  `session_id` varchar(128) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `time_entry` varchar(14) NOT NULL,
  `time_last_click` varchar(14) NOT NULL,
  `last_page_url` text NOT NULL,
  KEY `idx_whos_online_session_id` (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `zasilkovna`
--

--
-- Table structure for table `zones`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=922 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zones`
--

LOCK TABLES `zones` WRITE;
/*!40000 ALTER TABLE `zones` DISABLE KEYS */;
INSERT INTO `zones` VALUES
(1,223,'AL','Alabama'),
(2,223,'AK','Alaska'),
(3,223,'AS','American Samoa'),
(4,223,'AZ','Arizona'),
(5,223,'AR','Arkansas'),
(6,223,'AF','Armed Forces Africa'),
(7,223,'AA','Armed Forces Americas'),
(8,223,'AC','Armed Forces Canada'),
(9,223,'AE','Armed Forces Europe'),
(10,223,'AM','Armed Forces Middle East'),
(11,223,'AP','Armed Forces Pacific'),
(12,223,'CA','California'),
(13,223,'CO','Colorado'),
(14,223,'CT','Connecticut'),
(15,223,'DE','Delaware'),
(16,223,'DC','District of Columbia'),
(17,223,'FM','Federated States Of Micronesia'),
(18,223,'FL','Florida'),
(19,223,'GA','Georgia'),
(20,223,'GU','Guam'),
(21,223,'HI','Hawaii'),
(22,223,'ID','Idaho'),
(23,223,'IL','Illinois'),
(24,223,'IN','Indiana'),
(25,223,'IA','Iowa'),
(26,223,'KS','Kansas'),
(27,223,'KY','Kentucky'),
(28,223,'LA','Louisiana'),
(29,223,'ME','Maine'),
(30,223,'MH','Marshall Islands'),
(31,223,'MD','Maryland'),
(32,223,'MA','Massachusetts'),
(33,223,'MI','Michigan'),
(34,223,'MN','Minnesota'),
(35,223,'MS','Mississippi'),
(36,223,'MO','Missouri'),
(37,223,'MT','Montana'),
(38,223,'NE','Nebraska'),
(39,223,'NV','Nevada'),
(40,223,'NH','New Hampshire'),
(41,223,'NJ','New Jersey'),
(42,223,'NM','New Mexico'),
(43,223,'NY','New York'),
(44,223,'NC','North Carolina'),
(45,223,'ND','North Dakota'),
(46,223,'MP','Northern Mariana Islands'),
(47,223,'OH','Ohio'),
(48,223,'OK','Oklahoma'),
(49,223,'OR','Oregon'),
(50,223,'PW','Palau'),
(51,223,'PA','Pennsylvania'),
(52,223,'PR','Puerto Rico'),
(53,223,'RI','Rhode Island'),
(54,223,'SC','South Carolina'),
(55,223,'SD','South Dakota'),
(56,223,'TN','Tennessee'),
(57,223,'TX','Texas'),
(58,223,'UT','Utah'),
(59,223,'VT','Vermont'),
(60,223,'VI','Virgin Islands'),
(61,223,'VA','Virginia'),
(62,223,'WA','Washington'),
(63,223,'WV','West Virginia'),
(64,223,'WI','Wisconsin'),
(65,223,'WY','Wyoming'),
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

--
-- Table structure for table `zones_to_geo_zones`
--

DROP TABLE IF EXISTS `zones_to_geo_zones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zones_to_geo_zones` (
  `association_id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_country_id` int(11) NOT NULL,
  `zone_id` int(11) DEFAULT NULL,
  `geo_zone_id` int(11) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`association_id`),
  KEY `idx_zones_to_geo_zones_country_id` (`zone_country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zones_to_geo_zones`
--

LOCK TABLES `zones_to_geo_zones` WRITE;
/*!40000 ALTER TABLE `zones_to_geo_zones` DISABLE KEYS */;
INSERT INTO `zones_to_geo_zones` VALUES
(1,14,0,1,NULL,'2015-12-19 14:54:46'),
(2,21,0,1,NULL,'2015-12-19 14:54:46'),
(3,33,0,1,NULL,'2015-12-19 14:54:46'),
(4,53,0,1,NULL,'2015-12-19 14:54:46'),
(5,55,0,1,NULL,'2015-12-19 14:54:46'),
(6,56,0,1,NULL,'2015-12-19 14:54:46'),
(7,57,0,1,NULL,'2015-12-19 14:54:46'),
(8,67,0,1,NULL,'2015-12-19 14:54:46'),
(9,72,0,1,NULL,'2015-12-19 14:54:46'),
(10,73,0,1,NULL,'2015-12-19 14:54:46'),
(11,81,0,1,NULL,'2015-12-19 14:54:46'),
(12,84,0,1,NULL,'2015-12-19 14:54:46'),
(13,97,0,1,NULL,'2015-12-19 14:54:46'),
(14,103,0,1,NULL,'2015-12-19 14:54:46'),
(15,105,0,1,NULL,'2015-12-19 14:54:46'),
(16,117,0,1,NULL,'2015-12-19 14:54:46'),
(17,123,0,1,NULL,'2015-12-19 14:54:46'),
(18,124,0,1,NULL,'2015-12-19 14:54:46'),
(19,132,0,1,NULL,'2015-12-19 14:54:46'),
(20,150,0,1,NULL,'2015-12-19 14:54:46'),
(21,170,0,1,NULL,'2015-12-19 14:54:46'),
(22,171,0,1,NULL,'2015-12-19 14:54:46'),
(23,175,0,1,NULL,'2015-12-19 14:54:46'),
(24,189,0,1,NULL,'2015-12-19 14:54:46'),
(25,190,0,1,NULL,'2015-12-19 14:54:46'),
(26,195,0,1,NULL,'2015-12-19 14:54:46'),
(27,203,0,1,NULL,'2015-12-19 14:54:46'),
(28,222,0,1,NULL,'2015-12-19 14:54:46'),
(29,56,0,2,NULL,'2017-12-10 03:46:44');
/*!40000 ALTER TABLE `zones_to_geo_zones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `address_book`
--

/*!50001 DROP VIEW IF EXISTS `address_book`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb3 */;
/*!50001 SET character_set_results     = utf8mb3 */;
/*!50001 SET collation_connection      = utf8mb3_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `address_book` AS select `address_book_real`.`address_book_id` AS `address_book_id`,`address_book_real`.`customers_id` AS `customers_id`,`address_book_real`.`entry_gender` AS `entry_gender`,`address_book_real`.`entry_company` AS `entry_company`,`address_book_real`.`entry_company_number` AS `entry_company_number`,`address_book_real`.`entry_vat_number` AS `entry_vat_number`,`address_book_real`.`entry_firstname` AS `entry_firstname`,`address_book_real`.`entry_lastname` AS `entry_lastname`,`address_book_real`.`entry_street_address` AS `entry_street_address`,`address_book_real`.`entry_suburb` AS `entry_suburb`,`address_book_real`.`entry_postcode` AS `entry_postcode`,`address_book_real`.`entry_city` AS `entry_city`,`address_book_real`.`entry_state` AS `entry_state`,`address_book_real`.`entry_country_id` AS `entry_country_id`,`address_book_real`.`entry_zone_id` AS `entry_zone_id`,`address_book_real`.`entry_carrier_point_id` AS `entry_carrier_point_id`,`address_book_real`.`tmp` AS `tmp` from `address_book_real` where `address_book_real`.`customers_id` = (select substr(substring_index(user(),'@',1),7)) or (select substr(substring_index(user(),'@',1),1) = 'ruzkyAdmin') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `customers`
--

/*!50001 DROP VIEW IF EXISTS `customers`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb3 */;
/*!50001 SET character_set_results     = utf8mb3 */;
/*!50001 SET collation_connection      = utf8mb3_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `customers` AS select `customers_real`.`customers_id` AS `customers_id`,`customers_real`.`customers_gender` AS `customers_gender`,`customers_real`.`customers_firstname` AS `customers_firstname`,`customers_real`.`customers_lastname` AS `customers_lastname`,`customers_real`.`customers_dob` AS `customers_dob`,`customers_real`.`customers_email_address` AS `customers_email_address`,`customers_real`.`customers_email_hash` AS `customers_email_hash`,`customers_real`.`customers_default_address_id` AS `customers_default_address_id`,`customers_real`.`customers_telephone` AS `customers_telephone`,`customers_real`.`customers_fax` AS `customers_fax`,`customers_real`.`customers_password` AS `customers_password`,`customers_real`.`customers_newsletter` AS `customers_newsletter` from `customers_real` where `customers_real`.`customers_id` = (select substr(substring_index(user(),'@',1),7)) or (select substr(substring_index(user(),'@',1),1) = 'ruzkyAdmin') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `orders`
--

/*!50001 DROP VIEW IF EXISTS `orders`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb3 */;
/*!50001 SET character_set_results     = utf8mb3 */;
/*!50001 SET collation_connection      = utf8mb3_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `orders` AS select `orders_real`.`orders_id` AS `orders_id`,`orders_real`.`customers_id` AS `customers_id`,`orders_real`.`customers_name` AS `customers_name`,`orders_real`.`customers_company` AS `customers_company`,`orders_real`.`customers_company_number` AS `customers_company_number`,`orders_real`.`customers_vat_number` AS `customers_vat_number`,`orders_real`.`customers_street_address` AS `customers_street_address`,`orders_real`.`customers_suburb` AS `customers_suburb`,`orders_real`.`customers_city` AS `customers_city`,`orders_real`.`customers_postcode` AS `customers_postcode`,`orders_real`.`customers_state` AS `customers_state`,`orders_real`.`customers_country` AS `customers_country`,`orders_real`.`customers_telephone` AS `customers_telephone`,`orders_real`.`customers_email_address` AS `customers_email_address`,`orders_real`.`customers_address_format_id` AS `customers_address_format_id`,`orders_real`.`delivery_name` AS `delivery_name`,`orders_real`.`delivery_company` AS `delivery_company`,`orders_real`.`delivery_company_number` AS `delivery_company_number`,`orders_real`.`delivery_vat_number` AS `delivery_vat_number`,`orders_real`.`delivery_street_address` AS `delivery_street_address`,`orders_real`.`delivery_suburb` AS `delivery_suburb`,`orders_real`.`delivery_city` AS `delivery_city`,`orders_real`.`delivery_postcode` AS `delivery_postcode`,`orders_real`.`delivery_state` AS `delivery_state`,`orders_real`.`delivery_country` AS `delivery_country`,`orders_real`.`delivery_address_format_id` AS `delivery_address_format_id`,`orders_real`.`billing_name` AS `billing_name`,`orders_real`.`billing_company` AS `billing_company`,`orders_real`.`billing_company_number` AS `billing_company_number`,`orders_real`.`billing_vat_number` AS `billing_vat_number`,`orders_real`.`billing_street_address` AS `billing_street_address`,`orders_real`.`billing_suburb` AS `billing_suburb`,`orders_real`.`billing_city` AS `billing_city`,`orders_real`.`billing_postcode` AS `billing_postcode`,`orders_real`.`billing_state` AS `billing_state`,`orders_real`.`billing_country` AS `billing_country`,`orders_real`.`billing_address_format_id` AS `billing_address_format_id`,`orders_real`.`payment_method` AS `payment_method`,`orders_real`.`cc_type` AS `cc_type`,`orders_real`.`cc_owner` AS `cc_owner`,`orders_real`.`cc_number` AS `cc_number`,`orders_real`.`cc_expires` AS `cc_expires`,`orders_real`.`last_modified` AS `last_modified`,`orders_real`.`date_purchased` AS `date_purchased`,`orders_real`.`orders_status` AS `orders_status`,`orders_real`.`orders_date_finished` AS `orders_date_finished`,`orders_real`.`currency` AS `currency`,`orders_real`.`currency_value` AS `currency_value`,`orders_real`.`customer_service_id` AS `customer_service_id`,`orders_real`.`shipping_module` AS `shipping_module` from `orders_real` where `orders_real`.`customers_id` = (select substr(substring_index(user(),'@',1),7)) or (select substr(substring_index(user(),'@',1),1) = 'ruzkyAdmin') */;
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

-- Dump completed on 2024-01-28 23:43:47
