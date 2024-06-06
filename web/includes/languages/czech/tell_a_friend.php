<?php
/*
  $Id: tell_a_friend.php,v 1.7 2003/06/10 18:20:39 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Upozornit přátele');

define('HEADING_TITLE', 'Upozornit přátele na \'%s\'');

define('FORM_TITLE_CUSTOMER_DETAILS', 'Vy');
define('FORM_TITLE_FRIEND_DETAILS', 'Váš přítel');
define('FORM_TITLE_FRIEND_MESSAGE', 'Vzkaz');

define('FORM_FIELD_CUSTOMER_NAME', 'Vaše jméno:');
define('FORM_FIELD_CUSTOMER_EMAIL', 'Vaše e-mailová adresa:');
define('FORM_FIELD_FRIEND_NAME', 'Jméno Vašeho přítele:');
define('FORM_FIELD_FRIEND_EMAIL', 'E-Mail Vašeho přítele:');

define('TEXT_EMAIL_SUCCESSFUL_SENT', 'Váš e-mail byl <span class="b">%s</span> úspěšně odeslán <span class="b">%s</span>.');

define('TEXT_EMAIL_SUBJECT', 'Váš přítel %s doporučil tento produkt od %s');
define('TEXT_EMAIL_INTRO', 'Vážený %s!' . "\n\n" . 'Váš přítel, %s, si myslí, že by Vás mohl zajímat %s na %s.');
define('TEXT_EMAIL_LINK', 'Pro zobrazení zboží klikněte:' . "\n\n" . '%s');
define('TEXT_EMAIL_SIGNATURE', 'Srdečně Vás zdravíme,' . "\n\n" . '%s');

define('ERROR_TO_NAME', 'Chyba: Vyplňte jméno přítele.');
define('ERROR_TO_ADDRESS', 'Chyba: e-mail je neplatný.');
define('ERROR_FROM_NAME', 'Chyba: Prosíme, uveďte své jméno - povinný údaj.');
define('ERROR_FROM_ADDRESS', 'Chyba: vyplňte e-mailovou adresu.');
?>
