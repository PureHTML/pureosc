<?php
/*
  $Id: admin_categories.php,v 1.13 2002/08/19 01:45:58 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
  Schließt Beitrag Ein:
  Zugang mit waagerecht ausgerichtetem Konto (v. 2.2a) für den Admin Bereich des osCommerce (MS2)

	Diese Akte kann gelöscht werden, wenn man den oben genannten Beitrag entfernt
*/

define('HEADING_TITLE', 'Administrator: Datei-Rechte');

define('TABLE_HEADING_ACTION', 'T&auml;tigkeit');
define('TABLE_HEADING_BOXES', 'Ordner');
define('TABLE_HEADING_FILENAME', 'Dateinamen');
define('TABLE_HEADING_GROUPS', 'Gruppen');
define('TABLE_HEADING_STATUS', 'Status');

define('TEXT_COUNT_BOXES', 'Otrdner: ');
define('TEXT_COUNT_FILES', 'Datei(en): ');

//categories access
define('TEXT_INFO_HEADING_DEFAULT_BOXES', 'Ordner: ');

define('TEXT_INFO_DEFAULT_BOXES_INTRO', 'Klicken Sie einfach die gr&uuml;ne oder die rote Taste um den Status zu ändern.<br /><br /><b>Warnung:</b> Wenn Sie einen Ornder l&ouml;schen, werden alle darin enthaltenen Dateien gel&ouml;scht!');
define('TEXT_INFO_DEFAULT_BOXES_INSTALLED', ' installiert');
define('TEXT_INFO_DEFAULT_BOXES_NOT_INSTALLED', ' nicht installiert');

define('STATUS_BOX_INSTALLED', 'Installiert');
define('STATUS_BOX_NOT_INSTALLED', 'Nicht Installiert');
define('STATUS_BOX_REMOVE', 'Entfernen');
define('STATUS_BOX_INSTALL', 'Installieren');

//files access
define('TEXT_INFO_HEADING_DEFAULT_FILE', 'Datei: ');
define('TEXT_INFO_HEADING_DELETE_FILE', 'Entfernen der Datei');
define('TEXT_INFO_HEADING_NEW_FILE', 'Speichern der Datei');

define('TEXT_INFO_DEFAULT_FILE_INTRO', 'Neue Datei in diesem Ordner einf&uuml;gen: ');
define('TEXT_INFO_DELETE_FILE_INTRO', ' <font color="red"><b>%s</b></font> von <b>%s</b> Ordner entfernen? ');
define('TEXT_INFO_NEW_FILE_INTRO', '&Uuml;berpr&uuml;fen Sie die Auswahl um sicherzustellen, daß Sie die richtige Datei &auml;ndern.');

define('TEXT_INFO_NEW_FILE_BOX', 'Aktueller Ordner: ');

?>
