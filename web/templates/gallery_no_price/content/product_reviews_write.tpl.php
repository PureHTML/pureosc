<?php echo tep_draw_form('product_reviews_write', tep_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, 'action=process' . SEPARATOR_LINK . 'products_id=' . $_GET['products_id']), 'post', 'onsubmit="return checkForm();"'); ?>
  <h1 class="pageHeading">
  <?php echo $products_name; ?>
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
  
<div class="CinquantaL">
  <?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS, tep_get_all_get_params(array('reviews_id', 'action'))) . '">' . tep_image_button('button_back.png', IMAGE_BUTTON_BACK) . '</a>'; ?>
</div>

<div class="CinquantaR">
    <?php echo tep_image_submit('button_continue.png', IMAGE_BUTTON_CONTINUE, 'id="continue"'); ?>
</div>
</div>
</form>