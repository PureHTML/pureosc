<?php
/*
  $Id: my_points_help.php, v 2.00 2006/JULY/06 17:41:03 dsa_ Exp $
  created by Ben Zukrel, Deep Silver Accessories
  http://www.deep-silver.com

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_MY_POINTS_HELP);

if (USE_POINTS_SYSTEM == 'true') {

$page_query = tep_db_query("select 
                               p.pages_id, 
                               p.sort_order, 
                               p.status, 
                               s.pages_title, 
                               s.pages_html_text
                            from 
                               " . TABLE_PAGES . " p LEFT JOIN " .TABLE_PAGES_DESCRIPTION . " s on p.pages_id = s.pages_id 
                            where 
                               p.status = 1
                            and
                               s.language_id = '" . (int)$languages_id . "'
                            and 
                               p.page_type = 6");


$page_check = tep_db_fetch_array($page_query);

$pagetext=stripslashes($page_check[pages_html_text]);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_MY_POINTS_HELP, '', 'NONSSL'));

  $content = basename($_SERVER['PHP_SELF']);
  while (strstr($content, '.php')) $content = str_replace('.php', '', $content);

  $javascript = 'remove_label.js';
  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
  
} else {
    tep_redirect(tep_href_link(FILENAME_DEFAULT));
}
?>