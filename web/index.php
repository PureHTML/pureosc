<?php
//INFO
//jsp:sort order nastaveni zakladniho trideni



/*
  $Id: index.php,v 1.1 2003/06/11 17:37:59 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce, Copyright (c) 2008 shop2.0brain.com

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

$page_query = tep_db_query("select 
                               p.pages_id, 
                               p.sort_order, 
                               p.status, 
                               s.pages_title, 
                               s.pages_html_text
                            from 
                               " . TABLE_PAGES . " p LEFT JOIN " .TABLE_PAGES_DESCRIPTION . " s on p.pages_id = s.pages_id 
                            where 
                               p.status = 1
                            and
                               s.language_id = '" . (int)$languages_id . "'
                            and 
                               p.page_type = 1");


$page_check = tep_db_fetch_array($page_query);

$pagetext=stripslashes($page_check[pages_html_text]);

// the following cPath references come from application_top.php
  $category_depth = 'top';
  if (isset($cPath) && tep_not_null($cPath)) {
    $categories_products_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_id = '" . (int)$current_category_id . "'");
    $cateqories_products = tep_db_fetch_array($categories_products_query);
    if ($cateqories_products['total'] > 0) {
      $category_depth = 'products'; // display products
    } else {
      $category_parent_query = tep_db_query("select count(*) as total from " . TABLE_CATEGORIES . " where parent_id = '" . (int)$current_category_id . "'");
      $category_parent = tep_db_fetch_array($category_parent_query);
      if ($category_parent['total'] > 0) {
        $category_depth = 'nested'; // navigate through the categories
      } else {
        $category_depth = 'products'; // category has no products, but display the 'no products' message
      }
    }
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_DEFAULT);


  if ($category_depth == 'nested') {
    $category_query = tep_db_query("select cd.categories_name, c.categories_image from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = '" . (int)$current_category_id . "' and cd.categories_id = '" . (int)$current_category_id . "' and cd.language_id = '" . (int)$languages_id . "'");
    $category = tep_db_fetch_array($category_query);


    $content = basename($_SERVER['PHP_SELF']);
    while (strstr($content, '.php')) $content = str_replace('.php', '', $content);
    $content .= '_nested';
   // $content = CONTENT_INDEX_NESTED;

  } elseif ($category_depth == 'products' || isset($_GET['manufacturers_id'])) {
// create column list
    $define_list = array('PRODUCT_LIST_MODEL' => PRODUCT_LIST_MODEL,
                         'PRODUCT_LIST_NAME' => PRODUCT_LIST_NAME,
                         'PRODUCT_LIST_MANUFACTURER' => PRODUCT_LIST_MANUFACTURER,
                         'PRODUCT_LIST_PRICE' => PRODUCT_LIST_PRICE,
                         'PRODUCT_LIST_QUANTITY' => PRODUCT_LIST_QUANTITY,
                         'PRODUCT_LIST_WEIGHT' => PRODUCT_LIST_WEIGHT,
                         'PRODUCT_LIST_IMAGE' => PRODUCT_LIST_IMAGE,
                         'PRODUCT_LIST_BUY_NOW' => PRODUCT_LIST_BUY_NOW);

    asort($define_list);

    $column_list = array();
    reset($define_list);
    while (list($key, $value) = each($define_list)) {
      if ($value > 0) $column_list[] = $key;
    }

    $select_column_list = '';

    for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
      switch ($column_list[$i]) {
        case 'PRODUCT_LIST_MODEL':
          $select_column_list .= 'p.products_model, ';
          break;
        case 'PRODUCT_LIST_NAME':
          $select_column_list .= 'pd.products_name, ';
          break;
        case 'PRODUCT_LIST_MANUFACTURER':
          $select_column_list .= 'm.manufacturers_name, ';
          break;
        case 'PRODUCT_LIST_QUANTITY':
          $select_column_list .= 'p.products_quantity, ';
          break;
        case 'PRODUCT_LIST_IMAGE':
          $select_column_list .= 'p.products_image, ';
          break;
        case 'PRODUCT_LIST_WEIGHT':
          $select_column_list .= 'p.products_weight, ';
          break;
      }
    }

    //TotalB2B start
// show the products of a specified manufacturer
    if (isset($_GET['manufacturers_id'])) {
      if (isset($_GET['filter_id']) && tep_not_null($_GET['filter_id'])) {
// We are asked to show only a specific category
// ################## Added Enable Disable Categorie #################
//      $listing_sql = "select " . $select_column_list . " p. products_quantity, p.products_date_added, pd.products_description, p.products_listing_order, pd.products_description_long, pd.products_description_long2, p.products_dotisk, unix_timestamp(p.products_date_available) AS upcoming, p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from  " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on (p.products_id = s.products_id), " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c                                                                                 where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$_GET['filter_id'] . "'";
// b2b  $listing_sql = "select " . $select_column_list . " p. products_quantity, p.products_date_added, pd.products_description, p.products_listing_order, pd.products_description_long, pd.products_description_long2, p.products_dotisk, unix_timestamp(p.products_date_available) AS upcoming, p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from  " . TABLE_PRODUCTS . " p                                                                      , " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c   left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id           where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$_GET['filter_id'] . "' group by p.products_id";
        $listing_sql = "select " . $select_column_list . " p. products_quantity, p.products_date_added, pd.products_description, p.products_listing_order, pd.products_description_long, pd.products_description_long2, p.products_dotisk, unix_timestamp(p.products_date_available) AS upcoming, p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from (" . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on (p.products_id = s.products_id), " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c ) left join " . TABLE_CATEGORIES . " c on (p2c.categories_id = c.categories_id) where c.categories_status = '1' and p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$_GET['filter_id'] . "' group by p.products_id";
      } else {
// We show them all
// ################## Added Enable Disable Categorie #################
//      $listing_sql = "select " . $select_column_list . " p. products_quantity, p.products_date_added, pd.products_description, p.products_listing_order, pd.products_description_long, pd.products_description_long2, p.products_dotisk, unix_timestamp(p.products_date_available) AS upcoming, p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m                                                                     where p.products_status = '1' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "'";
// b2b  $listing_sql = "select " . $select_column_list . " p. products_quantity, p.products_date_added, pd.products_description, p.products_listing_order, pd.products_description_long, pd.products_description_long2, p.products_dotisk, unix_timestamp(p.products_date_available) AS upcoming, p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS . " p                                                                    , " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id where p.products_status = '1' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' group by p.products_id";
        $listing_sql = "select " . $select_column_list . " p. products_quantity, p.products_date_added, pd.products_description, p.products_listing_order, pd.products_description_long, pd.products_description_long2, p.products_dotisk, unix_timestamp(p.products_date_available) AS upcoming, p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from (" . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on (p.products_id = s.products_id), " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m ) left join " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c on (p.products_id = p2c.products_id) left join " . TABLE_CATEGORIES . " c on (p2c.categories_id = c.categories_id) where c.categories_status = '1' and p.products_status = '1' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' group by p.products_id";
      }
    } else {
// show the products in a given categorie
      if (isset($_GET['filter_id']) && tep_not_null($_GET['filter_id'])) {
// We are asked to show only specific catgeory
// ################## Added Enable Disable Categorie #################
//      $listing_sql = "select " . $select_column_list . " p. products_quantity, p.products_date_added, pd.products_description, p.products_listing_order, pd.products_description_long, pd.products_description_long2, p.products_dotisk, unix_timestamp(p.products_date_available) AS upcoming, p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c                                                                     where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$_GET['filter_id'] . "' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$current_category_id . "'";
// b2b  $listing_sql = "select " . $select_column_list . " p. products_quantity, p.products_date_added, pd.products_description, p.products_listing_order, pd.products_description_long, pd.products_description_long2, p.products_dotisk, unix_timestamp(p.products_date_available) AS upcoming, p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS . " p                                                                    , " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$_GET['filter_id'] . "' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$current_category_id . "' group by p.products_id";
        $listing_sql = "select " . $select_column_list . " p. products_quantity, p.products_date_added, pd.products_description, p.products_listing_order, pd.products_description_long, pd.products_description_long2, p.products_dotisk, unix_timestamp(p.products_date_available) AS upcoming, p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from (" . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on (p.products_id = s.products_id), " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c ) left join " . TABLE_CATEGORIES . " c on (c.categories_id = p2c.categories_id) where c.categories_status = '1' and p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$_GET['filter_id'] . "' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$current_category_id . "' group by p.products_id";
      } else {
// We show them all
// ################## Added Enable Disable Categorie #################
//      $listing_sql = "select " . $select_column_list . " p. products_quantity, p.products_date_added, pd.products_description, p.products_listing_order, pd.products_description_long, pd.products_description_long2, p.products_dotisk, unix_timestamp(p.products_date_available) AS upcoming, p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c                                                                     where p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$current_category_id . "'";
// b2b  $listing_sql = "select " . $select_column_list . " p. products_quantity, p.products_date_added, pd.products_description, p.products_listing_order, pd.products_description_long, pd.products_description_long2, p.products_dotisk, unix_timestamp(p.products_date_available) AS upcoming, p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id                                                                    , " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id where p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$current_category_id . "' group by p.products_id";
        $listing_sql = "select " . $select_column_list . " p. products_quantity, p.products_date_added, pd.products_description, p.products_listing_order, pd.products_description_long, pd.products_description_long2, p.products_dotisk, unix_timestamp(p.products_date_available) AS upcoming, p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from (" . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on (p.manufacturers_id = m.manufacturers_id) left join " . TABLE_SPECIALS . " s on (p.products_id = s.products_id), " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c) left join " . TABLE_CATEGORIES . " c on (c.categories_id = p2c.categories_id) where c.categories_status = '1' and p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$current_category_id . "' group by p.products_id";
      }
    }
    //TotalB2B end


    if ( (!isset($_GET['sort'])) || (!ereg('^[1-8][ad]$', $_GET['sort'])) || (substr($_GET['sort'], 0, 1) > sizeof($column_list)) ) {
      for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
        if ($column_list[$i] == 'PRODUCT_LIST_NAME') {
          $_GET['sort'] = $i+1 . 'a';
          //jsp:sort order novinky jsou blog
          if ($current_category_id==11) $listing_sql .= " order by p.products_date_added desc"; //tady1
            else
          $listing_sql .= " order by products_listing_order, pd.products_name"; //tady1
          break;
        }
      }
    } else {
      $sort_col = substr($_GET['sort'], 0 , 1);
      $sort_order = substr($_GET['sort'], 1);

      switch ($column_list[$sort_col-1]) {
        case 'PRODUCT_LIST_MODEL':
          $listing_sql .= " order by p.products_model " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
          break;
        case 'PRODUCT_LIST_NAME':
          $listing_sql .= " order by pd.products_name " . ($sort_order == 'd' ? 'desc' : '');
          break;
        case 'PRODUCT_LIST_MANUFACTURER':
          $listing_sql .= " order by m.manufacturers_name " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
          break;
        case 'PRODUCT_LIST_QUANTITY':
          $listing_sql .= " order by p.products_quantity " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
          break;
        case 'PRODUCT_LIST_IMAGE':
          $listing_sql .= " order by pd.products_name";
          break;
        case 'PRODUCT_LIST_WEIGHT':
          $listing_sql .= " order by p.products_weight " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
          break;

		//TotalB2B start
		//this is a know bug
        case 'PRODUCT_LIST_PRICE':
//        $listing_sql .= " order by final_price " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
          $listing_sql .= " order by p.products_price " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
          break;
		//TotalB2B end

      }
    }

    $content = basename($_SERVER['PHP_SELF']);
    while (strstr($content, '.php')) $content = str_replace('.php', '', $content);
    $content .= '_products';
   // $content = CONTENT_INDEX_PRODUCTS;

  } else { // default page
    $content = basename($_SERVER['PHP_SELF']);
    while (strstr($content, '.php')) $content = str_replace('.php', '', $content);
    $content .= '_default';
   // $content = CONTENT_INDEX_DEFAULT;

  }

  $javascript = 'remove_label.js';
  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>