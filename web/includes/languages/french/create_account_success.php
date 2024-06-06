<?php
/*
  $Id: create_account_success.php,v 1.9 2002/11/19 01:48:08 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
  Translated by Gunt - Contact : webmaster@webdesigner.com.fr
*/

//TotalB2B
define('TEXT_ACCOUNT_CREATED_ENABLE', '<br /><br /><b><u>Your account is active.</u></b>');
define('TEXT_ACCOUNT_CREATED_DISABLE', '<br /><br /><b><u>Your account must be activated by us, before you can use it.</u></b>');
//TotalB2B

// Points/Rewards system V2.00 BOF
define('TEXT_WELCOME_POINTS_TITLE', 'As part of our Welcome to new customers, we have credited your  <a href="' . tep_href_link(FILENAME_MY_POINTS, '', 'SSL') . '">Shopping Points Accout</a>  with a total of %s Shopping Points worth %s');
define('TEXT_WELCOME_POINTS_LINK', 'Please refer to the  <a href="' . tep_href_link(FILENAME_MY_POINTS_HELP, '', 'NONSSL') . '">Reward Point Program FAQ</a> as conditions may apply.');
// Points/Rewards system V2.00 EOF
define('NAVBAR_TITLE_1', 'Cr&eacute;er un comtpe');
define('NAVBAR_TITLE_2', 'Succ&egrave;s');
define('HEADING_TITLE', 'Votre compte a &eacute;t&eacute; cr&eacute;&eacute; !');
define('TEXT_ACCOUNT_CREATED', 'F&eacute;licitations ! Votre nouveau compte a &eacute;t&eacute; cr&eacute;&eacute; avec succ&egrave;s ! Vous pouvez maintenant profiter des privil&egrave;ges de membre afin de tirer pleinement parti de notre magasin en ligne. Pour <span class="b">TOUTE</span> question sur le fonctionnement de ce magasin en ligne, envoyez s\'il vous pla&icirc;t un courrier &eacute;lectronique au <a href="' . tep_href_link(FILENAME_CONTACT_US) . '">propri&eacute;taire du magasin</a>.<br /><br />Une confirmation a &eacute;t&eacute; envoy&eacute;e &agrave; l\'adresse &eacute;lectronique fournie. Si vous ne l\'avez pas reçu dans l\'heure, s\'il vous pla&icirc;t  <a href="' . tep_href_link(FILENAME_CONTACT_US) . '">contactez-nous</a>.');
?>