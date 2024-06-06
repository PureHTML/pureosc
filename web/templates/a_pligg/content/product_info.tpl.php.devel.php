<?
/*
TODO hledej
//jsp:todo:hack

zobrazeni obraku u clanku vyresit
//jsp:todo:hack nezobrazuji se obrazky

*/

?>

<?php
  if ($product_check['total'] < 1) {
?>
  <?php new infoBox(array(array('text' => TEXT_PRODUCT_NOT_FOUND))); ?> <br />
  <div class="InfoBoxContenent2MA">
  <?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE) . '</a></div>'; ?>

<?php
  } else {
    $product_info_query = tep_db_query("select p.products_id, pd.products_name, pd.products_description, pd.products_description_long, pd.products_description_long2, p.products_dotisk, p.products_model, p.products_quantity, p.products_image, pd.products_url, p.products_price, p.products_length, p.products_width, p.products_height, p.products_codebar, p.products_weight,
                                       p.products_tax_class_id, p.products_date_added, p.products_date_available, unix_timestamp(p.products_date_available) AS unixdate, p.manufacturers_id  from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");

//060417/zepitt/multi images extra
	$product_img_query = tep_db_query("select pi.products_image1, pi.products_image2, pi.products_image3, pi.products_image4, pi.products_image5,	pi.products_image6, pi.products_image7, pi.products_image8, pi.products_image9 FROM ".TABLE_PRODUCTS_IMAGES." pi WHERE pi.products_id = '".(int)$_GET['products_id']."'");
	
	$product_img = tep_db_fetch_array($product_img_query);
//060417/zepitt/multi images extra EOF

    $product_info = tep_db_fetch_array($product_info_query);




//shop2.0brain:new manufacturers_name
$manufacturers_id = $product_info['manufacturers_id'];
$manufacturers_name_q = tep_db_query("SELECT manufacturers_name from manufacturers WHERE manufacturers_id = $manufacturers_id"); 
$manufacturers_name = tep_db_fetch_array($manufacturers_name_q);
$tittleh1 = $manufacturers_name['manufacturers_name'];
if (MANUFACTURERS_TYPE == 'a') {
if (strpos($tittleh1, ',')) {
$tittleh1a = ereg_replace('\,.*','',$tittleh1);
$tittleh1b = ereg_replace('^.*\,','',$tittleh1);
$tittleh1 = $tittleh1b .' ' .  $tittleh1a;
}
$manufacturers_name = $tittleh1;
}  

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jsp:new:update products name / update products_description admin edit
//echo '<pre><div align=left>';  print_r($GLOBALS); exit;
if ((ADMIN_LOGIN==1)  && ($editmode!=''))  include 'jsp/pd_admin_sql.php';



//shop2.0brain new: nelze objednat kdyz je pripravovany produkt
  if ($product_info['unixdate']  >= time()) $upcoming = 1;

//jsp:new:shop level disable mysql snooping
//    tep_db_query("update " . TABLE_PRODUCTS_DESCRIPTION . " set products_viewed = products_viewed+1 where products_id = '" . (int)$_GET['products_id'] . "' and language_id = '" . (int)$languages_id . "'");
    count_store_products_viewed((int)$_GET['products_id']);

    //TotalB2B start
	$product_info['products_price'] = tep_xppp_getproductprice($product_info['products_id']);
    //TotalB2B end

    if ($new_price = tep_get_products_special_price($product_info['products_id'])) {
      
      //TotalB2B start
	  $query_special_prices_hide = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " WHERE configuration_key = 'SPECIAL_PRICES_HIDE'");
      $query_special_prices_hide_result = tep_db_fetch_array($query_special_prices_hide); 
      if ($query_special_prices_hide_result['configuration_value'] == 'true') {
	 	$products_price = '<span class="ColorRed">' . $currencies->display_price_nodiscount($new_price, tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span>'; 
	  } else {
//jsp:old oboji slevy kravina???    $products_price = '<span class="s"> ' . $currencies->display_price($product_info['products_id'], $product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span> <span class="ColorRed">' . $currencies->display_price_nodiscount($new_price, tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span>';
//jsp:new:
	    $products_price = '<span class="ColorRed">' . $currencies->display_price_nodiscount($new_price, tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span>';
	  }
      //TotalB2B end

    } else {
      $products_price = $currencies->display_price($product_info['products_id'], $product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id']));
    }
    if (tep_not_null($product_info['products_model'])) {
      $products_name = $product_info['products_name'] . '<br />[' . $product_info['products_model'] . ']';
    } else {
      $products_name = $product_info['products_name'];
    }
?>
 <h1>
    <?php echo $manufacturers_name. ': ' .$products_name; ?> <br />
 </h1> <br />
<?
//echo '<!--tady:' .ADMIN_LOGIN .'//-->';
//jsp:admin frontend
if (ADMIN_LOGIN==1)include 'jsp/pd_admin.php';
//spustime kosik
echo tep_draw_form('cart_quantity', tep_href_link(FILENAME_PRODUCT_INFO, tep_get_all_get_params(array('action')) . 'action=add_product')); 
?>
<div class="AlignLeft">
<div class="Venticinque2" style="border-right:15px solid white">
<?php
    if (tep_not_null($product_info['products_image'])) {
//jsp:todo:hack nezobrazuji se obrazky
echo '<img src="images/' . $product_info['products_image'] . '" width="180">' ;
}
?>

<?php 
//bog image click stop
//echo '<a href="' . tep_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $product_info['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $product_info['products_image'], addslashes($product_info['products_name']), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, '') . '<br />' . TEXT_CLICK_TO_ENLARGE . '</a><br /><br />'; ?>

<?php
//    }
//060417/zepitt/multi images extra
/// MULTI IMAGE
	for($nb=1; $nb <= NB_IMAGE_EXTRA ; $nb++) {
		$var_products_image = "products_image".$nb;
		if (tep_not_null($product_img[$var_products_image])) {
		?>        
		<?php echo '<a href="' . tep_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $product_info['products_id']) . '">' . tep_image(DIR_WS_IMAGES . "images_extra/" . $product_img[$var_products_image], addslashes($product_info['products_name']), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, '') . '<br />' . TEXT_CLICK_TO_ENLARGE . '</a><br /><br />'; ?>
		<?php
	    }
    }
//060417/zepitt/multi images extra EOF
?>
  </div><div>    <?php 
//echo '<pre>'; print_r($GLOBALS); exit;
//cena bez slevy
//jsp:todo:hack cena se nikdy nezobrazuje
//if ($products_price > 0 && ($currencies->display_price_nodiscount($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) != $products_price)) {
echo '<s>'. $currencies->display_price_nodiscount($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) .
//'</s>&nbsp;&nbsp;<b style="font-size:120%">'. $products_price . '</b> <br />';
//} else {
//echo '<b style="font-size:120%">'. $products_price . '</b> <br />';
//}
//ušetříte: ' . round($currencies->display_price_nodiscount($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) - substr($products_price, 0, 2) . 'Kč'; 

/*
echo 'ušetříte: ' . round($currencies->display_price_nodiscount($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id']))); 
echo 'xxx';
echo round($currencies->display_price($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id']), 1)) . 'Kč'; 
*/
//kosik
if (($upcoming != 1) && ($product_info['products_quantity']>1)) {
?>
 <?php echo '<span style="top:15px;">' . tep_draw_input_field_label(TABLE_HEADING_QUANTITY . ' ', false, 'quantity', '1', 'size="3" maxlength="3"') . '</span> '.  tep_draw_hidden_field('products_id', $product_info['products_id']) . tep_image_submit('button_in_cart.png', IMAGE_BUTTON_IN_CART, 'id="add_cart_button_img"'); ?>
<br />
<?
}
if (tep_not_null($product_info['products_description_long'])) echo '<br /><a style="text-decoration:underline" href="' .$GLOBALS['REDIRECT_URL'] . '#pdl" title="' . $product_info['products_name'] .  '">'. TEXT_PRODUCTS_DESCRIPTION_LONG . '</a><br />';
if (tep_not_null($product_info['products_description_long2'])) echo '<a style="text-decoration:underline" href="' .$GLOBALS['REDIRECT_URL'] .'#pdl2" title="' . $product_info['products_name'].  '">'. TEXT_PRODUCTS_DESCRIPTION_LONG2 . '</a><br />';
?>
<br>


  <?php 

// image for QTY
if ( TRAFFIC_LIGHT == 'true') {
//jsp:orig  if (PRODUCT_LIST_QUANTITY != NULL) {
//jsp:todo:quantity resit prozizorni hack: nepocitame sklad
if (PRODUCT_LIST_QUANTITY != 0) {
               $prod_quantity = $product_info['products_quantity'];
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
    echo TEXT_IN_STOCK . ' ' . $img ;
  }
} 
// image for QTY END
//} else echo 'neni';
?>


</div>
<br class="Clear" />
<br />
<div>
<?php
echo msword_autoclean(stripslashes($product_info['products_description']));

// Points/Rewards system V2.00 BOF
    if ((USE_POINTS_SYSTEM == 'true') && (DISPLAY_POINTS_INFO == 'true')) { // check that the points system is enabled
      if ($new_price = tep_get_products_special_price($product_info['products_id'])) {
        $products_price_points = tep_display_points($new_price, tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span>';
      } else {
        $products_price_points = tep_display_points($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id']));
      }
      $products_points = tep_calc_products_price_points($products_price_points);
      $products_points_value = tep_calc_price_pvalue($products_points);
      if (USE_POINTS_FOR_SPECIALS == 'true' || $new_price == false){
        echo '<p>' . sprintf(TEXT_PRODUCT_POINTS , number_format($products_points,POINTS_DECIMAL_PLACES), $currencies->format($products_points_value)) . '</p>';
      } else {
          echo '<p>' . TEXT_PRODUCT_NO_POINTS . '</p>';
      }
    }
// Points/Rewards system V2.00 EOF


?>
<?php
    $products_attributes_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$_GET['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "'");
    $products_attributes = tep_db_fetch_array($products_attributes_query);
    if ($products_attributes['total'] > 0) {
?>
  <?php echo TEXT_PRODUCT_OPTIONS; ?> <br />
<?php
      $products_options_name_query = tep_db_query("select distinct popt.products_options_id, popt.products_options_name from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$_GET['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "' order by popt.products_options_name");
      while ($products_options_name = tep_db_fetch_array($products_options_name_query)) {
        $products_options_array = array();
        $products_options_query = tep_db_query("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . (int)$_GET['products_id'] . "' and pa.options_id = '" . (int)$products_options_name['products_options_id'] . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '" . (int)$languages_id . "'");
        while ($products_options = tep_db_fetch_array($products_options_query)) {
          $products_options_array[] = array('id' => $products_options['products_options_values_id'], 'text' => $products_options['products_options_values_name']);
          if ($products_options['options_values_price'] != '0') {
            $products_options_array[sizeof($products_options_array)-1]['text'] .= ' (' . $products_options['price_prefix'] . $currencies->display_price($product_info['products_id'], $products_options['options_values_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) .') ';
          }
        }

        if (isset($cart->contents[$_GET['products_id']]['attributes'][$products_options_name['products_options_id']])) {
          $selected_attribute = $cart->contents[$_GET['products_id']]['attributes'][$products_options_name['products_options_id']];
        } else {
          $selected_attribute = false;
        }
?>
  <?php $list_option = $products_options_name['products_options_name']; ?>
  <?php echo tep_draw_pull_down_menu_label($list_option . ' :', $list_option, 'id[' . $products_options_name['products_options_id'] . ']', $products_options_array, $selected_attribute); ?> <br />
<?php
      }
?>
<?php
    }
?>
<?php
//*** <Reviews Mod>
    $reviews_query = tep_db_query("select count(*) as count from " . TABLE_REVIEWS . " where products_id = '" . (int)$_GET['products_id'] . "' and approved = '1' ");
//  $reviews_query = tep_db_query("select count(*) as count from " . TABLE_REVIEWS . " where products_id = '" . (int)$_GET['products_id'] . "'");
//*** </Reviews Mod>
    $reviews = tep_db_fetch_array($reviews_query);
    if ($reviews['count'] > 0) {
?>
  <?php echo TEXT_CURRENT_REVIEWS . ' ' . $reviews['count']; ?> <br />
<?php
    }

    if (tep_not_null($product_info['products_url'])) {

    echo '<a href="http://' .  $product_info['products_url'] . '">' . TEXT_MORE_INFORMATION  . '</a><br /> <br />';
 /*echo sprintf(TEXT_MORE_INFORMATION, tep_href_link(FILENAME_REDIRECT, 'action=url' . SEPARATOR_LINK . 'goto=' . urlencode($product_info['products_url']), 'NONSSL', true, false));*/  


    }
    if ($product_info['products_date_available'] > date('Y-m-d H:i:s')) {
?>
  <?php echo sprintf(TEXT_DATE_AVAILABLE, tep_date_short($product_info['products_date_available'])); ?> <br /><br />
<?php
    } else {
?>
  <?php //shop2.0brain:stop echo sprintf(TEXT_DATE_ADDED, tep_date_long($product_info['products_date_added'])); ?> <br /><br />
<?php
    }

if (($product_info['products_length'] >= '0.01') && ($product_info['products_length'] != null) && 
    ($product_info['products_width'] >= '0.01') && ($product_info['products_width'] != null) && 
    ($product_info['products_height'] >= '0.01') && ($product_info['products_height'] != null)) {
   echo tep_image_2ma(bts_select(images, 'image_dimension.png')) . '<br /><br />';
}

if (($product_info['products_length'] >= '0.01') && ($product_info['products_length'] != null)) {
  echo TEXT_PRODUCTS_LENGTH . ' ' . $product_info['products_length'] . '&nbsp;-&nbsp;' ;
}
if (($product_info['products_width'] >= '0.01') && ($product_info['products_width'] != null)) {
  echo TEXT_PRODUCTS_WIDTH . ' ' . $product_info['products_width'] . '&nbsp;-&nbsp;' ;
}
if (($product_info['products_height'] >= '0.01') && ($product_info['products_height'] != null)) {
  echo TEXT_PRODUCTS_HEIGHT . ' ' . $product_info['products_height'] . '<br /><br />' ;
}
/* shop2.0brain:todo rucne zakazano zobrazovat vahu natvrdo parametr pridat
if (($product_info['products_weight'] >= '0.01') && ($product_info['products_weight'] != null)) {
  echo TEXT_PRODUCTS_WEIGHT . ' ' . $product_info['products_weight'] . '<br /><br />' ;
}
*/
if (($product_info['products_codebar'] != '0') && ($product_info['products_codebar'] != null)) {
?> 
<br />
<?php
  echo TEXT_PRODUCTS_CODEBAR . '<br />' ;
?> <img src="<?php echo 'barcodegen.php?barcode=' . $product_info['products_codebar']; ?>"  alt="Barcode article"/>
<br /><br />
<?php
}
?>
<div class="CinquantaL">
    <?php //shop2.0brain:stop echo '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, tep_get_all_get_params()) . '">' . tep_image_button('button_write_review.png', IMAGE_BUTTON_WRITE_REVIEW) . '</a>'; ?>
</div>

<?php

    if ((USE_CACHE == 'true') && empty($SID)) {
      echo tep_cache_also_purchased(3600);
    } else {
      include(DIR_WS_MODULES . FILENAME_ALSO_PURCHASED_PRODUCTS);
    }
  

/* Optional Related Products (ORP) */
include(DIR_WS_MODULES . FILENAME_RELATED_PRODUCTS); 
//ORP: end


//shop2.0brain:new: ukazka
if (tep_not_null($product_info['products_description_long'])) echo '<a name="pdl"></a><h2>' . TEXT_PRODUCTS_DESCRIPTION_LONG . '</h2>'. stripslashes($product_info['products_description_long']);
//shop2.0brain:new: recenze
if (tep_not_null($product_info['products_description_long2'])) echo '<a name="pdl2"></a><h2>' . TEXT_PRODUCTS_DESCRIPTION_LONG2 . '</h2>'. stripslashes($product_info['products_description_long2']);
echo '</div>';
?>
</div>  </form>
<?php //shop2.0brain:stop include(DIR_WS_MODULES . 'product_reviews_info.php'); 



}
?>