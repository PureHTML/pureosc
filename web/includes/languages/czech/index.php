<?php
/*
  $Id: index.php,v 1.1 2003/06/11 17:38:00 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('TEXT_MAIN', 'Informace o nás');
define('TABLE_HEADING_NEW_PRODUCTS', 'Novinky %s');
define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Brzy bude v prodeji');
define('TABLE_HEADING_RANDOM_PRODUCTS', 'náhodné produkty');
define('TABLE_HEADING_DATE_EXPECTED', 'Očekávané uvedení');

if ( ($category_depth == 'products') || (isset($_GET['manufacturers_id'])) ) {
  define('HEADING_TITLE', '');
  define('TABLE_HEADING_IMAGE', '');
  define('TABLE_HEADING_MODEL', 'Model');
  define('TABLE_HEADING_PRODUCTS', 'Jméno&nbsp;produktu ');
  define('TABLE_HEADING_MANUFACTURER', 'Výrobce');
  define('TABLE_HEADING_QUANTITY', 'Množství');
  define('TABLE_HEADING_PRICE', 'Cena  ');
  define('TABLE_HEADING_WEIGHT', 'Váha');
  define('TABLE_HEADING_BUY_NOW', 'Koupit');
  define('TEXT_NO_PRODUCTS', ''); //Toto zboží není dostupné.
  define('TEXT_NO_PRODUCTS2', 'Toto zboží nemáme na skladě.');
  define('TEXT_NUMBER_OF_PRODUCTS', 'Počet zboží: ');
  define('TEXT_SHOW', '<span class="b">Vyberte:</span>');
  define('TEXT_BUY', 'Buy 1 \'');
  define('TEXT_NOW', '\' nyní');
  define('TEXT_ALL_CATEGORIES', 'Všechny kategorie');
  define('TEXT_ALL_MANUFACTURERS', 'Všichni výrobci');
} elseif ($category_depth == 'top') {
  define('HEADING_TITLE', 'Nové zboží:');
} elseif ($category_depth == 'nested') {
$category_query = tep_db_query("select cd.categories_name, c.categories_image from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = '" . (int)$current_category_id . "' and cd.categories_id = '" . (int)$current_category_id . "' and cd.language_id = '" . (int)$languages_id . "'");

$category = tep_db_fetch_array($category_query);
  define('HEADING_TITLE', '' . $category['categories_name']);
}

?>