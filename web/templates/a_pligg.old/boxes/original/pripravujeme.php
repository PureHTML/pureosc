<?php
/*
  $Id: upcoming_products.php,v 1.24 2003/06/09 22:49:59 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
  $expected_query = tep_db_query("select 
  p.products_id, pd.products_name, p.products_image, products_date_available as date_expected,
  p.products_tax_class_id, if(s.status, s.specials_new_products_price, p.products_price) as products_price   
  from " . TABLE_PRODUCTS . " p
  left join " . TABLE_SPECIALS . " s on (p.products_id = s.products_id)
  , " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c 
  , " . TABLE_PRODUCTS_DESCRIPTION . " pd 
  where 
  to_days(products_date_available) >= to_days(now())
  and
  c.categories_status='1' 
  and
  products_status = '1'
  and 
  p.products_id = p2c.products_id 
  and 
  p2c.categories_id = c.categories_id
  and 
  p.products_id = pd.products_id 
  and 
  pd.language_id = '" . (int)$languages_id . "' 
  order by unix_timestamp(products_date_available)   limit 2");
  if (tep_db_num_rows($expected_query) > 0) {
?>
<!-- upcoming_products //-->
 
<?php
  $info_box_contents = array();
  $info_box_contents[] = array('text' => TABLE_HEADING_UPCOMING_PRODUCTS);
//  new contentBoxHeading($info_box_contents);
echo  '<div class="BoxesInfoBoxHeadingCenterBoxTitle">brzy vyjde</div>';
  $row = 0;
  $col = 0;
  $info_box_contents = array();
    while ($expected = tep_db_fetch_array($expected_query)) {

//TotalB2B start & TotalB2B start
	if ($new_price = tep_get_products_special_price($expected['products_id'])) {
      $expected['products_price'] = $new_price;
    $info_box_contents[$row][$col] = array('params' => 'class="centerBoxik"',
                                           'text' => '<a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">'
                                            . tep_image(DIR_WS_IMAGES . $expected['products_image'], $expected['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br />
                                           <a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $expected['products_id']) . '">' . $expected['products_name'] . '</a>
                                           <br /><s>'. round(((tep_get_tax_rate($expected['products_tax_class_id'])+100)/100) * $expected['products_price']) .'Kč</s>&nbsp;' . $currencies->display_price_nodiscount($expected['products_price'], tep_get_tax_rate($expected['products_tax_class_id'])));
    } else {
      $expected['products_price'] = tep_xppp_getproductprice($expected['products_id']);
    $info_box_contents[$row][$col] = array('params' => 'class="centerBoxik"',
                                           'text' => '<a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $expected['products_id']) . '">'
                                            . tep_image(DIR_WS_IMAGES . $expected['products_image'], $expected['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br />
                                           <a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $expected['products_id']) . '">' . $expected['products_name'] . '</a>
                                           <br /><s>'. round(((tep_get_tax_rate($expected['products_tax_class_id'])+100)/100) * $expected['products_price']) .'Kč</s>&nbsp;' . $currencies->display_price($expected['products_id'], $expected['products_price'], tep_get_tax_rate($expected['products_tax_class_id'])));
    }
//TotalB2B end & TotalB2B end

    $col ++;
      if ($col > 2) {
        $col = 0;
        $row ++;
      }
    }
    
  new contentBox($info_box_contents);
?> 
<br />
<!-- upcoming_products_eof //-->
<?php
  }
?>
