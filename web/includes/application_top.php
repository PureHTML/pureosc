<?php
/*
$Id$

osCommerce, Open Source E-Commerce Solutions
http://www.oscommerce.com

Copyright (c) 2020 osCommerce

Released under the GNU General Public License
*/

// start the timer for the page parse time log
define('PAGE_PARSE_START_TIME', microtime());

// load server configuration parameters
if (file_exists('includes/local/configure.php')) { // for developers
  include('includes/local/configure.php');
} else {
  include('includes/configure.php');
}

if (strlen(DB_SERVER) < 1) {
  if (is_dir('install')) {
    header('Location: install/index.php');
  }
}

// define the project version --- obsolete, now retrieved with tep_get_version()
define('PROJECT_VERSION', 'osCommerce Online Merchant v2.3.5');

// some code to solve compatibility issues
require('includes/functions/compatibility.php');

// set the type of request (secure or not)
$request_type = (getenv('HTTPS') == 'on') ? 'SSL' : 'NONSSL';

// set php_self in the local scope
  if (!isset($PHP_SELF)) $PHP_SELF = $_SERVER['PHP_SELF'];

  if ($request_type == 'NONSSL') {
    define('DIR_WS_CATALOG', DIR_WS_HTTP_CATALOG);
  } else {
    define('DIR_WS_CATALOG', DIR_WS_HTTPS_CATALOG);
  }

// include the list of project filenames
require('includes/filenames.php');

// include the list of project database tables
  require(DIR_WS_INCLUDES . 'database_tables.php');

// customization for the design layout
// removed for BST modified
//  define('BOX_WIDTH', 125); // how wide the boxes should be in pixels (default: 125)

// include the database functions
  require(DIR_WS_FUNCTIONS . 'database.php');

// make a connection to the database... now
  tep_db_connect() or die('Unable to connect to database server!');

// set the application parameters
  $configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from ' . TABLE_CONFIGURATION);
  while ($configuration = tep_db_fetch_array($configuration_query)) {
    define($configuration['cfgKey'], $configuration['cfgValue']);
  }

// if gzip_compression is enabled, start to buffer the output
  if ( (GZIP_COMPRESSION == 'true') && ($ext_zlib_loaded = extension_loaded('zlib')) && (PHP_VERSION >= '4') ) {
    if (($ini_zlib_output_compression = (int)ini_get('zlib.output_compression')) < 1) {
      if (PHP_VERSION >= '4.0.4') {
        ob_start('ob_gzhandler');
      } else {
        include(DIR_WS_FUNCTIONS . 'gzip_compression.php');
        ob_start();
        ob_implicit_flush();
      }
    } else {
      ini_set('zlib.output_compression_level', GZIP_LEVEL);
    }
  }

  function tep_id_check(&$array, $overflow=0 ) {
    if($overflow > 10 )
      exit();
    foreach ($array as $key => $value) {
      if (is_array($value)) {
        $overflow++;
        $array[$key] = tep_id_check($value, $overflow);
        $overflow--;
      }
      elseif( stristr($key, '_id') !== false ) {
        settype($array[$key], 'integer');
      }
    }
    return $array;
  }

  tep_id_check($_GET);
  tep_id_check($_POST);
  reset($_GET);
  reset($_POST);

  $numeric_sec_array = array('page','edit','pid');
  for($i=0,$j=count($numeric_sec_array); $i<$j; $i++ ) {
    if( isset($_GET[$numeric_sec_array[$i]]) ) {
      settype($_GET[$numeric_sec_array[$i]], 'integer');
    }
    if( isset($_POST[$numeric_sec_array[$i]]) ) {
      settype($_POST[$numeric_sec_array[$i]], 'integer');
    }
  }

