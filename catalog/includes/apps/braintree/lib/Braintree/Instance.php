<?php

declare(strict_types=1);

/**
 * osCommerce, Open Source E-Commerce Solutions
 * http://www.oscommerce.com
 *
 * Copyright (c) 2020 osCommerce
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

namespace Braintree;

/**
 * Braintree Class Instance template.
 */
abstract class Instance
{
    protected $_attributes = [];

    /**
     * @param array $attributes
     */
    public function __construct($attributes)
    {
        if (!empty($attributes)) {
            $this->_initializeFromArray($attributes);
        }
    }

    /**
     * returns private/nonexistent instance properties.
     *
     * @param string $name property name
     *
     * @return mixed contents of instance properties
     */
    public function __get($name)
    {
        if (\array_key_exists($name, $this->_attributes)) {
            return $this->_attributes[$name];
        }

        trigger_error('Undefined property on '.\get_class($this).': '.$name, \E_USER_NOTICE);

        return null;
    }

    /**
     * used by isset() and empty().
     *
     * @param string $name property name
     *
     * @return bool
     */
    public function __isset($name)
    {
        return \array_key_exists($name, $this->_attributes);
    }

    /**
     * create a printable representation of the object as:
     * ClassName[property=value, property=value]
     *
     * @return string
     */
    public function __toString()
    {
        $objOutput = Util::implodeAssociativeArray($this->_attributes);

        return \get_class($this).'['.$objOutput.']';
    }
    /**
     * initializes instance properties from the keys/values of an array.
     *
     * @ignore
     *
     * @param mixed $attributes
     * @param <type> $aAttribs array of properties to set - single level
     */
    private function _initializeFromArray($attributes): void
    {
        $this->_attributes = $attributes;
    }
}
