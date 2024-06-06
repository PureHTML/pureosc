<?php
/*
  $Id: index.php,v 1.2 2003/07/11 09:04:22 jan0815 Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('TEXT_MAIN', '');
define('TABLE_HEADING_NEW_PRODUCTS', 'Nieuw Artikel Voor %s');
define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Verwachte Artikel(en)');
define('TABLE_HEADING_RANDOM_PRODUCTS', 'Random Artikel');
define('TABLE_HEADING_DATE_EXPECTED', 'Datum');

if ( ($category_depth == 'products') || (isset($_GET['manufacturers_id'])) ) {
  define('HEADING_TITLE', 'Wat hebben we hier?');
  define('TABLE_HEADING_IMAGE', '');
  define('TABLE_HEADING_MODEL', 'Model/Type');
  define('TABLE_HEADING_PRODUCTS', 'Artikel Naam');
  define('TABLE_HEADING_MANUFACTURER', 'Fabrikant');
  define('TABLE_HEADING_QUANTITY', 'Aantal');
  define('TABLE_HEADING_PRICE', 'Prijs');
  define('TABLE_HEADING_WEIGHT', 'Gewicht');
  define('TABLE_HEADING_BUY_NOW', 'Koop NU');
  define('TEXT_NO_PRODUCTS', 'Er bevinden zich geen Artikelen in deze Categorie.');
  define('TEXT_NO_PRODUCTS2', 'Er zijn geen Artikelen van deze Fabrikant beschikbaar.');
  define('TEXT_NUMBER_OF_PRODUCTS', 'Artikel: ');
  define('TEXT_SHOW', '<span class="b">Toon:</span>');
  define('TEXT_BUY', 'Koop 1 \'');
  define('TEXT_NOW', '\' NU!');
  define('TEXT_ALL_CATEGORIES', 'Alle Categorieën');
  define('TEXT_ALL_MANUFACTURERS', 'Alle Fabrikanten');
} elseif ($category_depth == 'top') {
  define('HEADING_TITLE', 'Nieuw Binnengekomen');
} elseif ($category_depth == 'nested') {
$category_query = tep_db_query("select cd.categories_name, c.categories_image from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = '" . (int)$current_category_id . "' and cd.categories_id = '" . (int)$current_category_id . "' and cd.language_id = '" . (int)$languages_id . "'");

$category = tep_db_fetch_array($category_query);
  define('HEADING_TITLE', 'Categorieën - ' . $category['categories_name']);
}

?>