<h1 class="pageHeading">
  <?php echo tep_image_2ma_template(bts_select(images, 'table_background_reviews_new.png'), HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php echo HEADING_TITLE; ?>
</h1> <br />  
<!-- // Points/Rewards Module V2.00 bof //-->
<?php
    if ((USE_POINTS_SYSTEM == 'true') && (tep_not_null(USE_POINTS_FOR_REVIEWS))) {
?>
    <?php echo REVIEW_HELP_LINK; ?>
<?php
  }
?>
<!-- // Points/Rewards Module V2.00 eof //-->
<br /><br />
<?php
//*** <Reviews Mod>
    $reviews_query_raw = "select r.reviews_id, left(rd.reviews_text, 100) as reviews_text, r.reviews_rating, r.date_added, p.products_id, pd.products_name, p.products_image, r.customers_name from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = r.products_id and r.reviews_id = rd.reviews_id and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and rd.languages_id = '" . (int)$languages_id . "' and r.approved = '1' order by r.reviews_id DESC";
//*** </Reviews Mod>
//  $reviews_query_raw = "select r.reviews_id, left(rd.reviews_text, 100) as reviews_text, r.reviews_rating, r.date_added, p.products_id, pd.products_name, p.products_image, r.customers_name from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = r.products_id and r.reviews_id = rd.reviews_id and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and rd.languages_id = '" . (int)$languages_id . "' order by r.reviews_id DESC";
  $reviews_split = new splitPageResults($reviews_query_raw, MAX_DISPLAY_NEW_REVIEWS);

  if ($reviews_split->number_of_rows > 0) {
    if ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3')) {
?>
  <?php echo $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?> - <?php echo TEXT_RESULT_PAGE . ' ' . $reviews_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info'))); ?> <br />
<?php
    }

    $reviews_query = tep_db_query($reviews_split->sql_query);
    while ($reviews = tep_db_fetch_array($reviews_query)) {
?>
  <?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . $reviews['products_id'] . SEPARATOR_LINK .'reviews_id=' . $reviews['reviews_id']) 
             . '"><span class="ColorSpan">' . $reviews['products_name'] . '</span></a> <span class="smallText">' 
             . sprintf(TEXT_REVIEW_BY, tep_output_string_protected($reviews['customers_name'])) . '</span> ' . sprintf(TEXT_REVIEW_DATE_ADDED, tep_date_long($reviews['date_added'])) . '<br />'; ?> 
  <br />
  <div class="InfoBoxContenent2MA">
    <?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . $reviews['products_id'] . SEPARATOR_LINK . 'reviews_id=' . $reviews['reviews_id']) . '">' . tep_image(DIR_WS_IMAGES . $reviews['products_image'], $reviews['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>'; ?> <br />
    <?php echo tep_break_string(tep_output_string_protected($reviews['reviews_text']), 60, '-<br />') . ((strlen($reviews['reviews_text']) >= 100) ? '..' : '') . '<br /><br />' . sprintf(TEXT_REVIEW_RATING, tep_image(bts_select(images, 'stars_' . $reviews['reviews_rating'] . '.png'), sprintf(TEXT_OF_5_STARS, $reviews['reviews_rating'])), sprintf(TEXT_OF_5_STARS, $reviews['reviews_rating'])); ?>
  </div>
  <br />  
<?php
    }
?>
<?php
  } else {
?>
  <?php new infoBox(array(array('text' => TEXT_NO_REVIEWS))); ?> <br />
<?php
  }

  if (($reviews_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
  <?php echo $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?> - <?php echo TEXT_RESULT_PAGE . ' ' . $reviews_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info'))); ?> <br />
<?php
  }
?>
