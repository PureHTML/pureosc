<?php
/*
  $Id: tell_a_friend.php,v 1.5 2002/11/19 01:48:08 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Vetel een vriend');

define('HEADING_TITLE', 'Vertel een vriend over \'%s\'');

define('FORM_TITLE_CUSTOMER_DETAILS', 'Jouw Details');
define('FORM_TITLE_FRIEND_DETAILS', 'Details van je vriend');
define('FORM_TITLE_FRIEND_MESSAGE', 'Jouw Bericht');

define('FORM_FIELD_CUSTOMER_NAME', 'Jouw naam:');
define('FORM_FIELD_CUSTOMER_EMAIL', 'Jouw Email Adres:');
define('FORM_FIELD_FRIEND_NAME', 'Jouw vriend\'s naam:');
define('FORM_FIELD_FRIEND_EMAIL', 'Jouw vriend\'s Email Adres:');

define('TEXT_EMAIL_SUCCESSFUL_SENT', 'Jouw email over <span class="b">%s</span> is succesvol verstuurd naar <span class="b">%s</span>.');

define('TEXT_EMAIL_SUBJECT', 'Jouw vriend %s raad dit geweldige product aan %s');
define('TEXT_EMAIL_INTRO', 'Hoi %s!' . "\n\n" . 'Jouw vriend, %s, dat je wel geïnteresseerd zou zijn in %s van %s.');
define('TEXT_EMAIL_LINK', 'Om het product te zien klik je gewoon op de onderstaande link of kopieer en plak de link in jouw web browser:' . "\n\n" . '%s');
define('TEXT_EMAIL_SIGNATURE', 'Groet,' . "\n\n" . '%s');

define('ERROR_TO_NAME', 'Error: Your friends name must not be empty.');
define('ERROR_TO_ADDRESS', 'Error: Your friends e-mail address must be a valid e-mail address.');
define('ERROR_FROM_NAME', 'Error: Your name must not be empty.');
define('ERROR_FROM_ADDRESS', 'Error: Your e-mail address must be a valid e-mail address.');
?>