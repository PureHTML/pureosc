<?php
/*
  $Id: checkout_payment.php,v 1.14 2003/02/06 17:38:16 thomasamoulton Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
// Points/Rewards Module V2.00 BOF
define('TABLE_HEADING_REDEEM_SYSTEM', 'Shopping Points Redemptions ');
define('TABLE_HEADING_REFERRAL', 'Referral System');
define('TEXT_REDEEM_SYSTEM_START', 'You have a credit balance of %s ,would you like to use it to pay for this order?<br />The estimated total of your purchase is: %s .');
define('TEXT_REDEEM_SYSTEM_SPENDING', 'Tick here to use Maximum Points allowed for this order. (%s points %s)&nbsp;&nbsp;->');
define('TEXT_REDEEM_SYSTEM_NOTE', 'Total Purchase is greater than the maximum points allowed, you will also need to choose a payment method');
define('TEXT_REFERRAL_REFERRED', 'If you were referred to us by a friend please enter their email address here. ');
// Points/Rewards Module V2.00 EOF
define('NAVBAR_TITLE_1', 'Checkout');
define('NAVBAR_TITLE_2', 'Payment Method');

define('HEADING_TITLE', 'Payment Information');

define('TABLE_HEADING_BILLING_ADDRESS', 'Billing Address');
define('TEXT_SELECTED_BILLING_DESTINATION', 'Please choose from your address book where you would like the invoice to be sent to.');
define('TITLE_BILLING_ADDRESS', 'Billing Address:');

define('TABLE_HEADING_PAYMENT_METHOD', 'Payment Method');
define('TEXT_SELECT_PAYMENT_METHOD', 'Please select the preferred payment method to use on this order.');
define('TITLE_PLEASE_SELECT', 'Please Select');
define('TEXT_ENTER_PAYMENT_INFORMATION', 'This is currently the only payment method available to use on this order.');

define('TABLE_HEADING_COMMENTS', 'Add Comments About Your Order');

define('TITLE_CONTINUE_CHECKOUT_PROCEDURE', 'Continue Checkout Procedure');
define('TEXT_CONTINUE_CHECKOUT_PROCEDURE', 'to confirm this order.');

// product summary text in checkout_payment.php
define('HEADING_PRODUCTS', 'Products Ordered');
define('TEXT_EDIT', 'Edit');


?>
