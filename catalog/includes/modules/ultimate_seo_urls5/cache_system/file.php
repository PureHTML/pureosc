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
  * @Id $Id:: file.php 196 2010-12-21 22:45:02Z Rob                     $:  Full Details   
  */
  
  
  /**
  * File based cache system
  * 
  * @package USU5_PRO
  */
  final class File_Cache_Module implements iCache_System {
    
    private static $_singleton = null;
    private static $cache_name;
    private static $cache_on;

    private function __construct() {
    } // end constructor
    /**
    * Returns a singleton instance of the class
    * 
    * Sets the cache name and checks that the cache directory is writeable
    * @uses defined()
    * @uses substr()
    * 
    * @access public
    * @return File_Cache_Module
    */
    public static function i() {
      self::$cache_on = ( defined( 'USU5_CACHE_ON' ) && ( USU5_CACHE_ON == 'true' ) ) ? true : false; 
      if ( !self::$_singleton instanceof File_Cache_Module ) {
        if ( Usu_Main::i()->getVar( 'page_modules', substr( Usu_Main::i()->getVar( 'filename' ), 0, -4 ) ) instanceof aPage_Modules ) { 
          self::$cache_name = Usu_Main::i()->getVar( 'page_modules', substr( Usu_Main::i()
                                           ->getVar( 'filename' ), 0, -4 ) )
                                           ->buildCacheName();
          Usu_Main::i()->setVar( 'cache_name', self::$cache_name );
        } else { // No module so we set the cache name as the language id plus the called file
          self::$cache_name = Usu_Main::i()->getVar( 'languages_id' ) . '_' . substr( Usu_Main::i()->getVar( 'filename' ), 0, -4 );
          Usu_Main::i()->setVar( 'cache_name', self::$cache_name ); 
        } 
        self::checkCacheWriteable();
        self::$_singleton = new self;
      }
      return self::$_singleton; 
    } // end method
    /**
    * Stores the current cache on the destruction of the Usu_Main class
    * 
    * @uses is_readable()
    * @uses file_exists()
    * @uses gzdeflate()
    * @uses serialize()
    * @uses file_put_contents()
    * @see Usu_Main::__destruct()
    * @param array $registry_vars - array of data to cache
    * 
    * @access public
    * @return void
    */
    public function store( array $registry_vars = array() ) {
      if ( false !== self::$cache_on  ) {
        $path_to_file = Usu_Main::i()->getVar( 'cache_system_path' ) . 'cache/' . self::$cache_name . '.cache';
        if ( is_readable( $path_to_file ) ) {
          $this->gc( new SplFileInfo( $path_to_file ) );
        }
        if ( !file_exists( $path_to_file ) ) {
          $to_cache = gzdeflate( serialize( $registry_vars ), 1 );
          file_put_contents( $path_to_file, $to_cache, LOCK_EX );
        }
      } 
    } // end method
    /**
    * Retrieve the cached data
    * 
    * @see  Usu_Main::extractCacheData()
    * 
    * @access public
    * @return void
    */
    public function retrieve() {
      if ( false !== self::$cache_on  ) {
        Usu_Main::i()->extractCacheData( self::$cache_name, 'file', $this );
      }
    } // end method
    /**
    * Cache garbage clearance
    * 
    * @param object $file_info - instance of SplFileInfo
    * @uses time()
    * @uses unlink()
    * @uses trigger_error()
    * 
    * @access public
    * @throws - triggers an error of type E_USER_WARNING if unable to delete the cache file
    * @return void
    */
    public function gc(  $file_info = false  ) {
      if ( !$file_info instanceof SplFileInfo ) {
        return false;
      }
      $cache_seconds = ( (int)USU5_CACHE_DAYS * 24 * 60 * 60 );
      $last_modified = $file_info->getMTime();
      if ( time() > ( $last_modified + $cache_seconds ) ) {
        if ( false === @unlink( Usu_Main::i()->getVar( 'cache_system_path' ) . 'cache/' . self::$cache_name . '.cache' ) ) {
          trigger_error( __CLASS__ . '::' . __FUNCTION__ . ' was unable to garbage clear a cache file using the unlink function', E_USER_WARNING );
        }
      }
    } // end method
    /**
    * Check that the cache directory is writeable
    * @uses trigger_error()
    * 
    * @access private
    * @throws - triggers an error of type E_USER_WARNING if the cache directory is not writeable
    * @return bool
    */
    private static function checkCacheWriteable() {
      $cache_file = Usu_Main::i()->getVar( 'cache_system_path' ) . 'cache/';
      if ( false === usu5_make_writeable( $cache_file) ) {
        trigger_error( __CLASS__ . '::' . __FUNCTION__ . ' could not make the cache directory writeable, you will need to do this manually.<br />' . $cache_file, E_USER_WARNING );
        return false;
      }
      return true;
    } // end method

  } // end class