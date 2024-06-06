<?php
/*
  $Id: customers.php,v 1.12 2002/01/12 18:46:27 hpdl Exp $

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

define('HEADING_TITLE', 'Clienti');
define('HEADING_TITLE_SEARCH', 'Cerca:');

define('TABLE_HEADING_FIRSTNAME', 'Nome');
define('TABLE_HEADING_LASTNAME', 'Cognome');
define('TABLE_HEADING_ACCOUNT_CREATED', 'Account Creato');
define('TABLE_HEADING_ACTION', 'Azione');

define('TEXT_DATE_ACCOUNT_CREATED', 'Account Creato:');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'Ultima modifica:');
define('TEXT_INFO_DATE_LAST_LOGON', 'Ultima entrata:');
define('TEXT_INFO_NUMBER_OF_LOGONS', 'Numero di entrate:');
define('TEXT_INFO_COUNTRY', 'Nazione:');
define('TEXT_INFO_NUMBER_OF_REVIEWS', 'Numero di Recensioni:');
define('TEXT_DELETE_INTRO', 'Sicuro di voler cancellare questo Cliente?');
define('TEXT_DELETE_REVIEWS', 'Cancella %s recensione(i)');
define('TEXT_INFO_HEADING_DELETE_CUSTOMER', 'Cancella Cliente');
define('TYPE_BELOW', 'Tipo');
define('PLEASE_SELECT', 'Seleziona');

//#CHAVEIRO6# Step order/customer begin
define('HEADING_TITLE_ADD', 'Aggiungi un nuovo cliente');
define('EMAIL_SUBJECT', 'Benvenuto in ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Caro %s ,' . "\n\n");
define('EMAIL_GREET_MS', 'Cara %s ,' . "\n\n");
define('EMAIL_GREET_NONE', 'Caro %s' . "\n\n");
define('EMAIL_WELCOME', 'Benvenuti in <b>' . STORE_NAME . '</b>.' . "\n\n");
define('EMAIL_PASS', 'La Vostra password per accedere &egrave; : %s' . "\n" . "Rispettate le minuscole e maiuscole, la vostra password &egrave; case sensitive.\n\n" . "Voi potete accedere a " . HTTP_CATALOG_SERVER . DIR_WS_CATALOG . "login.php \n\n");
define('EMAIL_TEXT', 'You can now take part in the <b>various services</b> we have to offer you. Some of these services include:' . "\n\n" . '<li><b>Permanent Cart</b> - Any products added to your online cart remain there until you remove them, or check them out.' . "\n" . '<li><b>Address Book</b> - We can now deliver your products to another address other than yours! This is perfect to send birthday gifts direct to the birthday-person themselves.' . "\n" . '<li><b>Order History</b> - View your history of purchases that you have made with us.' . "\n" . '<li><b>Products Reviews</b> - Share your opinions on products with our other customers.' . "\n\n");
define('EMAIL_CONTACT', 'For help with any of our online services, please email the store-owner: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<b>Note:</b> This email address was given to us by one of our customers. If you did not signup to be a member, please send an email to ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");
//#CHAVEIRO6# Step order/customer end

?>
