<?
// ============== ONE SERVER CONFIGURATION DEFAULTS ===================================================
//server
  define('META_BASE_URL','x.e-garamond.cz');
  define('META_HTTP_SERVER', 'http://x.e-garamond.cz'); 
  define('META_DIR_FS_DOCUMENT_ROOT', '/home/e-garamond.cz/WWW/x.e-garamond.cz/'); // where the pages are located on the server
//mysql
  define('META_DB_SERVER', 'mysql.jeansolpartre.com'); // eg, localhost - should not be empty for productive servers
  define('META_DB_SERVER_USERNAME', 'egaramonddevel');
  define('META_DB_SERVER_PASSWORD', 'egar8hbj09');
  define('META_DB_DATABASE', 'egaramonddevel');

//jsp new specials ----------------------------------------------------------
  define('PRODUCT_LIST_DESCRIPTION_MAX_LENGTH','200');
  define('PRODUCT_LIST_DESCRIPTION_LONG_MAX_LENGTH','800');
  //shop2.0brain: new: maufacturer = author
  define('MANUFACTURERS_TYPE', 'a'); // '' = standard manufacturers
  //shop2.0brain: new: confirm privacy = jestli vyzadovat potvrzeni u nove registrovanych uzivatelu
  define('READ_PRIVACY_REQUIRED','0'); //1 = true
//specials END ---------------------------------------------------------------

//automaticke nabijeni hodnot
//  define('META_HTTP_SERVER', 'http://' . META_BASE_URL . '/');
  define('META_HTTP_CATALOG_SERVER', META_HTTP_SERVER); //EDIT if need !!!
  define('HTTPS_CATALOG_SERVER', META_HTTPS_SERVER); //EDIT if need !!!
  define('META_HTTP_COOKIE_DOMAIN', META_BASE_URL);
  define('META_DIR_FS_CATALOG', META_DIR_FS_DOCUMENT_ROOT);
  define('META_DIR_FS_ADMIN', META_DIR_FS_DOCUMENT_ROOT . 'admin/'); // absolute pate required
  define('META_DIR_FS_CATALOG', META_DIR_FS_DOCUMENT_ROOT); // absolute path required

  define('META_HTTPS_SERVER', '');
  define('META_ENABLE_SSL', false); 
  define('META_ENABLE_SSL_CATALOG', META_ENABLE_SSL); // secure webserver for catalog module
  define('META_HTTPS_COOKIE_DOMAIN', '');
  define('META_HTTP_COOKIE_PATH', '/');
  define('META_HTTPS_COOKIE_PATH', '');
  define('META_DIR_WS_HTTP_CATALOG', '/');
  define('META_DIR_WS_HTTPS_CATALOG', '');

?>