// set the HTTP GET parameters manually if search_engine_friendly_urls is enabled
  if (SEARCH_ENGINE_FRIENDLY_URLS == 'true') {
    if (strlen(getenv('PATH_INFO')) > 1) {
      $GET_array = array();
      $PHP_SELF = str_replace(getenv('PATH_INFO'), '', $PHP_SELF);
      $vars = explode('/', substr(getenv('PATH_INFO'), 1));
      for ($i=0, $n=sizeof($vars); $i<$n; $i++) {
        if (strpos($vars[$i], '[]')) {
          $GET_array[substr($vars[$i], 0, -2)][] = $vars[$i+1];
        } else {
          $_GET[$vars[$i]] = $vars[$i+1];
        }
        $i++;
      }

      if (sizeof($GET_array) > 0) {
        while (list($key, $value) = each($GET_array)) {
          $_GET[$key] = $value;
        }
      }
    }
  }

// define general functions used application-wide
  require(DIR_WS_FUNCTIONS . 'general.php');
  require(DIR_WS_FUNCTIONS . 'html_output.php');

//jsp:new:events_calendar include calendar class 
require(DIR_WS_CLASSES . 'calendar.php');



// set the cookie domain
$cookie_domain = (($request_type == 'NONSSL') ? HTTP_COOKIE_DOMAIN : HTTPS_COOKIE_DOMAIN);
$cookie_path = (($request_type == 'NONSSL') ? HTTP_COOKIE_PATH : HTTPS_COOKIE_PATH);

// include cache functions if enabled
if (USE_CACHE == 'true') include('includes/functions/cache.php');

// include shopping cart class
  require(DIR_WS_CLASSES . 'shopping_cart.php');

// include navigation history class
  require(DIR_WS_CLASSES . 'navigation_history.php');

// check if sessions are supported, otherwise use the php3 compatible session class
  if (!function_exists('session_start')) {
    define('PHP_SESSION_NAME', 'osCsid');
    define('PHP_SESSION_PATH', $cookie_path);
    define('PHP_SESSION_DOMAIN', $cookie_domain);
    define('PHP_SESSION_SAVE_PATH', SESSION_WRITE_DIRECTORY);

    include(DIR_WS_CLASSES . 'sessions.php');
  }

// define how the session functions will be used
require('includes/functions/sessions.php');

// set the session name and save path
//tep_session_name('osCsid');
tep_session_save_path(SESSION_WRITE_DIRECTORY);

// set the session cookie parameters
session_set_cookie_params(0, $cookie_path, $cookie_domain, ($request_type == 'SSL'));

@ini_set('session.use_only_cookies', (SESSION_FORCE_COOKIE_USE == 'True') ? 1 : 0);

if (version_compare(PHP_VERSION, '7.3.0', '>=')) {
  @ini_set('session.cookie_samesite', 'Lax');
}

// set the session ID if it exists
if (SESSION_FORCE_COOKIE_USE == 'False') {
  if (isset($_GET[tep_session_name()]) && (!isset($_COOKIE[tep_session_name()]) || ($_COOKIE[tep_session_name()] != $_GET[tep_session_name()]))) {
    tep_session_id($_GET[tep_session_name()]);
  } elseif (isset($_POST[tep_session_name()]) && (!isset($_COOKIE[tep_session_name()]) || ($_COOKIE[tep_session_name()] != $_POST[tep_session_name()]))) {
    tep_session_id($_POST[tep_session_name()]);
  }
}

// start the session
$session_started = false;
if (SESSION_FORCE_COOKIE_USE == 'True') {
  tep_setcookie('cookie_test', 'please_accept_for_session', time() + 60 * 60 * 24 * 30, $cookie_path, $cookie_domain);

  if (isset($_COOKIE['cookie_test'])) {
    tep_session_start();
    $session_started = true;
  }
} elseif (SESSION_BLOCK_SPIDERS == 'True') {
  $user_agent = strtolower(getenv('HTTP_USER_AGENT'));
  $spider_flag = false;

  if (!empty($user_agent)) {
    $spiders = file(DIR_WS_INCLUDES . 'spiders.txt');

    for ($i = 0, $n = sizeof($spiders); $i < $n; $i++) {
      if (!empty($spiders[$i])) {
        if (is_integer(strpos($user_agent, trim($spiders[$i])))) {
          $spider_flag = true;
          break;
        }
      }
    }
  }

  if ($spider_flag == false) {
    tep_session_start();
    $session_started = true;
  }
} else {
  tep_session_start();
  $session_started = true;
}

