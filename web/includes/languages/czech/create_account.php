<?php
/*
  $Id: create_account.php,v 1.11 2003/07/05 13:58:31 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
define('TEXT_ORIGIN_LOGIN', '<font color="#FF0000"><small><b>INFO:</b></font></small> Pokud již u nás máte svůj účet, prosím přihlašte se na <a href="' . tep_href_link(FILENAME_LOGIN, 'origin=checkout_address&connection=' . $HTTP_GET_VARS['connection'], 'NONSSL') . '"><u>přihlašovací stránce</u></a>.');

//TotalB2B start
define('EMAIL_VALIDATE_SUBJECT', 'Nový zákazník v internetovém obchodě '. STORE_NAME);
define('EMAIL_VALIDATE', 'Nový registrovaný zákazník v internetovém obchodě '. STORE_NAME);
define('EMAIL_VALIDATE_PROFILE', 'Klikněte pro zobrazení uživatelského profilu:');
define('EMAIL_VALIDATE_ACTIVATE', 'Klikněte pro aktivaci uživatelského profilu:');
//TotalB2B end

// Points/Rewards system V2.00 BOF
define('EMAIL_WELCOME_POINTS', '<li><span class="b">Bodovací program - bonusové body</span> - Vám - novému zákazníkovi připisujeme vašich %s bodů s celkovým součtem %s bonusových bodů v ceně %s .' . "\n" . 'Please refer to the %s as conditions may apply.');
define('EMAIL_POINTS_ACCOUNT', 'Shopping Points Účet');
define('EMAIL_POINTS_FAQ', 'Reward Point Program FAQ');
// Points/Rewards system V2.00 EOF
define('NAVBAR_TITLE', 'Vytvořit účet');

define('HEADING_TITLE', 'Informace o mém účtu');

define('TEXT_ORIGIN_LOGIN', '<span class="ColorSpanRed"><span class="b">NOTE:</span></span> Pokud již u nás máte svůj účet, prosím přihlašte se na <a href="%s"><span class="ColorSpan">login page</span></a>.');

define('EMAIL_SUBJECT', 'Vítejte v internetovém obchodě ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Vážený pán %s,' . "\n\n");
define('EMAIL_GREET_MS', 'Vážená paní %s,' . "\n\n");
define('EMAIL_GREET_NONE', 'Vážený %s' . "\n\n");
define('EMAIL_WELCOME', 'Vítejte <span class="b">' . STORE_NAME . '</span>.' . "\n\n");
define('EMAIL_TEXT', 'Po přihlášení můžete využívat služeb našeho obchodu,  <span class="b">například</span> které Vám nabízíme. Například tyto služby:' . "\n\n" . '<li><span class="b">Trvalý košík</span> - Zboží v košíku zůstane dokud jej nevymažete.' . "\n" . '<li><span class="b">Služba adresář</span> - Můžete si uložit až 5 různých dodacích adres, například svých přátel. Můžete jim tak posílat například narozeninové dárky přímo.' . "\n" . '<li><span class="b">služba Přehled objednávek</span> - můžete sledovat stav zpracování svých objednávek.' . "\n" . '<li><span class="b">Služba Zasílání novinek</span> - v případě Vašeho zájmu Vás budeme automaticky informovat o nových produktech, mimořádných nabídkách a slevách.' . "\n\n");
define('EMAIL_CONTACT', 'Pokud budete potřebovat pomoci s našimi on-line službami, kontaktujte provozovatele obchodu na adrese: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<span class="b">Upozornění:</span> Tento mail jste dostal(a), protože jste se registroval v našem obchodě. Pokud jste se u nás neregistroval, napište nám prosím na adresu ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");

/* ICW Credit class gift voucher begin */
define('EMAIL_GV_INCENTIVE_HEADER', "\n\n" .'jako službu pro nové zákazníky Vám můžeme zaslat e-Gift dárkový poukaz %s');
define('EMAIL_GV_REDEEM', 'redeem kód pro Váš e-Gift Poukaz je: %s, můžete jej vložit při placení v našem obchodě');
define('EMAIL_GV_LINK', 'nebo by tento link: ');
define('EMAIL_COUPON_INCENTIVE_HEADER', 'Gratulujeme, poprvé jste navštívil náš online obchod a můžete si vyzkoušet zasílání vašeho e-Discount Kuponu.' . "\n" .
                                        ' Níže čtěte detaily pro Slevový kupon, který je pro vás nyní připraven' . "\n");
define('EMAIL_COUPON_REDEEM', 'Chcete li použít kupon vložte redeem kód, který je %s v průběhu vašeho nákupu připočítán????');

/* ICW Credit class gift voucher end */

//###################################### avs ########################################
define('ENTRY_DATE_OF_BIRTH_ERROR2', ' Jste příliš mladý, musíte být starší ' . MIN_AGE . ' roků věku!');
define('ENTRY_DATE_OF_BIRTH_ERROR3', ' Jste moc starý !');
//###################################### avs ########################################
//jsp:pwa
define('NAVBAR_TITLE_PWA', 'Vyplňte platební a dodací informace');
define('HEADING_TITLE_PWA', 'Platební a dodací informace');


?>