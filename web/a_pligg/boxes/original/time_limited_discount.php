<?php
/*

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
//  if ($random_product = tep_random_select("select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s, " . TABLE_CATEGORIES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c  where c.categories_status='1' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and p.products_status = '1' and p.products_id = s.products_id and pd.products_id = s.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' AND s.expires_date >0 order by s.specials_date_added desc limit 2")) {

    $best_sellers_query = tep_db_query("select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s, " . TABLE_CATEGORIES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c  where c.categories_status='1' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and p.products_status = '1' and p.products_id = s.products_id and pd.products_id = s.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' AND s.expires_date >0 order by s.specials_date_added desc limit 2");
//("select distinct p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_CATEGORIES . " c  where p.products_status = '1' and c.categories_status = '1'  and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' AND products_dotisk = 1 order by p.products_date_added desc, pd.products_name limit " . MAX_DISPLAY_BESTSELLERS);



  if (tep_db_num_rows($best_sellers_query) >= MIN_DISPLAY_BESTSELLERS) {
?>
<!-- dotisk //-->
<?php
  $boxHeading = '<font color="#b19b6a">'. BOX_HEADING_SPECIALS_TIMED . '</font>';

  $corner_left = 'square';
  $corner_right = 'square';
  $box_base_name = 'dotisk'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)
  $rows = 0;
  $boxContent = '<table border="0" width="100%" cellspacing="0" cellpadding="0">';

    while ($best_sellers = tep_db_fetch_array($best_sellers_query)) {
      $rows++;
  
    $boxContent .= '<tr><td><div align="center"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $best_sellers['products_id']) . '"><img border="0" src="images/'. $best_sellers['products_image'].'"></a><br>
<a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $best_sellers['products_id']) . '">' . $best_sellers['products_name'] . '</a><br />
                                 <span class="s"> ' . $currencies->display_price($best_sellers['products_id'], $best_sellers['products_price'], tep_get_tax_rate($best_sellers['products_tax_class_id'])) . '</span><br />
                                 <span class="ColorWhite">' . $currencies->display_price_nodiscount($best_sellers['specials_new_products_price'], tep_get_tax_rate($best_sellers['products_tax_class_id'])) .
'</div></td></tr>';
  }

  $boxContent .= '</table>';

include (bts_select('boxes', $box_base_name)); // BTS 1.5
?>
<!-- dotisk_eof //-->
<?php
  }
?>