if ($session_started == true) { // force register_globals
  extract($_SESSION, EXTR_OVERWRITE + EXTR_REFS);
}

// initialize a session token
if (!isset($_SESSION['sessiontoken'])) {
  $sessiontoken = md5(tep_rand() . tep_rand() . tep_rand() . tep_rand());
  tep_session_register('sessiontoken');
}

// set SID once, even if empty
$SID = (defined('SID') ? SID : '');

// verify the ssl_session_id if the feature is enabled
if (($request_type == 'SSL') && (SESSION_CHECK_SSL_SESSION_ID == 'True') && (ENABLE_SSL == true) && ($session_started == true)) {
  $ssl_session_id = getenv('SSL_SESSION_ID');
  if (!isset($_SESSION['SSL_SESSION_ID'])) {
    $SESSION_SSL_ID = $ssl_session_id;
    tep_session_register('SESSION_SSL_ID');
  }

    if ($SESSION_SSL_ID != $ssl_session_id) {
      tep_session_destroy();
      tep_redirect(tep_href_link(FILENAME_SSL_CHECK));
    }
  }


// verify the browser user agent if the feature is enabled
if (SESSION_CHECK_USER_AGENT == 'True') {
  $http_user_agent = getenv('HTTP_USER_AGENT');
  if (!isset($_SESSION['SESSION_USER_AGENT'])) {
    $SESSION_USER_AGENT = $http_user_agent;
    tep_session_register('SESSION_USER_AGENT');
  }

    if ($SESSION_USER_AGENT != $http_user_agent) {
      tep_session_destroy();
      tep_redirect(tep_href_link(FILENAME_LOGIN));
    }
  }


// verify the IP address if the feature is enabled
if (SESSION_CHECK_IP_ADDRESS == 'True') {
  $ip_address = tep_get_ip_address();
  if (!isset($_SESSION['SESSION_IP_ADDRESS'])) {
    $SESSION_IP_ADDRESS = $ip_address;
    tep_session_register('SESSION_IP_ADDRESS');
  }

  if ($SESSION_IP_ADDRESS != $ip_address) {
    tep_session_destroy();
    tep_redirect(tep_href_link('login.php'));
  }
}

// create the shopping cart
if (!isset($_SESSION['cart']) || !is_object($cart)) {
  tep_session_register('cart');
  $cart = new shoppingCart;
}

$cart->update_content();

if (!isset($_SESSION['wishlist']) || !is_object($wishlist)) {
  tep_session_register('wishlist');
  $wishlist = new wishList;
}

$wishlist->update_list();
$wishlist->add_products();

// include currencies class and create an instance
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

// include the mail classes
  require(DIR_WS_CLASSES . 'mime.php');
  require(DIR_WS_CLASSES . 'email.php');

// set the language
  if (!tep_session_is_registered('language') || isset($_GET['language'])) {
    if (!tep_session_is_registered('language')) {
      tep_session_register('language');
      tep_session_register('languages_id');
    }

    include(DIR_WS_CLASSES . 'language.php');
    $lng = new language();

    if (isset($_GET['language']) && tep_not_null($_GET['language'])) {
      $lng->set_language($_GET['language']);
    } else {
//jsp:todo:hack vyber jazyka az bude angl, de odkomentovat
//      $lng->get_browser_language();
    	if (empty($lng)) {
        $lng->set_language(DEFAULT_LANGUAGE);
      }
    }

    $language = $lng->language['directory'];
    $languages_id = $lng->language['id'];
  }

