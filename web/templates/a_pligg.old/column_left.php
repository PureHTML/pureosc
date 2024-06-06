<div align="left" style="padding-left:10px;padding-top:60px;background: #8f2005;">
<form name="quick_find" action="/advanced_search_result.php"
method="get"> <input
style="width:160px;border:0px none" alt="keywords" type="text" name="keywords"
id="keywords"   size="16" maxlength="30" onfocus="this.value=''; this.style.padding='0px'; this.style.color='#000000';" value="vyhledat"
/>
</form>
</div>
<div style="background: #8f2005;">
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
  if ((USE_CACHE == 'true') && empty($SID)) {
    echo tep_cache_manufacturers_box();
  } else {
    include(bts_select(boxes_original, 'manufacturers.php'));
  }
?>
</div>
<div class="BoxesInfoBoxHeadingCenterBoxTitle"> 
<a class="nadpis1" href="/">novinky</a>
</div>
<br />
<?
  if ((USE_CACHE == 'true') && empty($SID)) {
    echo tep_cache_categories_box();
  } else {
    include(bts_select(boxes_original, 'categories.php'));
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

<?php echo tep_display_banner('static', $banner); ?>
<?php
  }
?>
<div class="BoxesInfoBoxHeadingCenterBoxTitle"> 
<a class="nadpis1" href="/specials.php">zlevněné knihy</a>
</div>
<br />
<img src="i/sleva20.gif"><br />&nbsp;
<div class="BoxRamecekTop"> 
<a class="nadpis1" href="/?f=3">připravujeme</a>
</div>
<div class="BoxRamecekTop"> 
<a class="nadpis1" href="/?f=1">ukázky</a>
</div>
<div class="BoxRamecekTop"> 
<a class="nadpis1" href="/?f=2">recenze</a>
</div>
<div class="BoxRamecekTop"> 
<a class="nadpis1" href="/edicni-plan-v-pdf-i-6.html">Ediční plán v PDF</a>
</div>
<br />
<div style="width:195px">
<?

//  require(bts_select(boxes_original, 'kniha_mesice.php'));
  require(bts_select(boxes_original, 'specials_timed.php'));
  require(bts_select(boxes_original, 'specials_timed2.php'));
?>
</div>