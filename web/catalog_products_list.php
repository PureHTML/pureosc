<?php
/*
  $Id: advanced_search_result.php,v 1.72 2003/06/23 06:50:11 project3000 Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ADVANCED_SEARCH);

  $error = false;

  if ( (isset($_GET['keywords']) && empty($_GET['keywords'])) &&
       (isset($_GET['dfrom']) && (empty($_GET['dfrom']) || ($_GET['dfrom'] == DOB_FORMAT_STRING))) &&
       (isset($_GET['dto']) && (empty($_GET['dto']) || ($_GET['dto'] == DOB_FORMAT_STRING))) &&
       (isset($_GET['pfrom']) && !is_numeric($_GET['pfrom'])) &&
       (isset($_GET['pto']) && !is_numeric($_GET['pto'])) ) {
    $error = true;

    $messageStack->add_session('search', ERROR_AT_LEAST_ONE_INPUT);
  } else {
    $dfrom = '';
    $dto = '';
    $pfrom = '';
    $pto = '';
    $keywords = '';

    if (isset($_GET['dfrom'])) {
      $dfrom = (($_GET['dfrom'] == DOB_FORMAT_STRING) ? '' : $_GET['dfrom']);
    }

    if (isset($_GET['dto'])) {
      $dto = (($_GET['dto'] == DOB_FORMAT_STRING) ? '' : $_GET['dto']);
    }

    if (isset($_GET['pfrom'])) {
      $pfrom = $_GET['pfrom'];
    }

    if (isset($_GET['pto'])) {
      $pto = $_GET['pto'];
    }

    if (isset($_GET['keywords'])) {
      $keywords = $_GET['keywords'];
    }

    $date_check_error = false;
    if (tep_not_null($dfrom)) {
      if (!tep_checkdate($dfrom, DOB_FORMAT_STRING, $dfrom_array)) {
        $error = true;
        $date_check_error = true;

        $messageStack->add_session('search', ERROR_INVALID_FROM_DATE);
      }
    }

    if (tep_not_null($dto)) {
      if (!tep_checkdate($dto, DOB_FORMAT_STRING, $dto_array)) {
        $error = true;
        $date_check_error = true;

        $messageStack->add_session('search', ERROR_INVALID_TO_DATE);
      }
    }

    if (($date_check_error == false) && tep_not_null($dfrom) && tep_not_null($dto)) {
      if (mktime(0, 0, 0, $dfrom_array[1], $dfrom_array[2], $dfrom_array[0]) > mktime(0, 0, 0, $dto_array[1], $dto_array[2], $dto_array[0])) {
        $error = true;

        $messageStack->add_session('search', ERROR_TO_DATE_LESS_THAN_FROM_DATE);
      }
    }

    $price_check_error = false;
    if (tep_not_null($pfrom)) {
      if (!settype($pfrom, 'double')) {
        $error = true;
        $price_check_error = true;

        $messageStack->add_session('search', ERROR_PRICE_FROM_MUST_BE_NUM);
      }
    }

    if (tep_not_null($pto)) {
      if (!settype($pto, 'double')) {
        $error = true;
        $price_check_error = true;

        $messageStack->add_session('search', ERROR_PRICE_TO_MUST_BE_NUM);
      }
    }

    if (($price_check_error == false) && is_float($pfrom) && is_float($pto)) {
      if ($pfrom >= $pto) {
        $error = true;

        $messageStack->add_session('search', ERROR_PRICE_TO_LESS_THAN_PRICE_FROM);
      }
    }

    if (tep_not_null($keywords)) {
      if (!tep_parse_search_string($keywords, $search_keywords)) {
        $error = true;

        $messageStack->add_session('search', ERROR_INVALID_KEYWORDS);
      }
    }
  }

  if (empty($dfrom) && empty($dto) && empty($pfrom) && empty($pto) && empty($keywords)) {
    $error = true;

    $messageStack->add_session('search', ERROR_AT_LEAST_ONE_INPUT);
  }

  if ($error == true) {
    tep_redirect(tep_href_link(FILENAME_ADVANCED_SEARCH, tep_get_all_get_params(), 'NONSSL', true, false));
  }

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ADVANCED_SEARCH));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, tep_get_all_get_params(), 'NONSSL', true, false));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>"/>
<?php
# cDynamic Meta Tags 
/*<title><?php echo TITLE; ?></title>*/ 
require(DIR_WS_INCLUDES . 'meta_tags.php'); 
# END Meta Tag 
?>

