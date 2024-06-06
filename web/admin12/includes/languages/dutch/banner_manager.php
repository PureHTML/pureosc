<?php
/*
  $Id: banner_manager.php,v 1.17 2002/08/18 18:54:47 hpdl Exp $

  DUTCH TRANSLATION
  - V2.2 ms1: Author: Joost Billiet   Date: 06/18/2003   Mail: joost@jbpc.be
  - V2.2 ms2: Update: Martijn Loots   Date: 08/01/2003   Mail: oscommerce@cosix.com

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Banner Manager');

define('TABLE_HEADING_BANNERS', 'Banners');
define('TABLE_HEADING_GROUPS', 'Groepen');
define('TABLE_HEADING_STATISTICS', 'Bekeken / Geklikt');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Actie');

define('TEXT_BANNERS_TITLE', 'Banner Titel:');
define('TEXT_BANNERS_URL', 'Banner URL:');
define('TEXT_BANNERS_GROUP', 'Banner Groep:');
define('TEXT_BANNERS_NEW_GROUP', ', of maak hieronder een nieuwe groep');
define('TEXT_BANNERS_IMAGE', 'Plaatje:');
define('TEXT_BANNERS_IMAGE_LOCAL', ', of vul hieronder een lokaal bestand in');
define('TEXT_BANNERS_IMAGE_TARGET', 'Plaatje Bestemming (Opslaan als):');
define('TEXT_BANNERS_HTML_TEXT', 'HTML Tekst:');
define('TEXT_BANNERS_EXPIRES_ON', 'Verloopt Op:');
define('TEXT_BANNERS_OR_AT', ', of op');
define('TEXT_BANNERS_IMPRESSIONS', 'impressies/overzichten.');
define('TEXT_BANNERS_SCHEDULED_AT', 'Gepland op:');
define('TEXT_BANNERS_BANNER_NOTE', '<b>N.B. Banners:</b><ul><li>Gebruik een plaatje of een HTML tekst voor de banner - niet beide.</li><li>HTML Tekst heeft de hoogste prioriteit</li></ul>');
define('TEXT_BANNERS_INSERT_NOTE', '<b>N.B. Plaatjes:</b><ul><li>De te uploaden directory\'s hebben de juiste permissie\'s nodig!</li><li>Vul het \'Opslaan Als\' veld niet in als je geen plaatje gaat uploaden naar de server (bijv. als je een serverside foto gebruikt).</li><li>Het \'Opslaan Als\' veld moet een bestaande directory zijn en eindigen op een (bijv. banners/).</li></ul>');
define('TEXT_BANNERS_EXPIRCY_NOTE', '<b>N.B. Verloopdata:</b><ul><li>Slechts &eacute;&eacute;n van de 2 velden mag worden ingevuld</li><li>Laat de velden leeg als de banner niet automatisch mag vervallen</li></ul>');
define('TEXT_BANNERS_SCHEDULE_NOTE', '<b>N.B. Planning:</b><ul><li>Als een datum is gepland zal de banner actief worden op die datum.</li><li>Die banners zijn allemaal aangeduid als niet actief, ze zullen automatisch op actief worden gezet op de geplande datum.</li></ul>');

define('TEXT_BANNERS_DATE_ADDED', 'Datum Toegevoegd:');
define('TEXT_BANNERS_SCHEDULED_AT_DATE', 'Gepland Op: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_DATE', 'Verloopt Op: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', 'Verloopt na: <b>%s</b> impressies');
define('TEXT_BANNERS_STATUS_CHANGE', 'Status Veranderd: %s');

define('TEXT_BANNERS_DATA', 'D<br />A<br />T<br />A');
define('TEXT_BANNERS_LAST_3_DAYS', 'Laatste 3 Dagen');
define('TEXT_BANNERS_BANNER_VIEWS', 'Banner Overzichten');
define('TEXT_BANNERS_BANNER_CLICKS', 'Banner Kliks');

define('TEXT_INFO_DELETE_INTRO', 'Weet je zeker dat je de banner wil verwijderen');
define('TEXT_INFO_DELETE_IMAGE', 'Verwijder banner plaatje');

define('SUCCESS_BANNER_INSERTED', 'Success: De banner is ingevoegd.');
define('SUCCESS_BANNER_UPDATED', 'Success: De banner is geupdate.');
define('SUCCESS_BANNER_REMOVED', 'Success: De banner is verwijderd.');
define('SUCCESS_BANNER_STATUS_UPDATED', 'Success: De status van de banner is geupdate.');

define('ERROR_BANNER_TITLE_REQUIRED', 'Fout: Banner titel vereist.');
define('ERROR_BANNER_GROUP_REQUIRED', 'Fout: Banner groep vereist');
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Fout: Bestemmingsdirectory bestaat niet: %s');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Fout: Bestemmingsdirectory niet beschrijfbaar: %s');
define('ERROR_IMAGE_DOES_NOT_EXIST', 'Fout: Plaatje bestaat niet.');
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Fout: Plaatje kan niet worden verwijderd.');
define('ERROR_UNKNOWN_STATUS_FLAG', 'Fout: Onbekende status.');

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'Fout: Graphs directory bestaat niet, maak een \'graphs\' directory aan in \'images\'.');
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'Fout: Graphs directory is niet schrijfbaar.');
?>
