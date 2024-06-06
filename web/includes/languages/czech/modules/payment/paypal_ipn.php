<?php
/*
  $Id: paypal_ipn.php,v 2.3.3.0 11/17/2007 16:30:37 alexstudio Exp $

  Copyright (c) 2008 osCommerce
  Released under the GNU General Public License
  
  Original Authors: Harald Ponce de Leon, Mark Evans 
  Updates by PandA.nl, Navyhost, Zoeticlight, David, gravyface, AlexStudio, windfjf and Terra
  v2.3 updated by AlexStudio
    
*/

  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_TITLE', 'Credit/Debit Card (via PayPal)');
  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_DESCRIPTION', 'PayPal IPN v2.3.4');
  // BOF add by AlexStudio
  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_SELECTION', '<img src="https://www.paypal.com/en_US/i/logo/PayPal_mark_37x23.gif" align="left" style="margin-right:7px;"> Credit/Debit Card (via PayPal)');
  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_LAST_CONFIRM', '<img src="https://www.paypal.com/en_US/i/logo/PayPal_mark_37x23.gif" align="left" style="margin-right:7px;"> Credit/Debit Card (via PayPal)');
  // EOF add by AlexStudio
  // Sets the text for the "continue" button on the PayPal Payment Complete Page
  // Maximum of 60 characters!  
  define('CONFIRMATION_BUTTON_TEXT', 'Complete your Order Confirmation');
  define('EMAIL_PAYPAL_PENDING_NOTICE', 'Your payment is currently pending. We will send you a copy of your order once the payment has cleared.');
  
  define('EMAIL_TEXT_SUBJECT', 'Objednávka');
  define('EMAIL_TEXT_ORDER_NUMBER', 'Objednávka číslo:');
  define('EMAIL_TEXT_INVOICE_URL', 'Detail objednávky:');
  define('EMAIL_TEXT_DATE_ORDERED', 'Datum objednávky:');
  define('EMAIL_TEXT_PRODUCTS', 'Zboží');
  define('EMAIL_TEXT_SUBTOTAL', 'Mezisoučet:');
  define('EMAIL_TEXT_TAX', 'Tax:        ');
  define('EMAIL_TEXT_SHIPPING', 'Dopravné: ');
  define('EMAIL_TEXT_TOTAL', 'Celkem:    ');
  define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Dodací adresa');
  define('EMAIL_TEXT_BILLING_ADDRESS', 'Fakturační adresa');
  define('EMAIL_TEXT_PAYMENT_METHOD', 'Platební metoda');

  define('EMAIL_SEPARATOR', '------------------------------------------------------');
  define('TEXT_EMAIL_VIA', 'via'); 

  define('PAYPAL_ADDRESS', 'Customer PayPal address');

/* If you want to include a message with the order email, enter text here: */
/* Use \n for line breaks */
  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_EMAIL_FOOTER', '');
  
?>
