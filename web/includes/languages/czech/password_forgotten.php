<?php
/*
  $Id: password_forgotten.php,v 1.8 2003/06/09 22:46:46 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Přihlášení');
define('NAVBAR_TITLE_2', 'Zapomenuté heslo');

define('HEADING_TITLE', 'Zapomněl jsem své heslo!');

define('TEXT_MAIN', 'Zapoměli jste heslo? Vložte svou e-mailovou adresu, kterou jste zadali při registraci a my Vám pošleme nové.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Chyba: Toto není platná e-mailová adresa, vložte znovu.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - Nové heslo');
// >>> BEGIN REGISTER_GLOBALS
define('EMAIL_PASSWORD_REMINDER_BODY', 'Heslo bylo vyžádáno z ' . $_SERVER['REMOTE_ADDR'] . '.' . "\n\n" . 'Vaše nové heslo pro \'' . STORE_NAME . '\' je:' . "\n\n" . '   %s' . "\n\n");
// <<< END REGISTER_GLOBALS

define('SUCCESS_PASSWORD_SENT', 'Hotovo: Nové heslo bylo zasláno na Váš e-mail.');
?>