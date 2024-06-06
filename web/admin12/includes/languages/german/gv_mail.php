<?php
/*
  $Id: gv_mail.php,v 1.1.2.1 2003/05/15 23:10:55 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 - 2003 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Gutschein an Kunden versenden');

define('TEXT_CUSTOMER', 'Kunde:');
define('TEXT_SUBJECT', 'Betreff:');
define('TEXT_FROM', 'Absender:');
define('TEXT_TO', 'E-Mail an:');
define('TEXT_AMOUNT', 'Betrag:');
define('TEXT_MESSAGE', 'Nachricht:');
define('TEXT_SINGLE_EMAIL', '<span class="smallText">Use this for sending single emails, otherwise use dropdown above</span>');
define('TEXT_SELECT_CUSTOMER', 'Kunden ausw&auml;hlen');
define('TEXT_ALL_CUSTOMERS', 'Alle Kunden');
define('TEXT_NEWSLETTER_CUSTOMERS', 'An alle Newsletter-Abonnenten');

define('NOTICE_EMAIL_SENT_TO', 'Hinweis: eMail wurde versendet an: %s');
define('ERROR_NO_CUSTOMER_SELECTED', 'Fehler: Es wurde kein Kunde ausgew&auml;hlt.');
define('ERROR_NO_AMOUNT_SELECTED', 'Fehler: Sie haben keinen Betrag f&uuml;r den Gutschein eingegeben.');

define('TEXT_GV_WORTH', 'Gutscheinwert ');
define('TEXT_TO_REDEEM', 'Um Ihren Gutschein zu verbuchen, klicken Sie auf den unten stehenden Link. Bitte notieren Sie sich zur Sicherheit Ihren pers&ouml;nlichen Gutschein-Code.');
define('TEXT_WHICH_IS', 'Ihr Gutscheincode lautet: ');
define('TEXT_IN_CASE', ' Falls es wider Erwarten zu Problemen beim verbuchen kommen sollte.');
define('TEXT_OR_VISIT', 'besuchen Sie unsere Webseite');
define('TEXT_ENTER_CODE', ' und geben den Gutschein-Code bitte manuell ein ');

define ('TEXT_REDEEM_COUPON_MESSAGE_HEADER', 'Sie haben in unserem Webshop einen Gutschein gekauft, welcher aus Sicherheitsgründen nicht sofort freigeschaltet wurde. Dieses Guthaben steht Ihnen nun zur Verf&uuml;gung.');
define ('TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', "\n\n" . 'Der Wert Ihres Gutscheines betr&auml;gt %s');
define ('TEXT_REDEEM_COUPON_MESSAGE_BODY', "\n\n" . 'Sie k&ouml;nnen nun &uuml;ber Ihren persönlichen Account den Gutschein versenden.');
define ('TEXT_REDEEM_COUPON_MESSAGE_FOOTER', "\n\n");

?>