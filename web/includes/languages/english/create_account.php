<?php
/*
  $Id: create_account.php,v 1.11 2003/07/05 13:58:31 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

//TotalB2B start
define('EMAIL_VALIDATE_SUBJECT', 'New customer at '. STORE_NAME);
define('EMAIL_VALIDATE', 'A new customer registered at '. STORE_NAME);
define('EMAIL_VALIDATE_PROFILE', 'To see customer profile click here:');
define('EMAIL_VALIDATE_ACTIVATE', 'To activate customer click here:');
//TotalB2B end

// Points/Rewards system V2.00 BOF
define('EMAIL_WELCOME_POINTS', '<li><span class="b">Reward Point Program</span> - As part of our Welcome to new customers, we have credited your %s with a total of %s Shopping Points worth %s .' . "\n" . 'Please refer to the %s as conditions may apply.');
define('EMAIL_POINTS_ACCOUNT', 'Shopping Points Accout');
define('EMAIL_POINTS_FAQ', 'Reward Point Program FAQ');
// Points/Rewards system V2.00 EOF
define('NAVBAR_TITLE', 'Create an Account');

define('HEADING_TITLE', 'My Account Information');

define('TEXT_ORIGIN_LOGIN', '<span class="ColorSpanRed"><span class="b">NOTE:</span></span> If you already have an account with us, please login at the <a href="%s"><span class="ColorSpan">login page</span></a>.');

define('EMAIL_SUBJECT', 'Welcome to ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Dear Mr. %s,' . "\n\n");
define('EMAIL_GREET_MS', 'Dear Ms. %s,' . "\n\n");
define('EMAIL_GREET_NONE', 'Dear %s' . "\n\n");
define('EMAIL_WELCOME', 'We welcome you to <span class="b">' . STORE_NAME . '</span>.' . "\n\n");
define('EMAIL_TEXT', 'You can now take part in the <span class="b">various services</span> we have to offer you. Some of these services include:' . "\n\n" . '<li><span class="b">Permanent Cart</span> - Any products added to your online cart remain there until you remove them, or check them out.' . "\n" . '<li><span class="b">Address Book</span> - We can now deliver your products to another address other than yours! This is perfect to send birthday gifts direct to the birthday-person themselves.' . "\n" . '<li><span class="b">Order History</span> - View your history of purchases that you have made with us.' . "\n" . '<li><span class="b">Products Reviews</span> - Share your opinions on products with our other customers.' . "\n\n");
define('EMAIL_CONTACT', 'For help with any of our online services, please email the store-owner: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<span class="b">Note:</span> This email address was given to us by one of our customers. If you did not signup to be a member, please send an email to ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");

/* ICW Credit class gift voucher begin */
define('EMAIL_GV_INCENTIVE_HEADER', "\n\n" .'As part of our welcome to new customers, we have sent you an e-Gift Voucher worth %s');
define('EMAIL_GV_REDEEM', 'The redeem code for the e-Gift Voucher is %s, you can enter the redeem code when checking out while making a purchase');
define('EMAIL_GV_LINK', 'or by following this link ');
define('EMAIL_COUPON_INCENTIVE_HEADER', 'Congratulations, to make your first visit to our online shop a more rewarding experience we are sending you an e-Discount Coupon.' . "\n" .
                                        ' Below are details of the Discount Coupon created just for you' . "\n");
define('EMAIL_COUPON_REDEEM', 'To use the coupon enter the redeem code which is %s during checkout while making a purchase');

/* ICW Credit class gift voucher end */

//###################################### avs ########################################
define('ENTRY_DATE_OF_BIRTH_ERROR2', ' You are too young, you need to be at least ' . MIN_AGE . ' years of age!');
define('ENTRY_DATE_OF_BIRTH_ERROR3', ' You are too old !');
//###################################### avs ########################################

?>