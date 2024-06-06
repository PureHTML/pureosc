<?php
  require('metaconfigure.php');
// Define the webserver and path parameters
// * DIR_FS_* = Filesystem directories (local/physical)
// * DIR_WS_* = Webserver directories (virtual/URL)
  define('HTTP_SERVER', META_HTTP_SERVER); // eg, http://localhost - should not be empty for productive servers
  define('HTTPS_SERVER', META_HTTPS_SERVER); // eg, https://localhost - should not be empty for productive servers
  define('ENABLE_SSL', META_ENABLE_SSL); // secure webserver for checkout procedure?
  define('HTTP_COOKIE_DOMAIN', META_HTTP_COOKIE_DOMAIN);
  define('HTTPS_COOKIE_DOMAIN', META_HTTPS_COOKIE_DOMAIN);
  define('HTTP_COOKIE_PATH', META_HTTP_COOKIE_PATH);
  define('HTTPS_COOKIE_PATH', META_HTTPS_COOKIE_PATH);
  define('DIR_WS_HTTP_CATALOG', META_DIR_WS_HTTP_CATALOG);
  define('DIR_WS_HTTPS_CATALOG', META_DIR_WS_HTTPS_CATALOG);
  define('DIR_WS_IMAGES', 'images/');
  define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');
  define('DIR_WS_INCLUDES', 'includes/');
  define('DIR_WS_BOXES', DIR_WS_INCLUDES . 'boxes/');
  define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
  define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
  define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');
  define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');

  define('DIR_WS_DOWNLOAD_PUBLIC', 'pub/');
  define('DIR_FS_CATALOG', META_DIR_FS_CATALOG);
  define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');
  define('DIR_FS_DOWNLOAD_PUBLIC', DIR_FS_CATALOG . 'pub/');

// define our database connection
  define('DB_SERVER', META_DB_SERVER); // eg, localhost - should not be empty for productive servers
  define('DB_SERVER_USERNAME', META_DB_SERVER_USERNAME);
  define('DB_SERVER_PASSWORD', META_DB_SERVER_PASSWORD);
  define('DB_DATABASE', META_DB_DATABASE);
  define('USE_PCONNECT', 'false'); // use persistent connections?
  define('STORE_SESSIONS', 'mysql'); // leave empty '' for default handler or set to 'mysql'
  define('DB_PREFIX', ''); //Database table name prefix to use
/*
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
?>