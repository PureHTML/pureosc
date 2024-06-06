<?php
/*
  $Id: index.php,v 1.1 2003/06/11 17:38:00 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce 

  Released under the GNU General Public License 
*/

define('TEXT_MAIN', '');
define('TABLE_HEADING_NEW_PRODUCTS', 'Nuovi prodotti per %s');
define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Prodotti in arrivo');
define('TABLE_HEADING_RANDOM_PRODUCTS', 'Prodotti a caso');
define('TABLE_HEADING_DATE_EXPECTED', 'Data di arrivo');

if ( ($category_depth == 'products') || (isset($_GET['manufacturers_id'])) ) {
  define('HEADING_TITLE', 'Vediamo cosa c\'&egrave; qui');
  define('TABLE_HEADING_IMAGE', '');
  define('TABLE_HEADING_MODEL', 'Modello');
  define('TABLE_HEADING_PRODUCTS', 'Articolo ');
  define('TABLE_HEADING_MANUFACTURER', 'Produttore');
  define('TABLE_HEADING_QUANTITY', 'Quantit&agrave;');
  define('TABLE_HEADING_PRICE', 'Prezzo ');
  define('TABLE_HEADING_WEIGHT', 'Dimensioni');
  define('TABLE_HEADING_BUY_NOW', 'Acquista adesso');
  define('TEXT_NO_PRODUCTS', 'Non ci sono prodotti in questa categoria.');
  define('TEXT_NO_PRODUCTS2', 'Non ci sono prodotti per questo produttore.');
  define('TEXT_NUMBER_OF_PRODUCTS', 'Numero di prodotti: ');
  define('TEXT_SHOW', '<span class="b">Mostra:</span>');
  define('TEXT_BUY', 'Acquista 1 \'');
  define('TEXT_NOW', '\' Ora');
  define('TEXT_ALL_CATEGORIES', 'Tutte le categoria');
  define('TEXT_ALL_MANUFACTURERS', 'Tutti i produttori');
} elseif ($category_depth == 'top') {
  define('HEADING_TITLE', 'Cosa c\' &egrave; di nuovo?');
} elseif ($category_depth == 'nested') {
$category_query = tep_db_query("select cd.categories_name, c.categories_image from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = '" . (int)$current_category_id . "' and cd.categories_id = '" . (int)$current_category_id . "' and cd.language_id = '" . (int)$languages_id . "'");

$category = tep_db_fetch_array($category_query);
  define('HEADING_TITLE', 'Categorie - ' . $category['categories_name']);
}

?>