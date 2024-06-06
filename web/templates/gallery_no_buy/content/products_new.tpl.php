<h1 class="pageHeading">
  <?php echo tep_image_2ma_template(bts_select(images, 'table_background_products_new.png'), HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php echo HEADING_TITLE; ?>
</h1><br />
<div class="AlignLeft">
<?php
  $products_new_array = array();
//################## Added Enable / Disable Categories #################"
//  $products_new_query_raw = "select p.products_id, pd.products_name, p.products_image, p.products_price, p.products_tax_class_id, p.products_date_added, m.manufacturers_name from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on (p.manufacturers_id = m.manufacturers_id), " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by p.products_date_added DESC, pd.products_name";
  $products_new_query_raw = "select p.products_id, pd.products_name, p.products_image, p.products_price, p.products_tax_class_id, p.products_date_added, m.manufacturers_name from (" . TABLE_PRODUCTS . " p, " . TABLE_CATEGORIES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c ) left join " . TABLE_MANUFACTURERS . " m on (p.manufacturers_id = m.manufacturers_id) , " . TABLE_PRODUCTS_DESCRIPTION . " pd where c.categories_status=1 and p.products_id = p2c.products_id and c.categories_id = p2c.categories_id and p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by p.products_date_added DESC, pd.products_name";
//################## End Added Enable / Disable Categories #################
  $products_new_split = new splitPageResults($products_new_query_raw, MAX_DISPLAY_PRODUCTS_NEW);
  if (($products_new_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
  <br />
    <?php echo $products_new_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW); ?> - <?php echo TEXT_RESULT_PAGE . ' ' . $products_new_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array(SEPARATOR_LINK . 'page', 'info', 'x', 'y'))); ?> <br />
  <br />
<?php
  }
?>
<?php
  if ($products_new_split->number_of_rows > 0) {
    $products_new_query = tep_db_query($products_new_split->sql_query);
    while ($products_new = tep_db_fetch_array($products_new_query)) {
		
		//TotalB2B start
        $products_new['products_price'] = tep_xppp_getproductprice($products_new['products_id']);
        //TotalB2B end

      if ($new_price = tep_get_products_special_price($products_new['products_id'])) {
		
        //TotalB2B start
		$query_special_prices_hide = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " WHERE configuration_key = 'SPECIAL_PRICES_HIDE'");
        $query_special_prices_hide_result = tep_db_fetch_array($query_special_prices_hide); 
        if ($query_special_prices_hide_result['configuration_value'] == 'true') {
          $products_price = '<span class="ColorRed">' . $currencies->display_price_nodiscount($new_price, tep_get_tax_rate($products_new['products_tax_class_id'])) . '</span>';
	    } else {
          $products_price = '<span class="s"> ' . $currencies->display_price($products_new['products_id'], $products_new['products_price'], tep_get_tax_rate($products_new['products_tax_class_id'])) . '</span> <span class="ColorRed">' . $currencies->display_price_nodiscount($new_price, tep_get_tax_rate($products_new['products_tax_class_id'])) . '</span>';
  	    }
        //TotalB2B end

      } else {
        $products_price = $currencies->display_price($products_new['products_id'], $products_new['products_price'], tep_get_tax_rate($products_new['products_tax_class_id']));
      }
?>
  <?php echo '<div class="Venticinque2"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products_new['products_id']) . '">&nbsp;&nbsp;&nbsp;' 
             . tep_image(DIR_WS_IMAGES . $products_new['products_image'], $products_new['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></div>'; ?>
  <?php echo '<a class="ColorSpan" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products_new['products_id']) . '">' 
             . $products_new['products_name'] . '</a><br />' . TEXT_DATE_ADDED . ' ' . tep_date_long($products_new['products_date_added']) . ' - ' 
             . TEXT_MANUFACTURER . ' ' . $products_new['manufacturers_name'] . '' . TEXT_PRICE . ' ' . $products_price; ?>
  <?php echo '<br class="Clear" /><br />'; ?>
<br />
<?php
    }
  } else {
?>
  <?php echo TEXT_NO_NEW_PRODUCTS; ?> <br />
<?php
  }
?>
<?php
  if (($products_new_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
<br />
  <div class="InfoBoxContenent2MA">
  <?php echo $products_new_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW); ?> <br />
  <br />
  <?php echo TEXT_RESULT_PAGE . ' ' . $products_new_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?> <br />
  <br />
  </div>
<?php
  }
?>
</div>