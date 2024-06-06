<h1 class="pageHeading">
  <?php echo tep_image_2ma_template(bts_select(images, 'table_background_history.png'), HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php echo HEADING_TITLE; ?>
</h1> <br /> 
<div class="AlignLeft">
  <h2 class="b"><?php echo sprintf(HEADING_ORDER_NUMBER, $_GET['order_id']) . ' (' . $order->info['orders_status'] . ')'; ?></h2>
  <?php echo HEADING_ORDER_DATE . ' ' . tep_date_long($order->info['date_purchased']); ?> &nbsp;-&nbsp;
  <?php echo HEADING_ORDER_TOTAL . ' ' . $order->info['total']; ?> <br />

  <h3 class="b"><?php echo HEADING_DELIVERY_ADDRESS; ?></h3>
  <div class="InfoBoxContenent2MA">
<?php
  if ($order->delivery != false) {
?>
  <?php echo tep_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br />'); ?>
<?php
    if (tep_not_null($order->info['shipping_method'])) {
?>
  </div> 
  
  <h3 class="b"><?php echo HEADING_SHIPPING_METHOD; ?></h3>  
  <div class="InfoBoxContenent2MA">
  <?php echo $order->info['shipping_method']; ?>
<?php
    }
?>
<?php
  }
?>
  </div> 
  
  <h3 class="b"><?php echo HEADING_PRODUCTS; ?></h3> 
  <div class="InfoBoxContenent2MA">
<?php
  if (sizeof($order->info['tax_groups']) > 1) {
?>
  <span class="b"><?php echo HEADING_TAX; ?></span> - <span class="b"><?php echo HEADING_TOTAL; ?></span>
<?php
  } 
  for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
    echo $order->products[$i]['qty'] . '&nbsp;x&nbsp;' . $order->products[$i]['name'];

    if ( (isset($order->products[$i]['attributes'])) && (sizeof($order->products[$i]['attributes']) > 0) ) {
      for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
        echo '&nbsp; - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'];
      }
    }
    echo '&nbsp;' . "\n";
    if (sizeof($order->info['tax_groups']) > 1) {
      echo tep_display_tax_value($order->products[$i]['tax']) . '% &nbsp,' . "\n";
    }
    echo $currencies->format(tep_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']) * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']);
  }
?>
  </div> 
  
  
  <h3 class="b"><?php echo HEADING_BILLING_INFORMATION; ?></h3>
  <div class="InfoBoxContenent2MA">
  <h4 class="b"><?php echo HEADING_BILLING_ADDRESS; ?></h4>
<?php echo tep_address_format($order->billing['format_id'], $order->billing, 1, ' ', '<br />'); ?>
  </div> <br /> 
  
  <div class="InfoBoxContenent2MA">
<h4 class="b"><?php echo HEADING_PAYMENT_METHOD; ?></h4> 
<?php echo $order->info['payment_method']; ?> 
<?php
  for ($i=0, $n=sizeof($order->totals); $i<$n; $i++) {
    echo $order->totals[$i]['title'] . '&nbsp;' . $order->totals[$i]['text'] . '<br />' ;
  }
?>
  </div> 
  <h3 class="b"><?php echo HEADING_ORDER_HISTORY; ?></h3>  
  <div class="InfoBoxContenent2MA">

  

<?php
  $statuses_query = tep_db_query("select os.orders_status_name, osh.date_added, osh.comments from " . TABLE_ORDERS_STATUS . " os, " . TABLE_ORDERS_STATUS_HISTORY . " osh where osh.orders_id = '" . (int)$_GET['order_id'] . "' and osh.orders_status_id = os.orders_status_id and os.language_id = '" . (int)$languages_id . "' and os.public_flag = '1' order by osh.date_added");
  while ($statuses = tep_db_fetch_array($statuses_query)) {
    echo tep_date_short($statuses['date_added']) . '&nbsp;-&nbsp;' . $statuses['orders_status_name'] . '<br />' 
                       . (empty($statuses['comments']) ? '&nbsp;' : nl2br(tep_output_string_protected($statuses['comments'])));
  }
?>
<?php
  if (DOWNLOAD_ENABLED == 'true') include(DIR_WS_MODULES . 'downloads.php');
?>
  </div> <br />


  <?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, tep_get_all_get_params(array('order_id')), 'SSL') . '">' . tep_image_button('button_back.png', IMAGE_BUTTON_BACK) . '</a>'; 
?></div>