// include the language translations
  require(DIR_WS_LANGUAGES . $language . '.php');

// Ultimate SEO URLs v2.1
  if (SEO_ENABLED == 'true') {
    include_once(DIR_WS_CLASSES . 'seo.class.php');
    if ( !is_object($seo_urls) ){
      $seo_urls = new SEO_URL($languages_id);
    }
    define('SEPARATOR_LINK','&'); //musi bejt takle
  } else {
    define('SEPARATOR_LINK','&amp;');
  }

// currency
  if (!tep_session_is_registered('currency') || isset($_GET['currency']) || ( (USE_DEFAULT_LANGUAGE_CURRENCY == 'true') && (LANGUAGE_CURRENCY != $currency) ) ) {
    if (!tep_session_is_registered('currency')) tep_session_register('currency');

    if (isset($_GET['currency']) && $currencies->is_set($_GET['currency'])) {
      $currency = $_GET['currency'];
    } else {
      $currency = (USE_DEFAULT_LANGUAGE_CURRENCY == 'true') ? LANGUAGE_CURRENCY : DEFAULT_CURRENCY;
    }
  }


// navigation history //shop2.0brain:bugfix http://webglobalnet.net/support/index.php?topic=1684.msg4203
  if (tep_session_is_registered('navigation')) {
    if (PHP_VERSION < 4) {
      $broken_navigation = $navigation;
      $navigation = new navigationHistory;
      $navigation->unserialize($broken_navigation);
    } else {
      $navigation = new navigationHistory;
    }
  } else {
    tep_session_register('navigation');
    $navigation = new navigationHistory;
  }
  $navigation->add_current_page();


