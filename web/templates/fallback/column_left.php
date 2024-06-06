<?php
/*
  $Id: column_left.php,v 1.15 2003/07/01 14:34:54 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  if ((USE_CACHE == 'true') && empty($SID)) {
    echo tep_cache_categories_box();
  } else {
    include(bts_select(boxes_original, 'categories.php'));
  }

  require(bts_select(boxes_original, 'price_list.php'));

  if ((USE_CACHE == 'true') && empty($SID)) {
    echo tep_cache_manufacturers_box();
  } else {
    include(bts_select(boxes_original, 'manufacturers.php'));
  }

  require(bts_select(boxes_original, 'whats_new.php'));
  
  if (!strstr($_SERVER['PHP_SELF'],'advanced_search.php')) {
    require(bts_select(boxes_original, 'search.php'));
  }

  require(bts_select(boxes_original, 'information.php'));

  // Article Manager
  require(DIR_WS_BOXES . 'authors.php');
  require(DIR_WS_BOXES . 'articles.php');

?>