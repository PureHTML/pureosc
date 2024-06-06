<?php
/*
  $Id: create_account_success.php,v 1.9 2002/11/19 01:48:08 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce 

  Released under the GNU General Public License 
*/

//TotalB2B
define('TEXT_ACCOUNT_CREATED_ENABLE', '<br /><br /><span class="ColorRed">Il vostro account &egrave; ATTIVO.</span>');
define('TEXT_ACCOUNT_CREATED_DISABLE', '<br /><br /><span class="ColorRed">Il vostro account &egrave; INATTIVO, pazientate fino a quando il webmaster non vi attiva.</span>');
//TotalB2B

// Points/Rewards system V2.00 BOF
define('TEXT_WELCOME_POINTS_TITLE', 'As part of our Welcome to new customers, we have credited your  <a href="' . tep_href_link(FILENAME_MY_POINTS, '', 'SSL') . '">Shopping Points Accout</a>  with a total of %s Shopping Points worth %s');
define('TEXT_WELCOME_POINTS_LINK', 'Please refer to the  <a href="' . tep_href_link(FILENAME_MY_POINTS_HELP, '', 'NONSSL') . '">Reward Point Program FAQ</a> as conditions may apply.');
// Points/Rewards system V2.00 EOF
define('NAVBAR_TITLE_1', 'Crea un  Account');
define('NAVBAR_TITLE_2', 'Successo');
define('HEADING_TITLE', 'Il tuo account &egrave; stato creato!');
define('TEXT_ACCOUNT_CREATED', 'Congratulazioni! Il tuo nuovo account &egrave; stato creato con successo! Può ora usufruire dei privilegi da membro. Se tu hai <span class="b">qualsiasi</span> dubbio sul funzionamento di questo negozio on-line, manda una e-mail all\' <a href="' . tep_href_link(FILENAME_CONTACT_US) . '"><span class="b">amministratore</span></a>.<br /><br />Una conferma &egrave; stata inviata all\'indirizzo specificato. Se non l\'hai ricevuta entro poche ore, <a href="' . tep_href_link(FILENAME_CONTACT_US) . '"><span class="b">contattaci</span></a>.');
?>