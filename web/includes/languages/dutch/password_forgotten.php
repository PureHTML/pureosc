<?php
/*
  $Id: password_forgotten.php,v 1.6 2002/11/19 01:48:08 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Login');
define('NAVBAR_TITLE_2', 'Wachtwoord vergeten');

define('HEADING_TITLE', 'Ik ben mijn wachtwoord vergeten! HELP!');

define('TEXT_MAIN', 'If you\'ve forgotten your password, enter your e-mail address below and we\'ll send you an e-mail message containing your new password.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', '<span class="ColorSpanRed"><span class="b">Let op:</span></span> Het e-mail is niet in onze database gevonden. Probeer het opnieuw');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - Nieuw wachtwoord');
define('EMAIL_PASSWORD_REMINDER_BODY', 'Het nieuwe wachtwoord was aangevraagd via IP-adres ' . $_SERVER['REMOTE_ADDR'] . '.' . "\n\n" . 'Uw nieuwe wachtwoord voor toegang tot \'' . STORE_NAME . '\' is:' . "\n\n" . '   %s' . "\n\n");

define('SUCCESS_PASSWORD_SENT', 'Success: A new password has been sent to your e-mail address.');
?>