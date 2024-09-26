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
  * @lastmod $Date:: 2010-12-21 22:45:02 +0000 (Tue, 21 Dec 2010)       $:  Date of last commit
  * @version $Rev:: 196                                                 $:  Revision of last commit
  * @Id $Id:: mysql.php 196 2010-12-21 22:45:02Z Rob                    $:  Full Details   
  */
  
  /**
  * Cache system using a MySQL database
  *
  * @package USU5_PRO
  */
  final class Mysql_Cache_Module implements iCache_System {
    
    private static $_singleton = null;
    private static $cache_name;
    private static $cache_on;
    public $extract_query = "SELECT * FROM `usu_cache` WHERE cache_name = ':cache_name'";
    private $insert_query = "INSERT INTO `usu_cache` (cache_name, cache_data, cache_date) VALUES (':cache_name', ':cache_data', ':cache_date')";
    private $insert = false;
    /**
    * Class constructor
    * @access private
    */
    private function __construct() {
    } // end constructor
    /**
    * Returns a singleton instance of the class
    * 
    * Sets the cache name and checks that the cache directory is writeable
    * @uses defined()
    * @uses substr()
    * @uses md5()
    * 
    * @access public
    * @return Mysql_Cache_Module
    */
    public static function i() {
      self::$cache_on = ( defined( 'USU5_CACHE_ON' ) && ( USU5_CACHE_ON == 'true' ) ) ? true : false; 
      if ( !self::$_singleton instanceof Mysql_Cache_Module ) {
        if ( Usu_Main::i()->getVar( 'page_modules', substr( Usu_Main::i()->getVar( 'filename' ), 0, -4 ) ) instanceof aPage_Modules ) { 
          self::$cache_name = md5( Usu_Main::i()->getVar( 'page_modules', substr( Usu_Main::i()
                                           ->getVar( 'filename' ), 0, -4 ) )
                                           ->buildCacheName() );
          Usu_Main::i()->setVar( 'cache_name', self::$cache_name );
        } else { // No module so we set the cache name as the language id plus the called file
          self::$cache_name = Usu_Main::i()->getVar( 'languages_id' ) . '_' . substr( Usu_Main::i()->getVar( 'filename' ), 0, -4 );
          Usu_Main::i()->setVar( 'cache_name', self::$cache_name ); 
        } 
        self::$_singleton = new self;
      }
      return self::$_singleton; 
    } // end method
    /**
    * Stores the current cache on the destruction of the Usu_Main class 
    * 
    * @see Usu_Main::__destruct()
    * @uses serialize()
    * @uses base64_encode()
    * @uses gzdeflate()
    * @uses str_replace()
    * @uses date()
    * @param array $registry_vars - array of data to cache
    * 
    * @access public
    * @return void
    */
    public function store( array $registry_vars = array() ) {
      if ( false !== self::$cache_on  ) {
        if ( false !== $this->insert ) {
          $data = serialize( $registry_vars ); // Serialize the registry of data
          $rawdata = base64_encode( gzdeflate( $data ) ); // encode and deflate
          $targets = array( ':cache_name', ':cache_data', ':cache_date' );
          $replacements = array( tep_db_input( self::$cache_name ), tep_db_input( $rawdata ), date( "Y-m-d H:i:s" ) );
          $query = str_replace( $targets, $replacements, $this->insert_query );
          Usu_Main::i()->query( $query );
        }
      }
    } // end method
    /**
    * Retrieve the cached data
    * 
    * If $insert becomes bool true then we insert data when storing, bool false we don't save as the cache already exists
    * 
    * @see Usu_Main::extractCacheData()
    * 
    * @access public
    * @return void
    */
    public function retrieve() {
      if ( false !== self::$cache_on  ) {
        $this->insert = Usu_Main::i()->extractCacheData( self::$cache_name, 'mysql', $this );
      }
    } // end method
    /**
    * Cache garbage clearance
    * 
    * @param bool $file_info
    * 
    * @access public
    * @return void
    */
    public function gc(  $file_info = false ) {
      $this->insert = true;
      Usu_Main::i()->query( 'TRUNCATE `usu_cache`' );
    } // end method

  } // end class