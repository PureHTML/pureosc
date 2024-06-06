<?php
/*
  $Id: moneyorder.php,v 1.6 2003/01/24 21:36:04 thomasamoulton Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce 

  Released under the GNU General Public License 
*/

  define('MODULE_PAYMENT_MONEYORDER_TEXT_TITLE', 'Check/Money Order');
  define('MODULE_PAYMENT_MONEYORDER_TEXT_DESCRIPTION', 'Da pagare a:&nbsp;' . MODULE_PAYMENT_MONEYORDER_PAYTO . '<br /><br />Da Spedire a:<br />' . nl2br(STORE_NAME_ADDRESS) . '<br /><br />' . 'Il tuo ordine non verr&agrave; spedito finch&egrave; non riceveremo il pagamento.');
  define('MODULE_PAYMENT_MONEYORDER_TEXT_EMAIL_FOOTER', "Da pagare a:&nbsp;". MODULE_PAYMENT_MONEYORDER_PAYTO . "\n\na Spedire a:\n" . STORE_NAME_ADDRESS . "\n\n" . 'Il tuo ordine non verr&agrave; spedito finch&egrave; non riceveremo il pagamento.');
?>