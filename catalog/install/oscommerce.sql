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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `action_recorder`
--

LOCK TABLES `action_recorder` WRITE;
/*!40000 ALTER TABLE `action_recorder` DISABLE KEYS */;
INSERT INTO `action_recorder` VALUES
(1,'ar_admin_login',1,'pureosc','127.0.0.1','1','2024-10-05 21:26:27'),
(2,'ar_admin_login',1,'pureosc','127.0.0.1','1','2024-10-08 05:37:37'),
(3,'ar_admin_login',1,'pureosc','127.0.0.1','1','2024-10-08 07:12:14'),
(4,'ar_admin_login',0,'osc','127.0.0.1','0','2024-10-08 07:45:32'),
(5,'ar_admin_login',0,'osc','127.0.0.1','0','2024-10-08 07:55:25'),
(6,'ar_admin_login',1,'pureosc','127.0.0.1','1','2024-10-09 06:40:04'),
(7,'ar_admin_login',1,'pureosc','127.0.0.1','1','2024-10-09 08:25:21'),
(8,'ar_admin_login',1,'pureosc','127.0.0.1','1','2024-10-11 07:25:58'),
(9,'ar_admin_login',1,'pureosc','127.0.0.1','1','2024-10-11 07:26:32'),
(10,'ar_admin_login',1,'pureosc','127.0.0.1','1','2024-10-19 01:18:40'),
(11,'ar_admin_login',0,'osc','127.0.0.1','0','2024-10-21 16:18:46'),
(12,'ar_admin_login',1,'pureosc','127.0.0.1','1','2024-10-21 16:18:57'),
(13,'ar_admin_login',0,'pureosc','127.0.0.1','0','2024-10-21 16:45:46'),
(14,'ar_admin_login',1,'pureosc','127.0.0.1','1','2024-10-21 16:45:48'),
(15,'ar_admin_login',1,'pureosc','127.0.0.1','1','2024-10-21 21:50:52');
/*!40000 ALTER TABLE `action_recorder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `address_book`
--

DROP TABLE IF EXISTS `address_book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address_book` (
  `address_book_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `entry_gender` char(1) DEFAULT NULL,
  `entry_company` varchar(255) DEFAULT NULL,
  `entry_firstname` varchar(255) NOT NULL,
  `entry_lastname` varchar(255) NOT NULL,
  `entry_street_address` varchar(255) NOT NULL,
  `entry_suburb` varchar(255) DEFAULT NULL,
  `entry_postcode` varchar(255) NOT NULL,
  `entry_city` varchar(255) NOT NULL,
  `entry_state` varchar(255) DEFAULT NULL,
  `entry_country_id` int(11) NOT NULL DEFAULT 0,
  `entry_zone_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`address_book_id`),
  KEY `idx_address_book_customers_id` (`customers_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address_book`
--

LOCK TABLES `address_book` WRITE;
/*!40000 ALTER TABLE `address_book` DISABLE KEYS */;
INSERT INTO `address_book` VALUES
(1,1,NULL,NULL,'Šimon','Formánek','Nám Borise Němcova 57/5',NULL,'16000','Praha','Hlavní město Praha',223,0);
/*!40000 ALTER TABLE `address_book` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address_format`
--

LOCK TABLES `address_format` WRITE;
/*!40000 ALTER TABLE `address_format` DISABLE KEYS */;
INSERT INTO `address_format` VALUES
(1,'$firstname $lastname$cr$streets$cr$city, $postcode$cr$statecomma$country','$city / $country'),
(2,'$firstname $lastname$cr$streets$cr$city, $state    $postcode$cr$country','$city, $state / $country'),
(3,'$firstname $lastname$cr$streets$cr$city$cr$postcode - $statecomma$country','$state / $country'),
(4,'$firstname $lastname$cr$streets$cr$city ($postcode)$cr$country','$postcode / $country'),
(5,'$firstname $lastname$cr$streets$cr$postcode $city$cr$country','$city / $country');
/*!40000 ALTER TABLE `address_format` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `administrators`
--

DROP TABLE IF EXISTS `administrators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `user_password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrators`
--

LOCK TABLES `administrators` WRITE;
/*!40000 ALTER TABLE `administrators` DISABLE KEYS */;
INSERT INTO `administrators` VALUES
(1,'pureosc','$P$DaVeYrni87r.USYWNtBf4Em2/dxNJi0');
/*!40000 ALTER TABLE `administrators` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES
(2,'1sapeli','index.php?cPath=362_243_32','IMG_1_sapeli_big.jpg','rotator','',0,NULL,NULL,'2024-09-25 22:21:33',NULL,1),
(3,'2loprais','index.php?cPath=362_241_52','IMG_2_loprais-celek.jpg','rotator','',0,NULL,NULL,'2024-09-25 22:22:48',NULL,1);
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL AUTO_INCREMENT,
  `categories_image` varchar(255) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `sort_order` int(3) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`categories_id`),
  KEY `idx_categories_parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES
(1,NULL,0,0,'2024-10-11 06:18:09','2024-10-18 00:50:11'),
(2,NULL,0,0,'2024-10-18 00:54:05','2024-10-18 00:54:56'),
(3,NULL,0,0,'2024-10-18 00:56:30',NULL),
(4,NULL,8,0,'2024-10-18 00:57:02','2024-10-21 17:24:12'),
(5,NULL,0,0,'2024-10-18 04:29:59',NULL),
(6,'ic_crypto.jpg',5,0,'2024-10-18 19:56:07','2024-10-19 03:13:05'),
(7,'ic_crypto.jpg',5,0,'2024-10-18 19:56:35','2024-10-19 03:11:26'),
(8,NULL,0,0,'2024-10-20 05:07:51',NULL),
(9,NULL,8,0,'2024-10-20 05:08:06',NULL),
(10,NULL,8,0,'2024-10-20 07:45:38','2024-10-21 17:23:51');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories_description`
--

DROP TABLE IF EXISTS `categories_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories_description` (
  `categories_id` int(11) NOT NULL DEFAULT 0,
  `language_id` int(11) NOT NULL DEFAULT 1,
  `categories_name` varchar(255) NOT NULL,
  `categories_description` text DEFAULT NULL,
  PRIMARY KEY (`categories_id`,`language_id`),
  KEY `idx_categories_name` (`categories_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories_description`
--

LOCK TABLES `categories_description` WRITE;
/*!40000 ALTER TABLE `categories_description` DISABLE KEYS */;
INSERT INTO `categories_description` VALUES
(1,2,'Desktop First','<p>Mobile first is wrong idea. No calculation in this IT mythology.<br>\r\n</p>'),
(2,2,'minimize information ballast in HTML body',''),
(3,2,'Default HTML rendering',''),
(4,2,'text browsers welcome',''),
(5,2,'http 1.1 tests',''),
(6,2,'stripped images',''),
(7,2,'pureCSS vs Botstrap',''),
(8,2,'technology',''),
(9,2,'git',''),
(10,2,'all visitors matters','');
/*!40000 ALTER TABLE `categories_description` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=445 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuration`
--

LOCK TABLES `configuration` WRITE;
/*!40000 ALTER TABLE `configuration` DISABLE KEYS */;
INSERT INTO `configuration` VALUES
(1,'Store Name','STORE_NAME','osCommerce','The name of my store',1,1,NULL,'2024-06-07 04:52:42',NULL,NULL),
(2,'Store Owner','STORE_OWNER','Harald Ponce de Leon','The name of my store owner',1,2,NULL,'2024-06-07 04:52:42',NULL,NULL),
(3,'E-Mail Address','STORE_OWNER_EMAIL_ADDRESS','root@localhost','The e-mail address of my store owner',1,3,NULL,'2024-06-07 04:52:42',NULL,NULL),
(4,'E-Mail From','EMAIL_FROM','osCommerce <root@localhost>','The e-mail address used in (sent) e-mails',1,4,NULL,'2024-06-07 04:52:42',NULL,NULL),
(5,'Country','STORE_COUNTRY','223','The country my store is located in <br /><br /><strong>Note: Please remember to update the store zone.</strong>',1,6,NULL,'2024-06-07 04:52:42','tep_get_country_name','tep_cfg_pull_down_country_list('),
(6,'Zone','STORE_ZONE','18','The zone my store is located in',1,7,NULL,'2024-06-07 04:52:42','tep_cfg_get_zone_name','tep_cfg_pull_down_zone_list('),
(7,'Expected Sort Order','EXPECTED_PRODUCTS_SORT','desc','This is the sort order used in the expected products box.',1,8,NULL,'2024-06-07 04:52:42',NULL,'tep_cfg_select_option(array(\'asc\', \'desc\'), '),
(8,'Expected Sort Field','EXPECTED_PRODUCTS_FIELD','date_expected','The column to sort by in the expected products box.',1,9,NULL,'2024-06-07 04:52:42',NULL,'tep_cfg_select_option(array(\'products_name\', \'date_expected\'), '),
(9,'Switch To Default Language Currency','USE_DEFAULT_LANGUAGE_CURRENCY','true','Automatically switch to the language\'s currency when it is changed',1,10,NULL,'2024-06-07 04:52:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(10,'Send Extra Order Emails To','SEND_EXTRA_ORDER_EMAILS_TO','','Send extra order emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;',1,11,NULL,'2024-06-07 04:52:42',NULL,NULL),
(11,'Use Search-Engine Safe URLs','SEARCH_ENGINE_FRIENDLY_URLS','false','Use search-engine safe urls for all site links',1,12,NULL,'2024-06-07 04:52:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(12,'Display Cart After Adding Product','DISPLAY_CART','true','Display the shopping cart after adding a product (or return back to their origin)',1,14,NULL,'2024-06-07 04:52:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(13,'Allow Guest To Tell A Friend','ALLOW_GUEST_TO_TELL_A_FRIEND','false','Allow guests to tell a friend about a product',1,15,NULL,'2024-06-07 04:52:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(14,'Default Search Operator','ADVANCED_SEARCH_DEFAULT_OPERATOR','and','Default search operators',1,17,NULL,'2024-06-07 04:52:42',NULL,'tep_cfg_select_option(array(\'and\', \'or\'), '),
(15,'Store Address and Phone','STORE_NAME_ADDRESS','Store Name\nAddress\nCountry\n800-0123456789','This is the Store Name, Address and Phone used on printable documents and displayed online',1,18,NULL,'2024-06-07 04:52:42',NULL,'tep_cfg_textarea('),
(16,'Tax Decimal Places','TAX_DECIMAL_PLACES','0','Pad the tax value this amount of decimal places',1,20,NULL,'2024-06-07 04:52:42',NULL,NULL),
(17,'Display Prices with Tax','DISPLAY_PRICE_WITH_TAX','false','Display prices with tax included (true) or add the tax at the end (false)',1,21,NULL,'2024-06-07 04:52:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(18,'First Name','ENTRY_FIRST_NAME_MIN_LENGTH','2','Minimum length of first name',2,1,NULL,'2024-06-07 04:52:42',NULL,NULL),
(19,'Last Name','ENTRY_LAST_NAME_MIN_LENGTH','2','Minimum length of last name',2,2,NULL,'2024-06-07 04:52:42',NULL,NULL),
(20,'Date of Birth','ENTRY_DOB_MIN_LENGTH','10','Minimum length of date of birth',2,3,NULL,'2024-06-07 04:52:42',NULL,NULL),
(21,'E-Mail Address','ENTRY_EMAIL_ADDRESS_MIN_LENGTH','6','Minimum length of e-mail address',2,4,NULL,'2024-06-07 04:52:42',NULL,NULL),
(22,'Street Address','ENTRY_STREET_ADDRESS_MIN_LENGTH','5','Minimum length of street address',2,5,NULL,'2024-06-07 04:52:42',NULL,NULL),
(23,'Company','ENTRY_COMPANY_MIN_LENGTH','2','Minimum length of company name',2,6,NULL,'2024-06-07 04:52:42',NULL,NULL),
(24,'Post Code','ENTRY_POSTCODE_MIN_LENGTH','4','Minimum length of post code',2,7,NULL,'2024-06-07 04:52:42',NULL,NULL),
(25,'City','ENTRY_CITY_MIN_LENGTH','3','Minimum length of city',2,8,NULL,'2024-06-07 04:52:42',NULL,NULL),
(26,'State','ENTRY_STATE_MIN_LENGTH','2','Minimum length of state',2,9,NULL,'2024-06-07 04:52:42',NULL,NULL),
(27,'Telephone Number','ENTRY_TELEPHONE_MIN_LENGTH','3','Minimum length of telephone number',2,10,NULL,'2024-06-07 04:52:42',NULL,NULL),
(28,'Password','ENTRY_PASSWORD_MIN_LENGTH','5','Minimum length of password',2,11,NULL,'2024-06-07 04:52:42',NULL,NULL),
(29,'Credit Card Owner Name','CC_OWNER_MIN_LENGTH','3','Minimum length of credit card owner name',2,12,NULL,'2024-06-07 04:52:42',NULL,NULL),
(30,'Credit Card Number','CC_NUMBER_MIN_LENGTH','10','Minimum length of credit card number',2,13,NULL,'2024-06-07 04:52:42',NULL,NULL),
(31,'Review Text','REVIEW_TEXT_MIN_LENGTH','50','Minimum length of review text',2,14,NULL,'2024-06-07 04:52:42',NULL,NULL),
(32,'Address Book Entries','MAX_ADDRESS_BOOK_ENTRIES','5','Maximum address book entries a customer is allowed to have',3,1,NULL,'2024-06-07 04:52:42',NULL,NULL),
(33,'Search Results','MAX_DISPLAY_SEARCH_RESULTS','20','Amount of products to list',3,2,NULL,'2024-06-07 04:52:42',NULL,NULL),
(34,'Page Links','MAX_DISPLAY_PAGE_LINKS','5','Number of \'number\' links use for page-sets',3,3,NULL,'2024-06-07 04:52:42',NULL,NULL),
(35,'Product Quantities In Shopping Cart','MAX_QTY_IN_CART','99','Maximum number of product quantities that can be added to the shopping cart (0 for no limit)',3,19,NULL,'2024-06-07 04:52:42',NULL,NULL),
(36,'Small Image Width','SMALL_IMAGE_WIDTH','0','The pixel width of small images',4,1,NULL,'2024-06-07 04:52:42',NULL,NULL),
(37,'Small Image Height','SMALL_IMAGE_HEIGHT','90','The pixel height of small images',4,2,'2024-10-13 11:20:36','2024-06-07 04:52:42',NULL,NULL),
(38,'Heading Image Width','HEADING_IMAGE_WIDTH','57','The pixel width of heading images',4,3,NULL,'2024-06-07 04:52:42',NULL,NULL),
(39,'Heading Image Height','HEADING_IMAGE_HEIGHT','40','The pixel height of heading images',4,4,NULL,'2024-06-07 04:52:42',NULL,NULL),
(40,'Subcategory Image Width','SUBCATEGORY_IMAGE_WIDTH','0','The pixel width of subcategory images',4,5,NULL,'2024-06-07 04:52:42',NULL,NULL),
(41,'Subcategory Image Height','SUBCATEGORY_IMAGE_HEIGHT','0','The pixel height of subcategory images',4,6,NULL,'2024-06-07 04:52:42',NULL,NULL),
(42,'Calculate Image Size','CONFIG_CALCULATE_IMAGE_SIZE','true','Calculate the size of images?',4,7,NULL,'2024-06-07 04:52:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(43,'Image Required','IMAGE_REQUIRED','false','Enable to display broken images. Good for development.',4,8,NULL,'2024-06-07 04:52:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(44,'Gender','ACCOUNT_GENDER','false','Display gender in the customers account',5,1,NULL,'2024-06-07 04:52:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(45,'Date of Birth','ACCOUNT_DOB','false','Display date of birth in the customers account',5,2,NULL,'2024-06-07 04:52:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(46,'Company','ACCOUNT_COMPANY','false','Display company in the customers account',5,3,NULL,'2024-06-07 04:52:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(47,'Suburb','ACCOUNT_SUBURB','false','Display suburb in the customers account',5,4,NULL,'2024-06-07 04:52:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(48,'State','ACCOUNT_STATE','true','Display state in the customers account',5,5,NULL,'2024-06-07 04:52:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(49,'Legal Agreements','ACCOUNT_LEGAL_AGREEMENTS','true','Display legal agreements in the customers account',5,6,NULL,'2024-06-07 04:52:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(50,'Installed Modules','MODULE_PAYMENT_INSTALLED','cod.php;paypal_express.php;braintree_cc.php','List of payment module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: cod.php;paypal_express.php)',6,0,NULL,'2024-06-07 04:52:42',NULL,NULL),
(51,'Installed Modules','MODULE_ORDER_TOTAL_INSTALLED','ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_total.php','List of order_total module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_total.php)',6,0,NULL,'2024-06-07 04:52:42',NULL,NULL),
(52,'Installed Modules','MODULE_SHIPPING_INSTALLED','flat.php','List of shipping module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ups.php;flat.php;item.php)',6,0,NULL,'2024-06-07 04:52:42',NULL,NULL),
(53,'Installed Modules','MODULE_ACTION_RECORDER_INSTALLED','ar_admin_login.php;ar_contact_us.php;ar_reset_password.php;ar_tell_a_friend.php;ar_write_review.php','List of action recorder module filenames separated by a semi-colon. This is automatically updated. No need to edit.',6,0,NULL,'2024-06-07 04:52:42',NULL,NULL),
(54,'Installed Modules','MODULE_SOCIAL_BOOKMARKS_INSTALLED','sb_email.php;sb_facebook.php;sb_twitter.php;sb_pinterest.php','List of social bookmark module filenames separated by a semi-colon. This is automatically updated. No need to edit.',6,0,'2024-09-21 02:19:01','2024-06-07 04:52:42',NULL,NULL),
(55,'Enable Cash On Delivery Module','MODULE_PAYMENT_COD_STATUS','True','Do you want to accept Cash On Delevery payments?',6,1,NULL,'2024-06-07 04:52:42',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(56,'Payment Zone','MODULE_PAYMENT_COD_ZONE','0','If a zone is selected, only enable this payment method for that zone.',6,2,NULL,'2024-06-07 04:52:42','tep_get_zone_class_title','tep_cfg_pull_down_zone_classes('),
(57,'Sort order of display.','MODULE_PAYMENT_COD_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:42',NULL,NULL),
(58,'Set Order Status','MODULE_PAYMENT_COD_ORDER_STATUS_ID','0','Set the status of orders made with this payment module to this value',6,0,NULL,'2024-06-07 04:52:42','tep_get_order_status_name','tep_cfg_pull_down_order_statuses('),
(59,'Enable Flat Shipping','MODULE_SHIPPING_FLAT_STATUS','True','Do you want to offer flat rate shipping?',6,0,NULL,'2024-06-07 04:52:42',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(60,'Shipping Cost','MODULE_SHIPPING_FLAT_COST','5.00','The shipping cost for all orders using this shipping method.',6,0,NULL,'2024-06-07 04:52:42',NULL,NULL),
(61,'Tax Class','MODULE_SHIPPING_FLAT_TAX_CLASS','0','Use the following tax class on the shipping fee.',6,0,NULL,'2024-06-07 04:52:42','tep_get_tax_class_title','tep_cfg_pull_down_tax_classes('),
(62,'Shipping Zone','MODULE_SHIPPING_FLAT_ZONE','0','If a zone is selected, only enable this shipping method for that zone.',6,0,NULL,'2024-06-07 04:52:42','tep_get_zone_class_title','tep_cfg_pull_down_zone_classes('),
(63,'Sort Order','MODULE_SHIPPING_FLAT_SORT_ORDER','0','Sort order of display.',6,0,NULL,'2024-06-07 04:52:42',NULL,NULL),
(64,'Default Currency','DEFAULT_CURRENCY','USD','Default Currency',6,0,NULL,'2024-06-07 04:52:42',NULL,NULL),
(65,'Default Language','DEFAULT_LANGUAGE','en','Default Language',6,0,NULL,'2024-06-07 04:52:42',NULL,NULL),
(66,'Default Order Status For New Orders','DEFAULT_ORDERS_STATUS_ID','1','When a new order is created, this order status will be assigned to it.',6,0,NULL,'2024-06-07 04:52:42',NULL,NULL),
(67,'Display Shipping','MODULE_ORDER_TOTAL_SHIPPING_STATUS','true','Do you want to display the order shipping cost?',6,1,NULL,'2024-06-07 04:52:42',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(68,'Sort Order','MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER','2','Sort order of display.',6,2,NULL,'2024-06-07 04:52:43',NULL,NULL),
(69,'Allow Free Shipping','MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING','false','Do you want to allow free shipping?',6,3,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(70,'Free Shipping For Orders Over','MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER','50','Provide free shipping for orders over the set amount.',6,4,NULL,'2024-06-07 04:52:43','currencies->format',NULL),
(71,'Provide Free Shipping For Orders Made','MODULE_ORDER_TOTAL_SHIPPING_DESTINATION','national','Provide free shipping for orders sent to the set destination.',6,5,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'national\', \'international\', \'both\'), '),
(72,'Display Sub-Total','MODULE_ORDER_TOTAL_SUBTOTAL_STATUS','true','Do you want to display the order sub-total cost?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(73,'Sort Order','MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER','1','Sort order of display.',6,2,NULL,'2024-06-07 04:52:43',NULL,NULL),
(74,'Display Tax','MODULE_ORDER_TOTAL_TAX_STATUS','true','Do you want to display the order tax value?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(75,'Sort Order','MODULE_ORDER_TOTAL_TAX_SORT_ORDER','3','Sort order of display.',6,2,NULL,'2024-06-07 04:52:43',NULL,NULL),
(76,'Display Total','MODULE_ORDER_TOTAL_TOTAL_STATUS','true','Do you want to display the total order value?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(77,'Sort Order','MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER','4','Sort order of display.',6,2,NULL,'2024-06-07 04:52:43',NULL,NULL),
(78,'Minimum Minutes Per E-Mail','MODULE_ACTION_RECORDER_CONTACT_US_EMAIL_MINUTES','15','Minimum number of minutes to allow 1 e-mail to be sent (eg, 15 for 1 e-mail every 15 minutes)',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(79,'Minimum Minutes Per E-Mail','MODULE_ACTION_RECORDER_TELL_A_FRIEND_EMAIL_MINUTES','15','Minimum number of minutes to allow 1 e-mail to be sent (eg, 15 for 1 e-mail every 15 minutes)',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(80,'Allowed Minutes','MODULE_ACTION_RECORDER_ADMIN_LOGIN_MINUTES','5','Number of minutes to allow login attempts to occur.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(81,'Allowed Attempts','MODULE_ACTION_RECORDER_ADMIN_LOGIN_ATTEMPTS','3','Number of login attempts to allow within the specified period.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(82,'Allowed Minutes','MODULE_ACTION_RECORDER_RESET_PASSWORD_MINUTES','5','Number of minutes to allow password resets to occur.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(83,'Allowed Attempts','MODULE_ACTION_RECORDER_RESET_PASSWORD_ATTEMPTS','1','Number of password reset attempts to allow within the specified period.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(84,'Minimum Minutes Per Review','MODULE_ACTION_RECORDER_WRITE_REVIEW_MINUTES','3','Minimum number of minutes to allow 1 review to be sent (eg, 5 for 1 review every 5 minutes)',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(85,'Enable E-Mail Module','MODULE_SOCIAL_BOOKMARKS_EMAIL_STATUS','True','Do you want to allow products to be shared through e-mail?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(86,'Sort Order','MODULE_SOCIAL_BOOKMARKS_EMAIL_SORT_ORDER','10','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(87,'Enable Facebook Module','MODULE_SOCIAL_BOOKMARKS_FACEBOOK_STATUS','True','Do you want to allow products to be shared through Facebook?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(88,'Sort Order','MODULE_SOCIAL_BOOKMARKS_FACEBOOK_SORT_ORDER','30','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(89,'Enable Twitter Module','MODULE_SOCIAL_BOOKMARKS_TWITTER_STATUS','True','Do you want to allow products to be shared through Twitter?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(90,'Sort Order','MODULE_SOCIAL_BOOKMARKS_TWITTER_SORT_ORDER','40','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(91,'Enable Pinterest Module','MODULE_SOCIAL_BOOKMARKS_PINTEREST_STATUS','True','Do you want to allow Pinterest Button?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(92,'Layout Position','MODULE_SOCIAL_BOOKMARKS_PINTEREST_BUTTON_COUNT_POSITION','None','Horizontal or Vertical or None',6,2,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'Horizontal\', \'Vertical\', \'None\'), '),
(93,'Sort Order','MODULE_SOCIAL_BOOKMARKS_PINTEREST_SORT_ORDER','50','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(94,'Country of Origin','SHIPPING_ORIGIN_COUNTRY','223','Select the country of origin to be used in shipping quotes.',7,1,NULL,'2024-06-07 04:52:43','tep_get_country_name','tep_cfg_pull_down_country_list('),
(95,'Postal Code','SHIPPING_ORIGIN_ZIP','NONE','Enter the Postal Code (ZIP) of the Store to be used in shipping quotes.',7,2,NULL,'2024-06-07 04:52:43',NULL,NULL),
(96,'Enter the Maximum Package Weight you will ship','SHIPPING_MAX_WEIGHT','50','Carriers have a max weight limit for a single package. This is a common one for all.',7,3,NULL,'2024-06-07 04:52:43',NULL,NULL),
(97,'Package Tare weight.','SHIPPING_BOX_WEIGHT','3','What is the weight of typical packaging of small to medium packages?',7,4,NULL,'2024-06-07 04:52:43',NULL,NULL),
(98,'Larger packages - percentage increase.','SHIPPING_BOX_PADDING','10','For 10% enter 10',7,5,NULL,'2024-06-07 04:52:43',NULL,NULL),
(99,'Allow Orders Not Matching Defined Shipping Zones ','SHIPPING_ALLOW_UNDEFINED_ZONES','False','Should orders be allowed to shipping addresses not matching defined shipping module shipping zones?',7,5,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(100,'Check stock level','STOCK_CHECK','true','Check to see if sufficent stock is available',9,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(101,'Subtract stock','STOCK_LIMITED','true','Subtract product in stock by product orders',9,2,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(102,'Allow Checkout','STOCK_ALLOW_CHECKOUT','false','Allow customer to checkout even if there is insufficient stock',9,3,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(103,'Mark product out of stock','STOCK_MARK_PRODUCT_OUT_OF_STOCK','***','Display something on screen so customer can see which product has insufficient stock',9,4,NULL,'2024-06-07 04:52:43',NULL,NULL),
(104,'Stock Re-order level','STOCK_REORDER_LEVEL','5','Define when stock needs to be re-ordered',9,5,NULL,'2024-06-07 04:52:43',NULL,NULL),
(105,'Store Page Parse Time','STORE_PAGE_PARSE_TIME','false','Store the time it takes to parse a page',10,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(106,'Log Destination','STORE_PAGE_PARSE_TIME_LOG','/var/log/www/tep/page_parse_time.log','Directory and filename of the page parse time log',10,2,NULL,'2024-06-07 04:52:43',NULL,NULL),
(107,'Log Date Format','STORE_PARSE_DATE_TIME_FORMAT','%d/%m/%Y %H:%M:%S','The date format',10,3,NULL,'2024-06-07 04:52:43',NULL,NULL),
(108,'Display The Page Parse Time','DISPLAY_PAGE_PARSE_TIME','true','Display the page parse time (store page parse time must be enabled)',10,4,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(109,'Store Database Queries','STORE_DB_TRANSACTIONS','true','Store the database queries in the page parse time log',10,5,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(110,'Use Cache','USE_CACHE','false','Use caching features',11,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(111,'Cache Directory','DIR_FS_CACHE','/tmp/','The directory where the cached files are saved',11,2,NULL,'2024-06-07 04:52:43',NULL,NULL),
(112,'E-Mail Transport Method','EMAIL_TRANSPORT','sendmail','Defines if this server uses a local connection to sendmail or uses an SMTP connection via TCP/IP. Servers running on Windows and MacOS should change this setting to SMTP.',12,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'sendmail\', \'smtp\'),'),
(113,'E-Mail Linefeeds','EMAIL_LINEFEED','LF','Defines the character sequence used to separate mail headers.',12,2,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'LF\', \'CRLF\'),'),
(114,'Use MIME HTML When Sending Emails','EMAIL_USE_HTML','false','Send e-mails in HTML format',12,3,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(115,'Verify E-Mail Addresses Through DNS','ENTRY_EMAIL_ADDRESS_CHECK','false','Verify e-mail address through a DNS server',12,4,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(116,'Send E-Mails','SEND_EMAILS','true','Send out e-mails',12,5,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(117,'SMTP Server','EMAIL_SMTP_HOST','localhost','The hostname or IP address of the server',12,6,NULL,'2024-06-07 04:52:43',NULL,NULL),
(118,'SMTP Username','EMAIL_SMTP_USERNAME','','SMTP Username',12,7,NULL,'2024-06-07 04:52:43',NULL,NULL),
(119,'SMTP Password','EMAIL_SMTP_PASSWORD','','SMTP Password',12,8,NULL,'2024-06-07 04:52:43',NULL,NULL),
(120,'SMTP Port','EMAIL_SMTP_PORT','2525','Port number',12,9,NULL,'2024-06-07 04:52:43',NULL,NULL),
(121,'SMTP Encryption','EMAIL_SMTP_ENCRYPTION','','The protocol used for secure communication',12,10,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'ssl\', \'tls\', \'\'), '),
(122,'SMTP Debug','EMAIL_SMTP_DEBUG','false',' Debug information can help to set up e-mails dispatch. Please disable when emails sending works properly',12,13,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(123,'Bulk Mailer Limit','SEND_EMAIL_LIMIT','100','How many e-mails will be sent at a time',12,11,NULL,'2024-06-07 04:52:43',NULL,NULL),
(124,'Bulk Mailer Interval','SEND_EMAIL_INTERVAL','3','Time between each bulk e-mails send in seconds',12,12,NULL,'2024-06-07 04:52:43',NULL,NULL),
(125,'Enable download','DOWNLOAD_ENABLED','false','Enable the products download functions.',13,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(126,'Download by redirect','DOWNLOAD_BY_REDIRECT','false','Use browser redirection for download. Disable on non-Unix systems.',13,2,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(127,'Expiry delay (days)','DOWNLOAD_MAX_DAYS','7','Set number of days before the download link expires. 0 means no limit.',13,3,NULL,'2024-06-07 04:52:43',NULL,''),
(128,'Maximum number of downloads','DOWNLOAD_MAX_COUNT','5','Set the maximum number of downloads. 0 means no download authorized.',13,4,NULL,'2024-06-07 04:52:43',NULL,''),
(129,'Enable GZip Compression','GZIP_COMPRESSION','false','Enable HTTP GZip compression.',14,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(130,'Compression Level','GZIP_LEVEL','5','Use this compression level 0-9 (0 = minimum, 9 = maximum).',14,2,NULL,'2024-06-07 04:52:43',NULL,NULL),
(131,'Session Directory','SESSION_WRITE_DIRECTORY','/tmp','If sessions are file based, store them in this directory.',15,1,NULL,'2024-06-07 04:52:43',NULL,NULL),
(132,'Force Cookie Use','SESSION_FORCE_COOKIE_USE','False','Force the use of sessions when cookies are only enabled.',15,2,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(133,'Check SSL Session ID','SESSION_CHECK_SSL_SESSION_ID','True','Validate the SSL_SESSION_ID on every secure HTTPS page request.',15,3,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(134,'Check User Agent','SESSION_CHECK_USER_AGENT','True','Validate the clients browser user agent on every page request.',15,4,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(135,'Check IP Address','SESSION_CHECK_IP_ADDRESS','True','Validate the clients IP address on every page request.',15,5,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(136,'Prevent Spider Sessions','SESSION_BLOCK_SPIDERS','True','Prevent known spiders from starting a session.',15,6,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(137,'Recreate Session','SESSION_RECREATE','True','Recreate the session to generate a new session ID when the customer logs on or creates an account (PHP >=4.1 needed).',15,7,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(138,'Last Update Check Time','LAST_UPDATE_CHECK_TIME','','Last time a check for new versions of osCommerce was run',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(139,'Enable PayPal Express Checkout','MODULE_PAYMENT_PAYPAL_EXPRESS_STATUS','True','Do you want to accept PayPal Express Checkout payments?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(140,'Seller Account','MODULE_PAYMENT_PAYPAL_EXPRESS_SELLER_ACCOUNT','','The email address of the seller account if no API credentials has been setup.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(141,'API Username','MODULE_PAYMENT_PAYPAL_EXPRESS_API_USERNAME','','The username to use for the PayPal API service',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(142,'API Password','MODULE_PAYMENT_PAYPAL_EXPRESS_API_PASSWORD','','The password to use for the PayPal API service',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(143,'API Signature','MODULE_PAYMENT_PAYPAL_EXPRESS_API_SIGNATURE','','The signature to use for the PayPal API service',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(144,'PayPal Account Optional','MODULE_PAYMENT_PAYPAL_EXPRESS_ACCOUNT_OPTIONAL','False','This must also be enabled in your PayPal account, in Profile > Website Payment Preferences.',6,0,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(145,'PayPal Instant Update','MODULE_PAYMENT_PAYPAL_EXPRESS_INSTANT_UPDATE','True','Support PayPal shipping and tax calculations on the PayPal.com site during Express Checkout.',6,0,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(146,'PayPal Checkout Image','MODULE_PAYMENT_PAYPAL_EXPRESS_CHECKOUT_IMAGE','Static','Use static or dynamic Express Checkout image buttons. Dynamic images are used with PayPal campaigns.',6,0,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'Static\', \'Dynamic\'), '),
(147,'Transaction Method','MODULE_PAYMENT_PAYPAL_EXPRESS_TRANSACTION_METHOD','Sale','The processing method to use for each transaction.',6,0,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'Authorization\', \'Sale\'), '),
(148,'Set Order Status','MODULE_PAYMENT_PAYPAL_EXPRESS_ORDER_STATUS_ID','0','Set the status of orders made with this payment module to this value',6,0,NULL,'2024-06-07 04:52:43','tep_get_order_status_name','tep_cfg_pull_down_order_statuses('),
(149,'PayPal Transactions Order Status Level','MODULE_PAYMENT_PAYPAL_EXPRESS_TRANSACTIONS_ORDER_STATUS_ID','4','Include PayPal transaction information in this order status level',6,0,NULL,'2024-06-07 04:52:43','tep_get_order_status_name','tep_cfg_pull_down_order_statuses('),
(150,'Payment Zone','MODULE_PAYMENT_PAYPAL_EXPRESS_ZONE','0','If a zone is selected, only enable this payment method for that zone.',6,2,NULL,'2024-06-07 04:52:43','tep_get_zone_class_title','tep_cfg_pull_down_zone_classes('),
(151,'Transaction Server','MODULE_PAYMENT_PAYPAL_EXPRESS_TRANSACTION_SERVER','Live','Use the live or testing (sandbox) gateway server to process transactions?',6,0,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'Live\', \'Sandbox\'), '),
(152,'Verify SSL Certificate','MODULE_PAYMENT_PAYPAL_EXPRESS_VERIFY_SSL','True','Verify gateway server SSL certificate on connection?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(153,'Proxy Server','MODULE_PAYMENT_PAYPAL_EXPRESS_PROXY','','Send API requests through this proxy server. (host:port, eg: 123.45.67.89:8080 or proxy.example.com:8080)',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(154,'Debug E-Mail Address','MODULE_PAYMENT_PAYPAL_EXPRESS_DEBUG_EMAIL','','All parameters of an invalid transaction will be sent to this email address.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(155,'Sort order of display.','MODULE_PAYMENT_PAYPAL_EXPRESS_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(156,'Installed Modules','MODULE_HEADER_TAGS_INSTALLED','ht_manufacturer_title.php;ht_category_title.php;ht_product_title.php;ht_canonical.php;ht_robot_noindex.php','List of header tag module filenames separated by a semi-colon. This is automatically updated. No need to edit.',6,0,'2024-09-21 02:18:20','2024-06-07 04:52:43',NULL,NULL),
(157,'Enable Category Title Module','MODULE_HEADER_TAGS_CATEGORY_TITLE_STATUS','True','Do you want to allow category titles to be added to the page title?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(158,'Sort Order','MODULE_HEADER_TAGS_CATEGORY_TITLE_SORT_ORDER','200','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(159,'Enable Manufacturer Title Module','MODULE_HEADER_TAGS_MANUFACTURER_TITLE_STATUS','True','Do you want to allow manufacturer titles to be added to the page title?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(160,'Sort Order','MODULE_HEADER_TAGS_MANUFACTURER_TITLE_SORT_ORDER','100','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(161,'Enable Product Title Module','MODULE_HEADER_TAGS_PRODUCT_TITLE_STATUS','True','Do you want to allow product titles to be added to the page title?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(162,'Sort Order','MODULE_HEADER_TAGS_PRODUCT_TITLE_SORT_ORDER','300','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(163,'Enable Canonical Module','MODULE_HEADER_TAGS_CANONICAL_STATUS','True','Do you want to enable the Canonical module?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(164,'Sort Order','MODULE_HEADER_TAGS_CANONICAL_SORT_ORDER','400','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(165,'Enable Robot NoIndex Module','MODULE_HEADER_TAGS_ROBOT_NOINDEX_STATUS','True','Do you want to enable the Robot NoIndex module?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(166,'Pages','MODULE_HEADER_TAGS_ROBOT_NOINDEX_PAGES','account.php;account_edit.php;account_history.php;account_history_info.php;account_newsletters.php;account_notifications.php;account_password.php;address_book.php;address_book_process.php;checkout_confirmation.php;checkout_payment.php;checkout_payment_address.php;checkout_process.php;checkout_shipping.php;checkout_shipping_address.php;checkout_success.php;cookie_usage.php;create_account.php;create_account_success.php;login.php;logoff.php;password_forgotten.php;password_reset.php;product_reviews_write.php;shopping_cart.php;ssl_check.php;tell_a_friend.php','The pages to add the meta robot noindex tag to.',6,0,NULL,'2024-06-07 04:52:43','ht_robot_noindex_show_pages','ht_robot_noindex_edit_pages('),
(167,'Sort Order','MODULE_HEADER_TAGS_ROBOT_NOINDEX_SORT_ORDER','500','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(168,'Installed Modules','MODULE_ADMIN_DASHBOARD_INSTALLED','','List of Administration Tool Dashboard module filenames separated by a semi-colon. This is automatically updated. No need to edit.',6,0,'2024-09-21 02:24:05','2024-06-07 04:52:43',NULL,NULL),
(169,'Enable Administrator Logins Module','MODULE_ADMIN_DASHBOARD_ADMIN_LOGINS_STATUS','False','Do you want to show the latest administrator logins on the dashboard?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(170,'Sort Order','MODULE_ADMIN_DASHBOARD_ADMIN_LOGINS_SORT_ORDER','500','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(171,'Enable Customers Module','MODULE_ADMIN_DASHBOARD_CUSTOMERS_STATUS','False','Do you want to show the newest customers on the dashboard?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(172,'Sort Order','MODULE_ADMIN_DASHBOARD_CUSTOMERS_SORT_ORDER','400','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(173,'Enable Latest Add-Ons Module','MODULE_ADMIN_DASHBOARD_LATEST_ADDONS_STATUS','False','Do you want to show the latest osCommerce Add-Ons on the dashboard?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(174,'Sort Order','MODULE_ADMIN_DASHBOARD_LATEST_ADDONS_SORT_ORDER','800','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(175,'Enable Latest News Module','MODULE_ADMIN_DASHBOARD_LATEST_NEWS_STATUS','False','Do you want to show the latest osCommerce News on the dashboard?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(176,'Sort Order','MODULE_ADMIN_DASHBOARD_LATEST_NEWS_SORT_ORDER','700','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(177,'Enable Orders Module','MODULE_ADMIN_DASHBOARD_ORDERS_STATUS','False','Do you want to show the latest orders on the dashboard?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(178,'Sort Order','MODULE_ADMIN_DASHBOARD_ORDERS_SORT_ORDER','300','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(179,'Enable Security Checks Module','MODULE_ADMIN_DASHBOARD_SECURITY_CHECKS_STATUS','False','Do you want to run the security checks for this installation?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(180,'Sort Order','MODULE_ADMIN_DASHBOARD_SECURITY_CHECKS_SORT_ORDER','600','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(181,'Enable Total Customers Module','MODULE_ADMIN_DASHBOARD_TOTAL_CUSTOMERS_STATUS','False','Do you want to show the total customers chart on the dashboard?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(182,'Sort Order','MODULE_ADMIN_DASHBOARD_TOTAL_CUSTOMERS_SORT_ORDER','200','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(183,'Enable Total Revenue Module','MODULE_ADMIN_DASHBOARD_TOTAL_REVENUE_STATUS','False','Do you want to show the total revenue chart on the dashboard?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(184,'Sort Order','MODULE_ADMIN_DASHBOARD_TOTAL_REVENUE_SORT_ORDER','100','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(185,'Enable Version Check Module','MODULE_ADMIN_DASHBOARD_VERSION_CHECK_STATUS','False','Do you want to show the version check results on the dashboard?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(186,'Sort Order','MODULE_ADMIN_DASHBOARD_VERSION_CHECK_SORT_ORDER','900','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(187,'Enable Latest Reviews Module','MODULE_ADMIN_DASHBOARD_REVIEWS_STATUS','False','Do you want to show the latest reviews on the dashboard?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(188,'Sort Order','MODULE_ADMIN_DASHBOARD_REVIEWS_SORT_ORDER','1000','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(189,'Enable Partner News Module','MODULE_ADMIN_DASHBOARD_PARTNER_NEWS_STATUS','False','Do you want to show the latest osCommerce Partner News on the dashboard?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(190,'Sort Order','MODULE_ADMIN_DASHBOARD_PARTNER_NEWS_SORT_ORDER','820','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(191,'Installed Modules','MODULE_BOXES_INSTALLED','bm_product_filters.php','List of box module filenames separated by a semi-colon. This is automatically updated. No need to edit.',6,0,'2024-09-21 02:17:09','2024-06-07 04:52:43',NULL,NULL),
(192,'Installed Template Block Groups','TEMPLATE_BLOCK_GROUPS','boxes;footer;header;header_tags','This is automatically updated. No need to edit.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(193,'Installed Modules','MODULE_CONTENT_INSTALLED','account/cm_account_anonymize_data;account/cm_account_delete;account/cm_account_set_password;checkout_success/cm_cs_redirect_old_order;checkout_success/cm_cs_thank_you;checkout_success/cm_cs_product_notifications;checkout_success/cm_cs_downloads;index/cm_index_webp_banner;index/cm_index_category_images;index/cm_index_category_title;index/cm_index_product_listing;index/cm_index_category_description;index/cm_index_customer_greeting;index/cm_index_new_products;index/cm_index_special_products;login/cm_login_form;login/cm_create_account_link;product_info/cm_pi_attributes;product_info/cm_pi_model;product_info/cm_pi_price;product_info/cm_pi_buy_button;product_info/cm_pi_manufacturer;product_info/cm_pi_images;product_info/cm_pi_description','This is automatically updated. No need to edit.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(194,'Enable Module','MODULE_CONTENT_ACCOUNT_DELETE_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(195,'Sort Order','MODULE_CONTENT_ACCOUNT_DELETE_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(196,'Enable Set Account Password','MODULE_CONTENT_ACCOUNT_SET_PASSWORD_STATUS','True','Do you want to enable the Set Account Password module?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(197,'Allow Local Passwords','MODULE_CONTENT_ACCOUNT_SET_PASSWORD_ALLOW_PASSWORD','True','Allow local account passwords to be set.',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(198,'Sort Order','MODULE_CONTENT_ACCOUNT_SET_PASSWORD_SORT_ORDER','100','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(199,'Enable Redirect Old Order Module','MODULE_CONTENT_CHECKOUT_SUCCESS_REDIRECT_OLD_ORDER_STATUS','True','Should customers be redirected when viewing old checkout success orders?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(200,'Redirect Minutes','MODULE_CONTENT_CHECKOUT_SUCCESS_REDIRECT_OLD_ORDER_MINUTES','60','Redirect customers to the My Account page after an order older than this amount is viewed.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(201,'Sort Order','MODULE_CONTENT_CHECKOUT_SUCCESS_REDIRECT_OLD_ORDER_SORT_ORDER','500','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(202,'Enable Thank You Module','MODULE_CONTENT_CHECKOUT_SUCCESS_THANK_YOU_STATUS','True','Should the thank you block be shown on the checkout success page?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(203,'Sort Order','MODULE_CONTENT_CHECKOUT_SUCCESS_THANK_YOU_SORT_ORDER','1000','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(204,'Enable Product Notifications Module','MODULE_CONTENT_CHECKOUT_SUCCESS_PRODUCT_NOTIFICATIONS_STATUS','True','Should the product notifications block be shown on the checkout success page?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(205,'Sort Order','MODULE_CONTENT_CHECKOUT_SUCCESS_PRODUCT_NOTIFICATIONS_SORT_ORDER','2000','Sort order of display. Lowest is displayed first.',6,3,NULL,'2024-06-07 04:52:43',NULL,NULL),
(206,'Enable Product Downloads Module','MODULE_CONTENT_CHECKOUT_SUCCESS_DOWNLOADS_STATUS','True','Should ordered product download links be shown on the checkout success page?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(207,'Sort Order','MODULE_CONTENT_CHECKOUT_SUCCESS_DOWNLOADS_SORT_ORDER','3000','Sort order of display. Lowest is displayed first.',6,3,NULL,'2024-06-07 04:52:43',NULL,NULL),
(208,'Enable Login Form Module','MODULE_CONTENT_LOGIN_FORM_STATUS','True','Do you want to enable the login form module?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(209,'Sort Order','MODULE_CONTENT_LOGIN_FORM_SORT_ORDER','1000','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(210,'Enable New User Module','MODULE_CONTENT_CREATE_ACCOUNT_LINK_STATUS','True','Do you want to enable the new user module?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(211,'Sort Order','MODULE_CONTENT_CREATE_ACCOUNT_LINK_SORT_ORDER','2000','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(219,'Enable Module','MODULE_CONTENT_INDEX_CATEGORY_IMAGES_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(220,'Sort Order','MODULE_CONTENT_INDEX_CATEGORY_IMAGES_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(223,'Enable Module','MODULE_CONTENT_INDEX_CATEGORY_TITLE_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(224,'Sort Order','MODULE_CONTENT_INDEX_CATEGORY_TITLE_SORT_ORDER','21','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(230,'Enable Module','MODULE_CONTENT_INDEX_PRODUCT_LISTING_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(231,'Show products from subcategories','MODULE_CONTENT_INDEX_PRODUCT_LISTING_PRODUCTS_SUBCATEGORIES','True','Show products from subcategories?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(232,'Sort Order','MODULE_CONTENT_INDEX_PRODUCT_LISTING_SORT_ORDER','51','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(233,'Enable Best Sellers Module','MODULE_CONTENT_INDEX_SPECIAL_PRODUCTS_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(234,'Max number products to display','MODULE_CONTENT_INDEX_SPECIAL_PRODUCTS_MAX_DISPLAY_PRODUCTS','6','Maximum number of recently viewed products to display in a index page and category.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(235,'Sort Order','MODULE_CONTENT_INDEX_SPECIAL_PRODUCTS_SORT_ORDER','300','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(236,'Enable Module','MODULE_CONTENT_PRODUCT_INFO_ATTRIBUTES_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(237,'Sort Order','MODULE_CONTENT_PRODUCT_INFO_ATTRIBUTES_SORT_ORDER','1','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(242,'Enable Module','MODULE_CONTENT_PRODUCT_INFO_DESCRIPTION_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(243,'Block Placement','MODULE_CONTENT_PRODUCT_INFO_DESCRIPTION_BLOCK_PLACEMENT','Top','Place the description block on the top, bottom or footer?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'Top\', \'Bottom\', \'Footer\'), '),
(244,'Sort Order','MODULE_CONTENT_PRODUCT_INFO_DESCRIPTION_SORT_ORDER','5','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(245,'Enable Module','MODULE_CONTENT_PRODUCT_INFO_IMAGES_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(246,'Original Image Width','MODULE_CONTENT_PRODUCT_INFO_IMAGES_ORIGINAL_IMAGE_WIDTH','','The pixel width of original images.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(247,'Original Image Height','MODULE_CONTENT_PRODUCT_INFO_IMAGES_ORIGINAL_IMAGE_HEIGHT','360','The pixel height of original images.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(248,'Thumb Image Width','MODULE_CONTENT_PRODUCT_INFO_IMAGES_THUMB_IMAGE_WIDTH','','The pixel width of thumb images.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(249,'Thumb Image Height','MODULE_CONTENT_PRODUCT_INFO_IMAGES_THUMB_IMAGE_HEIGHT','96','The pixel height of thumb images.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(250,'Sort Order','MODULE_CONTENT_PRODUCT_INFO_IMAGES_SORT_ORDER','3','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(251,'Enable Module','MODULE_CONTENT_PRODUCT_INFO_MANUFACTURER_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(252,'Sort Order','MODULE_CONTENT_PRODUCT_INFO_MANUFACTURER_SORT_ORDER','2','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(253,'Enable Module','MODULE_CONTENT_PRODUCT_INFO_MODEL_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-06-07 04:52:43',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(254,'Sort Order','MODULE_CONTENT_PRODUCT_INFO_MODEL_SORT_ORDER','1','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:43',NULL,NULL),
(266,'Installed Modules','MODULE_FOOTER_INSTALLED','fm_information.php;fm_copyright.php','This is automatically updated. No need to edit.',6,0,'2024-10-13 09:59:41','2024-06-07 04:52:43',NULL,NULL),
(290,'Installed Modules','MODULE_HEADER_INSTALLED','hm_store_logo.php;hm_quick_search.php;hm_shopping_cart.php;hm_wishlist.php;hm_account.php;hm_categories.php','This is automatically updated. No need to edit.',6,0,'2024-10-21 22:03:51','2024-06-07 04:52:44',NULL,NULL),
(293,'Enable Module','MODULE_HEADER_CATEGORIES_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-06-07 04:52:44',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(294,'Sort Order','MODULE_HEADER_CATEGORIES_SORT_ORDER','1400','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:44',NULL,NULL),
(301,'Enable Module','MODULE_HEADER_QUICK_SEARCH_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-06-07 04:52:44',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(302,'Sort Order','MODULE_HEADER_QUICK_SEARCH_SORT_ORDER','2','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:44',NULL,NULL),
(305,'Enable Module','MODULE_HEADER_STORE_LOGO_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-06-07 04:52:44',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(306,'Sort Order','MODULE_HEADER_STORE_LOGO_SORT_ORDER','1','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:44',NULL,NULL),
(309,'Installed Modules','MODULE_LISTING_SORT_INSTALLED','ls_date_added.php;ls_price.php','This is automatically updated. No need to edit.',6,0,NULL,'2024-06-07 04:52:44',NULL,NULL),
(310,'Enable Module','MODULE_LISTING_SORT_DATE_ADDED_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-06-07 04:52:44',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(311,'Sort Order','MODULE_LISTING_SORT_DATE_ADDED_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-06-07 04:52:44',NULL,NULL),
(314,'Installed Modules','MODULE_PRODUCT_FILTERS_INSTALLED','','This is automatically updated. No need to edit.',6,0,NULL,'2024-06-07 04:52:44',NULL,NULL),
(315,'Enable Module','MODULE_FOOTER_COPYRIGHT_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-09-18 03:51:48',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(316,'Sort Order','MODULE_FOOTER_COPYRIGHT_SORT_ORDER','50','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-09-18 03:51:48',NULL,NULL),
(317,'Sort Order','OSCOM_APP_PAYPAL_BRAINTREE_CC_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-09-18 05:37:11',NULL,NULL),
(318,'Braintree App Parameter','OSCOM_APP_PAYPAL_BRAINTREE_TRANSACTIONS_ORDER_STATUS_ID','5','A parameter for the Braintree Application.',6,0,NULL,'2024-09-18 05:37:11',NULL,NULL),
(319,'Sort Order','MODULE_CONTENT_ACCOUNT_BRAINTREE_CARDS_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-09-18 05:37:11',NULL,NULL),
(320,'Enable Module','MODULE_CONTENT_INDEX_CATEGORY_DESCRIPTION_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-09-18 05:37:59',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(321,'Sort Order','MODULE_CONTENT_INDEX_CATEGORY_DESCRIPTION_SORT_ORDER','71','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-09-18 05:37:59',NULL,NULL),
(322,'Enable Module','MODULE_CONTENT_INDEX_NEW_PRODUCTS_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-09-18 05:40:29',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(323,'Max number products to display','MODULE_CONTENT_INDEX_NEW_PRODUCTS_MAX_DISPLAY_PRODUCTS','8','Maximum number of recently viewed products to display in a index page and category.',6,0,NULL,'2024-09-18 05:40:29',NULL,NULL),
(324,'Sort Order','MODULE_CONTENT_INDEX_NEW_PRODUCTS_SORT_ORDER','200','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-09-18 05:40:29',NULL,NULL),
(325,'Enable SEO URLs 5?','USU5_ENABLED','false','Turn Seo Urls 5 on',8,1,'2024-10-03 23:50:34','2024-09-20 14:32:17',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(326,'Enable the cache?','USU5_CACHE_ON','true','Turn the cache system on',8,2,'2024-10-03 07:53:13','2024-09-20 14:32:17',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(327,'Enable multi language support?','USU5_MULTI_LANGUAGE_SEO_SUPPORT','false','Enable the multi language functionality',8,3,'2024-09-20 14:32:17','2024-09-20 14:32:17',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(328,'Output W3C valid URLs?','USU5_USE_W3C_VALID','true','This setting will output W3C valid URLs.',8,4,'2024-09-20 14:32:17','2024-09-20 14:32:17',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(329,'Select your chosen cache system?','USU5_CACHE_SYSTEM','file','Choose from the 4 available caching strategies.',8,5,'2024-09-21 03:13:58','2024-09-20 14:32:17',NULL,'tep_cfg_select_option(array(\'mysql\', \'file\',\'sqlite\',\'memcache\'), '),
(330,'Set the number of days to store the cache.','USU5_CACHE_DAYS','7','Set the number of days you wish to retain cached data, after this the cache will auto reset.',8,6,'2024-09-20 14:32:17','2024-09-20 14:32:17',NULL,NULL),
(331,'Choose the uri format','USU5_URLS_TYPE','path_rewrite','<b>Choose USU5 URL format:</b>',8,7,'2024-09-20 21:43:10','2024-09-20 14:32:17',NULL,'tep_cfg_select_option(array(\'standard\',\'path_standard\',\'rewrite\',\'path_rewrite\',), '),
(332,'Choose how your product link text is made up','USU5_PRODUCTS_LINK_TEXT_ORDER','p','Product link text can be made up of:<br /><b>p</b> = product name<br /><b>c</b> = category name<br /><b>b</b> = manufacturer (brand)<br /><b>m</b> = model<br />e.g. <b>bp</b> (brand/product)',8,8,'2024-09-20 14:32:17','2024-09-20 14:32:17',NULL,NULL),
(333,'Filter Short Words','USU5_FILTER_SHORT_WORDS','1','<b>This setting will filter words.</b><br>1 = Remove words of 1 letter<br>2 = Remove words of 2 letters or less<br>3 = Remove words of 3 letters or less<br>',8,9,'2024-09-20 21:17:20','2024-09-20 14:32:17',NULL,'tep_cfg_select_option(array(\'1\',\'2\',\'3\',), '),
(334,'Add category parent to beginning of category uris?','USU5_ADD_CAT_PARENT','false','This setting will add the category parent name to the beginning of the category URLs (i.e. - parent-category-c-1.html).',8,10,'2024-09-20 21:35:57','2024-09-20 14:32:17',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(335,'Remove all non-alphanumeric characters?','USU5_REMOVE_ALL_SPEC_CHARS','false','This will remove all non-letters and non-numbers. If your language has special characters then you will need to use the character conversion system.',8,11,'2024-09-20 21:18:26','2024-09-20 14:32:17',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(336,'Add cPath to product URLs?','USU5_ADD_CPATH_TO_PRODUCT_URLS','false','This setting will append the cPath to the end of product URLs (i.e. - some-product-p-1.html?cPath=xx).',8,12,'2024-09-20 14:32:17','2024-09-20 14:32:17',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(337,'Enter special character conversions. <b>(Better to use the file based character conversions)</b>','USU5_CHAR_CONVERT_SET','','This setting will convert characters.<br><br>The format <b>MUST</b> be in the form: <b>char=>conv,char2=>conv2</b>',8,13,'2024-09-20 14:32:17','2024-09-20 14:32:17',NULL,NULL),
(338,'Turn performance reporting on true/false.','USU5_OUPUT_PERFORMANCE','false','<span style=\"color: red;\">Performance reporting should not be set to ON on a live site</span><br>It is for reporting re: performance and queries and shows at the bottom of your site.',8,14,'2024-09-20 14:32:17','2024-09-20 14:32:17',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(339,'Turn variable reporting on true/false.','USU5_DEBUG_OUPUT_VARS','false','<span style=\"color: red;\">Variable reporting should not be set to ON on a live site</span><br>It is for reporting the contents of USU classes and shows unformatted at the bottom of your site.',8,15,'2024-09-20 14:32:17','2024-09-20 14:32:17',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(340,'Force www.mysite.com/ when www.mysite.com/index.php','USU5_HOME_PAGE_REDIRECT','false','Force a redirect to www.mysite.com/ when www.mysite.com/index.php',8,16,'2024-09-20 14:32:17','2024-09-20 14:32:17',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),
(341,'Reset USU5 Cache','USU5_RESET_CACHE','false','This will reset the cache data for USU5',8,17,'2024-10-03 07:53:00','2024-09-20 14:32:17','tep_reset_cache_data_usu5','tep_cfg_select_option(array(\'reset\', \'false\'), '),
(342,'Enable Module','MODULE_BOXES_PRODUCT_FILTERS_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-09-21 02:17:09',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(343,'Sort Order','MODULE_BOXES_PRODUCT_FILTERS_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-09-21 02:17:09',NULL,NULL),
(344,'Installed Modules','MODULE_SOCIAL_MEDIA_INSTALLED','','This is automatically updated. No need to edit.',6,0,NULL,'2024-09-21 02:18:57',NULL,NULL),
(345,'Enable Module','MODULE_LISTING_SORT_PRICE_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-09-21 02:22:32',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(346,'Sort Order','MODULE_LISTING_SORT_PRICE_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-09-21 02:22:32',NULL,NULL),
(396,'Enable Module','MODULE_CONTENT_ACCOUNT_ANONYMIZE_DATA_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-09-26 04:10:39',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(397,'Sort Order','MODULE_CONTENT_ACCOUNT_ANONYMIZE_DATA_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-09-26 04:10:39',NULL,NULL),
(398,'Sort Order','MODULE_CAROUSEL_ROTATOR_SORT_ORDER','','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-09-26 04:12:14',NULL,NULL),
(399,'Content Width','MODULE_CAROUSEL_ROTATOR_CONTENT_WIDTH','12','What width container should the content be shown in?',6,1,NULL,'2024-09-26 04:12:14',NULL,'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), '),
(400,'Enable Banner Rotator','MODULE_CAROUSEL_ROTATOR_STATUS','True','Do you want to show the banner rotator?',6,1,NULL,'2024-09-26 04:12:14',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(401,'Hold Time','MODULE_CAROUSEL_ROTATOR_HOLD_TIME','4000','The time each banner is shown. 1000 = 1 second',6,0,NULL,'2024-09-26 04:12:14',NULL,NULL),
(402,'Banner Order','MODULE_CAROUSEL_ROTATOR_BANNER_ORDER','Asc','Order that the Banner Rotator uses to show the banners.',6,0,NULL,'2024-09-26 04:12:14',NULL,'tep_cfg_select_option(array(\'Asc\', \'Desc\'), '),
(403,'Banner Rotator Group','MODULE_CAROUSEL_ROTATOR_GROUP','rotator','Name of the banner group that the Banner Rotator uses to show the banners.',6,0,NULL,'2024-09-26 04:12:14',NULL,NULL),
(404,'Banner Rotator Max Banners','MODULE_CAROUSEL_ROTATOR_MAX_DISPLAY','4','Maximum number of banners that the Banner Rotator will show',6,0,NULL,'2024-09-26 04:12:14',NULL,NULL),
(406,'DISPLAY_PRICES','DISPLAY_PRICES','false','DISPLAY_PRICES',1,9999,'2024-09-28 03:18:51','2024-09-28 03:18:51',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(407,'Braintree App Parameter','OSCOM_APP_PAYPAL_BRAINTREE_CC_STATUS','-1','A parameter for the Braintree Application.',6,0,NULL,'2024-09-28 04:36:00',NULL,NULL),
(408,'Create Tokens','OSCOM_APP_PAYPAL_BRAINTREE_CC_CC_TOKENS','0','Create and store tokens for card payments customers can use on their next purchase?',6,0,NULL,'2024-09-28 04:36:00',NULL,NULL),
(409,'Order Status','OSCOM_APP_PAYPAL_BRAINTREE_CC_ORDER_STATUS_ID','0','Set this to the order status level that is assigned to new orders.',6,0,NULL,'2024-09-28 04:36:00',NULL,NULL),
(410,'PayPal Button Shape','OSCOM_APP_PAYPAL_BRAINTREE_CC_PAYPAL_BUTTON_SHAPE','1','The shape of the PayPal checkout button.',6,0,NULL,'2024-09-28 04:36:00',NULL,NULL),
(411,'Payment Zone','OSCOM_APP_PAYPAL_BRAINTREE_CC_ZONE','0','Enable this payment module globally or limit it to customers shipping to the selected zone only.',6,0,NULL,'2024-09-28 04:36:00',NULL,NULL),
(412,'Verify CVV','OSCOM_APP_PAYPAL_BRAINTREE_CC_VERIFY_CVV','1','Verify the credit card billing address with the Card Verification Value (CVV)?',6,0,NULL,'2024-09-28 04:36:00',NULL,NULL),
(413,'PayPal Button Size','OSCOM_APP_PAYPAL_BRAINTREE_CC_PAYPAL_BUTTON_SIZE','2','The size of the PayPal checkout button.',6,0,NULL,'2024-09-28 04:36:00',NULL,NULL),
(414,'Transaction Method','OSCOM_APP_PAYPAL_BRAINTREE_CC_TRANSACTION_METHOD','1','Set this to Payment to immediately capture the funds for every order made.',6,0,NULL,'2024-09-28 04:36:00',NULL,NULL),
(415,'Payment Types','OSCOM_APP_PAYPAL_BRAINTREE_CC_PAYMENT_TYPES','','Enable the payment types to make available.',6,0,NULL,'2024-09-28 04:36:00',NULL,NULL),
(416,'PayPal Button Color','OSCOM_APP_PAYPAL_BRAINTREE_CC_PAYPAL_BUTTON_COLOR','1','The color of the PayPal checkout button.',6,0,NULL,'2024-09-28 04:36:00',NULL,NULL),
(417,'Entry Form','OSCOM_APP_PAYPAL_BRAINTREE_CC_ENTRY_FORM','3','Which method should be used to accept the card payment details (card number, expiry date, ..).',6,0,NULL,'2024-09-28 04:36:00',NULL,NULL),
(418,'3D Secure','OSCOM_APP_PAYPAL_BRAINTREE_CC_THREE_D_SECURE','0','Authenticate eligible card holders with 3D Secure?',6,0,NULL,'2024-09-28 04:36:00',NULL,NULL),
(419,'Braintree App Parameter','OSCOM_APP_PAYPAL_BRAINTREE_VERIFY_SSL','1','A parameter for the Braintree Application.',6,0,NULL,'2024-09-28 04:36:00',NULL,NULL),
(420,'Braintree App Parameter','OSCOM_APP_PAYPAL_BRAINTREE_PROXY','','A parameter for the Braintree Application.',6,0,NULL,'2024-09-28 04:36:00',NULL,NULL),
(421,'SSL Version','OSCOM_APP_PAYPAL_BRAINTREE_SSL_VERSION','0','Use the default cURL configured SSL version connection setting when making API calls to Braintree\'s servers or force TLS v1.2 connections.',6,0,NULL,'2024-09-28 04:36:00',NULL,NULL),
(422,'Braintree App Parameter','OSCOM_APP_PAYPAL_BRAINTREE_VERSION_CHECK','28','A parameter for the Braintree Application.',6,0,NULL,'2024-09-28 04:36:01',NULL,NULL),
(423,'Enable Module','MODULE_HEADER_ACCOUNT_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-10-06 01:20:36',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(424,'Sort Order','MODULE_HEADER_ACCOUNT_SORT_ORDER','7','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-10-06 01:20:36',NULL,NULL),
(425,'Enable Module','MODULE_HEADER_SHOPPING_CART_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-10-06 04:04:18',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(426,'Sort Order','MODULE_HEADER_SHOPPING_CART_SORT_ORDER','5','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-10-06 04:04:18',NULL,NULL),
(427,'Enable Module','MODULE_HEADER_WISHLIST_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-10-06 04:04:26',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(428,'Sort Order','MODULE_HEADER_WISHLIST_SORT_ORDER','6','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-10-06 04:04:26',NULL,NULL),
(431,'Enable Module','MODULE_CONTENT_PRODUCT_INFO_BUY_BUTTON_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-10-08 00:13:24',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(432,'Sort Order','MODULE_CONTENT_PRODUCT_INFO_BUY_BUTTON_SORT_ORDER','2','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-10-08 00:13:24',NULL,NULL),
(435,'Enable Module','MODULE_CONTENT_PRODUCT_INFO_PRICE_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-10-08 01:02:06',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(436,'Sort Order','MODULE_CONTENT_PRODUCT_INFO_PRICE_SORT_ORDER','1','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-10-08 01:02:06',NULL,NULL),
(440,'Use SummerNote','USE_SUMMERNOTE_ADMIN_TEXTAREA','true','Use SummerNote for WYSIWYG editing of textarea fields in admin',1,99,NULL,'2024-10-09 06:39:41',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),
(441,'Enable Module','MODULE_CONTENT_INDEX_CUSTOMER_GREETING_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-10-12 06:31:40',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(442,'Sort Order','MODULE_CONTENT_INDEX_CUSTOMER_GREETING_SORT_ORDER','100','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-10-12 06:31:40',NULL,NULL),
(443,'Enable Module','MODULE_FOOTER_INFORMATION_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2024-10-13 09:59:41',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),
(444,'Sort Order','MODULE_FOOTER_INFORMATION_SORT_ORDER','40','Sort order of display. Lowest is displayed first.',6,0,NULL,'2024-10-13 09:59:41',NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
(8,'Seo Urls 5','Options for ULTIMATE Seo Urls 5 by FWR Media',16,1),
(9,'Stock','Stock configuration options',9,1),
(10,'Logging','Logging configuration options',10,1),
(11,'Cache','Caching configuration options',11,1),
(12,'E-Mail Options','General setting for E-Mail transport and HTML E-Mails',12,1),
(13,'Download','Downloadable products options',13,1),
(14,'GZip Compression','GZip compression options',14,1),
(15,'Sessions','Session options',15,1);
/*!40000 ALTER TABLE `configuration_group` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
  `subtemplate` varchar(64) NOT NULL DEFAULT '',
  `tag` varchar(256) NOT NULL DEFAULT '',
  `status` int(1) NOT NULL DEFAULT 1,
  `inline` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=273 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
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
(186,'form:first-of-type','display:inline',0,0,0,'','','',1,0),
(190,'form:first-of-type > button:first-of-type','vertical-align: bottom;opacity: 0.85 !important;\r\nborder:0;width:30px;height:30px;background:url(\"data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAiIGhlaWdodD0iMzAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTEwLDE4YzEuODQ2LDAsMy41NDMtMC42MzUsNC44OTctMS42ODhsNC4zOTYsNC4zOTZsMS40MTQtMS40MTRsLTQuMzk2LTQuMzk2QzE3LjM2NSwxMy41NDMsMTgsMTEuODQ2LDE4LDEwIGMwLTQuNDExLTMuNTg5LTgtOC04cy04LDMuNTg5LTgsOFM1LjU4OSwxOCwxMCwxOHogTTEwLDRjMy4zMDksMCw2LDIuNjkxLDYsNnMtMi42OTEsNi02LDZzLTYtMi42OTEtNi02UzYuNjkxLDQsMTAsNHoiLz48L3N2Zz4K\")',0,0,0,'','','',1,0),
(193,'input,button','border-radius:0; border:1px solid #ccc',0,0,0,'','','',1,0),
(194,'input[name=\"keywords\"]','font-size:110%;width:30vw;margin-left: 4vw;position:relative;top:-8px',0,0,0,'','','',1,0),
(195,'a','text-decoration:none',0,0,0,'','','',1,0),
(196,'p a','text-decoration:underline',0,0,0,'','','',1,0),
(203,'a[href$=\"account.php\"]','background:url(\"data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAiIGhlaWdodD0iMzAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxjaXJjbGUgZmlsbD0ibm9uZSIgY3g9IjEyIiBjeT0iNyIgcj0iMyIvPjxwYXRoIGQ9Ik0xMiAyQzkuMjQzIDIgNyA0LjI0MyA3IDdzMi4yNDMgNSA1IDUgNS0yLjI0MyA1LTVTMTQuNzU3IDIgMTIgMnpNMTIgMTBjLTEuNjU0IDAtMy0xLjM0Ni0zLTNzMS4zNDYtMyAzLTMgMyAxLjM0NiAzIDNTMTMuNjU0IDEwIDEyIDEwek0yMSAyMXYtMWMwLTMuODU5LTMuMTQxLTctNy03aC00Yy0zLjg2IDAtNyAzLjE0MS03IDd2MWgydi0xYzAtMi43NTcgMi4yNDMtNSA1LTVoNGMyLjc1NyAwIDUgMi4yNDMgNSA1djFIMjF6Ii8+Cjwvc3ZnPg==\")\r\n',0,0,0,'','','',0,0),
(204,'a[href$=\"shopping_cart.php\"]','background:url(\"data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAiIGhlaWdodD0iMzAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxwYXRoIGQ9Ik0yMS44MjIsNy40MzFDMjEuNjM1LDcuMTYxLDIxLjMyOCw3LDIxLDdINy4zMzNMNi4xNzksNC4yM0M1Ljg2NywzLjQ4Miw1LjE0MywzLDQuMzMzLDNIMnYyaDIuMzMzbDQuNzQ0LDExLjM4NSBDOS4yMzIsMTYuNzU3LDkuNTk2LDE3LDEwLDE3aDhjMC40MTcsMCwwLjc5LTAuMjU5LDAuOTM3LTAuNjQ4bDMtOEMyMi4wNTIsOC4wNDQsMjIuMDA5LDcuNywyMS44MjIsNy40MzF6IE0xNy4zMDcsMTVoLTYuNjQgbC0yLjUtNmgxMS4zOUwxNy4zMDcsMTV6Ii8+PGNpcmNsZSBjeD0iMTAuNSIgY3k9IjE5LjUiIHI9IjEuNSIvPjxjaXJjbGUgY3g9IjE3LjUiIGN5PSIxOS41IiByPSIxLjUiLz4KPC9zdmc+Cg==\")\r\n',0,0,0,'','','',0,0),
(205,'a[href$=\"wishlist.php\"]','background:url(\"data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAiIGhlaWdodD0iMzAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxwYXRoIGQ9Ik0xMiw0LjU5NWMtMS4xMDQtMS4wMDYtMi41MTItMS41NTgtMy45OTYtMS41NThjLTEuNTc4LDAtMy4wNzIsMC42MjMtNC4yMTMsMS43NThjLTIuMzUzLDIuMzYzLTIuMzUyLDYuMDU5LDAuMDAyLDguNDEyIGw3LjMzMiw3LjMzMmMwLjE3LDAuMjk5LDAuNDk4LDAuNDkyLDAuODc1LDAuNDkyYzAuMzIyLDAsMC42MDktMC4xNjMsMC43OTItMC40MDlsNy40MTUtNy40MTUgYzIuMzU0LTIuMzU0LDIuMzU0LTYuMDQ5LTAuMDAyLTguNDE2Yy0xLjEzNy0xLjEzMS0yLjYzMS0xLjc1NC00LjIwOS0xLjc1NEMxNC41MTMsMy4wMzcsMTMuMTA0LDMuNTg5LDEyLDQuNTk1eiBNMTguNzkxLDYuMjA1IGMxLjU2MywxLjU3MSwxLjU2NCw0LjAyNSwwLjAwMiw1LjU4OEwxMiwxOC41ODZsLTYuNzkzLTYuNzkzQzMuNjQ1LDEwLjIzLDMuNjQ2LDcuNzc2LDUuMjA1LDYuMjA5IGMwLjc2LTAuNzU2LDEuNzU0LTEuMTcyLDIuNzk5LTEuMTcyczIuMDM1LDAuNDE2LDIuNzg5LDEuMTdsMC41LDAuNWMwLjM5MSwwLjM5MSwxLjAyMywwLjM5MSwxLjQxNCwwbDAuNS0wLjUgQzE0LjcxOSw0LjY5OCwxNy4yODEsNC43MDIsMTguNzkxLDYuMjA1eiIvPgo8L3N2Zz4=\")\r\n',0,0,0,'','','',0,0),
(206,'a:visited','color:#666',0,0,0,'','','',1,0),
(207,'a:link','color:#333',0,0,0,'','','',1,0),
(208,'body > center > table:nth-child(1) > tbody  > tr > td:nth-child(1)  > a:nth-child(1)','display:none',0,768,0,'','','',1,0),
(209,'#nav:target{ display: block; }',NULL,0,0,0,'','','',1,0),
(211,'.col2','width:48%;\r\nfloat:left',0,0,0,'','','',1,0),
(213,'.col2','background:red;overflow:auto;\r\ndisplay:table-row',0,0,0,'','','',0,0),
(214,'a:active','color: red',0,0,0,'','','',1,0),
(216,'input[name=\"keywords\"]','margin-left: 0 !important; width:90% !important',0,0,768,'','','',1,0),
(230,'body > center > table:nth-child(1) > tbody > tr:nth-child(1) > td:nth-child(1) > a:nth-child(1)','display:inline-block;width:21vw;height:50px; background-size:contain !important; background: url(\"data:image/gif;base64,R0lGODlhPgEyAOcAAAAAAA8AABYAAxwAACEBASYBAC0BAjIAAAsNCjgABDoAAEAAAEIAADwCAkQBAk0BA08BAFMAAFQAAFcAAFgBAF8AAF8AA2AAABQWFGgAAmMCAGwCAHUAAG0DAHYBABscGm8FAoAAAHcDAYECAIcAA4gAAIkAAIsAAIMEAZMAAJQAACEjIJwAAp8AAJcDAKEAACsiIqcAApgFAaICAKkAA6sAACUnJK0BAKMFALMAAi8mJrUAA7cAALcABL4AALkCAMAAAcEAAsIAAq8HADMqKsMBA8kAAMsAAMwAAM0AALoGAM4AAcUEADctLtYAANcAANoAANADAjAyL9sBAMYIAOEABOIABeMABuUAAOYAAOUABzI0MtEHA9wFAecEADY4Nd0JAjg6ODw+O0E9PD5APUM/PkZCQUlEQ0pGRU1JSE9LSlJNTFNOTVRPTlVRUFZSUVxRUllVVFpWVVtXVl1ZV19aWWFcW2JdXGNeXWZhYGdjYmhkY2pmZWtnZnJnaG1paG5qaXRpanVqa3ZrbHNvbXRwbnVxb3ZycHdzcXl0c3p1dHt2dX14d4N4eIB7eoF8e4J9fIN+fYh9fYR/fol+foWAf4aBgIeCgYiDgomEg4qFhIuGhYyHho6JiI+KiZCLipGMi5iNjZOPjZmOjpSQjpWRj5aSkJeTkZ+TlJmVk6CUlZuWlKGVlp2Ylp6ZmKSYmZ+amaWZmqaam6KdnKOenaSfnqWgn6ufoKahoK2hoqijoq6io6mko6+kpLGlpbKmprOnp7SoqLWpqbaqqrerq7isrbmtrrqur7Wwr7uvsLywsb2xsr6ys8CztMG0tcK1try3tsO3t8S4uMW5uca6use7u8i8vMm9vsq+v8u/wMbBwM3Awc7Bws/Cw9DDxNHFxdLGxtPHx9TIyNXJydbKy9jLzNnMzdrNztvOz9zP0N3R0d7S0t/T0+DU1OHV1ePW1+TX2OXY2ebZ2ufa2+jc3Ond3ere3uzf3+3g4e7h4u/i4/Dj5PHk5fLl5gAAAAAAACH5BAEKAP8ALAAAAAA+ATIAAAj+AAEIHEiwoMGDCBMqXMiwocOHECNKnEixosWLGDNq3Mixo8ePIEOKHEmypMmTKFOqXMmypcuXMGPKnEmzps2bOHPq3Mmzp8+fQA2eaZRqlq9etE4pEpPxgyBSRnW5+pTnw8UxjlbV+nVLlaY4QcOKRemombx+aNOqdUcs0EQMl77pU6tW3zhdeSLmEeaOrtp73Vq1GevSll+0/O7Ja2dtlyHCIS+hO0y537dBEP+kq+w3XSymC+tY48dZLb9vnBBATmm4dNp2rFZv/ELN9eF9wDA0BLXPNl1AC1Pd8602nmrZFk9scNiauLg0yC2maUf8MDcbCyf1rt7P3EJl3NP+ApP4okH0E1y8nGCeVl6v972EHbOmjrTadGGiTxxDPTzdbscd1MRZ4ZWiEHj+8QOHRGBcUYN5hKHnxYTrNdQcOgit0ctwaUmjn0TccMbONs40w807nPWSEC+UwUNNMtJ8Uw9d9eiQ0CmcpWPNMtSIM5da4EwExoQOQgiUhBNSyB5aGCZ0B4H98MPHhw/heBg/zdxh0B/WULZPHwhNRtc+rAQo0F7woIVMQnRw6NczdhRExCbgpOWJkEl6UaRPSOap3pL9NJnQImoJQ2VDMMRz2D2OKESKff8dVMZhxCSEwCXh1JFQl37tc4lCeFhDD3YM+qnngzkFcIITpup5g5H+C13I0DhpCXpoQqhQtglDulD2h0F+HPYrRYBQNkpDoEnUZ54OMlCTqqyaCgYOCkAk60LApFVPQZekNQ9DZ6j1xUFp0UIQJdrIs501CB2izDn37KNPPN7IUoZF5RymTUMI9EfXMQZRcpimFDVz2DYljYBEq83GBG2rULBQgETXKrRKWvzoNlC3aH27ULhpjWtQWoYCsMU2fg1jEB/iVHaPL1ZJ1AZleTX0yWHyGMTIYaRQBIObGGtpkghUMFyDsyypmp6pTqgwAEUVJ5QKxmZy3I/HCoGMlsgFdQgAGeYc1kpBovzI2ThcP0TKYbYupAPQaQk9EB6HxbPGRI0cJo7+ShsEwfANSJ+kdKtLkHBR1Aj1ihY93HoLrrjkouXNB2Gjlc4ywlQzDyUEdQJpP+c0E8wx3AAdjsYPQXOYLxCh7JcqBf2MMycSBXPYKyxpwMPfgYs0uKlUiJAR4gd1k1aQBFmNdUJa95P2QLUKg9Y6hxCEAakA1OGmOWASJIbB5UZEq1+SQJTLYckYxOlh4QgC0TeHTdlSBDtcYeoVgIf0u59BLKcR8QVpg9nMlTzHfQxyI0PLPkjzjecVJERoEQcMEPKMtNyjCRCBkloG85BNHKYbBklEabYxLIb0ZUwrgIkDamA/P+Gvdxl5mJ+wwAMLdASAA7EB/NByj3sVsGP+jwtZ5NICDyko5A8WvBtCwuCmVUDkcwqMSB8Ok46DTMM11pBbQrazlpkkYAZDcmH+MCJDZg0BAh/BIQD4MD60lOyHVwvi1oaIlkUsZBlpUcZCopEWhDmkCYfZFkTmcBh3CEhMnNnHMoyIEBuwrSYFkAEU7jdGiqxKWjGA1Q1rNZAPiEEOkriFOD5Xjgk2DogHFGIC0VIOhqQJLYwITnse0ry0xCMiZsAZQs6QL9fAI5YHyaVf9maTAaggWsx6FUXCmCQovMAAI2mOb8JBhoMoT47Oo+MtFpIGtWxhIZFQiykZIky6wCMitURLzhACg2JA8TY9Ewr7UnWCJZiqQqX+yhMPMkASaZbmHriImUGumco5rrIfj1jIzvzTjzM4RAeBjAgh/WJIhRSiZa45VkGkcBjv5KQAKmCmkvBkKiScgAAh8edtyjGLZFnTgFlDYNfSUrOEjIKh/XjDQ7iYln1EBIl+aRtCLrEZztxDDgVBwDvbgZMJ3ECkSTLcRHTXQj+BIQYPSGN74LMLW8CCE34gQkMIGlNVzhQtdFhIK3C6IIcoyi8cdIgH/cKNDqqDM34kCD38co9nhaAIrfKCSQVgEQbEYJKtCoIHNskki5A1IWuQKUHUklaFxMKC8MmsZjWbH4dglC6ce8guDlMMiCAgFBo0jRkKUjm6sEEmDHj+AWJNFQQQbIQAKrBnq5wggwP8j5MVeSxC7iBZ6KWlsjeyYEjw6JdftO4wqZDIF9ZHl04U5Ip+0QRMOsCDqiYzAiDxgN8YtgMNYESNY4VpQgxRXIFQdiGWUAsjPeIJKj7kbQOjCHXTkouCrNUv0WgJSHVrKijIAJojmUD9AmuEExAWasClSHwXxxArGfSs/UAuQiaKlkZ95Azv7MceHCKKulUknf0oLUHyEEixpoQCN/BunowQgpQkQLaBhQIOHDAR9DJkof3o60LAd+HJHpche0VLpUASjoPxix2ktUhq+xEMg/hLLbgQ3AiKxjAemJclAjjBwlqFBSXY1loRnsj+FNPSVoQgQIMOBMB7F4LdftQIJGs7DO0Wcr7D1HQgmoirQlYAt364wiDZ4qsWQRLb2Vo1BjyOyQZ8EFgvLEEFKLVQmiWyBS7iLiGloEuc56yQQ6hFxR75AIr4mtCEmCLEeSXIN/bRDU0I9CCmOAwwCXKGQvfjHW1mXmgj0gElyDhJXFDBxGrygBpANUn4jNWmJVLUfsTDpQSpQ5LNamS0NqROiIHdQtQwkZtdqRlxKggg9tvTPw9kh/2QBzEYgb2BcKLQ9UAdQY5BmXvQYgwGQQAgbjEOfoyDpLQVnk4K4AJkQhtQQo2I4tByDoINBAGgmPKoj8wQ7allGsEeSBj+PrENfeiXM+uwRjNM9ErKZPkg8LZgOVSuDGu0/F8IkcKqbzMOayijGdaAl1oOns8kXWEHFABKCLg8Uob4mCFimFFPxVEMYBxDG1LvhzXmwW3jershleApP9AhOmEkwxrr2A4/KPKFu+IULexCSMyrQ4/OHqQQvrYN0SPCTGdWSywa6IH9oq2Qp/+Yp5QZhxQ+u/GvN8QRWS/N2ilihmr7RxsplLt/9NGIhUDCbNXZO0SGNFjZMAAHi9V0YzEiiCuPqRgTJHLjMwyRMzQD9ItqhkWkIA3/7GMXZjLI3G1zj0k0hBA3943oH7ID/91K2qvHyKWeoY567OMe7+iGKhyqKpDLFtnrtEcnK6zRjnvw4/rvAAcxJDFOi0wCkbbxhh8YMovIu8Ybgl6IGI6B+9Ls6/kAuBqN4AxTphbtMAzA4RArsAnQsHM40wwJGBFsoAvoEGJoYRfCUEIBuIGEcQaPkAq0cBRJoQh2NxFicAhQkQvAYAurcAnkhhFSgAinYBS/gAuucAl5UG8cuIM82IM++INAGIRCOIREWIRGeIRImIRKuIRM2IRGGBAAOw==\") no-repeat;background-position: left bottom',0,0,0,'','','',1,0),
(252,'h3','margin-bottom:0',0,0,0,'','','',1,0),
(253,'.flc a','float:left;margin-right:1em',0,0,0,'','','',1,0),
(255,'td','display:block; width:100%',0,0,768,'','','',1,1),
(256,'table','border:1px solid #555 !important',0,0,0,'','','debug',0,0),
(257,'#m:target','display: table-cell',0,0,0,'','','',1,0),
(261,'#m > a','color: #fff; display: inline-block; margin-right:2em',0,0,0,'','','',1,0),
(262,'u','display:none',0,0,0,'','','',1,0),
(264,'body > center >  table:nth-child(1) > tbody > tr:nth-child(1) > td:nth-child(3) > a','margin-left: 0.4vw;font-size:130%;font-weight:bold',0,0,0,'','','',1,0),
(265,'#cim > a > img, #cim > a','float:left; margin-right:1em',0,0,0,'','','',1,0),
(266,'body > center > table:last-of-type > tbody >  tr > td ','text-align:center',0,0,0,'','','',1,0),
(267,'#f','border-top: 2px dashed gray;1em;padding-top:.6em',0,0,0,'','','footer',1,0),
(268,'body > center > table:last-of-type','margin-top:1em !important',0,0,0,'','','',1,0),
(269,'#m','display: none',0,0,768,'','','',1,0),
(270,'#m','background: #000\r\n\r\n',0,0,0,'','','',1,0),
(271,'a[href$=\"m\"]','display: none',0,768,0,'','','',1,0),
(272,'table','border-spacing: 0px',0,0,0,'','','',1,0);
/*!40000 ALTER TABLE `css` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES
(1,'Česká koruna','CZK','',' Kč',',','.','',1.00000000,'2024-06-07 04:52:43'),
(3,'U.S. Dollar','USD','$','','.',',','',1.00000000,NULL);
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `customers_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_gender` char(1) DEFAULT NULL,
  `customers_firstname` varchar(255) NOT NULL,
  `customers_lastname` varchar(255) NOT NULL,
  `customers_dob` datetime DEFAULT NULL,
  `customers_email_address` varchar(255) NOT NULL,
  `customers_default_address_id` int(11) DEFAULT NULL,
  `customers_telephone` varchar(255) NOT NULL,
  `customers_fax` varchar(255) DEFAULT NULL,
  `customers_password` varchar(60) NOT NULL,
  `customers_newsletter` char(1) DEFAULT NULL,
  PRIMARY KEY (`customers_id`),
  KEY `idx_customers_email_address` (`customers_email_address`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES
(1,NULL,'Šimon','Formánek',NULL,'f@simonformanek.cz',1,'602604992','','$P$D0s/SJO6S7l6.6zB.w0otsWTzGF1lc/','1');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers_basket_attributes`
--

LOCK TABLES `customers_basket_attributes` WRITE;
/*!40000 ALTER TABLE `customers_basket_attributes` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers_basket_attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers_braintree_tokens`
--

DROP TABLE IF EXISTS `customers_braintree_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers_braintree_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `braintree_token` varchar(255) NOT NULL,
  `card_type` varchar(32) NOT NULL,
  `number_filtered` varchar(20) NOT NULL,
  `expiry_date` char(6) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_cbraintreet_customers_id` (`customers_id`),
  KEY `idx_cbraintreet_token` (`braintree_token`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers_braintree_tokens`
--

LOCK TABLES `customers_braintree_tokens` WRITE;
/*!40000 ALTER TABLE `customers_braintree_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers_braintree_tokens` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers_info`
--

LOCK TABLES `customers_info` WRITE;
/*!40000 ALTER TABLE `customers_info` DISABLE KEYS */;
INSERT INTO `customers_info` VALUES
(1,'2024-10-21 15:18:37',1,'2024-10-21 15:16:49',NULL,0,NULL,NULL);
/*!40000 ALTER TABLE `customers_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers_wishlist`
--

DROP TABLE IF EXISTS `customers_wishlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers_wishlist` (
  `customers_wishlist_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL DEFAULT 0,
  `products_id` tinytext NOT NULL,
  `customers_wishlist_date_added` char(8) DEFAULT NULL,
  PRIMARY KEY (`customers_wishlist_id`),
  KEY `idx_wishlist_customers_id` (`customers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers_wishlist`
--

LOCK TABLES `customers_wishlist` WRITE;
/*!40000 ALTER TABLE `customers_wishlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers_wishlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers_wishlist_attributes`
--

DROP TABLE IF EXISTS `customers_wishlist_attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers_wishlist_attributes` (
  `customers_wishlist_attributes_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `products_id` tinytext NOT NULL,
  `products_options_id` int(11) NOT NULL,
  `products_options_value_id` int(11) NOT NULL,
  PRIMARY KEY (`customers_wishlist_attributes_id`),
  KEY `idx_wishlist_att_customers_id` (`customers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers_wishlist_attributes`
--

LOCK TABLES `customers_wishlist_attributes` WRITE;
/*!40000 ALTER TABLE `customers_wishlist_attributes` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers_wishlist_attributes` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `geo_zones`
--

LOCK TABLES `geo_zones` WRITE;
/*!40000 ALTER TABLE `geo_zones` DISABLE KEYS */;
INSERT INTO `geo_zones` VALUES
(1,'Florida','Florida local sales tax zone',NULL,'2024-06-07 04:52:43');
/*!40000 ALTER TABLE `geo_zones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `information_pages`
--

DROP TABLE IF EXISTS `information_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `information_pages` (
  `pages_id` int(11) NOT NULL AUTO_INCREMENT,
  `pages_date_added` datetime DEFAULT NULL,
  `pages_last_modified` datetime DEFAULT NULL,
  `pages_status` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(3) DEFAULT NULL,
  PRIMARY KEY (`pages_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `information_pages`
--

LOCK TABLES `information_pages` WRITE;
/*!40000 ALTER TABLE `information_pages` DISABLE KEYS */;
INSERT INTO `information_pages` VALUES
(1,'2024-06-07 04:52:43',NULL,1,3),
(2,'2024-06-07 04:52:43',NULL,1,2),
(3,'2024-06-07 04:52:43',NULL,1,1),
(4,'2024-06-07 04:52:43',NULL,0,1),
(5,'2024-06-07 04:52:43',NULL,1,1);
/*!40000 ALTER TABLE `information_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `information_pages_content`
--

DROP TABLE IF EXISTS `information_pages_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `information_pages_content` (
  `pages_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` tinyint(1) NOT NULL DEFAULT 1,
  `pages_name` varchar(255) NOT NULL,
  `pages_content` text DEFAULT NULL,
  PRIMARY KEY (`pages_id`,`language_id`),
  KEY `pages_name` (`pages_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `information_pages_content`
--

LOCK TABLES `information_pages_content` WRITE;
/*!40000 ALTER TABLE `information_pages_content` DISABLE KEYS */;
INSERT INTO `information_pages_content` VALUES
(1,2,'Shipping & Returns','Put here your Shipping & Returns information.'),
(2,2,'Privacy Notice','Put here your Privacy Notice information. '),
(3,2,'Conditions of Use','Put here your Conditions of Use information.'),
(4,2,'Returns & Refunds','Put here your Returns & Refunds information.'),
(5,2,'Cookie Policy','Put here your Cookie Policy information.');
/*!40000 ALTER TABLE `information_pages_content` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES
(2,'english','en','icon.gif','english',1);
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manufacturers`
--

DROP TABLE IF EXISTS `manufacturers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manufacturers` (
  `manufacturers_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturers_name` varchar(64) NOT NULL,
  `manufacturers_image` varchar(255) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`manufacturers_id`),
  KEY `IDX_MANUFACTURERS_NAME` (`manufacturers_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manufacturers`
--

LOCK TABLES `manufacturers` WRITE;
/*!40000 ALTER TABLE `manufacturers` DISABLE KEYS */;
INSERT INTO `manufacturers` VALUES
(1,'Šimon Formánek',NULL,'2024-10-09 07:38:59','2024-10-09 07:38:59');
/*!40000 ALTER TABLE `manufacturers` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manufacturers_info`
--

LOCK TABLES `manufacturers_info` WRITE;
/*!40000 ALTER TABLE `manufacturers_info` DISABLE KEYS */;
INSERT INTO `manufacturers_info` VALUES
(1,2,'',0,NULL);
/*!40000 ALTER TABLE `manufacturers_info` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletters`
--

LOCK TABLES `newsletters` WRITE;
/*!40000 ALTER TABLE `newsletters` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `orders_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `customers_name` varchar(255) NOT NULL,
  `customers_company` varchar(255) DEFAULT NULL,
  `customers_street_address` varchar(255) NOT NULL,
  `customers_suburb` varchar(255) DEFAULT NULL,
  `customers_city` varchar(255) NOT NULL,
  `customers_postcode` varchar(255) NOT NULL,
  `customers_state` varchar(255) DEFAULT NULL,
  `customers_country` varchar(255) NOT NULL,
  `customers_telephone` varchar(255) NOT NULL,
  `customers_email_address` varchar(255) NOT NULL,
  `customers_address_format_id` int(5) NOT NULL,
  `delivery_name` varchar(255) NOT NULL,
  `delivery_company` varchar(255) DEFAULT NULL,
  `delivery_street_address` varchar(255) NOT NULL,
  `delivery_suburb` varchar(255) DEFAULT NULL,
  `delivery_city` varchar(255) NOT NULL,
  `delivery_postcode` varchar(255) NOT NULL,
  `delivery_state` varchar(255) DEFAULT NULL,
  `delivery_country` varchar(255) NOT NULL,
  `delivery_address_format_id` int(5) NOT NULL,
  `billing_name` varchar(255) NOT NULL,
  `billing_company` varchar(255) DEFAULT NULL,
  `billing_street_address` varchar(255) NOT NULL,
  `billing_suburb` varchar(255) DEFAULT NULL,
  `billing_city` varchar(255) NOT NULL,
  `billing_postcode` varchar(255) NOT NULL,
  `billing_state` varchar(255) DEFAULT NULL,
  `billing_country` varchar(255) NOT NULL,
  `billing_address_format_id` int(5) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `cc_type` varchar(20) DEFAULT NULL,
  `cc_owner` varchar(255) DEFAULT NULL,
  `cc_number` varchar(32) DEFAULT NULL,
  `cc_expires` varchar(4) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_purchased` datetime DEFAULT NULL,
  `orders_status` int(5) NOT NULL,
  `orders_date_finished` datetime DEFAULT NULL,
  `currency` char(3) DEFAULT NULL,
  `currency_value` decimal(14,6) DEFAULT NULL,
  PRIMARY KEY (`orders_id`),
  KEY `idx_orders_customers_id` (`customers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_products`
--

LOCK TABLES `orders_products` WRITE;
/*!40000 ALTER TABLE `orders_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_products` ENABLE KEYS */;
UNLOCK TABLES;

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
  `options_values_price` decimal(15,4) NOT NULL,
  `price_prefix` char(1) NOT NULL,
  PRIMARY KEY (`orders_products_attributes_id`),
  KEY `idx_orders_products_att_orders_id` (`orders_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_products_attributes`
--

LOCK TABLES `orders_products_attributes` WRITE;
/*!40000 ALTER TABLE `orders_products_attributes` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_products_attributes` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_products_download`
--

LOCK TABLES `orders_products_download` WRITE;
/*!40000 ALTER TABLE `orders_products_download` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_products_download` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_status`
--

DROP TABLE IF EXISTS `orders_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_status` (
  `orders_status_id` int(11) NOT NULL DEFAULT 0,
  `language_id` int(11) NOT NULL DEFAULT 1,
  `orders_status_name` varchar(32) NOT NULL,
  `public_flag` int(11) DEFAULT 1,
  `downloads_flag` int(11) DEFAULT 0,
  PRIMARY KEY (`orders_status_id`,`language_id`),
  KEY `idx_orders_status_name` (`orders_status_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_status`
--

LOCK TABLES `orders_status` WRITE;
/*!40000 ALTER TABLE `orders_status` DISABLE KEYS */;
INSERT INTO `orders_status` VALUES
(1,2,'Pending',1,0),
(2,2,'Processing',1,1),
(3,2,'Delivered',1,1),
(4,2,'PayPal [Transactions]',0,0),
(5,2,'Braintree [Transactions]',0,0);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_status_history`
--

LOCK TABLES `orders_status_history` WRITE;
/*!40000 ALTER TABLE `orders_status_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_status_history` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_total`
--

LOCK TABLES `orders_total` WRITE;
/*!40000 ALTER TABLE `orders_total` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_total` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `products_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_quantity` int(4) NOT NULL,
  `products_model` varchar(12) DEFAULT NULL,
  `products_image` varchar(255) DEFAULT NULL,
  `products_price` decimal(15,4) NOT NULL,
  `products_date_added` datetime NOT NULL,
  `products_last_modified` datetime DEFAULT NULL,
  `products_date_available` datetime DEFAULT NULL,
  `products_weight` decimal(5,2) NOT NULL,
  `products_status` tinyint(1) NOT NULL,
  `products_tax_class_id` int(11) NOT NULL,
  `manufacturers_id` int(11) DEFAULT NULL,
  `products_ordered` int(11) NOT NULL DEFAULT 0,
  `canonical` int(11) DEFAULT 1,
  `authors_id` int(11) DEFAULT 1,
  PRIMARY KEY (`products_id`),
  KEY `idx_products_model` (`products_model`),
  KEY `idx_products_date_added` (`products_date_added`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES
(2,1,'',NULL,1.0000,'1970-01-01 00:00:00','2024-10-13 10:55:06',NULL,0.00,0,1,1,0,1,1),
(3,0,'','ic_crypto.jpg',0.0000,'2024-10-12 02:58:23','2024-10-13 11:04:43',NULL,0.00,1,0,0,0,1,1),
(7,1,'',NULL,0.0000,'1970-01-01 00:00:00','2024-10-20 06:14:28',NULL,0.00,1,0,1,0,1,1);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_attributes`
--

DROP TABLE IF EXISTS `products_attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_attributes` (
  `products_attributes_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL DEFAULT 0,
  `options_id` int(11) NOT NULL DEFAULT 0,
  `options_values_id` int(11) NOT NULL DEFAULT 0,
  `options_values_price` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `price_prefix` char(1) NOT NULL,
  PRIMARY KEY (`products_attributes_id`),
  KEY `idx_products_attributes_products_id` (`products_id`)
) ENGINE=MyISAM AUTO_INCREMENT=422 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_czech_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_attributes`
--

LOCK TABLES `products_attributes` WRITE;
/*!40000 ALTER TABLE `products_attributes` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_attributes_download`
--

DROP TABLE IF EXISTS `products_attributes_download`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_attributes_download` (
  `products_attributes_id` int(11) NOT NULL DEFAULT 0,
  `products_attributes_filename` varchar(255) NOT NULL,
  `products_attributes_maxdays` int(2) DEFAULT 0,
  `products_attributes_maxcount` int(2) DEFAULT 0,
  PRIMARY KEY (`products_attributes_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_czech_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_attributes_download`
--

LOCK TABLES `products_attributes_download` WRITE;
/*!40000 ALTER TABLE `products_attributes_download` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_attributes_download` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_description`
--

DROP TABLE IF EXISTS `products_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_description` (
  `products_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL DEFAULT 1,
  `products_name` varchar(128) NOT NULL DEFAULT '',
  `products_description` text DEFAULT NULL,
  `products_url` varchar(255) DEFAULT NULL,
  `products_viewed` int(5) DEFAULT 0,
  PRIMARY KEY (`products_id`,`language_id`),
  KEY `products_name` (`products_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_description`
--

LOCK TABLES `products_description` WRITE;
/*!40000 ALTER TABLE `products_description` DISABLE KEYS */;
INSERT INTO `products_description` VALUES
(2,2,'Homepage','<p>Pure OSC is a modern fork of osCommerce, based on <a href=\"https://github.com/ruden/vanilla-oscommerce/\">vanilla-oscommerce</a></p>\n\n<h2>Compatibility</h2>\n\n<ul>\n<li>PHP  8.2+</li>\n<li>MariaDB 10.2.7+</li>\n</ul>\n\n<h2>Bugs and Feature Requests</h2>\n\n<p>Found a bug or have a feature request? <a href=\"https://github.com/PureHTML/pureosc/issues/new\">Please open a new issue</a>.</p>\n\n<h2>PureOSC key Features</h2>\n\n<h3>PureHTML Css</h3>\n\n<p>Lightweight, extremely fast HTML rendering engine:</p>\n\n<ol>\n<li>no classes, only sematic tag childrens;</li>\n<li>Stored in single DB table, many cli tools for efficient managing and filtering rules.</li>\n</ol>\n\n<h3>PureHTML BannerManager</h3>\n\n<ol>\n<li>create webp animated banners</li>\n<li>extermely fast loading big advert graphicks in sigle HTTP request.</li>\n</ol>\n\n<h3>Czech language translation</h3>\n\n<p>Frontend and admin.</p>\n\n<h2>External Contributions</h2>\n\n<h3>SEO URLs</h3>\n\n<ol>\n<li>Dynamic SEO URLs based on <a href=\"https://old.oscommerce.com/36rDo&amp;ultimate-seo-urls\">Ultimate SEO URLs</a>.</li>\n<li>Updated to PHP 8x;</li>\n<li>Tested on Apache, Nginx, Haproxy.</li>\n</ol>\n\n<h3>GPWEBPAY Payment Gateway integration</h3>\n\n<p>Using <a href=\"https://www.platiti.cz/ZenCart-a.php\">Platiti.cz Oscommerce</a>.</p>\n\n<ol>\n<li>Free for Raifaisen Bank clients;</li>\n<li>Possible integration with Česká Spořitelna and Komerřní banka.</li>\n</ol>\n\n<h2>Comming soon</h2>\n\n<h3>CSOB Payment Gateway integration</h3>\n\n<p>As free module.</p>\n\n<h3>Flexibee integration</h3>\n\n<ol>\n<li>Orders sync with accounting;</li>\n<li>Catalog can be gebrated from accounting system.</li>\n</ol>\n\n<h3>Row level security for Mariadb</h3>\n\n<h3>SEO URLs caching system</h3>\n\n<ol>\n<li>Faster pages loading from static files;</li>\n<li>Web still work as catalog with dead database.</li>\n</ol>\n\n<h3>Ai serch suggestion engine</h3>\n\n<ol>\n<li>Based on  <a href=\"https://github.com/cantino/mcfly\">mcfly</a>, cli small neural network writen in Rust;</li>\n<li>PHP integration.</li>\n</ol>','',0),
(3,2,'row level security','<p>\r\n	def<br />\r\n</p>','',0),
(7,2,'git storage','<p>Git file storage and versioning capabilities are used not only for php/css source files,\nbut for all articles and products. Markdown source files are part of git backup as md directory.</p>\n\n<p>TODO: ! Add git add to catalog/admin/categories.php</p>','',0);
/*!40000 ALTER TABLE `products_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_images`
--

DROP TABLE IF EXISTS `products_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `htmlcontent` text DEFAULT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `products_images_prodid` (`products_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_images`
--

LOCK TABLES `products_images` WRITE;
/*!40000 ALTER TABLE `products_images` DISABLE KEYS */;
INSERT INTO `products_images` VALUES
(2,1867,'archivInstitutuPlanovaniPrahy.jpg','',1);
/*!40000 ALTER TABLE `products_images` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
  `products_options_name` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`products_options_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_options`
--

LOCK TABLES `products_options` WRITE;
/*!40000 ALTER TABLE `products_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_options_values`
--

DROP TABLE IF EXISTS `products_options_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_options_values` (
  `products_options_values_id` int(11) NOT NULL DEFAULT 0,
  `language_id` int(11) NOT NULL DEFAULT 1,
  `products_options_values_name` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`products_options_values_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_options_values`
--

LOCK TABLES `products_options_values` WRITE;
/*!40000 ALTER TABLE `products_options_values` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_options_values` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_options_values_to_products_options`
--

LOCK TABLES `products_options_values_to_products_options` WRITE;
/*!40000 ALTER TABLE `products_options_values_to_products_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_options_values_to_products_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_to_categories`
--

DROP TABLE IF EXISTS `products_to_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_to_categories` (
  `products_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `canonical` int(11) DEFAULT NULL,
  PRIMARY KEY (`products_id`,`categories_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_to_categories`
--

LOCK TABLES `products_to_categories` WRITE;
/*!40000 ALTER TABLE `products_to_categories` DISABLE KEYS */;
INSERT INTO `products_to_categories` VALUES
(2,0,NULL),
(3,1,NULL),
(7,9,1);
/*!40000 ALTER TABLE `products_to_categories` ENABLE KEYS */;
UNLOCK TABLES;

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
  `reviews_text` text NOT NULL,
  PRIMARY KEY (`reviews_id`),
  KEY `idx_reviews_products_id` (`products_id`),
  KEY `idx_reviews_customers_id` (`customers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sec_directory_whitelist`
--

LOCK TABLES `sec_directory_whitelist` WRITE;
/*!40000 ALTER TABLE `sec_directory_whitelist` DISABLE KEYS */;
INSERT INTO `sec_directory_whitelist` VALUES
(1,'admin/backups'),
(2,'images'),
(3,'images/dvd'),
(4,'images/gt_interactive'),
(5,'images/hewlett_packard'),
(6,'images/matrox'),
(7,'images/microsoft'),
(8,'images/samsung'),
(9,'images/sierra'),
(10,'includes/work'),
(11,'pub');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES
('00t8us8tosv6epop8s28f01vph',1728355254,'sessiontoken|s:32:\"590b78e0729a6b4a22c576880a402d23\";SESSION_USER_AGENT|s:70:\"Mozilla/5.0 (X11; Linux x86_64; rv:133.0) Gecko/20100101 Firefox/133.0\";SESSION_IP_ADDRESS|s:9:\"127.0.0.1\";cart|O:13:\"shopping_cart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}wishlist|O:8:\"wishlist\":1:{s:4:\"list\";a:0:{}}language|s:5:\"czech\";languages_id|s:1:\"1\";currency|s:3:\"CZK\";navigation|O:18:\"navigation_history\":2:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:16:\"product_info.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:11:\"products_id\";s:1:\"2\";s:20:\"XDEBUG_SESSION_START\";s:15:\"netbeans-xdebug\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:14:\"contact_us.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:11:\"products_id\";s:1:\"2\";s:20:\"XDEBUG_SESSION_START\";s:15:\"netbeans-xdebug\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}recently_viewed_products|a:2:{i:0;i:2;i:1;i:1;}'),
('3g7gv945uh95ja97au60v22r6f',1729138245,'sessiontoken|s:32:\"38af98b9f9c2160d0e70915e54b20705\";SESSION_USER_AGENT|s:21:\"w3m/0.5.3+git20230121\";SESSION_IP_ADDRESS|s:9:\"127.0.0.1\";cart|O:13:\"shopping_cart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}wishlist|O:8:\"wishlist\":1:{s:4:\"list\";a:0:{}}language|s:7:\"english\";languages_id|s:1:\"2\";currency|s:3:\"USD\";navigation|O:18:\"navigation_history\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),
('3ju4bmg0v6v4f11t1c43qbbrba',1729530250,'sessiontoken|s:32:\"5ed39a22f8cab0fdb16189e2348ce773\";SESSION_USER_AGENT|s:21:\"w3m/0.5.3+git20230121\";SESSION_IP_ADDRESS|s:9:\"127.0.0.1\";cart|O:13:\"shopping_cart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}wishlist|O:8:\"wishlist\":1:{s:4:\"list\";a:0:{}}language|s:7:\"english\";languages_id|s:1:\"2\";currency|s:3:\"USD\";navigation|O:18:\"navigation_history\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),
('46ep0v2mhatmikard6fi6i171n',1728619971,'sessiontoken|s:32:\"61c3562f54be5bd9b2fed412f4ff07e2\";SESSION_USER_AGENT|s:86:\"Mozilla/5.0 (X11; Linux x86_64; rv:91.0) Gecko/20100101 Firefox/91.0 SeaMonkey/2.53.19\";SESSION_IP_ADDRESS|s:9:\"127.0.0.1\";cart|O:13:\"shopping_cart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}wishlist|O:8:\"wishlist\":1:{s:4:\"list\";a:0:{}}language|s:7:\"english\";languages_id|s:1:\"2\";currency|s:3:\"USD\";navigation|O:18:\"navigation_history\":2:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:16:\"product_info.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:11:\"products_id\";s:1:\"2\";s:8:\"language\";s:2:\"en\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),
('5pfj4d31vs4llausedd7qksss6',1729543743,'sessiontoken|s:32:\"ea9d5978ba6ac5eccd771ff8dfa18d9c\";SESSION_USER_AGENT|s:21:\"w3m/0.5.3+git20230121\";SESSION_IP_ADDRESS|s:9:\"127.0.0.1\";cart|O:13:\"shopping_cart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}wishlist|O:8:\"wishlist\":1:{s:4:\"list\";a:0:{}}language|s:7:\"english\";languages_id|s:1:\"2\";currency|s:3:\"USD\";navigation|O:18:\"navigation_history\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"cPath\";s:1:\"2\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),
('60j5dg1r7hc0r4d62pa7kb7ar6',1729282359,'sessiontoken|s:32:\"3a3f6fa90b12599bcbc1bef52e5b112e\";SESSION_USER_AGENT|s:101:\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36\";SESSION_IP_ADDRESS|s:9:\"127.0.0.1\";cart|O:13:\"shopping_cart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}wishlist|O:8:\"wishlist\":1:{s:4:\"list\";a:0:{}}language|s:7:\"english\";languages_id|s:1:\"2\";currency|s:3:\"USD\";navigation|O:18:\"navigation_history\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),
('6coehr86fcljvlp5q4druie712',1728366864,'language|s:5:\"czech\";languages_id|s:1:\"1\";redirect_origin|a:2:{s:4:\"page\";s:9:\"index.php\";s:3:\"get\";a:0:{}}'),
('6ej82utfcslbo9u706m2f80qq0',1728428807,'language|s:5:\"czech\";languages_id|s:1:\"1\";redirect_origin|a:2:{s:4:\"page\";s:14:\"categories.php\";s:3:\"get\";a:3:{s:5:\"cPath\";s:0:\"\";s:3:\"pID\";s:1:\"1\";s:6:\"action\";s:11:\"new_product\";}}'),
('8668bvc4p9r16f36jou5e943ad',1728364377,'language|s:5:\"czech\";languages_id|s:1:\"1\";admin|a:2:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:7:\"pureosc\";}'),
('8vad98mvu393todhlld9mbb1r0',1729281589,'sessiontoken|s:32:\"d26db41d78ff93d96b624ad3610325bd\";SESSION_USER_AGENT|s:21:\"w3m/0.5.3+git20230121\";SESSION_IP_ADDRESS|s:9:\"127.0.0.1\";cart|O:13:\"shopping_cart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}wishlist|O:8:\"wishlist\":1:{s:4:\"list\";a:0:{}}language|s:7:\"english\";languages_id|s:1:\"2\";currency|s:3:\"USD\";navigation|O:18:\"navigation_history\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),
('atuqok64vcl72gegmiokga3oku',1729543841,'sessiontoken|s:32:\"330be85549d5d1e10f2dd94e71a5b711\";SESSION_USER_AGENT|s:21:\"w3m/0.5.3+git20230121\";SESSION_IP_ADDRESS|s:9:\"127.0.0.1\";cart|O:13:\"shopping_cart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}wishlist|O:8:\"wishlist\":1:{s:4:\"list\";a:0:{}}language|s:7:\"english\";languages_id|s:1:\"2\";currency|s:3:\"USD\";navigation|O:18:\"navigation_history\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"cPath\";s:1:\"2\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),
('bgmo5si9ti1ql9b33k40obon5m',1729535214,'sessiontoken|s:32:\"acf3ebbc7bd21be65f0919195c2662bd\";SESSION_USER_AGENT|s:86:\"Mozilla/5.0 (X11; Linux x86_64; rv:91.0) Gecko/20100101 Firefox/91.0 SeaMonkey/2.53.19\";SESSION_IP_ADDRESS|s:9:\"127.0.0.1\";cart|O:13:\"shopping_cart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}wishlist|O:8:\"wishlist\":1:{s:4:\"list\";a:0:{}}language|s:7:\"english\";languages_id|s:1:\"2\";currency|s:3:\"USD\";navigation|O:18:\"navigation_history\":2:{s:4:\"path\";a:3:{i:0;a:4:{s:4:\"page\";s:24:\"address_book_process.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:9:\"login.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}i:2;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:11:\"account.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}'),
('dk4rllvvp9gkfbhiqsoe24meec',1729620023,'language|s:7:\"english\";languages_id|s:1:\"2\";admin|a:2:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:7:\"pureosc\";}'),
('dqqereaqef080thahvb5uj1alj',1729544091,'sessiontoken|s:32:\"a7a9ba7427108773e024bd95ec19c851\";SESSION_USER_AGENT|s:21:\"w3m/0.5.3+git20230121\";SESSION_IP_ADDRESS|s:9:\"127.0.0.1\";cart|O:13:\"shopping_cart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}wishlist|O:8:\"wishlist\":1:{s:4:\"list\";a:0:{}}language|s:7:\"english\";languages_id|s:1:\"2\";currency|s:3:\"USD\";navigation|O:18:\"navigation_history\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"cPath\";s:1:\"2\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),
('h225hfv29hjc7pm4f29ionitre',1729622950,'sessiontoken|s:32:\"53555f98970d51de8e127a6309c59485\";SESSION_USER_AGENT|s:86:\"Mozilla/5.0 (X11; Linux x86_64; rv:91.0) Gecko/20100101 Firefox/91.0 SeaMonkey/2.53.19\";SESSION_IP_ADDRESS|s:9:\"127.0.0.1\";cart|O:13:\"shopping_cart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}wishlist|O:8:\"wishlist\":1:{s:4:\"list\";a:0:{}}language|s:7:\"english\";languages_id|s:1:\"2\";currency|s:3:\"USD\";navigation|O:18:\"navigation_history\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),
('hv019jl33fj3ijmpf6ob0bif1j',1728885716,'sessiontoken|s:32:\"f5e5cc022963d92761be554cc9e71fe8\";SESSION_USER_AGENT|s:101:\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36\";SESSION_IP_ADDRESS|s:9:\"127.0.0.1\";cart|O:13:\"shopping_cart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}wishlist|O:8:\"wishlist\":1:{s:4:\"list\";a:0:{}}language|s:7:\"english\";languages_id|s:1:\"2\";currency|s:3:\"USD\";navigation|O:18:\"navigation_history\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),
('iiu45v3ko4q113vdqvav7utvu8',1728368509,'sessiontoken|s:32:\"0f2190d7a5735217f1ae1a4f6e61a7ec\";SESSION_USER_AGENT|s:86:\"Mozilla/5.0 (X11; Linux x86_64; rv:91.0) Gecko/20100101 Firefox/91.0 SeaMonkey/2.53.19\";SESSION_IP_ADDRESS|s:9:\"127.0.0.1\";cart|O:13:\"shopping_cart\":5:{s:8:\"contents\";a:1:{i:2;a:1:{s:3:\"qty\";i:4;}}s:5:\"total\";d:4000;s:6:\"weight\";d:0;s:6:\"cartID\";s:5:\"79879\";s:12:\"content_type\";b:0;}wishlist|O:8:\"wishlist\":1:{s:4:\"list\";a:0:{}}language|s:5:\"czech\";languages_id|s:1:\"1\";currency|s:3:\"CZK\";navigation|O:18:\"navigation_history\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:21:\"checkout_shipping.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}recently_viewed_products|a:1:{i:0;i:2;}new_products_id_in_cart|i:2;'),
('jtecjbeg2tktp4jp42aqap8989',1729274255,'language|s:7:\"english\";languages_id|s:1:\"2\";admin|a:2:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:7:\"pureosc\";}'),
('koa77f1u4gsj6417ll3c9n2j1p',1729512038,'sessiontoken|s:32:\"b12a06909bf6944f33339ea678adb315\";SESSION_USER_AGENT|s:21:\"w3m/0.5.3+git20230121\";SESSION_IP_ADDRESS|s:9:\"127.0.0.1\";cart|O:13:\"shopping_cart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}wishlist|O:8:\"wishlist\":1:{s:4:\"list\";a:0:{}}language|s:7:\"english\";languages_id|s:1:\"2\";currency|s:3:\"USD\";navigation|O:18:\"navigation_history\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),
('ln8euvochjv1vcimco83a8rusc',1729278416,'sessiontoken|s:32:\"8f3139911a11bf41d4cb9a2f02429f36\";SESSION_USER_AGENT|s:86:\"Mozilla/5.0 (X11; Linux x86_64; rv:91.0) Gecko/20100101 Firefox/91.0 SeaMonkey/2.53.19\";SESSION_IP_ADDRESS|s:9:\"127.0.0.1\";cart|O:13:\"shopping_cart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}wishlist|O:8:\"wishlist\":1:{s:4:\"list\";a:0:{}}language|s:7:\"english\";languages_id|s:1:\"2\";currency|s:3:\"USD\";navigation|O:18:\"navigation_history\":2:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:16:\"product_info.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:11:\"products_id\";s:1:\"2\";s:20:\"XDEBUG_SESSION_START\";s:15:\"netbeans-xdebug\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:11:\"account.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}'),
('n2npaa62vsghfdan8p814q2635',1729537592,'sessiontoken|s:32:\"7b4868fa021279cf0ddb361434e367c9\";SESSION_USER_AGENT|s:101:\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36\";SESSION_IP_ADDRESS|s:9:\"127.0.0.1\";cart|O:13:\"shopping_cart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}wishlist|O:8:\"wishlist\":1:{s:4:\"list\";a:0:{}}language|s:7:\"english\";languages_id|s:1:\"2\";currency|s:3:\"USD\";navigation|O:18:\"navigation_history\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),
('nf80fgsv1cg9p5psejniqumgt4',1729290170,'sessiontoken|s:32:\"404c259b2a4a8f772c1a8cea5fb4c1f9\";SESSION_USER_AGENT|s:21:\"w3m/0.5.3+git20230121\";SESSION_IP_ADDRESS|s:9:\"127.0.0.1\";cart|O:13:\"shopping_cart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}wishlist|O:8:\"wishlist\":1:{s:4:\"list\";a:0:{}}language|s:7:\"english\";languages_id|s:1:\"2\";currency|s:3:\"USD\";navigation|O:18:\"navigation_history\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),
('nso7ud3r9mq95tn837mcd2gnip',1729521146,'language|s:7:\"english\";languages_id|s:1:\"2\";admin|a:2:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:7:\"pureosc\";}'),
('o5qiknsbpmlq8jjr8s7g8c3foq',1728620700,'language|s:7:\"english\";languages_id|s:1:\"2\";admin|a:2:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:7:\"pureosc\";}'),
('o7k4p6ch0vs8is154cvfip74dm',1729520050,'sessiontoken|s:32:\"5da77b9298658d1026e70c6dbe699d90\";SESSION_USER_AGENT|s:86:\"Mozilla/5.0 (X11; Linux x86_64; rv:91.0) Gecko/20100101 Firefox/91.0 SeaMonkey/2.53.19\";SESSION_IP_ADDRESS|s:9:\"127.0.0.1\";cart|O:13:\"shopping_cart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";s:5:\"18072\";s:12:\"content_type\";b:0;}wishlist|O:8:\"wishlist\":1:{s:4:\"list\";a:0:{}}language|s:7:\"english\";languages_id|s:1:\"2\";currency|s:3:\"USD\";navigation|O:18:\"navigation_history\":2:{s:4:\"path\";a:4:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:11:\"account.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}i:2;a:4:{s:4:\"page\";s:16:\"address_book.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}i:3;a:4:{s:4:\"page\";s:24:\"address_book_process.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}legal_agreements_consents|s:19:\"2024-10-21 15:16:49\";customer_id|i:1;customer_default_address_id|s:1:\"1\";customer_first_name|s:6:\"Šimon\";customer_country_id|s:3:\"223\";customer_zone_id|s:1:\"0\";'),
('pj7iqd69l596ev1hgoj96htru5',1728982184,'sessiontoken|s:32:\"14f251dfd8cb8dd952347236d148d987\";SESSION_USER_AGENT|s:21:\"w3m/0.5.3+git20230121\";SESSION_IP_ADDRESS|s:9:\"127.0.0.1\";cart|O:13:\"shopping_cart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}wishlist|O:8:\"wishlist\":1:{s:4:\"list\";a:0:{}}language|s:7:\"english\";languages_id|s:1:\"2\";currency|s:3:\"USD\";navigation|O:18:\"navigation_history\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),
('pr51li6m5eh1kdlto2vh7jeofc',1729491220,'sessiontoken|s:32:\"1c47442bbbd4bf3a48f13d640fdaf08e\";SESSION_USER_AGENT|s:21:\"w3m/0.5.3+git20230121\";SESSION_IP_ADDRESS|s:9:\"127.0.0.1\";cart|O:13:\"shopping_cart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}wishlist|O:8:\"wishlist\":1:{s:4:\"list\";a:0:{}}language|s:7:\"english\";languages_id|s:1:\"2\";currency|s:3:\"USD\";navigation|O:18:\"navigation_history\":2:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:12:\"wishlist.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),
('pv2ube02deuv6bbn4hs558juea',1728809329,'sessiontoken|s:32:\"73ec4ddbb9e1b3413cffc57d40910b21\";SESSION_USER_AGENT|s:101:\"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36\";SESSION_IP_ADDRESS|s:9:\"127.0.0.1\";cart|O:13:\"shopping_cart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}wishlist|O:8:\"wishlist\":1:{s:4:\"list\";a:0:{}}language|s:5:\"czech\";languages_id|s:1:\"1\";currency|s:3:\"CZK\";navigation|O:18:\"navigation_history\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),
('qdusg0tt6t6jrgf17qd7abnepp',1728366925,'language|s:5:\"czech\";languages_id|s:1:\"1\";redirect_origin|a:2:{s:4:\"page\";s:9:\"index.php\";s:3:\"get\";a:0:{}}'),
('rs1h43tltn0ad2kk30rvi0vujf',1729524540,'language|s:7:\"english\";languages_id|s:1:\"2\";admin|a:2:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:7:\"pureosc\";}');
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tax_class`
--

LOCK TABLES `tax_class` WRITE;
/*!40000 ALTER TABLE `tax_class` DISABLE KEYS */;
INSERT INTO `tax_class` VALUES
(1,'Taxable Goods','The following types of products are included non-food, services, etc','2024-06-07 04:52:43','2024-06-07 04:52:43');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tax_rates`
--

LOCK TABLES `tax_rates` WRITE;
/*!40000 ALTER TABLE `tax_rates` DISABLE KEYS */;
INSERT INTO `tax_rates` VALUES
(1,1,1,1,7.0000,'FL TAX 7.0%','2024-06-07 04:52:43','2024-06-07 04:52:43');
/*!40000 ALTER TABLE `tax_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usu_cache`
--

DROP TABLE IF EXISTS `usu_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usu_cache` (
  `cache_name` varchar(64) NOT NULL,
  `cache_data` mediumtext NOT NULL,
  `cache_date` datetime NOT NULL,
  UNIQUE KEY `cache_name` (`cache_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usu_cache`
--

LOCK TABLES `usu_cache` WRITE;
/*!40000 ALTER TABLE `usu_cache` DISABLE KEYS */;
INSERT INTO `usu_cache` VALUES
('4d623115888bda1a05903d5995cef887','tc5BDoIwEAXQq5CegFJAGXYuXHkH07QTaURKCnRDehCPwDmI97IiRhITWLmb/Pw/eRwo9A1QCqQ2Wnaibc5KkpxDDL0Clqb+ZFOFLSoVvyHJ36G0+LhjcDBdg+UUJkAEb/GijcJvN4qBnHRtuGqCeWNFoaW24/D5tZi9FH4EJIlI7jwlCzcph04UpbZKYEDDNcr+h6KqFo0aB7PJYTMnXuVkQI5dWeE1YPS/EprumKeE0Dvnng==','2024-09-21 03:13:38');
/*!40000 ALTER TABLE `usu_cache` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zones_to_geo_zones`
--

LOCK TABLES `zones_to_geo_zones` WRITE;
/*!40000 ALTER TABLE `zones_to_geo_zones` DISABLE KEYS */;
INSERT INTO `zones_to_geo_zones` VALUES
(1,223,18,1,NULL,'2024-06-07 04:52:43');
/*!40000 ALTER TABLE `zones_to_geo_zones` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-22 21:07:23
