<?php
/*
  $Id: login.php,v 1.11 2002/06/03 13:19:42 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  define('NAVBAR_TITLE', 'Login');
  define('HEADING_TITLE', 'Benvenuto, registrati');
  define('TEXT_STEP_BY_STEP', ''); // should be empty

define('HEADING_RETURNING_ADMIN', 'Pannello di accesso :');
define('HEADING_PASSWORD_FORGOTTEN', 'Password persa:');
define('TEXT_RETURNING_ADMIN', 'Staff only!');
define('ENTRY_EMAIL_ADDRESS', 'Indirizzo E-Mail :');
define('ENTRY_PASSWORD', 'Password:');
define('ENTRY_FIRSTNAME', 'Nome:');
define('IMAGE_BUTTON_LOGIN', 'Invio');

define('TEXT_PASSWORD_FORGOTTEN', 'Hai perso la password ?');

define('TEXT_LOGIN_ERROR', '<font color="#ff0000"><b>ERRORE:</b></font>  user o password sbagliati!');
define('TEXT_FORGOTTEN_ERROR', '<font color="#ff0000"><b>ERRORE:</b></font> nome e password non combinano!');
define('TEXT_FORGOTTEN_FAIL', 'Hai provato tre volte. Per ragioni di sicurezza contatta il tuo Amministratore Web per avere una nuova password.<br />&nbsp;<br />&nbsp;');
define('TEXT_FORGOTTEN_SUCCESS', 'La nuova password &egrave; stata inviata al tuo indirizzo email. Controlla la tua email e prova nuovamente.<br />&nbsp;<br />&nbsp;');

define('ADMIN_EMAIL_SUBJECT', 'Nuova Password'); 
define('ADMIN_EMAIL_TEXT', 'Hi %s,' . "\n\n" . 'Hai accesso al pannello di amministrazione con la seguente password. Quando accederai al pannello di amministrazione cambia immediatamente la tua password!' . "\n\n" . 'Website : %s' . "\n" . 'Username: %s' . "\n" . 'Password: %s' . "\n\n" . 'Grazie!' . "\n" . '%s' . "\n\n" . 'Questa &egrave; una risposta automatica: non replicare!'); 
?>
