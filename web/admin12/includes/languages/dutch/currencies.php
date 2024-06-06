<?php
/*
  $Id: currencies.php,v 1.12 2003/06/25 20:36:48 hpdl Exp $

  DUTCH TRANSLATION
  - V2.2 ms1: Author: Joost Billiet   Date: 06/18/2003   Mail: joost@jbpc.be
  - V2.2 ms2: Update: Martijn Loots   Date: 08/01/2003   Mail: oscommerce@cosix.com

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Valuta\'s');

define('TABLE_HEADING_CURRENCY_NAME', 'Valuta');
define('TABLE_HEADING_CURRENCY_CODES', 'Code');
define('TABLE_HEADING_CURRENCY_VALUE', 'Waarde');
define('TABLE_HEADING_ACTION', 'Actie');

define('TEXT_INFO_EDIT_INTRO', 'Gelieve de nodige wijzigingen te maken');
define('TEXT_INFO_CURRENCY_TITLE', 'Titel:');
define('TEXT_INFO_CURRENCY_CODE', 'Code:');
define('TEXT_INFO_CURRENCY_SYMBOL_LEFT', 'Symbool Links:');
define('TEXT_INFO_CURRENCY_SYMBOL_RIGHT', 'Symbool Rechts:');
define('TEXT_INFO_CURRENCY_DECIMAL_POINT', 'Decimaalteken:');
define('TEXT_INFO_CURRENCY_THOUSANDS_POINT', 'Scheidinsteken Duizendtallen:');
define('TEXT_INFO_CURRENCY_DECIMAL_PLACES', 'Decimalen:');
define('TEXT_INFO_CURRENCY_LAST_UPDATED', 'Laatste Update:');
define('TEXT_INFO_CURRENCY_VALUE', 'Waarde:');
define('TEXT_INFO_CURRENCY_EXAMPLE', 'Voorbeeld Output:');
define('TEXT_INFO_INSERT_INTRO', 'Gelieve de nieuwe valuta met bijbehorende data in te geven');
define('TEXT_INFO_DELETE_INTRO', 'Weet je zeker dat je deze valuta wil wissen?');
define('TEXT_INFO_HEADING_NEW_CURRENCY', 'Nieuwe Valuta');
define('TEXT_INFO_HEADING_EDIT_CURRENCY', 'Wijzig Valuta');
define('TEXT_INFO_HEADING_DELETE_CURRENCY', 'Verwijder Valuta');
define('TEXT_INFO_SET_AS_DEFAULT', TEXT_SET_DEFAULT . ' (Vereist een handmatige aanpassing van de wisselkoersen)');
define('TEXT_INFO_CURRENCY_UPDATED', 'De wisselkoers voor %s (%s) is succesvol aangepast via %s.');

define('ERROR_REMOVE_DEFAULT_CURRENCY', 'Fout: de default valuta kan niet worden verwijderd, stel een andere valuta als standaard in en probeer opnieuw.');
define('ERROR_CURRENCY_INVALID', 'Fout: De wisselkoers voor %s (%s) is niet aangepast via %s. Is het een correcte valuta code?');
define('WARNING_PRIMARY_SERVER_FAILED', 'Waarschuwing: De primaire wisselkoers server (%s) kon %s (%s) niet aanpassen - de secondaire wisselkoers server wordt geprobeerd..');
?>
