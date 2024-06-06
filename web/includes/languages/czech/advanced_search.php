<?php
/*
  $Id: advanced_search.php,v 1.15 2003/07/08 16:45:35 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Podrobné vyhledávání');
define('NAVBAR_TITLE_2', 'Výsledky vyhledávání');

define('HEADING_TITLE_1', 'Podrobné vyhledávání');
define('HEADING_TITLE_2', 'Výsledky vyhledávání');

define('HEADING_SEARCH_CRITERIA', 'Váš vyhledávací dotaz');

define('TEXT_SEARCH_IN_DESCRIPTION', 'Hledat v popisech zboží');
define('ENTRY_CATEGORIES', 'Kategorie:');
define('ENTRY_INCLUDE_SUBCATEGORIES', 'Včetně podkategorií');
define('ENTRY_MANUFACTURERS', 'Výrobci/autoři:');
define('ENTRY_PRICE_FROM', 'Cena od:');
define('ENTRY_PRICE_TO', 'Cena do:');
define('ENTRY_DATE_FROM', 'Datum zařazení od:');
define('ENTRY_DATE_TO', 'Datum zařazení do:');

define('TEXT_SEARCH_HELP_LINK', '<span class="ColorSpan">HELP/POMOC k vyhledávání</span> [?]');

define('TEXT_ALL_CATEGORIES', 'Všechny kategorie');
define('TEXT_ALL_MANUFACTURERS', 'Všichni výrobci');

define('HEADING_SEARCH_HELP', 'HELP/POMOC');
define('TEXT_SEARCH_HELP', 'Klíčová slova mohou být oddělena tak, že napíšete AND (a), OR (nebo); abyste tak mohli lépe formulovat své dotazy.<br /><br />Například, <span class="ColorSpan">značka-výrobce AND myš</span> vytvoří dotaz ve kterém budou obě slova. <span class="ColorSpan">mouse OR keyboard</span>, the result set returned would contain both or either words.<br /><br />Exact matches can be searched for by enclosing keywords in double-quotes.<br /><br />For example, <span class="ColorSpan">"notebook computer"</span> Takto snadno vytvoříte logické dotazy pro lepší výsledky Vašeho vyhledávání.<br /><br />Například, <span class="ColorSpan">složitější dotaz: značka-výrobce and (keyboard or myš or "visual basic") IIIII uvozovky sdružují více slov do jednoho výrazu, závorky sdružují celé hledané výrazy.</span>.');
define('TEXT_CLOSE_WINDOW', '<span class="ColorSpan">Zavřít okno</span> [x]');

define('TABLE_HEADING_IMAGE', '');
define('TABLE_HEADING_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS', 'Produkt&nbsp;Jméno ');
define('TABLE_HEADING_MANUFACTURER', 'Výrobce');
define('TABLE_HEADING_QUANTITY', 'Množství');
define('TABLE_HEADING_PRICE', 'Cena');
define('TABLE_HEADING_WEIGHT', 'Váha');
define('TABLE_HEADING_BUY_NOW', 'Koupit');

define('TEXT_NO_PRODUCTS', 'Váš hledaný produkt nebyl vyhledán, nebo změňte vyhledávací dotaz.');

define('ERROR_AT_LEAST_ONE_INPUT', 'Jedno vyhledávací pole musí být vyplněno.');
define('ERROR_INVALID_FROM_DATE', '-Datum od- je špatně zadáno.');
define('ERROR_INVALID_TO_DATE', '-Datum do- je špatně zadáno.');
define('ERROR_TO_DATE_LESS_THAN_FROM_DATE', 'Datum do musí být vyšší než nebo stejné, než datum od.');
define('ERROR_PRICE_FROM_MUST_BE_NUM', 'Cena od musí být číslo.');
define('ERROR_PRICE_TO_MUST_BE_NUM', 'cena do musí být číslo.');
define('ERROR_PRICE_TO_LESS_THAN_PRICE_FROM', 'Cena do musí být vyšší nebo stejná jako cena od.');
define('ERROR_INVALID_KEYWORDS', 'špatné klíčové slovo');
//404 redirect
define('SEARCH_NOTFOUND_REDIRECT','Požadovaná stránka neexistuje, systém se pokusil vyhledat dokument dle klíčových slov v názvu. Pokud požadovaný dokument není v seznamu níže, zadejte upřesněný dotaz do vyhledávacího formuláře.');
?>
