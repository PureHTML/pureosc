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
define('NAVBAR_TITLE_1', 'Account Aanmaken');
define('NAVBAR_TITLE_2', 'Succes');
define('HEADING_TITLE', 'Uw Account is aangemaakt!');
define('TEXT_ACCOUNT_CREATED', 'Gefeliciteerd! Uw nieuwe account is succesvol aangemaakt!<br />' . STORE_NAME . ' wenst u veel plezier met winkelen. Voor vragen kunt u altijd contact met \n');
?>