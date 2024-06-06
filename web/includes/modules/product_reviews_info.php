<?php
#July 11, 2005
#Version 1.0
#By Dan Sullivan

$reviews_query = tep_db_query("select r.reviews_id, r.customers_name, r.date_added, rd.reviews_text, r.reviews_rating FROM " 
                             . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd WHERE r.reviews_id = rd.reviews_id AND r.products_id = '" 
                             . (int)$_GET['products_id'] . "' AND rd.languages_id = '" . (int)$languages_id . "' and r.approved = '1' ORDER BY r.date_added DESC LIMIT " 
                             . MAX_REVIEWS);
$info_box_header = array();
$info_box_header[] = array('text' => BOX_REVIEWS_HEADER_TEXT);
new contentBoxHeading($info_box_header);

$info_box_contents = array();

while ($reviews = tep_db_fetch_array($reviews_query)) {
  $info_box_contents[][0] = array('text' => '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . (int)$_GET['products_id'] 
                                             . '&amp;reviews_id=' . $reviews['reviews_id']) . '"><span class="b">' . $reviews['customers_name'] . '</span>&nbsp;-&nbsp;' 
                                             . tep_date_short($reviews['date_added']) . '&nbsp;' . tep_image(bts_select(images, 'stars_' . $reviews['reviews_rating'] 
                                             . '.png'), sprintf(BOX_REVIEWS_TEXT_OF_5_STARS, $reviews['reviews_rating'])) . '</a><br /> ' 
                                             . $reviews['reviews_text']);
}
 if(mysql_num_rows($reviews_query) > 0) {
$info_box_contents[][0] = array('text' => '<br /><br /><a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS, 'products_id=' . 
                                           (int)$_GET['products_id']) . '">' . ALL_REVIEWS . '</a>');
} else {
  $info_box_contents[][0] = array('text' => NO_REVIEWS_TEXT);
}
new contentBox($info_box_contents);
?>
