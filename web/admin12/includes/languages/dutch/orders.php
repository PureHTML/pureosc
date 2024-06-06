<?php
/*
  $Id: orders.php,v 1.25 2003/06/20 00:28:44 hpdl Exp $

  DUTCH TRANSLATION
  - V2.2 ms1: Author: Joost Billiet   Date: 06/18/2003   Mail: joost@jbpc.be
  - V2.2 ms2: Update: Martijn Loots   Date: 08/01/2003   Mail: oscommerce@cosix.com

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('ENTRY_CUSTOMER_NOTES', 'Customer Notes:');

######## Points/Rewards Module V2.00 BOF ##################
define('ENTRY_NOTIFY_POINTS', 'Confirm Pending Points:');
define('ENTRY_QUE_POINTS', 'and Que');
define('ENTRY_QUE_DEL_POINTS', 'and Delete:');
define('ENTRY_CONFIRMED_POINTS', 'Points Confirmed.  ');
######## Points/Rewards Module V2.00 EOF ##################
define('HEADING_TITLE', 'Orders');
define('HEADING_TITLE_SEARCH', 'Order ID:');
define('HEADING_TITLE_STATUS', 'Status:');

define('TABLE_HEADING_COMMENTS', 'Commentaar');
define('TABLE_HEADING_CUSTOMERS', 'Klanten');
define('TABLE_HEADING_ORDER_TOTAL', 'Order Totaal');
define('TABLE_HEADING_DATE_PURCHASED', 'Datum Gekocht');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Actie');
define('TABLE_HEADING_QUANTITY', 'Hoeveelheid');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS', 'Artikelen');
define('TABLE_HEADING_TAX', 'BTW');
define('TABLE_HEADING_TOTAL', 'Totaal');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Prijs (excl.)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Prijs (incl.)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Totaal (excl.)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Totaal (incl.)');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Klant Ingelicht');
define('TABLE_HEADING_DATE_ADDED', 'Datum toegevoegd');

define('ENTRY_CUSTOMER', 'Klant:');
define('ENTRY_SOLD_TO', 'Verkocht aan:');
define('ENTRY_DELIVERY_TO', 'Leveren aan:');
define('ENTRY_SHIP_TO', 'Verzenden Naar:');
define('ENTRY_SHIPPING_ADDRESS', 'Afleveradres:');
define('ENTRY_BILLING_ADDRESS', 'Factuuradres:');
define('ENTRY_PAYMENT_METHOD', 'Betaalwijze:');
define('ENTRY_CREDIT_CARD_TYPE', 'Credit Card Type:');
define('ENTRY_CREDIT_CARD_OWNER', 'Credit Card Eigenaar:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Credit Card Nummer:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Credit Card Vervalt:');
define('ENTRY_SUB_TOTAL', 'Subtotaal:');
define('ENTRY_TAX', 'BTW:');
define('ENTRY_SHIPPING', 'Verzendkosten:');
define('ENTRY_TOTAL', 'Totaal:');
define('ENTRY_DATE_PURCHASED', 'Datum Gekocht:');
define('ENTRY_STATUS', 'Status:');
define('ENTRY_DATE_LAST_UPDATED', 'Datum laatste update:');
define('ENTRY_NOTIFY_CUSTOMER', 'Licht klant in:');
define('ENTRY_NOTIFY_COMMENTS', 'Voeg commentaar toe:');
define('ENTRY_PRINTABLE', 'Print Factuur');

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Verwijder Order');
define('TEXT_INFO_DELETE_INTRO', 'Weet u zeker dat u deze order wil verwijderen?');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Voorraad bijwerken');
define('TEXT_DATE_ORDER_CREATED', 'Datum Aangemaakt:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Laatst Aangepast:');
define('TEXT_INFO_PAYMENT_METHOD', 'Betaalwijze:');

define('TEXT_ALL_ORDERS', 'Alle Orders');
define('TEXT_NO_ORDER_HISTORY', 'Geen bestelgeschiedenis beschikbaar');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Order Update');
define('EMAIL_TEXT_ORDER_NUMBER', 'Ordernummer:');
define('EMAIL_TEXT_INVOICE_URL', 'Gedetailleerde Factuur:');
define('EMAIL_TEXT_DATE_ORDERED', 'Orderdatum:');
define('EMAIL_TEXT_STATUS_UPDATE', 'Uw order is aangepast naar de volgende status.' . "\n\n" . 'Nieuwe status: %s' . "\n\n" . 'Reageer s.v.p. op deze email als u nog vragen heeft.' . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Het commentaar voor uw order is' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Fout: Order bestaat niet.');
define('SUCCESS_ORDER_UPDATED', 'Succes: De order is succesvol ge-update.');
define('WARNING_ORDER_NOT_UPDATED', 'Waarschuwing: Er valt niets aan te passen. Geen order update uitgevoerd.');
?>
