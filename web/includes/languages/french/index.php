<?php
/*
  $Id: index.php,v 1.1 2003/06/11 17:38:00 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
  Translated by Gunt - Contact : webmaster@webdesigner.com.fr
*/

define('TEXT_MAIN', '');
define('TABLE_HEADING_NEW_PRODUCTS', 'Nouveaux produits pour %s');
define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Prochains produits');
define('TABLE_HEADING_RANDOM_PRODUCTS', 'Random Produits');
define('TABLE_HEADING_DATE_EXPECTED', 'Date pr&eacute;vu');

if ( ($category_depth == 'products') || (isset($_GET['manufacturers_id'])) ) {
  define('HEADING_TITLE', 'Voyons ce que nous avons ici');
  define('TABLE_HEADING_IMAGE', '');
  define('TABLE_HEADING_MODEL', 'Mod&egrave;le:');
  define('TABLE_HEADING_PRODUCTS', 'Nom&nbsp;du&nbsp;produit: ');
  define('TABLE_HEADING_MANUFACTURER', 'Fabricant:');
  define('TABLE_HEADING_QUANTITY', 'Stock:');
  define('TABLE_HEADING_PRICE', 'Prix:');
  define('TABLE_HEADING_WEIGHT', 'Poids:');
  define('TABLE_HEADING_BUY_NOW', 'Acheter maintenant');
  define('TEXT_NO_PRODUCTS', 'Il n\'y a aucun produit list&eacute; dans cette cat&eacute;gorie.');
  define('TEXT_NO_PRODUCTS2', 'Il n\'y a aucun produit disponible de ce fabricant.');
  define('TEXT_NUMBER_OF_PRODUCTS', 'Nombre de produits :');
  define('TEXT_SHOW', '<span class="b">Afficher :</span>');
  define('TEXT_BUY', 'Acheter 1 \'');
  define('TEXT_NOW', '\' maintenant');
  define('TEXT_ALL_CATEGORIES', 'Toutes cat&eacute;gories');
  define('TEXT_ALL_MANUFACTURERS', 'Tous fabricants');
} elseif ($category_depth == 'top') {
  define('HEADING_TITLE', 'Nouveaut&eacute;s ?');
} elseif ($category_depth == 'nested') {
$category_query = tep_db_query("select cd.categories_name, c.categories_image from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = '" . (int)$current_category_id . "' and cd.categories_id = '" . (int)$current_category_id . "' and cd.language_id = '" . (int)$languages_id . "'");

$category = tep_db_fetch_array($category_query);
  define('HEADING_TITLE', 'Cat&eacute;gories - ' . $category['categories_name']);
}

?>