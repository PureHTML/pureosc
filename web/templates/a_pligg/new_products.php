<?php 
if ($f=='') echo  '<div class="categoriesH1">novinky</div><br />';

$boxHeader = 1;
// new product for bts 1.5 oscommerce wai

  $row = 0;
  $col = 0;
  $info_box_contents = array();
  while ($new_products = tep_db_fetch_array($new_products_query)) {
//preskocit kdyz neni produkt jeste skladem
//if (intval($new_products['unixdate'])  >= time()) continue;
//ukazka, recenze, dotisk
$pdl1 = '';
$pdl2 = '';
$dotisk = '';
/*
if ($new_products['products_description_long']) $pdl1 = '<span class="r">' . BUTTON_PRODUCTS_DESCRIPTION_LONG.'</span>';
if ($new_products['products_description_long2']) $pdl2 = '<span class="r">'. TEXT_PRODUCTS_DESCRIPTION_LONG2 .'</span>';
if ($new_products['products_dotisk']) $dotisk = '<span class="r">'. TEXT_PRODUCTS_DESCRIPTION_DOTISK .'</span>';
*/
if ($new_products['products_description_long']) $pdl1 = '<a class="r" href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . SEPARATOR_LINK : '') . 'products_id=' . $new_products['products_id']) . '#pdl">' . BUTTON_PRODUCTS_DESCRIPTION_LONG.'</a>';
if ($new_products['products_description_long2']) $pdl2 = '<a class="r" href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . SEPARATOR_LINK : '') . 'products_id=' . $new_products['products_id']) . '#pdl2">'. TEXT_PRODUCTS_DESCRIPTION_LONG2 .'</a>';
if ($new_products['products_dotisk']) $dotisk = '<span class="dotisk">'. TEXT_PRODUCTS_DESCRIPTION_DOTISK .'</span>';
if (MANUFACTURERS_TYPE == 'a') {
$tittleh1 = $new_products['manufacturers_name'];
    if (strpos($tittleh1, ',')) {
	$tittleh1a = ereg_replace('\,.*','',$tittleh1);
	$tittleh1b = ereg_replace('^.*\,','',$tittleh1);
	$tittleh1 = $tittleh1b .' ' .  $tittleh1a;
    }
$new_products['manufacturers_name'] = $tittleh1;
}  


	//TotalB2B start & TotalB2B start
	if ($new_price = tep_get_products_special_price($new_products['products_id'])) {
					    $info_box_contents[$row][$col] = array('params' => 'class=""',
                                           'text' => '<table border="0" width="100%" cellspacing="0" cellpadding="0"><tr><td class="obrtab"><a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">'
                                            . tep_image(DIR_WS_IMAGES . $new_products['products_image'], $new_products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT). '</a></td>
					    <td class="tabnovinka" valign="top" align="left">'. $dotisk . '<a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '"><i>' . $new_products['manufacturers_name'] . '</i><br /><b>' . $new_products['products_name'] .'</b></a><br />'
			                    . tep_flatten_product_description($new_products['products_description'],  ' <a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">' . TEXT_MORE . '</a>') . '<br />
                                           <s>'.  $currencies->display_price_nodiscount($new_products['products_price_original'], tep_get_tax_rate($new_products['products_tax_class_id'])) .'</s>&nbsp;<b>' .  $currencies->display_price_nodiscount($new_products['products_price'], tep_get_tax_rate($new_products['products_tax_class_id'])) . '</b>&nbsp;<a class="n" href="shopping_cart.php?action=buy_now&amp;products_id=' . $new_products['products_id'] . '">' . tep_image_button('button_buy_now.png', IMAGE_BUTTON_BUY_NOW) . '</a>'. $pdl1 . $pdl2 . '</td></tr></table><br style="font-size:15px;" />');
/*
//orig
      $new_products['products_price'] = $new_price;
    $info_box_contents[$row][$col] = array('params' => 'class="TrentaTre"',
                                           'text' => '<table border="0" width="100%" cellspacing="0" cellpadding="0"><tr><td class="obrtab"><a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '"><span class="ie6balengo">'
                                            . tep_image(DIR_WS_IMAGES . $new_products['products_image'], $new_products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) .'</span>'. $new_products['products_name'] .'</a><br />
                                         
                                           ' . $currencies->display_price_nodiscount($new_products['products_price'], tep_get_tax_rate($new_products['products_tax_class_id'])) . '</td></tr></table>');
*/
    } else {
      $new_products['products_price'] = tep_xppp_getproductprice($new_products['products_id']);

					    if (!$new_products['upcoming'] || ($new_products['upcoming']  < time())) {
					    $info_box_contents[$row][$col] = array('params' => 'class=""',
                                           'text' => '<table border="0" width="100%" cellspacing="0" cellpadding="0"><tr><td class="obrtab"><a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">'
                                            . tep_image(DIR_WS_IMAGES . $new_products['products_image'], $new_products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT). '</a></td>
					    <td class="tabnovinka" valign="top" align="left">'. $dotisk . '<a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '"><i>' . $new_products['manufacturers_name'] . '</i><br /><b>' . $new_products['products_name'] .'</b></a><br />'
			                    . tep_flatten_product_description($new_products['products_description'],  ' <a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">' . TEXT_MORE . '</a>') . '<br />
                                           <s>'. round(((tep_get_tax_rate($new_products['products_tax_class_id'])+100)/100) * $new_products['products_price']) .'Kč</s>&nbsp;<b>' . $currencies->display_price($new_products['products_id'], $new_products['products_price'], tep_get_tax_rate($new_products['products_tax_class_id'])) . '</b>&nbsp;<a class="n" href="shopping_cart.php?action=buy_now&amp;products_id=' . $new_products['products_id'] . '">' . tep_image_button('button_buy_now.png', IMAGE_BUTTON_BUY_NOW) . '</a>'. $pdl1 . $pdl2 . '</td></tr></table><br style="font-size:15px;" />');
} else {
        $info_box_contents[$row][$col] = array('params' => 'class=""',
                                           'text' => '<table border="0" width="100%" cellspacing="0" cellpadding="0"><tr><td class="obrtab"><a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">'
                                            . tep_image(DIR_WS_IMAGES . $new_products['products_image'], $new_products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT). '</a></td>
					    <td class="tabnovinka" valign="top" align="left"><a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '"><i>' . $new_products['manufacturers_name'] . '</i><br /><b>' . $new_products['products_name'] .'</b></a><br />'
			                    . tep_flatten_product_description($new_products['products_description'],  ' <a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">' . TEXT_MORE . '</a>') . '<br />
                                           <s>'. round(((tep_get_tax_rate($new_products['products_tax_class_id'])+100)/100) * $new_products['products_price']) .'Kč</s>&nbsp;<b>' . $currencies->display_price($new_products['products_id'], $new_products['products_price'], tep_get_tax_rate($new_products['products_tax_class_id'])) . '</b> '. $pdl1 . $pdl2 . $dotisk . '</td></tr></table>');


}
    }
	//TotalB2B end & TotalB2B end

	$col ++;
    if ($col > 2) {
      $col = 0;
      $row ++;
    }
  }

  new contentBox($info_box_contents);
$boxHeader = 0;
//konec novinky

?>