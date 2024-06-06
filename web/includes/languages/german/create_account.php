<?php
/*
  $Id: create_account.php,v 1.13 2003/05/19 20:17:51 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

//TotalB2B start
define('EMAIL_VALIDATE_SUBJECT', 'New customer at '. STORE_NAME);
define('EMAIL_VALIDATE', 'A new customer registered at '. STORE_NAME);
define('EMAIL_VALIDATE_PROFILE', 'To see customer profile click here:');
define('EMAIL_VALIDATE_ACTIVATE', 'To activate customer click here:');
//TotalB2B end

// Points/Rewards system V2.00 BOF
define('EMAIL_WELCOME_POINTS', '<li><span class="b">Reward Point Program</span> - As part of our Welcome to new customers, we have credited your %s with a total of %s Shopping Points worth %s .' . "\n" . 'Please refer to the %s as conditions may apply.');
define('EMAIL_POINTS_ACCOUNT', 'Shopping Points Accout');
define('EMAIL_POINTS_FAQ', 'Reward Point Program FAQ');
// Points/Rewards system V2.00 EOF
define('NAVBAR_TITLE', 'Konto erstellen');

define('HEADING_TITLE', 'Informationen zu Ihrem Kundenkonto');

define('TEXT_ORIGIN_LOGIN', '<span class="ColorSpanRed"><span class="b">ACHTUNG:</span></span> Wenn Sie bereits ein Konto besitzen, so melden Sie sich bitte <a href="%s"><span class="ColorSpan"><span class="b">hier</span></span></a> an.');

define('EMAIL_SUBJECT', 'Willkommen zu ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Sehr geehrter Herr ' . stripslashes($_POST['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_MS', 'Sehr geehrte Frau ' . stripslashes($_POST['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_NONE', 'Sehr geehrte ' . stripslashes($_POST['firstname']) . ',' . "\n\n");
define('EMAIL_WELCOME', 'willkommen zu <span class="b">' . STORE_NAME . '</span>.' . "\n\n");
define('EMAIL_TEXT', 'Sie können jetzt unseren <span class="b">Online-Service</span> nutzen. Der Service bietet unter anderem:' . "\n\n" . '<li><span class="b">Kundenwarenkorb</span> - Jeder Artikel bleibt registriert bis Sie zur Kasse gehen, oder die Produkte aus dem Warenkorb entfernen.' . "\n" . '<li><span class="b">Adressbuch</span> - Wir können jetzt die Produkte zu der von Ihnen ausgesuchten Adresse senden. Der perfekte Weg ein Geburtstagsgeschenk zu versenden.' . "\n" . '<li><span class="b">Vorherige Bestellungen</span> - Sie können jederzeit Ihre vorherigen Bestellungen überprüfen.' . "\n" . '<li><span class="b">Meinungen über Produkte</span> - Teilen Sie Ihre Meinung zu unseren Produkten mit anderen Kunden.' . "\n\n");
define('EMAIL_CONTACT', 'Falls Sie Fragen zu unserem Kunden-Service haben, wenden Sie sich bitte an den Vertrieb: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<span class="b">Achtung:</span> Diese eMail-Adresse wurde uns von einem Kunden bekannt gegeben. Falls Sie sich nicht angemeldet haben, senden Sie bitte eine eMail an ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");

/* ICW Credit class gift voucher begin */
define('EMAIL_GV_INCENTIVE_HEADER', 'Als kleines Willkommensgeschenk senden wir Ihnen einen Gutschein nber %s');
define('EMAIL_GV_REDEEM', 'Ihr pers˜nlicher Gutscheincode lautet %s. Sie k˜nnen diese Gutschrift entweder wShrend dem Bestellvorgang verbuchen');
define('EMAIL_GV_LINK', 'oder direkt nber diesen Link: ');
define('EMAIL_COUPON_INCENTIVE_HEADER', 'Herzlich Willkommen in unserem Webshop. Fnr Ihren ersten Einkauf verfngen Sie nber einen kleinen Einkaufsgutschein,' . "\n" .
                                        ' alle notwendigen Informationen diesbeznglich finden Sie hier:' . "\n\n");
define('EMAIL_COUPON_REDEEM', 'Geben Sie einfach Ihren pers˜nlichen Code   %s wShrend des Bezahlvorganges ' . "\n" .
                               'ein');

/* ICW Credit class gift voucher end */

//###################################### avs ########################################
define('ENTRY_DATE_OF_BIRTH_ERROR2', ' Sie sind nicht alt genug, Sie müssen mindestens ' . MIN_AGE . ' Jahre alt sein!');
define('ENTRY_DATE_OF_BIRTH_ERROR3', ' You are too old !');
//###################################### avs ########################################

?>
