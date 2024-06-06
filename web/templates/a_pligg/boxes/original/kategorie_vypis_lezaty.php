<div style="margin-top:20px">
<div style="width:145px" class="BoxesInfoBoxHeadingCenterBoxTitle">Publikace</div><br />
<?php
/*
  $Id: best_sellers.php,v 1.21 2003/06/09 22:07:52 hpdl Exp $

  modified by paulm_nl 2003/12/23

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/


//jsp:todo hack 
    $best_sellers_query = tep_db_query("select distinct p.products_id, pd.products_name, p.products_image from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where p.products_status = '1' and c.categories_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = p2c.products_id and p2c.categories_id = 4 and '" . (int)$current_category_id . "' in (c.categories_id, c.parent_id) order by  pd.products_name limit " . MAX_DISPLAY_BESTSELLERS);
// ################## End added Enable / Disable Categorie ################

  if (tep_db_num_rows($best_sellers_query) >= MIN_DISPLAY_BESTSELLERS) {
?>
<!-- best_sellers //-->
<?php
//  $boxHeading = 'publikace';
  $corner_left = 'square';
  $corner_right = 'square';
  $box_base_name = 'best_sellers'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)
  $rows = 0;
  $boxContent = '<div>';

    while ($best_sellers = tep_db_fetch_array($best_sellers_query)) {
      $rows++;
  
    $boxContent .= '<a class="nlezaty" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $best_sellers['products_id']) . '" title="' . $best_sellers['products_name'] . ' "><img src="images/'.$best_sellers['products_image'].'"></a>';
  }

  $boxContent .= '</div>';

include (bts_select('boxes', $box_base_name)); // BTS 1.5
?>
<!-- best_sellers_eof //-->
<?php
  }
?></div>