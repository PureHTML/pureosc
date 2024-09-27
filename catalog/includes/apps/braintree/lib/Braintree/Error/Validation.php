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

/**
 * error object returned as part of a validation error collection
 * provides read-only access to $attribute, $code, and $message.
 *
 * <b>== More information ==</b>
 *
 * For more detailed information on Validation errors, see {@link https://developers.braintreepayments.com/reference/general/validation-errors/overview/php https://developers.braintreepayments.com/reference/general/validation-errors/overview/php}
 *
 * @property string $attribute
 * @property string $code
 * @property string $message
 */
class Validation
{
    private $_attribute;
    private $_code;
    private $_message;

    /**
     * @ignore
     *
     * @param array $attributes
     */
    public function __construct($attributes)
    {
        $this->_initializeFromArray($attributes);
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
     * initializes instance properties from the keys/values of an array.
     *
     * @ignore
     *
     * @param array $attributes array of properties to set - single level
     */
    private function _initializeFromArray($attributes): void
    {
        foreach ($attributes as $name => $value) {
            $varName = "_{$name}";
            $this->{$varName} = Util::delimiterToCamelCase($value, '_');
        }
    }
}
