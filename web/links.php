<?php


  $new_page = false; // set to true to open links in a new page
        $result_page = 10; //results per page

  require('includes/application_top.php');
  if ($_GET['page'] == 1) {unset($_GET['page']); tep_redirect(tep_href_link('links.php')); }
        if (isset($_GET['category']) && $_GET['category'] == 0) {unset($_GET['category']); tep_redirect(tep_href_link('links.php')); }  //prevent duplicates on google
  require(DIR_WS_LANGUAGES . $language . '/links.php');
  //require(DIR_WS_FUNCTIONS.'pagerank.php');
        $action = (isset($_GET['action']) ? $_GET['action'] : '');
        $units = array( 1 =>"One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine" );
// changed by http://www.sportzone4you.de
//        $target = ($new_page ? '_blank' : '_parent');
// changed by http://www.sportzone4you.de
 $target = ($new_page ? '_blank' : '_blank');
        //category drop-down
  $category_array = array();
        $category_array[0] = array('id' => '0', 'text' => 'All');
        $category_query = tep_db_query("select category_id, category_name from links_categories where status = 1 order by sort_order, category_name");
  $rows = tep_db_num_rows($category_query);
        $page = $_GET['page'] > 0 ? $_GET['page'] : false;
        $cats = ($_GET['category'] > 0 ? $_GET['category'] : false);
  while ($category_values = tep_db_fetch_array($category_query)) {
    $category_array[] = array('id' => $category_values['category_id'], 'text' => $category_values['category_name']);
                $category_name[$category_values['category_id']] = $category_values['category_name'];
  }
        $product_info = TITLE . ' Links ' . (!$page ? '' : 'Page ' . $units[$page]) . (!$cats ? '' : '- ' .$category_name[$cats]);
  $breadcrumb->add('links', tep_href_link('links.php'));

        //$exclude = array(); if (!in_array('test', $exclude)) echo 'notin';

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_LINKS));

  $content = basename($_SERVER['PHP_SELF']);
  while (strstr($content, '.php')) $content = str_replace('.php', '', $content);

  $javascript = 'remove_label.js';
  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>