// Shopping cart actions
if (isset($_GET['action'])) {
// redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled
    if ($session_started == false) {
      tep_redirect(tep_href_link(FILENAME_COOKIE_USAGE));
    }

    if (DISPLAY_CART == 'true') {
      $goto =  FILENAME_SHOPPING_CART;
      $parameters = array('action', 'cPath', 'products_id', 'pid');

        /* Optional Related Products (ORP) */
            } elseif ($_GET['action'] == 'rp_buy_now') {
              $goto = FILENAME_PRODUCT_INFO;
              $parameters = array('action', 'pid', 'rp_products_id');
        //ORP: end

    } else {
      $goto = basename($PHP_SELF);
      if ($_GET['action'] == 'buy_now') {
        $parameters = array('action', 'pid', 'products_id');
      } else {
        $parameters = array('action', 'pid');
      }
    }
    switch ($_GET['action']) {
      // customer wants to update the product quantity in their shopping cart
      case 'update_product' : for ($i=0, $n=sizeof($_POST['products_id']); $i<$n; $i++) {
                                if (in_array($_POST['products_id'][$i], (is_array($_POST['cart_delete']) ? $_POST['cart_delete'] : array()))) {
                                  $cart->remove($_POST['products_id'][$i]);
                                } else {
                                  if (PHP_VERSION < 4) {
                                    // if PHP3, make correction for lack of multidimensional array.
                                    reset($_POST);
                                    while (list($key, $value) = each($_POST)) {
                                      if (is_array($value)) {
                                        while (list($key2, $value2) = each($value)) {
                                          if (ereg ("(.*)\]\[(.*)", $key2, $var)) {
                                            $id2[$var[1]][$var[2]] = $value2;
                                          }
                                        }
                                      }
                                    }
                                    $attributes = ($id2[$_POST['products_id'][$i]]) ? $id2[$_POST['products_id'][$i]] : '';
                                  } else {
                                    $attributes = ($_POST['id'][$_POST['products_id'][$i]]) ? $_POST['id'][$_POST['products_id'][$i]] : '';
                                  }
                                  $cart->add_cart($_POST['products_id'][$i], $_POST['cart_quantity'][$i], $attributes, false);
                                }
                              }
                              tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
                              break;
      // customer adds a product from the products page
      case 'add_product' :    if (isset($_POST['products_id']) && is_numeric($_POST['products_id'])) {
                                $cart->add_cart($_POST['products_id'], $cart->get_quantity(tep_get_uprid($_POST['products_id'], $_POST['id']))+ (int)$_POST['quantity'], $_POST['id']);
                              }
                              tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
                              break;
      // performed by the 'buy now' button in product listings and review page
      case 'buy_now' :        if (isset($_GET['products_id'])) {
                                if (tep_has_product_attributes($_GET['products_id'])) {
                                  tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['products_id']));
                                } else {
                                  $cart->add_cart($_GET['products_id'], $cart->get_quantity($_GET['products_id'])+1);
                                }
                              }
                              tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
                              break;

         /* Optional Related Products (ORP) */
          case 'rp_buy_now' :     if (isset($_GET['rp_products_id'])) {
                                    if (tep_has_product_attributes($_GET['rp_products_id'])) {
                                      tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['rp_products_id']));
                                    } else {
                                      $cart->add_cart($_GET['rp_products_id'], $cart->get_quantity($_GET['rp_products_id'])+1);
                                    }
                                  }
                                  tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
                                  break;
          //ORP: end

      case 'notify' :         if (tep_session_is_registered('customer_id')) {
                                if (isset($_GET['products_id'])) {
                                  $notify = $_GET['products_id'];
                                } elseif (isset($_GET['notify'])) {
                                  $notify = $_GET['notify'];
                                } elseif (isset($_POST['notify'])) {
                                  $notify = $_POST['notify'];
                                } else {
                                  tep_redirect(tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action', 'notify'))));
                                }
                                if (!is_array($notify)) $notify = array($notify);
                                for ($i=0, $n=sizeof($notify); $i<$n; $i++) {
                                  $check_query = tep_db_query("select count(*) as count from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . $notify[$i] . "' and customers_id = '" . $customer_id . "'");
                                  $check = tep_db_fetch_array($check_query);
                                  if ($check['count'] < 1) {
                                    tep_db_query("insert into " . TABLE_PRODUCTS_NOTIFICATIONS . " (products_id, customers_id, date_added) values ('" . $notify[$i] . "', '" . $customer_id . "', now())");
                                  }
                                }
                                tep_redirect(tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action', 'notify'))));
                              } else {
                                $navigation->set_snapshot();
				tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
                              }
                              break;
      case 'notify_remove' :  if (tep_session_is_registered('customer_id') && isset($_GET['products_id'])) {
                                $check_query = tep_db_query("select count(*) as count from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . $_GET['products_id'] . "' and customers_id = '" . $customer_id . "'");
                                $check = tep_db_fetch_array($check_query);
                                if ($check['count'] > 0) {
                                  tep_db_query("delete from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . $_GET['products_id'] . "' and customers_id = '" . $customer_id . "'");
                                }
                                tep_redirect(tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action'))));
                              } else {
                                $navigation->set_snapshot();
                                tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
                              }
                              break;
      case 'cust_order' :     if (tep_session_is_registered('customer_id') && isset($_GET['pid'])) {
                                if (tep_has_product_attributes($_GET['pid'])) {
                                  tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['pid']));
                                } else {
                                  $cart->add_cart($_GET['pid'], $cart->get_quantity($_GET['pid'])+1);
                                }
                              }
                              tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
                              break;
    }
  }

//jsp:new:events_calendar // include the who's online functions
if (basename($PHP_SELF) != FILENAME_EVENTS_CALENDAR_CONTENT){
require(DIR_WS_FUNCTIONS . 'whos_online.php');
tep_update_whos_online();
}
// include the password crypto functions
  require(DIR_WS_FUNCTIONS . 'password_funcs.php');

// include validation functions (right now only email address)
  require(DIR_WS_FUNCTIONS . 'validations.php');

// split-page-results
  require(DIR_WS_CLASSES . 'split_page_results.php');

// BOF BTS
  require(DIR_WS_INCLUDES . 'configure_bts.php');
// modified for BTS m
if ( is_file( DIR_WS_BOX_TEMPLATES . 'boxes.php' )) {
  include ( DIR_WS_BOX_TEMPLATES . 'boxes.php' );
} else {
  include ( 'templates/fallback/boxes/boxes.php' );
}
// infobox
//  require(DIR_WS_CLASSES . 'boxes.php');
// EOF BTS

// Points/Rewards Module V2.00
  require(DIR_WS_FUNCTIONS . 'redemptions.php');

// auto activate and expire banners
  require(DIR_WS_FUNCTIONS . 'banner.php');
  tep_activate_banners();
  tep_expire_banners();

// auto expire special products
  require(DIR_WS_FUNCTIONS . 'specials.php');
  tep_expire_specials();

// calculate category path
  if (isset($_GET['cPath'])) {
    $cPath = $_GET['cPath'];
  } elseif (isset($_GET['products_id']) && !isset($_GET['manufacturers_id'])) {
    $cPath = tep_get_product_path($_GET['products_id']);
  } else {
    $cPath = '';
  }

  if (tep_not_null($cPath)) {
    $cPath_array = tep_parse_category_path($cPath);
    $cPath = implode('_', $cPath_array);
    $current_category_id = $cPath_array[(sizeof($cPath_array)-1)];
  } else {
    $current_category_id = 0;
  }

// include the breadcrumb class and start the breadcrumb trail
  require(DIR_WS_CLASSES . 'breadcrumb.php');
  $breadcrumb = new breadcrumb;

//  $breadcrumb->add(HEADER_TITLE_TOP, HTTP_SERVER);
  $breadcrumb->add(HEADER_TITLE_CATALOG, tep_href_link(FILENAME_DEFAULT));

// add category names or the manufacturer name to the breadcrumb trail
  if (isset($cPath_array)) {
    for ($i=0, $n=sizeof($cPath_array); $i<$n; $i++) {
//################## Added Enable / Disable Categories #################
//      $categories_query = tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$cPath_array[$i] . "' and language_id = '" . (int)$languages_id . "'");
      $categories_query = tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " cd left join " . TABLE_CATEGORIES . " c on cd.categories_id = c.categories_id where c.categories_status = '1' and cd.categories_id = '" . (int)$cPath_array[$i] . "' and cd.language_id = '" . (int)$languages_id . "'");
//################## End Enable / Disable Categories #################
      if (tep_db_num_rows($categories_query) > 0) {
        $categories = tep_db_fetch_array($categories_query);
        $breadcrumb->add($categories['categories_name'], tep_href_link(FILENAME_DEFAULT, 'cPath=' . implode('_', array_slice($cPath_array, 0, ($i+1)))));
      } else {
        break;
      }
    }
  } elseif (isset($_GET['manufacturers_id'])) {
    $manufacturers_query = tep_db_query("select manufacturers_name from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "'");
    if (tep_db_num_rows($manufacturers_query)) {
      $manufacturers = tep_db_fetch_array($manufacturers_query);
      $breadcrumb->add($manufacturers['manufacturers_name'], tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $_GET['manufacturers_id']));
    }
  }

// add the products model to the breadcrumb trail
  if (isset($_GET['products_id'])) {
//################## Added Enable / Disable Categories #################
//  $model_query = tep_db_query("select products_model from " . TABLE_PRODUCTS . " where products_id = '" . (int)$_GET['products_id'] . "'");
    $model_query = tep_db_query("select p.products_model from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c on p.products_id = p2c.products_id left join " . TABLE_CATEGORIES . " c on p2c.categories_id = c.categories_id, " . TABLE_PRODUCTS_DESCRIPTION . "  pd where c.categories_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and p.products_id = pd.products_id");
//################## End Enable / Disable Categories #################
    if (tep_db_num_rows($model_query)) {
      $model = tep_db_fetch_array($model_query);
/* Michela non modello gioved 10 maggio 2007*/
//	  $breadcrumb->add($model['products_model'], tep_href_link(FILENAME_PRODUCT_INFO, 'cPath=' . $cPath . SEPARATOR_LINK . 'products_id=' . $_GET['products_id']));
    }
  }


/* Michela venerd 11 maggio 2007 
inserisco il nome del prodotto nel breadcrumb
*/
// add the products name and model to the breadcrumb trail
  if (isset($_GET['products_id'])) {
//################## Added Enable / Disable Categories #################
//  $model_query = tep_db_query("select products_model from " . TABLE_PRODUCTS . " where products_id = '" . (int)$_GET['products_id'] . "'");
    $model_query = tep_db_query("select p.products_model from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c on p.products_id = p2c.products_id left join " . TABLE_CATEGORIES . " c on p2c.categories_id = c.categories_id, " . TABLE_PRODUCTS_DESCRIPTION . "  pd where c.categories_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and p.products_id = pd.products_id");
//################## End Enable / Disable Categories #################

    $name_query = tep_db_query("select p.products_name from " . TABLE_PRODUCTS_DESCRIPTION . " p left join " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c on p.products_id = p2c.products_id left join " . TABLE_CATEGORIES . " c on p2c.categories_id = c.categories_id, " . TABLE_PRODUCTS_DESCRIPTION . "  pd where c.categories_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and p.products_id = pd.products_id and p.language_id = '" . (int)$languages_id . "'");
	
	$nome_prodotto='';

    if (tep_db_num_rows($name_query)) {
      $nome = tep_db_fetch_array($name_query);
		$nome_prodotto .=$nome['products_name'];
    }

    if (tep_db_num_rows($model_query)) {
      $model = tep_db_fetch_array($model_query);
		$nome_prodotto .=' ['.$model['products_model'].']';
    }

	  $breadcrumb->add($nome_prodotto, tep_href_link(FILENAME_PRODUCT_INFO, 'cPath=' . $cPath . SEPARATOR_LINK . 'products_id=' . $_GET['products_id']));
  }
  
// include the articles functions//////////////////////////////// ARTICLES START /////////////////
  require(DIR_WS_FUNCTIONS . 'articles.php');
  require(DIR_WS_FUNCTIONS . 'article_header_tags.php'); 

// calculate topic path
  if (isset($HTTP_GET_VARS['tPath'])) {
    $tPath = $HTTP_GET_VARS['tPath'];
  } elseif (isset($HTTP_GET_VARS['articles_id']) && !isset($HTTP_GET_VARS['authors_id'])) {
    $tPath = tep_get_article_path($HTTP_GET_VARS['articles_id']);
  } else {
    $tPath = '';
  }

  if (tep_not_null($tPath)) {
    $tPath_array = tep_parse_topic_path($tPath);
    $tPath = implode('_', $tPath_array);
    $current_topic_id = $tPath_array[(sizeof($tPath_array)-1)];
  } else {
    $current_topic_id = 0;
  }

// add topic names or the author name to the breadcrumb trail
  if (isset($tPath_array)) {
    for ($i=0, $n=sizeof($tPath_array); $i<$n; $i++) {
      $topics_query = tep_db_query("select topics_name from " . TABLE_TOPICS_DESCRIPTION . " where topics_id = '" . (int)$tPath_array[$i] . "' and language_id = '" . (int)$languages_id . "'");
      if (tep_db_num_rows($topics_query) > 0) {
        $topics = tep_db_fetch_array($topics_query);
        $breadcrumb->add($topics['topics_name'], tep_href_link(FILENAME_ARTICLES, 'tPath=' . implode('_', array_slice($tPath_array, 0, ($i+1)))));
      } else {
        break;
      }
    }
  } elseif (isset($HTTP_GET_VARS['authors_id'])) {
    $authors_query = tep_db_query("select authors_name from " . TABLE_AUTHORS . " where authors_id = '" . (int)$HTTP_GET_VARS['authors_id'] . "'");
    if (tep_db_num_rows($authors_query)) {
      $authors = tep_db_fetch_array($authors_query);
      $breadcrumb->add('Articles by ' . $authors['authors_name'], tep_href_link(FILENAME_ARTICLES, 'authors_id=' . $HTTP_GET_VARS['authors_id']));
    }
  }

// add the articles name to the breadcrumb trail
  if (isset($HTTP_GET_VARS['articles_id'])) {
    $article_query = tep_db_query("select articles_name from " . TABLE_ARTICLES_DESCRIPTION . " where articles_id = '" . (int)$HTTP_GET_VARS['articles_id'] . "'");
    if (tep_db_num_rows($article_query)) {
      $article = tep_db_fetch_array($article_query);
      if (isset($HTTP_GET_VARS['authors_id'])) {
        $breadcrumb->add($article['articles_name'], tep_href_link(FILENAME_ARTICLE_INFO, 'authors_id=' . $HTTP_GET_VARS['authors_id'] . '&articles_id=' . $HTTP_GET_VARS['articles_id']));
      } else {
        $breadcrumb->add($article['articles_name'], tep_href_link(FILENAME_ARTICLE_INFO, 'tPath=' . $tPath . '&articles_id=' . $HTTP_GET_VARS['articles_id']));
      }
    }
  }
// add only if Header Tags not already installed
  require(DIR_WS_FUNCTIONS . 'clean_html_comments.php');


//////////////////////////////// ARTICLES END /////////////////  
  
// initialize the message stack for output messages
  require(DIR_WS_CLASSES . 'message_stack.php');
  $messageStack = new messageStack;

// set which precautions should be checked
  define('WARN_INSTALL_EXISTENCE', 'true');
  define('WARN_CONFIG_WRITEABLE', 'true');
  define('WARN_SESSION_DIRECTORY_NOT_WRITEABLE', 'true');
  define('WARN_SESSION_AUTO_START', 'true');
  define('WARN_DOWNLOAD_DIRECTORY_NOT_READABLE', 'true');

// stat v3
   count_store_viewed(getenv("REMOTE_ADDR"));
// end

require(DIR_WS_INCLUDES . 'add_ccgvdc_application_top.php');  // ICW CREDIT CLASS Gift Voucher Addittion

//Do the superstats business
//jsp:stop  
/*
  require(DIR_WS_CLASSES . 'supertracker.php');
        $tracker = new supertracker;
        $tracker->update();
*/
//jsp:pwa
  if (tep_session_is_registered('customer_id') && tep_session_is_registered('customer_is_guest') && substr(basename($PHP_SELF),0,7)=='account') tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
// PWA EOF
//jsp:admin frontend
if ( ($_SESSION['customer_id']==ADMIN_USER_ID_0) || ($_SESSION['customer_id']==ADMIN_USER_ID_1) || ($_SESSION['customer_id']==ADMIN_USER_ID_2) || ($_SESSION['customer_id']==ADMIN_USER_ID_3) || ($_SESSION['customer_id']==ADMIN_USER_ID_4) || ($_SESSION['customer_id']==ADMIN_USER_ID_5) ) define('ADMIN_LOGIN','1'); 

//jsp:new:ankety
// set the pollbooth parameters (can be modified through the administration tool)
$configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from phesis_poll_config');

while ($configuration = tep_db_fetch_array($configuration_query)) {
     define($configuration['cfgKey'], $configuration['cfgValue']);
     }
//poll end
