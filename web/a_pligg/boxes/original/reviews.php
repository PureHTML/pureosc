<?php
/*
  shop2.0brain:todo hotkey [R] nefunguje acceskey
  $Id: reviews.php,v 1.37 2003/06/09 22:20:28 hpdl Exp $

  modified by paulm_nl 2003/12/23

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- reviews //-->
<?php
  $boxHeading = '';
  $corner_left = 'square';
  $corner_right = 'square';
  $boxLink = '<a class="BoxesInfoBoxHeadingCenterBoxRight" title="hotkey [R]" href="' . tep_href_link(FILENAME_REVIEWS) . '">'.BOX_HEADING_REVIEWS.'</a>';
  $box_base_name = 'reviews'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

//*** <Reviews Mod>
  $random_select = "select r.reviews_id, r.reviews_rating, p.products_id, p.products_image, pd.products_name from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = r.products_id and r.reviews_id = rd.reviews_id and rd.languages_id = '" . (int)$languages_id . "' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and r.approved = '1'";
//  $random_select = "select r.reviews_id, r.reviews_rating, p.products_id, p.products_image, pd.products_name from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = r.products_id and r.reviews_id = rd.reviews_id and rd.languages_id = '" . (int)$languages_id . "' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "'";
//*** </Reviews Mod>
  
  if (isset($_GET['products_id'])) {
    $random_select .= " and p.products_id = '" . (int)$_GET['products_id'] . "'";
  }
  $random_select .= " order by r.reviews_id desc limit " . MAX_RANDOM_SELECT_REVIEWS;
  $random_product = tep_random_select($random_select);

  if ($random_product) {
// display random review box
    $rand_review_query = tep_db_query("select substring(reviews_text, 1, 30) as reviews_text from " . TABLE_REVIEWS_DESCRIPTION . " where reviews_id = '" . (int)$random_product['reviews_id'] . "' and languages_id = '" . (int)$languages_id . "'");
    $rand_review = tep_db_fetch_array($rand_review_query);

    $rand_review_text = tep_break_string(tep_output_string_protected($rand_review['reviews_text']), 15, '-<br />');

    $boxContent = '<a accesskey="R" href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . $random_product['products_id'] . SEPARATOR_LINK . 'reviews_id=' . $random_product['reviews_id']) . '">' . '&nbsp;[R]&nbsp;<span class="ie6balengo">' . tep_image(DIR_WS_IMAGES . $random_product['products_image'], $random_product['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT).'</span>' . $rand_review_text .'...</a><br />' . tep_image(bts_select(images, 'stars_' . $random_product['reviews_rating'] . '.png'), sprintf(BOX_REVIEWS_TEXT_OF_5_STARS, $random_product['reviews_rating']));
  } elseif (isset($_GET['products_id'])) {
// display 'write a review' box
    $boxContent = '<a accesskey="R" href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, 'products_id=' . $_GET['products_id']) . '">' . '&nbsp;[R]&nbsp;' . tep_image(bts_select(images, 'box_write_review.png'), IMAGE_BUTTON_WRITE_REVIEW) . BOX_REVIEWS_WRITE_REVIEW . '</a><br />';
  } else {
// display 'no reviews' box
    $boxContent = BOX_REVIEWS_NO_REVIEWS;
  }

include (bts_select('boxes', $box_base_name)); // BTS 1.5

  $boxLink = '';
?>
<!-- reviews_eof //-->