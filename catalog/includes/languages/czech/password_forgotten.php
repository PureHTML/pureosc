<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2012 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', ' Přihlášení');
define('NAVBAR_TITLE_2', 'Heslo Zapomněli');

define('HEADING_TITLE', 'Zapomněl jsem své heslo !');

define('TEXT_MAIN', 'Pokud jste zapomněli své heslo , zadejte níže svou e - mailovou adresu a my vám bude posílat instrukce, jak bezpečně změnit heslo .');

define('TEXT_PASSWORD_RESET_INITIATED', 'Zkontrolujte prosím Váš e -mail pro instrukce o tom, jak změnit heslo . Pokyny obsahují odkaz, který je platný pouze po dobu 24 hodin nebo dokud heslo bylo aktualizováno.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Chyba :E - mailová adresa nebyla nalezena v našich záznamech , zkuste to prosím znovu .');

define('EMAIL_PASSWORD_RESET_SUBJECT', STORE_NAME . ' -  Nové heslo');
define('EMAIL_PASSWORD_RESET_BODY', 'Bylo požádánoo nové heslo pro váš účet na ' . STORE_NAME . '.' . "\n\n" . 'Prosím, postupujte podle tohoto osobního odkaz bezpečně změnit heslo:' . "\n\n" . '%s' . "\n\n" . 'Tento odkaz bude automaticky vyřazeny po 24 hodinách nebo po provedení změny hesla.' . "\n\n" . 'Pro pomoc s některou z našich on-line služeb, napište store-majitel: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");

define('ERROR_ACTION_RECORDER', 'Chyba: link Password Reset již byla odeslána. Zkuste to prosím znovu za %s minut.');
?>
