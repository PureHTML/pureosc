<?php

declare(strict_types=1);

/**
 * This file is part of the DvereCOM package
 *
 *  (c) Šimon Formánek <mail@simonformanek.cz>
 * This file is part of the MultiFlexi package
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Cache system using a SQLite database.
 */
final class sqlite implements cache_system
{
    public static $db;
    public $extract_query = "SELECT * FROM usu_cache WHERE cache_name = ':cache_name'";
    private static $_singleton;
    private static $sqlite_db_file;
    private static $cache_name;
    private static $cache_on;
    private $insert_query = "INSERT INTO usu_cache (cache_name, cache_data, cache_date) VALUES (':cache_name', ':cache_data', ':cache_date')";
    private $insert = false;
    /**
     * Class constructor.
     */
    private function __construct()
    {
    } // end constructor
    /**
     * Returns a singleton instance of the class.
     *
     * Sets the cache name and checks that the cache directory is writeable
     *
     * @uses defined()
     * @uses is_readable()
     * @uses md5()
     * @uses substr()
     * @uses trigger_error()
     *
     * @throws - triggers an error of type E_USER_WARNING if a new database cannot be created
     *
     * @return Sqlite_Cache_Module
     */
    public static function i()
    {
        if (!self::$_singleton instanceof Sqlite_Cache_Module) {
            if (Usu_Main::i()->getVar('page_modules', substr(Usu_Main::i()->getVar('filename'), 0, -4)) instanceof page_modules) {
                self::$cache_on = (\defined('USU5_CACHE_ON') && (USU5_CACHE_ON === 'true')) ? true : false;
                self::$cache_name = md5(Usu_Main::i()->getVar('page_modules', substr(Usu_Main::i()
                    ->getVar('filename'), 0, -4))
                    ->buildCacheName());
                Usu_Main::i()->setVar('cache_name', self::$cache_name);
            } else { // No module so we set the cache name as the language id plus the called file
                self::$cache_name = Usu_Main::i()->getVar('languages_id').'_'.substr(Usu_Main::i()->getVar('filename'), 0, -4);
            }

            self::$sqlite_db_file = Usu_Main::i()->getVar('cache_system_path').'sqlite/usu_cache.db';
            self::createDatabase();
            self::$_singleton = new self();
        }

        return self::$_singleton;
    } // end method
    /**
     * Returns a limited singleton instance of the class specifically for admin.
     *
     * Allows admin to access a limited version of the class in order to truncate the database
     *
     * @return Sqlite_Cache_Module
     */
    public static function admini()
    {
        if (!self::$_singleton instanceof Sqlite_Cache_Module) {
            self::$sqlite_db_file = realpath(__DIR__).'/sqlite/usu_cache.db';
            self::createDatabase();
            self::$_singleton = new self();
        }

        return self::$_singleton;
    }
    /**
     * Stores the current cache on the destruction of the Usu_Main class.
     *
     * @see Usu_Main::__destruct()
     *
     * @uses base64_encode()
     * @uses date()
     * @uses gzdeflate()
     * @uses serialize()
     * @uses sqlite_escape_string()
     * @uses str_replace()
     *
     * @param array $registry_vars - array of data to cache
     */
    public function store(array $registry_vars = []): void
    {
        if (false !== self::$cache_on) {
            if (false !== $this->insert) {
                $data = serialize($registry_vars); // Serialize the registry of data
                $rawdata = base64_encode(gzdeflate($data)); // encode and deflate
                $targets = [':cache_name', ':cache_data', ':cache_date'];
                $replacements = [sqlite_escape_string(self::$cache_name), sqlite_escape_string($rawdata), date('Y-m-d H:i:s')];
                $query = str_replace($targets, $replacements, $this->insert_query);
                self::$db->query($query);
            }
        }
    }
    /**
     * Retrieve the cached data.
     *
     * If $insert becomes bool true then we insert data when storing, bool false we don't save as the cache already exists
     *
     * @see Usu_Main::extractCacheData()
     */
    public function retrieve(): void
    {
        if (false !== self::$cache_on) {
            $this->insert = Usu_Main::i()->extractCacheData(self::$cache_name, 'sqlite', $this);
        }
    }
    /**
     * Cache garbage clearance.
     *
     * @uses file_exists()
     * @uses unlink()
     *
     * @param bool $file_info
     */
    public function gc($file_info = false): void
    {
        if (file_exists(self::$sqlite_db_file)) {
            self::$db->query('DELETE FROM usu_cache');
            self::$db->query('VACUUM usu_cache');
        }
    }
    /**
     * Retrieve an instance of SQLiteDatabase.
     *
     * @return SQLiteDatabase
     */
    public function getDb()
    {
        return self::$db;
    }
    /**
     * Create the SQLite database if it doesn't already exist.
     *
     * @uses is_readable()
     * @uses trigger_error()
     *
     * @throws - triggers an error of type E_USER_WARNING if a new database cannot be created
     */
    private static function createDatabase(): void
    {
        if (!is_readable(self::$sqlite_db_file)) {
            self::$db = new SQLiteDatabase(self::$sqlite_db_file, 0666, $error)
            || trigger_error('Failed: '.$error, \E_USER_WARNING);
            self::createTables();
        } else {
            self::$db = new SQLiteDatabase(self::$sqlite_db_file, 0666, $error)
            || trigger_error('Failed: '.$error, \E_USER_WARNING);
        }
    }
    /**
     * Create the initial table and fileds for SQLiteDatabase.
     */
    private static function createTables(): void
    {
        $create_query = <<<'EOD'

      CREATE TABLE usu_cache (
        cache_name,
        cache_data,
        cache_date
      );

      CREATE UNIQUE INDEX idx_cache_name ON usu_cache( cache_name );
EOD;

        self::$db->query($create_query);
    }
} // end class
