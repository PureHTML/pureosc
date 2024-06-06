<?php
//TODO
//jsp:todo:hack upravit zobrazeni ceny - ted se neukazuje nikdy


/*
  shop2.0brain:version 0.1
  $Id: product_listing.php,v 1.44 2003/06/09 22:49:59 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  $listing_split = new splitPageResults($listing_sql, MAX_DISPLAY_SEARCH_RESULTS, 'p.products_id');

  if ( ($listing_split->number_of_rows > 0) && ( (PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3') ) ) {
?>
    <br /> <?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?> - 
    <?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?>
    <br />
<?php
  }

  $list_box_contents = array();

  for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
    switch ($column_list[$col]) {
      case 'PRODUCT_LIST_MODEL':
        $lc_text = TABLE_HEADING_MODEL;
        break;
      case 'PRODUCT_LIST_NAME':
        $lc_text = TABLE_HEADING_PRODUCTS;
        break;
      case 'PRODUCT_LIST_MANUFACTURER':
        $lc_text = TABLE_HEADING_MANUFACTURER;
        break;
      case 'PRODUCT_LIST_PRICE':
        $lc_text = TABLE_HEADING_PRICE;
        break;
      case 'PRODUCT_LIST_QUANTITY':
        $lc_text = TABLE_HEADING_QUANTITY;
        break;
      case 'PRODUCT_LIST_WEIGHT':
        $lc_text = TABLE_HEADING_WEIGHT;
        break;
      case 'PRODUCT_LIST_IMAGE':
        $lc_text = '&nbsp;<br />&nbsp;';
        break;
      case 'PRODUCT_LIST_BUY_NOW':
        $lc_text = TABLE_HEADING_BUY_NOW;
        break;
    }

    if ( ($column_list[$col] != 'PRODUCT_LIST_BUY_NOW') && ($column_list[$col] != 'PRODUCT_LIST_IMAGE') ) {
      $lc_text = tep_create_sort_heading($_GET['sort'], $col+1, $lc_text);
    }
/*
if ($lc_text == TABLE_HEADING_BUY_NOW)  { 
    $list_box_contents[0][] = array('params' => 'class="Clear"',
                                    'text' => '&nbsp;'); 
} else { 
    $list_box_contents[0][] = array('params' => 'class="Product_listingProductListing-heading"',
                                    'text' => $lc_text);
}
*/
  }

  if ($listing_split->number_of_rows > 0) {
    $rows = 0;
    $listing_query = tep_db_query($listing_split->sql_query);
    while ($listing = tep_db_fetch_array($listing_query)) {
    $pdl1 = '';
    $pdl2 = '';
    $dotisk = '';
//shop2.0brain:new ukazka, recenze, dotisk, koupit za podminky ze neni pripravovane
if ($listing['products_description_long']) $pdl1 = '<a class="r" href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . SEPARATOR_LINK : '') . 'products_id=' . $listing['products_id']) . '#pdl">' . BUTTON_PRODUCTS_DESCRIPTION_LONG.'</a>';
if ($listing['products_description_long2']) $pdl2 = '<a class="r" href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . SEPARATOR_LINK : '') . 'products_id=' . $listing['products_id']) . '#pdl2">'. TEXT_PRODUCTS_DESCRIPTION_LONG2 .'</a>';
if ($listing['products_dotisk']) $dotisk = '<span class="dotisk">'. TEXT_PRODUCTS_DESCRIPTION_DOTISK .'</span>';


      $rows++;

      if (($rows/2) == floor($rows/2)) {
        $list_box_contents[] = array('params' => 'class="productListing-even"');
      } else {
        $list_box_contents[] = array('params' => 'class="productListing-odd"');
      }

      $cur_row = sizeof($list_box_contents) - 1;

      for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {


        switch ($column_list[$col]) {
          case 'PRODUCT_LIST_MODEL':
            $lc_text = '<br />&nbsp;' . $listing['products_model'] . '&nbsp;<br /><br />';
            break;
          case 'PRODUCT_LIST_NAME':
            if (isset($_GET['manufacturers_id'])) {
              $lc_text = '<br /><div class="prod_desc">'. $dotisk . '<strong><a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'manufacturers_id=' . $_GET['manufacturers_id'] . SEPARATOR_LINK . 'products_id=' . $listing['products_id']) . '">' . $listing['products_name'] . '</a></strong><br />'. tep_flatten_product_description($listing['products_description'],  ' <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $listing['products_id']) . '">' . TEXT_MORE . '</a>') . '</div>';
            } else {
              $lc_text = '<div class="prod_desc">'. $dotisk . '<strong><a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . SEPARATOR_LINK : '') . 'products_id=' . $listing['products_id']) . '">' . $listing['products_name'] . '</a></strong>&nbsp;<br />'. tep_flatten_product_description($listing['products_description'],  ' <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $listing['products_id']) . '">' . TEXT_MORE . '</a>') . '</div>';
            }
            break;
          case 'PRODUCT_LIST_MANUFACTURER':
		if (MANUFACTURERS_TYPE == 'a') {
		$tittleh1 = $listing['manufacturers_name'];
		if (strpos($tittleh1, ',')) {
		$tittleh1a = ereg_replace('\,.*','',$tittleh1);
		$tittleh1b = ereg_replace('^.*\,','',$tittleh1);
		$tittleh1 = $tittleh1b .' ' .  $tittleh1a;
		}
		$listing['manufacturers_name'] = $tittleh1;
		}  

            $lc_text = '<br />&nbsp;<em><a class="n" href="' . tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $listing['manufacturers_id']) . '">' . $listing['manufacturers_name'] . '</a></em>';
            break;
          case 'PRODUCT_LIST_PRICE':
	        if (!$listing['upcoming'] || ($listing['upcoming']  < time())) {

//TotalB2B start
            $listing['products_price'] = tep_xppp_getproductprice($listing['products_id']);
//TotalB2B end

//TotalB2B start
		    if ($new_price = tep_get_products_special_price($listing['products_id'])) {
              $listing['specials_new_products_price'] = $new_price;
			  $query_special_prices_hide = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " WHERE configuration_key = 'SPECIAL_PRICES_HIDE'");
              $query_special_prices_hide_result = tep_db_fetch_array($query_special_prices_hide); 
              if ($query_special_prices_hide_result['configuration_value'] == 'true') {
			    $lc_text = '<br />&nbsp;<span class="ColorRed">' . $currencies->display_price_nodiscount($listing['specials_new_products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</span>&nbsp;<a class="n" href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now' . SEPARATOR_LINK . 'products_id=' . $listing['products_id']) . '">' . tep_image_button('button_buy_now.png', IMAGE_BUTTON_BUY_NOW) . '</a>';
	          } else {
			    $lc_text = '<br />&nbsp;<span class="s">' .  $currencies->display_price_nodiscount($listing['products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</span>&nbsp;<span class="ColorRed">' . $currencies->display_price_nodiscount($listing['specials_new_products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</span>&nbsp;<a class="n" href="/shopping_cart.php?action=buy_now&amp;products_id=' . $listing['products_id'] . '">'  . tep_image_button('button_buy_now.png', IMAGE_BUTTON_BUY_NOW) . '</a>';
	          }
//TotalB2B end

            } else {

		if ($listing['products_quantity']>1) {
              $lc_text = '<div style="padding-left:5px"><s>' . $currencies->display_price_nodiscount($listing['products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</s>
&nbsp;<b>'. $currencies->display_price($listing['products_id'], $listing['products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</b>&nbsp;&nbsp;<a class="n" href="/shopping_cart.php?action=buy_now&amp;products_id=' . $listing['products_id'] . '">' . tep_image_button('button_buy_now.png', IMAGE_BUTTON_BUY_NOW) . '</a>'
. $pdl1 . $pdl2 . '</div>';
		} else {
//jsp:todo:hack upravit zobrazeni ceny
$lc_text = '';
/*              $lc_text = '<div style="padding-left:5px"><s>' . $currencies->display_price_nodiscount($listing['products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</s>
&nbsp;<b>'. $currencies->display_price($listing['products_id'], $listing['products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</b>&nbsp;'
. $pdl1 . $pdl2 . $dotisk . '</div>';
*/
		}
            }
} 	    else $lc_text =  '';
            break;
          case 'PRODUCT_LIST_QUANTITY':

// image for QTY
         if ( TRAFFIC_LIGHT == 'false') {
            $lc_text = '<br />&nbsp;' . $listing['products_quantity'] . '&nbsp;<br /><br />';
             } else {    
                           $prod_quantity = $listing['products_quantity'];
                              $minus = ($prod_quantity <= 0);
                              $red = ($prod_quantity == NULL);
                              $yellow = (($prod_quantity >= TRAFFIC_LIGHT_YELLOW) && ($prod_quantity <= TRAFFIC_LIGHT_GREEN));
                              $green =  ($prod_quantity > TRAFFIC_LIGHT_GREEN );
                            switch ($prod_quantity) { 
                            case $minus: 
                            $img = tep_image(bts_select(images, 'icon_status_red.png'), TEXT_NOT_AVAIBLE) . '&nbsp;&nbsp;' . TEXT_NOT_AVAIBLE ; 
                            break;  
                            case $red: 
                            $img = tep_image(bts_select(images, 'icon_status_red.png'), TEXT_NOT_AVAIBLE) . '&nbsp;&nbsp;' . TEXT_NOT_AVAIBLE ; 
                            break; 
                            case $yellow : 
                            $img = tep_image(bts_select(images, 'icon_status_yellow.png'), TEXT_FEW_QTY) . '&nbsp;&nbsp;' . TEXT_FEW_QTY ; 
                            break;
                            case $green : 
                            $img = tep_image(bts_select(images, 'icon_status_green.png'), TEXT_BIG_QTY) . '&nbsp;&nbsp;' . TEXT_BIG_QTY ; 
                            break; 
                            } 
            $lc_text =  $img ;
            } 
// image for QTY END
            break;        
          case 'PRODUCT_LIST_WEIGHT':
            $lc_text = '<br />&nbsp;' . $listing['products_weight'] . '&nbsp;<br /><br />';
            break;
          case 'PRODUCT_LIST_IMAGE':
            if (isset($_GET['manufacturers_id'])) {
              $lc_text = '<br /><a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'manufacturers_id=' . $_GET['manufacturers_id'] . SEPARATOR_LINK . 'products_id=' . $listing['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $listing['products_image'], $listing['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>';
            } else {
             if ($listing['products_image']=='') $listing['products_image'] = $image;
                 $lc_text = '<br />&nbsp;<a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . SEPARATOR_LINK : '') . 'products_id=' . $listing['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $listing['products_image'], $listing['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>&nbsp;';
            }
            break;
          case 'PRODUCT_LIST_BUY_NOW':
//            $lc_text =  '<div class="InfoBoxContenent2MA"><a class="n" href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now' . SEPARATOR_LINK . 'products_id=' . $listing['products_id']) . '">' . tep_image_button('button_buy_now.png', IMAGE_BUTTON_BUY_NOW) . '</a></div>';
            $lc_text =  '';
            break;
        }        
        
if ($lc_text =='')  { 
        $list_box_contents[$cur_row][] = array('params' => 'class="Clear"',
                                               	'text'  =>  '<br />' ); //jspa hack: orig: $lc_text 
} else { 
        $list_box_contents[$cur_row][] = array('params' => 'class="Venticinque2"',
                                               	'text'  =>  $lc_text );       
 }


      } 
    }

    new productListingBox($list_box_contents);
  } else {
    $list_box_contents = array();

    $list_box_contents[0] = array('params' => 'class="productListing-odd"');
    $list_box_contents[0][] = array('text' => '<br />' . TEXT_NO_PRODUCTS);

    new productListingBox($list_box_contents);
  }

  if ( ($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3')) ) {
?>
  <br />
    <?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?> - 
    <?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?>
  <br /> 
<?php
  }
?>