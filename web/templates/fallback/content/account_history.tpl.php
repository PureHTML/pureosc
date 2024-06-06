<h1 class="pageHeading">
  <?php echo tep_image_2ma_template(bts_select(images, 'table_background_history.png'), HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php echo HEADING_TITLE; ?>
</h1> <br />
<?php
  $orders_total = tep_count_customer_orders();

  if ($orders_total > 0) {
    $history_query_raw = "select o.orders_id, o.date_purchased, o.delivery_name, o.billing_name, ot.text as order_total, s.orders_status_name from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_TOTAL . " ot, " . TABLE_ORDERS_STATUS . " s where o.customers_id = '" . (int)$customer_id . "' and o.orders_id = ot.orders_id and ot.class = 'ot_total' and o.orders_status = s.orders_status_id and s.language_id = '" . (int)$languages_id . "' and s.public_flag = '1' order by orders_id DESC";
    $history_split = new splitPageResults($history_query_raw, MAX_DISPLAY_ORDER_HISTORY);
    $history_query = tep_db_query($history_split->sql_query);

    while ($history = tep_db_fetch_array($history_query)) {
      $products_query = tep_db_query("select count(*) as count from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$history['orders_id'] . "'");
      $products = tep_db_fetch_array($products_query);

      if (tep_not_null($history['delivery_name'])) {
        $order_type = TEXT_ORDER_SHIPPED_TO;
        $order_name = $history['delivery_name'];
      } else {
        $order_type = TEXT_ORDER_BILLED_TO;
        $order_name = $history['billing_name'];
      }
?>
  <?php echo '<h2 class="b">' . TEXT_ORDER_NUMBER  . $history['orders_id'] . '</h2> '; ?> 
  <div class="InfoBoxContenent2MA">
    <?php echo '<span class="b">' . TEXT_ORDER_STATUS . '</span> ' . $history['orders_status_name'] . ' - '; ?>
    <?php echo '<span class="b">' . TEXT_ORDER_DATE . '</span> ' . tep_date_long($history['date_purchased']) . ' - <span class="b">' . $order_type . '</span> ' . tep_output_string_protected($order_name) . ' - '; ?>
    <?php echo '<span class="b">' . TEXT_ORDER_PRODUCTS . '</span> ' . $products['count'] . ' - <span class="b">' . TEXT_ORDER_COST . '</span> ' . strip_tags($history['order_total']); ?> <br />
    <?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'order_id=' . $history['orders_id'], 'SSL') . '">' . tep_image_button('small_view.png', SMALL_IMAGE_BUTTON_VIEW) . '</a>'; ?>
  </div> <br />
<?php
    }
  } else {
?>
  <div class="InfoBoxContenent2MA">
    <?php echo TEXT_NO_PURCHASES; ?>
  </div> <br />
<?php
  }
  if ($orders_total > 0) {
?>
  <div class="smallText">
  <?php echo $history_split->display_count(TEXT_DISPLAY_NUMBER_OF_ORDERS); ?> <br />
  <?php echo TEXT_RESULT_PAGE . ' ' . $history_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?>
  </div> <br />
<?php
  }

echo '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . tep_image_button('button_back.png', IMAGE_BUTTON_BACK) . '</a>'; 
?>