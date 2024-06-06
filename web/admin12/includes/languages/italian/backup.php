<?php
/*
  $Id: backup.php,v 1.16 2002/03/16 21:30:02 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce 

  Released under the GNU General Public License 
*/

define('HEADING_TITLE', 'Database Backup Manager');

define('TABLE_HEADING_TITLE', 'Titolo');
define('TABLE_HEADING_FILE_DATE', 'Data');
define('TABLE_HEADING_FILE_SIZE', 'Dimensione');
define('TABLE_HEADING_ACTION', 'Azione');

define('TEXT_INFO_HEADING_NEW_BACKUP', 'Nuovo Salvataggio');
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Ripristina Locale');
define('TEXT_INFO_NEW_BACKUP', 'Non interrompere il processo di salvataggio, potrebbe durare diversi minuti.');
define('TEXT_INFO_UNPACK', '<br /><br />(dopo aver scompattato il file dall\' archivio)');
define('TEXT_INFO_RESTORE', 'Non interrompere il processo di ripristino.<br /><br />La durata del processo dipende dalla grandezza del Database!<br /><br />Se possibile usa un client Mysql.<br /><br />Per esempio:<br /><br /><b>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </b> %s');
define('TEXT_INFO_RESTORE_LOCAL', 'Non interrompere il processo di ripristino.<br /><br />La durata del processo dipende dalla grandezza del Database!<');
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'Il file importato deve essere un file.sql!');
define('TEXT_INFO_DATE', 'Data:');
define('TEXT_INFO_SIZE', 'Dimensione:');
define('TEXT_INFO_COMPRESSION', 'Compressione:');
define('TEXT_INFO_USE_GZIP', 'Usa GZIP');
define('TEXT_INFO_USE_ZIP', 'Usa ZIP');
define('TEXT_INFO_USE_NO_COMPRESSION', 'Non Compresso (solo SQL)');
define('TEXT_INFO_DOWNLOAD_ONLY', 'Solo Download (non depositare lato server)');
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'Meglio tramite connessione HTTPS');
define('TEXT_DELETE_INTRO', 'Sicuro di voler cancellare questo salvataggio?');
define('TEXT_NO_EXTENSION', 'Nessuna');
define('TEXT_BACKUP_DIRECTORY', 'Directory di salvataggio:');
define('TEXT_LAST_RESTORATION', 'Ultimo Ripristino:');
define('TEXT_FORGET', '(<u>dimenticare</u>)');

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Errore: La Directory di salvataggio non esiste. Imposta i parametri in configure.php.');
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Errore: La Directory di salvataggio non &egrave; scrivibile.');
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'Errore: Il Link del Download non &egrave; accettabile.');

define('SUCCESS_LAST_RESTORE_CLEARED', 'Operazione riuscita: L\'ultima data di ripristino &egrave; stata eliminata\'.');
define('SUCCESS_DATABASE_SAVED', 'Operazione riuscita: Il Database &egrave; stato salvato.');
define('SUCCESS_DATABASE_RESTORED', 'Operazione riuscita: Il Database &egrave; stato ripristinato.');
define('SUCCESS_BACKUP_DELETED', 'Operazione riuscita: Il File di salvataggio &egrave; stato rimosso.');

// prefix table for multi store
define('TEXT_INFO_USE_PREFIX', 'Seleziona per fare il Backup del Vostro BD con il seguente prefisso ' . DB_PREFIX . ', oppure deseleziona per fare il Backup di tutto il DB.');

?>