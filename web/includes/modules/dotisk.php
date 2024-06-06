xxxxxxxxxxxxxxxxxxxxxxxxx<?php
/*
  $Id: new_products.php,v 1.34 2003/06/09 22:49:58 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- new_products //-->
<?php
//  $info_box_contents = array();
//  $info_box_contents[] = array('text' => sprintf(TABLE_HEADING_NEW_PRODUCTS, strftime('%B')));

//  new contentBoxHeading($info_box_contents);
//echo  '<div class="categoriesH1">' .sprintf(TABLE_HEADING_NEW_PRODUCTS, strftime('%B')) . '</div>';

echo  '<div class="categoriesH1">dotisk</div>';
$new_products_query = tep_db_query("select unix_timestamp(p.products_date_available) AS upcoming, m.manufacturers_name,  pd.products_description, pd.products_description_long, pd.products_description_long2,  p.products_id, p.products_image, p.products_tax_class_id, pd.products_name, if(s.status, s.specials_new_products_price, p.products_price) as products_price from " . TABLE_MANUFACTURERS . " m, " .  TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c 
where pd.products_description_long !='' AND m.manufacturers_id = p.manufacturers_id AND c.categories_status='1' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "'");

echo '<table style="position:relative; left:-5px;"  border="0" width="100%" cellspacing="0" cellpadding="0">';

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

if ($new_products['products_description_long']) $pdl1 = '<span class="r">' . BUTTON_PRODUCTS_DESCRIPTION_LONG.'</span>';
if ($new_products['products_description_long2']) $pdl2 = '<span class="r">'. TEXT_PRODUCTS_DESCRIPTION_LONG2 .'</span>';
if ($new_products['products_dotisk']) $dotisk = '<span class="r">'. TEXT_PRODUCTS_DESCRIPTION_DOTISK .'</span>';

	//TotalB2B start & TotalB2B start
	if ($new_price = tep_get_products_special_price($new_products['products_id'])) {
      $new_products['products_price'] = $new_price;
    $info_box_contents[$row][$col] = array('params' => 'class="TrentaTre"',
                                           'text' => '<br /><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '"><span class="ie6balengo">'
                                            . tep_image(DIR_WS_IMAGES . $new_products['products_image'], $new_products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) .'</span>'. $new_products['products_name'] .'</a><br />
                                         
                                           ' . $currencies->display_price_nodiscount($new_products['products_price'], tep_get_tax_rate($new_products['products_tax_class_id'])));
    } else {
      $new_products['products_price'] = tep_xppp_getproductprice($new_products['products_id']);

					    if (!$new_products['upcoming'] || ($new_products['upcoming']  < time())) {
					    $info_box_contents[$row][$col] = array('params' => 'class=""',
                                           'text' => '<tr><td class="obrtab"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">'
                                            . tep_image_spec('images/'.$new_products['products_image']). '</a></td>
					    <td class="tabnovinka" valign="top" align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '"><i>' . $new_products['manufacturers_name'] . '</i><br /><b>' . $new_products['products_name'] .'</a></b><br />'
			                    . tep_flatten_product_description($new_products['products_description'],  ' <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">' . TEXT_MORE . '</a>') . '<br />
                                           <s>'. round(((tep_get_tax_rate($new_products['products_tax_class_id'])+100)/100) * $new_products['products_price']) .'Kč</s>&nbsp;<b>' . $currencies->display_price($new_products['products_id'], $new_products['products_price'], tep_get_tax_rate($new_products['products_tax_class_id'])) . '</b>&nbsp;<a href="shopping_cart.php?action=buy_now&amp;products_id=' . $new_products['products_id'] . '">' . tep_image_button('button_buy_now.png', IMAGE_BUTTON_BUY_NOW) . '</a>'. $pdl1 . $pdl2 . $dotisk . '</td></tr>');
} else {
        $info_box_contents[$row][$col] = array('params' => 'class=""',
                                           'text' => '<tr><td class="obrtab"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">'
                                            . tep_image('images/'.$new_products['products_image']). '</a></td>
					    <td class="tabnovinka" valign="top" align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '"><i>' . $new_products['manufacturers_name'] . '</i><br /><b>' . $new_products['products_name'] .'</b></a><br />'
			                    . tep_flatten_product_description($new_products['products_description'],  ' <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">' . TEXT_MORE . '</a>') . '<br />
                                           <s>'. round(((tep_get_tax_rate($new_products['products_tax_class_id'])+100)/100) * $new_products['products_price']) .'Kč</s>&nbsp;<b>' . $currencies->display_price($new_products['products_id'], $new_products['products_price'], tep_get_tax_rate($new_products['products_tax_class_id'])) . '</b> '. $pdl1 . $pdl2 . $dotisk . '</td></tr>');


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

?>
</table>