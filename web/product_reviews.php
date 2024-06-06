<?php
/*
  $Id: product_reviews.php,v 1.50 2003/06/09 23:03:55 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  $product_info_query = tep_db_query("select p.products_id, p.products_model, p.products_image, p.products_price, p.products_tax_class_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = '" . (int)$_GET['products_id'] . "' and p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "'");
  if (!tep_db_num_rows($product_info_query)) {
    tep_redirect(tep_href_link(FILENAME_REVIEWS));
  } else {
    $product_info = tep_db_fetch_array($product_info_query);
  }
  
  //TotalB2B start
  $product_info['products_price'] = tep_xppp_getproductprice($product_info['products_id']);
  //TotalB2B end

  if ($new_price = tep_get_products_special_price($product_info['products_id'])) {
	
    //TotalB2B start
	$query_special_prices_hide = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " WHERE configuration_key = 'SPECIAL_PRICES_HIDE'");
    $query_special_prices_hide_result = tep_db_fetch_array($query_special_prices_hide); 
    if ($query_special_prices_hide_result['configuration_value'] == 'true') {
      $products_price = '<span class="ColorRed">' . $currencies->display_price_nodiscount($new_price, tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span>';
	} else {
      $products_price = '<span class="s"> ' . $currencies->display_price($product_info['products_id'], $product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span> <span class="ColorRed">' . $currencies->display_price_nodiscount($new_price, tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span>';
	}
    //TotalB2B end

  } else {
    $products_price = $currencies->display_price($product_info['products_id'], $product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id']));
  }

  if (tep_not_null($product_info['products_model'])) {
    $products_name = $product_info['products_name'] . '<br /><span class="smallText">[' . $product_info['products_model'] . ']</span>';
  } else {
    $products_name = $product_info['products_name'];
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCT_REVIEWS);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_PRODUCT_REVIEWS, tep_get_all_get_params()));

  $content = basename($_SERVER['PHP_SELF']);
  while (strstr($content, '.php')) $content = str_replace('.php', '', $content);

//  $javascript = 'popup_window.js';

  $javascript = 'remove_label.js';
  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>