<div class="bp">
<h1 class="pageHeading">
  <?php //echo '<pre>'; print_r($GLOBALS); exit;

//echo tep_image_2ma_template(bts_select(images, 'table_background_payment.png'), HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php echo HEADING_TITLE; ?>
</h1> <br />
<?php
//  if (isset($_GET['payment_error']) && is_object(${$_GET['payment_error']}) && ($error = ${$_GET['payment_error']}->get_error()))
  {
?>
  <span class="b"><?php echo tep_output_string_protected($error['title']); ?></span> <br />
  <div class="InfoBoxContenent2MA">
  <?php echo tep_output_string_protected($error['error']); ?>
  </div> <br />
<?php
  }
?>
<?php // #################### Begin Added CGV JONYO ###################### ?>
<div class="AlignLeft">
    <h2 class="b"><?php echo HEADING_PRODUCTS; ?></h2>
    <div class="InfoBoxContenent2MA"> 
    <?php  echo ' <a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '"><span class="orderEdit">(' . TEXT_EDIT . ')</span></a><br />';

 for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
   echo $order->products[$i]['qty'] . ' x ' . $order->products[$i]['name'];

   if (STOCK_CHECK == 'true') {
     echo tep_check_stock($order->products[$i]['id'], $order->products[$i]['qty']);
   }

   if ( (isset($order->products[$i]['attributes'])) && (sizeof($order->products[$i]['attributes']) > 0) ) {
     for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
       echo ' - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'];
     }
   }
   
   echo '<br />';

 }
 ?>
 <?php
 if (MODULE_ORDER_TOTAL_INSTALLED) {
   echo $order_total_modules->output();
 }
 ?></div>
<?php // #################### End Added CGV JONYO ###################### ?>

  <h2 class="b"><?php echo TABLE_HEADING_BILLING_ADDRESS; ?></h2>
  <div class="InfoBoxContenent2MA">
  <?php echo TEXT_SELECTED_BILLING_DESTINATION; ?><br /><br /><?php echo '<a class="n" href="' . tep_href_link(FILENAME_CHECKOUT_PAYMENT_ADDRESS, '', 'SSL') . '">' . tep_image_button('button_change_address.png', IMAGE_BUTTON_CHANGE_ADDRESS) . '</a>'; ?> 
  <span class="b">
  <?php echo TITLE_BILLING_ADDRESS; ?></span><br /><br /><?php echo tep_image_2ma(bts_select(images, 'arrow_south_east.png')) . ' ';
  echo tep_address_label($customer_id, $billto, true, ' ', ' - '); ?> 
  </div> <br />
  
<?php // #################### Added CGV ###################### 
  echo $order_total_modules->credit_selection();//ICW ADDED FOR CREDIT CLASS SYSTEM
 // #################### End Added CGV ###################### 

  echo tep_draw_form('checkout_payment', tep_href_link(FILENAME_CHECKOUT_CONFIRMATION, '', 'SSL'), 'post', 'onsubmit="return check_form();"'); 
////////////////////////////////////////jsp: formular nagrazen staticky kodem viz  checkout_payment.tpl.php.js-verze
//    echo tep_draw_form('checkout_payment', tep_href_link(FILENAME_CHECKOUT_CONFIRMATION, '', 'SSL'), 'post', '');
?>


<?//konec rucne vlozeneho kodu - viz checkout_payment.tpl.php.js-verze ?>
  </div>
<!-- Points/Rewards Module V2.00 Redeemption box bof -->

<?php
   $orders_total = tep_count_customer_orders();

  if ((USE_POINTS_SYSTEM == 'true') && (USE_REDEEM_SYSTEM == 'true')) {
    echo points_selection();
	
  }
?>
<!-- Points/Rewards Module V2.00 Redeemption box eof -->

<br />
  <h2 class="b"><?php echo TABLE_HEADING_COMMENTS; ?></h2>
  <div class="InfoBoxContenent2MA">
  <?php echo tep_draw_textarea_field('comments', '60', '5', $comments); ?>
  </div> <br />
  <span class="b"><?php echo TITLE_CONTINUE_CHECKOUT_PROCEDURE . ' ' . TEXT_CONTINUE_CHECKOUT_PROCEDURE . '</span>'; ?> <br /><br />

  <?php echo tep_image_submit('button_continue.png', IMAGE_BUTTON_CONTINUE, 'id="continue"'); ?>
  </form>
<?

if ($order->info['shipping_method']=='Poštou - platba převodem (Poštou platba převodem)') {
echo '<input type=hidden name=payment value=moneyorder>';
} else {
echo '<input type=hidden name=payment value=cod>';
}
//echo '<pre>';  print_r($GLOBALS); exit;

?>


  <br />
  <?php echo tep_draw_separator('pixel_silver.png', '100%', '1'); ?>
  <?php echo '<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '" class="checkoutBarFrom">' . CHECKOUT_BAR_DELIVERY . '</a>  -  '; ?>
  <span class="checkoutBarCurrent">
  <?php echo tep_image_2ma(DIR_WS_IMAGES . 'checkout_bullet.png') . ' '; ?>
  <?php echo CHECKOUT_BAR_PAYMENT . '  -  '; ?>
  </span>  
  <span class="checkoutBarTo">    
  <?php echo CHECKOUT_BAR_CONFIRMATION . '  -  '; ?>
  <?php echo CHECKOUT_BAR_FINISHED; ?> 
  </span>
  <?php echo tep_draw_separator('pixel_silver.png', '100%', '1'); 
  ?>
  </div>