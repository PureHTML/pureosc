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
 * Data registry.
 */
final class data_registry
{
    private static $_singleton;
    private $vars = [];
    /**
     * Class constructor.
     */
    private function __construct()
    {
    } // end constructor
    /**
     * Class destructor.
     */
    public function __destruct()
    {
    } // end destructor

    /**
     * Prepare the vars array to be serialized.
     *
     * @return $vars
     */
    public function __sleep()
    {
        return ['vars'];
    } // end method
    /**
     * Unimplemented magic method.
     */
    public function __wakeup(): void
    {
    } // end method
    /**
     * Returns a singleton instance of the class.
     *
     * @return data_registry
     */
    public static function i()
    {
        if (!self::$_singleton instanceof self) {
            self::$_singleton = new self();
        }

        return self::$_singleton;
    } // end method
    /**
     * Attach data to the $vars array.
     *
     * @param string $index        - index key of $vars
     * @param string $index2       - secondary index of $vars
     * @param mixed  $array_values - bool false / array
     *
     * @example $this->vars[$index][$index2]
     */
    public function attach($index, $index2, $array_values = false)
    {
        if (false === \array_key_exists($index, $this->vars)) {
            if (false === $array_values) {
                return $this->vars[$index] = $index2;
            }

            $this->vars[$index] = [];
        }

        if (false === \array_key_exists($index2, $this->vars[$index])) {
            $this->vars[$index][$index2] = [];
            $this->vars[$index][$index2] = $array_values;
        }
    } // end method
    /**
     * Retrieve data from the $vars array.
     *
     * @param string $index  - primary index
     * @param string $index2 - secondary index
     *
     * @return mixed - bool false / data found by the retrieval
     */
    public function retrieve($index, $index2 = false)
    {
        if (!\is_array($this->vars)) {
            $this->vars = [];
        }

        if (\array_key_exists($index, $this->vars)) {
            if (false === $index2) {
                return $this->vars[$index];
            }

            if (\array_key_exists($index2, $this->vars[$index])) {
                return $this->vars[$index][$index2];
            }
        }

        return false;
    } // end method
    /**
     * Return the $vars array to be stored by the cache system.
     *
     * @return array $vars
     */
    public function store()
    {
        return $this->vars;
    }
    /**
     * Re populate the registry from the cache system.
     *
     * @see usu5::extractCacheData()
     *
     * @param mixed $cached_registry_data
     */
    public function load(array $cached_registry_data = []): void
    {
        $this->vars = $cached_registry_data;
    }
} // end class
