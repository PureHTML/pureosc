<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Kategorie / zboží');
define('HEADING_TITLE_SEARCH', 'Vyhledat:');
define('HEADING_TITLE_GOTO', 'Jdi na:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Kategorie / zboží');
define('TABLE_HEADING_ACTION', 'Proveď');
define('TABLE_HEADING_STATUS', 'Karta');

define('TEXT_NEW_PRODUCT', 'Nové zboží v &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Kategorie:');
define('TEXT_SUBCATEGORIES', 'Podkategorie:');
define('TEXT_PRODUCTS', 'Zboží:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Cena s DPH:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Výše DPH:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Průměr hodnocení:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Množství:');
define('TEXT_DATE_ADDED', 'Datum přidání:');
define('TEXT_DATE_AVAILABLE', 'Datum uskladnění:');
define('TEXT_LAST_MODIFIED', 'Posledni úprava:');
define('TEXT_IMAGE_NONEXISTENT', 'Obrázek chybí');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Vlož novou kategorii nebo zboží do<br>&nbsp;<br><b>%s</b>');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Pro více informací se na zboží podívej na <a href="http://%s" target="blank"><u>webpage</u></a>.');
define('TEXT_PRODUCT_DATE_ADDED', 'Toto zboží bylo přidáno do obchodu %s.');

define('TEXT_PRODUCT_DATE_AVAILABLE', 'Teto zboží bude na skladu %s.');

define('TEXT_EDIT_INTRO', 'Proveď potřebné změny');
define('TEXT_EDIT_CATEGORIES_ID', 'ID kategorie:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Název kategorie:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Logo kategorie:');
define('TEXT_EDIT_SORT_ORDER', 'Pořadí třídění:');
//define('TEXT_EDIT_PARENT_ID', 'Nadřazené ID:');

define('TEXT_INFO_COPY_TO_INTRO', 'Vyber kategorii do které chceš překopírovat zboží');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Aktuální kategorie:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Nová kategorie');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Úprava kategorie');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Vymazání kategorie');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Vyber kategorii');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Vymazání zboží');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Vybrat zboží');
define('TEXT_INFO_HEADING_COPY_TO', 'Kopírovat do');

define('TEXT_DELETE_CATEGORY_INTRO', 'Opravdu chceš smazat tuto kategorii?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Skutečně chceš smazat toto zboží?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>Upozornění:</b> Zde je %s (pod-)kategorií připojených k této kategorii!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>Upozornění:</b> Zde je are %s zboží připojených k této kategorii!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Vyber nadřazenou kategorii pro přesun zboží <b>%s</b> to');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Vyber nadřazenou kategorii pro přesun <b>%s</b> to');
define('TEXT_MOVE', 'Přesuň <b>%s</b> do:');
define('TEXT_MOVE_NOTE', '<small><b>Poznámka:</b></small> Rozmysli si to!');

define('TEXT_NEW_CATEGORY_INTRO', 'Vyplň několik informací o nové kategorii');
define('TEXT_CATEGORIES_NAME', 'Název kategorie:');
define('TEXT_CATEGORIES_IMAGE', 'Logo kategorie:');
define('TEXT_SORT_ORDER', 'Způsob třídění:');

define('TEXT_PRODUCTS_STATUS', 'Karta zboží:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Datum uskladnění:');
define('TEXT_PRODUCT_AVAILABLE', 'Na skladu');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Není skladem');
define('TEXT_PRODUCTS_MANUFACTURER', 'Výrobce-značka tboží:');
define('TEXT_PRODUCTS_NAME', 'Název zboží:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Popis zboží:');
define('TEXT_PRODUCTS_QUANTITY', 'Množství zboží:');
define('TEXT_PRODUCTS_MODEL', 'Model-typ:');
define('TEXT_PRODUCTS_IMAGE', 'Obrázek zboží:');
define('TEXT_PRODUCTS_URL', 'URL zboží:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(bez http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Cena zboží (bez DPH):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Cena zboží (s DPH):');
define('TEXT_PRODUCTS_PRICE', 'Cen s DPH:');
define('TEXT_PRODUCTS_WEIGHT', 'Váha zboží:');

define('EMPTY_CATEGORY', 'Prázdná kategorie');

define('TEXT_HOW_TO_COPY', 'Copy Method:');
define('TEXT_COPY_AS_LINK', 'Link zboží');
define('TEXT_COPY_AS_DUPLICATE', 'Duplikovat zboží');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Chyba: Nelze spojit výrobky ve stejné kategorii.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Chyba: Katalog obrazy adresáře nelze zapisovat: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Chyba: Katalog obrazy adresář neexistuje: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Chyba: Kategorie nemohou být přesunuty do kategorie dětí.');
?>
