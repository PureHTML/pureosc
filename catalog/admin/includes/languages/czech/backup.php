<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'zálohování databáze správce');

define('TABLE_HEADING_TITLE', 'Název');
define('TABLE_HEADING_FILE_DATE', 'Datum');
define('TABLE_HEADING_FILE_SIZE', 'Velikost');
define('TABLE_HEADING_ACTION', 'Proveď');

define('TEXT_INFO_HEADING_NEW_BACKUP', 'Nové zálohování');
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Renovace Localu');
define('TEXT_INFO_NEW_BACKUP', 'Nepřerušujte proces zálohování, které může trvat několik minut.');
define('TEXT_INFO_UNPACK', '<br><br>(Po rozbalení souboru z archivu)');
define('TEXT_INFO_RESTORE', 'Nepřerušujte proces obnovy.<br><br>Větší záloha, tento proces trvá déle!<br><br>Pokud je to možné, použít mysql klienta.<br><br>Například:<br><br><b>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </b> %s');
define('TEXT_INFO_RESTORE_LOCAL', 'Nepřerušujte proces obnovy.<br><br>Větší zálohy, déle tento proces trvá!');
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'Soubor nahrán musí být raw sql soubor (text).');
define('TEXT_INFO_DATE', 'Datum:');
define('TEXT_INFO_SIZE', 'Velikost:');
define('TEXT_INFO_COMPRESSION', 'Komprese:');
define('TEXT_INFO_USE_GZIP', 'Use GZIP');
define('TEXT_INFO_USE_ZIP', 'Use ZIP');
define('TEXT_INFO_USE_NO_COMPRESSION', 'Bez komprese (pouze SQL)');
define('TEXT_INFO_DOWNLOAD_ONLY', 'Pouze stáhni (neukládej na server)');
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'Nejlepší pomocí připojení HTTPS');
define('TEXT_DELETE_INTRO', 'Jste si jisti, že chcete odstranit tuto zálohu?');
define('TEXT_NO_EXTENSION', 'Ne');
define('TEXT_BACKUP_DIRECTORY', 'Zálohování uloženo do:');
define('TEXT_LAST_RESTORATION', 'Poslední renovace:');
define('TEXT_FORGET', '(<u>zapomenout</u>)');

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Chyba: Záložní adresář neexistuje. Prosím nastavte to v configure.php.');
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Chyba: Záložní adresář není zapisovatelný.');
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'Chyba: Odkaz ke stažení nepřijatelné.');

define('SUCCESS_LAST_RESTORE_CLEARED', 'Úspěch: datum posledního restaurování byl vymazán.');
define('SUCCESS_DATABASE_SAVED', 'Úspěch: Databáze byla uložena.');
define('SUCCESS_DATABASE_RESTORED', 'Úspěch: Databáze byla obnovena.');
define('SUCCESS_BACKUP_DELETED', 'Úspěch: backup odstranil.');
?>
