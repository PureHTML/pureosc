<?php
/*
  $Id: categories.php,v 1.25 2003/07/09 01:13:58 hpdl Exp $

  modified by paulm_nl 2003/12/23

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  $boxHeading = BOX_HEADING_PRICE_LIST;
  $corner_left = 'square';
  $corner_right = 'square';
  $box_base_name = 'price_list'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

  $boxContent = '<div class="AlignLeft">' ;
  $boxContent .= '<a href="' . tep_href_link(FILENAME_CATALOG_LIST, 'pfrom=0' . SEPARATOR_LINK . 'pto=999999999999999999', 'NONSSL') . '" >' . BOX_CATALOG_PRODUCTS_WITH_IMAGES . '</a>' ;
  $boxContent .= '</div>' ;

include (bts_select('boxes', $box_base_name)); // BTS 1.5
?>
<!-- categories_eof //-->