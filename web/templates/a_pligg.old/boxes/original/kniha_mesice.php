<?php
/*
  $Id: whats_new.php,v 1.31 2003/02/10 22:31:09 hpdl Exp $

  modified by paulm_nl 2003/12/23

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
// ######################## Added Enable / Disable Categorie ################
//  if ($random_product = tep_random_select("select products_id, products_image, products_tax_class_id, products_price from " . TABLE_PRODUCTS . " where products_status = '1' order by products_date_added desc limit " . MAX_RANDOM_SELECT_NEW)) {
   if ($random_product = tep_random_select("select distinct p.products_id, p.products_image, p.products_tax_class_id, p.products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where p.products_status='1' and p.products_id = p2c.products_id and c.categories_id = p2c.categories_id and c.categories_status=1 AND p.products_kniha_mesice = 1")) {
// ######################## End Added Enable / Disable Categorie ################
?>
<div align="center">
<div style="border:1px solid #d6d0b8; width:80%">
<!-- kniha_mesice //-->
<?php
    $boxHeading = '';
    $corner_left = 'square';
    $corner_right = 'square';
    $boxContent_attributes = ' align="center"';
    $boxLink = '&nbsp;&nbsp;&nbsp;kniha měsíce';
    $box_base_name = 'whats_new'; // for easy unique box template setup (added BTSv1.2)
    $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)
    $random_product['products_name'] = tep_get_products_name($random_product['products_id']);
    $random_product['specials_new_products_price'] = tep_get_products_special_price($random_product['products_id']);

	//TotalB2B start
    $random_product['products_price'] = tep_xppp_getproductprice($random_product['products_id']);
    //TotalB2B end

    if (tep_not_null($random_product['specials_new_products_price'])) {
	  
      //TotalB2B start
	  $random_product['specials_new_products_price'] = tep_get_products_special_price($random_product['products_id']);
	  $query_special_prices_hide = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " WHERE configuration_key = 'SPECIAL_PRICES_HIDE'");
      $query_special_prices_hide_result = tep_db_fetch_array($query_special_prices_hide); 
      if ($query_special_prices_hide_result['configuration_value'] == 'true') {
		$whats_new_price = '<span class="ColorRed">' . $currencies->display_price_nodiscount($random_product['specials_new_products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</span>';
	  } else {
		$whats_new_price = '<span class="s">' . $currencies->display_price($random_product['products_id'], $random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</span><br />';
        $whats_new_price .= '<span class="ColorRed">' . $currencies->display_price_nodiscount($random_product['specials_new_products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</span>';
	  }
      //TotalB2B end

    } else {
      $whats_new_price = $currencies->display_price($random_product['products_id'], $random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id']));
    }

    $boxContent = '<a class="n" accesskey="N" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . '<span class="ie6balengo">' . tep_image(DIR_WS_IMAGES . $random_product['products_image'], $random_product['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) .'</span>'. $random_product['products_name'] .'</a><br /><s>' . $currencies->display_price_nodiscount($random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</s>&nbsp;<b>' . $whats_new_price . '</b><br />';

include (bts_select('boxes', $box_base_name)); // BTS 1.5

    $boxLink = '';
    $boxContent_attributes = '';
?>
<!-- kniha_mesice_eof //-->
</div></div>
<?php
  }
?>