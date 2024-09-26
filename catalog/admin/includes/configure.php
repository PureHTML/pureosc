<?php
define('HTTP_SERVER', 'http://dvere.local');
define('HTTPS_SERVER', '');
define('ENABLE_SSL', false);
define('HTTP_COOKIE_DOMAIN', '');
define('HTTPS_COOKIE_DOMAIN', '');
define('HTTP_COOKIE_PATH', '/admin');
define('HTTPS_COOKIE_PATH', '/admin');
define('HTTP_CATALOG_SERVER', 'http://dvere.local');
define('HTTPS_CATALOG_SERVER', '');
define('ENABLE_SSL_CATALOG', 'false');
define('DIR_FS_DOCUMENT_ROOT', '/home/f/git/dvere.local/dverecom/catalog/');
define('DIR_WS_ADMIN', '/admin/');
define('DIR_WS_HTTPS_ADMIN', '/admin/');
define('DIR_FS_ADMIN', '/home/f/git/dvere.local/dverecom/catalog/admin/');
define('DIR_WS_CATALOG', '/');
define('DIR_WS_HTTPS_CATALOG', '/');
define('DIR_FS_CATALOG', '/home/f/git/dvere.local/dverecom/catalog/');
define('DIR_WS_IMAGES', 'images/');
define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');
define('DIR_WS_CATALOG_IMAGES', DIR_WS_CATALOG . 'images/');
define('DIR_WS_INCLUDES', 'includes/');
define('DIR_WS_BOXES', DIR_WS_INCLUDES . 'boxes/');
define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');
define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');
define('DIR_WS_CATALOG_LANGUAGES', DIR_WS_CATALOG . 'includes/languages/');
define('DIR_FS_CATALOG_LANGUAGES', DIR_FS_CATALOG . 'includes/languages/');
define('DIR_FS_CATALOG_IMAGES', DIR_FS_CATALOG . 'images/');
define('DIR_FS_CATALOG_MODULES', DIR_FS_CATALOG . 'includes/modules/');
define('DIR_FS_BACKUP', DIR_FS_ADMIN . 'backups/');
define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');
define('DIR_FS_DOWNLOAD_PUBLIC', DIR_FS_CATALOG . 'pub/');

define('DB_SERVER', 'localhost');
define('DB_PORT', '3306');
define('DB_CHARSET', 'utf8');

define('DB_SERVER_USERNAME', 'dvere');
define('DB_SERVER_PASSWORD', 'dvere');

//define('DB_SERVER_ROOT_USERNAME', 'vanilla');
//define('DB_SERVER_ROOT_PASSWORD', 'osc');

define('DB_DATABASE', 'dvere');
define('USE_PCONNECT', 'false');
define('STORE_SESSIONS', 'mysql');
define('CFG_TIME_ZONE', 'Europe/Prague');
