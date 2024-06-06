<?php
/*
  $Id: coupon_admin.php,v 1.1.2.2 2003/05/15 23:10:55 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
define('TEXT_COUPON_REDEEMED', 'Redeemed Coupons');
define('REDEEM_DATE_LAST', 'Date Last Redeemed');
define('TOP_BAR_TITLE', 'Statistiken');
define('HEADING_TITLE', 'Discount Coupons');
define('HEADING_TITLE_STATUS', 'Status : ');
define('TEXT_CUSTOMER', 'Kunde:');
define('TEXT_COUPON', 'Coupon Name');
define('TEXT_COUPON_ALL', 'Alle Coupons');
define('TEXT_COUPON_ACTIVE', 'Aktive Coupons');
define('TEXT_COUPON_INACTIVE', 'Inaktive Coupons');
define('TEXT_SUBJECT', 'Betreff:');
define('TEXT_FROM', 'Von:');
define('TEXT_FREE_SHIPPING', 'Versandkostenfrei');
define('TEXT_MESSAGE', 'Nachricht:');
define('TEXT_SELECT_CUSTOMER', 'Kunde w&auml;hlen');
define('TEXT_ALL_CUSTOMERS', 'Alle Kunden');
define('TEXT_NEWSLETTER_CUSTOMERS', 'An alle Newsletter Abonnenten ');
define('TEXT_CONFIRM_DELETE', 'Diesen Coupon wirklich l&ouml;schen ?');

define('TEXT_TO_REDEEM', 'Bei Ihrer n&auml;chsten Bestellung k&ouml;nnen Sie diesen Coupon einl&ouml;sen.');
define('TEXT_IN_CASE', ' falls Probleme entstehen sollten. ');
define('TEXT_VOUCHER_IS', 'Der Coupon Code lautet ');
define('TEXT_REMEMBER', 'Bitte bewahren Sie den Coupon Code sicher auf bis Ihre Gutschrift eingel&ouml;st wird.');
define('TEXT_VISIT', 'Wenn Sie folgende Shop besuchen' . STORE_NAME . '&nbsp;unter:<br />' . HTTP_SERVER . DIR_WS_CATALOG);
define('TEXT_ENTER_CODE', ' und den Coupon Code eingeben ');

define('TABLE_HEADING_ACTION', 'Action');

define('CUSTOMER_ID', 'Customer id');
define('CUSTOMER_NAME', 'Kundenname');
define('REDEEM_DATE', 'Einl&ouml;sedatum');
define('IP_ADDRESS', 'IP Adresse');

define('TEXT_REDEMPTIONS', 'R&uuml;ckk&auml;ufe');
define('TEXT_REDEMPTIONS_TOTAL', 'Gesamt');
define('TEXT_REDEMPTIONS_CUSTOMER', 'F&uuml;r den Kunden');
define('TEXT_NO_FREE_SHIPPING', 'Nicht Versandkostenfrei');

define('NOTICE_EMAIL_SENT_TO', 'Info: eMail gesendet an: %s');
define('ERROR_NO_CUSTOMER_SELECTED', 'Fehler: Es wurde kein Kunde gew&auml;hlt.');
define('COUPON_NAME', 'Coupon Name');
//define('COUPON_VALUE', 'Coupon Value');
define('COUPON_AMOUNT', 'Coupon Betrag');
define('COUPON_CODE', 'Coupon Code');
define('COUPON_STARTDATE', 'Start Datum');
define('COUPON_FINISHDATE', 'G&uuml;ltig bis');
define('COUPON_FREE_SHIP', 'Versandkostenfrei');
define('COUPON_DESC', 'Coupon Beschreibung');
define('COUPON_MIN_ORDER', 'Coupon Mindestbestellwert');
define('COUPON_USES_COUPON', 'Nutzung per Coupon');
define('COUPON_USES_USER', 'Nutzung pro Kunde');
define('COUPON_PRODUCTS', 'Beschr&auml;nken auf folgende Produkte');
define('COUPON_CATEGORIES', 'Beschr&auml;nken auf folgende Kategorien');
define('VOUCHER_NUMBER_USED', 'Coupon Nummer');
define('DATE_CREATED', 'Erstellt am');
define('DATE_MODIFIED', 'Ge&auml;ndert am');
define('TEXT_HEADING_NEW_COUPON', 'Neuen Coupon erstellen');
define('TEXT_NEW_INTRO', 'Bitte machen Sie f&uuml;r einen neuen Coupon folgende Angaben: <br />');


define('COUPON_NAME_HELP', 'Eine kurze Bezeichnung f&uuml;r den Coupon');
define('COUPON_AMOUNT_HELP', 'Wert des Coupons: Zahl f&uuml;r Fixwert angeben, wenn Prozentualer Wert gew&uuml;nscht bitte Zeichen % hinter der Zahl angeben.');
define('COUPON_CODE_HELP', 'Hier eigenen Code angeben, leer lassen f&uuml;r automatisch generierten Code.');
define('COUPON_STARTDATE_HELP', 'Coupon G&uuml;ltig ab:');
define('COUPON_FINISHDATE_HELP', 'Coupon g&uuml;ltig bis:');
define('COUPON_FREE_SHIP_HELP', 'Den Coupon gibt es versandkostenfrei bei der Bestellung. Hinweis: Wenn der Coupon-Wert unter dem Minimalbestellwert liegt, kann wer angelehnt werden.');
define('COUPON_DESC_HELP', 'Eine Beschreibung des Coupons f&uuml;r den Kunden');
define('COUPON_MIN_ORDER_HELP', 'Mindestbestellwert um Coupon einzul&ouml;sen');
define('COUPON_USES_COUPON_HELP', 'Wie oft kann dieser Coupon allgemein genutzt werden ? Achtung: Keine Angabe = kein Limit !');
define('COUPON_USES_USER_HELP', 'Wie oft kann dieser Coupon von einem Kunden genutzt werden ? Achtung: Keine Angabe = kein Limit !');
define('COUPON_PRODUCTS_HELP', 'Eine durch Kommas getrennte Liste der product_ids auf die der Coupon angewendet werden kann. Feld leer lassen falls keine Einschr&auml;nkung gew&uuml;nscht.');
define('COUPON_CATEGORIES_HELP', 'Eine durch Kommas getrennte Liste der Pfade ( cpaths )auf die der Coupon angewendet werden kann. Feld leer lassen falls keine Einschr&auml;nkung gew&uuml;nscht.');
define('ERROR_NO_COUPON_AMOUNT', 'Error: No coupon amount has been entered. Either enter an amount or select free shipping.');
define('ERROR_COUPON_EXISTS', 'Error: A coupon with the same coupon code already exists.');
define('COUPON_BUTTON_EMAIL_VOUCHER', 'Email Voucher');
define('COUPON_BUTTON_EDIT_VOUCHER', 'Edit Voucher');
define('COUPON_BUTTON_DELETE_VOUCHER', 'Delete Voucher');
define('COUPON_BUTTON_VOUCHER_REPORT', 'Voucher Report');
define('COUPON_STATUS', 'Status');
define('COUPON_STATUS_HELP', 'Set to ' . IMAGE_ICON_STATUS_RED . ' to disable customers\' ability to use the coupon.');
?>