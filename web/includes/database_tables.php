<?php 
/*
  $Id: database_tables.php,v 1.1 2003/03/14 02:10:58 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
  // Add-on - Information Pages Unlimited
  define('TABLE_INFORMATION', DB_PREFIX . 'information');
  define('TABLE_INFORMATION_GROUP', DB_PREFIX . 'information_group');

// define the database table names used in the project
  define('TABLE_ADDRESS_BOOK', DB_PREFIX . 'address_book');
  define('TABLE_ADDRESS_FORMAT', DB_PREFIX . 'address_format');
  define('TABLE_BANNERS', DB_PREFIX . 'banners');
  define('TABLE_BANNERS_HISTORY', DB_PREFIX . 'banners_history');
  define('TABLE_CATEGORIES', DB_PREFIX . 'categories');
  define('TABLE_CATEGORIES_DESCRIPTION', DB_PREFIX . 'categories_description');
  define('TABLE_CONFIGURATION', DB_PREFIX . 'configuration');
  define('TABLE_CONFIGURATION_GROUP', DB_PREFIX . 'configuration_group');
  define('TABLE_COUNTER', DB_PREFIX . 'counter');
  define('TABLE_COUNTER_HISTORY', DB_PREFIX . 'counter_history');
  define('TABLE_COUNTRIES', DB_PREFIX . 'countries');
  define('TABLE_CURRENCIES', DB_PREFIX . 'currencies');
  define('TABLE_CUSTOMERS', DB_PREFIX . 'customers');
  define('TABLE_CUSTOMERS_BASKET', DB_PREFIX . 'customers_basket');
  define('TABLE_CUSTOMERS_BASKET_ATTRIBUTES', DB_PREFIX . 'customers_basket_attributes');
  define('TABLE_CUSTOMERS_INFO', DB_PREFIX . 'customers_info');
  define('TABLE_CUSTOMERS_POINTS_PENDING', DB_PREFIX . 'customers_points_pending');//Points/Rewards Module V2.00
  define('TABLE_LANGUAGES', DB_PREFIX . 'languages');
  define('TABLE_MANUFACTURERS', DB_PREFIX . 'manufacturers');
  define('TABLE_MANUFACTURERS_INFO', DB_PREFIX . 'manufacturers_info');
  define('TABLE_ORDERS', DB_PREFIX . 'orders');
  define('TABLE_ORDERS_PRODUCTS', DB_PREFIX . 'orders_products');
  define('TABLE_ORDERS_PRODUCTS_ATTRIBUTES', DB_PREFIX . 'orders_products_attributes');
  define('TABLE_ORDERS_PRODUCTS_DOWNLOAD', DB_PREFIX . 'orders_products_download');
  define('TABLE_ORDERS_STATUS', DB_PREFIX . 'orders_status');
  define('TABLE_ORDERS_STATUS_HISTORY', DB_PREFIX . 'orders_status_history');
  define('TABLE_ORDERS_TOTAL', DB_PREFIX . 'orders_total');
  define('TABLE_PRODUCTS', DB_PREFIX . 'products');
  define('TABLE_PRODUCTS_ATTRIBUTES', DB_PREFIX . 'products_attributes');
  define('TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD', DB_PREFIX . 'products_attributes_download');
  define('TABLE_PRODUCTS_DESCRIPTION', DB_PREFIX . 'products_description');
  define('TABLE_PRODUCTS_NOTIFICATIONS', DB_PREFIX . 'products_notifications');
  define('TABLE_PRODUCTS_OPTIONS', DB_PREFIX . 'products_options');
  define('TABLE_PRODUCTS_OPTIONS_VALUES', DB_PREFIX . 'products_options_values');
  define('TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS', DB_PREFIX . 'products_options_values_to_products_options');
  define('TABLE_PRODUCTS_TO_CATEGORIES', DB_PREFIX . 'products_to_categories');
  define('TABLE_REVIEWS', DB_PREFIX . 'reviews');
  define('TABLE_REVIEWS_DESCRIPTION', DB_PREFIX . 'reviews_description');
  define('TABLE_SESSIONS', DB_PREFIX . 'sessions');
  define('TABLE_SPECIALS', DB_PREFIX . 'specials');
  define('TABLE_TAX_CLASS', DB_PREFIX . 'tax_class');
  define('TABLE_TAX_RATES', DB_PREFIX . 'tax_rates');
  define('TABLE_GEO_ZONES', DB_PREFIX . 'geo_zones');
  define('TABLE_ZONES_TO_GEO_ZONES', DB_PREFIX . 'zones_to_geo_zones');
  define('TABLE_WHOS_ONLINE', DB_PREFIX . 'whos_online');
  define('TABLE_ZONES', DB_PREFIX . 'zones');

// stat v3
  define('TABLE_STORE_VIEWED', DB_PREFIX . 'store_viewed');
  define('TABLE_STORE_HISTORY', DB_PREFIX . 'store_history');
  define('TABLE_STORE_PRODUCTS_HISTORY', DB_PREFIX . 'store_products_history');
// end

  //dynamic sitemap control
  define('TABLE_SITEMAP_EXCLUDE', DB_PREFIX . 'sitemap_exclude');
  
define('TABLE_PAGES', DB_PREFIX . 'pages');
define('TABLE_PAGES_DESCRIPTION', DB_PREFIX . 'pages_description');

// multi images
define('TABLE_PRODUCTS_IMAGES', DB_PREFIX . 'products_images');

// JUST SPIFFY Category Descriptions
define('TABLE_CAT_DESCRIPT', DB_PREFIX . 'cat_descript');
// END JUST SPIFFY Category Descriptions

  //TotalB2B start
  define('TABLE_CUSTOMERS_GROUPS', DB_PREFIX . 'customers_groups');
  define('TABLE_MANUDISCOUNT', DB_PREFIX . 'manudiscount');
  //TotalB2B end

// BOF Anti Robot Registration v2.6
  define('TABLE_ANTI_ROBOT_REGISTRATION', DB_PREFIX . 'anti_robotreg');
// EOF Anti Robot Registration v2.6

/* Optional Related Products (ORP) */
  define('TABLE_PRODUCTS_RELATED_PRODUCTS', DB_PREFIX . 'products_related_products');
//ORP: end

  define('TABLE_CACHE_SEO', DB_PREFIX . 'cache');
  define('TABLE_ARTICLE_REVIEWS', 'article_reviews');
  define('TABLE_ARTICLE_REVIEWS_DESCRIPTION', 'article_reviews_description');
  define('TABLE_ARTICLES', 'articles');
  define('TABLE_ARTICLES_DESCRIPTION', 'articles_description');
  define('TABLE_ARTICLES_TO_TOPICS', 'articles_to_topics');
  define('TABLE_ARTICLES_XSELL', 'articles_xsell');
  define('TABLE_AUTHORS', 'authors');
  define('TABLE_AUTHORS_INFO', 'authors_info');
  define('TABLE_TOPICS', 'topics');
  define('TABLE_TOPICS_DESCRIPTION', 'topics_description');

//jsp:new:events_calendar //events_calendar
  define('TABLE_EVENTS_CALENDAR', 'events_calendar');

?>