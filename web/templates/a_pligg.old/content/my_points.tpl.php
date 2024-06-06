<h1 class="pageHeading" >
  <?php echo tep_image_2ma_template(bts_select(images, 'money.png'), HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php echo HEADING_TITLE; ?>
</h1><br />
<div class="AlignLeft">

    <?php echo MY_POINTS_HELP_LINK; ?> <br /><br />

<?php
  $points_query = tep_db_query("SELECT customers_shopping_points, customers_points_expires FROM " . TABLE_CUSTOMERS . " WHERE customers_id = '" . (int)$customer_id . "' AND customers_points_expires > CURDATE()");
  $points = tep_db_fetch_array($points_query);
    if (tep_db_num_rows($points_query)) {
?>
    <?php echo sprintf(MY_POINTS_CURRENT_BALANCE, number_format($points['customers_shopping_points'],POINTS_DECIMAL_PLACES),$currencies->format(tep_calc_shopping_pvalue($points['customers_shopping_points']))); ?>
    <?php echo '<span class="b">' . MY_POINTS_EXPIRE . '</span> ' . tep_date_short($points['customers_points_expires']); ?> <br /><br />
<?php
  } else {
         echo TEXT_NO_POINTS . '<br /><br />';
  }
?>
<?php
    $pending_points_query = "SELECT unique_id, orders_id, points_pending, points_comment, date_added, points_status, points_type from " . TABLE_CUSTOMERS_POINTS_PENDING . " WHERE customer_id = '" . (int)$customer_id . "' ORDER BY unique_id DESC";
    $pending_points_split = new splitPageResults($pending_points_query, MAX_DISPLAY_POINTS_RECORD);
    $pending_points_query = tep_db_query($pending_points_split->sql_query);

    if (tep_db_num_rows($pending_points_query)) {
?>
<h2 class="b">
    <?php echo HEADING_ORDER_DATE; ?> -
    <?php echo HEADING_ORDERS_NUMBER; ?> -
    <?php echo HEADING_POINTS_COMMENT; ?> -
    <?php echo HEADING_POINTS_STATUS; ?> ( <?php echo HEADING_POINTS_TOTAL; ?> ) </h2>

    <div class="InfoBoxContenent2MA">

<?php
    while ($pending_points = tep_db_fetch_array($pending_points_query)) {
      $orders_status_query = tep_db_query("SELECT o.orders_id, o.orders_status, s.orders_status_name FROM " . TABLE_ORDERS . " o, " . TABLE_ORDERS_STATUS . " s WHERE o.customers_id = '" . (int)$customer_id . "' AND o.orders_id = '" . $pending_points['orders_id'] . "' AND o.orders_status = s.orders_status_id AND s.language_id = '" . (int)$languages_id . "'");
      $orders_status = tep_db_fetch_array($orders_status_query);

	  if ($pending_points['points_status'] == 1) $points_status_name = TEXT_POINTS_PENDING;
	  if ($pending_points['points_status'] == 2) $points_status_name = TEXT_POINTS_CONFIRMED;
	  if ($pending_points['points_status'] == 3) $points_status_name = TEXT_POINTS_CANCELLED;
	  if ($pending_points['points_status'] == 4) $points_status_name = TEXT_POINTS_REDEEMED;
		  
	  if ($orders_status['orders_status'] == 2 && $pending_points['points_status'] == 1 || $orders_status['orders_status'] == 3 && $pending_points['points_status'] == 1) {
		$points_status_name = TEXT_POINTS_PROCESSING;
	  }
		
	  if (($pending_points['points_type'] == SP) && ($pending_points['points_comment'] == 'TEXT_DEFAULT_COMMENT')) {
		$pending_points['points_comment'] = TEXT_DEFAULT_COMMENT;
	  }
		if($pending_points['points_comment'] == 'TEXT_DEFAULT_REDEEMED') {
		   $pending_points['points_comment'] = TEXT_DEFAULT_REDEEMED;
	  }
	  if ($pending_points['points_type'] == RF) {
        $referred_name_query = tep_db_query("SELECT customers_name FROM " . TABLE_ORDERS . " WHERE orders_id = '" . $pending_points['orders_id'] . "' LIMIT 1");
        $referred_name = tep_db_fetch_array($referred_name_query);
		if ($pending_points['points_comment'] == 'TEXT_DEFAULT_REFERRAL') {
		  $pending_points['points_comment'] = TEXT_DEFAULT_REFERRAL;
	    }
	  }
	  if (($pending_points['points_type'] == RV) && ($pending_points['points_comment'] == 'TEXT_DEFAULT_REVIEWS')) {
		$pending_points['points_comment'] = TEXT_DEFAULT_REVIEWS;
	  }
	  if (($pending_points['orders_id'] > 0) && (($pending_points['points_type'] == SP)||($pending_points['points_type'] == RD))) {
?>
        <a href="<?php echo tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $pending_points['orders_id'], 'SSL'); ?>" title="<?php echo TEXT_ORDER_HISTORY .'&nbsp;' . $pending_points['orders_id']; ?>">
<?php
	  }
	  if ($pending_points['points_type'] == RV) {
?>
        <a href="<?php echo tep_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . $pending_points['orders_id'], 'NONSSL'); ?>" title="<?php echo TEXT_REVIEW_HISTORY; ?>">
<?php
	  }
	  if (($pending_points['orders_id'] == 0) || ($pending_points['points_type'] == RF) || ($pending_points['points_type'] == RV)) {
		$orders_status['orders_status_name'] = TEXT_STATUS_ADMINISTATION;
		$pending_points['orders_id'] = TEXT_ORDER_ADMINISTATION;
	  }
?>
    <?php echo tep_date_short($pending_points['date_added']); ?> - <?php echo '#' . $pending_points['orders_id'] . '&nbsp;&nbsp;' . $orders_status['orders_status_name']; ?>  </a> -                 
    <?php echo  $pending_points['points_comment'] .'&nbsp;' . $referred_name['customers_name']; ?> - <?php echo  $points_status_name; ?> ( <?php echo number_format($pending_points['points_pending'],POINTS_DECIMAL_PLACES); ?> ) <br />
<?php
   }
?>
</div> <br />
    <?php echo $pending_points_split->display_count(TEXT_DISPLAY_NUMBER_OF_RECORDS); ?> - <?php echo TEXT_RESULT_PAGE . ' ' . $pending_points_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?> 

<?php
  }
?> <br /><br />
    <?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE) . '</a>'; ?>
  </div>