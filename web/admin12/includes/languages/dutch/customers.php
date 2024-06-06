<?php
/*
  $Id: customers.php,v 1.12 2002/01/12 18:46:27 hpdl Exp $

  DUTCH TRANSLATION
  - V2.2 ms1: Author: Joost Billiet   Date: 06/18/2003   Mail: joost@jbpc.be
  - V2.2 ms2: Update: Martijn Loots   Date: 08/01/2003   Mail: oscommerce@cosix.com

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

define('HEADING_TITLE', 'Klanten');
define('HEADING_TITLE_SEARCH', 'Zoeken:');

define('TABLE_HEADING_FIRSTNAME', 'Voornaam');
define('TABLE_HEADING_LASTNAME', 'Achternaam');
define('TABLE_HEADING_ACCOUNT_CREATED', 'Account gemaakt');
define('TABLE_HEADING_ACTION', 'Actie');

define('TEXT_DATE_ACCOUNT_CREATED', 'Account gemaakt:');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'Laatst gewijzigd:');
define('TEXT_INFO_DATE_LAST_LOGON', 'Laatste login:');
define('TEXT_INFO_NUMBER_OF_LOGONS', 'Aantal logins:');
define('TEXT_INFO_COUNTRY', 'Land:');
define('TEXT_INFO_NUMBER_OF_REVIEWS', 'Aantal recensies:');
define('TEXT_DELETE_INTRO', 'Bent u zeker dat u deze klant wil verwijderen?');
define('TEXT_DELETE_REVIEWS', 'Verwijder %s recensie(s)');
define('TEXT_INFO_HEADING_DELETE_CUSTOMER', 'Verwijder Klant');
define('TYPE_BELOW', 'Typ hieronder');
define('PLEASE_SELECT', 'Selecteer');

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
