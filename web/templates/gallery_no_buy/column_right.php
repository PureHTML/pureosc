<?php
/*
  $Id: column_right.php,v 1.17 2003/06/09 22:06:41 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
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


  if (isset($_GET['products_id'])) { include(bts_select(boxes_original, 'manufacturer_info.php')); }


//BOF ask a question
			if (isset($_GET['products_id']))
			{
			include(bts_select(boxes_original, 'ask_box.php'));
			}
//EOF ask a question

  if (isset($_GET['products_id'])) {
    if (tep_session_is_registered('customer_id')) {
      $check_query = tep_db_query("select count(*) as count from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$customer_id . "' and global_product_notifications = '1'");
      $check = tep_db_fetch_array($check_query);
      if (!$check['count'] > 0) {

        include(bts_select(boxes_original, 'product_notifications.php'));
      }
    } else {
      include(bts_select(boxes_original, 'product_notifications.php'));
    }
  }

  if (isset($_GET['products_id'])) {
    if (basename($PHP_SELF) != FILENAME_TELL_A_FRIEND) include(bts_select(boxes_original, 'tell_a_friend.php'));
  } 

  require(bts_select(boxes_original, 'reviews.php'));

  if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {
    include(bts_select(boxes_original, 'languages.php'));
    include(bts_select(boxes_original, 'currencies.php'));
  }
  
  require(bts_select(boxes_original, 'whos_online.php')); 

?>