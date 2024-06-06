<?php
/*
  $Id: information.php,v 1.6 2003/02/10 22:31:00 hpdl Exp $
  modified by paulm_nl 2003/12/23
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- information //-->
<?php
  $boxHeading = BOX_HEADING_INFORMATION;
  $corner_left = 'square';
  $corner_right = 'square';
  $box_base_name = 'information'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)


$boxContent = '<div class="AlignLeft"><a accesskey="1" href="' . tep_href_link(FILENAME_SHIPPING) . '">' . '[1]&nbsp;' . BOX_INFORMATION_SHIPPING . '</a><br />' .
              '<a accesskey="2" href="' . tep_href_link(FILENAME_PRIVACY) . '">' . '[2]&nbsp;' . BOX_INFORMATION_PRIVACY . '</a><br />' .
              '<a accesskey="3" href="' . tep_href_link(FILENAME_CONDITIONS) . '">' . '[3]&nbsp;' . BOX_INFORMATION_CONDITIONS . '</a><br />' .
              '<a accesskey="4" href="' . tep_href_link(FILENAME_CONTACT_US) . '">' . '[4]&nbsp;' . BOX_INFORMATION_CONTACT . '</a><br />' .
              '<a accesskey="5" href="' . tep_href_link(FILENAME_DYNAMIC_SITEMAP) . '">' . '[5]&nbsp;' . BOX_INFORMATION_DYNAMIC_SITEMAP . '</a><br />' .

              '</div>';

include (bts_select('boxes', $box_base_name)); // BTS 1.5
?>
<!-- information_eof //-->