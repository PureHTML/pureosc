<?php
  /**
  *
  * ULTIMATE Seo Urls 5 PRO ( version 1.1 )
  *
  * 
  * @package USU5_PRO
  * @license http://www.opensource.org/licenses/gpl-2.0.php GNU Public License
  * @link http://www.fwrmedia.co.uk
  * @copyright Copyright 2008-2009 FWR Media
  * @copyright Portions Copyright 2005 ( rewrite uri concept ) Bobby Easland
  * @author Robert Fisher, FWR Media, http://www.fwrmedia.co.uk 
  * @lastdev $Author:: Rob                                              $:  Author of last commit
  * @lastmod $Date:: 2011-02-28 11:13:41 +0000 (Mon, 28 Feb 2011)       $:  Date of last commit
  * @version $Rev:: 200                                                 $:  Revision of last commit
  * @Id $Id:: installer_constants.php 200 2011-02-28 11:13:41Z Rob      $:  Full Details   
  */
  
  /**
  * Arrays of configuration constants for the installer
  * @package USU5_PRO
  * @uses class_exists()
  * @uses date()
  */

  /**
  * Array of configuration constants as used by USU5 PRO
  * 
  * @var array $usu51
  */
  $usu51 =     array( 'USU5_RESET_CACHE',      'USU5_ENABLED',                   'USU5_CACHE_ON',                 'USU5_URLS_TYPE',
                      'USU5_CHAR_CONVERT_SET', 'USU5_FILTER_SHORT_WORDS',        'USU5_REMOVE_ALL_SPEC_CHARS',    'USU5_CACHE_DAYS',
                      'USU5_USE_W3C_VALID',    'USU5_ADD_CPATH_TO_PRODUCT_URLS', 'USU5_OUPUT_PERFORMANCE',        'USU5_ADD_CAT_PARENT', 
                      'USU5_DEBUG_OUPUT_VARS', 'USU5_CACHE_SYSTEM',              'USU5_PRODUCTS_LINK_TEXT_ORDER', 'USU5_MULTI_LANGUAGE_SEO_SUPPORT',
                      'USU5_HOME_PAGE_REDIRECT' );
  /**
  * Array of configuration constants as used by USU5
  * 
  * @var array $usu5
  */                  
  $usu5 = array( 'SEO_URLS_RESET_CACHE',               'SEO_URLS_ENABLED',               'SEO_URLS_TYPE',           'SEO_URLS_CHAR_CONVERT_SET', 
                 'SEO_URLS_FILTER_SHORT_WORDS',        'SEO_URLS_REMOVE_ALL_SPEC_CHARS', 'SEO_URLS_CACHE_DAYS',     'SEO_URLS_USE_W3C_VALID',
                 'SEO_URLS_ADD_CPATH_TO_PRODUCT_URLS', 'SEO_URLS_OUPUT_PERFORMANCE',     'SEO_URLS_ADD_CAT_PARENT', 'SEO_URLS_CACHE_SYSTEM' );   
  /**
  * Array of configuration constants as used by Chemos old series 2 seo urls ( including modifications by jack_mcs )
  * 
  * @var array $usu5
  */                 
  $seo_urls2 = array ( 'SEO_ENABLED',                       'SEO_ADD_CID_TO_PRODUCT_URLS', 'SEO_ADD_CPATH_TO_PRODUCT_URLS', 'SEO_ADD_CAT_PARENT', 
                       'SEO_URLS_FILTER_SHORT_WORDS',       'SEO_URLS_USE_W3C_VALID',      'USE_SEO_CACHE_GLOBAL',          'USE_SEO_CACHE_PRODUCTS', 
                       'USE_SEO_CACHE_CATEGORIES',          'USE_SEO_CACHE_MANUFACTURERS', 'USE_SEO_CACHE_ARTICLES',        'USE_SEO_CACHE_TOPICS', 
                       'USE_SEO_CACHE_FAQDESK_CATEGORIES',  'USE_SEO_CACHE_INFO_PAGES',    'USE_SEO_CACHE_LINKS',           'USE_SEO_CACHE_NEWSDESK_ARTICLES', 
                       'USE_SEO_CACHE_NEWSDESK_CATEGORIES', 'USE_SEO_CACHE_POLLBOOTH',     'USE_SEO_CACHE_PAGE_EDITOR',     'USE_SEO_REDIRECT', 
                       'USE_SEO_HEADER_TAGS',               'USE_SEO_PERFORMANCE_CHECK',   'SEO_REWRITE_TYPE',              'SEO_CHAR_CONVERT_SET',
                       'SEO_REMOVE_ALL_SPEC_CHARS',         'SEO_URLS_CACHE_RESET',        'SEO_URLS_UNINSTALL',            'SEO_URLS_DB_UNINSTALL' );
  /**
  * Array of USU5 PRO configuration group keys and values
  * 
  * @var array $usu5_config_group
  */                      
  $usu5_config_group = array( 'configuration_group_id'          => '\'[--config_group_id--]\'',
                              'configuration_group_title'       => '\'Seo Urls 5\'',
                              'configuration_group_description' => '\'Options for ULTIMATE Seo Urls 5 by FWR Media\'',
                              'sort_order'                      => '\'[--sort_order--]\'',
                              'visible'                         => '\'1\'' );
  /**
  * Set the default cache strategy to SQLite unless the class does not exist when we default to file.                            
  */
  if ( !class_exists( 'SQLiteDatabase' ) ) {
    $standard_cache_strategy = 'file';
  } else $standard_cache_strategy = 'sqlite';
  /**
  * Array of USU5 PRO configuration table keys and values
  * 
  * @var array $usu5_config
  */                            
  $usu5_config = array( array( 'configuration_title'       => '\'Enable SEO URLs 5?\'',
                               'configuration_key'         => '\'USU5_ENABLED\'',
                               'configuration_value'       => '\'true\'',
                               'configuration_description' => '\'Turn Seo Urls 5 on\'',
                               'configuration_group_id'    => '\'[--config_group_id--]\'',
                               'sort_order'                => '\'1\'',
                               'last_modified'             => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                               'date_added'                => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                               'set_function'              => '\'tep_cfg_select_option(array(\\\'true\\\', \\\'false\\\'), \'' ),
                        array( 'configuration_title'       => '\'Enable the cache?\'',
                               'configuration_key'         => '\'USU5_CACHE_ON\'',
                               'configuration_value'       => '\'true\'',
                               'configuration_description' => '\'Turn the cache system on\'',
                               'configuration_group_id'    => '\'[--config_group_id--]\'',
                               'sort_order'                => '\'2\'',
                               'last_modified'             => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                               'date_added'                => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                               'set_function'              => '\'tep_cfg_select_option(array(\\\'true\\\', \\\'false\\\'), \'' ),
                        array( 'configuration_title'       => '\'Enable multi language support?\'',
                               'configuration_key'         => '\'USU5_MULTI_LANGUAGE_SEO_SUPPORT\'',
                               'configuration_value'       => '\'false\'',
                               'configuration_description' => '\'Enable the multi language functionality\'',
                               'configuration_group_id'    => '\'[--config_group_id--]\'',
                               'sort_order'                => '\'3\'',
                               'last_modified'             => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                               'date_added'                => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                               'set_function'              => '\'tep_cfg_select_option(array(\\\'true\\\', \\\'false\\\'), \'' ),
                        array( 'configuration_title'       => '\'Output W3C valid URLs?\'',
                               'configuration_key'         => '\'USU5_USE_W3C_VALID\'',
                               'configuration_value'       => '\'true\'',
                               'configuration_description' => '\'This setting will output W3C valid URLs.\'',
                               'configuration_group_id'    => '\'[--config_group_id--]\'',
                               'sort_order'                => '\'4\'',
                               'last_modified'             => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                               'date_added'                => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                               'set_function'              => '\'tep_cfg_select_option(array(\\\'true\\\', \\\'false\\\'), \'' ),
                        array( 'configuration_title'       => '\'Select your chosen cache system?\'',
                               'configuration_key'         => '\'USU5_CACHE_SYSTEM\'',
                               'configuration_value'       => '\'' . $standard_cache_strategy . '\'',
                               'configuration_description' => '\'Choose from the 4 available caching strategies.\'',
                               'configuration_group_id'    => '\'[--config_group_id--]\'',
                               'sort_order'                => '\'5\'',
                               'last_modified'             => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                               'date_added'                => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                               'set_function'              => '\'tep_cfg_select_option(array(\\\'mysql\\\', \\\'file\\\',\\\'sqlite\\\',\\\'memcache\\\'), \'' ),
                       array( 'configuration_title'       => '\'Set the number of days to store the cache.\'',
                              'configuration_key'         => '\'USU5_CACHE_DAYS\'',
                              'configuration_value'       => '\'7\'',
                              'configuration_description' => '\'Set the number of days you wish to retain cached data, after this the cache will auto reset.\'',
                              'configuration_group_id'    => '\'[--config_group_id--]\'',
                              'sort_order'                => '\'6\'',
                              'last_modified'             => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                              'date_added'                => '\'' . date( "Y-m-d H:i:s" ) . '\'' ),
                       array( 'configuration_title'       => '\'Choose the uri format\'',
                              'configuration_key'         => '\'USU5_URLS_TYPE\'',
                              'configuration_value'       => '\'standard\'',
                              'configuration_description' => '\'<b>Choose USU5 URL format:</b>\'',
                              'configuration_group_id'    => '\'[--config_group_id--]\'',
                              'sort_order'                => '\'7\'',
                              'last_modified'             => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                              'date_added'                => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                              'set_function'              => '\'tep_cfg_select_option(array(\\\'standard\\\',\\\'path_standard\\\',\\\'rewrite\\\',\\\'path_rewrite\\\',), \'' ),
                       array( 'configuration_title'       => '\'Choose how your product link text is made up\'',
                              'configuration_key'         => '\'USU5_PRODUCTS_LINK_TEXT_ORDER\'',
                              'configuration_value'       => '\'p\'',
                              'configuration_description' => '\'Product link text can be made up of:<br /><b>p</b> = product name<br /><b>c</b> = category name<br /><b>b</b> = manufacturer (brand)<br /><b>m</b> = model<br />e.g. <b>bp</b> (brand/product)\'',
                              'configuration_group_id'    => '\'[--config_group_id--]\'',
                              'sort_order'                => '\'8\'',
                              'last_modified'             => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                              'date_added'                => '\'' . date( "Y-m-d H:i:s" ) . '\'' ),
                       array( 'configuration_title'       => '\'Filter Short Words\'',
                              'configuration_key'         => '\'USU5_FILTER_SHORT_WORDS\'',
                              'configuration_value'       => '\'2\'',
                              'configuration_description' => '\'<b>This setting will filter words.</b><br>1 = Remove words of 1 letter<br>2 = Remove words of 2 letters or less<br>3 = Remove words of 3 letters or less<br>\'',
                              'configuration_group_id'    => '\'[--config_group_id--]\'',
                              'sort_order'                => '\'9\'',
                              'last_modified'             => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                              'date_added'                => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                              'set_function'              => '\'tep_cfg_select_option(array(\\\'1\\\',\\\'2\\\',\\\'3\\\',), \'' ),
                       array( 'configuration_title'       => '\'Add category parent to beginning of category uris?\'',
                              'configuration_key'         => '\'USU5_ADD_CAT_PARENT\'',
                              'configuration_value'       => '\'true\'',
                              'configuration_description' => '\'This setting will add the category parent name to the beginning of the category URLs (i.e. - parent-category-c-1.html).\'',
                              'configuration_group_id'    => '\'[--config_group_id--]\'',
                              'sort_order'                => '\'10\'',
                              'last_modified'             => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                              'date_added'                => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                              'set_function'              => '\'tep_cfg_select_option(array(\\\'true\\\', \\\'false\\\'), \'' ),
                       array( 'configuration_title'       => '\'Remove all non-alphanumeric characters?\'',
                              'configuration_key'         => '\'USU5_REMOVE_ALL_SPEC_CHARS\'',
                              'configuration_value'       => '\'true\'',
                              'configuration_description' => '\'This will remove all non-letters and non-numbers. If your language has special characters then you will need to use the character conversion system.\'',
                              'configuration_group_id'    => '\'[--config_group_id--]\'',
                              'sort_order'                => '\'11\'',
                              'last_modified'             => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                              'date_added'                => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                              'set_function'              => '\'tep_cfg_select_option(array(\\\'true\\\', \\\'false\\\'), \'' ),
                       array( 'configuration_title'       => '\'Add cPath to product URLs?\'',
                              'configuration_key'         => '\'USU5_ADD_CPATH_TO_PRODUCT_URLS\'',
                              'configuration_value'       => '\'false\'',
                              'configuration_description' => '\'This setting will append the cPath to the end of product URLs (i.e. - some-product-p-1.html?cPath=xx).\'',
                              'configuration_group_id'    => '\'[--config_group_id--]\'',
                              'sort_order'                => '\'12\'',
                              'last_modified'             => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                              'date_added'                => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                              'set_function'              => '\'tep_cfg_select_option(array(\\\'true\\\', \\\'false\\\'), \'' ),
                       array( 'configuration_title'       => '\'Enter special character conversions. <b>(Better to use the file based character conversions)</b>\'',
                              'configuration_key'         => '\'USU5_CHAR_CONVERT_SET\'',
                              'configuration_value'       => '\'\'',
                              'configuration_description' => '\'This setting will convert characters.<br><br>The format <b>MUST</b> be in the form: <b>char=>conv,char2=>conv2</b>\'',
                              'configuration_group_id'    => '\'[--config_group_id--]\'',
                              'sort_order'                => '\'13\'',
                              'last_modified'             => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                              'date_added'                => '\'' . date( "Y-m-d H:i:s" ) . '\'' ),
                       array( 'configuration_title'       => '\'Turn performance reporting on true/false.\'',
                              'configuration_key'         => '\'USU5_OUPUT_PERFORMANCE\'',
                              'configuration_value'       => '\'false\'',
                              'configuration_description' => '\'<span style="color: red;">Performance reporting should not be set to ON on a live site</span><br>It is for reporting re: performance and queries and shows at the bottom of your site.\'',
                              'configuration_group_id'    => '\'[--config_group_id--]\'',
                              'sort_order'                => '\'14\'',
                              'last_modified'             => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                              'date_added'                => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                              'set_function'              => '\'tep_cfg_select_option(array(\\\'true\\\', \\\'false\\\'), \'' ),
                       array( 'configuration_title'       => '\'Turn variable reporting on true/false.\'',
                              'configuration_key'         => '\'USU5_DEBUG_OUPUT_VARS\'',
                              'configuration_value'       => '\'false\'',
                              'configuration_description' => '\'<span style="color: red;">Variable reporting should not be set to ON on a live site</span><br>It is for reporting the contents of USU classes and shows unformatted at the bottom of your site.\'',
                              'configuration_group_id'    => '\'[--config_group_id--]\'',
                              'sort_order'                => '\'15\'',
                              'last_modified'             => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                              'date_added'                => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                              'set_function'              => '\'tep_cfg_select_option(array(\\\'true\\\', \\\'false\\\'), \'' ),
                       array( 'configuration_title'       => '\'Force www.mysite.com/ when www.mysite.com/index.php\'',
                              'configuration_key'         => '\'USU5_HOME_PAGE_REDIRECT\'',
                              'configuration_value'       => '\'false\'',
                              'configuration_description' => '\'Force a redirect to www.mysite.com/ when www.mysite.com/index.php\'',
                              'configuration_group_id'    => '\'[--config_group_id--]\'',
                              'sort_order'                => '\'16\'',
                              'last_modified'             => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                              'date_added'                => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                              'set_function'              => '\'tep_cfg_select_option(array(\\\'true\\\', \\\'false\\\'), \'' ),
                       array( 'configuration_title'       => '\'Reset USU5 Cache\'',
                              'configuration_key'         => '\'USU5_RESET_CACHE\'',
                              'configuration_value'       => '\'false\'',
                              'configuration_description' => '\'This will reset the cache data for USU5\'',
                              'configuration_group_id'    => '\'[--config_group_id--]\'',
                              'sort_order'                => '\'17\'',
                              'last_modified'             => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                              'date_added'                => '\'' . date( "Y-m-d H:i:s" ) . '\'',
                              'use_function'              => '\'tep_reset_cache_data_usu5\'',
                              'set_function'              => '\'tep_cfg_select_option(array(\\\'reset\\\', \\\'false\\\'), \'' ) );