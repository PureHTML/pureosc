<?php
/*
  $Id: sitemap.php,v2.0 2006/07/07 web4pro

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/


  require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ARTICLES_NEW);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_ARTICLES_NEW));




  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_ARTICLE_NEW));
  
  $content = basename($_SERVER['PHP_SELF']);
  while (strstr($content, '.php')) $content = str_replace('.php', '', $content);

  $javascript = 'remove_label.js';
  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>