<?php
/*
  $Id: customers.php,v 1.13 2002/06/15 12:19:14 harley_vb Exp $

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

define('HEADING_TITLE', 'Kunden');
define('HEADING_TITLE_SEARCH', 'Suche:');

define('TABLE_HEADING_FIRSTNAME', 'Vorname');
define('TABLE_HEADING_LASTNAME', 'Nachname');
define('TABLE_HEADING_ACCOUNT_CREATED', 'Zugang erstellt am');
define('TABLE_HEADING_ACTION', 'Aktion');

define('TEXT_DATE_ACCOUNT_CREATED', 'Zugang erstellt am:');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'letzte &Auml;nderung:');
define('TEXT_INFO_DATE_LAST_LOGON', 'letzte Anmeldung:');
define('TEXT_INFO_NUMBER_OF_LOGONS', 'Anzahl der Anmeldungen:');
define('TEXT_INFO_COUNTRY', 'Land:');
define('TEXT_INFO_NUMBER_OF_REVIEWS', 'Anzahl der Artikelbewertungen:');
define('TEXT_DELETE_INTRO', 'Wollen Sie diesen Kunden wirklich l&ouml;schen?');
define('TEXT_DELETE_REVIEWS', '%s Bewertung(en) l&ouml;schen');
define('TEXT_INFO_HEADING_DELETE_CUSTOMER', 'Kunden l&ouml;schen');
define('TYPE_BELOW', 'Bitte unten eingeben');
define('PLEASE_SELECT', 'Auswählen');

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