<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>"/>
<style title="default" type="text/css" media="all"><!--

BODY {
	font-family: Verdana, Arial, sans-serif;
  font-size: 0.7em;
  text-align: center;
  background: #ffffff;
  color: #000000;
  margin: 0px;
}


.s {
  text-decoration: line-through;
	background: inherit;
	color: inherit;
}

.b {
  font-weight: bold;
	background: inherit;
	color: inherit;
}

.InfoBoxContenent2MA {
  clear: both;
  border-style:solid;
  border-width:1px;
  border-color: #000000;
  background: #ffffff;
  color: #000000;
}

.ColorRed {
  color: #ff0000;
	background: inherit;
}

.Table_templateClear {
  font-size: 0.2em;
  background: #ffffff;
  color: #000000;
  clear: both;
}

.AlignLeft {
  text-align: left;
	background: inherit;
	color: inherit;
}

.Venticinque2 {
  width: 24%;
  float: left;
	background: inherit;
	color: inherit;
}

.Venticinque {
  background: #ffffff;
  color: #000000;
  font-weight: bold;
  width: 24%;
  float: left;
}

.Clear {
  font-size: 0em;
  clear: both;
	background: inherit;
	color: inherit;
}

.img2ma {
	background: inherit;
	color: inherit;	
  border:0px;
}

.pageHeading {
  font-size: 1.6em;
  font-weight: bold;
  color: #000000;
	background: inherit;
}

.Product_listingProductListing-heading {
  width: 24%;
  float: left;
  background: #ffffff;
  color: #000000;
  font-weight: bold;
}

--></style>

</head>
<body> 
<div><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(bts_select(images, 'logo.png'), STORE_NAME) . '</a>'; ?>
</div>

<?php
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

  $select_str = "select distinct " . $select_column_list . " m.manufacturers_id, p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price ";

  if ( (DISPLAY_PRICE_WITH_TAX == 'true') && (tep_not_null($pfrom) || tep_not_null($pto)) ) {
    $select_str .= ", SUM(tr.tax_rate) as tax_rate ";
  }

  $from_str = "from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m using(manufacturers_id) left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id";

  if ( (DISPLAY_PRICE_WITH_TAX == 'true') && (tep_not_null($pfrom) || tep_not_null($pto)) ) {
    if (!tep_session_is_registered('customer_country_id')) {
      $customer_country_id = STORE_COUNTRY;
      $customer_zone_id = STORE_ZONE;
    }
    $from_str .= " left join " . TABLE_TAX_RATES . " tr on p.products_tax_class_id = tr.tax_class_id left join " . TABLE_ZONES_TO_GEO_ZONES . " gz on tr.tax_zone_id = gz.geo_zone_id and (gz.zone_country_id is null or gz.zone_country_id = '0' or gz.zone_country_id = '" . (int)$customer_country_id . "') and (gz.zone_id is null or gz.zone_id = '0' or gz.zone_id = '" . (int)$customer_zone_id . "')";
  }

  $from_str .= ", " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_CATEGORIES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c";

// #################### Added Enable / Disable Categorie ###################
//  $where_str = " where p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id ";
    $where_str = " where p.products_status = '1' and c.categories_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id ";
