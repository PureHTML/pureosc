<?php
/*
  $Id: paypal_ipn.php,v 2.3.3.0 11/17/2007 16:30:45 alexstudio Exp $

  Copyright (c) 2008 osCommerce
  Released under the GNU General Public License
  
  Original Authors: Harald Ponce de Leon, Mark Evans 
  Updates by PandA.nl, Navyhost, Zoeticlight, David, gravyface, AlexStudio, windfjf, asulis and Terra
  v2.3 updated by AlexStudio
    
*/

  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_TITLE', 'Carte de crédit/débit (via PayPal)');
  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_DESCRIPTION', 'PayPal IPN v2.3.4');
  // BOF add by AlexStudio
  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_SELECTION', '<img src="https://www.paypal.com/en_US/i/logo/PayPal_mark_37x23.gif" align="left" style="margin-right:7px;"> Carte de crédit/débit (via PayPal)');
  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_LAST_CONFIRM', '<img src="https://www.paypal.com/en_US/i/logo/PayPal_mark_37x23.gif" align="left" style="margin-right:7px;"> Carte de crédit/débit (via PayPal)');
  // EOF add by AlexStudio

  // Sets the text for the "continue" button on the PayPal Payment Complete Page
  // Maximum of 60 characters!  
  define('CONFIRMATION_BUTTON_TEXT', 'Finaliser votre commande');
  
define('EMAIL_PAYPAL_PENDING_NOTICE', 'Votre paiement est actuellement en attente. Nous vous enverrons une copie de votre commande dès que le paiement aura été effectué.');
  
define('EMAIL_TEXT_SUBJECT', 'Commande');
define('EMAIL_TEXT_ORDER_NUMBER', 'No de commande:');
define('EMAIL_TEXT_INVOICE_URL', 'Commande détaillée:');
define('EMAIL_TEXT_DATE_ORDERED', 'Date de commande:');
define('EMAIL_TEXT_PRODUCTS', 'Produits');
define('EMAIL_TEXT_SUBTOTAL', 'Sous-Total:');
define('EMAIL_TEXT_TAX', 'TVA:');
define('EMAIL_TEXT_SHIPPING', 'Frais de livraison:');
define('EMAIL_TEXT_TOTAL', 'Total:');
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Adresse de livraison');
define('EMAIL_TEXT_BILLING_ADDRESS', 'Adresse de facturation');
define('EMAIL_TEXT_PAYMENT_METHOD', 'Moyen de paiement');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('TEXT_EMAIL_VIA', 'par'); 

define('PAYPAL_ADDRESS', 'Adresse Paypal du client');  
 
/* If you want to include a message with the order email, enter text here: */
/* Use \n for line breaks */
define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_EMAIL_FOOTER', '');
   
?>
