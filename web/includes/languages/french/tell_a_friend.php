<?php
/*
  $Id: tell_a_friend.php,v 1.7 2003/06/10 18:20:39 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
  Translated by Gunt - Contact : webmaster@webdesigner.com.fr
*/

define('NAVBAR_TITLE', 'Faire conna&icirc;tre &agrave; un ami(e)');

define('HEADING_TITLE', 'Faire conna&icirc;tre &agrave; un ami(e) &agrave; propos de \'%s\'');

define('FORM_TITLE_CUSTOMER_DETAILS', 'Vous');
define('FORM_TITLE_FRIEND_DETAILS', 'Votre ami(e)');
define('FORM_TITLE_FRIEND_MESSAGE', 'Votre message');

define('FORM_FIELD_CUSTOMER_NAME', 'Votre nom :');
define('FORM_FIELD_CUSTOMER_EMAIL', 'Votre adresse &eacute;lectronique :');
define('FORM_FIELD_FRIEND_NAME', 'Le nom de votre ami(e) :');
define('FORM_FIELD_FRIEND_EMAIL', 'L\'adresse &eacute;lectronqiue de votre ami(e) :');

define('TEXT_EMAIL_SUCCESSFUL_SENT', 'Votre courrier &eacute;lectronique &agrave; propos de <span class="b">%s</span> Ont &eacute;t&eacute; avec succ&egrave;s envoy&eacute; &agrave; <span class="b">%s</span>.');

define('TEXT_EMAIL_SUBJECT', 'Votre ami %s a recommand&eacute; ce produit de %s');
define('TEXT_EMAIL_INTRO', 'Hé %s !' . "\n\n" . 'Votre ami(e), %s, a pens&eacute; que vous seriez int&eacute;ress&eacute;s par %s de %s.');
define('TEXT_EMAIL_LINK', 'Pour voir le produit cliquez sur le lien ci-dessous ou copiez et collez le lien dans votre navigateur Internet :' . "\n\n" . '%s');
define('TEXT_EMAIL_SIGNATURE', 'Amicalement,' . "\n\n" . '%s');

define('ERROR_TO_NAME', 'Erreur : Votre nom d\'ami(e) ne doit pas être vide.');
define('ERROR_TO_ADDRESS', 'Erreur : L\'adresse &eacute;lectronique de votre ami(e) doit &ecirc;tre une adresse &eacute;lectronique valide.');
define('ERROR_FROM_NAME', 'Erreur : Votre nom ne doit pas &ecirc;tre vide.');
define('ERROR_FROM_ADDRESS', 'Erreur : Votre adresse &eacute;lectronique doit &ecirc;tre une adresse &eacute;lectronique valide.');
?>