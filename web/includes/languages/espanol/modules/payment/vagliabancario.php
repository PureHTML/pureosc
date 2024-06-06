<?php
/*
  modulo per pagamento tramite vaglia bancario
  by hOZONE, hozone@tiscali.it, http://hozone.cjb.net

  visita osCommerceITalia, http://www.oscommerceitalia.com
  
  derivato dal modulo:
  $Id: moneyorder.php,v 1.6 2003/01/24 21:36:04 thomasamoulton Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/
  
  define('MODULE_PAYMENT_VAGLIABANCARIO_TEXT_TITLE', 'Vaglia Bancario');
  define('MODULE_PAYMENT_VAGLIABANCARIO_TEXT_DESCRIPTION', 'Modulo per il pagamento tramite Vaglia Bancario.');
  define('MODULE_PAYMENT_VAGLIABANCARIO_TEXT_EMAIL_FOOTER', "Da pagare a:\n\nIntestatario: ".MODULE_PAYMENT_VAGLIABANCARIO_INTESTATARIO."\nBanca: ".MODULE_PAYMENT_VAGLIABANCARIO_BANCA."\nCAB: ".MODULE_PAYMENT_VAGLIABANCARIO_CAB."\nABI: ".MODULE_PAYMENT_VAGLIABANCARIO_ABI."\nCIN: ".MODULE_PAYMENT_VAGLIABANCARIO_CIN."\nC/C: ".MODULE_PAYMENT_VAGLIABANCARIO_CC."\n\nNon appena riceveremo il pagamento provvederemo alla spedizione della merce ordinata.");
?>
