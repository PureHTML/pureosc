<?php 
// new product for bts 1.5 oscommerce wai

  $row = 0;
  $col = 0;
  $info_box_contents = array();
  while ($new_products = tep_db_fetch_array($new_products_query)) {

	//TotalB2B start & TotalB2B start
	if ($new_price = tep_get_products_special_price($new_products['products_id'])) {
      $new_products['products_price'] = $new_price;
    $info_box_contents[$row][$col] = array('params' => 'class="TrentaTre"',
                                           'text' => '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">'
                                            . tep_image(DIR_WS_IMAGES . $new_products['products_image'], $new_products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br />
                                           <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">' . $new_products['products_name'] . '</a><br /><br />');
    } else {
      $new_products['products_price'] = tep_xppp_getproductprice($new_products['products_id']);
    $info_box_contents[$row][$col] = array('params' => 'class="TrentaTre"',
                                           'text' => '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">'
                                            . tep_image(DIR_WS_IMAGES . $new_products['products_image'], $new_products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br />
                                           <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">' . $new_products['products_name'] . '</a><br /><br />');
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