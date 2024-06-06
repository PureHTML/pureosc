<?php
/*
  $Id: gv_queue.php,v 1.2.2.1 2003/04/27 12:36:00 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 - 2003 osCommerce

  Gift Voucher System v1.0
  Copyright (c) 2001,2002 Ian C Wilson
  http://www.phesis.org

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Gift Voucher Release Queue');

define('TABLE_HEADING_CUSTOMERS', 'Clienti');
define('TABLE_HEADING_ORDERS_ID', 'Ordine N.');
define('TABLE_HEADING_VOUCHER_VALUE', 'Valore del buono');
define('TABLE_HEADING_DATE_PURCHASED', 'Data d&#39;acquisto');
define('TABLE_HEADING_ACTION', 'Azione');

define('TEXT_REDEEM_COUPON_MESSAGE_HEADER', 'Hai recentemente acquistato un Gift Voucher dal nostro negozio online.' . "\n"
                                          . 'Per ragioni di sicurezza il buono non &egrave; ancora disponibile.' . "\n"
                                          . 'Tuttavia l\'importo e\' stato rilasciato. Puoi ora visitare il nostro store' . "\n"
                                          . 'ed inviare il buono a chiunque tu voglia' . "\n\n");

define('TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', 'Il Gift Voucher(s) acquistato &egrave; disponibile %s' . "\n\n");

define('TEXT_REDEEM_COUPON_MESSAGE_BODY', '');
define('TEXT_REDEEM_COUPON_MESSAGE_FOOTER', '');
define('TEXT_REDEEM_COUPON_SUBJECT', 'Acquisto Gift Voucher');
?>