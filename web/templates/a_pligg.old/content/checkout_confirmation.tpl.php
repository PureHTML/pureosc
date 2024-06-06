<h1 class="pageHeading">
  <?php echo tep_image_2ma_template(bts_select(images, 'table_background_confirmation.png'), HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php echo HEADING_TITLE; ?>
</h1> <br /> 
<div class="AlignLeft">
<?php
  if ($sendto != false) {
?>
  <?php 
  /*
  //jsp:orignal bez pwa
  echo '<h2 class="b">' . HEADING_DELIVERY_ADDRESS . '</h2><div class="InfoBoxContenent2MA">'
             . '<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL') . '">'
             . '<span class="orderEdit">(' . TEXT_EDIT . ')</span></a>';
             */
             //jsp:pwa
             echo '<h2 class="b">' . HEADING_DELIVERY_ADDRESS . '</h2>' . (((! tep_session_is_registered('customer_is_guest')) || (defined('PURCHASE_WITHOUT_ACCOUNT_SEPARATE_SHIPPING') && PURCHASE_WITHOUT_ACCOUNT_SEPARATE_SHIPPING=='yes') )? ' <a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL') . '"><span class="orderEdit">(' . TEXT_EDIT . ')</span></a>':'');
             ?>
             <br />
  <?php echo tep_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', ' - '); ?> </div>
<?php
    if ($order->info['shipping_method']) {

  echo '<h2 class="b">' . HEADING_SHIPPING_METHOD . '</h2> <div class="InfoBoxContenent2MA">'
       . '<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">'
       . '<span class="orderEdit">(' . TEXT_EDIT . ')</span></a>'; ?> <br />
  <?php echo $order->info['shipping_method']; ?> </div>
<?php
    }
?>
<?php
  }

  if (sizeof($order->info['tax_groups']) > 1) {

  echo '<h2 class="b">' . HEADING_PRODUCTS . '</h2> <div class="InfoBoxContenent2MA">'
       . '<a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">'
       . '<span class="orderEdit">(' . TEXT_EDIT . ')</span></a>'; ?><br />
  <span class="b"><?php echo HEADING_TAX; ?></span><br />
  <span class="b"><?php echo HEADING_TOTAL; ?></span><br />
<?php
  } else {

  echo '<h2 class="b">' . HEADING_PRODUCTS . '</h2> <div class="InfoBoxContenent2MA">'
       . '<a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">'
       . '<span class="orderEdit">(' . TEXT_EDIT . ')</span></a>'; ?><br />
<?php
  }
  for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
    echo $order->products[$i]['qty'] . '&nbsp;x&nbsp;' . $order->products[$i]['name'];

    if (STOCK_CHECK == 'true') {
      echo tep_check_stock($order->products[$i]['id'], $order->products[$i]['qty']);
    }
    if ( (isset($order->products[$i]['attributes'])) && (sizeof($order->products[$i]['attributes']) > 0) ) {
      for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
        echo ' - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'];
      }
    }

    if (sizeof($order->info['tax_groups']) > 1) echo ' - ' . tep_display_tax_value($order->products[$i]['tax']) . '%';

	//TotalB2B start
    echo ' - ' . $currencies->display_price_nodiscount($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']) . '<br />' ;
//  echo $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']) . '' . "\n" ;
    //TotalB2B end

  }
?>
  </div>
  <h2 class="b"><?php echo HEADING_BILLING_INFORMATION; ?></h2>
  <div class="InfoBoxContenent2MA">
  <?php 
  //jsp:orig echo '<h3 class="b">' . HEADING_BILLING_ADDRESS . '</h3> <a href="' . tep_href_link(FILENAME_CHECKOUT_PAYMENT_ADDRESS, '', 'SSL') . '"><span class="orderEdit">(' . TEXT_EDIT . ')</span></a>'; 
  //jsp:pwa
  <a href="' . ((tep_session_is_registered('customer_is_guest'))?tep_href_link(FILENAME_CREATE_ACCOUNT, 'guest=guest', 'SSL'):tep_href_link(FILENAME_CHECKOUT_PAYMENT_ADDRESS, '', 'SSL')) . '"><span class="orderEdit">(' . TEXT_EDIT . ')</span></a>';
  ?> <br />
  <?php echo tep_address_format($order->billing['format_id'], $order->billing, 1, ' ', ' - '); ?>


  <?php echo '<h3 class="b">' . HEADING_PAYMENT_METHOD . '</h3> <a href="' . tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL') . '">'
             . '<span class="orderEdit">(' . TEXT_EDIT . ')</span></a><br />'; ?>
  <?php echo $order->info['payment_method']; ?> <br />

<?php
  if (MODULE_ORDER_TOTAL_INSTALLED) {
    echo $order_total_modules->output();
  }
?>
<?php
  if (is_array($payment_modules->modules)) {
    if ($confirmation = $payment_modules->confirmation()) {
?>
 <br />
 <span class="b"><?php echo HEADING_PAYMENT_INFORMATION; ?></span><br />
  <?php echo $confirmation['title']; ?> <br />
<?php
      for ($i=0, $n=sizeof($confirmation['fields']); $i<$n; $i++) {
?>
  <?php echo $confirmation['fields'][$i]['title']; ?><br />
  <?php echo $confirmation['fields'][$i]['field']; ?><br />
<?php
      }

    }
  }

  if (tep_not_null($order->info['comments'])) {
?>
  <?php echo '<h3 class="b">' . HEADING_ORDER_COMMENTS . '</h3> <a href="' . tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL') . '"><span class="orderEdit">(' . TEXT_EDIT . ')</span></a>'; ?> <br />
  
  <?php echo nl2br(tep_output_string_protected($order->info['comments'])) . tep_draw_hidden_field('comments', $order->info['comments']); ?>
 <br />
<?php
  }
?>
  </div>
<?php
  if (isset($$payment->form_action_url)) {
    $form_action_url = $$payment->form_action_url;
  } else {
    $form_action_url = tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL');
  }

  echo tep_draw_form('checkout_confirmation', $form_action_url, 'post');
  echo tep_draw_hidden_field('gv_redeem_code', $_POST['gv_redeem_code']); 

  if (is_array($payment_modules->modules)) {
    echo $payment_modules->process_button();
  }
  echo '<br />' . tep_image_submit('button_confirm_order.png', IMAGE_BUTTON_CONFIRM_ORDER, 'id="confirm"') . '</form>';
?>
</div>
  <br /><br />
  <?php echo tep_draw_separator('pixel_silver.png', '100%', '1'); ?>
  <?php echo '<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '" class="checkoutBarFrom">' . CHECKOUT_BAR_DELIVERY . '</a>  -  '; ?>
  <?php echo '<a href="' . tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL') . '" class="checkoutBarFrom">' . CHECKOUT_BAR_PAYMENT . '</a>  -  '; ?>
  <span class="checkoutBarCurrent">
  <?php echo tep_image_2ma(DIR_WS_IMAGES . 'checkout_bullet.png') . ' '; ?>
  <?php echo CHECKOUT_BAR_CONFIRMATION . '  -  '; ?>
  </span>    
  <span class="checkoutBarTo">      
  <?php echo CHECKOUT_BAR_FINISHED; ?> 
  </span>
  <?php echo tep_draw_separator('pixel_silver.png', '100%', '1'); ?>
  <br />  