// ################### End Added Enable / Disable Categorie ###################

  if (isset($_GET['categories_id']) && tep_not_null($_GET['categories_id'])) {
    if (isset($_GET['inc_subcat']) && ($_GET['inc_subcat'] == '1')) {
      $subcategories_array = array();
      tep_get_subcategories($subcategories_array, $_GET['categories_id']);

      $where_str .= " and p2c.products_id = p.products_id and p2c.products_id = pd.products_id and (p2c.categories_id = '" . (int)$_GET['categories_id'] . "'";

      for ($i=0, $n=sizeof($subcategories_array); $i<$n; $i++ ) {
        $where_str .= " or p2c.categories_id = '" . (int)$subcategories_array[$i] . "'";
      }

      $where_str .= ")";
    } else {
      $where_str .= " and p2c.products_id = p.products_id and p2c.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$_GET['categories_id'] . "'";
    }
  }

  if (isset($_GET['manufacturers_id']) && tep_not_null($_GET['manufacturers_id'])) {
    $where_str .= " and m.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "'";
  }

  if (isset($search_keywords) && (sizeof($search_keywords) > 0)) {
    $where_str .= " and (";
    for ($i=0, $n=sizeof($search_keywords); $i<$n; $i++ ) {
      switch ($search_keywords[$i]) {
        case '(':
        case ')':
        case 'and':
        case 'or':
          $where_str .= " " . $search_keywords[$i] . " ";
          break;
        default:
          $keyword = tep_db_prepare_input($search_keywords[$i]);
          $where_str .= "(pd.products_name like '%" . tep_db_input($keyword) . "%' or p.products_model like '%" . tep_db_input($keyword) . "%' or m.manufacturers_name like '%" . tep_db_input($keyword) . "%'";
          if (isset($_GET['search_in_description']) && ($_GET['search_in_description'] == '1')) $where_str .= " or pd.products_description like '%" . tep_db_input($keyword) . "%'";
          $where_str .= ')';
          break;
      }
    }
    $where_str .= " )";
  }

  if (tep_not_null($dfrom)) {
    $where_str .= " and p.products_date_added >= '" . tep_date_raw($dfrom) . "'";
  }

  if (tep_not_null($dto)) {
    $where_str .= " and p.products_date_added <= '" . tep_date_raw($dto) . "'";
  }

  if (tep_not_null($pfrom)) {
    if ($currencies->is_set($currency)) {
      $rate = $currencies->get_value($currency);

      $pfrom = $pfrom / $rate;
    }
  }

  if (tep_not_null($pto)) {
    if (isset($rate)) {
      $pto = $pto / $rate;
    }
  }

  if (DISPLAY_PRICE_WITH_TAX == 'true') {
    if ($pfrom > 0) $where_str .= " and (IF(s.status, s.specials_new_products_price, p.products_price) * if(gz.geo_zone_id is null, 1, 1 + (tr.tax_rate / 100) ) >= " . (double)$pfrom . ")";
    if ($pto > 0) $where_str .= " and (IF(s.status, s.specials_new_products_price, p.products_price) * if(gz.geo_zone_id is null, 1, 1 + (tr.tax_rate / 100) ) <= " . (double)$pto . ")";
  } else {
    if ($pfrom > 0) $where_str .= " and (IF(s.status, s.specials_new_products_price, p.products_price) >= " . (double)$pfrom . ")";
    if ($pto > 0) $where_str .= " and (IF(s.status, s.specials_new_products_price, p.products_price) <= " . (double)$pto . ")";
  }
  
  //TotalB2B start
  $where_str .=  " group by p.products_id";
  if ( (DISPLAY_PRICE_WITH_TAX == 'true') && (tep_not_null($pfrom) || tep_not_null($pto)) ) {
    $where_str .= ", tr.tax_priority";
  }
  //TotalB2B end

  if ( (!isset($_GET['sort'])) || (!ereg('[1-8][ad]', $_GET['sort'])) || (substr($_GET['sort'], 0, 1) > sizeof($column_list)) ) {
    for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
      if ($column_list[$i] == 'PRODUCT_LIST_NAME') {
        $_GET['sort'] = $i+1 . 'a';
        $order_str = ' order by pd.products_name';
        break;
      }
    }
  } else {
    $sort_col = substr($_GET['sort'], 0 , 1);
    $sort_order = substr($_GET['sort'], 1);
    $order_str = ' order by ';
    switch ($column_list[$sort_col-1]) {
      case 'PRODUCT_LIST_MODEL':
        $order_str .= "p.products_model " . ($sort_order == 'd' ? "desc" : "") . ", pd.products_name";
        break;
      case 'PRODUCT_LIST_NAME':
        $order_str .= "pd.products_name " . ($sort_order == 'd' ? "desc" : "");
        break;
      case 'PRODUCT_LIST_MANUFACTURER':
        $order_str .= "m.manufacturers_name " . ($sort_order == 'd' ? "desc" : "") . ", pd.products_name";
        break;
      case 'PRODUCT_LIST_QUANTITY':
        $order_str .= "p.products_quantity " . ($sort_order == 'd' ? "desc" : "") . ", pd.products_name";
        break;
      case 'PRODUCT_LIST_IMAGE':
        $order_str .= "pd.products_name";
        break;
      case 'PRODUCT_LIST_WEIGHT':
        $order_str .= "p.products_weight " . ($sort_order == 'd' ? "desc" : "") . ", pd.products_name";
        break;
      case 'PRODUCT_LIST_PRICE':
        $order_str .= "final_price " . ($sort_order == 'd' ? "desc" : "") . ", pd.products_name";
        break;
    }
  }

  $listing_sql = $select_str . $from_str . $where_str . $order_str;
  $listing_split = new splitPageResults($listing_sql, MAX_DISPLAY_SEARCH_RESULTS, 'p.products_id');

  if ( ($listing_split->number_of_rows > 0) && ( (PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3') ) ) {
?>
    <br /> <?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?> - 
    <?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?>
    <br />
<?php
  }

  $list_box_contents = array();

  for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
    switch ($column_list[$col]) {
      case 'PRODUCT_LIST_MODEL':
        $lc_text = TABLE_HEADING_MODEL;
        break;
      case 'PRODUCT_LIST_NAME':
        $lc_text = TABLE_HEADING_PRODUCTS;
        break;
      case 'PRODUCT_LIST_MANUFACTURER':
        $lc_text = TABLE_HEADING_MANUFACTURER;
        break;
      case 'PRODUCT_LIST_PRICE':
        $lc_text = TABLE_HEADING_PRICE;
        break;
      case 'PRODUCT_LIST_QUANTITY':
        $lc_text = TABLE_HEADING_QUANTITY;
        break;
      case 'PRODUCT_LIST_WEIGHT':
        $lc_text = TABLE_HEADING_WEIGHT;
        break;
      case 'PRODUCT_LIST_IMAGE':
        $lc_text = '&nbsp;<br />&nbsp;';
        break;
      case 'PRODUCT_LIST_BUY_NOW':
        $lc_text = TABLE_HEADING_BUY_NOW;
        break;
    }

    if ( ($column_list[$col] != 'PRODUCT_LIST_BUY_NOW') && ($column_list[$col] != 'PRODUCT_LIST_IMAGE') ) {
      $lc_text = tep_create_sort_heading($_GET['sort'], $col+1, $lc_text);
    }

if ($lc_text == TABLE_HEADING_BUY_NOW)  { 
    $list_box_contents[0][] = array('params' => 'class="Clear"',
                                    'text' => '&nbsp;'); 
} else { 
    $list_box_contents[0][] = array('params' => 'class="Product_listingProductListing-heading"',
                                    'text' => $lc_text);
}

  }

  if ($listing_split->number_of_rows > 0) {
    $rows = 0;
    $listing_query = tep_db_query($listing_split->sql_query);
    while ($listing = tep_db_fetch_array($listing_query)) {
      $rows++;

      if (($rows/2) == floor($rows/2)) {
        $list_box_contents[] = array('params' => 'class="productListing-even"');
      } else {
        $list_box_contents[] = array('params' => 'class="productListing-odd"');
      }

      $cur_row = sizeof($list_box_contents) - 1;

      for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {

        switch ($column_list[$col]) {
          case 'PRODUCT_LIST_MODEL':
            $lc_text = '<br />&nbsp;' . $listing['products_model'] . '&nbsp;<br /><br />';
            break;
          case 'PRODUCT_LIST_NAME':
            if (isset($_GET['manufacturers_id'])) {
              $lc_text = '<br /><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'manufacturers_id=' . $_GET['manufacturers_id'] . SEPARATOR_LINK . 'products_id=' . $listing['products_id']) . '">' . $listing['products_name'] . '</a><br />';
            } else {
              $lc_text = '<br />&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . SEPARATOR_LINK : '') . 'products_id=' . $listing['products_id']) . '">' . $listing['products_name'] . '</a>&nbsp;<br />';
            }
            break;
          case 'PRODUCT_LIST_MANUFACTURER':
            $lc_text = '<br />&nbsp;<a href="' . tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $listing['manufacturers_id']) . '">' . $listing['manufacturers_name'] . '</a>&nbsp;<br /><br />';
            break;
          case 'PRODUCT_LIST_PRICE':
//TotalB2B start
            $listing['products_price'] = tep_xppp_getproductprice($listing['products_id']);
//TotalB2B end

//TotalB2B start
		    if ($new_price = tep_get_products_special_price($listing['products_id'])) {
              $listing['specials_new_products_price'] = $new_price;
			  $query_special_prices_hide = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " WHERE configuration_key = 'SPECIAL_PRICES_HIDE'");
              $query_special_prices_hide_result = tep_db_fetch_array($query_special_prices_hide); 
              if ($query_special_prices_hide_result['configuration_value'] == 'true') {
			    $lc_text = '<br />&nbsp;<span class="ColorRed">' . $currencies->display_price_nodiscount($listing['specials_new_products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</span>&nbsp;<br /><br />';
	          } else {
			    $lc_text = '<br />&nbsp;<span class="s">' .  $currencies->display_price($listing['products_id'], $listing['products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</span>&nbsp;<br />&nbsp;<span class="ColorRed">' . $currencies->display_price_nodiscount($listing['specials_new_products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</span>&nbsp;<br />';
	          }
//TotalB2B end

            } else {
              $lc_text = '<br />&nbsp;' . $currencies->display_price($listing['products_id'], $listing['products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '&nbsp;<br /><br />';
            }
            break;
          case 'PRODUCT_LIST_QUANTITY':

// image for QTY
         if ( TRAFFIC_LIGHT == 'false') {
            $lc_text = '<br />&nbsp;' . $listing['products_quantity'] . '&nbsp;<br /><br />';
             } else {    
                           $prod_quantity = $listing['products_quantity'];
                              $minus = ($prod_quantity <= 0);
                              $red = ($prod_quantity == NULL);
                              $yellow = (($prod_quantity >= TRAFFIC_LIGHT_YELLOW) && ($prod_quantity <= TRAFFIC_LIGHT_GREEN));
                              $green =  ($prod_quantity > TRAFFIC_LIGHT_GREEN );
                            switch ($prod_quantity) { 
                            case $minus: 
                            $img = tep_image(bts_select(images, 'icon_status_red.png'), TEXT_NOT_AVAIBLE) . '&nbsp;&nbsp;' . TEXT_NOT_AVAIBLE ; 
                            break;  
                            case $red: 
                            $img = tep_image(bts_select(images, 'icon_status_red.png'), TEXT_NOT_AVAIBLE) . '&nbsp;&nbsp;' . TEXT_NOT_AVAIBLE ; 
                            break; 
                            case $yellow : 
                            $img = tep_image(bts_select(images, 'icon_status_yellow.png'), TEXT_FEW_QTY) . '&nbsp;&nbsp;' . TEXT_FEW_QTY ; 
                            break;
                            case $green : 
                            $img = tep_image(bts_select(images, 'icon_status_green.png'), TEXT_BIG_QTY) . '&nbsp;&nbsp;' . TEXT_BIG_QTY ; 
                            break; 
                            } 
            $lc_text =  $img ;
            } 
// image for QTY END
            break;        
          case 'PRODUCT_LIST_WEIGHT':
            $lc_text = '<br />&nbsp;' . $listing['products_weight'] . '&nbsp;<br /><br />';
            break;
          case 'PRODUCT_LIST_IMAGE':
            if (isset($_GET['manufacturers_id'])) {
              $lc_text = '<br /><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'manufacturers_id=' . $_GET['manufacturers_id'] . SEPARATOR_LINK . 'products_id=' . $listing['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $listing['products_image'], $listing['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>';
            } else {
              $lc_text = '<br />&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . SEPARATOR_LINK : '') . 'products_id=' . $listing['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $listing['products_image'], $listing['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>&nbsp;';
            }
            break;
          case 'PRODUCT_LIST_BUY_NOW':
            $lc_text = '<br /><div class="InfoBoxContenent2MA"><a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now' . SEPARATOR_LINK . 'products_id=' . $listing['products_id']) . '">' . tep_image_button('button_buy_now.png', IMAGE_BUTTON_BUY_NOW) . '</a></div>';
            break;
        }        
        
if ($lc_text == ('<br /><div class="InfoBoxContenent2MA"><a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now' . SEPARATOR_LINK . 'products_id=' . $listing['products_id']) . '">' . tep_image_button('button_buy_now.png', IMAGE_BUTTON_BUY_NOW) . '</a></div>'))  { 
        $list_box_contents[$cur_row][] = array('params' => 'class="Clear"',
                                               	'text'  =>  $lc_text );
} else { 
        $list_box_contents[$cur_row][] = array('params' => 'class="Venticinque2"',
                                               	'text'  =>  $lc_text );       
 }


      } 
    }

    new productListingBox($list_box_contents);
  } else {
    $list_box_contents = array();

    $list_box_contents[0] = array('params' => 'class="productListing-odd"');
    $list_box_contents[0][] = array('text' => '<br />' . TEXT_NO_PRODUCTS);

    new productListingBox($list_box_contents);
  }

  if ( ($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3')) ) {
?>
  <br />
    <?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?> - 
    <?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?>
  <br /> 
<?php
  }
?>
<br />
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
