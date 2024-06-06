<?php
/*
  $Id: backup.php,v 1.16 2002/03/16 21:30:02 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Zálohování databáze');

define('TABLE_HEADING_TITLE', 'Jméno');
define('TABLE_HEADING_FILE_DATE', 'Datum');
define('TABLE_HEADING_FILE_SIZE', 'Velikost');
define('TABLE_HEADING_ACTION', 'Akce');

define('TEXT_INFO_HEADING_NEW_BACKUP', 'Nová záloha');
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Restore Local');
define('TEXT_INFO_NEW_BACKUP', 'Nepřerušujte proces zálohování.!');
define('TEXT_INFO_UNPACK', '<br /><br />(after unpacking the file from the archive)');
define('TEXT_INFO_RESTORE', 'Nepřerušujte proces obnovy.<br /><br />Velká záloha trvá poměrně dlouho!<br /><br />Záleží také na Vašem mysql klientovi.<br /><br />Například:<br /><br /><b>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </b> %s');
define('TEXT_INFO_RESTORE_LOCAL', 'Nepřerušujte proces obnovy.<br /><br />Velká záloha trvá poměrně dlouho!');
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'Soubor musí být ve formátu raw sql (text).');
define('TEXT_INFO_DATE', 'Datum:');
define('TEXT_INFO_SIZE', 'Velikost:');
define('TEXT_INFO_COMPRESSION', 'Komprese:');
define('TEXT_INFO_USE_GZIP', 'Use GZIP');
define('TEXT_INFO_USE_ZIP', 'Use ZIP');
define('TEXT_INFO_USE_NO_COMPRESSION', 'Bez komprese (čisté SQL)');
define('TEXT_INFO_DOWNLOAD_ONLY', 'Pouze stáhnout (do not store server side)');
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'Nejlepší bude použít HTTPS připojení');
define('TEXT_DELETE_INTRO', 'Smazat tuto zálohu?');
define('TEXT_NO_EXTENSION', 'Neexistuje');
define('TEXT_BACKUP_DIRECTORY', 'Adresář pro zálohu:');
define('TEXT_LAST_RESTORATION', 'Poslední záloha:');
define('TEXT_FORGET', '(<u>přejdi</u>)');

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Error: Adresář neexistuje. Nastavte ho v configure.php.');
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Error: Do tohoto adresáře nelze zapisovat.');
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'Error: link pro download nelze použít.');

define('SUCCESS_LAST_RESTORE_CLEARED', 'V pořádku: místo poslední zálohy je prázdné.');
define('SUCCESS_DATABASE_SAVED', 'V pořádku: databáze uložena.');
define('SUCCESS_DATABASE_RESTORED', 'V pořádku: databáze obnovena.');
define('SUCCESS_BACKUP_DELETED', 'V pořádku: záloha odebrána.');

// prefix table for multi store
define('TEXT_INFO_USE_PREFIX', 'Vybrat pro záloování jen databázi s prefixem ' . DB_PREFIX . ' nebo odeberte pro zálohu všechny.');

?>