<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Rozšířené hledání');
define('NAVBAR_TITLE_2', 'Výsledek hledání');

define('HEADING_TITLE_1', 'Rozšířené hledání');
define('HEADING_TITLE_2', 'Produkty vyhovující kritériím vyhledávání');

define('HEADING_SEARCH_CRITERIA', 'Kritéria vyhledávání');

define('TEXT_SEARCH_IN_DESCRIPTION', 'Hledat v popisu zboží');
define('ENTRY_CATEGORIES', 'Kategorie:');
define('ENTRY_INCLUDE_SUBCATEGORIES', 'Včetně subkategorií');
define('ENTRY_MANUFACTURERS', 'Výrobci:');
define('ENTRY_PRICE_FROM', 'Cena od:');
define('ENTRY_PRICE_TO', 'Cena do:');
define('ENTRY_DATE_FROM', 'Datum od:');
define('ENTRY_DATE_TO', 'Datum do:');



define('TEXT_SEARCH_HELP_LINK', '<u>Nápověda</u> [?]');

define('TEXT_ALL_CATEGORIES', 'Všechny kategorie');
define('TEXT_ALL_MANUFACTURERS', 'Všichni výrobci');


define('HEADING_SEARCH_HELP', 'Nápověda');
define('TEXT_SEARCH_HELP', 'Klíčová slova můžou být oddělena operátory AND a/nebo OR pro lepší kontrolu výsledku vyhledávání.<br><br>Například, <u>dupačky AND košilka</u> generuje výsledek, který obsahuje obě tato slova. Avšak, zadáním <u>body OR dupačky</u>, výsledek zobrazí produkty, které obsahují obě či jen jedno z těchto slov.<br><br>Přesného výsledku lze dosáhnout zadáním klíčových slov v uvozovkách.<br><br>Například zadání <u>"kojenecká košilka"</u> nalezne produkty, které mají ve svém popisu tato slova tak, jak byla vložena pro hledání.<br><br>Závorky mohou být použity pro přesnější výsledek.<br><br>Zadáním například: <u>dupačky AND (bavlněné OR mako OR bílá)</u>.');
define('TEXT_CLOSE_WINDOW', '<u>Zavřít okno</u> [x]');

define('TABLE_HEADING_IMAGE', 'Vyobrazení');
define('TABLE_HEADING_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS', 'Zboží');
define('TABLE_HEADING_MANUFACTURER', 'Výrobce');
define('TABLE_HEADING_QUANTITY', 'Množství');
define('TABLE_HEADING_PRICE', 'Cena'); 
define('TABLE_HEADING_WEIGHT', 'Weight');
define('TABLE_HEADING_BUY_NOW', 'Koupit nyní');

define('TEXT_NO_PRODUCTS', 'Neexistuje žádný produkt, který odpovídá kritériím vyhledávání.');

define('ERROR_AT_LEAST_ONE_INPUT', 'Alespoň jeden z polí ve vyhledávacím formuláři musí být zadán.');
define('ERROR_INVALID_FROM_DATE', 'Neplatná data.');
define('ERROR_INVALID_TO_DATE', 'Neplatné datum');
define('ERROR_TO_DATE_LESS_THAN_FROM_DATE', 'Chcete-li data musí být větší než nebo rovno Datum od.');
define('ERROR_PRICE_FROM_MUST_BE_NUM', 'Cena Od musí být číslo.');
define('ERROR_PRICE_TO_MUST_BE_NUM', 'Cena musí být číslo.');
define('ERROR_PRICE_TO_LESS_THAN_PRICE_FROM', 'Cena musí být větší než nebo rovno Cena Od.');
define('ERROR_INVALID_KEYWORDS', 'Neplatné klíčová slova.');
?>
