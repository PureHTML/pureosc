<?php
/*
  $Id: login.php,v 1.11 2002/06/03 13:19:42 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
  Schließt Beitrag Ein:
  Zugang mit waagerecht ausgerichtetem Konto (v. 2.2a) für den Admin Bereich des osCommerce (MS2)

	Diese Akte kann gelöscht werden, wenn man den oben genannten Beitrag entfernt
*/

define('NAVBAR_TITLE', 'Anmelden');
define('HEADING_TITLE', 'Willkommen. Bitte anmelden');
define('TEXT_STEP_BY_STEP', ''); // should be empty

define('HEADING_RETURNING_ADMIN', 'Anmelde-Pannel');
define('HEADING_PASSWORD_FORGOTTEN', 'Kennwort vergessen:');
define('TEXT_RETURNING_ADMIN', 'Nur f&uuml;r Mitglieder!');
define('ENTRY_EMAIL_ADDRESS', 'Email-Adresse:');
define('ENTRY_PASSWORD', 'Kennwort:');
define('ENTRY_FIRSTNAME', 'Vorname:');
define('IMAGE_BUTTON_LOGIN', 'Absenden');

define('TEXT_PASSWORD_FORGOTTEN', 'Kennwort vergessen?');

define('TEXT_LOGIN_ERROR', '<font color="#ff0000"><b>Achtung:</b></font> Name oder Kennwort falsch!');
define('TEXT_FORGOTTEN_ERROR', '<font color="#ff0000"><b>Achtung:</b></font> Vorname und Kennwort passen nicht zusammen!');
define('TEXT_FORGOTTEN_FAIL', 'Sie haben drei mal versucht, sich anzumelden, bitte treten Sie mit dem Admin in Verbindung, um sich ein neues Passwort geben zu lassen.<br />&nbsp;<br />&nbsp;');
define('TEXT_FORGOTTEN_SUCCESS', 'Ein neues Kennwort ist zu Ihrer Email-Adresse geschickt worden.<br />&nbsp;<br />&nbsp;');

define('ADMIN_EMAIL_SUBJECT', 'Neues Kennwort');
define('ADMIN_EMAIL_TEXT', 'Hallo %s,' . "\n\n" . 'Das Administrator-Pannel kann mit dem folgenden Passwort geöffnet werden. Bitte Passwort sofort ändern!' . "\n\n" . 'Website : %s' . "\n" . 'Username: %s' . "\n" . 'Password: %s' . "\n\n" . 'Danke!' . "\n" . '%s' . "\n\n" . 'Das ist eine automatische Nachricht!, bitte nicht antworten.');
?>
