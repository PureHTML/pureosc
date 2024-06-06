<?php
/*
  $Id: create_account_success.php,v 1.9 2002/11/19 01:48:08 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

//TotalB2B
define('TEXT_ACCOUNT_CREATED_ENABLE', '<br /><br /><b><u>Your account is active.</u></b>');
define('TEXT_ACCOUNT_CREATED_DISABLE', '<br /><br /><b><u>Your account must be activated by us, before you can use it.</u></b>');
//TotalB2B

// Points/Rewards system V2.00 BOF
define('TEXT_WELCOME_POINTS_TITLE', 'As part of our Welcome to new customers, we have credited your  <a href="' . tep_href_link(FILENAME_MY_POINTS, '', 'SSL') . '">Shopping Points Accout</a>  with a total of %s Shopping Points worth %s');
define('TEXT_WELCOME_POINTS_LINK', 'Please refer to the  <a href="' . tep_href_link(FILENAME_MY_POINTS_HELP, '', 'NONSSL') . '">Reward Point Program FAQ</a> as conditions may apply.');
// Points/Rewards system V2.00 EOF
define('NAVBAR_TITLE_1', 'Create an Account');
define('NAVBAR_TITLE_2', 'Success');
define('HEADING_TITLE', 'Your Account Has Been Created!');
define('TEXT_ACCOUNT_CREATED', 'Congratulations! Your new account has been successfully created! You can now take advantage of member priviledges to enhance your online shopping experience with us. If you have <span class="b">ANY</span> questions about the operation of this online shop, please email the <a href="' . tep_href_link(FILENAME_CONTACT_US) . '">store owner</a>.<br /><br />A confirmation has been sent to the provided email address. If you have not received it within the hour, please <a href="' . tep_href_link(FILENAME_CONTACT_US) . '">contact us</a>.');
?>