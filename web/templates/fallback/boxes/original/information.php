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

if ((MODULE_ORDER_TOTAL_GV_STATUS != 'MODULE_ORDER_TOTAL_GV_STATUS') && (MODULE_ORDER_TOTAL_GV_STATUS == true)) { 
$text_gift = '<a accesskey="6" href="' . tep_href_link(FILENAME_GV_FAQ) . '">' . '[6]&nbsp;' . BOX_INFORMATION_GV . '</a><br />';
} else { 
$text_gift = ' ';
}

if (USE_POINTS_SYSTEM == 'true') {
$text_point = '<a accesskey="7" href="' . tep_href_link(FILENAME_MY_POINTS_HELP) . '">' . '[7]&nbsp;' . BOX_INFORMATION_MY_POINTS_HELP . '</a><br />' ; //Points/Rewards Module V2.00
} else { 
$text_point = ' ';
}

// Add-on - Information Pages Unlimited
require_once(DIR_WS_FUNCTIONS . 'information.php');

// RSS Recover the code (en, fr, etc) of the current language
if ($_GET['language'] == '') {
  $lang_query = tep_db_query('select code from ' . TABLE_LANGUAGES . ' where directory = \'' . $language . '\'');
} else {
  $cur_language = tep_db_output($_GET['language']);
  $lang_query = tep_db_query('select code from ' . TABLE_LANGUAGES . ' where code = \'' . $cur_language . '\'');
}
$lang_a = tep_db_fetch_array($lang_query);
$lang_code = $lang_a['code'];
// RSS

$boxContent = '<div class="AlignLeft"><a accesskey="1" href="' . tep_href_link(FILENAME_SHIPPING) . '">' . '[1]&nbsp;' . BOX_INFORMATION_SHIPPING . '</a><br />' .
              '<a accesskey="2" href="' . tep_href_link(FILENAME_PRIVACY) . '">' . '[2]&nbsp;' . BOX_INFORMATION_PRIVACY . '</a><br />' .
              '<a accesskey="3" href="' . tep_href_link(FILENAME_CONDITIONS) . '">' . '[3]&nbsp;' . BOX_INFORMATION_CONDITIONS . '</a><br />' .
              '<a accesskey="4" href="' . tep_href_link(FILENAME_CONTACT_US) . '">' . '[4]&nbsp;' . BOX_INFORMATION_CONTACT . '</a><br />' .
              '<a accesskey="5" href="' . tep_href_link(FILENAME_DYNAMIC_SITEMAP) . '">' . '[5]&nbsp;' . BOX_INFORMATION_DYNAMIC_SITEMAP . '</a><br />' .
              $text_gift . 
              $text_point . 
              tep_information_show_category() .
              '<br /><a href="' . FILENAME_RSS . '?language=' . $lang_code . '" title="' . BOX_INFORMATION_RSS . '">' . tep_image(DIR_WS_IMAGES .  "icons/rss_icon.jpg" , STORE_NAME . " - " . BOX_INFORMATION_RSS) . ' - ' . BOX_INFORMATION_RSS . '</a>' .
              '</div>';

include (bts_select('boxes', $box_base_name)); // BTS 1.5
?>
<!-- information_eof //-->