<?php
/*
  $Id: checkout_process.php,v 1.26 2002/11/01 04:22:05 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('EMAIL_TEXT_SUBJECT', 'Objednavka v ' .STORE_NAME);
define('EMAIL_TEXT_ORDER_NUMBER', 'Variabilní symbol (číslo objednávky):');
define('EMAIL_TEXT_INVOICE_URL', 'Odkaz na fakturu:');
define('EMAIL_TEXT_DATE_ORDERED', 'Datum objednání:');
define('EMAIL_TEXT_PRODUCTS', 'Zboží');
define('EMAIL_TEXT_SUBTOTAL', 'Součet:');
define('EMAIL_TEXT_TAX', 'Daň:        ');
define('EMAIL_TEXT_SHIPPING', 'Dodání: ');
define('EMAIL_TEXT_TOTAL', 'Celkem:    ');
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Dodací adresa');
define('EMAIL_TEXT_BILLING_ADDRESS', 'Fakturační adresa');
define('EMAIL_TEXT_PAYMENT_METHOD', 'Platební metoda');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('TEXT_EMAIL_VIA', 'via');
// PWA BOF
define('EMAIL_WARNING', ''); 
// PWA EOF
?>