<?php
/*
  modulo per pagamento tramite Ricarica PostePay (www.poste.it)
 
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
  
  define('MODULE_PAYMENT_POSTEPAY_TEXT_TITLE', 'Ricarica PostePay');
  define('MODULE_PAYMENT_POSTEPAY_TEXT_INTESTATARIO_CARTA', 'Ricarica da effettuare a: ');
  define('MODULE_PAYMENT_POSTEPAY_TEXT_NUMERO_CARTA', 'N° Carta PostePay: ');
  define('MODULE_PAYMENT_POSTEPAY_TEXT_DESCRIPTION', 'Modulo per il pagamento tramite Ricarica PostePay.');
  define('MODULE_PAYMENT_POSTEPAY_TEXT_CONFIRMATION', 'I dettagli per la Ricarica PostePay sono stati inviati, per sicurezza, via mail insieme ai dettagli del vostro ordine!');
  define('MODULE_PAYMENT_POSTEPAY_TEXT_DELIVERY', 'Non appena verrà contabilizzata la ricarica, provvederemo immediatamente alla spedizione della merce ordinata.');
  define('MODULE_PAYMENT_POSTEPAY_TEXT_EMAIL_FOOTER', MODULE_PAYMENT_POSTEPAY_TEXT_INTESTATARIO_CARTA . MODULE_PAYMENT_POSTEPAY_INTESTATARIO."\n".MODULE_PAYMENT_POSTEPAY_TEXT_NUMERO_CARTA . MODULE_PAYMENT_POSTEPAY_NUMERO_CARTA."\n\n".MODULE_PAYMENT_POSTEPAY_TEXT_DELIVERY);
?>
