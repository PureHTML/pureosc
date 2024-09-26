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
  * @Id $Id:: memcache.php 196 2010-12-21 22:45:02Z Rob                 $:  Full Details   
  */
  
  /**
  * Cache system using Memcached
  * @see http://memcached.org/
  * 
  * @package USU5_PRO
  */
  final class Memcache_Cache_Module extends Memcache implements iCache_System {
    
    private static $_singleton = null;
    private static $cache_name;
    private static $cache_on;
    private static $memcache_host = 'localhost';
    private static $memcache_port = '11211';
    private static $memcache_prefix = 'usu_';
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
    * @return Memcache_Cache_Module
    */
    public static function i() {
      if ( !self::$_singleton instanceof Memcache_Cache_Module ) {
        if ( Usu_Main::i()->getVar( 'page_modules', substr( Usu_Main::i()->getVar( 'filename' ), 0, -4 ) ) instanceof aPage_Modules ) {
          self::$cache_on = ( defined( 'USU5_CACHE_ON' ) && ( USU5_CACHE_ON == 'true' ) ) ? true : false; 
          self::$cache_name = self::$memcache_prefix . md5( HTTP_SERVER . Usu_Main::i()->getVar( 'page_modules', substr( Usu_Main::i()
                                                                                       ->getVar( 'filename' ), 0, -4 ) )
                                                                                       ->buildCacheName() );
          Usu_Main::i()->setVar( 'cache_name', self::$cache_name );
        } else { // No module so we set the cache name as the language id plus the called file
          self::$cache_name = self::$memcache_prefix . md5( HTTP_SERVER . Usu_Main::i()->getVar( 'languages_id' ) . '_' . substr( Usu_Main::i()
                                                                                       ->getVar( 'filename' ), 0, -4 ) );
          Usu_Main::i()->setVar( 'cache_name', self::$cache_name ); 
        } 
        self::$_singleton = new self;
      }
      return self::$_singleton; 
    } // end method
    /**
    * Singleton access for the class via admin
    * 
    * @access public
    * @return Memcache_Cache_Module
    */
    public function iAdmin() {
      if ( !self::$_singleton instanceof Memcache_Cache_Module ) {
        self::$_singleton = new self;
      }
      return self::$_singleton;
    }
    /**
    * Connect to the memcache server
    * 
    * @access public
    * @throws - triggers an error of type E_USER_WARNING when connection to the memcache server fails
    * @return mixed - bool false / Memcache_Cache_Module
    */
    public function initiate() {
      if ( false === $this->connect( self::$memcache_host, self::$memcache_port ) ) {
        trigger_error( __CLASS__ . '::' . __FUNCTION__ . '() Could not connect to memcache server', E_USER_WARNING );
        return false;
      }
      return $this;
    }
    /**
    * Stores the current cache on the destruction of the Usu_Main class 
    * 
    * @see Usu_Main::__destruct()
    * @uses serialize()
    * @uses base64_encode()
    * @uses gzdeflate()
    * @param array $registry_vars - array of data to cache
    * 
    * @access public
    * @return void
    */
    public function store( array $registry_vars = array() ) {
      if ( false !== self::$cache_on  ) {
        if ( false !== $this->insert ) {
          $data = serialize( $registry_vars );
          $rawdata = base64_encode( gzdeflate( $data ) );
          if ( false === $this->add( self::$cache_name, $rawdata, 0, 3600 ) ) {
            $this->replace( self::$cache_name, $rawdata, 0, 3600 );
          }
        }
      }
    }
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
        $this->insert = Usu_Main::i()->extractCacheData( self::$cache_name, 'memcache', $this );
      }
    }
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
      $this->delete( $this->cachename );
    } // end method
    /**
    * Flush memcache clearing all data
    */
    public function flushOut() {
      $this->flush();
    } // end method

  } // end class