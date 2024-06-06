<?php
/*
  $Id: gv_mail.php,v 1.5.2.2 2003/04/27 12:36:00 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Envoie de ch&egrave;ques cadeaux aux clients');

define('TEXT_CUSTOMER', 'Client :');
define('TEXT_SUBJECT', 'Sujet :');
define('TEXT_FROM', 'De :');
define('TEXT_TO', 'Email :');
define('TEXT_AMOUNT', 'Valeur :');
define('TEXT_MESSAGE', 'Message :');
define('TEXT_SINGLE_EMAIL', '<span class="smallText">Utiliser uniquement ce formulaire pour envoyer un ch&egrave;que par email à une personne anonyme.</span>');
define('TEXT_SELECT_CUSTOMER', 'S&eacute;lection du client');
define('TEXT_ALL_CUSTOMERS', 'Tous les clients');
define('TEXT_NEWSLETTER_CUSTOMERS', 'A tous ceux qui ont souscrit &agrave; la newsletter');

define('NOTICE_EMAIL_SENT_TO', 'Note : Email envoy&eacute; a %s');
define('ERROR_NO_CUSTOMER_SELECTED', 'Erreur : Aucun client n\'a &eacute;t&eacute; s&eacute;lectionn&eacute;.');
define('ERROR_NO_AMOUNT_SELECTED', 'Erreur : Aucun montant n\'a &eacute;t&eacute; rempli.');

define('TEXT_GV_WORTH', 'Chèque cadeau d\'une valeur de : ');
define('TEXT_TO_REDEEM', 'Pour valider ce chèque cadeau, merci de cliquer sur le lien ci dessous. Attention a sauvegarder ou mettre de côté');
define('TEXT_WHICH_IS', ' le code de votre chèque ');
define('TEXT_IN_CASE', ' en cas de problème.');
define('TEXT_OR_VISIT', 'ou aller sur la page ');
define('TEXT_ENTER_CODE', ' et entrer le code.');

define ('TEXT_REDEEM_COUPON_MESSAGE_HEADER', 'Vous avez utilisé un chèque cadeau sur notre site, pour des raisons de sécurité, la montant du chèque cadeau ne vous a pas crédités. Notre magasin a remit ce montant.');
define ('TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', "\n\n" . 'La valeur du chèque cadeau était %s');
define ('TEXT_REDEEM_COUPON_MESSAGE_BODY', "\n\n" . 'Vous pouvez maintenant visiter notre site, vous connecter sur votre compte et l\'utiliser.');
define ('TEXT_REDEEM_COUPON_MESSAGE_FOOTER', "\n\n");

?>