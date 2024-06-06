<?php
/*
  $Id: popup_image.php,v 1.18 2003/06/05 23:26:23 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCT_INFO);

  $navigation->remove_current_page();

  $products_oswai_query = tep_db_query("select pd.products_name, p.products_image, p.products_price, p.manufacturers_id from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id where p.products_status = '1' and p.products_id = '" . (int)$_GET['pID'] . "' and pd.language_id = '" . (int)$languages_id . "'");
  $products_oswai = tep_db_fetch_array($products_oswai_query);

//060417/zepitt/multi images extra
	/// MULTI IMAGE
	$product_img_query = tep_db_query("select pi.products_image1, pi.products_image2, pi.products_image3, pi.products_image4, pi.products_image5,	pi.products_image6, pi.products_image7, pi.products_image8, pi.products_image9
	FROM ".TABLE_PRODUCTS_IMAGES." pi 
	WHERE pi.products_id = '".(int)$_GET['pID']."'");
	
	$product_img = tep_db_fetch_array($product_img_query);
	///
//060417/zepitt/multi images extra EOF

  $product_check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$_GET['pID'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
  $product_check = tep_db_fetch_array($product_check_query);

                if (isset($_GET['pID'])) {
    $manufacturer_query = tep_db_query("select m.manufacturers_id, m.manufacturers_name, m.manufacturers_image, mi.manufacturers_url from " . TABLE_MANUFACTURERS . " m left join " . TABLE_MANUFACTURERS_INFO . " mi on (m.manufacturers_id = mi.manufacturers_id and mi.languages_id = '" . (int)$languages_id . "'), " . TABLE_PRODUCTS . " p  where p.products_id = '" . (int)$_GET['pID'] . "' and p.manufacturers_id = m.manufacturers_id");
    if (tep_db_num_rows($manufacturer_query)) {
      $manufacturer = tep_db_fetch_array($manufacturer_query);
                                        }}

  if ($product_check['total'] < 1) {
  } else {
    $product_info_query = tep_db_query("select p.products_id, pd.products_name, pd.products_description, p.products_model, p.products_quantity, p.products_image, pd.products_url, p.products_price, p.products_tax_class_id, p.products_date_added, p.products_date_available, p.manufacturers_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$_GET['pID'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
    $product_info = tep_db_fetch_array($product_info_query);

    tep_db_query("update " . TABLE_PRODUCTS_DESCRIPTION . " set products_viewed = products_viewed+1 where products_id = '" . (int)$_GET['pID'] . "' and language_id = '" . (int)$languages_id . "'");

    if (tep_not_null($product_info['products_model'])) {
      $products_oswai_name = $product_info['products_name'] . '<br /><span class="smallText">[' . $product_info['products_model'] . ']</span>';
    } else {
      $products_oswai_name = $product_info['products_name'];
    }}

  $content = basename($_SERVER['PHP_SELF']);
  while (strstr($content, '.php')) $content = str_replace('.php', '', $content);

//  $javascript = $content . '.js';
//  $body_attributes = ' onload="resize();"';

  include(bts_select('main', $content_template)); // BTSv1.5

  require('includes/application_bottom.php');
?>