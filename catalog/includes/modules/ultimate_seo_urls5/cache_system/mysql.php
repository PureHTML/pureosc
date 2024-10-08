<?php

declare(strict_types=1);

/**
 * PureOSC, Open Source E-Commerce Solutions
 * https://pureosc.com
 *
 * Copyright (c) 2024 PureOSC
 *
 * Released under the GNU General Public License
 *
 * This file is part of the PureOSC package
 *
 *  (c) 2024 Šimon Formánek <mail@simonformanek.cz>
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Cache system using a MySQL database.
 */
final class mysql implements cache_system
{
    public $extract_query = "SELECT * FROM `usu_cache` WHERE cache_name = ':cache_name'";
    private static $_singleton;
    private static $cache_name;
    private static $cache_on;
    private $insert_query = "INSERT INTO `usu_cache` (cache_name, cache_data, cache_date) VALUES (':cache_name', ':cache_data', ':cache_date')";
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
     * @uses md5()
     * @uses substr()
     *
     * @return Mysql_Cache_Module
     */
    public static function i()
    {
        self::$cache_on = (\defined('USU5_CACHE_ON') && (USU5_CACHE_ON === 'true')) ? true : false;

        if (!self::$_singleton instanceof Mysql_Cache_Module) {
            if (Usu_Main::i()->getVar('page_modules', substr(Usu_Main::i()->getVar('filename'), 0, -4)) instanceof page_modules) {
                self::$cache_name = md5(Usu_Main::i()->getVar('page_modules', substr(Usu_Main::i()
                    ->getVar('filename'), 0, -4))
                    ->buildCacheName());
                Usu_Main::i()->setVar('cache_name', self::$cache_name);
            } else { // No module so we set the cache name as the language id plus the called file
                self::$cache_name = Usu_Main::i()->getVar('languages_id').'_'.substr(Usu_Main::i()->getVar('filename'), 0, -4);
                Usu_Main::i()->setVar('cache_name', self::$cache_name);
            }

            self::$_singleton = new self();
        }

        return self::$_singleton;
    } // end method
    /**
     * Stores the current cache on the destruction of the Usu_Main class.
     *
     * @see Usu_Main::__destruct()
     *
     * @uses base64_encode()
     * @uses date()
     * @uses gzdeflate()
     * @uses serialize()
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
                $replacements = [tep_db_input(self::$cache_name), tep_db_input($rawdata), date('Y-m-d H:i:s')];
                $query = str_replace($targets, $replacements, $this->insert_query);
                Usu_Main::i()->query($query);
            }
        }
    } // end method
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
            $this->insert = Usu_Main::i()->extractCacheData(self::$cache_name, 'mysql', $this);
        }
    } // end method
    /**
     * Cache garbage clearance.
     *
     * @param bool $file_info
     */
    public function gc($file_info = false): void
    {
        $this->insert = true;
        Usu_Main::i()->query('TRUNCATE `usu_cache`');
    } // end method
} // end class
