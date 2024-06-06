<div>
<?php
/*
  $Id: column_right.php,v 1.17 2003/06/09 22:06:41 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License

//  require(bts_select(boxes_original, 'shopping_cart.php'));

    if (!strstr($_SERVER['PHP_SELF'],'advanced_search.php')) {
    require(bts_select(boxes_original, 'search.php'));
  }

*/  



?>
</div>
<br />
<?
  if ((USE_CACHE == 'true') && empty($SID)) {
    echo tep_cache_categories_box();
  } else {
    include(bts_select(boxes_original, 'categories.php'));
  }

  if ((USE_CACHE == 'true') && empty($SID)) {
    echo tep_cache_manufacturers_box();
  } else {
    include(bts_select(boxes_original, 'manufacturers.php'));
  }

/*
  // Article Manager
  require(DIR_WS_BOXES . 'authors.php');
  require(DIR_WS_BOXES . 'articles.php');
*/
/*
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

  require(bts_select(boxes_original, 'themes.php'));

  if (isset($_GET['products_id'])) { include(bts_select(boxes_original, 'manufacturer_info.php')); }

  if (tep_session_is_registered('customer_id')) { include(bts_select(boxes_original, 'order_history.php')); }

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
      if ($check['count'] > 0) {
        include(bts_select(boxes_original, 'best_sellers.php'));
      } else {
        include(bts_select(boxes_original, 'product_notifications.php'));
      }
    } else {
      include(bts_select(boxes_original, 'product_notifications.php'));
    }
  } else {
    include(bts_select(boxes_original, 'best_sellers.php'));
  }

  if (isset($_GET['products_id'])) {
    if (basename($PHP_SELF) != FILENAME_TELL_A_FRIEND) include(bts_select(boxes_original, 'tell_a_friend.php'));
  } 
    include(bts_select(boxes_original, 'specials.php'));
    
  require(bts_select(boxes_original, 'whats_new.php'));
  
  require(bts_select(boxes_original, 'reviews.php'));

  if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {
//    include(bts_select(boxes_original, 'languages.php'));
//    include(bts_select(boxes_original, 'currencies.php'));
  }
    require(bts_select(boxes_original, 'information.php'));
  require(bts_select(boxes_original, 'whos_online.php')); 

*/

  if ($banner = tep_banner_exists('dynamic', 'pravysloup')) {
?>

<?php //echo tep_display_banner('static', $banner); ?>
<?php
  }
?>
<div>
<?

//  require(bts_select(boxes_original, 'kniha_mesice.php'));
//require(bts_select(boxes_original, 'time_limited_discount.php'));
?>
<div class="fb-like-box" data-href="http://www.facebook.com/pages/Antrea-sro/190966404268166" data-width="192" data-show-faces="true" data-stream="false" data-header="true"></div>
<a href="http://www.toplist.cz/"><script language="JavaScript" type="text/javascript">
<!--
document.write ('<img src="http://toplist.cz/count.asp?id=8013&logo=bc&http='+escape(document.referrer)+'&t='+escape(document.title)+'" width="88" height="120" border=0 alt="TOPlist" />');
//--></script></a><br />
<font size="1">Přidáno: 16.4. 1999</font><br />
<script src="http://c1.navrcholu.cz/code?site=96972;t=o80" type="text/javascript"></script><noscript><div><a href="http://navrcholu.cz/"><img src="http://c1.navrcholu.cz/hit?site=96972;t=o80;ref=;jss=0" width="80" height="15" alt="NAVRCHOLU.cz" style="border:none" /></a></div></noscript>

<p style="white-space:pre;text-align:left;">
<?=STORE_NAME_ADDRESS ?>
<br><br><a href="/information.php?info_id=16">Zpracování osobních údajů</a>

</p>
<p>
<br>
<a style="text-decoration:none" href="http://purehtml.cz">web design <strong>PureHTML</strong></a>
</p>
</div>