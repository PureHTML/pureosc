<?php
/*
  $Id: backup.php,v 1.16 2002/03/16 21:30:02 hpdl Exp $

  DUTCH TRANSLATION
  - V2.2 ms1: Author: Joost Billiet   Date: 06/18/2003   Mail: joost@jbpc.be
  - V2.2 ms2: Update: Martijn Loots   Date: 08/01/2003   Mail: oscommerce@cosix.com

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Database Backup Manager');

define('TABLE_HEADING_TITLE', 'Titel');
define('TABLE_HEADING_FILE_DATE', 'Datum');
define('TABLE_HEADING_FILE_SIZE', 'Grootte');
define('TABLE_HEADING_ACTION', 'Actie');

define('TEXT_INFO_HEADING_NEW_BACKUP', 'Nieuwe Backup');
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Restore Lokaal');
define('TEXT_INFO_NEW_BACKUP', 'Gelieve het backup proces niet te onderbreken, dit kan enkele minuten duren.');
define('TEXT_INFO_UNPACK', '<br /><br />(na het uitpakken van de file uit het archief)');
define('TEXT_INFO_RESTORE', 'Gelieve het restoreproces niet te onderbreken.<br /><br />Hoe groter de backup, hoe langer dit kan duren!<br /><br />Indien mogelijk, gebruik mysql client.<br /><br />Bijvoorbeeld:<br /><br /><b>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </b> %s');
define('TEXT_INFO_RESTORE_LOCAL', 'Gelieve het lokale restoreproces niet te onderbreken.<br /><br />Hoe groter de backup, hoe langer dit duurt!');
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'De geuploade file moet een RAW SQL(tekst) bestand zijn.');
define('TEXT_INFO_DATE', 'Datum:');
define('TEXT_INFO_SIZE', 'Grootte:');
define('TEXT_INFO_COMPRESSION', 'Compressie:');
define('TEXT_INFO_USE_GZIP', 'Gebruik GZIP');
define('TEXT_INFO_USE_ZIP', 'Gebruik ZIP');
define('TEXT_INFO_USE_NO_COMPRESSION', 'Geen Compressie (Pure SQL)');
define('TEXT_INFO_DOWNLOAD_ONLY', 'Alleen Downloaden (Server Side niet opslaan)');
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'Liefst via een veilige HTTPS verbinding');
define('TEXT_DELETE_INTRO', 'Bent u zeker dat u deze backup wilt verwijderen?');
define('TEXT_NO_EXTENSION', 'Niets');
define('TEXT_BACKUP_DIRECTORY', 'Backup Directory:');
define('TEXT_LAST_RESTORATION', 'Laatste Restore:');
define('TEXT_FORGET', '(<u>vergeten</u>)');

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Fout: Backup directory bestaat niet. Pas dit aan in configure.php.');
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Fout: Kan niet schrijven naar backup directory.');
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'Fout: Download link niet aanvaardbaar.');

define('SUCCESS_LAST_RESTORE_CLEARED', 'Succes: De datum van de laatste restore is gewist.');
define('SUCCESS_DATABASE_SAVED', 'Succes: De database is opgeslagen.');
define('SUCCESS_DATABASE_RESTORED', 'Succes: De database restore is uitgevoerd.');
define('SUCCESS_BACKUP_DELETED', 'Succes: De backup is verwijderd.');

// prefix table for multi store
define('TEXT_INFO_USE_PREFIX', 'Select for Backup only DB with the prefix ' . DB_PREFIX . ' or deselect for Backup all DB.');

?>
