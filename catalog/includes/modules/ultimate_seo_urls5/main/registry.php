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
 * Data registry.
 */
final class registry
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
     * @return Data_Registry
     */
    public static function i()
    {
        if (!self::$_singleton instanceof Data_Registry) {
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
     * @see USU_Main::extractCacheData()
     *
     * @param mixed $cached_registry_data
     */
    public function load(array $cached_registry_data = []): void
    {
        $this->vars = $cached_registry_data;
    }
} // end class
