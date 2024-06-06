<?php
/*
  $Id: whos_online.php,v 1.5 2002/03/30 15:48:55 harley_vb Exp $

  DUTCH TRANSLATION
  - V2.2 ms1: Author: Joost Billiet   Date: 06/18/2003   Mail: joost@jbpc.be
  - V2.2 ms2: Update: Martijn Loots   Date: 08/01/2003   Mail: oscommerce@cosix.com

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

// added for version 1.9 - to be translated to the right language BOF ******
define('AZER_WHOSONLINE_WHOIS_URL', 'http://www.dnsstuff.com/tools/whois.ch?ip='); //for version 2.9 by azer - whois ip
define('TEXT_NOT_AVAILABLE', '   <b>Note:</b> N/A = IP non available'); //for version 2.9 by azer was missing
define('TEXT_LAST_REFRESH', 'Last refresh at'); //for version 2.9 by azer was missing
define('TEXT_EMPTY', 'Empty'); //for version 2.8 by azer was missing
define('TEXT_MY_IP_ADDRESS', 'My IP adresss '); //for version 2.8 by azer was missing
define('TABLE_HEADING_COUNTRY', 'Country'); // azerc : 25oct05 for contrib whos_online with country and flag
// added for version 1.9 EOF *************************************************

define('HEADING_TITLE', 'Wie Is Er Online');
define('TABLE_HEADING_ONLINE', 'Online');
define('TABLE_HEADING_CUSTOMER_ID', 'ID');
define('TABLE_HEADING_FULL_NAME', 'Volledige Naam');
define('TABLE_HEADING_IP_ADDRESS', 'IP Adres');
define('TABLE_HEADING_ENTRY_TIME', 'Tijdstip binnenkomst');
define('TABLE_HEADING_LAST_CLICK', 'Laatste Klik');
define('TABLE_HEADING_LAST_PAGE_URL', 'Laatste URL');
define('TABLE_HEADING_ACTION', 'Actie');
define('TABLE_HEADING_SHOPPING_CART', 'Winkelwagen Klant');
define('TEXT_SHOPPING_CART_SUBTOTAL', 'Subtotaal');
define('TEXT_NUMBER_OF_CUSTOMERS', 'Momenteel zijn er %s klanten online');
define('TABLE_HEADING_HTTP_REFERER', 'Referer?');
define('TEXT_HTTP_REFERER_URL', 'HTTP Referer URL');
define('TEXT_HTTP_REFERER_FOUND', 'Yes');
define('TEXT_HTTP_REFERER_NOT_FOUND', 'Not Found');
define('TEXT_STATUS_ACTIVE_CART', 'Active with Cart');
define('TEXT_STATUS_ACTIVE_NOCART', 'Active with no Cart');
define('TEXT_STATUS_INACTIVE_CART', 'Inactive with Cart');
define('TEXT_STATUS_INACTIVE_NOCART', 'Inactive with no Cart');
define('TEXT_STATUS_NO_SESSION_BOT', 'Inactive Bot with no session?'); //Azer !!! check if right description
define('TEXT_STATUS_INACTIVE_BOT', 'Inactive Bot with session '); //Azer !!! check if right description
define('TEXT_STATUS_ACTIVE_BOT', 'Active Bot with session '); //Azer !!! check if right description
define('TABLE_HEADING_COUNTRY', 'Country');
define('TABLE_HEADING_USER_SESSION', 'Session?');
define('TEXT_IN_SESSION', 'Yes');
define('TEXT_NO_SESSION', 'No');

define('TEXT_OSCID', 'osCsid');
define('TEXT_PROFILE_DISPLAY', 'Profile Display');
define('TEXT_USER_AGENT', 'User Agent');
define('TEXT_ERROR', 'Error!');
define('TEXT_ADMIN', 'Admin');
define('TEXT_DUPLICATE_IP', 'Duplicate(s) IP(s)');
define('TEXT_BOTS', 'Bots');
define('TEXT_ME', 'Myself!');
define('TEXT_ALL', 'All');
define('TEXT_REAL_CUSTOMERS', 'Real Customer(s)');
define('TEXT_ACTIVE_CUSTOMERS', ' are active.');

define('TEXT_YOUR_IP_ADDRESS', 'Your IP Address');
define('TEXT_SET_REFRESH_RATE', 'Refresh Rate');
define('TEXT_NONE_', 'None');
define('TEXT_CUSTOMERS', 'Customers');
define('TEXT_SHOW_BOTS', 'Show Bots');
?>