<?php
//knihy stop
// require(bts_select(boxes_original, 'kategorie_vypis.php'));

//kosik
  require(bts_select(boxes_original, 'shopping_cart.php'));
//pripravujeme
   include(bts_select(boxes_original, 'pripravujeme.php'));
    include(bts_select(boxes_original, 'specials.php'));
    include(bts_select(boxes_original, 'reprints.php'));

  if (isset($_GET['products_id'])) {
    if (tep_session_is_registered('customer_id')) {
      $check_query = tep_db_query("select count(*) as count from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$customer_id . "' and global_product_notifications = '1'");
      $check = tep_db_fetch_array($check_query);
      if ($check['count'] > 0) {
        include(bts_select(boxes_original, 'best_sellers.php'));
      } else {
//        include(bts_select(boxes_original, 'product_notifications.php'));
      }
    } else {
//      include(bts_select(boxes_original, 'product_notifications.php'));
    }
  } else {
    include(bts_select(boxes_original, 'best_sellers.php'));
  }

/*
    if (!strstr($_SERVER['PHP_SELF'],'advanced_search.php')) {
    require(bts_select(boxes_original, 'search.php'));
  }
  
  if ((USE_CACHE == 'true') && empty($SID)) {
    echo tep_cache_manufacturers_box();
  } else {
    include(bts_select(boxes_original, 'manufacturers.php'));
  }

  if ((USE_CACHE == 'true') && empty($SID)) {
    echo tep_cache_categories_box();
  } else {
    include(bts_select(boxes_original, 'categories.php'));
  }


  // Article Manager
  require(DIR_WS_BOXES . 'authors.php');
  require(DIR_WS_BOXES . 'articles.php');
*/

// Begin Login/Account Box
  if ( (!strstr($_SERVER['PHP_SELF'],'login.php') && !strstr($_SERVER['PHP_SELF'],'create_account.php') && !strstr($_SERVER['PHP_SELF'],'password_forgotten.php')) | tep_session_is_registered('customer_id') )
  {
    if (!tep_session_is_registered('customer_id'))
    {
    require(bts_select(boxes_original, 'login.php'));
    }
     else
    {
    require(bts_select(boxes_original, 'account.php'));
    }
  }
// End Login/Account Box
//jsp:new:ankety
require(bts_select(boxes_original, 'polls.php'));
//jsp:new:events_calendar
//require(bts_select(boxes_original, 'calendar.php'));

/*
  require(bts_select(boxes_original, 'themes.php'));

  if (isset($_GET['products_id'])) { include(bts_select(boxes_original, 'manufacturer_info.php')); }

//jsp:orig  if (tep_session_is_registered('customer_id')) { include(bts_select(boxes_original, 'order_history.php')); }
//jsp:pwa
  if (tep_session_is_registered('customer_id') && (! tep_session_is_registered('customer_is_guest')) ) include(DIR_WS_BOXES . 'order_history.php');

//BOF ask a question
			if (isset($_GET['products_id']))
			{
			include(bts_select(boxes_original, 'ask_box.php'));
			}
//EOF ask a question
*/

/*
  if (isset($_GET['products_id'])) {
    if (basename($PHP_SELF) != FILENAME_TELL_A_FRIEND) include(bts_select(boxes_original, 'tell_a_friend.php'));
  } 
    
  require(bts_select(boxes_original, 'whats_new.php'));
  
  require(bts_select(boxes_original, 'reviews.php'));

  if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {
//    include(bts_select(boxes_original, 'languages.php'));
//    include(bts_select(boxes_original, 'currencies.php'));
  }
    require(bts_select(boxes_original, 'information.php'));
  require(bts_select(boxes_original, 'whos_online.php')); 
*/
echo '<div style="border:1px solid black"><a href="' . tep_href_link('links.php') . '">' . LM_TITLE . '</a></div>' 

?>