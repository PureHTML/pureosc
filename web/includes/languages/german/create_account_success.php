<?php
/*
  $Id: create_account_success.php,v 1.9 2003/02/16 00:42:03 harley_vb Exp $

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
define('NAVBAR_TITLE_1', 'Konto erstellen');
define('NAVBAR_TITLE_2', 'Erfolg');
define('HEADING_TITLE', 'Ihr Konto wurde mit Erfolg er&ouml;ffnet!');
define('TEXT_ACCOUNT_CREATED', 'Herzlichen Gl&uuml;ckwunsch! Ihr neues Konto wurde erfolgreich er&ouml;ffnet! Sie k&ouml;nnen jetzt &uuml;ber Ihr Kundenkonto unseren \'Online-Service\' effizienter nutzen. Wenn Sie Fragen zum diesem Online-Shop haben, wenden Sie sich bitte an den <a href="' . tep_href_link(FILENAME_CONTACT_US) . '"><span class="ColorSpan">Vertrieb</span></a>.<br /><br />Eine Best&auml;tigung &uuml;ber Ihr neues Konto wird Ihnen zugesandt. Falls Sie diese eMail nicht innerhalb einer Stunde erhalten, wenden Sie sich bitte an den <a href="' . tep_href_link(FILENAME_CONTACT_US) . '"><span class="ColorSpan">Vertrieb</span></a>.');
?>