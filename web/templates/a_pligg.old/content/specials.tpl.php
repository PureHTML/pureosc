<h1 class="categoriesH1">
  <?php //echo tep_image_2ma_template(bts_select(images, 'table_background_specials.png'), HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php echo BOX_HEADING_SPECIALS; ?>
</h1> <br /><br />
<?php //new infoBoxHeading(array(array('text' => BOX_HEADING_SPECIALS))); ?> 
<div class="InfoBoxContenent2MA">
<?php
// ####################### Added Categories Enable / Disable ###############
  //$specials_query_raw = "select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and s.products_id = p.products_id and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' order by s.specials_date_added DESC";
  //TotalB2B start
  if (!isset($customer_id)) $customer_id = 0;
    $customer_group = tep_get_customers_groups_id();
//  $specials_query_raw = "select          p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s, " . TABLE_CATEGORIES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where c.categories_status='1' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and p.products_status = '1' and p.products_id = s.products_id and pd.products_id = s.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1'                                                                                                                                                                                                                           order by s.specials_date_added DESC";
    $specials_query_raw = "select DISTINCT p.products_id, pd.products_description, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s, " . TABLE_CATEGORIES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where c.categories_status='1' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and p.products_status = '1' and p.products_id = s.products_id and pd.products_id = s.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' and ((s.customers_id = '" . $customer_id . "' and s.customers_groups_id = '0') or (s.customers_id = '0' and s.customers_groups_id = '" . $customer_group . "') or (s.customers_id = '0' and s.customers_groups_id = '0')) order by p.products_last_modified DESC";
  //TotalB2B end
// ####################### End Categories Enable / Disable ###############

  $specials_split = new splitPageResults($specials_query_raw, MAX_DISPLAY_SPECIAL_PRODUCTS);

  if (($specials_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
  <?php echo $specials_split->display_count(TEXT_DISPLAY_NUMBER_OF_SPECIALS); ?> - <?php echo TEXT_RESULT_PAGE . ' ' . $specials_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?> <br />
<?php
  }
?>
<div>
<?php
    $row = 0;
    $specials_query = tep_db_query($specials_split->sql_query);
    while ($specials = tep_db_fetch_array($specials_query)) {
      $row++;

	  //TotalB2B start
      $specials['products_price'] = tep_xppp_getproductprice($specials['products_id']);
      //TotalB2B end
      //TotalB2B start
	  $specials['specials_new_products_price'] = tep_get_products_special_price($specials['products_id']);
	  $query_special_prices_hide = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " WHERE configuration_key = 'SPECIAL_PRICES_HIDE'");
      $query_special_prices_hide_result = tep_db_fetch_array($query_special_prices_hide); 
      if ($query_special_prices_hide_result['configuration_value'] == 'true') {
        echo '  <div class="TrentaTre"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $specials['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $specials['products_image'], $specials['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br /><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $specials['products_id']) . '"><b>' . $specials['products_name'] . '</b></a><br /><span class="ColorRed">' . $currencies->display_price_nodiscount($specials['specials_new_products_price'], tep_get_tax_rate($specials['products_tax_class_id'])) . '</span></div>' . "\n";
	  } else {
        echo '<div class="Venticinque2"><table><tr><td><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $specials['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $specials['products_image'], $specials['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><td/><td><a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $specials['products_id']) . '"><b>' . $specials['products_name'] . '</b></a>
<br />'. tep_flatten_product_description($specials['products_description'],  ' <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $specials['products_id']) . '">' . TEXT_MORE . '</a>') . 
'<br /><span class="s">' . $currencies->display_price($specials['products_id'], $specials['products_price'], tep_get_tax_rate($specials['products_tax_class_id'])) . '</span> <span class="ColorRed">' . $currencies->display_price_nodiscount($specials['specials_new_products_price'], tep_get_tax_rate($specials['products_tax_class_id'])) . '</span>&nbsp;<a class="n" href="/shopping_cart.php?action=buy_now&amp;products_id=' . $specials['products_id'] . '">'  . tep_image_button('button_buy_now.png', IMAGE_BUTTON_BUY_NOW) . '</a></td></tr></table></div>' . "\n";
	  }
      //TotalB2B end

      if ((($row / 1) == floor($row / 1))) {
?>
      </div><div class="Table_templateClear"> <br /> </div><div>
<?php
      }
    }
?>
   </div><div class="Table_templateClear"> <br /> </div>
<?php
  if (($specials_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
<br /> 
    <?php echo $specials_split->display_count(TEXT_DISPLAY_NUMBER_OF_SPECIALS); ?> - <?php echo TEXT_RESULT_PAGE . ' ' . $specials_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?> <br />
<?php
  }
?> </div>