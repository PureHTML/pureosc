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
 * File based cache system.
 */
final class file implements cache_system
{
    private static $_singleton;
    private static $cache_name;
    private static $cache_on;

    private function __construct()
    {
    } // end constructor
    /**
     * Returns a singleton instance of the class.
     *
     * Sets the cache name and checks that the cache directory is writeable
     *
     * @uses defined()
     * @uses substr()
     *
     * @return File_Cache_Module
     */
    public static function i()
    {
        self::$cache_on = (\defined('USU5_CACHE_ON') && (USU5_CACHE_ON === 'true')) ? true : false;

        if (!self::$_singleton instanceof File_Cache_Module) {
            if (usu5::i()->getVar('page_modules', substr(usu5::i()->getVar('filename'), 0, -4)) instanceof page_modules) {
                self::$cache_name = usu5::i()->getVar('page_modules', substr(usu5::i()
                    ->getVar('filename'), 0, -4))
                    ->buildCacheName();
                usu5::i()->setVar('cache_name', self::$cache_name);
            } else { // No module so we set the cache name as the language id plus the called file
                self::$cache_name = usu5::i()->getVar('languages_id').'_'.substr(usu5::i()->getVar('filename'), 0, -4);
                usu5::i()->setVar('cache_name', self::$cache_name);
            }

            self::checkCacheWriteable();
            self::$_singleton = new self();
        }

        return self::$_singleton;
    } // end method
    /**
     * Stores the current cache on the destruction of the usu5 class.
     *
     * @uses file_exists()
     * @uses file_put_contents()
     * @uses gzdeflate()
     * @uses is_readable()
     * @uses serialize()
     *
     * @see usu5::__destruct()
     *
     * @param array $registry_vars - array of data to cache
     */
    public function store(array $registry_vars = []): void
    {
        if (false !== self::$cache_on) {
            $path_to_file = usu5::i()->getVar('cache_system_path').'cache/'.self::$cache_name.'.cache';

            if (is_readable($path_to_file)) {
                $this->gc(new SplFileInfo($path_to_file));
            }

            if (!file_exists($path_to_file)) {
                $to_cache = gzdeflate(serialize($registry_vars), 1);
                file_put_contents($path_to_file, $to_cache, \LOCK_EX);
            }
        }
    } // end method
    /**
     * Retrieve the cached data.
     *
     * @see  usu5::extractCacheData()
     */
    public function retrieve(): void
    {
        if (false !== self::$cache_on) {
            usu5::i()->extractCacheData(self::$cache_name, 'file', $this);
        }
    } // end method
    /**
     * Cache garbage clearance.
     *
     * @uses time()
     * @uses trigger_error()
     * @uses unlink()
     *
     * @param object $file_info - instance of SplFileInfo
     *
     * @throws - triggers an error of type E_USER_WARNING if unable to delete the cache file
     */
    public function gc($file_info = false)
    {
        if (!$file_info instanceof SplFileInfo) {
            return false;
        }

        $cache_seconds = ((int) USU5_CACHE_DAYS * 24 * 60 * 60);
        $last_modified = $file_info->getMTime();

        if (time() > ($last_modified + $cache_seconds)) {
            if (false === @unlink(usu5::i()->getVar('cache_system_path').'cache/'.self::$cache_name.'.cache')) {
                trigger_error(__CLASS__.'::'.__FUNCTION__.' was unable to garbage clear a cache file using the unlink function', \E_USER_WARNING);
            }
        }
    } // end method
    /**
     * Check that the cache directory is writeable.
     *
     * @uses trigger_error()
     *
     * @throws - triggers an error of type E_USER_WARNING if the cache directory is not writeable
     *
     * @return bool
     */
    private static function checkCacheWriteable()
    {
        $cache_file = usu5::i()->getVar('cache_system_path').'cache/';

        if (false === usu5_make_writeable($cache_file)) {
            trigger_error(__CLASS__.'::'.__FUNCTION__.' could not make the cache directory writeable, you will need to do this manually.<br />'.$cache_file, \E_USER_WARNING);

            return false;
        }

        return true;
    } // end method
} // end class
