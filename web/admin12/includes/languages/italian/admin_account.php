<?php
/*
  $Id: admin_members.php,v 1.13 2002/08/19 01:45:58 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Admin Account');

define('TABLE_HEADING_ACCOUNT', 'My Account');

define('TEXT_INFO_FULLNAME', '<b>Nome Intero: </b>');
define('TEXT_INFO_FIRSTNAME', '<b>Nome: </b>');
define('TEXT_INFO_LASTNAME', '<b>Cognome: </b>');
define('TEXT_INFO_EMAIL', '<b>Indirizzo Email: </b>');
define('TEXT_INFO_PASSWORD', '<b>Password: </b>');
define('TEXT_INFO_PASSWORD_HIDDEN', '-NASCOSTO-');
define('TEXT_INFO_PASSWORD_CONFIRM', '<b>Conferma Password: </b>');
define('TEXT_INFO_CREATED', '<b>Account Creato: </b>');
define('TEXT_INFO_LOGDATE', '<b>Ultimo Accesso: </b>');
define('TEXT_INFO_LOGNUM', '<b>Log Numero: </b>');
define('TEXT_INFO_GROUP', '<b>Livello del Gruppo: </b>');
define('TEXT_INFO_ERROR', '<font color="#ff0000">Indirizzo Email gi&agrave; utilizzato! Prego ritenta.</font>');
define('TEXT_INFO_MODIFIED', 'Modificato: ');

define('TEXT_INFO_HEADING_DEFAULT', 'Edita Account ');
define('TEXT_INFO_HEADING_CONFIRM_PASSWORD', 'Conferma Password ');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD', 'Password:');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD_ERROR', '<font color="#ff0000"><b>ERROR:</b> Password Sbagliata !</font>');
define('TEXT_INFO_INTRO_DEFAULT', 'Click <b>MODIFICA</b> se desideri modificare il tuo Account.');
define('TEXT_INFO_INTRO_DEFAULT_FIRST_TIME', '<br /><b>ATTENZIONE:</b><br />Benvenuto <b>%s</b>, questa &egrave; la vostra prima visita. Vi raccomandiamo di cambiare la vostra password !');
define('TEXT_INFO_INTRO_DEFAULT_FIRST', '<br /><b>ATTENZIONE:</b><br />Benvenuto <b>%s</b>, vi raccomandiamo di cambiare la vostra email (<font color="#ff0000">admin@localhost</font>) e la password !');
define('TEXT_INFO_INTRO_EDIT_PROCESS', 'Tutti i campi vanno riempiti. Click salva per proseguire.');

define('JS_ALERT_FIRSTNAME',        '- Richiesto: Nome \n');
define('JS_ALERT_LASTNAME',         '- Richiesto: Cognome \n');
define('JS_ALERT_EMAIL',            '- Richiesto: Indirizzo Email \n');
define('JS_ALERT_PASSWORD',         '- Richiesto: Password \n');
define('JS_ALERT_FIRSTNAME_LENGTH', '- Lunghezza minima Nome almeno ');
define('JS_ALERT_LASTNAME_LENGTH',  '- Lunghezza minima Cognome almeno ');
define('JS_ALERT_PASSWORD_LENGTH',  '- Lunghezza minima Password almeno ');
define('JS_ALERT_EMAIL_FORMAT',     '- Indirizzo Email invalido ! \n');
define('JS_ALERT_EMAIL_USED',       '- Indirizzo Email gi&agrave; usato! \n');
define('JS_ALERT_PASSWORD_CONFIRM', '- Inserisci dinuovo la Password di conferma ! \n');

define('ADMIN_EMAIL_SUBJECT', 'Informazioni Personali Canbiate');
define('ADMIN_EMAIL_TEXT', 'Salve %s,' . "\n\n" . 'Le tue informazioni personali, compresa la tua password, sono state cambiate con successo.  Se non hai richiesto queste modifiche contatta immediatamente l\'amministratore del sito !' . "\n\n" . 'Website : %s' . "\n" . 'Username: %s' . "\n" . 'Password: %s' . "\n\n" . 'Grazie !' . "\n" . '%s' . "\n\n" . 'Questa e\' una email automatica, siete pregati di non rispondere !'); 
?>
