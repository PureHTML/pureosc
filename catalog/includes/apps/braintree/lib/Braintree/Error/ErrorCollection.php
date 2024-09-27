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

namespace Braintree\Error;

use Braintree\Util;
use Countable;
use JsonSerializable;

/**
 * Error handler
 * Handles validation errors.
 *
 * Contains a read-only property $error which is a ValidationErrorCollection
 *
 * @category   Errors
 *
 * @property object $errors
 */
class ErrorCollection implements \Countable, \JsonSerializable
{
    private $_errors;

    public function __construct($errorData)
    {
        $this->_errors =
                new ValidationErrorCollection($errorData);
    }

    /**
     * @ignore
     *
     * @param mixed $name
     */
    public function __get($name)
    {
        $varName = "_{$name}";

        return $this->{$varName} ?? null;
    }

    /**
     * @ignore
     */
    public function __toString()
    {
        return sprintf('%s', $this->_errors);
    }

    /**
     * Return count of items in collection
     * Implements countable.
     *
     * @return int
     */
    public function count()
    {
        return $this->deepSize();
    }

    /**
     * Returns all of the validation errors at all levels of nesting in a single, flat array.
     */
    public function deepAll()
    {
        return $this->_errors->deepAll();
    }

    /**
     * Returns the total number of validation errors at all levels of nesting. For example,
     *if creating a customer with a credit card and a billing address, and each of the customer,
     * credit card, and billing address has 1 error, this method will return 3.
     *
     * @return int size
     */
    public function deepSize()
    {
        return $this->_errors->deepSize();
    }

    /**
     * return errors for the passed key name.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function forKey($key)
    {
        return $this->_errors->forKey($key);
    }

    /**
     * return errors for the passed html field.
     * For example, $result->errors->onHtmlField("transaction[customer][last_name]").
     *
     * @param string $field
     *
     * @return array
     */
    public function onHtmlField($field)
    {
        $pieces = preg_split('/[\\[\\]]+/', $field, 0, \PREG_SPLIT_NO_EMPTY);
        $errors = $this;

        foreach (\array_slice($pieces, 0, -1) as $key) {
            $errors = $errors->forKey(Util::delimiterToCamelCase($key));

            if (!isset($errors)) {
                return [];
            }
        }

        $finalKey = Util::delimiterToCamelCase(end($pieces));

        return $errors->onAttribute($finalKey);
    }

    /**
     * Returns the errors at the given nesting level (see forKey) in a single, flat array:
     *
     * <code>
     *   $result = Customer::create(...);
     *   $customerErrors = $result->errors->forKey('customer')->shallowAll();
     * </code>
     */
    public function shallowAll()
    {
        return $this->_errors->shallowAll();
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
        return $this->_errors->deepAll();
    }
}
