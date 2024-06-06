<?php
/*
  $Id: password_forgotten.php,v 1.8 2003/06/09 22:46:46 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce 

  Released under the GNU General Public License 
*/

define('NAVBAR_TITLE_1', 'Entra');
define('NAVBAR_TITLE_2', 'Password dimenticata');

define('HEADING_TITLE', 'Ho dimenticato la mia Password!');

define('TEXT_MAIN', 'Se ti sei dimenticato la password, inserisci il tuo indirizzo e-mail e ti spediremo una mail contenente una nuova password.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Errore: L\' indirizzo e-mail non &egrave; stato trovato nel nostro database, riprova.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - Nuova Password');
define('EMAIL_PASSWORD_REMINDER_BODY', 'La nuova password è stata richiesta da ' . $_SERVER['REMOTE_ADDR'] . '.' . "\n\n" . 'La tua nuova password per \'' . STORE_NAME . '\' è:' . "\n\n" . '   %s' . "\n\n");

define('SUCCESS_PASSWORD_SENT', 'Successo: Nuova password spedita al tuo indirizzo e-mail.');
?>