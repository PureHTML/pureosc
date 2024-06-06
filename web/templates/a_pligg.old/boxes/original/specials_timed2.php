<?php
/*
  //shop2.0brain:todo: accesskey
  $Id: specials.php,v 1.31 2003/06/09 22:21:03 hpdl Exp $

  modified by paulm_nl 2003/12/23

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
// ######################## Added Enable / Disable Categorie ################
//  if ($random_product = tep_random_select("select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and p.products_id = s.products_id and pd.products_id = s.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' order by s.specials_date_added desc limit " . MAX_RANDOM_SELECT_SPECIALS)) {
   //TotalB2B start
   if (!isset($customer_id)) $customer_id = 0;
   $customer_group = tep_get_customers_groups_id();
  if ($random_product = tep_random_select("select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s, " . TABLE_CATEGORIES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c  where c.categories_status='1' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and p.products_status = '1' and p.products_id = s.products_id and pd.products_id = s.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' AND s.expires_date >0 order by s.specials_date_added desc limit 1,1")) {
   //TotalB2B end
// ######################## End Added Enable / Disable Categorie ################
?>
<!-- specials //-->
<?php
  $boxHeading = '';
//  $corner_left = 'square';
//  $corner_right = 'square';
  $boxContent_attributes = ' align="center"';
//jsp:stop neodkazujeme  $boxLink = '<a class="BoxesInfoBoxHeadingCenterBoxRight" title="hotkey: [v]" href="' . tep_href_link(FILENAME_SPECIALS) . '"><font color="#b19b6a">'. BOX_HEADING_SPECIALS_TIMED . '</font></a>';
//  $boxLink = '<font color="#b19b6a">'. BOX_HEADING_SPECIALS_TIMED . '</font>';
$boxLink = '';
  $box_base_name = 'specials'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

	//TotalB2B start
    $random_product['products_price'] = tep_xppp_getproductprice($random_product['products_id']);
    //TotalB2B end

	//TotalB2B start
	$random_product['specials_new_products_price'] = tep_get_products_special_price($random_product['products_id']);
    $query_special_prices_hide = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " WHERE configuration_key = 'SPECIAL_PRICES_HIDE'");
    $query_special_prices_hide_result = tep_db_fetch_array($query_special_prices_hide); 
    if ($query_special_prices_hide_result['configuration_value'] == 'true') {
    $boxContent = '<a accesskey="V" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product["products_id"]) . '">'. '&nbsp;[V]&nbsp;<span>' . tep_image(DIR_WS_IMAGES . $random_product['products_image'], $random_product['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</span>'.$random_product['products_name'] . '</a><br />

                                 <span class="ColorWhite">' . $currencies->display_price_nodiscount($random_product['specials_new_products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) 
                                 . '</span>';
	} else {
    $boxContent = '
        <div style="left:-10px;background:#8f2005;width:195px;height:2px;position:relative;top:-12px;z-index:2"></div><a accesskey="V" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product["products_id"]) . '">'. '<span class="ie6balengo">' . tep_image(DIR_WS_IMAGES . $random_product['products_image'], $random_product['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) .'</span>'. $random_product['products_name'] . '</a><br />

                                 <span class="s"> ' . $currencies->display_price($random_product['products_id'], $random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</span><br />
                                 <span class="ColorWhite">' . $currencies->display_price_nodiscount($random_product['specials_new_products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) 
                                 . '</span>';
        }
    //TotalB2B end

include (bts_select('boxes', $box_base_name)); // BTS 1.5

  $boxLink = '';
  $boxContent_attributes = '';
?>
<!-- specials_eof //-->
<?php
  }
?>