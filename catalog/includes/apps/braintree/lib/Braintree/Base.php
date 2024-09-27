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

namespace Braintree;

use JsonSerializable;

/**
 * Braintree PHP Library.
 *
 * Braintree base class and initialization
 * Provides methods to child classes. This class cannot be instantiated.
 */
abstract class Base implements \JsonSerializable
{
    protected $_attributes = [];

    /**
     * @ignore
     * don't permit an explicit call of the constructor!
     * (like $t = new Transaction())
     */
    protected function __construct()
    {
    }

    /**
     * Disable cloning of objects.
     *
     * @ignore
     */
    protected function __clone()
    {
    }

    /**
     * Accessor for instance properties stored in the private $_attributes property.
     *
     * @ignore
     *
     * @param string $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        if (isset($this->_attributes['globalId'])) {
            $this->_attributes['graphQLId'] = $this->_attributes['globalId'];
        }

        if (\array_key_exists($name, $this->_attributes)) {
            return $this->_attributes[$name];
        }

        trigger_error('Undefined property on '.\get_class($this).': '.$name, \E_USER_NOTICE);

        return null;
    }

    /**
     * Checks for the existence of a property stored in the private $_attributes property.
     *
     * @ignore
     *
     * @param string $name
     *
     * @return bool
     */
    public function __isset($name)
    {
        return \array_key_exists($name, $this->_attributes);
    }

    /**
     * Mutator for instance properties stored in the private $_attributes property.
     *
     * @ignore
     *
     * @param string $key
     * @param mixed  $value
     */
    public function _set($key, $value): void
    {
        $this->_attributes[$key] = $value;
    }

    /**
     * Implementation of JsonSerializable.
     *
     * @ignore
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->_attributes;
    }
}
