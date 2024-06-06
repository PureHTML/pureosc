<?php echo tep_draw_form('product_reviews_write', tep_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, 'action=process' . SEPARATOR_LINK . 'products_id=' . $_GET['products_id']), 'post', 'onsubmit="return checkForm();"'); ?>
  <h1 class="pageHeading">
  <?php echo $products_name; ?> <br /> <?php echo $products_price; ?>
  </h1><br />
<!-- // Points/Rewards Module V2.00 bof //-->
<?php
    if ((USE_POINTS_SYSTEM == 'true') && (tep_not_null(USE_POINTS_FOR_REVIEWS))) {
?>
    <br /><?php echo REVIEW_HELP_LINK; ?><br /> <br />
<?php
  }
?>
<!-- // Points/Rewards Module V2.00 eof //-->
<?php
  if (tep_not_null($product_info['products_image'])) {
?>
<?php echo '<a href="' . tep_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $product_info['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $product_info['products_image'], addslashes($product_info['products_name']), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, '') . '<br />' . TEXT_CLICK_TO_ENLARGE . '</a>'; ?>
<?php
  }
?>  <br />
<?php
  if ($messageStack->size('review') > 0) {
?>
  <?php echo $messageStack->output('review'); ?> <br />
<?php
  }
?>
<div class="AlignLeft">  
<?php //*** <Reviews Mod> ?>
  <?php echo SUB_TITLE_EXPLAIN; ?><br />
<?php //*** </Reviews Mod> ?>

  <div class="InfoBoxContenent2MA">
  <?php echo '<span class="b">' . SUB_TITLE_FROM . '</span> ' . tep_output_string_protected($customer['customers_firstname'] . ' ' . $customer['customers_lastname']); ?> <br />
  <span class="b"><?php echo SUB_TITLE_REVIEW; ?></span> <br />
  <?php echo tep_draw_textarea_field('review', '60', '15'); ?> <br />
  <?php echo TEXT_NO_HTML; ?> &nbsp;-&nbsp;
  <?php echo '<span class="b">' . SUB_TITLE_RATING . '</span> ' . TEXT_BAD . ' ' . tep_draw_radio_field('rating', '1') . ' ' . tep_draw_radio_field('rating', '2') . ' ' . tep_draw_radio_field('rating', '3') . ' ' . tep_draw_radio_field('rating', '4') . ' ' . tep_draw_radio_field('rating', '5') . ' ' . TEXT_GOOD; ?>
  </div> <br />

<?php
// BOF Anti Robot Registration v2.6
  if (ACCOUNT_VALIDATION == 'true' && strstr($PHP_SELF,'product_reviews_write') &&  ACCOUNT_REVIEW_VALIDATION == 'true') {
?>
  <h2 class="b"><?php echo CATEGORY_ANTIROBOTREG; ?></h2>
  <div class="InfoBoxContenent2MA">
<?php
      if ($is_read_only == false || (strstr($PHP_SELF,'product_reviews_write')) ) {
        $sql = "DELETE FROM " . TABLE_ANTI_ROBOT_REGISTRATION . " WHERE timestamp < '" . (time() - 3600) . "' OR session_id = '" . tep_session_id() . "'";
        if( !$result = tep_db_query($sql) ) { die('Could not delete validation key'); }
        $reg_key = gen_reg_key();
        $sql = "INSERT INTO ". TABLE_ANTI_ROBOT_REGISTRATION . " VALUES ('" . tep_session_id() . "', '" . $reg_key . "', '" . time() . "')";
        if( !$result = tep_db_query($sql) ) { die('Could not check registration information'); }
  echo '<label for="anti_robot_reg">' . ENTRY_ANTIROBOTREG . '<br />'; 
        $check_anti_robotreg_query = tep_db_query("select session_id, reg_key, timestamp from ". TABLE_ANTI_ROBOT_REGISTRATION . " where session_id = '" . tep_session_id() . "'");
        $new_guery_anti_robotreg = tep_db_fetch_array($check_anti_robotreg_query);
        $validation_images = '<br />' . tep_image_2ma('validation_png.php?rsid=' . $new_guery_anti_robotreg['session_id']);
          echo $validation_images . ' <br /> <br />' ;
          echo tep_draw_input_field('antirobotreg', $account['entry_antirobotreg'], ' id="anti_robot_reg" ', 'text', false) . '&nbsp;</label> ' . ENTRY_ANTIROBOTREG_TEXT;
      }
?>
  </div> <br />
<?php
        }
// EOF Anti Robot Registration v2.6
?>

<div class="CinquantaL">
  <?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS, tep_get_all_get_params(array('reviews_id', 'action'))) . '">' . tep_image_button('button_back.png', IMAGE_BUTTON_BACK) . '</a>'; ?>
</div>

<div class="CinquantaR">
    <?php echo tep_image_submit('button_continue.png', IMAGE_BUTTON_CONTINUE, 'id="continue"'); ?>
</div>
</div>
</form>