<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Měny');

define('TABLE_HEADING_CURRENCY_NAME', 'Měna');
define('TABLE_HEADING_CURRENCY_CODES', 'Kód');
define('TABLE_HEADING_CURRENCY_VALUE', 'Kurs');
define('TABLE_HEADING_ACTION', 'Proveď');


define('TEXT_INFO_EDIT_INTRO', 'Proveď potřebné změny');
define('TEXT_INFO_COMMON_CURRENCIES', '-- Common Currencies --');
define('TEXT_INFO_CURRENCY_TITLE', 'Název:');
define('TEXT_INFO_CURRENCY_CODE', 'Kód:');
define('TEXT_INFO_CURRENCY_SYMBOL_LEFT', 'Symbol před:');
define('TEXT_INFO_CURRENCY_SYMBOL_RIGHT', 'Symbol za:');
define('TEXT_INFO_CURRENCY_DECIMAL_POINT', 'Desetiná tečka:');
define('TEXT_INFO_CURRENCY_THOUSANDS_POINT', 'Oddělovač tis.:');
define('TEXT_INFO_CURRENCY_DECIMAL_PLACES', 'Poč. desetin. míst:');
define('TEXT_INFO_CURRENCY_LAST_UPDATED', 'Poslední úprva:');
define('TEXT_INFO_CURRENCY_VALUE', 'Hodnota / kurs:');
define('TEXT_INFO_CURRENCY_EXAMPLE', 'Příklad formátu:');
define('TEXT_INFO_INSERT_INTRO', 'Vlož novou měnu a její parametry');
define('TEXT_INFO_DELETE_INTRO', 'Opravdu chceš zrušit tuto měnu?');
define('TEXT_INFO_HEADING_NEW_CURRENCY', 'Nová měna');
define('TEXT_INFO_HEADING_EDIT_CURRENCY', 'Úprava měny');
define('TEXT_INFO_HEADING_DELETE_CURRENCY', 'Vymazání měny');
define('TEXT_INFO_SET_AS_DEFAULT', TEXT_SET_DEFAULT . ' (u ostatních měn manuálně upravte hodnotu kursu k této měně)');
define('TEXT_INFO_CURRENCY_UPDATED', 'Směnný kurz pro %s (%s) byla úspěšně aktualizována pomocí %s.');

define('ERROR_REMOVE_DEFAULT_CURRENCY', 'Chyba: Výchozí měna nemůže být odstraněn. Prosím nastavte jinou měnu jako výchozí, a zkuste to znovu.');
define('ERROR_CURRENCY_INVALID', 'Chyba: Směnný kurz pro %s (%s) nebyl aktualizován pomocí %s. Je to platný kód měny?');
define('WARNING_PRIMARY_SERVER_FAILED', 'Upozornění: Primární kurz serveru (%s) se nezdařilo pro %s (%s) - se snaží na sekundární server směnného kurzu.');
?>
