  <h1 class="pageHeading"><?php echo $products_name; ?> <br /> <br />
  <?php echo $products_price; ?></h1>
  
<!-- // Points/Rewards Module V2.00 bof //-->
<?php
    if ((USE_POINTS_SYSTEM == 'true') && (tep_not_null(USE_POINTS_FOR_REVIEWS))) {
?>
   <br /> <?php echo REVIEW_HELP_LINK; ?><br /><br />
<?php
  }
?>
<!-- // Points/Rewards Module V2.00 eof //-->
  
  
<br />
<br />
<?php
  if (tep_not_null($review['products_image'])) {
?>
<?php echo '<a href="' . tep_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $review['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $review['products_image'], addslashes($review['products_name']), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, '') . '<br />' . TEXT_CLICK_TO_ENLARGE . '</a>'; ?>
<?php
  }

  echo '<p><a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now') . '">' . tep_image_button('button_in_cart.png', IMAGE_BUTTON_IN_CART) . '</a></p>';
?>
<br />
  <?php echo '<span class="b">' . sprintf(TEXT_REVIEW_BY, tep_output_string_protected($review['customers_name'])) . '</span>'; ?> <br />
  <?php echo sprintf(TEXT_REVIEW_DATE_ADDED, tep_date_long($review['date_added'])); ?> <br />
  <div class="InfoBoxContenent2MA">
    <?php echo tep_break_string(nl2br(tep_output_string_protected($review['reviews_text'])), 60, '-<br />') . '<br /><br />' . sprintf(TEXT_REVIEW_RATING, tep_image(bts_select(images, 'stars_' . $review['reviews_rating'] . '.png'), sprintf(TEXT_OF_5_STARS, $review['reviews_rating'])), sprintf(TEXT_OF_5_STARS, $review['reviews_rating'])); ?>
  </div>
<br />

<div class="CinquantaL">
     <?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS, tep_get_all_get_params(array('reviews_id'))) . '">' . tep_image_button('button_back.png', IMAGE_BUTTON_BACK) . '</a>'; ?>
</div>

<div class="CinquantaR">
     <?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, tep_get_all_get_params(array('reviews_id'))) . '">' . tep_image_button('button_write_review.png', IMAGE_BUTTON_WRITE_REVIEW) . '</a>'; ?>
</div>