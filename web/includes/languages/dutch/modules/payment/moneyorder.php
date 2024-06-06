<?php
/*
  $Id: moneyorder.php,v 1.4 2002/11/01 05:36:58 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  define('MODULE_PAYMENT_MONEYORDER_TEXT_TITLE', 'Vooruit Betalen');
  define('MODULE_PAYMENT_MONEYORDER_TEXT_DESCRIPTION', 'Betaal aan:<br /><br />' . nl2br(STORE_NAME_ADDRESS) . '<br /><br />' . 'Uw bestelling wordt verzonden nadat de betaling binnen is.');
  define('MODULE_PAYMENT_MONEYORDER_TEXT_EMAIL_FOOTER', "Betaal aan:\n\n" . STORE_NAME_ADDRESS . "\n\n" . 'Uw bestelling wordt verzonden nadat de betaling binnen is.');
?>