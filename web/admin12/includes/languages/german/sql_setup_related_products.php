<?php
/*
  sql_setup_related_products.php
  SQL Setup Utility For Optional Related Products, Ver 4.0

  Copyright (c) 2008 Anita Cross (http://www.callofthewildphoto.com/)

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Released under the GNU General Public License
*/

define('HEADING_TITLE_ORP', 'SQL Setup for Optional Related Products');
define('TEXT_ORP_INTRODUCTION', 'To complete your installation of Optional Related Products, a number of changes must be made to your database. This setup page is intended to make that easy for you. With the click of a single button, your database will be updated with all the current information for your new or upgrade install.');
define('TEXT_ORP_WARNING', 'Please Note: It is highly recommended that you backup your database before making changes. Although this utility is intended to safely update your configuration and configuration_group tables, it is still "Use At Your Own Risk". ');
define('SECTION_TITLE_NEW_INSTALL', 'New Install');
define('SECTION_DESCRIPTION_NEW_INSTALL', 'If this is your first installation of Optional Related Products, click on the button below to create the new SQL table, as well as installing the configuration group and options.');
define('SECTION_TITLE_UPGRADE', 'Upgrade Earlier Version to Version 4.0');
define('SECTION_DESCRIPTION_UPGRADE', 'If you have previously installed Optional Related Products and want to upgrade to Version 4.0, this is the option to select. Click on the button below and your configuration options will be updated to correspond with the changes in version 4.0, without affecting the data you\'ve worked so hard to prepare.');
define('SECTION_TITLE_REMOVE', 'Remove Optional Related Products from the Database');
define('SECTION_DESCRIPTION_REMOVE', 'Whether you want to remove everything and start over, or just want to remove this contribution, this is the option for you. All traces of Optional Related Products will be removed from your database, including the table with all the related products! To protect your data from accidental deletion, this option requires confirmation.');
define('TEXT_CONFIRM_REMOVE_SQL', 'Click on OK to remove Optional Related Products from your SQL database.');
?>