<?php

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_DEFAULT);

  include(DIR_WS_MODULES . '/dynamic_sitemap.php');


  $content = basename($_SERVER['PHP_SELF']);
  while (strstr($content, '.php')) $content = str_replace('.php', '', $content);
  $breadcrumb->add(NAVBAR_TITLE, tep_href_link($content));

  $javascript = 'remove_label.js';
  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>