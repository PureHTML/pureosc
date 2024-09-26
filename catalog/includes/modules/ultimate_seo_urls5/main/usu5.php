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
  * @Id $Id:: usu5.php 202 2011-03-06 15:12:19Z Rob                     $:  Full Details   
  */
 
 /**
 * Load the general reusable functions
 */
  require_once DIR_WS_MODULES . 'ultimate_seo_urls5/includes/usu_general_functions.php';
  /**
  * @see Usu5_Bootstrap
  */
  require_once DIR_WS_MODULES . 'ultimate_seo_urls5/main/bootstrap.php';
  /**
  * @see Usu_Validator
  */
  require_once DIR_WS_MODULES . 'ultimate_seo_urls5/main/validator.php';
  /**
  * @see Data_Registry
  */
  require_once DIR_WS_MODULES . 'ultimate_seo_urls5/main/registry.php';
 
  /**
  * Main USU5 PRO class
  * 
  * @package USU5_PRO
  */
  class Usu_Main {
   
    private static $_singleton = null;
    private $vars = array();
    public static $version = 'version 1.1';
    /**
    * Be careful with $uninstall_db_settings, a setting of bool true will delete the database entries for usu5
    * false is the standard setting where USU5 will auto install
    * @var bool $uninstall_db_settings
    */
    public static $uninstall_db_settings = false;
    // Store performance data
    public static $performance = array( 'seo_urls'              => 0,
                                        'seo_url_array'         => array(),
                                        'std_urls'              => 0,
                                        'std_url_array'         => array(),
                                        'queries_saved'         => 0,
                                        'querycount'            => 0,
                                        'queries'               => array(),
                                        'time_extracting_cache' => 0,
                                        'cache_loaded'          => 'false' );
    /**
    * Class constructor
    * @access private
    */
    private function __construct() {
    } // end constructor
    /**
    * Class destructor
    * 
    * Stores the cache and outputs and performance data requested
    * 
    * @access public
    * @return void
    */
    public function __destruct() {
      if ( defined( 'USU5_ENABLED' ) && ( USU5_ENABLED == 'true' ) ) {
        $this->getVar( 'cache' )->store( $this->getVar( 'registry' )->store() );
        if ( defined( 'USU5_OUPUT_PERFORMANCE' ) && ( USU5_OUPUT_PERFORMANCE == 'true' ) ) {
          performance();
        }
        if ( defined( 'USU5_DEBUG_OUPUT_VARS' ) && ( USU5_DEBUG_OUPUT_VARS == 'true' ) ) {
          usu5_show_vars( $this->vars );
        }
      } 
    } // end destructor
    /**
    * Return a singleton instance of the class
    * 
    * @access public
    * @return Usu_Main
    */
    public static function i() {
     if ( !self::$_singleton instanceof Usu_Main ) {
       self::$_singleton = new self;
     }
     return self::$_singleton; 
    } // end method
    /**
    * Actioned on about line 314 of includes/application_top.php
    * 
    * After the variables have all been set this is were USU5 is actually initiated
    * 
    * @param mixed $lng - instance of language / empty array
    * @param int $languages_id - passed by reference as USU5 may reset this value in multi language mode
    * @param string $language - passed by reference as USU5 may reset this value in multi language mode
    * @param $force_language - force links to be produced for a particular language
    * @see Usu5_Bootstrap::bootStrapper()
    * 
    * @access public
    * @return void
    */
    public function initiate( $lng, &$languages_id, &$language, $force_language = false ) {
      if ( false !== $force_language ) {
        $this->vars['languages_id'] = $languages_id;
        $this->vars['language'] = $language;
        return Usu5_Bootstrap::i()->loadLanguageData( array() );
      }
     Usu5_Bootstrap::i()->bootStrapper( $lng );
     $languages_id = $this->vars['languages_id'];
     $language = $this->vars['language'];
    } // end method
    /**
    * USU5 link wrapper, defaults to the standard osCommerce tep_href_link() wrapper if not a valid seo url request
    * 
    * @see includes/usu_general_functions.php - osc_href_link() - this is the standard osC tep_href_link() wrapper
    * @see Usu_Main::getVar()
    * @see Usu_Main::monitorPerformance()
    * @uses str_replace()
    * @uses substr()
    * @uses strlen()
    * @uses array_key_exists()
    * @uses preg_match()
    * @uses is_readable()
    * 
    * @param string $page - base filename or sometimes a path ( e.g. ext/modules/payment/paypal.php )
    * @param string $parameters - querystring parameters
    * @param string $connection - SSL / NONSSL
    * @param bool $add_session_id
    * @param bool $search_engine_safe
    * 
    * @access public
    * @return string - url
    */
    public function hrefLink( $page, $parameters, $connection, $add_session_id, $search_engine_safe ) {
     // Badly coded shops often pass in odd characters
     $parameters = str_replace( array( '&amp;', 'amp;' ), array( '&', '', ), $parameters ); 
     $page_module_name = substr( $page, 0, strlen( $page )-4 );
     // 101 reasons to revert to using the standard osCommerce link wrapper
     if ( !array_key_exists( 'initiated', $this->vars ) || ( false === $this->vars['initiated'] ) // USU5 not yet fully initiated
                                                        || !preg_match( '@^[a-z0-9_]+\.php$@i', $page ) // Not a valid filename
                                                        || !is_readable( $this->getVar( 'page_modules_path' ) . $page ) // No module for this file
                                                        || ( USU5_ENABLED == 'false' ) // USU5 is turned off
                                                        || !tep_not_null( $parameters ) // All Seo Urls require parameters
                                                        || !array_key_exists( 'page_modules', $this->vars ) // Page module objects not loaded
                                                        || ( false === $this->vars['page_modules'] ) // Page module objects not loaded
                                                        || !array_key_exists( $page_module_name, $this->vars['page_modules'] ) ) { // No module loaded for this page
       return osc_href_link( $page, $parameters, $connection, $add_session_id, $search_engine_safe );
     }
     if ( false === ( $url = $this->vars['page_modules'][$page_module_name]->buildLink( $page, $parameters, $add_session_id, $connection ) ) ) {
       // The module returned false so we fall back on the standard osCommerce link wrapper
       return osc_href_link( $page, $parameters, $connection, $add_session_id, $search_engine_safe );
     }
     if ( self::monitorPerformance() ) {
       self::$performance['seo_urls']++;
       self::$performance['seo_url_array'][] = $url;
     }
     return $url;
    } // end method
    /**
    * Set the class properties out of scope
    * 
    * @param mixed $var_name - variable key
    * @param mixed $value - variable value
    * 
    * @access public
    * @return Usu_Main - chaining
    */
    public function setVar( $var_name, $value ) {
     $this->vars[$var_name] = $value;
     return $this;
    } // end method

    /**
    * Retrieve class properties from out of scope
    * 
    * @uses array_key_exists()
    * @uses is_array()
    * @param string $var_name - variable key
    * @param string $additional_key - $variable[$var_name][$additional_key]
    * 
    * @access public
    * @return mixed bool false / data found by the retrieval
    */
    public function getVar( $var_name, $additional_key = false ) {
     if ( array_key_exists( $var_name, $this->vars ) ) {
       if ( ( false !== $additional_key ) && is_array( $this->vars[$var_name] ) && array_key_exists( $additional_key, $this->vars[$var_name] ) ) {
         return $this->vars[$var_name][$additional_key];
       }
       return $this->vars[$var_name];
     }
     return false; 
    }  // end method
    /**
    * Query wrapper
    * 
    * Purely exists to allow monitoring of the number and content of queries
    * 
    * @uses microtime()
    * @uses number_format()
    * @see Usu_Main::monitorPerformance()
    * @param string $sql - The query
    * 
    * @access public
    * @return resource - query result
    */
    public function query( $sql ) {
      $time = microtime( true );
      $result = tep_db_query( $sql );
      $end_time = number_format ( ( microtime( true ) - $time ), 4 );
      if ( self::monitorPerformance() ) {
        self::$performance['querycount']++;
        self::$performance['queries'][] = array( 'time' => $end_time, 'query' => $sql );
      }
      return $result;
    }  // End method
    /**
    * Factory to extract data from the various cache strategies
    * 
    * @see Usu_Main::getVar()
    * @see Data_Registry::load()
    * @uses microtime()
    * @uses str_replace()
    * @uses number_format()
    * @uses strlen()
    * @uses gzinflate()
    * @uses base64_decode()
    * @uses unserialize()
    * @uses is_readable()
    * @uses file_get_contents()
    * @param string $cache_name - cache name to extract
    * @param string $cache_type - e.g. mysql, file etc.
    * @param object $object  iCache_System
    * 
    * @access public
    * @return bool
    */
    public function extractCacheData( $cache_name, $cache_type, iCache_System $object ) {
      $cache_seconds = ( (int)USU5_CACHE_DAYS * 24 * 60 * 60 );
      $timestart = microtime( true );
      switch ( true ) {
        case $cache_type == 'mysql':
          $query = str_replace( ':cache_name', $cache_name, $object->extract_query );
          $result = $this->query( $query );
          $row = tep_db_fetch_array( $result );
          tep_db_free_result( $result );
          if ( false === $row ) {
            self::$performance['time_extracting_cache'] = number_format ( ( microtime( true ) - $timestart ), 4 );
            // return insert = true as there is nothing in the database
            return true;
          }
          if ( time() > ( strtotime( $row['cache_date'] ) + $cache_seconds ) ) { // If the cache has expired
            $object->gc(); // Clear the cache
            self::$performance['time_extracting_cache'] = number_format ( ( microtime( true ) - $timestart ), 4 );
            // return insert = true as there is nothing in the database
            return true;
          } else { // the cache hasn't expired so we retrieve it and set the registry
            $cache_file_size = number_format( strlen( $row['cache_data'] ) / 1024, 2 ) . ' kb';
            $rawdata = gzinflate( base64_decode( $row['cache_data'] ) );
            $this->getVar( 'registry' )
                 ->load( unserialize( $rawdata ) );
            self::$performance['time_extracting_cache'] = number_format ( ( microtime( true ) - $timestart ), 4 );
            self::$performance['cache_loaded'] = 'true';
            // return insert = false as we have extracted data from the database
            return false;
          }
          break;
        case $cache_type == 'file':
          if ( is_readable( $this->getVar( 'cache_system_path' ) . 'cache/' .$cache_name . '.cache' ) ) {
            $this->getVar( 'registry' )
                 ->load( unserialize( gzinflate( file_get_contents( $this
                 ->getVar( 'cache_system_path' ) . 'cache/' . $cache_name . '.cache' ) ) ) );
            self::$performance['cache_loaded'] = 'true';
            self::$performance['time_extracting_cache'] = number_format ( ( microtime( true ) - $timestart ), 4 );
            return false;
          } else {
            self::$performance['time_extracting_cache'] = number_format ( ( microtime( true ) - $timestart ), 4 );
            return true;
          }
          break;
        case $cache_type == 'memcache':
          if ( false === ( $rawdata = $object->get( $cache_name ) ) ) {
            self::$performance['time_extracting_cache'] = number_format ( ( microtime( true ) - $timestart ), 4 );
            // return insert = true as there is nothing in the database
            return true;
          }
          $rawdata  = gzinflate( base64_decode( $rawdata ) );
          $this->getVar( 'registry' )
               ->load( unserialize( $rawdata ) );
          self::$performance['time_extracting_cache'] = number_format ( ( microtime( true ) - $timestart ), 4 );
          self::$performance['cache_loaded'] = 'true';
          // return insert = false as we have extracted data from the database
          return false;
          break;
        case $cache_type == 'sqlite':
          $query = str_replace( ':cache_name', $cache_name, $object->extract_query );
          $result = $object->getDb()->query( $query );
          $row = $result->fetch();
          if ( empty( $row ) ) {
            self::$performance['time_extracting_cache'] = number_format ( ( microtime( true ) - $timestart ), 4 );
            // return insert = true as there is nothing in the database
            return true;
          }
          if ( time() > ( strtotime( $row['cache_date'] ) + $cache_seconds ) ) { // If the cache has expired
            $object->gc(); // Clear the cache
            self::$performance['time_extracting_cache'] = number_format ( ( microtime( true ) - $timestart ), 4 );
            // return insert = true as there is nothing in the database
            return true;
          } else { // the cache hasn't expired so we retrieve it and set the registry
            $cache_file_size = number_format( strlen( $row['cache_data'] ) / 1024, 2 ) . ' kb';
            $rawdata = gzinflate( base64_decode( $row['cache_data'] ) );
            $this->getVar( 'registry' )
                 ->load( unserialize( $rawdata ) );
            self::$performance['time_extracting_cache'] = number_format ( ( microtime( true ) - $timestart ), 4 );
            self::$performance['cache_loaded'] = 'true';
            // return insert = false as we have extracted data from the database
            return false;
          }
          break;
        default:
          trigger_error( __CLASS__ . '::' . __FUNCTION__ . ' unknown type passed as: ' . $type, E_USER_WARNING );
          break; 
      }
    }
    /**
    * If monitoring is turned off it saves memory as the arrays are left empty
    * 
    * @uses defined()
    * 
    * @access public
    * @return bool
    */
    public static function monitorPerformance() {
      if ( defined( 'USU5_OUPUT_PERFORMANCE' ) && USU5_OUPUT_PERFORMANCE == 'true' ) {
        return true;
      }
      return false;
    } // end method

  } // end class