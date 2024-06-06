<?php
/*
  $Id: manufacturer_info.php,v 1.11 2003/06/09 22:12:05 hpdl Exp $

  modified by paulm_nl 2003/12/23

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  if (isset($_GET['products_id'])) {
    $manufacturer_query = tep_db_query("select m.manufacturers_id, m.manufacturers_name, m.manufacturers_image, mi.manufacturers_url from " . TABLE_MANUFACTURERS . " m left join " . TABLE_MANUFACTURERS_INFO . " mi on (m.manufacturers_id = mi.manufacturers_id and mi.languages_id = '" . (int)$languages_id . "'), " . TABLE_PRODUCTS . " p  where p.products_id = '" . (int)$_GET['products_id'] . "' and p.manufacturers_id = m.manufacturers_id");
    if (tep_db_num_rows($manufacturer_query)) {
      $manufacturer = tep_db_fetch_array($manufacturer_query);
?>
<!-- manufacturer_info //-->
<?php
      $boxHeading = BOX_HEADING_MANUFACTURER_INFO;
      $corner_left = 'square';
      $corner_right = 'square';
      $box_base_name = 'manufacturer_info'; // for easy unique box template setup (added BTSv1.2)
      $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)


      $boxContent = '';
      if (tep_not_null($manufacturer['manufacturers_image'])) $boxContent .= '' . tep_image(DIR_WS_IMAGES . $manufacturer['manufacturers_image'], $manufacturer['manufacturers_name']) . '<br />';
      if (tep_not_null($manufacturer['manufacturers_url'])) $boxContent .= '<a accesskey="W" href="' . tep_href_link(FILENAME_REDIRECT, 'action=manufacturer' . SEPARATOR_LINK . 'manufacturers_id=' . $manufacturer['manufacturers_id']) . '" >' . '&nbsp;[W]&nbsp;' . sprintf(BOX_MANUFACTURER_INFO_HOMEPAGE, $manufacturer['manufacturers_name']) . '</a><br />';
      $boxContent .= '<a accesskey="M" href="' . tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $manufacturer['manufacturers_id']) . '">' . '&nbsp;[M]&nbsp;' . BOX_MANUFACTURER_INFO_OTHER_PRODUCTS . '</a>' .
                                   '';
include (bts_select('boxes', $box_base_name)); // BTS 1.5
?>
<!-- manufacturer_info_eof //-->
<?php
    }
  }
?>
