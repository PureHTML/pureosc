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

namespace Braintree\Error;

use Braintree\Collection;

/**
 * collection of errors enumerating all validation errors for a given request.
 *
 * <b>== More information ==</b>
 *
 * For more detailed information on Validation errors, see {@link https://developers.braintreepayments.com/reference/general/validation-errors/overview/php https://developers.braintreepayments.com/reference/general/validation-errors/overview/php}
 *
 * @property array $errors
 * @property array $nested
 */
class ValidationErrorCollection extends Collection
{
    private $_errors = [];
    private $_nested = [];

    /**
     * @ignore
     *
     * @param mixed $data
     */
    public function __construct($data)
    {
        foreach ($data as $key => $errorData) {
            // map errors to new collections recursively
            if ($key === 'errors') {
                foreach ($errorData as $error) {
                    $this->_errors[] = new Validation($error);
                }
            } else {
                $this->_nested[$key] = new self($errorData);
            }
        }
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
        $output = [];

        if (!empty($this->_errors)) {
            $output[] = $this->_inspect($this->_errors);
        }

        if (!empty($this->_nested)) {
            foreach ($this->_nested as $key => $values) {
                $output[] = $this->_inspect($this->_nested);
            }
        }

        return implode(', ', $output);
    }

    public function deepAll()
    {
        $validationErrors = array_merge([], $this->_errors);

        foreach ($this->_nested as $nestedErrors) {
            $validationErrors = array_merge($validationErrors, $nestedErrors->deepAll());
        }

        return $validationErrors;
    }

    public function deepSize()
    {
        $total = \count($this->_errors);

        foreach ($this->_nested as $_nestedErrors) {
            $total += $_nestedErrors->deepSize();
        }

        return $total;
    }

    public function forIndex($index)
    {
        return $this->forKey('index'.$index);
    }

    public function forKey($key)
    {
        return $this->_nested[$key] ?? null;
    }

    public function onAttribute($attribute)
    {
        $matches = [];

        foreach ($this->_errors as $key => $error) {
            if ($error->attribute === $attribute) {
                $matches[] = $error;
            }
        }

        return $matches;
    }

    public function shallowAll()
    {
        return $this->_errors;
    }

    /**
     * @ignore
     *
     * @param mixed      $errors
     * @param null|mixed $scope
     */
    private function _inspect($errors, $scope = null)
    {
        $eOutput = '['.__CLASS__.'/errors:[';
        $outputErrs = [];

        foreach ($errors as $error => $errorObj) {
            if (\is_array($errorObj->error)) {
                $outputErrs[] = "({$errorObj->error['code']} {$errorObj->error['message']})";
            }
        }

        $eOutput .= implode(', ', $outputErrs).']]';

        return $eOutput;
    }
}
