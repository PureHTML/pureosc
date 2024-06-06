 <h1 class="pageHeading">
  <?php echo tep_image_2ma_template(bts_select(images, 'table_background_account.png'), HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php echo HEADING_TITLE; ?> </h1><br />
<div class="AlignLeft">  
<?php
  if ($messageStack->size('account') > 0) {
?>
  <?php echo $messageStack->output('account'); ?><br />
<?php
  }
  if (tep_count_customer_orders() > 0) {
?>
  <h2 class="b"><?php echo OVERVIEW_TITLE; ?></h2>
  <?php echo '<a class="ColorSpan" href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '">' . OVERVIEW_SHOW_ALL_ORDERS . '</a>'; ?>
  <br /><?php echo tep_image_2ma(bts_select(images, 'arrow_south_east.png')) . '<h3 class="b">' . OVERVIEW_PREVIOUS_ORDERS . '</h3><br />' ; ?>
<?php
    $orders_query = tep_db_query("select o.orders_id, o.date_purchased, o.delivery_name, o.delivery_country, o.billing_name, o.billing_country, ot.text as order_total, s.orders_status_name from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_TOTAL . " ot, " . TABLE_ORDERS_STATUS . " s where o.customers_id = '" . (int)$customer_id . "' and o.orders_id = ot.orders_id and ot.class = 'ot_total' and o.orders_status = s.orders_status_id and s.language_id = '" . (int)$languages_id . "' and s.public_flag = '1' order by orders_id desc limit 3");
    while ($orders = tep_db_fetch_array($orders_query)) {
      if (tep_not_null($orders['delivery_name'])) {
        $order_name = $orders['delivery_name'];
        $order_country = $orders['delivery_country'];
      } else {
        $order_name = $orders['billing_name'];
        $order_country = $orders['billing_country'];
      }
?>
  <div class="InfoBoxContenent2MA">
    <?php echo tep_date_short($orders['date_purchased']); ?>
    <?php echo '#' . $orders['orders_id']; ?>
    <?php echo tep_output_string_protected($order_name) . ', ' . $order_country; ?>
    <?php echo $orders['orders_status_name']; ?>
    <?php echo $orders['order_total']; ?>
    <?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $orders['orders_id'], 'SSL') . '">' . tep_image_button('small_view.png', SMALL_IMAGE_BUTTON_VIEW) . '</a>'; ?>
  </div><br />
<?php
    }
  }
?>

<!--// CCGV ADDED - BEGIN //-->
<?php if ((MODULE_ORDER_TOTAL_GV_STATUS != 'MODULE_ORDER_TOTAL_GV_STATUS') && (MODULE_ORDER_TOTAL_GV_STATUS == true)) { ?>
  <h2 class="b">
 <?php echo tep_image_2ma(bts_select(images, 'account_gv.png')); ?>
  <?php echo GIFT_VOUCHER_COUPON; ?></h2>
  <div class="InfoBoxContenent2MA">
  <?php
  if (tep_session_is_registered('customer_id')) {
    $gv_query = tep_db_query("select amount from " . TABLE_COUPON_GV_CUSTOMER . " where customer_id = '" . $customer_id . "'");
    $gv_result = tep_db_fetch_array($gv_query);
    if ($gv_result['amount'] > 0 ) {
?>
<span class="ColorRed">
  <?php echo CCGV_BALANCE . ' : ' . $currencies->format($gv_result['amount']); ?> <br />
</span>
<?php
}
  }
?>
  <?php echo tep_image_2ma(bts_select(images, 'arrow_green.png')) . ' <a href="' . tep_href_link(FILENAME_GV_SEND, '', 'SSL') . '">' . CCGV_SENDVOUCHER . '</a>'; ?>
  <br />
  <?php echo tep_image_2ma(bts_select(images, 'arrow_green.png')) . ' <a href="' . tep_href_link(FILENAME_GV_FAQ, '', 'SSL') . '">' . CCGV_FAQ . '</a>'; ?>
</div> <br />
<?php 
}
?>
<!--// CCGV ADDED - END//-->

  <h2 class="b">
  <?php echo tep_image_2ma(bts_select(images, 'account_personal.png')); ?>
  <?php echo MY_ACCOUNT_TITLE; ?></h2><br />
    <div class="InfoBoxContenent2MA">
      <?php echo tep_image_2ma(bts_select(images, 'arrow_green.png')) . ' <a href="' . tep_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL') . '">' . MY_ACCOUNT_INFORMATION . '</a>'; ?> <br />
      <?php echo tep_image_2ma(bts_select(images, 'arrow_green.png')) . ' <a href="' . tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL') . '">' . MY_ACCOUNT_ADDRESS_BOOK . '</a>'; ?> <br />
      <?php echo tep_image_2ma(bts_select(images, 'arrow_green.png')) . ' <a href="' . tep_href_link(FILENAME_ACCOUNT_PASSWORD, '', 'SSL') . '">' . MY_ACCOUNT_PASSWORD . '</a>'; ?> <br />
            <?php echo tep_image_2ma(bts_select(images, 'arrow_green.png')) . ' <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '?subject= ' . EMAIL_ACCOUNT_DELETE . '&body= ' . EMAIL_ACCOUNT_DELETE_BODY . '">' . MY_ACCOUNT_DELETE . '</a>'; ?> <br />
    </div><br />
  <h2 class="b">
  <?php echo tep_image_2ma(bts_select(images, 'account_orders.png')); ?>
  <?php echo MY_ORDERS_TITLE; ?></h2>
    <div class="InfoBoxContenent2MA">
      <?php echo tep_image_2ma(bts_select(images, 'arrow_green.png')) . ' <a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '">' . MY_ORDERS_VIEW . '</a>'; ?>
    </div><br />
  <h2 class="b">
  <?php echo tep_image_2ma(bts_select(images, 'account_notifications.png')); ?>
  <?php echo EMAIL_NOTIFICATIONS_TITLE; ?></h2>
  <div class="InfoBoxContenent2MA">
      <?php echo tep_image_2ma(bts_select(images, 'arrow_green.png')) . ' <a href="' . tep_href_link(FILENAME_ACCOUNT_NEWSLETTERS, '', 'SSL') . '">' . EMAIL_NOTIFICATIONS_NEWSLETTERS . '</a>'; ?> <br />
      <?php echo tep_image_2ma(bts_select(images, 'arrow_green.png')) . ' <a href="' . tep_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL') . '">' . EMAIL_NOTIFICATIONS_PRODUCTS . '</a>'; ?>
  </div>
  
<!-- // Points/Rewards Module V2.00 points_system_box_bof //-->
<?php 	
    if (USE_POINTS_SYSTEM == 'true') { // check that the points system is enabled
?> <br />
     <h2 class="b">
     <?php echo tep_image_2ma(bts_select(images, 'money.png')); ?>
     <?php echo MY_POINTS_TITLE; ?></h2>
<?php
  $shopping_points = tep_get_shopping_points();
  if ($shopping_points > 0) {
?>
    <?php echo tep_image_2ma(bts_select(images, 'indicator.png')) .'&nbsp;&nbsp;'.  sprintf(MY_POINTS_CURRENT_BALANCE, number_format($shopping_points,POINTS_DECIMAL_PLACES),$currencies->format(tep_calc_shopping_pvalue($shopping_points))); ?> 
<br />
<?php
  }
?> <div class="InfoBoxContenent2MA">
    <?php echo tep_image_2ma(bts_select(images, 'arrow_green.png')) . ' <a href="' . tep_href_link(FILENAME_MY_POINTS, '', 'SSL') . '">' . MY_POINTS_VIEW . '</a>'; ?> <br />
    <?php echo tep_image_2ma(bts_select(images, 'arrow_green.png')) . ' <a href="' . tep_href_link(FILENAME_MY_POINTS_HELP, '', 'SSL') . '">' . MY_POINTS_VIEW_HELP . '</a>'; ?>
   </div>
<?php 
  }// else do not show points_system_box
?>
<!-- // Points/Rewards Module V2.00 points_system_box_eof //-->
<br />  
</div>