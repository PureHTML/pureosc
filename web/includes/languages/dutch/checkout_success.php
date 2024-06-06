<?php
/*
  $Id: checkout_success.php,v 1.11 2002/11/01 04:27:01 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Afrekeken');
define('NAVBAR_TITLE_2', 'Succes');

define('HEADING_TITLE', 'Uw bestelling is onvangen!');

define('TEXT_SUCCESS', 'Uw bestelling is succesvol ontvangen! U krijgt van ons bericht wanneer de bestelling bij u aangeboden, of wanneer u deze kunt afhalen.');
define('TEXT_NOTIFY_PRODUCTS', 'Hou mij op de hoogte van updates voor de producten die ik hierbeneden heb geselecteerd:');
define('TEXT_SEE_ORDERS', 'U kunt uw bestel geschiedenis bekijken door naar <a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">\'Mijn Account\'</a> te gaan en daar op <a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '">\'Bestel geschiedenis\'</a> te klikken.');
define('TEXT_CONTACT_STORE_OWNER', 'Voor vragen kunt u contact opnemen met <a href="' . tep_href_link(FILENAME_CONTACT_US) . '">' . STORE_NAME . '</a>.');
define('TEXT_THANKS_FOR_SHOPPING', 'Bedankt voor uw bestelling en tot gauw!');

define('TABLE_HEADING_COMMENTS', 'Extra commentaar kunt u hieronder invullen:');

define('TABLE_HEADING_DOWNLOAD_DATE', 'Verloop datum: ');
define('TABLE_HEADING_DOWNLOAD_COUNT', ' downloads over.');
define('HEADING_DOWNLOAD', 'Download uw producten hier:');
define('FOOTER_DOWNLOAD', 'U kunt uw producten ook later downloaden bij \'%s\'');
?>