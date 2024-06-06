<?php
/*
  $Id: banner_manager.php,v 1.17 2002/08/18 18:54:47 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Bannerová reklama');

define('TABLE_HEADING_BANNERS', 'Bannery');
define('TABLE_HEADING_GROUPS', 'Skupiny');
define('TABLE_HEADING_STATISTICS', 'Zobrazeno / Kliknutí');
define('TABLE_HEADING_STATUS', 'Stav');
define('TABLE_HEADING_ACTION', 'Akce');

define('TEXT_BANNERS_TITLE', 'Název banneru:');
define('TEXT_BANNERS_URL', 'URL adresa banneru:');
define('TEXT_BANNERS_GROUP', 'Skupina bannerů:');
define('TEXT_BANNERS_NEW_GROUP', ', nebo vytvořit novou skupinu níže');
define('TEXT_BANNERS_IMAGE', 'Obrázek:');
define('TEXT_BANNERS_IMAGE_LOCAL', ', nebo vyber soubor');
define('TEXT_BANNERS_IMAGE_TARGET', 'Cílový soubor (uložit):');
define('TEXT_BANNERS_HTML_TEXT', 'HTML Text:');
define('TEXT_BANNERS_EXPIRES_ON', 'Vyprší:');
define('TEXT_BANNERS_OR_AT', ', nebo za');
define('TEXT_BANNERS_IMPRESSIONS', 'impressí/zobrazení.');
define('TEXT_BANNERS_SCHEDULED_AT', 'Spustit:');
define('TEXT_BANNERS_BANNER_NOTE', '<b>Banner:</b><ul><li>Vložte alternativní popis v HTML.</li><li>HTML text má přednost před obrázkem!</li></ul>');
define('TEXT_BANNERS_INSERT_NOTE', '<b>Obrázek:</b><ul><li>Adresář musí mít práva pro zápis!</li><li>Lépe používat absolutní cestu \'Sav[M h-e To\' pokud soubor není uploadován na webserver (ie, you are using a local (serverside) image).</li><li>The \'Save To\' field must be an existing directory with an ending slash (eg, banners/).</li></ul>');
define('TEXT_BANNERS_EXPIRCY_NOTE', '<b>Expiry Notes:</b><ul><li>jen jeden z dvou souborů může být odeslán</li><li>If the banner is not to expire automatically, then leave these fields blank</li></ul>');
define('TEXT_BANNERS_SCHEDULE_NOTE', '<b>Schedule Notes:</b><ul><li>If a schedule is set, the banner will be activated on that date.</li><li>Všechny připravené banery jsou označeny jako neaktivní před vlastním spuštěním, dokud nebudou označeny jako aktivní.</li></ul>');

define('TEXT_BANNERS_DATE_ADDED', 'Přidáno:');
define('TEXT_BANNERS_SCHEDULED_AT_DATE', 'Spuštěno: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_DATE', 'Vyprší: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', 'Vyprší za: <b>%s</b> impresí');
define('TEXT_BANNERS_STATUS_CHANGE', 'Status změněn: %s');

define('TEXT_BANNERS_DATA', 'D<br />A<br />T<br />A');
define('TEXT_BANNERS_LAST_3_DAYS', 'Poslední 3 dny');
define('TEXT_BANNERS_BANNER_VIEWS', 'Zobrazeno');
define('TEXT_BANNERS_BANNER_CLICKS', 'Kliků');

define('TEXT_INFO_DELETE_INTRO', 'Chcete smazat tento banner?');
define('TEXT_INFO_DELETE_IMAGE', 'Smazat obrázek');

define('SUCCESS_BANNER_INSERTED', 'V pořádku: banner přidán.');
define('SUCCESS_BANNER_UPDATED', 'V pořádku: banner upraven.');
define('SUCCESS_BANNER_REMOVED', 'V pořádku: banner odebrán.');
define('SUCCESS_BANNER_STATUS_UPDATED', 'V pořádku: status banneru upraven.');

define('ERROR_BANNER_TITLE_REQUIRED', 'Error: chybí název banneru.');
define('ERROR_BANNER_GROUP_REQUIRED', 'Error: chybí název skupiny.');
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Error: Cílový adesář neexistuje: %s');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Error: Do adresáře nelze zapisovat: %s');
define('ERROR_IMAGE_DOES_NOT_EXIST', 'Error: Obrázek neexistuje.');
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Error: obrázek nelze smazat.');
define('ERROR_UNKNOWN_STATUS_FLAG', 'Error: neznámá chyba.');

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'Error: Adresář pro grafy neexistuje. Prosím vytvořte \'graphs\' adresář v \'images\'.');
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'Chyba: Adresář pro grafy nemá práva zápisu.');
?>