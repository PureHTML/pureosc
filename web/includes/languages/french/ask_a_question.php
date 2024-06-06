<?php
/*
  $Id: tell_a_friend.php,v 1.7 2003/06/10 18:20:39 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
  
  Edit only lines 26 & 27.
*/

define('NAVBAR_TITLE', 'Poser une question sur ce produit');

define('HEADING_TITLE', 'Poser une question concernant :<br />%s');

DEFINE('TEXT_QUESTION','Demander un renseignement concernant ');


define('FORM_TITLE_CUSTOMER_DETAILS', 'Vos informations');
define('FORM_TITLE_FRIEND_MESSAGE', 'Votre question');

define('FORM_FIELD_CUSTOMER_NAME', 'Votre nom:');
define('FORM_FIELD_CUSTOMER_EMAIL', 'Votre adresse e mail:');


define('TEXT_EMAIL_SUCCESSFUL_SENT', 'Votre question concernant <span class="b">%s</span> a &egrave;t&egrave; envoy&egrave; avec succ&eacute;s...');

define('TEXT_EMAIL_SUBJECT', 'Une question provenant d\'un client du site '. STORE_NAME .' sur %s');
define('TEXT_EMAIL_INTRO', '%s' . "\n\n" . 'un client, %s, souhaite recevoir des informations concernant : %s - %s.');
define('TEXT_EMAIL_LINK', 'Le lien du produit:' . "\n\n" . '%s');
define('TEXT_EMAIL_SIGNATURE', 'Cordialement,' . "\n\n" . '%s');

define('ERROR_FROM_NAME', 'Erreur: La champ nom ne peut pas être vide .');
define('ERROR_FROM_ADDRESS', 'Erreur: Le champ e mail doit être une adresse valide mail.');
?>