<?php
/*

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

    $best_sellers_query = tep_db_query("select distinct p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_CATEGORIES . " c  where p.products_status = '1' and c.categories_status = '1'  and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' AND products_dotisk = 1 order by p.products_date_added desc, pd.products_name limit " . MAX_DISPLAY_BESTSELLERS);



  if (tep_db_num_rows($best_sellers_query) >= MIN_DISPLAY_BESTSELLERS) {
?>
<!-- dotisk //-->
<?php
  $boxHeading = '<a class="n" href="/?f=4"><font color="#8f8255">' . BOX_HEADING_DOTISK . '</font></a>';
  $corner_left = 'square';
  $corner_right = 'square';
  $box_base_name = 'dotisk'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)
  $rows = 0;
  $boxContent = '<table border="0" width="100%" cellspacing="0" cellpadding="0">';

    while ($best_sellers = tep_db_fetch_array($best_sellers_query)) {
      $rows++;
  
    $boxContent .= '<tr><td>'. tep_row_number_format_9($rows) . '</td><td><a class="n" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $best_sellers['products_id']) . '">' . $best_sellers['products_name'] . '</a></td></tr>';
  }

  $boxContent .= '</table>';

include (bts_select('boxes', $box_base_name)); // BTS 1.5
?>
<!-- dotisk_eof //-->
<?php
  }
?>