<?php
/*
  $Id: backup.php,v 1.1 2006/09/26 18:05:19 j4k Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Gestionnaire de sauvegarde de la base de donn&eacute;es');

define('TABLE_HEADING_TITLE', 'Titre');
define('TABLE_HEADING_FILE_DATE', 'Date');
define('TABLE_HEADING_FILE_SIZE', 'Taille');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_INFO_HEADING_NEW_BACKUP', 'Nouvelle sauvegarde');
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Restaurer localement');
define('TEXT_INFO_NEW_BACKUP', 'N\'interrompez pas le processus de sauvegarde. Celui-ci peut durer quelques minutes');
define('TEXT_INFO_UNPACK', '<br /><br />(apr&egrave;s extraction des fichiers de l\'archive)');
define('TEXT_INFO_RESTORE', 'Ne pas interrompre le processus de restauration.<br /><br />Plus le fichier est grand, plus cela prendra du temps!<br /><br />Si possible, utilisez un client Mysql.<br /><br />Par exemple :<br /><br /><b>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </b> %s');
define('TEXT_INFO_RESTORE_LOCAL', 'Ne pas interrompre le processus de restauration.<br /><br />Plus le fichier est grand, plus cela prendra du temps!');
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'Le fichier transf&eacute;r&eacute; doit &ecirc;tre au format SQL brut (texte).');
define('TEXT_INFO_DATE', 'Date :');
define('TEXT_INFO_SIZE', 'Taille :');
define('TEXT_INFO_COMPRESSION', 'Compression :');
define('TEXT_INFO_USE_GZIP', 'Utiliser GZIP');
define('TEXT_INFO_USE_ZIP', 'Utiliser ZIP');
define('TEXT_INFO_USE_NO_COMPRESSION', 'Pas de compression (Pur SQL)');
define('TEXT_INFO_DOWNLOAD_ONLY', 'T&eacute;l&eacute;charger seulement (ne pas le stocker côt&eacute; serveur)');
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'Le meilleur serait le cas d\'une connexion HTTPS');
define('TEXT_DELETE_INTRO', 'Etes vous sur de vouloir supprimer cette sauvegarde ?');
define('TEXT_NO_EXTENSION', 'Aucune');
define('TEXT_BACKUP_DIRECTORY', 'R&eacute;pertoire de sauvegarde :');
define('TEXT_LAST_RESTORATION', 'Derni&egrave;re restauration :');
define('TEXT_FORGET', '(<u>oubli&eacute;</u>)');

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Erreur : Le r&eacute;pertoire de sauvegarde n\'existe pas. Merci de le pr&eacute;ciser dans le fichier configure.php.');
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Erreur : Impossible d\'&eacute;crire dans le r&eacute;pertoire de sauvegarde.');
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'Erreur : Lien de t&eacute;l&eacute;chargement non disponible.');

define('SUCCESS_LAST_RESTORE_CLEARED', 'Succ&egrave;s : La date de derniere restauration est modifi&eacute;e.');
define('SUCCESS_DATABASE_SAVED', 'Succ&egrave;s : La base de donn&eacute;es a &eacute;t&eacute; sauv&eacute;e.');
define('SUCCESS_DATABASE_RESTORED', 'Succ&egrave;s : La base de donn&eacute;es a &eacute;t&eacute; restaur&eacute;.');
define('SUCCESS_BACKUP_DELETED', 'Success : La base de donn&eacute;es a &eacute;t&eacute; supprim&eacute;.');

// prefix table for multi store
define('TEXT_INFO_USE_PREFIX', 'Select for Backup only DB with the prefix ' . DB_PREFIX . ' or deselect for Backup all DB.');

?>