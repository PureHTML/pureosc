<?php
/*
  $Id: admin_categories.php,v 1.13 2002/08/19 01:45:58 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Admin "Boxes" Menu');

define('TABLE_HEADING_ACTION', 'Azione');
define('TABLE_HEADING_BOXES', 'Boxes');
define('TABLE_HEADING_FILENAME', 'Filenames');
define('TABLE_HEADING_GROUPS', 'Gruppi');
define('TABLE_HEADING_STATUS', 'Stato');

define('TEXT_COUNT_BOXES', 'Boxes: ');
define('TEXT_COUNT_FILES', 'File(s): ');

//categories access
define('TEXT_INFO_HEADING_DEFAULT_BOXES', 'Boxes: ');

define('TEXT_INFO_DEFAULT_BOXES_INTRO', 'clicca il pulsante VERDE per INSTALLARE il box o il pulsante ROSSO per DISINSTALLARE.<br /><br />ATTENZIONE: se disinstalli un box, TUTTI i files che contiene saranno RIMOSSI!');
define('TEXT_INFO_DEFAULT_BOXES_INSTALLED', ' installato');
define('TEXT_INFO_DEFAULT_BOXES_NOT_INSTALLED', ' non installato');

define('STATUS_BOX_INSTALLED', 'Installato');
define('STATUS_BOX_NOT_INSTALLED', 'Non Installato');
define('STATUS_BOX_REMOVE', 'Rimuovi');
define('STATUS_BOX_INSTALL', 'Installa');

//files access
define('TEXT_INFO_HEADING_DEFAULT_FILE', 'File: ');
define('TEXT_INFO_HEADING_DELETE_FILE', 'Conferma Rimozione');
define('TEXT_INFO_HEADING_NEW_FILE', 'File Contenuti');

define('TEXT_INFO_DEFAULT_FILE_INTRO', 'Clicca il pulsante<b>store files</b>  per inserire nuovi file nel box corrente: ');
define('TEXT_INFO_DELETE_FILE_INTRO', 'Rimuovi <font color="#ff0000"><b>%s</b></font> dal <b>%s</b> box? ');
define('TEXT_INFO_NEW_FILE_INTRO', 'Controlla il <font color="#ff0000"><b> menu sinistro</b></font> per essere sicuro di salvare i files giusti.');

define('TEXT_INFO_NEW_FILE_BOX', 'Box corrente: ');

?>
