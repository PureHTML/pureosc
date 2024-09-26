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
  * @lastmod $Date:: 2011-03-06 15:12:19 +0000 (Sun, 06 Mar 2011)       $:  Date of last commit
  * @version $Rev:: 202                                                 $:  Revision of last commit
  * @Id $Id:: bootstrap.php 202 2011-03-06 15:12:19Z Rob                $:  Full Details   
  */
 
  /**
  * Set up all needed parameters and settings
  * 
  * @package USU5_PRO
  */
  class Usu5_Bootstrap {
    private static $_singleton = null;
    /**
    * Class constructor
    * @access private
    */
    private function __construct() {
    } // end constructor
    /**
    * Singleton instance of the class
    * 
    * @access public
    * @return Usu5_Bootstrap
    */
    public static function i() {
     if ( !self::$_singleton instanceof Usu5_Bootstrap ) {
       self::$_singleton = new self;
     }
     return self::$_singleton; 
    } // end method
    /**
    * Initiate the main bootstrapper methods, called by Usu_Main::initiate()
    * 
    * @param mixed $lng - instance of language / empty array
    * @see Usu_Main::initiate()
    * @see Usu5_Bootstrap::getRequestUri()
    * @see Usu5_Bootstrap::setPaths()
    * @see Usu5_Bootstrap::getConfigConstants()
    * @see Usu5_Bootstrap::adminInstalled()
    * @see Usu5_Bootstrap::turnOffBrokenUrls()
    * @see Usu5_Bootstrap::loadLanguageData()
    * @see Usu5_Bootstrap::actionMultiLanguageSupport()
    * @see Usu5_Bootstrap::loadCharacterConversions()
    * @see Usu5_Bootstrap::loadPageModules()
    * @see Usu5_Bootstrap::loadUriModules()
    * @see Usu5_Bootstrap::uriModulesParsePath()
    * @see Usu5_Bootstrap::cacheSystem()
    * @see Usu5_Bootstrap::setRegistry()
    * @see Usu_Main::getVar()
    * @see Usu_Main::setVar()
    * @see Usu_Validator::initiate();
    * 
    * @access public
    * @return void
    */
    public function bootStrapper( $lng ) {
      $this->getRequestUri();
      $this->setPaths();
      $this->getConfigConstants();
      $this->adminInstalled(); // Dependent on getConfigConstants()
      Usu_Main::i()->setVar( 'enabled', USU5_ENABLED ); // dependent on adminInstalled()
      // No point in loading a load of functions that will not be used
      if ( Usu_Main::i()->getVar( 'enabled' ) == 'false' ) {
        return Usu_Main::i()->setVar( 'initiated', false );
      }
      $this->turnOffBrokenUrls();
      $this->loadLanguageData( $lng );
      $this->actionMultiLanguageSupport();
      $this->loadCharacterConversions(); // Dependent on language being set as final ( i.e. multi language functions must precede )
      $this->loadPageModules();
      $this->loadUriModules();
      $this->uriModulesParsePath();
      $this->cacheSystem();
      $this->setRegistry();
      Usu_Main::i()->setVar( 'initiated', true );
      Usu_Validator::i()->initiate();
    } // end method
    /**
    * Attempt to extract or replicate (Windows) REQUEST_URI ( strips seo url to e.g. de/my-great-category-c-32.html )
    * 
    * @uses array_key_exists()
    * @uses strlen()
    * @uses strpos()
    * @usesstr_replace()
    * @uses trim()
    * 
    * @access public
    * @return void
    */
    public function getRequestUri() {
      $rawpath = '';
      $finduri = new ArrayIterator( array( 'HTTP_X_ORIGINAL_URL', 'HTTP_X_REWRITE_URL', 'REQUEST_URI', 'ORIG_PATH_INFO', ) );
      while ( $finduri->valid() ) {
        if ( array_key_exists(  $finduri->current(), $_SERVER ) && ( strlen( $_SERVER[$finduri->current()] ) > 0 ) ) {
          $original_request_uri = $_SERVER[$finduri->current()];
          // If there is querystring present then remove it
          if ( false !== strpos( $original_request_uri, '?' ) ) {
            $original_request_uri = substr_replace( $original_request_uri, '', strpos( $original_request_uri, '?' ), strlen( $original_request_uri ) );
          }
          // set the original_request_uri adding back ( if it was there ) the querystring
          $querystring = $this->getRequestQueryString();  
          Usu_Main::i()->setVar( 'original_request_uri', ( $original_request_uri . ( tep_not_null( $querystring ) ? ( '?' . $querystring ) : '' ) ) );
          break;
        }
        $finduri->next();
      }
      $rawpath = $original_request_uri; 
      if ( DIR_WS_CATALOG != '/' && ( false !== strpos( $rawpath, DIR_WS_CATALOG ) ) ) { // Remove the DIR_WS_CATALOG path
        $rawpath = str_replace( DIR_WS_CATALOG, '/', $rawpath ); 
      }
      $rawpath = trim( str_replace( Usu_Main::i()->getVar( 'filename' ), '', $rawpath ), '/' ); // Remove the filename and any remaining / from left or right
      Usu_Main::i()->setVar( 'request_uri', $rawpath );
    } // End Method

    private function getRequestQueryString() {
      if ( false !== ( $qs = Usu_Main::i()->getVar( 'request_querystring' ) ) ) {
        return $qs;
      }
      $qs = '';
      $get_array = ( strlen( $_SERVER['QUERY_STRING'] ) > 0 ) ? explode( '&', $_SERVER['QUERY_STRING'] ) : false;
      if ( false !== $get_array ) {
        foreach ( $get_array as $index => $stringpair ) {
          if ( false === strpos( $stringpair, tep_session_name() ) ) { // Leave out the osCsid
            $pair = explode('=', $stringpair);
            if ( count( $pair ) == 2 ) {
              $stringpair =  usu_cleanse( $pair[0] ) . '=' . usu_cleanse( $pair[1] ); 
            } else {
              $stringpair =  usu_cleanse( $stringpair );
            }
            $qs .= '&' . $stringpair;  
          }
        }
      }
      Usu_Main::i()->setVar( 'request_querystring', ltrim( $qs, '&' ) );
      return Usu_Main::i()->getVar( 'request_querystring' );
    } // end method
    /**
    * Set all paths used by USU5 PRO
    * @see Usu_Main::setVar()
    * @see Usu5_Bootstrap::getRealPath()
    * 
    * @access private
    * @return void
    */
    private function setPaths() {
      $real_path = $this->getRealPath();
      $usu_path  = $real_path . 'includes/modules/ultimate_seo_urls5/';  
      Usu_Main::i()->setVar( 'real_path', $real_path )
                   ->setVar( 'usu_path', $usu_path )
                   ->setVar( 'db_install_path', $usu_path . 'database_install/' )
                   ->setVar( 'abstracts_path', $usu_path . 'abstracts/' )
                   ->setVar( 'includes_path', $usu_path . 'includes/' )
                   ->setVar( 'cache_system_path', $usu_path . 'cache_system/' )
                   ->setVar( 'interfaces_path', $usu_path . 'interfaces/' )
                   ->setVar( 'page_modules_path', $usu_path . 'page_modules/' )
                   ->setVar( 'uri_modules_path', $usu_path . 'uri_modules/' )
                   ->setVar( 'cache_path', $usu_path . 'cache/' )
                   ->setVar( 'base_url', HTTP_SERVER . DIR_WS_HTTP_CATALOG )
                   ->setVar( 'base_url_ssl', HTTPS_SERVER . DIR_WS_HTTPS_CATALOG );
    } // end method
    /**
    * A number of osC users don't have a full path in DIR_FS_CATALOG which was causing the caching to fail so sadly we have to do this to find the full path.
    * 
    * @access private
    * @return string - path to shop root
    */
    private function getRealPath() {
      $remove_from_path = '/includes/modules/ultimate_seo_urls5/main';
      $realpath = '';
      if( function_exists( 'realpath' ) ) {
        $realpath = realpath( dirname( __FILE__ ) . '/../../../../' ) . '/';
        if( file_exists( $realpath . FILENAME_PRODUCT_INFO ) && !empty( $realpath ) ) {
          return $realpath;
        }
      }
      if( function_exists( 'getcwd' ) ) {
        $realpath = str_replace( array( DIRECTORY_SEPARATOR, $remove_from_path ), array( '/', '' ), getcwd() ) . '/';
        if( file_exists( $realpath . FILENAME_PRODUCT_INFO ) && !empty( $realpath ) ) { 
          return $realpath;
        }
      }
      if ( file_exists( DIR_FS_CATALOG . FILENAME_PRODUCT_INFO ) ) {
        return DIR_FS_CATALOG;
      }
      trigger_error( 'Usu5 cannot find the full filepath, please ensure that DIR_FS_CATALOG in configure.php contains a FULL path', E_USER_WARNING );
    } // end method
    /**
    * Set the array of constants used in the USU5 PRO configuration
    * 
    * @see Usu_Main::setVar()
    * 
    * @access private
    * @return void
    */
    private function getConfigConstants() {
      $constants = array( 'USU5_RESET_CACHE',      'USU5_ENABLED',                   'USU5_CACHE_ON',                 'USU5_URLS_TYPE',
                          'USU5_CHAR_CONVERT_SET', 'USU5_FILTER_SHORT_WORDS',        'USU5_REMOVE_ALL_SPEC_CHARS',    'USU5_CACHE_DAYS',
                          'USU5_USE_W3C_VALID',    'USU5_ADD_CPATH_TO_PRODUCT_URLS', 'USU5_OUPUT_PERFORMANCE',        'USU5_ADD_CAT_PARENT', 
                          'USU5_DEBUG_OUPUT_VARS', 'USU5_CACHE_SYSTEM',              'USU5_PRODUCTS_LINK_TEXT_ORDER', 'USU5_MULTI_LANGUAGE_SEO_SUPPORT' );
      Usu_Main::i()->setVar( 'config_settings', $constants );
    } // end method
    /**
    * Load the language based character conversions
    * 
    * If there is a file based character conversion we use that, if not we fall back on the old admin settings
    * @uses is_readable()
    * @uses is_array()
    * @uses defined()
    * @uses explode()
    * @uses trim()
    * @see Usu_Main::getVar()
    * @see Usu_Main::setVar() 
    * 
    * @access private
    * @return void
    */
    private function loadCharacterConversions() {
      // Check to see if there is a character conversion language file before trying the admin settings
      $character_conv_filepath = Usu_Main::i()->getVar( 'includes_path' ) . 'character_conversion/' . Usu_Main::i()->getVar( 'language' ) . '.php';
      if ( is_readable( $character_conv_filepath ) ) {
        include_once $character_conv_filepath;
        if ( isset( $char_convert ) && is_array( $char_convert ) && !empty( $char_convert ) ) {
          return Usu_Main::i()->setVar( 'character_conversion', $char_convert );
        }
      }
      if ( defined( 'USU5_CHAR_CONVERT_SET' ) && tep_not_null( USU5_CHAR_CONVERT_SET ) ) {
        $char_convert = array();
        $comma_separation = explode( ',', USU5_CHAR_CONVERT_SET );
        foreach ( $comma_separation as $index => $value_pairs ) {
          $pairs = @explode( '=>', $value_pairs );
          $char_convert[trim( $pairs[0] )] = trim( $pairs[1] );
        }
        return Usu_Main::i()->setVar( 'character_conversion', $char_convert ); 
      }
      Usu_Main::i()->setVar( 'character_conversion', false );
    } // End method
    /**
    * Ensure the admin database entries are installed.
    * 
    * If all the required database entries are not installed remove all entries for series 2 seo urls and USU5 and USU5 PRO then install fresh
    * @see Usu_Main::getVar()
    * @see Installer_Class::setConfigConstants()
    * @see Installer_Class::setConfigArray()
    * @see Installer_Class::removeConfigurationGroup()
    * @see Installer_Class::removeConfigurationSettings()
    * @see Installer_Class::dropTable()
    * @see Installer_Class::getConfigGroupId()
    * @see Installer_Class::getMaxSort()
    * @see Installer_Class::addConfigGroup()
    * @see Installer_Class::addConfigSettings()
    * @see Installer_Class::addTable()
    * @uses defined()
    * @uses session_write_close()
    * @uses header() - osC redirect wrapper tep_redirect()
    * 
    * @access private
    * @return void
    */
    private function adminInstalled() {
      $needs_install = false;
      foreach ( Usu_Main::i()->getVar( 'config_settings' ) as $index => $define ) {
        if ( false === defined( $define ) ) {
          $needs_install = true;
          break;
        }
      }
      // System is not set to uninstall and all the constants are defined so all is well we just return out
      if ( ( false === Usu_Main::$uninstall_db_settings ) && ( false === $needs_install ) ) {
        return;
      } 
      // If $uninstall_db_settings is true and $needs_install is false we are ready to delete the database entries for USU5
      if ( ( false !== Usu_Main::$uninstall_db_settings ) && ( false === $needs_install ) ) {
        include_once Usu_Main::i()->getVar( 'db_install_path' ) . 'installer_class.php';
        include_once Usu_Main::i()->getVar( 'db_install_path' ) . 'installer_constants.php';
        // deletions
        Installer_Class::i()->setConfigConstants( $usu51 )
                            ->setConfigConstants( $usu5 )
                            ->setConfigConstants( $seo_urls2 )
                            ->setConfigArray()
                            ->removeConfigurationGroup()
                            ->removeConfigurationSettings()
                            ->dropTable();
        return;
        //Set to uninstall but $needs_install is true so the database entries are not present, we do nothing
      } elseif ( ( false !== Usu_Main::$uninstall_db_settings ) && ( false !== $needs_install ) ) {
        return;
        // If $uninstall_db_settings is false and $needs_install is true we are ready to install the database entries for USU5
      } elseif ( ( false !== $needs_install ) && ( false === Usu_Main::$uninstall_db_settings ) ) {
        include_once Usu_Main::i()->getVar( 'db_install_path' ) . 'installer_class.php';
        include_once Usu_Main::i()->getVar( 'db_install_path' ) . 'installer_constants.php';
        
        // deletions
        Installer_Class::i()->setConfigConstants( $usu51 )
                            ->setConfigConstants( $usu5 )
                            ->setConfigConstants( $seo_urls2 )
                            ->setConfigArray()
                            ->removeConfigurationGroup()
                            ->removeConfigurationSettings()
                            ->dropTable();
        // installation                    
        Installer_Class::i()->getConfigGroupId()
                            ->getMaxSort()
                            ->addConfigGroup( $usu5_config_group )
                            ->addConfigSettings( $usu5_config )
                            ->addTable();
        session_write_close();
        tep_redirect( tep_href_link( FILENAME_DEFAULT ) );
        exit;
      }
    } // end method
    /**
    * Load the page modules
    * 
    * Modules allow USU5 to deal with the different requests and added contributions
    * @example categories, products, manufacturers - contributions may be articles or information pages
    * Module filenames are the same as the page they represent e.g. module for index.php is named index.php
    * @uses str_replace()
    * @uses substr()
    * @uses is_readable()
    * @uses call_user_func()
    * 
    * @access private
    * @return void
    */
    private function loadPageModules() {
      include_once Usu_Main::i()->getVar( 'abstracts_path' ) . 'page_modules.php';
      $modules = usu_dir_iterator( Usu_Main::i()->getVar( 'page_modules_path' ) );
      $page_modules = array();
      foreach ( $modules as $index => $module ) {
        $basename = str_replace( '.php', '', $module );
        $class = module_naming_convention( $basename, '_Page_Module' );
        if ( ( substr( $module, -4, 4 ) == '.php' ) && ( is_readable(  Usu_Main::i()->getVar( 'page_modules_path' ) . $module ) ) ) {
          include_once Usu_Main::i()->getVar( 'page_modules_path' ) . $module;
          $page_modules[$basename] = call_user_func( array( $class, 'i' ) );
        }
      }
      return Usu_Main::i()->setVar( 'page_modules', $page_modules );
    } // End method
    /**
    * Load uri modules
    * 
    * These modules dictate the makeup of the seo url
    * @example rewrite, path_rewrite, standard, path_standard
    * @uses is_readable()
    * @uses str_replace()
    * @uses substr()
    * @see Usu_Main::getVar()
    * @see Usu_Main::setVar()
    * @see includes/usu_general_functions.php - module_naming_convention()
    * 
    * @access private
    * @return void
    */
    private function loadUriModules() {
      include_once Usu_Main::i()->getVar( 'abstracts_path' ) . 'uri_modules.php';
      $modules = usu_dir_iterator( Usu_Main::i()->getVar( 'uri_modules_path' ) );
      $uri_modules = array();
      foreach ( $modules as $index => $module ) {
        $basename = str_replace( '.php', '', $module );
        $class = module_naming_convention( $basename, '_Uri_Module' );
        if ( ( substr( $module, -4, 4 ) == '.php' ) && ( is_readable(  Usu_Main::i()->getVar( 'uri_modules_path' ) . $module ) ) ) {
          include_once Usu_Main::i()->getVar( 'uri_modules_path' ) . $module;
          $uri_modules[$basename] = new $class;
        }
      }
      return Usu_Main::i()->setVar( 'uri_modules', $uri_modules );
    } // End method
    /**
    * Turn off the experimental seo urls of osCommerce
    * 
    * @uses defined()
    * 
    * @access private
    * @return void
    */
    private function turnOffBrokenUrls() {
      if( defined( 'SEARCH_ENGINE_FRIENDLY_URLS' ) && ( SEARCH_ENGINE_FRIENDLY_URLS == 'true' ) ) {
        $sql = "UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = 'false' WHERE configuration_key = 'SEARCH_ENGINE_FRIENDLY_URLS'";
        tep_db_query( $sql );
      }
    }
    /**
    * Selects the correct uri module then parses the request adding key => value pairs to _GET and HTTP_GET_VARS as needed by the osCommerce system.
    * @uses is_readable()
    * @uses substr()
    * 
    * @access private
    * @return void
    */
    private function uriModulesParsePath() {
      if ( !is_readable( Usu_Main::i()->getVar( 'page_modules_path' ) . Usu_Main::i()->getVar( 'filename' ) ) ) {
        return false;
      }
      $uri_modules = Usu_Main::i()->getVar( 'uri_modules' );
      foreach ( $uri_modules as $object ) {
        if ( false !== ( $object->isValidUri() ) ) {
          $object->parsePath();
        }
      }
    } // end method
    /**
    * Extract language data from the osCommerce language class
    * 
    * This is used for the multi language support
    * 
    * @param mixed $lng - instance of language or empty array
    * 
    * @access private
    * @return void
    */
    public function loadLanguageData( $lng ) {
      if ( !defined( 'USU5_MULTI_LANGUAGE_SEO_SUPPORT' ) || USU5_MULTI_LANGUAGE_SEO_SUPPORT != 'true' ) {
        return;
      }
      $current_language = '';
      $catalog_languages = array();
      if ( !empty( $lng ) && ( $lng instanceof language ) ) {
        $catalog_languages = $lng->catalog_languages;
        foreach ( $catalog_languages as $code => $detail ) {
          if ( $detail['directory'] == Usu_Main::i()->getVar( 'language' ) ) {
            $current_code = $code;
          }
        }
        $current_language = $lng->language;
      } else {
        $languages_query = tep_db_query( "select languages_id, name, code, image, directory from " . TABLE_LANGUAGES . " order by sort_order" );
        $current_language = '';
        while ( $languages = tep_db_fetch_array( $languages_query ) ) {
          $catalog_languages[$languages['code']] = array( 'id' => $languages['languages_id'],
                                                          'name' => $languages['name'],
                                                          'image' => $languages['image'],
                                                          'directory' => $languages['directory'] );
          if ( $languages['directory'] == Usu_Main::i()->getVar( 'language' ) ) {
            $current_language =  $catalog_languages[$languages['code']];
            $current_code = $languages['code']; 
          }
          
        }
      }
      $current_language =  array_merge( (array)$current_language, array( 'code' => $current_code ) );
      Usu_Main::i()->setVar( 'catalog_languages', $catalog_languages )
                   ->setVar( 'current_language', $current_language );
    } // End method
    /**
    * Reset the language based on the request
    * 
    * This is the core of the multi language system.
    * 
    * @access private
    * @return void
    */
    private function actionMultiLanguageSupport() {
      // Exit if Multi language support is not required
      if ( ( USU5_MULTI_LANGUAGE_SEO_SUPPORT != 'true' ) || isset( $_GET['language'] ) ) {
        return false;
      }
      $possible_lang = false;

      preg_match( '@^[a-z]{2}/@', Usu_Main::i()->getVar( 'request_uri' ), $matches ); // Try to find de/ at the front of the request
      $catalog_languages = Usu_Main::i()->getVar( 'catalog_languages' );
      if ( strlen( Usu_Main::i()->getVar( 'request_uri' ) ) == 2 ) { // Possibly a language name ( like de ) if two characters
        $possible_lang = Usu_Main::i()->getVar( 'request_uri' );
      } elseif ( !empty( $matches ) && ctype_alpha( rtrim( $matches[0], '/' ) ) ) { // did we get a regex match?
        $possible_lang = rtrim( $matches[0], '/' );
      }
      if ( false !== $possible_lang ) { // We have some sort of match so iterate through the language array
        foreach( $catalog_languages as $lang_code => $lang_detail ) {
          if ( $possible_lang == $lang_code ) { // We have a match
            Usu_Main::i()->setVar( 'languages_id', $lang_detail['id'] ); // Reset $languages_id to the new value
            Usu_Main::i()->setVar( 'language', $lang_detail['directory'] ); // Reset $language to the new value
            $this->loadLanguageData( array() );
            return; // Job done so exit the method
          }
        }
      }
      $current_language = Usu_Main::i()->getVar( 'current_language' );
      // We have no language markers to use so we really should be using the default langiage
      if ( DEFAULT_LANGUAGE != $current_language['code'] ) { // We are not using the default language so need to change to it
        Usu_Main::i()->setVar( 'languages_id', $catalog_languages[DEFAULT_LANGUAGE]['id'] ); // Reset $languages_id to the new value
        Usu_Main::i()->setVar( 'language', $catalog_languages[DEFAULT_LANGUAGE]['directory'] ); // Reset $language to the new value
        $this->loadLanguageData( array() );
      } 
    } // End method
    /**
    * Load the chosen cache system
    * @uses is_readable()
    * @uses call_user_func()
    * @uses trigger_error()
    * @see Usu_Main::getVar()
    * @see Usu_Main::setVar()
    * 
    * @throws - triggers an error of type E_USER_WARNING if the cache system cannot be found
    * @access private
    * @return void
    */
    private function cacheSystem() {
      include_once Usu_Main::i()->getVar( 'interfaces_path' ) . 'cache_interface.php';
      if ( is_readable( Usu_Main::i()->getVar( 'cache_system_path' ) . USU5_CACHE_SYSTEM . '.php' ) ) {
        include_once Usu_Main::i()->getVar( 'cache_system_path' ) . USU5_CACHE_SYSTEM . '.php';
        $class_name = module_naming_convention( USU5_CACHE_SYSTEM, '_Cache_Module' );
        Usu_Main::$performance['cache_system'] = $class_name;
        $cache_object = call_user_func( array( $class_name, 'i' ) );
        if ( $cache_object instanceof Memcache ) {
          $cache_object->initiate();
        }
        return Usu_Main::i()->setVar( 'cache', $cache_object );
      }
      trigger_error( 'Can not find cache system: <b>' . USU5_CACHE_SYSTEM . '</b>', E_USER_WARNING );
    }
    /**
    * Initiate the registry and retrieve the cached data
    * 
    * @access private
    * @return void
    */
    private function setRegistry() {
      Usu_Main::i()->setVar( 'registry', Data_Registry::i() );
      Usu_Main::i()->getVar( 'cache' )->retrieve();
    }

  } // end class
