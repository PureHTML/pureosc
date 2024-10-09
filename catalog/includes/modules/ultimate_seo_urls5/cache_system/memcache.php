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
 * Cache system using Memcached.
 *
 * @see http://memcached.org/
 */
final class memcache extends Memcache implements cache_system
{
    private static $_singleton;
    private static $cache_name;
    private static $cache_on;
    private static $memcache_host = 'localhost';
    private static $memcache_port = '11211';
    private static $memcache_prefix = 'usu_';
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
     * @return Memcache_Cache_Module
     */
    public static function i()
    {
        if (!self::$_singleton instanceof Memcache_Cache_Module) {
            if (usu5::i()->getVar('page_modules', substr(usu5::i()->getVar('filename'), 0, -4)) instanceof page_modules) {
                self::$cache_on = (\defined('USU5_CACHE_ON') && (USU5_CACHE_ON === 'true')) ? true : false;
                self::$cache_name = self::$memcache_prefix.md5(HTTP_SERVER.usu5::i()->getVar('page_modules', substr(usu5::i()
                    ->getVar('filename'), 0, -4))
                    ->buildCacheName());
                usu5::i()->setVar('cache_name', self::$cache_name);
            } else { // No module so we set the cache name as the language id plus the called file
                self::$cache_name = self::$memcache_prefix.md5(HTTP_SERVER.usu5::i()->getVar('languages_id').'_'.substr(usu5::i()
                    ->getVar('filename'), 0, -4));
                usu5::i()->setVar('cache_name', self::$cache_name);
            }

            self::$_singleton = new self();
        }

        return self::$_singleton;
    } // end method
    /**
     * Singleton access for the class via admin.
     *
     * @return Memcache_Cache_Module
     */
    public function iAdmin()
    {
        if (!self::$_singleton instanceof Memcache_Cache_Module) {
            self::$_singleton = new self();
        }

        return self::$_singleton;
    }
    /**
     * Connect to the memcache server.
     *
     * @throws - triggers an error of type E_USER_WARNING when connection to the memcache server fails
     *
     * @return mixed - bool false / Memcache_Cache_Module
     */
    public function initiate()
    {
        if (false === $this->connect(self::$memcache_host, self::$memcache_port)) {
            trigger_error(__CLASS__.'::'.__FUNCTION__.'() Could not connect to memcache server', \E_USER_WARNING);

            return false;
        }

        return $this;
    }
    /**
     * Stores the current cache on the destruction of the usu5 class.
     *
     * @see usu5::__destruct()
     *
     * @uses base64_encode()
     * @uses gzdeflate()
     * @uses serialize()
     *
     * @param array $registry_vars - array of data to cache
     */
    public function store(array $registry_vars = []): void
    {
        if (false !== self::$cache_on) {
            if (false !== $this->insert) {
                $data = serialize($registry_vars);
                $rawdata = base64_encode(gzdeflate($data));

                if (false === $this->add(self::$cache_name, $rawdata, 0, 3600)) {
                    $this->replace(self::$cache_name, $rawdata, 0, 3600);
                }
            }
        }
    }
    /**
     * Retrieve the cached data.
     *
     * If $insert becomes bool true then we insert data when storing, bool false we don't save as the cache already exists
     *
     * @see usu5::extractCacheData()
     */
    public function retrieve(): void
    {
        if (false !== self::$cache_on) {
            $this->insert = usu5::i()->extractCacheData(self::$cache_name, 'memcache', $this);
        }
    }
    /**
     * Cache garbage clearance.
     *
     * @param bool $file_info
     */
    public function gc($file_info = false): void
    {
        $this->insert = true;
        $this->delete($this->cachename);
    } // end method
    /**
     * Flush memcache clearing all data.
     */
    public function flushOut(): void
    {
        $this->flush();
    } // end method
} // end class
