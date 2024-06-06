<?php
/*
  $Id: customers.php,v 1.13 2004/07/22 23:17:20 hpdl Exp $
  translation by mathsosc 2005/07/13
  
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

//TotalB2B start
define('TABLE_HEADING_CUSTOMERS_STATUS', 'Status');
define('ENTRY_CUSTOMERS_DISCOUNT', 'Customer Discount Rate:');
define('ENTRY_CUSTOMERS_GROUPS_NAME', 'Group:');
//TotalB2B end

define('HEADING_TITLE', 'Clients');
define('HEADING_TITLE_SEARCH', 'Rechercher :');

define('TABLE_HEADING_FIRSTNAME', 'Pr&eacute;nom');
define('TABLE_HEADING_LASTNAME', 'Nom');
define('TABLE_HEADING_ACCOUNT_CREATED', 'Compte cr&eacute;&eacute;');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_DATE_ACCOUNT_CREATED', 'Compte cr&eacute;&eacute :');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'Derni&egrave;re modification :');
define('TEXT_INFO_DATE_LAST_LOGON', 'Derni&egrave;re connexion :');
define('TEXT_INFO_NUMBER_OF_LOGONS', 'Nombre de connexions :');
define('TEXT_INFO_COUNTRY', 'Pays :');
define('TEXT_INFO_NUMBER_OF_REVIEWS', 'Nombre de critiques :');
define('TEXT_DELETE_INTRO', 'Etes vous s&ucirc;r de vouloir supprimer ce client ?');
define('TEXT_DELETE_REVIEWS', 'Supprimer %s critique(s)');
define('TEXT_INFO_HEADING_DELETE_CUSTOMER', 'Supprimer client');
define('TYPE_BELOW', 'Type ci-dessous');
define('PLEASE_SELECT', 'Choisissez en un');

//#CHAVEIRO6# Step order/customer begin
define('HEADING_TITLE_ADD', 'Add new Customer');
define('EMAIL_SUBJECT', 'Welcome to ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Dear Mr. %s ,' . "\n\n");
define('EMAIL_GREET_MS', 'Dear Ms. %s ,' . "\n\n");
define('EMAIL_GREET_NONE', 'Dear %s' . "\n\n");
define('EMAIL_WELCOME', 'We welcome you to <b>' . STORE_NAME . '</b>.' . "\n\n");
define('EMAIL_PASS', 'Your password for this account is: %s' . "\n" . "Keep it in a safe place, your password is case sensitive.\n\n" . "You can login now at " . HTTP_CATALOG_SERVER . DIR_WS_CATALOG . "login.php \n\n");
define('EMAIL_TEXT', 'You can now take part in the <b>various services</b> we have to offer you. Some of these services include:' . "\n\n" . '<li><b>Permanent Cart</b> - Any products added to your online cart remain there until you remove them, or check them out.' . "\n" . '<li><b>Address Book</b> - We can now deliver your products to another address other than yours! This is perfect to send birthday gifts direct to the birthday-person themselves.' . "\n" . '<li><b>Order History</b> - View your history of purchases that you have made with us.' . "\n" . '<li><b>Products Reviews</b> - Share your opinions on products with our other customers.' . "\n\n");
define('EMAIL_CONTACT', 'For help with any of our online services, please email the store-owner: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<b>Note:</b> This email address was given to us by one of our customers. If you did not signup to be a member, please send an email to ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");
//#CHAVEIRO6# Step order/customer end

?>
