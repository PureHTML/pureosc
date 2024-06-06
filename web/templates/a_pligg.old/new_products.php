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
//////////////////////ukazky////////////////////
if ($f=='') {
echo  '<table border="0" width="100%" cellspacing="0" cellpadding="0"><tr><td colspan="5" height="50"><br />&nbsp;<br /><div class="categoriesH1">ukázky</div><br /></td></tr></table>';
$new_products_query = tep_db_query("select p.products_date_added, unix_timestamp(p.products_date_available) AS upcoming, m.manufacturers_name,  p.products_quantity, pd.products_description_long, pd.products_description_long, pd.products_description_long2,  p.products_id, p.products_image, p.products_tax_class_id, pd.products_name, if(s.status, s.specials_new_products_price, p.products_price) as products_price, p.products_price as products_price_original from " . TABLE_MANUFACTURERS . " m, " .  TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c 
where p.products_description_long_order > 0 AND m.manufacturers_id = p.manufacturers_id AND c.categories_status='1' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' AND p.products_quantity>0 order by p.products_date_added DESC");

//echo '<table style="position:relative; left:-5px;"  border="0" width="100%" cellspacing="0" cellpadding="0">';

$boxHeader = 1;
// new product for bts 1.5 oscommerce wai

  $row = 0;
  $col = 0;
  $info_box_contents = array();
  while ($new_products = tep_db_fetch_array($new_products_query)) {
//preskocit kdyz neni produkt jeste skladem
if (intval($new_products['unixdate'])  >= time()) continue;
//ukazka, recenze, dotisk
$pdl1 = '';
$pdl2 = '';
$dotisk = '';

if ($new_products['products_description_long']) $pdl1 = '<a class="r" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">' . BUTTON_PRODUCTS_DESCRIPTION_LONG.'</a>';
if ($new_products['products_description_long2']) $pdl2 = '<a class="r" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">'. TEXT_PRODUCTS_DESCRIPTION_LONG2 .'</a>';
if ($new_products['products_dotisk']) $dotisk = '<span class="r">'. TEXT_PRODUCTS_DESCRIPTION_DOTISK .'</span>';

	//TotalB2B start & TotalB2B start
	if ($new_price = tep_get_products_special_price($new_products['products_id'])) {
      $new_products['products_price'] = $new_price;
    $info_box_contents[$row][$col] = array('params' => 'class=""',
                                           'text' => '<table border="0" width="100%" cellspacing="0" cellpadding="0"><tr><td class="obrtab"><a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '"><span class="ie6balengo">'
                                            . tep_image(DIR_WS_IMAGES . $new_products['products_image'], $new_products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) .'</span>'. $new_products['products_name'] .'</a></td>
                                            <td class="tabnovinka" valign="top" align="left"><a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '"><i>' . $new_products['manufacturers_name'] . '</i><br /><b>' . $new_products['products_name'] .'</b></a><br />'
			                    . tep_flatten_product_description_long($new_products['products_description_long'],  ' <a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">' . TEXT_MORE . '</a>') . '<br />
                                           <s>'.  $currencies->display_price_nodiscount($new_products['products_price_original'], tep_get_tax_rate($new_products['products_tax_class_id'])) .'</s>&nbsp;<b>' .  $currencies->display_price_nodiscount($new_products['products_price'], tep_get_tax_rate($new_products['products_tax_class_id'])) . '</b>&nbsp;<a class="n" href="shopping_cart.php?action=buy_now&amp;products_id=' . $new_products['products_id'] . '">' . tep_image_button('button_buy_now.png', IMAGE_BUTTON_BUY_NOW) . '</a>'. $pdl1 . $pdl2 . '</td></tr></table>');
                                           } else {
      $new_products['products_price'] = tep_xppp_getproductprice($new_products['products_id']);

					    if (!$new_products['upcoming'] || ($new_products['upcoming']  < time())) {
					    $info_box_contents[$row][$col] = array('params' => 'class=""',
                                           'text' => '<table border="0" width="100%" cellspacing="0" cellpadding="0"><tr><td class="obrtab"><a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">'
                                            . tep_image(DIR_WS_IMAGES . $new_products['products_image'], $new_products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT). '</a></td>
					    <td class="tabnovinka" valign="top" align="left"><a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '"><i>' . $new_products['manufacturers_name'] . '</i><br /><b>' . $new_products['products_name'] .'</b></a><br />'
			                    . tep_flatten_product_description_long($new_products['products_description_long'],  ' <a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">' . TEXT_MORE . '</a>') . '<br />
                                           <s>'. round(((tep_get_tax_rate($new_products['products_tax_class_id'])+100)/100) * $new_products['products_price']) .'Kč</s>&nbsp;<b>' . $currencies->display_price($new_products['products_id'], $new_products['products_price'], tep_get_tax_rate($new_products['products_tax_class_id'])) . '</b>&nbsp;<a class="n" href="shopping_cart.php?action=buy_now&amp;products_id=' . $new_products['products_id'] . '">' . tep_image_button('button_buy_now.png', IMAGE_BUTTON_BUY_NOW) . '</a>'. $pdl1 . $pdl2 . $dotisk . '</td></tr></table>');
} else {
        $info_box_contents[$row][$col] = array('params' => 'class=""',
                                           'text' => '<table border="0" width="100%" cellspacing="0" cellpadding="0"><tr><td class="obrtab"><a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">'
                                            . tep_image(DIR_WS_IMAGES . $new_products['products_image'], $new_products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT). '</a></td>
					    <td class="tabnovinka" valign="top" align="left"><a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '"><i>' . $new_products['manufacturers_name'] . '</i><br /><b>' . $new_products['products_name'] .'</b></a><br />'
			                    . tep_flatten_product_description_long($new_products['products_description_long'],  ' <a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">' . TEXT_MORE . '</a>') . '<br />
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

//posledni radka kde se da odkaz
echo '<div style="text-align:left;margin-left:135px"><a href="/?f=1"><b><u>' . TEXT_ALL_PRODUCTS_DESCRIPTION_LONG . '</u></b></a></div>';
}
?>