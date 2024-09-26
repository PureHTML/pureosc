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
  * @lastmod $Date:: 2011-03-21 12:48:04 +0000 (Mon, 21 Mar 2011)       $:  Date of last commit
  * @version $Rev:: 206                                                 $:  Revision of last commit
  * @Id $Id:: sqlite.php 206 2011-03-21 12:48:04Z Rob                   $:  Full Details   
  */
  
  /**
  * Cache system using a SQLite database
  *
  * @package USU5_PRO
  */
  final class Sqlite_Cache_Module implements iCache_System {
    
    private static $_singleton = null;
    private static $sqlite_db_file = null;
    private static $cache_name;
    private static $cache_on;
    public static $db;
    public $extract_query = "SELECT * FROM usu_cache WHERE cache_name = ':cache_name'";
    private $insert_query = "INSERT INTO usu_cache (cache_name, cache_data, cache_date) VALUES (':cache_name', ':cache_data', ':cache_date')";
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
    * @uses is_readable()
    * @uses trigger_error()
    * 
    * @access public
    * @throws - triggers an error of type E_USER_WARNING if a new database cannot be created
    * @return Sqlite_Cache_Module
    */
    public static function i() { 
      if ( !self::$_singleton instanceof Sqlite_Cache_Module ) {
        if ( Usu_Main::i()->getVar( 'page_modules', substr( Usu_Main::i()->getVar( 'filename' ), 0, -4 ) ) instanceof aPage_Modules ) {
          self::$cache_on = ( defined( 'USU5_CACHE_ON' ) && ( USU5_CACHE_ON == 'true' ) ) ? true : false; 
          self::$cache_name = md5( Usu_Main::i()->getVar( 'page_modules', substr( Usu_Main::i()
                                           ->getVar( 'filename' ), 0, -4 ) )
                                           ->buildCacheName() );
          Usu_Main::i()->setVar( 'cache_name', self::$cache_name );
        } else { // No module so we set the cache name as the language id plus the called file
          self::$cache_name = Usu_Main::i()->getVar( 'languages_id' ) . '_' . substr( Usu_Main::i()->getVar( 'filename' ), 0, -4 ); 
        }
        self::$sqlite_db_file = Usu_Main::i()->getVar( 'cache_system_path' ) . 'sqlite/usu_cache.db';
        self::createDatabase(); 
        self::$_singleton = new self;
      }
      return self::$_singleton; 
    } // end method
    /**
    * Returns a limited singleton instance of the class specifically for admin
    * 
    * Allows admin to access a limited version of the class in order to truncate the database
    * 
    * @access public
    * @return Sqlite_Cache_Module
    */
    public static function admini() {
      if ( !self::$_singleton instanceof Sqlite_Cache_Module ) {
        self::$sqlite_db_file = realpath( dirname( __FILE__ ) ) . '/sqlite/usu_cache.db';
        self::createDatabase();
        self::$_singleton = new self;
      }
      return self::$_singleton;
    }
    /**
    * Create the SQLite database if it doesn't already exist
    * 
    * @uses is_readable()
    * @uses trigger_error()
    * 
    * @access protected
    * @throws - triggers an error of type E_USER_WARNING if a new database cannot be created
    * @return void
    */
    protected static function createDatabase() {
      if ( !is_readable( self::$sqlite_db_file ) ) {
        self::$db = new SQLiteDatabase( self::$sqlite_db_file, 0666, $error )
        or trigger_error( 'Failed: ' . $error, E_USER_WARNING );
        self::createTables();
      } else {
        self::$db = new SQLiteDatabase( self::$sqlite_db_file, 0666, $error )
        or trigger_error( 'Failed: ' . $error, E_USER_WARNING );
      }
    }
    /**
    * Stores the current cache on the destruction of the Usu_Main class 
    * 
    * @see Usu_Main::__destruct()
    * @uses serialize()
    * @uses base64_encode()
    * @uses gzdeflate()
    * @uses str_replace()
    * @uses date()
    * @uses sqlite_escape_string()
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
          $replacements = array( sqlite_escape_string( self::$cache_name ), sqlite_escape_string( $rawdata ), date( "Y-m-d H:i:s" ) );
          $query = str_replace( $targets, $replacements, $this->insert_query );
          self::$db->query( $query );
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
        $this->insert = Usu_Main::i()->extractCacheData( self::$cache_name, 'sqlite', $this );
      }
    }
    /**
    * Cache garbage clearance
    * 
    * @uses file_exists()
    * @uses unlink()
    * @param bool $file_info
    * 
    * @access public
    * @return void
    */
    public function gc( $file_info = false ) {
      if ( file_exists( self::$sqlite_db_file ) ) {
        self::$db->query( 'DELETE FROM usu_cache' );
        self::$db->query( 'VACUUM usu_cache' );
      }
    }
    /**
    * Retrieve an instance of SQLiteDatabase
    * 
    * @access public
    * @return SQLiteDatabase
    */
    public function getDb() {
      return self::$db;
    }
    /**
    * Create the initial table and fileds for SQLiteDatabase
    * @access private
    */
    private static function createTables() {
      $create_query = "
      CREATE TABLE usu_cache (
        cache_name,
        cache_data,
        cache_date
      );
      
      CREATE UNIQUE INDEX idx_cache_name ON usu_cache( cache_name );";
      
      self::$db->query( $create_query );
    }

  } // end class