<?php
/*
  $Id: gv_mail.php,v 1.5.2.2 2003/04/27 12:36:00 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Invia Gift Voucher ai clienti');

define('TEXT_CUSTOMER', 'Cliente:');
define('TEXT_SUBJECT', 'Oggetto:');
define('TEXT_FROM', 'Da:');
define('TEXT_TO', 'Email a:');
define('TEXT_AMOUNT', 'Importo');
define('TEXT_MESSAGE', 'Messaggio:');
define('TEXT_SINGLE_EMAIL', '<span class="smallText">Usare per inviare emails singolarmente, altrimenti usa dropdown sopra</span>');
define('TEXT_SELECT_CUSTOMER', 'Seleziona cliente');
define('TEXT_ALL_CUSTOMERS', 'Tutti i clienti');
define('TEXT_NEWSLETTER_CUSTOMERS', 'A tutti gli iscritti alla Newsletter');

define('NOTICE_EMAIL_SENT_TO', 'Avviso: Email inviata a: %s');
define('ERROR_NO_CUSTOMER_SELECTED', 'Errore: Nessun cliente selezionato.');
define('ERROR_NO_AMOUNT_SELECTED', 'Errore: Nessun importo selezionato.');

define('TEXT_GV_WORTH', 'The Gift Voucher is worth ');
define('TEXT_TO_REDEEM', 'Per riscattare il Gift Voucher, clicca sul link sotto indicato. Inserisci il codice del buono');
define('TEXT_WHICH_IS', ' che e\': ');
define('TEXT_IN_CASE', ' in caso di problemi.');
define('TEXT_OR_VISIT', 'o visita ');
define('TEXT_ENTER_CODE', ' ed inserisci il codice in fase d\'ordine');

define ('TEXT_REDEEM_COUPON_MESSAGE_HEADER', 'Hai recentemente acquistato un Gift Voucher dal nostro sito, per ragioni di sicurezza, l&#39;importo del Gift Voucher non ti &egrave; stato ancora accreditato. The shop owner has now released this amount.');
define ('TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', "\n\n" . 'Il valore del Gift Voucher &egrave; %s');
define ('TEXT_REDEEM_COUPON_MESSAGE_BODY', "\n\n" . 'Ora puoi visitare il nostro sito, fare il login ed inviare il Gift Voucher a chiunque tu voglia.');
define ('TEXT_REDEEM_COUPON_MESSAGE_FOOTER', "\n\n");

?>