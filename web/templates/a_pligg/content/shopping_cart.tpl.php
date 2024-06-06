<?php echo tep_draw_form('cart_quantity', tep_href_link(FILENAME_SHOPPING_CART, 'action=update_product')); ?>
<h1 class="pageHeading">
  <?php echo tep_image_2ma_template(bts_select(images, 'table_background_cart.png'), HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php echo HEADING_TITLE; ?>
</h1> <br />
<?php
  if ($cart->count_contents() > 0) {

    $info_box_contents = array();
/*
    $info_box_contents[0][] = array('params' => 'class="Venticinque"',
                                    'text' => TABLE_HEADING_REMOVE);
    $info_box_contents[0][] = array('params' => 'class="Venticinque"',
                                    'text' => TABLE_HEADING_PRODUCTS);
    $info_box_contents[0][] = array('params' => 'class="Venticinque"',
                                    'text' => TABLE_HEADING_QUANTITY);
    $info_box_contents[0][] = array('params' => 'class="Venticinque"',
                                    'text' => TABLE_HEADING_TOTAL);
*/
    $info_box_contents[0][] = array('params' => 'class="Table_templateClear"',
                                    'text' => '<br />');
    $any_out_of_stock = 0;
    $products = $cart->get_products();
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
// Push all attributes information in an array
      if (isset($products[$i]['attributes']) && is_array($products[$i]['attributes'])) {
        while (list($option, $value) = each($products[$i]['attributes'])) {
          echo tep_draw_hidden_field('id[' . $products[$i]['id'] . '][' . $option . ']', $value);
          $attributes = tep_db_query("select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix
                                      from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa
                                      where pa.products_id = '" . (int)$products[$i]['id'] . "'
                                       and pa.options_id = '" . (int)$option . "'
                                       and pa.options_id = popt.products_options_id
                                       and pa.options_values_id = '" . (int)$value . "'
                                       and pa.options_values_id = poval.products_options_values_id
                                       and popt.language_id = '" . (int)$languages_id . "'
                                       and poval.language_id = '" . (int)$languages_id . "'");
          $attributes_values = tep_db_fetch_array($attributes);

          $products[$i][$option]['products_options_name'] = $attributes_values['products_options_name'];
          $products[$i][$option]['options_values_id'] = $value;
          $products[$i][$option]['products_options_values_name'] = $attributes_values['products_options_values_name'];
          $products[$i][$option]['options_values_price'] = $attributes_values['options_values_price'];
          $products[$i][$option]['price_prefix'] = $attributes_values['price_prefix'];
        }
      }
    }

    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
      if (($i/2) == floor($i/2)) {
        $info_box_contents[] = array('params' => '');
      } else {
        $info_box_contents[] = array('params' => '');
      }

      $cur_row = sizeof($info_box_contents) - 1;

      $info_box_contents[$cur_row][] = array('params' => ' class="Venticinque2" ',
                                             'text' => tep_draw_checkbox_field_label(TABLE_HEADING_REMOVE, 'cart_delete_' 
                                                       . $products[$i]['id'], 'cart_delete[]', $products[$i]['id']));

      $products_name = '<span><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products[$i]['id']) . '">' 
                      . tep_image(DIR_WS_IMAGES . $products[$i]['image'], $products[$i]['name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br />' 
                      . '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products[$i]['id']) . '"><span class="b">' 
                      . $products[$i]['name'] . '</span></a>';
      if (STOCK_CHECK == 'true') {
        $stock_check = tep_check_stock($products[$i]['id'], $products[$i]['quantity']);
        if (tep_not_null($stock_check)) {
          $any_out_of_stock = 1;
          $products_name .= $stock_check;
        }
      }
      if (isset($products[$i]['attributes']) && is_array($products[$i]['attributes'])) {
        reset($products[$i]['attributes']);
        while (list($option, $value) = each($products[$i]['attributes'])) {
          $products_name .= ' - ' . $products[$i][$option]['products_options_name'] . ' ' . $products[$i][$option]['products_options_values_name'];
        }
      }
      $products_name .= '</span>';
      $info_box_contents[$cur_row][] = array('params' => ' class="Venticinque2" ',
                                             'text' => $products_name);
      $info_box_contents[$cur_row][] = array('params' => ' class="qtaCart" ',
                                             'text' => '<label for="qta_' . $products[$i]['id'] . '">' . TEXT_QTA . ' '
                                                       . tep_draw_input_field('cart_quantity[]', $products[$i]['quantity'], 'size="4" id="qta_' 
                                                       . $products[$i]['id'] . '" ') 
                                                       . tep_draw_hidden_field('products_id[]', $products[$i]['id'])
                                                       . '</label>');

      //TotalB2B start
      $info_box_contents[$cur_row][] = array('params' => ' class="toTal" ',
                                             'text' => '<span class="b">' . $currencies->display_price_nodiscount($products[$i]['final_price'], tep_get_tax_rate($products[$i]['tax_class_id']), $products[$i]['quantity']) . '</span>');
      //TotalB2B end

      $info_box_contents[$cur_row][] = array('params' => ' class="Table_templateClear" ',
                                             'text' => '<hr />');
    }
    new productListingBox($info_box_contents);
?>
<br />
<?php
// frase rottura stock
    if ($any_out_of_stock == 1) {
      if (STOCK_ALLOW_CHECKOUT == 'true') {
?>
        <br /><br /><span class="ColorRed"><br /><?php echo OUT_OF_STOCK_CAN_CHECKOUT; ?></span>
<?php
      } else {
?>
        <br /><br /><span class="ColorRed"><br /><?php echo OUT_OF_STOCK_CANT_CHECKOUT; ?></span>
<?php
      }
    }
// fine frase rottura stock
?>

<div class="CinquantaL">
          <?php echo tep_image_submit('button_update_cart.png', IMAGE_BUTTON_UPDATE_CART, 'id="update_cart_button_img"'); ?>
</div>
<?php // inizio prezzo totale
?>
  <div class="CinquantaR">
  <span class="b"><?php echo SUB_TITLE_SUB_TOTAL; ?></span>
<?php
          //TotalB2B start
          global $customer_id;
          $query_price_to_guest = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " WHERE configuration_key = 'ALLOW_GUEST_TO_SEE_PRICES'");
          $query_price_to_guest_result = tep_db_fetch_array($query_price_to_guest);
          if ((($query_price_to_guest_result['configuration_value']=='true') && !(tep_session_is_registered('customer_id'))) || ((tep_session_is_registered('customer_id')))) {
             echo $currencies->format($cart->show_total()); 
          } else {
             echo PRICES_LOGGED_IN_TEXT;
          }
          //TotalB2B end
// fine prezzo totale
?>
</div> <br class="Clear" />
<br />
<div class="CinquantaL">
          <?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT, '', 'NONSSL') . '">' . tep_image_button_tlusty('button_continue_shopping.png', IMAGE_BUTTON_CONTINUE_SHOPPING) . '</a>'; ?>
</div><div class="CinquantaR">
          <?php echo '<a  href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . tep_image_button_tlusty('button_checkout.png', IMAGE_BUTTON_CHECKOUT) . '</a>'; ?>
</div>
<?php
    $initialize_checkout_methods = $payment_modules->checkout_initialization_method();
    if (!empty($initialize_checkout_methods)) {
      echo TEXT_ALTERNATIVE_CHECKOUT_METHODS . '<br />';
      reset($initialize_checkout_methods);
      while (list(, $value) = each($initialize_checkout_methods)) {
      echo $value . '<br />';
      }
    }
  } else {
?>
          <?php new infoBox(array(array('text' => TEXT_CART_EMPTY))); ?><br />
          <?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE) . '</a>'; ?>
<?php
  }
?>
    </form>