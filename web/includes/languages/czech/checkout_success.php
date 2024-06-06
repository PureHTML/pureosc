<?php
/*
  $Id: checkout_success.php,v 1.12 2003/04/15 17:47:42 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Dodávky');
define('NAVBAR_TITLE_2', 'V pořádku');

define('HEADING_TITLE', 'Vaše objednávka se zpracovává');

define('TEXT_SUCCESS', 'Vaše objednávka se zpracovává! Vybrané zboží bude doručeno na uvedenou adresu během 2-5 pracovních dnů.');
define('TEXT_NOTIFY_PRODUCTS', 'Prosím upozornit na stav.');
define('TEXT_SEE_ORDERS', 'Zobrazit <a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '">historie objednávek</a>.');
define('TEXT_CONTACT_STORE_OWNER', 'Máte-li případné dotazy  <a href="' . tep_href_link(FILENAME_CONTACT_US) . '">napište nám.</a>.');
define('TEXT_THANKS_FOR_SHOPPING', 'Děkujeme za Váš nákup!');

define('TABLE_HEADING_COMMENTS', 'Vložte komentář ke zpracování objednávky');

define('TABLE_HEADING_DOWNLOAD_DATE', 'Datum: ');
define('TABLE_HEADING_DOWNLOAD_COUNT', ' zbývá uložit');
define('HEADING_DOWNLOAD', 'Nahrajte Váš produkt zde:');
define('FOOTER_DOWNLOAD', 'Vaše další produkty můžete nahrát později \'%s\'');
?>